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
class GoodsCategory extends Model {
    //获取所有商品分类
    public function getAllCats($where = array(),$fields = 'id,name,name_en'){
        $where['sid'] = $this->sid;
        $cats = self::field($fields)->where($where)->select();
        return $cats;
    }
}
