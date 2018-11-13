<?php
namespace app\admin\controller;
use app\admin\logic\GoodsLogic;
use app\admin\model\GoodsCards;
use app\admin\model\GoodsK11tags;
use app\admin\model\GoodsTags;
use app\admin\model\Spec;
use app\common\model\Shop;
use app\common\model\WeixinCards;
use app\common\model\WeixinCardsCats;
use bar\baz\source_with_namespace;
use app\common\logic\k11ApiLogic;
use think\AjaxPage;
use think\Exception;
use think\Loader;
use think\Page;
use think\Db;

class Goods extends Base {
    /**
     *  商品列表
     */
    public function goodsList(){
        return $this->fetch();
    }
    
    /**
     *  商品列表
     */
    public function ajaxGoodsList(){
        if(I('is_on_sale') !== ''){
            $where = "is_on_sale = ".I('is_on_sale') ;
        }else{
            $where = "is_on_sale in (0,1,2) " ;
        }

        // 关键词搜索
        $key_word = I('key_word') ? trim(I('key_word')) : '';
        if($key_word) {
            $where = "$where and (goods_name like '%$key_word%' or goods_name_en like '%$key_word%')" ;
//            $where = "$where and (goods_name_en like '%$key_word%')" ;
        }

        $model = M('Goods');
        $count = $model->where($where)->count();
        $Page  = new AjaxPage($count,10);

        $show = $Page->show();
        $goodsList = $model
            ->where($where)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order(['goods_id'=>'desc'])
            ->select();

        $GoodsLogic = new GoodsLogic();
        foreach($goodsList as $key=>$val){
            $level_cat = $GoodsLogic->find_parent_cat($val['cat_id']); //获取分类默认选中的下拉框
            sort($level_cat);
            $cat = [];
            foreach($level_cat as $v){
                //获取所属分类详情
                $cat[] = M('goods_category')->where(array('id'=>$v))->getField('name');
                $cat_str = implode(' > ',$cat);
                $goodsList[$key]['cat_str'] = $cat_str;
            }
        }

        $this->assign('goodsList',$goodsList);
        $this->assign('page',$show);// 赋值分页输出
        return $this->fetch('ajaxGoodsList');
    }

    /**
     * 第二步，修改商品信息
     */
    public function addEditGoods()
    {
        $Goods = new \app\admin\model\Goods();
        //ajax提交验证
        if ((I('is_ajax') == 1) && IS_POST) {
            $type = I('addEditType/d'); // 标识自动验证时的 场景 1 表示插入 2 表示更新

            $data = input('post.');
            $validate = \think\Loader::validate('Goods');
            if (!$validate->batch()->check($data)) {
                $error = $validate->getError();
                $error_msg = array_values($error);
                $return_arr = array(
                    'status' => -1,
                    'msg' => $error_msg[0],
                    'data' => $error,
                );
                $this->ajaxReturn($return_arr);
            }

            if(mb_strlen($data['goods_remark'],'UTF-8') > 127){
                $return_arr = array(
                    'status' => 0,
                    'msg' => '商品简介字数超过限制',
                );
                $this->ajaxReturn($return_arr);
            }

            $Goods->startTrans();
            try{
                $Goods->data($data, true); // 收集数据
                $Goods->last_update = time(); //  最近更新时间
                if($type == 1){
                    $Goods->create_time = time(); //  最近更新时间
                }

                $update = $type == 1 ? false : true;
                $Goods->isUpdate($update)->save(); // 写入数据到数据库
                $goods_id = $data['goods_id'];
                $Goods->afterSave($goods_id,$type);
                $Goods->commit();

                $return_arr = array(
                    'status' => 1,
                    'msg' => '操作成功',
                    'data' => array('url' => U('Goods/goodsList')),
                );
                $this->ajaxReturn($return_arr);exit;
            }catch(Exception $e){
                $Goods->rollback();
                $this->ajaxReturn([
                    'status'=>0,
                    'msg'=>$e->getMessage()
                ]);
            }
        }

        $id = input('id/d',0);
        if (!empty($id)) {
            //编辑
            $goodsInfo = $Goods->get(['goods_id'=>$id]);
            $goodsImages = M("GoodsImgs")->where(['goods_id' => $id])->select();

            $this->assign(array(
                'goodsImages'=>$goodsImages,  // 商品相册
                'goodsInfo'=>$goodsInfo,  // 商品详情
            ));
        }

        $cat_list = Db::name('goods_category')->where(['sid'=>$this->sid])->select(); // 已经改成联动菜单
        $this->assign('cat_list', $cat_list);
        return $this->fetch('_goods');
    }

