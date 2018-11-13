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

class ChangeLevel extends Model
{
    /**
     * 获取对换等级
     * @param $id
     * @param string $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getInfo($id,$field='*')
    {
        $info = Db::name('change_level')->field($field)->where(['id' => $id, 'sid' => $this->sid])->find();
        return $info;
    }
}