<?php
use think\Session;

/**
 * 检测字段值是否已经存在
 * @param $table
 * @param $where
 * @param string $pk
 * @return bool
 */
function checkIsset($table,$where,$pk='id'){
	$count = M($table)->where($where)->count($pk);
	return $count > 0 ? true : false;
}

/**
 * 管理员操作记录
 */
function adminLog($log_info,$action='n'){
	//Session::start();
	$sid = intval(base64_decode(session('sid')));
    $add['log_time'] = time();
    $add['admin_id'] = session('admin_id');
    $add['log_info'] = $log_info;
    $add['action'] = $action;
    $add['log_ip'] = getIP();
    $add['sid'] = $sid;
    M('admin_log')->add($add);
}

/**
 * 获取商品分类名称
 * @param $cat_id
 * @return mixed
 */
function getGoodsCatName($cat_id){
	$name = M('goods_category')->where(['id'=>$cat_id])->getField('name');
	return $name;
}

/**
 * 下载文件
 * @param string $file_path 绝对路径
 */
function downFile($file_path) {
	header("Content-type:text/html;charset=utf-8");
	$root = ROOT_PATH;
	$root_path = $root.$file_path;
	if(!file_exists($root_path)){
		return false;
	}

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=sales_example.xls');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($root_path));

	readfile($root_path);
}

function getAdminInfo($admin_id){
	return D('admin')->where("admin_id", $admin_id)->find();
}

/**
 * 面包屑导航  用于后台管理
 * 根据当前的控制器名称 和 action 方法
 */
function navigate_admin()
{            
    $navigate = include APP_PATH.'admin/conf/navigate.php';
    $location = strtolower('Admin/'.CONTROLLER_NAME);
    $arr = array(
        '后台首页'=>'javascript:void();',
        $navigate[$location]['name']=>'javascript:void();',
        $navigate[$location]['action'][ACTION_NAME]=>'javascript:void();',
    );
    return $arr;
}

/**
 * 导出excel
 * @param $strTable	表格内容
 * @param $filename 文件名
 */
function downloadExcel($strTable,$filename)
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=".$filename."_".date('Y-m-d').".xls");
	header('Expires:0');
	header('Pragma:public');
	echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$strTable.'</html>';
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 根据id获取地区名字
 * @param $regionId id
 */
function getRegionName($regionId){
    $data = M('region')->where(array('id'=>$regionId))->field('name')->find();
    return $data['name'];
}

function getMenuList($act_list){
	//根据角色权限过滤菜单
	$menu_list = getAllMenu();
	if($act_list != 'all'){
		$right = M('system_menu')->where("id", "in", $act_list)->cache(true)->getField('right',true);
		$role_right = '';
		foreach ($right as $val){
			$role_right .= $val.',';
		}
		$role_right = explode(',', $role_right);		
		foreach($menu_list as $k=>$mrr){
			foreach ($mrr['sub_menu'] as $j=>$v){
				if(!in_array($v['control'].'@'.$v['act'], $role_right)){
					unset($menu_list[$k]['sub_menu'][$j]);//过滤菜单
				}
			}
		}
	}
	return $menu_list;
}

function getAllMenu(){
	return	array(
		'system' => array('name'=>'系统设置','icon'=>'fa-cog','sub_menu'=>array(
				array('name'=>'银行设置','act'=>'index','control'=>'System'),
				array('name'=>'友情链接','act'=>'linkList','control'=>'Article'),
				array('name'=>'自定义导航','act'=>'navigationList','control'=>'System'),
				array('name'=>'区域管理','act'=>'region','control'=>'Tools'),
				array('name'=>'短信模板','act'=>'index','control'=>'SmsTemplate'),
		)),
		'access' => array('name' => '权限管理', 'icon'=>'fa-gears', 'sub_menu' => array(
				array('name'=>'权限资源列表','act'=>'right_list','control'=>'System'),
				array('name' => '管理员列表', 'act'=>'index', 'control'=>'Admin'),
				array('name' => '角色管理', 'act'=>'role', 'control'=>'Admin'),
				array('name' => '供应商管理', 'act'=>'supplier', 'control'=>'Admin'),
				array('name' => '管理员日志', 'act'=>'log', 'control'=>'Admin'),
		)),
	);
}

function getMenuArr(){
	$menuArr = include APP_PATH.'admin/conf/menu.php';
	$act_list = session('act_list');
	if($act_list != 'all' && !empty($act_list)){
		$right = M('system_menu')->where("id in ($act_list)")->cache(true)->getField('right',true);
		$role_right = '';
		foreach ($right as $val){
			$role_right .= $val.',';
		}
		foreach($menuArr as $k=>$val){
			foreach ($val['child'] as $j=>$v){
				foreach ($v['child'] as $s=>$son){
					if(strpos($role_right,$son['op'].'@'.$son['act']) === false){
						unset($menuArr[$k]['child'][$j]['child'][$s]);//过滤菜单
					}
				}
			}
		}
		foreach ($menuArr as $mk=>$mr){
			foreach ($mr['child'] as $nk=>$nrr){
				if(empty($nrr['child'])){
					unset($menuArr[$mk]['child'][$nk]);
				}
			}
		}
	}
	return $menuArr;
}

function respose($res){
	exit(json_encode($res));
}