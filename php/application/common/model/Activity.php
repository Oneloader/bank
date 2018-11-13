<?php
namespace app\common\model;
use think\Model;
use think\Db;
class Activity extends Model {
    /**
     * 获取活动信息
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     */
    public function getInfo($id){
        $info = Db::name('activity')->where(['id'=>$id,'sid'=>$this->sid])->find();
        return $info;
    }
}