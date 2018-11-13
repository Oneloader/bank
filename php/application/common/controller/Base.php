<?php
namespace app\common\controller;
use app\common\logic\k11ApiLogic;
use app\wiki\model\Customer;
use app\common\model\Mall;
use app\common\model\Sales;
use app\common\model\Shop;
use app\wiki\model\Tags;
use think\Controller;
use think\Db;
use think\Page;
use think\Session;

class Base extends Controller {
    public $url;            //导购二维码地址
    public $sid;            //银行id
    public $ssid;           //商城id
    public $sa_id;          //staff_code
    public $sa_ticket;     //staff_code
    public $mallId;
    public $unionid;
    public $sales_id;
    public $sales_name;
    public $accountId;
    public $customer;
    public $customer_id;
    public $customer_openid;
    public $customer_unionId;

    /*
     * 初始化操作
     */
    public function _initialize(){
        clean_xss($_GET);
        clean_xss($_POST);
        //header("Cache-control: private");  // history.back返回后输入框值丢失问题
        //权限检查
        if(!in_array(ACTION_NAME,['login','salesLogout'])){
            //SA登录
            $identity = $this->checkIdentity();
            if(!empty($identity) && is_array($identity)){
                $this->sid = $identity['sid'];
                $this->ssid = $identity['ssid'];
                $this->sa_id = $identity['sa_id'];
                $this->sa_ticket = $identity['ticket'];
                $this->sales_name = $identity['username'];
                $this->mallId = $identity['mall_id'];
                $this->unionid = $identity['unionid'];
                $this->sales_id = $identity['id'];
                $this->url = $identity['url'];

                $shop_info = $this->getShopInfo();
                $this->accountId = $shop_info['account_id'];
                //$this->mallId = $shop_info['store_code'];
            }else{
                ajaxReturn(['status'=>99,'msg'=>'您的身份验证已过期，请重新登录验证。']);
                //errorReturn('身份验证失败,请重新登录');
            }

            if(!in_array(ACTION_NAME,['getSalesInfo','getAds','getBrandInfo','getGoodsInfo','getWeixinCardErcode',
                'search','getSalesErcode','getBrands','getHotBrands','getWeixinCards','getRecentCustomer','getAllCustomer',
                'getFansDegree','getSales','getSellList','pointsHelper','customerLogout','salesLogout','getBlackCards',
                'getApplyInfo','saveApplyData','customerLogin'])){
                //顾客登录
                $this->getCustomerCache();
                if(!empty($this->customer) && is_array($this->customer)){
                    $this->customer_id = $this->customer['id'];
                    $this->customer_openid = $this->customer['openid'];
                    $this->customer_unionId = $this->customer['union_id'];
                }
            }
        }
    }

    /**
     * 获取银行信息
     * @return array|false|mixed|\PDOStatement|string|\think\Model
     */
    protected function getMallInfo(){
        $sid = $this->sid;    //银行id
        $mallInfo = S('mall_info_'.$sid);
        if(empty($mallInfo)){
            $mallModel = new Mall();
            $mallInfo = $mallModel->getMallInfo($this->sid);    //获取银行对应的在线商城信息
            S('mall_info_'.$sid,$mallInfo);
        }
        return $mallInfo;
    }

