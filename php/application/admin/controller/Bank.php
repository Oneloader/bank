<?php
/**
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\admin\controller;

use think\AjaxPage;
use think\Page;
use think\Db;

class Bank extends Base
{
    /**
     * 支行列表
     * @return mixed
     */
    public function branch()
    {
        $where = ['sid'=>$this->sid];

        // 关键词搜索
        $key_word = I('key_word') ? trim(I('key_word')) : '';
        if($key_word) {
//            $where = "$where and (a.order_sn like '%$key_word%' or b.goods_name like '%$key_word%')" ;
            $where['name'] = ['like','%'.$key_word.'%'];
        }

        $count = Db::name('banks')->where($where)->count('id');
        if($count){
            $pager = $page = new Page($count,20);
            $lists = Db::name('banks')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order(['id'=>'desc'])
                ->select();
            $this->assign([
                'lists' => $lists,
                'count' => $count,
                'pager' => $pager
            ]);
        }
        return $this->fetch();
    }

    /**
     * 操作支行
     * @return mixed
     */
    public function addEditBranch()
    {
        $id = input('id/d');
        if(IS_POST && IS_AJAX){
            $data = input('post.');
            if(empty($data['name'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'支行名称不能为空']);
            }
            if(!empty($id)){
                unset($data['id']);
                $r = Db::name('banks')->where(['id'=>$id,'sid'=>$this->sid])->save($data);
                $log_msg = '编辑支行【'. $data['name'] .'】成功';
            }else{
                $data['sid'] = $this->sid;
                $r = Db::name('banks')->add($data);
                $log_msg = '添加支行【'. $data['name'] .'】成功';
            }
            if($r !== false){
                adminLog($log_msg);
                $result = ['status'=>1,'msg'=>'操作成功'];
            }else{
                $result = ['status'=>0,'msg'=>'操作失败'];
            }
            $this->ajaxReturn($result);
        }

        if($id){
            $info = model('Banks')->getInfo($id);
            $this->assign('info',$info);
        }
        return $this->fetch('_branch');
    }

    /**
     * 删除支行
     * @throws \think\Exception
     */
    public function branch_del(){
        if(IS_AJAX && IS_POST){
            $id = input('id/d');
            if($id > 0){
                $info = Db::name('banks')->where(['sid'=>$this->sid,'id'=>$id])->find();
                if(empty($info)){
                    $this->ajaxReturn(['status'=>0,'msg'=>'支行不存在']);
                }

                $r = Db::name('banks')->where(['sid'=>$this->sid,'id'=>$id])->delete();
                if($r){
                    adminLog('删除支行成功【'.$info['name'].'】');
                    $return = ['status'=>1,'msg'=>'删除成功'];
                }else{
                    $return = ['status'=>0,'msg'=>'删除失败'];
                }
                $id = $r = $cats = null;
                $this->ajaxReturn($return);
            }
        }
    }

    /**
     * 销售经理列表
     * @return mixed
     */
    public function sales_man()
    {
        $where = ['sid'=>$this->sid];

        // 关键词搜索
        $key_word = I('key_word') ? trim(I('key_word')) : '';
        if($key_word) {
//            $where = "$where and (a.order_sn like '%$key_word%' or b.goods_name like '%$key_word%')" ;
            $where['name'] = ['like','%'.$key_word.'%'];
        }

        $count = Db::name('sales_man')->where($where)->count('id');
        if($count){
            $pager = $page = new Page($count,20);
            $lists = Db::name('sales_man')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order(['id'=>'desc'])
                ->select();

            //查询支行列表
            $branches = model('banks')->getList();
            $this->assign([
                'lists' => $lists,
                'count' => $count,
                'branches' => $branches,
                'pager' => $pager
            ]);
        }
        return $this->fetch();
    }

    /**
     * 操作销售经理
     * @return mixed
     */
    public function addEditSalesMan(){
        $id = input('id/d');
        if(IS_POST && IS_AJAX){
            $data = input('post.');
            if(empty($data['name'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'姓名不能为空']);
            }
            if(empty($data['phone'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'手机号码不能为空']);
            }
            if(!check_mobile($data['phone'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'请输入正确的手机号码']);
            }
            if(empty($data['branch_id'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'请选择所属支行']);
            }

            //验证唯一
            $where = ['sid'=>$this->sid,'phone'=>$data['phone']];
            $check_unique = true;
            if(!empty($id)){
                $phone = Db::name('sales_man')->where(['id'=>$id,'sid'=>$this->sid])->getField('phone');
                if($data['phone'] == $phone){
                    $check_unique = false;
                }
            }
            if($check_unique){
                $count = Db::name('sales_man')->where($where)->count('id');
                if($count){
                    $this->ajaxReturn(['status'=>0,'msg'=>'手机号码已经存在']);
                }
            }

            if(!empty($id)){
                unset($data['id']);
                $r = Db::name('sales_man')->where(['id'=>$id,'sid'=>$this->sid])->save($data);
                $log_msg = '编辑销售经理【'. $data['phone'] .'】成功';
            }else{
                $data['sid'] = $this->sid;

                $r = Db::name('sales_man')->add($data);
                $log_msg = '添加销售经理【'. $data['phone'] .'】成功';
            }
            if($r !== false){
                adminLog($log_msg);
                $result = ['status'=>1,'msg'=>'操作成功'];
            }else{
                $result = ['status'=>0,'msg'=>'操作失败'];
            }
            $this->ajaxReturn($result);
        }

        //查询支行列表
        $branches = model('banks')->getList();

        if($id){
            $info = model('sales_man')->getInfo($id);
            $this->assign('info',$info);
        }

        $this->assign([
            'branches' => $branches
        ]);
        return $this->fetch('_sales_man');
    }

    /**
     * 删除销售经理
     * @throws \think\Exception
     */
    public function sales_man_del(){
        if(IS_AJAX && IS_POST){
            $id = input('id/d');
            if($id > 0){
                $info = Db::name('sales_man')->where(['sid'=>$this->sid,'id'=>$id])->find();
                if(empty($info)){
                    $this->ajaxReturn(['status'=>0,'msg'=>'销售经理不存在']);
                }

                $r = Db::name('sales_man')->where(['sid'=>$this->sid,'id'=>$id])->delete();
                if($r){
                    adminLog('删除支行成功【'.$info['phone'].'】');
                    $return = ['status'=>1,'msg'=>'删除成功'];
                }else{
                    $return = ['status'=>0,'msg'=>'删除失败'];
                }
                $id = $r = $cats = null;
                $this->ajaxReturn($return);
            }
        }
    }

    /**
     * 销售经理列表
     * @return mixed
     */
    public function change_level()
    {
        $activity_id = input('aid/d',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }
        $where = ['aid'=>$activity_id,'sid'=>$this->sid];
        $count = Db::name('change_level')->where($where)->count('id');
        if($count){
            $pager = $page = new Page($count,20);
            $lists = Db::name('change_level')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order(['id'=>'desc'])
                ->select();
            $this->assign([
                'lists' => $lists,
                'count' => $count,
                'pager' => $pager
            ]);
        }

        $this->assign('aid',$activity_id);
        return $this->fetch();
    }

    /**
     * 操作销售经理
     * @return mixed
     */
    public function addEditChangeLevel(){
        $id = input('id/d');
        $aid = input('aid/d');
        if(empty($aid)){
            $this->ajaxReturn(['status'=>0,'msg'=>'参数丢失']);
        }
        if(IS_POST && IS_AJAX){
            $data = input('post.');

            if(empty($data['name'])){
                $this->ajaxReturn(['status'=>0,'msg'=>'等级名称不能为空']);
            }

            if(!empty($id)){
                unset($data['id']);
                $r = Db::name('change_level')->where(['id'=>$id,'sid'=>$this->sid])->save($data);
                $log_msg = '编辑兑换等级【'. $data['name'] .'】成功';
            }else{
                $data['sid'] = $this->sid;

                $r = Db::name('change_level')->add($data);
                $log_msg = '添加兑换等级【'. $data['name'] .'】成功';
            }
            if($r !== false){
                adminLog($log_msg);
                $result = ['status'=>1,'msg'=>'操作成功'];
            }else{
                $result = ['status'=>0,'msg'=>'操作失败'];
            }
            $this->ajaxReturn($result);
        }

        if($id){
            $info = model('change_level')->getInfo($id);
            $this->assign('info',$info);
        }

        $this->assign([
            'aid' => $aid,
        ]);
        return $this->fetch('_change_level');
    }

    /**
     * 删除销售经理
     * @throws \think\Exception
     */
    public function change_level_del(){
        if(IS_AJAX && IS_POST){
            $id = input('id/d');
            if($id > 0){
                $info = Db::name('change_level')->where(['sid'=>$this->sid,'id'=>$id])->find();
                if(empty($info)){
                    $this->ajaxReturn(['status'=>0,'msg'=>'兑换等级不存在']);
                }

                $r = Db::name('change_level')->where(['sid'=>$this->sid,'id'=>$id])->delete();
                if($r){
                    adminLog('删除兑换等级成功【'.$info['name'].'】');
                    $return = ['status'=>1,'msg'=>'删除成功'];
                }else{
                    $return = ['status'=>0,'msg'=>'删除失败'];
                }
                $id = $r = $cats = null;
                $this->ajaxReturn($return);
            }
        }
    }
}












