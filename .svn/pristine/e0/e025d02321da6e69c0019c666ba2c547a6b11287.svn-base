<?php

namespace app\common\model;
use think\Model;
use think\Db;
class Ad extends Model {
    public function getAdByPid($pid,$sid){
        $where = ['sid'=>$sid,'pid'=>$pid,'start_time'=>['lt',time()],'end_time'=>['gt',time()],'enabled'=>1];
        $ads = Db::name('ad')->field('ad_id,ad_code,cat,g_id')->where($where)->order(['orderby'=>'desc','ad_id'=>'desc'])->select();
        $ads = addCDN($ads,'ad_code');
        return $ads;
    }
}