    /**
     * 获取用户所有标签（本地标签 + CRM标签）
     * @return array|mixed
     */
    protected function getCustomerAllTags(){
        $k11Model = new k11ApiLogic($this->sid);
        $k11Model->mall_id = $this->mallId;
        $vip_code = $this->customer['vip_code'];
        if(!empty($vip_code)){
            $data = $k11Model->getCustomerCrmTags($vip_code);    //测试标签数据 0599006003583101
            $tags_ids = [];
            if(!empty($data) && is_array($data)){
                foreach($data as $k=>$v){
                    if(is_array($v['tag']) && !empty($v['tag'])){
                        $tags_ids1 = array_column($v['tag'],'id');
                        if(!empty($tags_ids1)){
                            $tags_ids = empty($tags_ids) ? $tags_ids1 : array_merge($tags_ids,$tags_ids1);
                        }
                    }
                }
            }
        }

        //获取所有用户绑定的标签id
        $tagModel = new Tags();
        $localTags = $tagModel->getAllTagIds($this->customer_id);
        if(empty($tags_ids) && empty($localTags)){
            //获取最新商品返回给用户
            $relation_tag_ids = [];
        }else{
            if(!empty($tags_ids) && !empty($localTags)){
                $relation_tag_ids = array_merge($tags_ids,$localTags);
            }else{
                $relation_tag_ids = empty($tags_ids) ? $localTags : $tags_ids;
            }
        }
        return $relation_tag_ids;
    }

    /**
     * 获取在线商城信息
     * @return mixed
     */
    protected function getShopInfo(){
        $shopModel = new Shop();
        return $shopInfo = $shopModel->shops[$this->ssid];
    }

    /**
     * 获取顾客UnionID
     * @return bool
     */
    protected function getCustomerUnionId(){
        if(!empty($this->customer_unionId)){
            return true;
        }
        if(empty($this->customer_openid)){
            return false;
        }
        $customerInfo = $this->getCustomerFromMall();
        if(!empty($customerInfo['union_id'])){
            $this->customer_unionId = $customerInfo['union_id'];
        }else{
            $k11Model = new k11ApiLogic($this->sid);
            $k11Model->account_id = $this->accountId;
            $returnData = $k11Model->getUnionId($this->customer_openid);
            if(!empty($returnData['unionid'])){
                $this->customer_unionId = $returnData['unionid'];
            }else{
                return false;
            }
        }
        return true;
    }

    /**
     * 从本地数据库获取customer信息
     * @return array|bool|false|\PDOStatement|string|\think\Model
     */
    protected function getCustomerFromMall(){
        $openId = $this->customer_openid;
        $unionId = $this->customer_unionId;
        if(empty($unionId) && empty($openId)){
            return false;
        }
        $customerModel = new Customer();
        $customerModel->sid = $this->sid;
        $customerInfo = $customerModel->getCustomerInfo($openId,$unionId);
        return $customerInfo;
    }

    /**
     * 从CRM+获取顾客信息
     * @return array|mixed
     */
    protected function getCustomerFromCrm($unionid = ''){
        $customer_unionid = empty($unionid) ? $this->customer_unionId : $unionid;
        if(empty($customer_unionid)){
            return ['status' => 0 ,'msg'=>'参数丢失'];
        }
        $k11model = new k11ApiLogic($this->sid);
        $salesInfo = $k11model->getMemberInfo($customer_unionid);

        //更新本地会员信息
        $customerModel = new Customer();
        $customerInfo1['union_id'] = $customer_unionid;
        $customerInfo1['vip_code'] = $salesInfo[0]['vip_code'];
        $customerInfo1['member_id'] = $salesInfo[0]['member_id'];
        $customerInfo1['level_id'] = $salesInfo[0]['level_id'];
        $customerInfo1['level'] = $salesInfo[0]['level'];
        $customerInfo1['nick_name'] = $salesInfo[0]['nick_name'];
        $customerInfo1['sid'] = $this->sid;
        $customerModel->saveInfo($customerInfo1);    //保存顾客信息

        return $salesInfo[0];
    }

