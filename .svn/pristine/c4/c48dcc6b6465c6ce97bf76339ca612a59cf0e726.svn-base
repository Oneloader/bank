<?php
namespace app\common\model;
use think\Model;
use think\Db;
class Shop extends Model {
    public $shops = [];

    public function getShopParam($sid){
        $info = Db::name('shop')->where(['id'=>$sid])->cache(true)->find();
        return $info;
    }
}