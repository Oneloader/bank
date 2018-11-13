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
namespace app\common\model;

use think\Model;
use think\Db;

class Banks extends Model
{
    /**
     * 获取推荐详情
     * @param $id
     * @param string $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getInfo($id,$field='*')
    {
        $info = Db::name('banks')->field($field)->where(['id' => $id, 'sid' => $this->sid])->find();
        return $info;
    }

    public function getList(){
        if(empty($this->sid)){
            return null;
        }
        $lists = Db::name('banks')->where(['sid' => $this->sid])->getField('id,name',true);
        return $lists;
    }
}