    /**
     * 核查导购员身份
     * @return array|bool|false|\PDOStatement|string|\think\Model
     */
    protected function checkIdentity(){
        $auth = session('sadata');
        if(empty($auth)){
            return false;
        }
        $sale_info_str = ucAuthCode($auth);
        $sale_info = json_decode($sale_info_str,true);
        if(count($sale_info) !== 4 ){
            session('sadata',null);
            return false;
        }
        $salesModel = new Sales();
        $sales_id = intval($sale_info[1]);
        if($sales_id == 0){
            session('sadata',null);
            return false;
        }
        $saleInfo = $salesModel->getSaleInfoById($sales_id);
        if(empty($saleInfo)){
            session('sadata',null);
            return false;
        }
        if($saleInfo['status'] == 0){
            session('sadata',null);
            return false;
        }
        unset($auth,$sale_info_str,$salesModel,$sales_id);
        if($saleInfo['sa_id'] ==  $sale_info[2] && $saleInfo['openid'] == $sale_info[3] && $saleInfo['sid'] == $sale_info[0]){
            return $saleInfo;
        }
        session('sadata',null);
        return false;
    }

    /**
     * 获取顾客缓存数据
     * @return bool|mixed
     */
    public function getCustomerCache(){
        $auth = cookie('customerdata');
        //file_put_contents(RUNTIME_PATH . 'getSaInfo33_'.time().'.php', $auth);
        if(empty($auth)){
            return false;
        }
        $customer_info_str = ucAuthCode($auth);
        $customer_info = json_decode($customer_info_str,true);
        //file_put_contents(RUNTIME_PATH . 'getSaInfo44.php', var_export($customer_info, true));
        if(empty($customer_info)){
            return false;
        }
        if(empty($customer_info[0]) && empty($customer_info[1])){
            //session('customerdata',null);
            return false;
        }else{
            $this->customer_openid = $customer_info[0];
            $this->customer_unionId = $customer_info[1];
            //获取customer信息
            $customerInfo = $this->getCustomerFromMall();
            //file_put_contents(RUNTIME_PATH . 'getSaInfo55.php', var_export($customerInfo, true));
            if(empty($customerInfo)){
                return false;
            }
            //获取当前服务客人是否已被其他人SA服务
            $date = Db::name('customer_come_log')
                ->field('stime,etime')
                ->where(['customer'=>$customerInfo['id'],'sales_id'=>$this->sales_id,'sid'=>$this->sid])
                ->order('id desc')
                ->find();
            if($date['etime'] > $date['stime']){
                $this->customer_openid = null;
                $this->customer_unionId = null;
                cookie('customerdata',null);
                //服务已结束
                return false;
            }
            $this->customer = $customerInfo;
            return true;
        }
    }

    protected function setCustomerCache($customerInfo){
        //缓存顾客信息
        $openid = empty($customerInfo['openid']) ? 0 : $customerInfo['openid'];
        $customerData = json_encode([$openid,$customerInfo['union_id'],$customerInfo['nick_name']]);
        $customerData = ucAuthCode($customerData,'ENCODE');
        cookie('customerdata',$customerData);
    }

    /**
     * 从CRM+获取sales数据
     * @return mixed
     */
    protected function getSaleFromCrm(){
        $k11model = new k11ApiLogic($this->sid);
        $k11model->mall_id = $this->mallId;
        $k11model->account_id = $this->accountId;
        if(empty($this->sa_id)){
            return false;
        }
        $salesInfo = $k11model->getSalesInfo($this->sa_id);
        return $salesInfo;
    }

    /**
     * 获取消费记录
     * @param $vipcode
     * @param $date
     * @return mixed
     */
    protected function getKpRecords($vipcode,$date=[]){
        $vipcode = empty($vipcode) ? $this->customer['vip_code'] : $vipcode;
        $sdate = empty($date['sdate']) ? date('Y-m-d',strtotime('-5 month')) : $date['sdate'] ;
        $edate = empty($date['edate']) ? date('Y-m-d') : $date['edate'];
        $k11model = new k11ApiLogic($this->sid);
        $k11model->mall_id = $this->mallId;
        $kpRecords = $k11model->getKpRecord($vipcode,$sdate,$edate);
        return $kpRecords;
    }

    /**
     * 等级顾客来访纪录
     */
    protected function customerComeLog(){
        $customerModel = new Customer();
        $customerModel->recordComeLog($this->customer_id,$this->sales_id,$this->sid);
    }