    /**
     * 修改商品状态
     */
    public function changeGoodStatus(){
        if(IS_AJAX && IS_GET){
            $goods_id = I('goods_id/d');
            if(empty($goods_id)){
                $this->ajaxReturn(['status'=>0,'msg'=>'参数丢失']);
            }
            $where = ['goods_id'=>$goods_id,'sid'=>$this->sid];
            $model = M('Goods');
            //获取订单状态
            $info = $model
                ->field('is_on_sale')
                ->where($where)
                ->find();
            if(empty($info)){
                $this->ajaxReturn(['status'=>0,'msg'=>'商品不存在']);
            }
            $status = $info['is_on_sale'];
            $status++;
            $status = $status >= 3 ? 0 : $status;
            $r = M('Goods')->where($where)->save(['is_on_sale'=>$status]);
            if($r){
                //$this->PushGoods($goods_id,2);
                $this->ajaxReturn(['status'=>1,'msg'=>'更新状态成功','goods_status'=>$status]);
            }else{
                $this->ajaxReturn(['status'=>0,'msg'=>'更新状态失败']);
            }
        }
    }

    /**
     * 更改指定表的指定字段
     */
    public function updateField(){
        $primary = array(
                'goods' => 'goods_id',
                'goods_category' => 'id',
                'brand' => 'id',            
                'goods_attribute' => 'attr_id',
        		'ad' =>'ad_id',            
        );
        $model = D($_POST['table']);
        $model->$primary[$_POST['table']] = $_POST['id'];
        $model->$_POST['field'] = $_POST['value'];        
        $model->save();   
        $return_arr = array(
            'status' => 1,
            'msg'   => '操作成功',                        
            'data'  => array('url'=>U('Goods/goodsAttributeList')),
        );
        $this->ajaxReturn($return_arr);
    }

    /**
     * 删除商品
     */
    public function delGoods()
    {
        $goods_id = input('id');

        // 删除此商品        
        M("Goods")->where(['goods_id'=>$goods_id])->save(['is_on_sale'=>3]);  //商品表
        $return_arr = array('status' => 1,'msg' => '操作成功','data'  =>'');
        $this->ajaxReturn($return_arr);
    }

    /**
     * 删除商品相册图
     */
    public function del_goods_images()
    {
        $path = I('filename','');
        M('goods_imgs')->where("img_url = '$path'")->delete();
    }

    /**
     *  商品分类列表
     */
    public function categoryList(){
        $GoodsLogic = new GoodsLogic();
        $cat_list = $GoodsLogic->goods_cat_list();
        $this->assign('cat_list',$cat_list);
        return $this->fetch();
    }

