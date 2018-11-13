<?php
/**
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\admin\controller;

use think\AjaxPage;
use think\Exception;
use think\Page;
use think\Db;

/**
 * 兑换订单
 * Class Orders
 * @package app\admin\controller
 */
class Orders extends Base
{
    /**
     * 兑换型活动订单
     * @return mixed
     */
    public function code_exchange(){
        $admin_id = session('admin_id');
        $role = D('admin')
            ->alias('a')
            ->field('r.aid')
            ->join('ka_admin_role r','a.role_id=r.role_id')
            ->where(['a.admin_id'=>$admin_id])
            ->find();
        if ($role['aid']!=null){
            $aid = explode(',',$role['aid']);
            $data = $this->get_exchange1(1,$aid);
        }else{
            $data = $this->get_exchange();
        }
        $this->assign([
            'lists' => $data['activitys'],
            'pager' => $data['pager'],
            'count' => $data['count']
        ]);
        return $this->fetch();
    }

    /**
     * 发放型活动订单
     */
    public function sales_exchange(){
        $admin_id = session('admin_id');
        $role = D('admin')
            ->alias('a')
            ->field('r.aid')
            ->join('ka_admin_role r','a.role_id=r.role_id')
            ->where(['a.admin_id'=>$admin_id])
            ->find();
        if ($role['aid']!=null){
            $aid = explode(',',$role['aid']);
            $data = $this->get_exchange1(2,$aid);
        }else{
            $data = $this->get_exchange(2);
        }
        $this->assign([
            'lists' => $data['activitys'],
            'pager' => $data['pager'],
            'count' => $data['count']
        ]);
        return $this->fetch();
    }

    /**
     * 获取活动订单概况
     */
    protected function get_exchange($type=1){
        $where = [
            'type'=>$type,
            'sid'=>$this->sid,
            'status'=>['in',[0,1]]
        ];
        $count = Db::name('activity')
            ->where($where)
            ->count('id');
        $activitys = $pager = null;
        if($count){
            $page =  $pager = new Page($count,20);
            //查询活动列表
            $activitys = Db::name('activity')
                ->field('id,name')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order('id desc')
                ->select();
            if($type == 1){
                foreach($activitys as $k=>$v){
                    $list = Db::name('orders')->field('shipping_time')->where(['aid'=>$v['id'],'sid'=>$this->sid])->select();
                    $activitys[$k]['total'] = count($list);
                    if(!empty($list)){
                        $num = 0;
                        foreach($list as $val){
                            if($val['shipping_time'] > 0){
                                ++ $num;
                            }
                        }
                        $activitys[$k]['has_shipping'] = $num;
                    }
                }
            }else{
                foreach($activitys as $k=>$v){
                    $list = Db::name('orders')
                        ->field('shipping_time')
                        ->where(['aid'=>$v['id'],'sid'=>$this->sid])
                        ->select();
                    $activitys[$k]['total'] = count($list);
                    if(!empty($list)){
                        $num = 0;
                        foreach($list as $val){
                            if($val['shipping_time'] > 0){
                                ++ $num;
                            }
                        }
                        $activitys[$k]['has_shipping'] = $num;
                    }
                }
            }
        }

        return [
            'count' => $count,
            'activitys'=> $activitys,
            'pager' => $pager
        ];
    }

    /**
     * 根据活动权限获取活动订单概况
     */
    protected function get_exchange1($type=1,$aid){
        $where = [
            'id'=>['in',$aid],
            'type'=>$type,
            'sid'=>$this->sid,
            'status'=>['in',[0,1]]
        ];
        $count = Db::name('activity')
            ->where($where)
            ->count('id');
        $activitys = $pager = null;
        if($count){
            $page =  $pager = new Page($count,20);
            //查询活动列表
            $activitys = Db::name('activity')
                ->field('id,name')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order('id desc')
                ->select();
            if($type == 1){
                foreach($activitys as $k=>$v){
                    $list = Db::name('orders')->field('shipping_time')->where(['aid'=>$v['id'],'sid'=>$this->sid])->select();
                    $activitys[$k]['total'] = count($list);
                    if(!empty($list)){
                        $num = 0;
                        foreach($list as $val){
                            if($val['shipping_time'] > 0){
                                ++ $num;
                            }
                        }
                        $activitys[$k]['has_shipping'] = $num;
                    }
                }
            }else{
                foreach($activitys as $k=>$v){
                    $list = Db::name('orders')
                        ->field('shipping_time')
                        ->where(['aid'=>$v['id'],'sid'=>$this->sid])
                        ->select();
                    $activitys[$k]['total'] = count($list);
                    if(!empty($list)){
                        $num = 0;
                        foreach($list as $val){
                            if($val['shipping_time'] > 0){
                                ++ $num;
                            }
                        }
                        $activitys[$k]['has_shipping'] = $num;
                    }
                }
            }
        }

        return [
            'count' => $count,
            'activitys'=> $activitys,
            'pager' => $pager
        ];
    }

