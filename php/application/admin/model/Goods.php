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
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\admin\model;
use think\Model;
use think\Db;
class Goods extends Model {

    protected $url;

    /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $goods_id 商品id
     */
    public function afterSave($goods_id,$type=1)
    {
         $goods_image_model = M('GoodsImgs');
         // 商品图片相册  图册
         $goods_images = I('goods_images/a');
         if(count($goods_images) > 1)
         {
             array_pop($goods_images); // 弹出最后一个
             $goodsImagesArr = $goods_image_model->where("goods_id = $goods_id")->getField('id,img_url'); // 查出所有已经存在的图片
             
             // 删除图片
             foreach($goodsImagesArr as $key => $val)
             {
                 if(!in_array($val, $goods_images))
                     $goods_image_model->where("id = {$key}")->delete(); //
             }
             // 添加图片
             foreach($goods_images as $key => $val)
             {
                 if($val == null)  continue;
                 if(!in_array($val, $goodsImagesArr))
                 {                 
                    $data = array(
                        'goods_id' => $goods_id,
                        'img_url' => $val,
                        'sid' => $this->sid,
                    );
                     $goods_image_model->insert($data); // 实例化User对象
                 }
             }
         }
        if($type == 1){
            // 查看主图是否已经存在相册中
            $original_img = I('original_img');
            $c = $goods_image_model->where("goods_id = $goods_id and img_url = '{$original_img}'")->count();
            if($c == 0 && $original_img)
            {
                $goods_image_model->add(array('goods_id'=>$goods_id,'img_url'=>$original_img));
            }
        }
    }
}