    /**
     * 添加修改商品分类
     */
    public function addEditCategory(){
        $GoodsLogic = new GoodsLogic();
        $model = M('goods_category');
        if(IS_GET)
        {
            $goods_category_info = $model->where(array('id'=>I('GET.id',0),'sid'=>$this->sid))->find();
            $parent_id = I('get.parent_id/d');
            if(!empty($goods_category_info)){
                $parent_id = $goods_category_info['id'];
            }
            if($parent_id > 0){
                $level_cat = $GoodsLogic->find_parent_cat($parent_id); // 获取分类默认选中的下拉框
                //array_unshift($level_cat,$parent_id);
                $this->assign('level_cat',$level_cat);
            }
            $cat_list = $model->where(array('parent_id' => 0,'sid'=>$this->sid))->select(); // 已经改成联动菜单

            $this->assign('goods_category_info',$goods_category_info);
            $this->assign('cat_list',$cat_list);
            return $this->fetch('_category');
        }

        $GoodsCategory = D('GoodsCategory');

        $type = I('id') > 0 ? 2 : 1; // 标识自动验证时的 场景 1 表示插入 2 表示更新
        //ajax提交验证
        if(I('is_ajax') == 1)
        {
            // 数据验证
            $data = input('post.');
            $validate = \think\Loader::validate('GoodsCategory');
            if(!$validate->batch()->check($data))
            {
                $error = $validate->getError();
                $error_msg = array_values($error);
                $return_arr = array(
                    'status' => -1,
                    'msg' => $error_msg[0],
                    'data' => $error,
                );
                $this->ajaxReturn($return_arr);
            } else {
                //unset($data['parent_id_1'],$data['parent_id_2']);
                $GoodsCategory->data($data,true); // 收集数据
                $GoodsCategory->parent_id = I('parent_id_1');
                $GoodsCategory->sid = $this->sid;
                !empty($data['parent_id_2']) && ($GoodsCategory->parent_id = input('parent_id_2'));
                //编辑判断
                /*if($type == 2){
                    $children_where = array(
                        'parent_id_path'=>array('like','%_'.I('id')."_%"),
                        'sid'=>$this->sid
                    );
                    $children = $model->where($children_where)->max('level');
                    if (I('parent_id_1')) {
                        $parent_level = $model->where(array('id' => I('parent_id_1'),'sid'=>$this->sid))->getField('level', false);
                        if (($parent_level + $children) > 4) {
                            $return_arr = array(
                                'status' => -1,
                                'msg'   => $parent_level.'商品分类最多为三级'.$children,
                                'data'  => '',
                            );
                            $this->ajaxReturn($return_arr);
                        }
                    }
                    if (I('parent_id_2')) {
                        $parent_level = $model->where(array('id' => I('parent_id_2'),'sid'=>$this->sid))->getField('level', false);
                        if (($parent_level + $children) > 4) {
                            $return_arr = array(
                                'status' => -1,
                                'msg'   => '商品分类最多为三级',
                                'data'  => '',
                            );
                            $this->ajaxReturn($return_arr);
                        }
                    }
                }*/

                if($GoodsCategory->id > 0 && $GoodsCategory->parent_id == $GoodsCategory->id){
                    // 编辑
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '上级分类不能为自己',
                        'data'  => '',
                    );
                    $this->ajaxReturn($return_arr);
                }
                if ($type == 2)
                {
                    $GoodsCategory->isUpdate(true)->save(); // 写入数据到数据库
                    $GoodsLogic->refresh_cat(I('id'));
                }else {
                    $GoodsCategory->save(); // 写入数据到数据库
                    $insert_id = $GoodsCategory->getLastInsID();
                    $GoodsLogic->refresh_cat($insert_id);
                }
                $return_arr = array(
                    'status' => 1,
                    'msg'   => '操作成功',
                    'data'  => array('url'=>U('Goods/categoryList')),
                );
                $this->ajaxReturn($return_arr);
            }
        }
    }

    /**
     * 删除分类
     */
    public function delGoodsCategory(){
        $id = $this->request->param('id');
        // 判断子分类
        $GoodsCategory = M("goods_category");
        $count = $GoodsCategory->where("parent_id = {$id}")->count("id");
        $count > 0 && $this->error('该分类下还有分类不得删除!',U('Goods/categoryList'));
        // 判断是否存在商品
        $goods_count = M('Goods')->where(['cat_id'=>$id])->count('1');
        $goods_count > 0 && $this->error('该分类下有商品不得删除!',U('Goods/categoryList'));
        // 删除分类
        DB::name('goods_category')->where(array('id'=>$id,'sid'=>$this->sid))->delete();
        $this->success("操作成功!!!",U('Goods/categoryList'));
    }
}