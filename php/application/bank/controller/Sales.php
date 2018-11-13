<?php
namespace app\bank\controller;
use Api\Controller\MessageController;
use think\Db;
use think\Loader;

/**
 * 银行客服经理兑换
 * Class Sales
 * @package app\bank\controller
 */
class Sales extends Base {

    protected $level_id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取短信验证码
     */
    public function get_message_code(){
        if (checkGet()){
            include('MessageController.class.php');
            session(null);
//            session(array('name'=>'message_code','expire'=>3600));
            $phone = input('get.phone');
//            $phone = '13888888888';
            if (preg_match("/^(13[0-9]|14[5-9]|15[0-3|5-9]|166|17[1-8]|18[0-9]|19[89])\d{8}$/", $phone)){
                $result = Db::name('sales_man')
                    ->where(['phone'=>$phone,'sid'=>$this->sid])
                    ->find();
                if ($result){
                    //本地验证每日短信发送上限
//                $re = $this->check_message_time($phone);
//                if ($re['status'] == 1){

//                    //测试数据验证码
                    $message_code='123456';
                    $expire_time = time()+60;
                    $re = $this->check_message_time($phone,$message_code,$expire_time);
                    if ($re){
                        successReturn($message_code,'发送成功');
                    }else{
                        errorReturn('发送失败');
                    }

                    //对接云片短信验证码
                    //检查发送次数
//                    $message_code = mt_rand(1000,9999);
//                    $code = (time()+60).','.$message_code;
//                    session('message_code',$code);

                    //用存数据库的方式验证验证码,提高安全性
//                    $message_code = mt_rand(1000,9999);
//                    $expire_time = time()+60;
////                    session('message_code',$code);
//                    $re = $this->check_message_time($phone,$message_code,$expire_time);
//                    if ($re){
//                        $msg = "【成都品信致尚】您的验证码是".$message_code;
////                    successReturn($msg,'短信发送成功');
//                        $message = new MessageController();
//                        $re_1 = $message->send($msg,$phone);
//                        if ($re_1['status']==1){
//                            if ($re_1['msg']['code']==0){
//                                successReturn('','短信发送成功');
//                            }else{
//                                errorReturn($re_1['msg']['msg']);
//                            }
//                        }else{
//                            errorReturn($re_1['msg']['msg']);
//                        }
//                    }else{
//                        errorReturn('发送失败,请重试!');
//                    }
//                }else{
//                    errorReturn($re['msg']);
//                }
                }else{
                    errorReturn('您不是该银行的工作人员!');
                }
            }else{
                errorReturn('请输入正确的11位手机号码');
            }
        }
    }

    /**
     * 检查用户短信发送次数,防止短信被盗刷
     */
    public function check_message_time($phone,$message_code,$expire_time){
        $t = time();
        $end_time = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t)); //当天结束时间
