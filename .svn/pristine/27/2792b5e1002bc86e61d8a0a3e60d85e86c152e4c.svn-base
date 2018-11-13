<?php

namespace app\admin\controller;
use app\common\model\Shop;
use think\Controller;
use think\Db;
use think\response\Json;
use think\Session;
class Base extends Controller {
    protected $sid;
    protected $where;
    protected $wherestr;
    /**
     * 析构函数
     */
    function __construct() 
    {
        Session::start();
        header("Cache-control: private");
        parent::__construct();
    }
    
    /*
     * 初始化操作
     */
    public function _initialize()
    {
        //过滤不需要登陆的行为
        if(in_array(ACTION_NAME,array('login','logout','vertify')) || in_array(CONTROLLER_NAME,array('Ueditor','Uploadify'))){
        	//return;
        }else{
        	if(session('admin_id') > 0 ){
        		$this->check_priv();//检查管理员菜单操作权限
        	}else{
                $this->redirect(U('Admin/Admin/login'));
                //$this->error('请先登陆',U('Admin/Admin/login'),1);
        	}
        }
    }

    //验证是否是超级管理员
    public function check_root(){
        $act_list = session('act_list');
        if($act_list == 'all'){
            //是超级管理员
            return true;
        }
        return false;
    }

    /**
     * 获取银行基本参数
     * @return mixed
     */
    public function getShopInfo(){
        //获取对应商城数据
        $shopModel = new Shop();
        //$mall_data = S('onlineData_'.$this->sid);
        if(empty($mall_data)){
            $mall_data = $shopModel->getShopParam($this->sid);
            S('onlineData_'.$this->sid,$mall_data);
        }
        return $shopInfo = $shopModel->shops[$mall_data['online']];
    }

    /**
     * 检查管理员权限
     * @return bool
     */
    public function check_priv()
    {
        $ctl = CONTROLLER_NAME;
    	$act = ACTION_NAME;
        $act_list = session('act_list');

        //管理员无须验证sid的操作
        $unsid_check = array('adminlog','pubs','pubs_add','pubs_del','pubs_edit','pubs_list','goshop','modify_pwd');
        if(in_array($act,$unsid_check)){
            if($act_list != 'all' && $act !== 'modify_pwd'){
                session(null);
                $this->error('你没有操作权限');
            }else{
                return true;
            }
        }

        //无需验证的操作
        $uneed_check = array('login','logout','vertifyHandle','vertify','imageUp','upload','goodsList','ajaxGoodsList','addEditGoods','delGoods','categoryList','addEditCategory','delGoodsCategory');
        //检测参数sid是否丢失
        $sid = intval(base64_decode(session('sid')));
        if(empty($sid) && !in_array($act,$uneed_check)){
            session(null);
            $this->error('银行参数丢失');
        }else{
            $this->sid = $sid;
            $this->where = array('sid'=>$sid);
            $this->wherestr = ' sid = '.$sid;
        }

    	if($act_list == 'all'){
    		//后台首页控制器无需验证,超级管理员无需验证
    		return true;
    	}elseif(strpos($act,'ajax') || IS_AJAX){
    		//所有ajax请求不需要验证权限
    		return true;
    	}else{
            $role_right = '';
    		$right = M('system_menu')->where("id", "in", $act_list)->cache(true)->getField('right',true);
    		foreach ($right as $val){
    			$role_right .= $val.',';
    		}
    		$role_right = explode(',', $role_right);
            $role_right[] = 'Admin@index';
            $role_right[] = 'Index@index';
            $role_right[] = 'Index@code_exchange';
            $role_right[] = 'Admin@modify_pwd';
    		//检查是否拥有此操作权限
    		if(!in_array($ctl.'@'.$act, $role_right)){
                //session(null);
                echo '您没有操作权限['.($ctl.'@'.$act).'],请联系超级管理员分配权限';die;
    			//$this->error('您没有操作权限['.($ctl.'@'.$act).'],请联系超级管理员分配权限',U("$ctl/$act"));
    		}
    	}
    }

    /**
     * 获取同步记录
     */
    protected  function getRefreshLog($info){
        $date = Db::name('admin_log')->where(['sid'=>$this->sid,'action'=>$info])->order(['log_id'=>'desc'])->getField('log_time');
        return empty($date) ? '' : date('Y-m-d H:i:s',$date);
    }

    public function ajaxReturn($data,$type = 'json'){                        
            exit(json_encode($data));
    }
}