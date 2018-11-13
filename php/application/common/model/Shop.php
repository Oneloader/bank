<?php
namespace app\common\model;
use think\Model;
use think\Db;
class Shop extends Model {
    public $shops = [
        2 => ['id'=>2 , 'name'=>'开世艺','store_code'=>'01','appid'=>'wxc1028ddd942f01d5','origin_id'=>6,'account_id' => 6,'AccountID'=>'767151425832326'],
    ];

    public function getShopParam($sid){
        $info = Db::name('shop')->where(['id'=>$sid])->cache(true)->find();
        return $info;
    }

    public function getOnlineShopId($sid){
        $ssid = Db::name('shop')->where(['id'=>$sid])->cache(true)->getField('online');
        return $ssid;
    }
}