    /**
     * 活动订单列表
     * @return mixed
     */
    public function order_list()
    {
        $activity_id = input('aid',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }
        //查询活动类型
        $activity_info = Db::name('activity')->field('name,type')->where(['id'=>$activity_id])->find();
        $activity_type = $activity_info['type'];
        $where = ['a.aid'=>$activity_id,'a.sid'=>$this->sid,'a.type'=>$activity_type];

        $count = Db::name('orders')->alias('a')->where($where)->count('a.id');

        // 关键词搜索
        $key_word = I('key_word') ? trim(I('key_word')) : '';
        if($key_word) {
//            $where = "$where and (a.order_sn like '%$key_word%' or b.goods_name like '%$key_word%')" ;
            if ($activity_type==2){
                $where['a.order_sn|b.goods_name|g.name|s.name'] = ['like','%'.$key_word.'%'];
            }
            if ($activity_type==1){
                $where['a.order_sn|b.goods_name'] = ['like','%'.$key_word.'%'];
            }
        }

        if($_GET['export'] == 1){
            if ($activity_type==2){
                $lists = Db::name('orders')
                    ->alias('a')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->join('sales_man s','a.operator_id=s.id')
                    ->join('banks g','s.branch_id=g.id')
                    ->field('a.id,a.order_sn,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,a.type,b.goods_name,s.name as sales_name,g.name as bank_name')
                    ->where($where)
                    ->order(['a.id'=>'desc'])
                    ->select();
            }elseif($activity_type==1){
                $lists = Db::name('orders')
                    ->alias('a')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->field('a.id,a.order_sn,b.goods_id,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,a.type,b.goods_name')
                    ->where($where)
                    ->order(['a.id'=>'desc'])
                    ->select();
            }
//            $lists = Db::name('orders')
//                ->alias('a')
//                ->join('goods b','a.goods_id=b.goods_id')
//                ->join('sales_man s','a.operator_id=s.id')
//                ->join('banks g','s.branch_id=g.id')
////                ->field('a.id,a.order_sn,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,b.goods_name')
//                ->field('a.id,a.order_sn,b.goods_id,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,a.type,b.goods_name,s.name as sales_name,g.name as bank_name')
//                ->where($where)
//                ->order(['a.id'=>'desc'])
//                ->select();

            //导出数字码
            $strTable = '<table width="500" border="1">';
            $strTable .= '<tr>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">订单编号</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品名称</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品型号</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品数量</td>';

            if($activity_type == 2){
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">所属的档次</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行网点</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">客户经理</td>';
            }else{
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">所属的档次</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">使用的兑换码</td>';
            }
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">兑换客户姓名</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">客户身份证号</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">兑换客户电话</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">兑换时间</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">发货时间</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">发货单号</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">收货人</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">联系电话</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">发货物流</td>';
            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">详细地址</td>';

            $a_new_field = Db::name('activity')->where(['id'=>$activity_id])->getField('new_field');
            $a_new_field = json_decode($a_new_field,true);
            if ($a_new_field){
                foreach ($a_new_field as $a=>$n){
                    unset($a_new_field[$a]['remarks']);
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'.$n['title'].'</td>';
                }
            }

            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">备注</td>';

            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">订单状态</td>';

            $strTable .= '</tr>';

            if(!empty($lists)){
                foreach($lists as $v){
                    $shipping_type = empty($v['shipping_time']) ? '未发货' : '已发货';
                    $shipping_time = empty($v['shipping_time']) ? '' : date('Y-m-d H:i:s',$v['shipping_time']);
                    $strTable .= '<tr>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' .$v['order_sn'].'&emsp;'. '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $v['goods_name'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $v['goods_name_en'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $v['goods_num'] . '</td>';

                    if($activity_type == 2){
                        $level = D('activity_goods')
                            ->alias('a')
                            ->field('a.level_id,l.name,l.id')
                            ->join('ka_change_level l','a.level_id=l.id')
                            ->where(['a.aid'=>$activity_id,'a.goods_id'=>$v['goods_id'],'a.sid'=>$this->sid,'status'=>1])
                            ->find();
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $level['name'] .'</td>';
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $v['bank_name'] .'</td>';
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $v['sales_name'] .'</td>';
                    }else{
                        $shop_name = Db::name('shop')->where(['id'=>$this->sid])->getField('name');

                        $code = Db::name('codes')
                            ->alias('c')
                            ->field('c.code,l.name')
                            ->join('ka_change_level l','c.level_id=l.id')
                            ->where(['c.id'=>$v['operator_id']])
                            ->find();
//                        var_dump($code);exit;
//                        $code = Db::name('codes')->where(['id'=>$v['operator_id']])->getField('code');
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">' .$code['name']. '</td>';
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">' .$shop_name. '</td>';
                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">' .$code['code']. '</td>';
                    }
                    $shipping = Db::name('shipping')->where(['id'=>$v['shipping_id']])->find();
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['username'] .'</td>';
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['ID_num'] .'&emsp;'.'</td>';
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['user_phone'] .'&emsp;'.'</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $v['create_time'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $shipping_time . '</td>';
//                    if($v['shipping_time'] != 0){
//                    }else{
//                        $shipping = [];
//                    }
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['shipping_sn'] .'&emsp;'.'</td>';
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['consignee'] .'&emsp;'.'</td>';
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['phone'] .'</td>';

                    $shipping_com = [
                        'STO' => '申通快递',
                        'YTO' => '圆通快递',
                        'ZTO' => '中通快递',
                        'SF' => '顺丰速运',
                        'YD' => '韵达快递',
                        'YZPY' => '邮政快递',
                        'EMS' => 'EMS',
                        'HHTT' => '天天快递',
                        'HTKY' => '百世快递',
                    ];
                    $shi_com = $shipping['shipping_com'];
                    if ($shipping_com[$shi_com]!=''){
                        $shipping['shipping_com'] = $shipping_com[$shi_com];
                    }
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'.$shipping['shipping_com'].'</td>';
//                    if ($shipping['shipping_com'] == ''){
//                        $strTable .= '<td style="text-align:center;font-size:12px;" width="*"></td>';
//                    }
//                    foreach ($shipping_com as $ship=>$com){
//                        if ($shipping['shipping_com']==$ship){
//                            $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping_com[$ship] .'</td>';
//                        }
//                    }
                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['address'] .'</td>';

                    /*------------自定义字段导出开始-------------*/
                    $a_new_field = Db::name('activity')->where(['id'=>$activity_id])->getField('new_field');

                    //判断该字段是否为空
                    if ($a_new_field){
                        if ($shipping['new_field']){
                            $new_field1 = json_decode($shipping['new_field'],true);
                            $a_new_field = json_decode($a_new_field,true);
                            //两个数据做对比,存在即显示
                            foreach ($a_new_field as $a=>$n){
                                unset($a_new_field[$a]['remarks']);
                                foreach ($new_field1 as $ne=>$fi){
                                    if ($a_new_field[$a]['title']==$fi['title']){
                                        $a_new_field[$a]['content'] = $fi['content'];
                                    }
                                    $new_field = $a_new_field;
                                }
                            }
                        }else{
                            $a_new_field = json_decode($a_new_field,true);
                            foreach ($a_new_field as $a=>$n){
                                unset($a_new_field[$a]['remarks']);
                                $a_new_field[$a]['content'] = null;
                                $new_field = $a_new_field;
                            }
                        }
                        foreach ($new_field as $shi_field=>$shi_val){
                            if ($shi_val['content']!=null){
                                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shi_val['content'] .'</td>';
                            }else{
                                $strTable .= '<td style="text-align:center;font-size:12px;" width="*"></td>';
                            }
                        }
                    }
                    /*----------------自定义字段导出结束----------------*/

                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping['remarks'] .'</td>';

                    $strTable .= '<td style="text-align:center;font-size:12px;" width="*">'. $shipping_type .'</td>';

                    $strTable .= '</tr>';
                }
            }

            $strTable .= '</table>';
            downloadExcel($strTable, $activity_info['name'].'活动的订单');
            unset($lists,$strTable);
            exit();
        }

        if($count){
            $page = new Page($count,20);
            if ($activity_type==2){
                $lists = Db::name('orders')
                    ->alias('a')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->join('sales_man s','a.operator_id=s.id')
                    ->join('banks g','s.branch_id=g.id')
                    ->field('a.id,a.order_sn,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,a.type,b.goods_name,s.name as sales_name,g.name as bank_name')
                    ->where($where)
                    ->limit($page->firstRow.','.$page->listRows)
                    ->order(['a.id'=>'desc'])
                    ->select();
            }elseif($activity_type==1){
                $lists = Db::name('orders')
                    ->alias('a')
                    ->join('goods b','a.goods_id=b.goods_id')
                    ->field('a.id,a.order_sn,b.goods_name_en,a.goods_num,a.create_time,a.shipping_time,a.shipping_id,a.operator_id,a.type,b.goods_name')
                    ->where($where)
                    ->limit($page->firstRow.','.$page->listRows)
                    ->order(['a.id'=>'desc'])
                    ->select();
            }

            //查询物流
            foreach($lists as $k=>$v){
                if($v['shipping_id']!==0){
                    $shipping = Db::name('shipping')->where(['id'=>$v['shipping_id']])->find();
                    $lists[$k]['shipping'] = $shipping;
                    $shipping_com = [
                        'STO' => '申通快递',
                        'YTO' => '圆通快递',
                        'ZTO' => '中通快递',
                        'SF' => '顺丰速运',
                        'YD' => '韵达快递',
                        'YZPY' => '邮政快递',
                        'EMS' => 'EMS',
                        'HHTT' => '天天快递',
                        'HTKY' => '百世快递',
                    ];
                    $shi_com = $lists[$k]['shipping']['shipping_com'];
                    if ($shipping_com[$shi_com]!=''){
                        $lists[$k]['shipping']['shipping_com'] = $shipping_com[$shi_com];
                    }

                    /*------------自定义字段订单显示开始-------------*/
                    $a_new_field = Db::name('activity')->where(['id'=>$activity_id])->getField('new_field');
//                    var_dump(json_decode($a_new_field,true));exit;
                    /*----新字段标题----*/
                    $a_field = json_decode($a_new_field,true);
                    if($a_new_field){
                        foreach ($a_field as $a=>$n){
                            unset($a_field[$a]['remarks']);
                            $field_title[$a] = $n['title'];
                        }
                        if ($lists[$k]['shipping']['new_field']){
                            $a_new_field = json_decode($a_new_field,true);
                            $new_field = json_decode($lists[$k]['shipping']['new_field'],true);
                            foreach ($a_new_field as $a=>$n){
                                unset($a_new_field[$a]['remarks']);
                                foreach ($new_field as $ne=>$fi){
                                    if ($a_new_field[$a]['title']==$fi['title']){
                                        $a_new_field[$a]['content'] = $fi['content'];
                                    }
                                }
                                $lists[$k]['shipping']['new_field'] = $a_new_field;
                            }
//                        var_dump($lists[$k]['shipping']['new_field']);exit;
                        }else{
                            $a_new_field = json_decode($a_new_field,true);
                            foreach ($a_new_field as $a=>$n){
                                unset($a_new_field[$a]['remarks']);
                                $a_new_field[$a]['content'] = null;
                                $lists[$k]['shipping']['new_field'] = $a_new_field;
                            }
                        }
                    }else{
                        $field_title = null;
                    }

                    /*------------自定义字段订单显示结束-------------*/

                }
                if ($v['type']==1){
                    $code = Db::name('codes')
                        ->field('code')
                        ->where(['id'=>$v['operator_id']])
                        ->find();
                    $shop = Db::name('shop')
                        ->field('name')
                        ->where(['id'=>$this->sid])
                        ->find();
                    $lists[$k]['shop_name'] = $shop['name'];
                    $lists[$k]['code'] = $code['code'];
                }
//                else{
//                    $sales_name = Db::name('sales_man')->where(['id'=>$v['operator_id']])->getField('name');
//                    $branch_id = Db::name('sales_man')
//                        ->where(['id'=>$v['operator_id']])
//                        ->getField('branch_id');
//                    $bank_name = Db::name('banks')
//                        ->where(['id'=>$branch_id])
//                        ->getField('name');
//                    $lists[$k]['sales_name'] = $sales_name;
//                    $lists[$k]['bank_name'] = $bank_name;
//                }
            }
            $this->assign([
                'lists' => $lists,
                'pager' => $page,
                'field_title' => $field_title
            ]);
        }

        $this->assign([
            'count' => $count,
            'aid' => $activity_id,
            'activity_type' => $activity_type
        ]);
        return $this->fetch();
    }

