<?php
/**
 * K11APP
 *
 *
 *
 *
 *
 *
 *
 *
 * Author: QP
 * Date: 2017-09-21
 */

namespace app\admin\controller;
use think\Page;
use think\Db;
use think\Url;
use think\Validate;

class Ad extends Base{
    public function ad(){
        $act = I('get.act','add');
        $ad_id = I('get.ad_id/d');
        $ad_info = array();
        if($ad_id){
            $ad_info = D('ad')->where(array('ad_id'=>$ad_id,'sid'=>$this->sid))->find();
            $ad_info['start_time'] = date('Y-m-d',$ad_info['start_time']);
            $ad_info['end_time'] = date('Y-m-d',$ad_info['end_time']);            
        }
        if($act == 'add')          
           $ad_info['pid'] = $this->request->param('pid');
        $position = D('ad_position')->where(1)->select();
        $this->assign('info',$ad_info);
        $this->assign('act',$act);
        $this->assign('position',$position);
        return $this->fetch();
    }
    
    public function adList(){
        delFile(RUNTIME_PATH.'html'); // 先清除缓存, 否则不好预览
        $Ad =  M('ad');
        $pid = I('pid',0);
        if($pid){
            $where['pid'] = $pid;
        	$this->assign('pid',I('pid'));
        }
        $keywords = I('keywords/s',false,'trim');
        if($keywords){
            $where['ad_name'] = array('like','%'.$keywords.'%');
        }
        $where['sid'] = $this->sid;
        $count = $Ad->where($where)->count();// 查询满足要求的总记录数
        $Page = $pager = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $res = $Ad->where($where)->order('pid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $list = array();
        if($res){
        	$media = array('图片','flash');
        	foreach ($res as $val){
        		$val['media_type'] = $media[$val['media_type']];        		
        		$list[] = $val;
        	}
        }

        $ad_position_list = M('AdPosition')->where(1)->getField("position_id,position_name,is_open");
        $this->assign('ad_position_list',$ad_position_list);//广告位 
        $show = $Page->show();// 分页显示输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('g_name',$g_name);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('pager',$pager);
        return $this->fetch();
    }
    
    public function position(){
        $act = I('get.act','add');
        $position_id = I('get.position_id/d');
        $info = array();
        if($position_id){
            $info = D('ad_position')->where(array('position_id'=>$position_id))->find();
        }

        $this->assign('info',$info);
        $this->assign('act',$act);
        return $this->fetch();
    }

    public function positionList()
    {
        $count = Db::name('ad_position')->where(1)->count();// 查询满足要求的总记录数
        $Page = $pager = new Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = Db::name('ad_position')->where(1)->order('position_id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('pager', $Page);
        return $this->fetch();
    }
    
    public function adHandle(){
    	$data = I('post.');
    	$data['start_time'] = strtotime($data['begin']);
    	$data['end_time'] = strtotime($data['end']);

    	if($data['act'] == 'add'){
            $data['sid'] = $this->sid;
    		$r = D('ad')->add($data);
    	}
    	if($data['act'] == 'edit'){
            $info = D('ad')->where(array('ad_id'=> $data['ad_id'],'sid'=>$this->sid))->find();
            if($info['cat'] != $data['cat'] ){
                $data['enabled'] = 0;
                $data['g_id'] = 0;
                $data['g_name'] = '';
            }
    		$r = D('ad')->where(array('ad_id'=> $data['ad_id'],'sid'=>$this->sid))->save($data);
    	}
    	if($data['act'] == 'del'){
            $r = D('ad')->where(array('ad_id'=> $data['ad_id'],'sid'=>$this->sid))->delete();
    	}
        // 不管是添加还是修改广告 都清除一下缓存
        delFile(RUNTIME_PATH);// 先清除缓存, 否则不好预览
        \think\Cache::clear();
    	if($r !== false){
            $this->ajaxReturn(['status'=>1,'msg'=>'操作成功']);
    	}else{
            $this->ajaxReturn(['status'=>0,'msg'=>'操作失败']);
    	}
    }

    /**
     * 操作广告位
     */
    public function positionHandle(){
        $data = I('post.');
        if($data['act'] == 'add'){
            $r = M('ad_position')->add($data);
        }
        if($data['act'] == 'edit'){
        	$r = M('ad_position')->where(array('position_id'=>$data['position_id']))->save($data);
        }
        if($data['act'] == 'del'){
            $adCount = M('ad')->where(array('pid'=>$data['position_id'],'sid'=>$this->sid))->count();
        	if($adCount){
                $this->ajaxReturn(['status'=>0,'msg'=>'此广告位下还有广告，请先清除']);
        	}else{
        		$r = M('ad_position')->where(array('position_id'=> $data['position_id']))->delete();
        	}
        }

        if($r !== false){
            $this->ajaxReturn(['status'=>1,'msg'=>'操作成功']);
        }else{
            $this->ajaxReturn(['status'=>0,'msg'=>'操作失败']);
        }
    }
    
    public function changeAdField(){
        $field = $this->request->request('field');
    	$data[$field] = I('get.value');
    	$data['ad_id'] = I('get.ad_id');
    	$data['sid'] = $this->sid;
    	M('ad')->save($data); // 根据条件保存修改的数据
    }
    
    /**
     * 编辑广告中转方法
     */
    public function editAd()
    {
        \think\Cache::clear();        
        $request_url = urldecode(I('request_url'));
        $request_url = U($request_url,array('edit_ad'=>1));
        echo "<script>location.href='".$request_url."';</script>";
        exit;
    }

    /**
     * @return mixed
     * 绑定商品|品牌|优惠券列表搜索与显示
     */
    public function searchItems(){
        //获取传来的数据并作出判断
        $cat = $_GET['cat'];
        $pid = $_GET['ad_id'];
        if(empty($cat) || empty($pid)){
            $this->error('参数丢失');
        }
        $keyword = input('keyword/s');
        //已推荐项
        $item_ids = Db::name('ad')->where(['cat'=>$cat,'ad_id'=>$pid])->getField('GROUP_CONCAT(g_id) g_ids');
//        var_dump($item_ids);exit;
        $primary_key = 'id';
        $field = 'name';
        $statusField = 'status';
        switch($cat){
            case 1:$table='goods';$primary_key = 'goods_id';$field='goods_name';$statusField='is_on_sale';break;
            case 2:$table='brands';break;
            case 3:$table='weixin_cards';$field='title';break;
            case 4:$table='goods_category';$statusField='is_show';break;
            default:$table='';
        }
        if(empty($table)) {
            $this->error('参数丢失');
        }
        $where = ['a.sid'=>$this->sid,$primary_key=>['not in',$item_ids],$statusField=>1];

        if($table == 'goods'){
            $where['a.cycle'] = 1;
        }
        if(!empty($keyword)){
            $where['a.'.$field] = ['like',"%$keyword%"];
        }
        $model = Db::name($table.' a')->field($primary_key.' as id,'.$field.' as name,'.$statusField.' as status')->where($where);
        $count = $model->count();
        if($count){
//            var_dump($where);exit;
            $page = new Page($count,10);
            $model = Db::name($table.' a')->field($primary_key.' as id,'.$field.' as name,'.$statusField.' as status')->where($where);

            $lists = $model->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
            $this->assign([
                'lists' => $lists,
                'pager' => $page,
                'table' => $table,
                'statusField'=>$statusField,
                'primaryKey' => $primary_key
            ]);
        }
        return $this->fetch('searchItems');
    }

    /**
     * 商品|品牌|优惠券的绑定操作
     */
    public function checkItems(){
        if(IS_POST && IS_AJAX){
            $cat = input('cat/d');
            $pid = input('pid/d');
            $item_id = input('item_id/d');
            if(empty($cat) || empty($pid) || empty($item_id)){
                $this->ajaxReturn(['status'=>0,'msg'=>'参数丢失']);
            }
            $count = Db::name('recommend_items')->where(['cat'=>$cat,'pid'=>$pid,'item_id'=>$item_id])->count('id');
            if($count == 0){
                $primary_key = 'id';$field = 'name';
                switch($cat){
                    case 1:$table='goods';$primary_key = 'goods_id';$field = 'goods_name';break;
                    case 2:$table='brands';break;
                    case 3:$table='weixin_cards';$field='title';break;
                    default:$table='';
                }
                $g_id = Db::name($table)->field([$primary_key])->where([$primary_key=>$item_id])->find();
                $g_name = Db::name($table)->field([$field])->where([$primary_key=>$item_id])->find();
                $goods_id = implode($g_id);
                $goods_name = implode($g_name);
                $result = Db::name('ad')
                    ->where('ad_id', $pid)
                    ->update(['g_id' => $goods_id,'g_name'=>$goods_name]);
                if(!$result){
                    $this->ajaxReturn(['status'=>0,'msg'=>'添加失败']);
                }
            }
            $this->ajaxReturn(['status'=>1,'msg'=>'添加成功']);
        }
    }
}