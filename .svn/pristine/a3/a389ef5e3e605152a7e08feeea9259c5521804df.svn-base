<?php
namespace app\bank\controller;
use think\Controller;
use think\Db;

/**
 * 银行顾客自助兑换页面
 * Class Index
 * @package app\bank\controller
 */
class Base extends Controller {
    protected $sid;
    protected $activity_id;

    public function __construct()
    {
        parent::__construct();

        //获取银行id
        $this->getSid();
    }

    /**
     * 从url中银行id参数获取
     */
    protected function getSid(){
        $sid = base64_decode(input('sid/s'));
        if(empty($sid) || $sid < 1){
            $this->error('无效的链接');
        }
        $this->sid = $sid;
    }

    /**
     * 从url中获取活动id
     */
    protected function getActivityId(){
        $activity_id = base64_decode(input('aid/s'));
        if(empty($activity_id) || $activity_id < 1){
            $this->error('无效的链接');
        }
        $this->activity_id = $activity_id;
    }
}