    /**
     * 订单发货
     */
    public function do_shipping(){
        //查询活动订单
        $order_id = input('oid',0);  //订单id
        if(empty($order_id)){
            exit('参数丢失');
        }

        //查询订单信息
        $info = Db::name('orders')
            ->alias('a')
            ->join('shipping b','a.shipping_id=b.id')
            ->field('b.id shipping_id,b.username,b.phone,b.address,b.consignee')
            ->where(['a.id'=>$order_id])
            ->find();

        $this->assign([
            'info' => $info,
            'oid' => $order_id,
            'shipping_coms' =>[
                'STO' => '申通快递',
                'YTO' => '圆通快递',
                'ZTO' => '中通快递',
                'SF' => '顺丰速运',
                'YD' => '韵达快递',
                'YZPY' => '邮政快递',
                'EMS' => 'EMS',
                'HHTT' => '天天快递',
                'HTKY' => '百世快递',
            ]
        ]);
        return $this->fetch();
    }

    /**
     * 保存发货信息
     */
    public function save_shipping(){
        if(IS_POST && IS_AJAX){
            $data = input('post.');
            $id = $data['shipping_id'];
            $order_id = $data['oid'];

            if($id > 0){
                unset($data['shipping_id'],$data['oid']);
                if ($data['shipping_com'] == "0"){
                    $data['shipping_com'] = $data['shipping_name'];
                }
                $r = Db::name('shipping')->where(['id'=>$id])->save($data);
                if($r !== false){
                    //修改订单状态为 已发货
                    Db::name('orders')->where(['id'=>$order_id])->save(['shipping_time'=>time()]);
                    adminLog('订单【orderid：'.$order_id.'】发货成功');
                    $this->ajaxReturn(['status'=>1,'msg'=>'发货成功']);
                }else{
                    $this->ajaxReturn(['status'=>0,'msg'=>'保存发货信息失败']);
                }
            }else{
                $this->ajaxReturn(['status'=>0,'msg'=>'查询物流信息失败']);
            }
        }else{
            exit('REQUEST ERROR');
        }
    }


    public function check_logistics(){
        //查询活动订单
        $order_id = input('shipping_id',0);  //订单id
        $shipping_info = Db::name('shipping')->where(['id'=>$order_id])->find();
        $logistics_info = getOrderTracesByJson($shipping_info['shipping_com'],$shipping_info['shipping_sn']);
        $log_info = json_decode($logistics_info,true);
        if ($log_info['Success']==true){
            $this->assign([
                'data' => $log_info,
                'shipping' => $shipping_info,
                'shipping_coms' =>[
                    'STO' => '申通快递',
                    'YTO' => '圆通快递',
                    'ZTO' => '中通快递',
                    'SF' => '顺丰速运',
                    'YD' => '韵达快递',
                    'YZPY' => '邮政快递',
                    'EMS' => 'EMS',
                    'HHTT' => '天天快递',
                    'HTKY' => '百世快递',
                ]
            ]);
            return $this->fetch();
        }
    }
}