//        $end_time = '1537545601'; //当天结束时间
        $check_time = D('message_limit')
            ->field('num,end_time')
            ->where(['phone'=>$phone])
            ->find();
        $map['code'] = $message_code;
        $map['expire_time'] = $expire_time;
        if (!empty($check_time)){
            $result = Db::name('message_limit')
                ->where(['phone'=>$phone])
                ->save($map);
            if ($result){
                return true;
            }else{
                return false;
            }
//            if ($end_time == $check_time['end_time']){
//                if (time()<=$check_time['end_time']){
//                    if ($check_time['num']>=10){
//                        return array('status'=>0,'msg'=>'每日发送短信已达上限!');
//                    }else{
//                        $map['num'] = $check_time['num']+1;
//                        $map['date'] = time();
//                        $time = D('message_limit')
//                            ->where(['phone'=>$phone])
//                            ->save($map);
//                        if ($time){
//                            return array('status'=>1,'msg'=>'短信已发送!');
//                        }else{
//                            return array('status'=>0,'msg'=>'短信发送失败!');
//                        }
//                    }
//                }else{
//                    $map['num'] = 0;
//                    $map['date'] = time();
//                    $map['end_time'] = $end_time;
//                    $time = D('message_limit')
//                        ->where(['phone'=>$phone])
//                        ->save($map);
//                    if ($time){
//                        return array('status'=>1,'msg'=>'短信已发送!');
//                    }else{
//                        return array('status'=>0,'msg'=>'短信发送失败!');
//                    }
//                }
//            }else{
//                $map['num'] = 1;
//                $map['date'] = time();
//                $map['end_time'] = $end_time;
//                $time = D('message_limit')
//                    ->where(['phone'=>$phone])
//                    ->save($map);
//                if ($time){
//                    return array('status'=>1,'msg'=>'短信已发送!');
//                }else{
//                    return array('status'=>0,'msg'=>'短信发送失败!');
//                }
//            }
        }else{
            $map['num'] = 1;
            $map['date'] = time();
            $map['phone'] = $phone;
            $map['end_time'] = $end_time;
            $time = D('message_limit')
                ->add($map);
            if ($time){
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * 银行客服经理登陆页
     */
    public function login(){
        if (IS_POST){
            session('sales_id',null);
            session('bank_id',null);
            $phone = input('phone/s','');
            $code = input('code/s','');

            $check_code = Db::name('message_limit')
                ->where(['phone'=>$phone])
                ->find();
            $validate_code = $check_code['code'];
            $code_time = $check_code['expire_time'];
//            $validate_code = session('message_code');
//            $code_time = explode(',',$validate_code);
            if ($code_time<time()){
                errorReturn('验证码已过期,请重新发送');
            }
            if ($code == $validate_code){
                $result = Db::name('sales_man')
                    ->where(['phone'=>$phone,'sid'=>$this->sid])
                    ->find();
                if ($result){
                    session('is_login',(time()+1200).','.$result['id']);
                    session('sales_id',$result['id']);
                    session('bank_id',$result['branch_id']);
                    $activityUrl = SITE_URL . url('Bank/sales/index',['sid'=>base64_encode($this->sid)]);
                    successReturn($activityUrl,'登陆成功');
                }else{
                    errorReturn('登陆失败');
                }
            }else{
                errorReturn('验证码错误');
            }
        }else{
            $bank = Db::name('shop')
                ->where(['id'=>$this->sid])
                ->find();
            $this->assign([
                'bank'=>$bank,
                'sid'=>base64_encode($this->sid),
            ]);
            return $this->fetch();
        }
    }

    /**
     * 银行客服经理退出登陆功能
     */
    public function logout(){
        session('sales_id',null);
        $activityUrl = SITE_URL . url('Bank/sales/index',['sid'=>base64_encode($this->sid)]);
//        $this->redirect($activityUrl);
        successReturn($activityUrl,'注销成功');
    }

    /**
     * 银行客服经理首页
     */
    public function index(){
        session('is_leader',null);
        $sales_id = session('sales_id');
        $from = Db::name('sales_man')
            ->where(['id'=>$sales_id])
            ->find();
        $shop_nav_color = Db::name('shop')
            ->field('nav_color')
            ->where(['id'=>$this->sid])
            ->find();
        session('nav_color',$shop_nav_color['nav_color']);
        $nav_color = session('nav_color');
        if ($this->check_login()){
            if (empty($sales_id)){
                $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
            }else{
                if ($from['sid']==$this->sid){
                    $sales = Db::name('sales_man')
                        ->field('name,branch_id')
                        ->where(['id'=>$sales_id])
                        ->find();
                    $bank = Db::name('banks')
                        ->field('name')
                        ->where(['id'=>$sales['branch_id']])
                        ->find();
                    $activity_auth = D('activity_auth')
                        ->alias('a')
                        ->field('a.aid,a.is_leader,c.id,c.name,c.img,c.back_img,c.end_time')
                        ->join('ka_activity c','a.aid=c.id')
                        ->where(['a.sales_id'=>$sales_id,'a.sid'=>$this->sid,'c.sid'=>$this->sid,'c.status'=>1,'c.type'=>2,'c.end_time'=>['>',time()]])
                        ->select();
                    foreach ($activity_auth as $key=>$val){
                        $activity_auth[$key]['end_time'] = date('Y-m-d',$val['end_time']);
                    }
//                    $shop_id = session('shop_id');
//                    var_dump($shop_id);exit;
                    $sign_url = Db::name('shop')
                        ->field('sign')
                        ->where(['id'=>$this->sid])
                        ->find();
                    $sign = $sign_url['sign'];
                    $this->assign([
                        'sales'=>$sales,
                        'bank'=>$bank,
                        'nav_color'=>$nav_color,
                        'sign'=>$sign,
                        'data'=>$activity_auth,
                        'sid' =>base64_encode($this->sid),
                    ]);
                    return $this->fetch();
                }else{
                    $this->error('此页面暂无法访问!!!');
                }
            }
        }
    }

    /**
     *
     */
    public function manager(){
        if (!$this->check_login()){
            $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
        }

        $sales_id = session('sales_id');
        $bank_id = session('bank_id');

        $activity_id = input('aid');
        session('activity_id',$activity_id);

        if (empty($sales_id)){
            $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
        }

        $is_leader = Db::name('activity_auth')
            ->field('is_leader')
            ->where(['aid'=>$activity_id,'sales_id'=>$sales_id])
            ->find();
        $leader = $is_leader['is_leader'];
        session('is_leader',$leader);

        $activity = Db::name('activity')
            ->field('is_level,name')
            ->where(['id' => $activity_id])
            ->find();

        $level = Db::name('change_level')
            ->field('id,name')
            ->where(['aid' => $activity_id, 'sid' => $this->sid])
            ->select();

        $sign_url = Db::name('shop')
            ->field('sign')
            ->where(['id'=>$this->sid])
            ->find();

        $sales_info = Db::name('sales_man')
            ->where(['id' => $sales_id, 'sid' => $this->sid])
            ->find();
        if (empty($sales_info)){
            $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
        }

        $banks = Db::name('banks')
            ->field('id,name')
            ->where(['id' => $sales_info['branch_id']])
            ->find();

        if ($leader == '1') {
            $sales = Db::name('sales_man')
                ->alias('b')
                ->field('b.id,b.name')
                ->join('activity_auth a','b.id=a.sales_id')
                ->where(['b.branch_id'=>$bank_id,'a.aid' => $activity_id])
                ->select();

            $goods_order = [];
            $total_order_count = 0;
            foreach ($sales as $key => $val) {
                //查询当前销售经理销售情况
                $orders = Db::name('orders')
                    ->alias('a')
                    ->field('a.goods_id,count(a.id) order_sum,sum(a.goods_num) goods_sum,b.goods_name,b.original_img')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->where(['a.operator_id'=>$val['id'],'a.aid'=>$activity_id,'a.type'=>2,'a.sid'=>$this->sid])
                    ->group('a.goods_id')
                    ->select();
                if(!empty($orders)){
                    $all_sum = array_sum(array_column($orders,'order_sum'));

                    //统计当前支行总订单记录
                    foreach($orders as $k=>$v){
                        if(array_key_exists($v['goods_id'],$goods_order)){
                            $goods_order[$v['goods_id']]['order_sum'] += $v['order_sum'];
                            $goods_order[$v['goods_id']]['goods_sum'] += $v['goods_sum'];
                        }else{
                            $goods_order[$v['goods_id']] = $v;
                            $goods_order[$v['goods_id']] = $v;
                        }
                    }
                }else{
                    $all_sum = 0;
                }

                $total_order_count += $all_sum;
                $sales[$key]['count'] = $all_sum;
                $sales[$key]['orders'] = $orders;
            }

            $bank_order['count'] = $total_order_count;
            $bank_order['goods_order'] = $goods_order;

            $this->assign('bank_order' , $bank_order);
        } else {
            //组装sales数据
            $sales = [];
            array_push($sales,$sales_info);

            //查询订单数据
            foreach ($sales as $key => $val) {
                //查询当前销售经理销售情况
                $orders = Db::name('orders')
                    ->alias('a')
                    ->field('a.goods_id,count(a.id) order_sum,sum(a.goods_num) goods_sum,b.goods_name,b.original_img')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->where(['a.operator_id'=>$val['id'],'a.aid'=>$activity_id,'a.type'=>2,'a.sid'=>$this->sid])
                    ->group('a.goods_id')
                    ->select();
                if(!empty($orders)){
                    $all_sum = array_sum(array_column($orders,'order_sum'));
                }else{
                    $all_sum = 0;
                }

                $sales[$key]['count'] = $all_sum;
                $sales[$key]['orders'] = $orders;
            }
        }

        $sign = $sign_url['sign'];
        $sales_info['bank_name'] .= $banks['name'];
        $sales_info['activity'] .= $activity['name'];
        $nav_color = session('nav_color');

        $this->assign([
            'data' => $sales,
            'sales_info' => $sales_info,
            'is_level' => $activity['is_level'],
            'level' => $level,
            'nav_color' => $nav_color,
            'sign' => $sign,
            'sales_id' => $sales_info['id'],
            'is_leader' => $leader,
            'aid' => $activity_id,
            'sid' => base64_encode($this->sid),
        ]);
        return $this->fetch();
    }

    public function select_leader($sales_id,$activity_id){
        /*---------根据当前管理员id查询该支行下所有订单--------*/
        $bank_id = session('bank_id');
        $banks = Db::name('sales_man')
            ->alias('s')
            ->join('activity_auth a','s.id=a.sales_id')
            ->join('banks b','b.id=s.branch_id')
            ->where(['s.branch_id'=>$bank_id,'a.aid' => $activity_id,'s.id' => $sales_id])
            ->find();

        $banks['count'] = Db::name('sales_man')
            ->alias('s')
            ->join('orders o','o.operator_id=s.id')
            ->where(['s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$activity_id])
            ->count();

        $banks['goods_order'] = Db::name('goods')
            ->alias('g')
            ->group('goods_id')
            ->field('o.id,g.goods_id,g.goods_name,g.original_img')
            ->join('ka_orders o','o.goods_id=g.goods_id')
            ->where(['o.aid'=>$activity_id,'o.type'=>2])
            ->select();
//        var_dump($banks);exit;
//        $banks['goods_order'] = array_unique($banks['goods_order']);

        foreach ($banks['goods_order'] as $key=>$value){
            $banks['goods_order'][$key]['goods_total'] = Db::name('sales_man')
                ->alias('s')
                ->join('orders o','o.operator_id=s.id')
                ->where(['s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$activity_id,'o.goods_id'=>$value['goods_id'], 'o.type' => 2])
                ->count();
            $goods_num = Db::name('sales_man')
                ->alias('s')
                ->join('orders o','o.operator_id=s.id')
                ->where(['s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$activity_id,'o.goods_id'=>$value['goods_id'], 'o.type' => 2])
                ->sum('goods_num');
            if ($goods_num==null){
                $banks['goods_order'][$key]['goods_num'] = 0;
            }else{
                $banks['goods_order'][$key]['goods_num'] = $goods_num;
            }
        }
        return $banks;
    }


    public function order_list(){
        if ($this->check_login()){
            $is_leader = session('is_leader');
            $aid = session('activity_id');
            $bank_id = session('bank_id');
            $good_id = input('get.good_id');
            $all_order = input('get.all_order');

            if (input('get.sales_id')){
                $sales_id = input('get.sales_id');
            }elseif (empty(input('get.sales_id'))){
                $sales_id = session('sales_id');
            }

            if (empty($sales_id)){
                session('sales_id',null);
                $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
            }else {
                /*----------根据销售id/商品id获取该销售与该商品的详细订单---------*/
                /**
                 * 查看订单列表:
                 * 1.不是管理员直接进入订单列表(查询的是该登陆销售下的所有订单)
                 * 2.是管理员直接进入订单列表(查询的是该银行网点下的所有订单)
                 * 3.点击银行下某商品进入订单列表(查询的是该银行网点下该商品的所有订单)
                 * 4.管理员点击该网点下某销售的订单进入订单列表(查询的是该销售下该商品的所有订单)
                 */
                if ($is_leader == 1){
                    if (input('get.sales_id')){
                        if (empty($good_id)) {
                            $goods_order = Db::name('orders')
                                ->alias('o')
                                ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                                ->join('ka_shipping s', 'o.shipping_id=s.id')
                                ->join('ka_goods go', 'o.goods_id=go.goods_id')
                                ->order('time', 'desc')
                                ->where(['o.sid' => $this->sid, 'o.aid' => $aid])
                                ->select();
                        } else {
                            if ($all_order==1){
                                $test = Db::name('sales_man')
                                    ->alias('s')
                                    ->field('o.id')
                                    ->join('orders o','o.operator_id=s.id')
                                    ->order('id', 'desc')
                                    ->where(['s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$aid])
                                    ->select();
                                foreach ($test as $key=>$value){
                                    $goods_order[$key] = Db::name('orders')
                                        ->alias('o')
                                        ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                                        ->join('ka_shipping s', 'o.shipping_id=s.id')
                                        ->join('ka_goods go', 'o.goods_id=go.goods_id')
                                        ->order('time', 'desc')
                                        ->where(['o.id'=>$value['id'],'o.goods_id' => $good_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
                                        ->find();
                                }
                                $goods_order = array_filter($goods_order);
//                                $goods_order = Db::name('orders')
//                                    ->alias('o')
//                                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
//                                    ->join('ka_shipping s', 'o.shipping_id=s.id')
//                                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
//                                    ->order('time', 'desc')
//                                    ->where(['o.goods_id' => $good_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
//                                    ->select();
                            }else{
                                $goods_order = Db::name('orders')
                                    ->alias('o')
                                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                                    ->join('ka_shipping s', 'o.shipping_id=s.id')
                                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
                                    ->order('time', 'desc')
                                    ->where(['o.operator_id' => $sales_id,'o.goods_id' => $good_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
                                    ->select();
//                            $test = Db::name('orders')->where(['goods_id' => $good_id])->select();
                            }
                        }
                    }else{
                        if ($good_id){
                            $test = Db::name('sales_man')
                                ->alias('s')
                                ->field('o.id')
                                ->join('orders o','o.operator_id=s.id')
                                ->order('id', 'desc')
                                ->where(['o.goods_id'=>$good_id,'s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$aid])
                                ->select();
                            foreach ($test as $key=>$value) {
                                $goods_order[$key] = Db::name('orders')
                                    ->alias('o')
                                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                                    ->join('ka_shipping s', 'o.shipping_id=s.id')
                                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
                                    ->order('time', 'desc')
                                    ->where(['o.id'=>$value['id'],'o.goods_id' => $good_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
                                    ->find();
                            }
                        }else{
                            $test = Db::name('sales_man')
                                ->alias('s')
                                ->field('o.id')
                                ->join('orders o','o.operator_id=s.id')
                                ->order('id', 'desc')
                                ->where(['s.branch_id'=>$bank_id,'s.sid'=>$this->sid,'o.aid'=>$aid])
                                ->select();
                            foreach ($test as $key=>$value){
                                $goods_order[$key] = Db::name('orders')
                                    ->alias('o')
                                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                                    ->join('ka_shipping s', 'o.shipping_id=s.id')
                                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
                                    ->order('time', 'desc')
                                    ->where(['o.id'=>$value['id'],'o.sid' => $this->sid, 'o.aid' => $aid])
                                    ->find();
                            }
                        }
                    }
                }else{
                    if (!empty($good_id)){
                        $goods_order = Db::name('orders')
                            ->alias('o')
                            ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                            ->join('ka_shipping s', 'o.shipping_id=s.id')
                            ->join('ka_goods go', 'o.goods_id=go.goods_id')
                            ->order('time', 'desc')
                            ->where(['o.operator_id' => $sales_id, 'o.sid' => $this->sid, 'o.aid' => $aid,'o.goods_id'=>$good_id])
                            ->select();
                    }else{
                        $goods_order = Db::name('orders')
                            ->alias('o')
                            ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.shipping_time,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
                            ->join('ka_shipping s', 'o.shipping_id=s.id')
                            ->join('ka_goods go', 'o.goods_id=go.goods_id')
                            ->order('time', 'desc')
                            ->where(['o.operator_id' => $sales_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
                            ->select();
                    }
                }
//            if (empty($good_id)) {
//                $goods_order = Db::name('orders')
//                    ->alias('o')
//                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
//                    ->join('ka_shipping s', 'o.shipping_id=s.id')
//                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
//                    ->order('time', 'desc')
//                    ->where(['o.operator_id' => $sales_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
//                    ->select();
//            } else {
//                $goods_order = Db::name('orders')
//                    ->alias('o')
//                    ->field('o.id,o.order_sn,o.goods_num,o.create_time,o.shipping_id,o.goods_id,o.operator_id,s.username,s.phone,s.address,s.consignee,go.goods_name,go.original_img')
//                    ->join('ka_shipping s', 'o.shipping_id=s.id')
//                    ->join('ka_goods go', 'o.goods_id=go.goods_id')
//                    ->order('time', 'desc')
//                    ->where(['o.goods_id' => $good_id, 'o.operator_id' => $sales_id, 'o.sid' => $this->sid, 'o.aid' => $aid])
//                    ->select();
//            }

                $sales = session('sales_id');
                if(!empty($goods_order)){
                    foreach ($goods_order as $key => $value) {
                        $sales_info = Db::name('sales_man')
                            ->field('name,branch_id')
                            ->where(['id' => $value['operator_id'], 'sid' => $this->sid])
                            ->find();
                        $banks = Db::name('banks')
                            ->field('name')
                            ->where(['id' => $sales_info['branch_id'], 'sid' => $this->sid])
                            ->find();
                        $sales_info['bank_name'] = $banks['name'];
                        $goods_order[$key] = array_merge_recursive($goods_order[$key], $sales_info);
                        $is_leaders = Db::name('activity_auth')
                            ->field('is_leader')
                            ->where(['aid' => $aid, 'sid' => $this->sid, 'sales_id' => $sales])
                            ->find();
            //          $goods_order[$key]['is_leader'] = $is_leaders['is_leader'];
                    }
                }

                $sales_info = Db::name('sales_man')
                    ->where(['id' => $sales, 'sid' => $this->sid])
                    ->find();
                $banks_name = Db::name('banks')
                    ->field('name')
                    ->where(['id' => $sales_info['branch_id']])
                    ->find();
                $activity = Db::name('activity')
                    ->field('is_level,name')
                    ->where(['id' => $aid])
                    ->find();
                $level = Db::name('change_level')
                    ->field('id,name')
                    ->where(['aid' => $aid, 'sid' => $this->sid])
                    ->select();

                $sales_info['bank_name'] .= $banks_name['name'];
                $sales_info['activity'] .= $activity['name'];

                $sign_url = Db::name('shop')
                    ->field('sign')
                    ->where(['id'=>$this->sid])
                    ->find();
                $sign = $sign_url['sign'];
                $nav_color = session('nav_color');

                $this->assign([
                    'sid' => base64_encode($this->sid),
                    'aid' => $aid,
                    'sign' => $sign,
                    'nav_color' => $nav_color,
                    'is_level' => $activity['is_level'],
                    'level' => $level,
                    'sales_info' => $sales_info,
                    'data' => $goods_order,
                ]);
                return $this->fetch();
            }
        }
    }

    /**
     *  获取商品列表
     */
    public function goodsList(){
        if ($this->check_login()) {
            if (IS_GET) {
                $aid = input('aid');
                $level_id = input('level_id');
                session('level_id', $level_id);
                $this->level_id = $level_id;
                $activity = D('activity')
                    ->field('name,back_img,back_color,is_price,is_stock,status')
                    ->where(['id' => $aid])
                    ->find();
                if ($activity['status'] !== 1) {
                    errorReturn('该活动暂未开放!!!');
                }
                if (!empty($level_id)){
                    $where = ['a.aid' => $aid, 'a.sid' => $this->sid, 'a.level_id' => $level_id, 'a.status' => 1, 'a.store' => ['>', 0]];
                }else{
                    $where = ['a.aid' => $aid, 'a.sid' => $this->sid, 'a.status' => 1, 'a.store' => ['>', 0]];
                }
                if ($activity['is_price'] == 1) {
                    $activity_goods = D('activity_goods')
                        ->alias('a')
                        ->field('b.goods_id,b.goods_name,b.goods_name_en,b.goods_price,b.original_img,a.store')
                        ->join('ka_goods b', 'a.goods_id=b.goods_id', 'LEFT')
                        ->where($where)
                        ->select();
                } else {
                    $activity_goods = D('activity_goods')
                        ->alias('a')
                        ->field('b.goods_id,b.goods_name,b.goods_name_en,b.original_img,a.store')
                        ->join('ka_goods b', 'a.goods_id=b.goods_id', 'LEFT')
                        ->where($where)
                        ->select();
                }
                foreach ($activity_goods as $key => $val) {
                    $activity_goods[$key]['url'] = SITE_URL . url('Bank/Sales/goods_info', ['sid' => base64_encode($this->sid), 'aid' => base64_encode($aid), 'good_id' => $val['goods_id']]);
                }
                $this->assign([
                    'list' => $activity_goods,
                    'data' => $activity,
                    'aid' => $aid,
                ]);
                return $this->fetch();
            }
        }
    }


    /**
     * 获取商品详情
     */
    public function goods_info(){
        if ($this->check_login()) {
            if (IS_GET) {
                $aid = session('activity_id');
                $goods_id = input('get.good_id', '', 'int');
                $good_info = Db::name('goods')
                    ->where(['goods_id' => $goods_id])
                    ->find();
                $good_info['url'] = SITE_URL . url('Bank/Sales/order_details', ['sid' => base64_encode($this->sid), 'aid' => base64_encode($aid), 'good_id' => $good_info['goods_id']]);
                $activity = D('activity')
                    ->field('name,back_img,back_color')
                    ->where(['id' => $aid])
                    ->find();
                $this->assign([
                    'info' => $good_info,
                    'data' => $activity,
                ]);
                return $this->fetch();
            }
        }
    }


    /**
     * 获取订单详情
     */
    public function order_details(){
        if ($this->check_login()) {
            if (IS_GET) {
                $aid = session('activity_id');
                $good_id = input('get.good_id');
                $good_info = Db::name('goods')
                    ->where(['goods_id' => $good_id])
                    ->find();
                $goods_total = Db::name('activity_goods')
                    ->where(['goods_id' => $good_id, 'aid' => $aid, 'status' => 1, 'sid' => $this->sid])
                    ->find();
                $order_type = Db::name('activity')
                    ->field('type,name,back_img,back_color,choice_num,must_name_id,must_user_phone,id_length,new_field')
                    ->where(['id' => $aid])
                    ->find();
                if (!empty($order_type['new_field'])){
                    $new_field = json_decode($order_type['new_field'],true);
                }
                $shop_color = Db::name('shop')->where(['id'=>$this->sid])->getField('nav_color');
                $this->assign([
                    'aid' => base64_encode($aid),
                    'activity_id' => $aid,
                    'level_id' => session('level_id'),
                    'sid' => base64_encode($this->sid),
                    'shop_color' => $shop_color,
                    'info' => $good_info,
                    'total' => $goods_total,
                    'type' => $order_type['type'],
                    'data' => $order_type,
                    'new_field' => $new_field
                ]);
                return $this->fetch();
            } elseif (IS_POST) {
                $aid = session('activity_id');
                $level_id = session('level_id');
                $data = input('post.');
//                var_dump($data);exit;
//                $json = json_decode($data['jsonStr'],true);
                if ($data['new_field']) {
                    $fields = array_values($data['new_field']);
                    foreach ($fields as $f_k=>$f_v){
                        if ($f_v['content']==''){
                            ajaxReturn(['status'=>0,'msg'=>$f_v['title'].'不能为空!','title'=>$f_v['title']]);
                        }else{
                            $data['new_field'] = json_encode($fields);
                        }
                    }
                }
//                var_dump(json_decode($data['jsonStr'],true));exit;
                $must_name_id = input('post.must_name_id');
                $must_user_phone = input('post.must_user_phone');
                if($must_user_phone == 1 && $must_name_id == 1){
                    $validate = Loader::validate('OrderUserPhone');
                    if (!$validate->batch()->check($data)) {
                        $error = $validate->getError();
                        $error_msg = array_values($error);
                        $return_arr = array(
                            'status' => 0,
                            'msg' => $error_msg,
                            'data' => $error,
                        );
                        $this->ajaxReturn($return_arr);
                    }
                }elseif ($must_name_id == 1 && $must_user_phone == 0){
                    $validate = Loader::validate('Order');
                    if (!$validate->batch()->check($data)) {
                        $error = $validate->getError();
                        $error_msg = array_values($error);
                        $return_arr = array(
                            'status' => 0,
                            'msg' => $error_msg,
                            'data' => $error,
                        );
                        $this->ajaxReturn($return_arr);
                    }
                }elseif ($must_user_phone == 1 && $must_name_id == 0){
                    $validate = Loader::validate('OrderUserPhone1');
                    if (!$validate->batch()->check($data)) {
                        $error = $validate->getError();
                        $error_msg = array_values($error);
                        $return_arr = array(
                            'status' => 0,
                            'msg' => $error_msg,
                            'data' => $error,
                        );
                        $this->ajaxReturn($return_arr);
                    }
                }else{
                    $validate1 = Loader::validate('Order1');
                    if (!$validate1->batch()->check($data)) {
                        $error = $validate1->getError();
                        $error_msg = array_values($error);
                        $return_arr = array(
                            'status' => 0,
                            'msg' => $error_msg,
                            'data' => $error,
                        );
                        $this->ajaxReturn($return_arr);
                    }
                }
                $customer = input('post.customer', '', 'string');
                $ID_num = input('post.ID_num', '', 'string');
                $user_phone = input('post.user_phone', '', 'string');
                $consignee = input('post.consignee', '', 'string');
                $phone = input('post.phone', '', 'string');
                $address = input('post.address', '', 'string');
                $good_id = input('post.good_id', '', 'int');
                $type = input('post.type', '', 'int');
                $order_sn = date('YmdHis', time()) . rand(1000, 9999);
                $shop_num = input('post.shop_num', '', 'string');
                /*省*/
                $province = input('post.province', '', 'string');
                /*市*/
                $city = input('post.city', '', 'string');
                /*县*/
                $district = input('post.district', '', 'string');
                $remarks = input('post.remarks', '', 'string');
                $new_field = $data['new_field'];
                $goods_is_null = Db::name('activity_goods')
                    ->where(['aid' => $aid, 'sid' => $this->sid, 'level_id' => $level_id, 'status' => 1, 'goods_id' => $good_id, 'store' => ['>', '0']])
                    ->find();
                if (!$goods_is_null) {
                    errorReturn('暂无库存,请另选商品');
                }
                if ($type == 1) {
                    $code = session('code');
                    $code_id = D('codes')
                        ->field('id')
                        ->where(['code' => $code])
                        ->find();
                } elseif ($type == 2) {
                    $code_id['id'] = session('sales_id');
                }
                $shipping_data = array(
                    'username' => $customer,
                    'phone' => $phone,
                    'address' => $province . "/" . $city . "/" . $district . "/" . $address,
                    'ID_num' => $ID_num,
                    'consignee' => $consignee,
                    'user_phone' => $user_phone,
                    'remarks' => $remarks,
                    'new_field' => $new_field,
                );
                $shipping = D('shipping')->add($shipping_data);
                if ($shipping) {
                    $order_data = array(
                        'order_sn' => $order_sn,
                        'goods_id' => $good_id,
                        'goods_num' => $shop_num,
                        'aid' => $aid,
                        'create_time' => date('Y-m-d H:i:s', time()),
                        'time' => time(),
                        'type' => $type,
                        'operator_id' => $code_id['id'],
                        'sid' => $this->sid,
                        'shipping_id' => $shipping,
                    );
                    $orders = D('orders')->add($order_data);
                    if ($orders) {
                        D('codes')
                            ->where(['id' => $code_id['id']])
                            ->save(['use_status' => 1, 'use_orderid' => $orders, 'use_time' => date('Y-m-d H:i:s', time())]);
                        D('activity_goods')
                            ->where(['aid' => $aid, 'sid' => $this->sid, 'level_id' => $level_id, 'status' => 1, 'goods_id' => $good_id])
                            ->setDec('store', $shop_num);
                        $url = SITE_URL . url('Bank/Sales/index', ['sid' => base64_encode($this->sid)]);
                        successReturn($url, '兑换成功');
                    }
                }
            }
        }
    }

    /**
     * 查询物流信息
     */
    public function logistics(){
        if ($this->check_login()) {
            if (IS_GET) {
                //查询活动订单
                $order_id = input('shipping_id', 0);  //订单id
                if ($order_id) {
                    $shipping_info = Db::name('shipping')->where(['id' => $order_id])->find();
                    $logistics_info = getOrderTracesByJson($shipping_info['shipping_com'], $shipping_info['shipping_sn']);
                    $log_info = json_decode($logistics_info, true);

                    $sales_id = session('sales_id');
                    $aid = session('activity_id');
                    $sales_info = Db::name('sales_man')
                        ->where(['id' => $sales_id, 'sid' => $this->sid])
                        ->find();
                    $banks_name = Db::name('banks')
                        ->field('name')
                        ->where(['id' => $sales_info['branch_id']])
                        ->find();
                    $activity = Db::name('activity')
                        ->field('is_level,name')
                        ->where(['id' => $aid])
                        ->find();
                    $sales_info['bank_name'] .= $banks_name['name'];
                    $sales_info['activity'] .= $activity['name'];

                    if ($log_info['Success'] == true) {
                        $this->assign([
                            'data' => $log_info,
                            'shipping' => $shipping_info,
                            'sales_info' => $sales_info,
                            'shipping_coms' => [
                                'STO' => '申通快递',
                                'YTO' => '圆通快递',
                                'ZTO' => '中通快递',
                                'SF' => '顺丰速运',
                                'YD' => '韵达快递',
                                'YZPY' => '邮政快递包裹',
                                'EMS' => 'EMS',
                                'HHTT' => '天天快递',
                                'HTKY' => '百世快递',
                            ]
                        ]);
                        return $this->fetch();
                    }
                } else {
                    errorReturn('暂未发货');
                }
            } else {
                errorReturn('非法请求');
            }
        }
    }

    /**
     * 检查登陆状态
     */
    protected function check_login(){
        $is_login = session('is_login');
        $login_type = explode(',',$is_login);
        if ($login_type[0]<time()){
            $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
        }else{
            return true;
        }
//        if (is_null($is_login)){
//            $this->redirect(url('Bank/sales/login',['sid'=>base64_encode($this->sid)]));
//        }else{
//            return true;
//        }
    }

}