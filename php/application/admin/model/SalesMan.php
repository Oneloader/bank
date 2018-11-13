<?php
/**
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\common\model;

use think\Model;
use think\Db;

class SalesMan extends Model
{
    /**
     * 获取销售经理详情
     * @param $id
     * @param string $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getInfo($id,$field='*')
    {
        $info = Db::name('sales_man')->field($field)->where(['id' => $id, 'sid' => $this->sid])->find();
        return $info;
    }
}