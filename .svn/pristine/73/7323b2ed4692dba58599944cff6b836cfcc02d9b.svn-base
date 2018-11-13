<?php
namespace app\common\model;
use think\Model;
use think\Db;
class Goods extends Model {
    /**
     * 获取商品信息
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     */
    public function getInfo($id){
        $info = Db::name('goods')->where(['id'=>$id,'sid'=>$this->sid])->find();
        return $info;
    }

    public function delBrand($id){
        $goods = Db::name('goods')->where(['sid'=>$this->sid,'id'=>$id])->find();
        if(empty($goods)){
            return ['status'=>0,'msg'=>'该商品不存在'];
        }
        $r = Db::name('goods')->where(['sid'=>$this->sid,'id'=>$id])->delete();
        if($r){
            adminLog('删除商品:'.$goods['name']);
            $return = ['status'=>1,'msg'=>'删除成功'];
        }else{
            $return = ['status'=>0,'msg'=>'删除失败'];
        }
        $id = $r = $goods = null;
        return $return;
    }

    public function getOldGoods($shop){
        $goods = Db::name('goods')->where(['shop'=>$shop,'origin'=>1])->getField('goods_id,s_goods_id');
//        var_dump($goods);exit;
        return $goods;
    }

    /**
     * 保存图片
     * @param $id
     * @throws \think\Exception
     */
    public function afterSave($id){
        // 商品图片相册  图册
        $store_imgs = input('goods_imgs/a');
        $model = Db::name('goods_imgs');
        if(count($store_imgs) > 1){
            $imagesArr = $model->where("goods_id = $id")->getField('id,img_url'); // 查出所有已经存在的图片
            // 删除图片
            foreach($imagesArr as $key => $val) {
                if(!in_array($val, $store_imgs))
                    $model->where("id = {$key}")->delete();
            }
            // 添加图片
            foreach($store_imgs as $key => $val) {
                if($val == null)  continue;
                if(!in_array($val, $imagesArr)) {
                    $data = array(
                        'goods_id' => $id,
                        'img_url' => $val,
                        'sid' => $this->sid
                    );
                    $model->add($data);
                }
            }
        }
    }

    /**
     * 获取商品图片
     * @param $id
     * @return mixed
     */
    public function getGoodsImgs($id){
        $store_imgs = Db::name('goods_imgs')->where(['goods_id'=>$id])->getField('id,img_url');
        return $store_imgs;
    }

    /**
     * 获取已有标签
     * @param $goods_id
     * @return mixed
     */
    public function getHasTags($goods_id){
        $bids = Db::name('goods_tags_relation')->where(['gid'=>$goods_id])->getField('tid',true);
        return $bids;
    }
}