    /**
     * 添加注册记录
     * @throws \think\Exception
     */
    protected function addRegisterLog(){
        $date = date('Y-m-d');
        $datetime = date('Y-m-d H:i:s');
        //添加注册详情
        Db::name('customer_register')->add([
            'sales_id' => $this->sales_id,
            'customer' => $this->customer_id,
            'date'=> $datetime,
            'sid' => $this->sid,
        ]);

        //添加关注数
        $count = Db::name('sales_data')->where(['sales_id'=>$this->sales_id,'date'=>$date])->count('id');
        if($count > 0){
            Db::name('sales_data')->where(['sales_id'=>$this->sales_id,'date'=>$date])->setInc('register',1);
        }else{
            Db::name('sales_data')->add([
                'sales_id' => $this->sales_id,
                'date'=> $date,
                'sid' => $this->sid,
                'register' => 1,
            ]);
        }
    }

    /**
     * 保存所有导购单
     * @return bool
     */
    protected function saveRecentDayData(){
        //获取最近带客的一天
        /*$dates = Db::name('customer_come_log')->distinct(true)->where(['sales_id'=>$this->sales_id])->order('id desc')->limit(1)->getField('date',true);
        if(empty($dates)){
            return true;
        }
        sort($dates);
        //$count = Db::name('sales_sell_list')->where(['sales_id'=>$this->sales_id,'createdate'=>$dates[0]])->count('id');
        $startDay = $dates[0];*/
        $startDay = date('Y-m-d');  //只同步今天的订单，（每天定时任务全量更新）
        //获取开始日期到今天所有客人
        $customers = Db::name('customer_come_log')
            ->alias('a')
            ->field('a.stime,a.etime,a.customer,a.sales_id,b.id uid,b.vip_code,b.member_id')
            ->join('customer b','a.customer = b.id')
            ->where(['a.sales_id'=>$this->sales_id,'b.member_id'=>['neq',''],'a.date'=>['egt',$startDay]])
            ->order('a.id asc')
            ->select();
        //file_put_contents(RUNTIME_PATH . 'customer.php', var_export($customers, true));
        if(empty($customers)){
            return true;
        }
        $k11Model = new k11ApiLogic($this->sid);
        $allData = $allData2 = [];

        $hasGetData = [];   //已经查询过数据的顾客member_id
        foreach($customers as $k=>$v){
            //获取vip_code
            $stime = date('Y-m-d H:i:s',$v['stime']);
            //当天后面是否有扫码其他SA
            $otherScanTime = Db::name('customer_come_log')
                ->where(['customer'=>$v['customer'],'stime'=>['gt',$v['stime']],'sales_id'=>['neq',$this->sales_id]])
                ->order('id asc')
                ->getField('stime');
            if(empty($otherScanTime)){
                if(in_array($v['member_id'],$hasGetData)){
                    continue;
                }
                $etime = date('Y-m-d',$v['stime']).' 23:59:59';
                array_push($hasGetData,$v['member_id']);
            }else{
                $etime = date('Y-m-d H:i:s',$otherScanTime);
            }

            //$etime = $v['etime'] == 0 ? $stime : date('Y-m-d H:i:s',$v['etime']);
            //循环获取顾客消费记录(线下)
            $k11Model->mall_id = $this->mallId;
            $data = $k11Model->getKpRecord($v['member_id'],$stime,$etime);
            if(!empty($data) && is_array($data)){
                foreach($data as $kp=>$log){
                    if($log['bonus_type'] != '01'){
                        unset($data[$kp]);
                        continue;
                    }

                    unset($data[$kp]['bonus_type']);
                    if($v['uid'] > 0){
                        $data[$kp]['uid'] = $v['uid'];
                    }
                }
                $allData = empty($allData) ? $data : array_merge($allData,$data);
            }

            //循环获取顾客消费记录(线上)
            $data2 = $k11Model->getKpRecord($v['member_id'],$stime,$etime,2);
            if(!empty($data2) && is_array($data2)){
                foreach($data2 as $kp=>$log){
                    if($v['uid'] > 0){
                        $data2[$kp]['uid'] = $v['uid'];
                    }
                }
                $allData2 = empty($allData2) ? $data2 : array_merge($allData2,$data2);
            }
        }

        //file_put_contents(RUNTIME_PATH . 'allData1_'.time().'.php', var_export($allData,true));
        if(!empty($allData)){
            foreach($allData as $key=>$val){
                $allData[$key] = json_encode($val);
            }
            $allData = array_unique($allData);
            //获取所查询的日期已经记录了导购单
            $record_noes = Db::name('sales_sell_list')->where(['sales_id'=>$this->sales_id,'createdate'=>['egt',$startDay]])->getField('record_no',true);
            foreach($allData as $k=>$v){
                $v = json_decode($v,true);
                if(!empty($record_noes) && in_array($v['record_no'],$record_noes)){
                    unset($allData[$k]);
                    continue;
                }
                $v['createdate'] = substr($v['createtime'],0,10);
                $v['sales_id'] = $this->sales_id;
                $v['sid'] = $this->sid;
                $allData[$k] = $v;
            }
            if(!empty($allData)){
                Db::name('sales_sell_list')->insertAll($allData);
            }
        }

        //file_put_contents(RUNTIME_PATH . 'allData2_'.time().'.php', var_export($allData2,true));
        if(!empty($allData2)){
            foreach($allData2 as $key=>$val){
                $allData2[$key] = json_encode($val);
            }
            $allData2 = array_unique($allData2);
            //获取所查询的日期已经记录了线上订单
            $order_ids = Db::name('sales_sell_list_online')->where(['sales_id'=>$this->sales_id,'createdate'=>['egt',$startDay]])->getField('order_id',true);
            foreach($allData2 as $k=>$v){
                $v = json_decode($v,true);
                if(!empty($order_ids) && in_array($v['order_id'],$order_ids)){
                    unset($allData2[$k]);
                    continue;
                }

                $newData = [
                    'order_id' => $v['order_id'],
                    'order_sn' => $v['order_sn'],
                    'shop' => $v['shop'],
                    'vip_code' => $v['vip_code'],
                    'bonus_amount' => $v['bonus_amount'],
                    'social_amount' => $v['social_amount'],
                    'cash_amount' => $v['cash_amount'],
                    'pay_time' => $v['pay_time'],
                    'createdate' => substr($v['pay_time'],0,10),
                    'sales_id' => $this->sales_id,
                    'uid' => $v['uid'],
                    'sid' => $this->sid,
                ];

                $allData2[$k] = $newData;
            }
            if(!empty($allData2)){
                Db::name('sales_sell_list_online')->insertAll($allData2);
            }
        }
    }

    /**
     * 获取最近消费记录
     * @param $vipcode
     * @return array|false|\PDOStatement|string|\think\Model
     */
    protected function getLatestCost($member_id){
        $costInfo = [
            ['date'=>'', 'cost'=>'', 'store_code'=>'', 'store_name'=>'']
        ];
        if(!empty($member_id)){
            $k11Model = new k11ApiLogic($this->sid);
            $k11Model->mall_id = $this->mallId;
            $stime =date('Y-m-d H:i:s',strtotime('-30 days'));
            $etime = date('Y-m-d H:i:s');
            $data1 = $k11Model->getKpRecord($member_id,$stime,$etime);
            $data2 = $k11Model->getKpRecord($member_id,$stime,$etime,2);

            $shops = [
                'artstore' => '在线商城',
                'kka' => '学院课程',
                'expo' => '艺术展览',
                'exchange' => '积分商城',
                'kaa' => 'ATELIER'
            ];
            $stores = $this->get_store_code_name();
            if(empty($data1) && empty($data2)){
                //查询30天-180天之间的1条数据
                $stime1 =date('Y-m-d H:i:s',strtotime('-180 days'));
                $etime1 = date('Y-m-d H:i:s',strtotime('-30 days'));
                $data3 = $k11Model->getKpRecord($member_id,$stime1,$etime1);
                if(empty($data3)){
                    $data4 = $k11Model->getKpRecord($member_id,$stime1,$etime1,2);
                    if(!empty($data4)){
                        $costInfo = [
                            [
                                'date'=>substr($data4[0]['pay_time'],0,10),
                                'cost'=>$data4[0]['cash_amount'],
                                'store_code'=>$data4[0]['shop'],
                                'store_name'=>$shops[$data4[0]['shop']]
                            ]
                        ];
                    }
                }else{
                    $costInfo = [
                        [
                            'date'=>substr($data3[0]['createtime'],0,10),
                            'cost'=>$data3[0]['sales_amount'],
                            'store_code'=>$data3[0]['store_code'],
                            'store_name'=>$stores[$data3[0]['store_code']]['store_name']
                        ]
                    ];
                }
            }else{
                $new_data1 = $new_data2 = [];
                if(!empty($data1)){
                    foreach($data1 as $v){
                        array_push($new_data1,[
                            'date'=>substr($v['createtime'],0,10),
                            'cost'=>$v['sales_amount'],
                            'store_code'=>$v['store_code'],
                            'store_name'=>$stores[$v['store_code']]['store_name']
                        ]);
                    }
                }
                if(!empty($data2)){
                    foreach($data2 as $val){
                        array_push($new_data2,[
                            'date'=>substr($val['pay_time'],0,10),
                            'cost'=>$val['cash_amount'],
                            'store_code'=>$val['shop'],
                            'store_name'=>$shops[$val['shop']]
                        ]);
                    }
                }

                $costInfo = empty($new_data2) ? $new_data1 : array_merge($new_data1,$new_data2);

                //对数组进行排序
                if(!empty($costInfo)){
                    $volume = array_column($costInfo,'date');
                    array_multisort($volume, SORT_DESC, $costInfo);
                }
            }
        }
        /*
        $offline_costInfo = Db::name('sales_sell_list')->field('createdate date,sales_amount cost')->where(['uid'=>$uid,'sid'=>$this->sid])->order('createtime desc')->find();
        $online_costInfo = Db::name('sales_sell_list_online')->field('createdate date,cash_amount cost')->where(['uid'=>$uid,'cash_amount'=>['gt',0],'sid'=>$this->sid])->order('id desc')->find();
        if(!empty($offline_costInfo) && !empty($online_costInfo)){
            $costInfo = strtotime($offline_costInfo['date']) > strtotime($online_costInfo['date']) ? $offline_costInfo : $online_costInfo;
        }else{
            $costInfo = empty($offline_costInfo) ? $online_costInfo : $offline_costInfo;
        }*/
        $costInfo = array_values($costInfo);
        return $costInfo;
    }

    /**
     * @return mixed
     */
    protected function get_store_code_name(){
        $stores = S('stores_'.$this->sid);
        if(empty($stores)){
            $stores = Db::name('store')->field('store_code,store_name')->where(['sid'=>$this->sid])->select();
            if(!empty($stores)){
                $stores = convert_arr_key($stores,'store_code');
            }
            S('stores_'.$this->sid , $stores);
        }
        return $stores;
    }

    /**
     * 设置默认值
     * @param $data
     * @return mixed
     */
    protected function setDefaultValue($data){
        if(empty($data) || !is_array($data)){
            return ['register'=>0,'subscribe'=>0];
        }
        $data1 = [];
        foreach($data as $k=>$v){
            $data1[$k] = empty($v) ? 0 : $v;
        }
        return $data1;
    }

    /**
     * ajax返回
     * @param $data
     */
    public function ajaxReturn($data){
        exit(json_encode($data));
    }
}