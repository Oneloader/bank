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
 *
 * Author: QP
 * Date: 2017-10-09
 */

namespace app\admin\controller;
use think\db;
use think\Cache;
class System extends Base{
	
	/*
	 * 配置入口
	 */
	public function index()
	{
		/*配置列表*/
		$group_list = array('shop_info'=>'商场信息','basic'=>'基本设置');// ,'sms'=>'短信设置','shopping'=>'购物流程设置','smtp'=>'邮件设置','water'=>'水印设置' ,'distribut'=>'分销设置'
		$this->assign('group_list',$group_list);
		$inc_type =  I('get.inc_type','shop_info');
		$this->assign('inc_type',$inc_type);
		$config = tpCache($inc_type);
		if($inc_type == 'shop_info'){
			$province = M('region')->where(array('parent_id'=>0))->select();
			$city =  M('region')->where(array('parent_id'=>$config['province']))->select();
			$area =  M('region')->where(array('parent_id'=>$config['city']))->select();
			$this->assign('province',$province);
			$this->assign('city',$city);
			$this->assign('area',$area);
		}
		$this->assign('config',$config);//当前配置项
                //C('TOKEN_ON',false);
		return $this->fetch($inc_type);
	}

   /**
	* 自定义导航
	*/
    public function navigationList(){
		$model = M("Navigation");
		$navigationList = $model->where($this->where)->order("id desc")->select();
		foreach($navigationList as $key=>$val){
			if($val['type'] == 1){
				$navigationList[$key]['response'] = url($val['name_en'].'/Index/index',array('sid'=>base64_encode($this->sid)),true,true);
			}
		}
		$this->assign('navigationList',$navigationList);
		return $this->fetch('navigationList');
	}

    /**
     * 添加修改编辑 前台导航
     */
    public function addEditNav()
    {
        if (IS_POST) {
			$id = I('post.id');
            if ($id){
				unset($_POST['id']);
				M("Navigation")->where($this->wherestr . ' AND id='.$id)->save(I('post.'));
            }else{
				$arr = $_POST;
				$count = M("Navigation")->where(['name_en'=>$arr['name_en'],'sid'=>$this->sid])->count('id');
				if($count > 0){
					$this->error("该栏目已经存在!!!");
				}
				$arr['sid'] = $this->sid;
				M("Navigation")->add($arr);
            }
            $this->success("操作成功!!!", U('Admin/System/navigationList'));
            exit;
        }
        // 点击过来编辑时
        $id = I('id',0);
        $navigation = DB::name('navigation')->where(array('id'=>$id,'sid'=>$this->sid))->find();
		$where = $this->wherestr;
		//$where .= ' AND parent_id=0';
        $this->assign('navigation', $navigation);
        return $this->fetch('_navigation');
    }   
    
    /**
     * 删除前台 自定义 导航
     */
    public function delNav()
    {     
        // 删除导航
        M('Navigation')->where("id",I('id'))->delete();
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功'));
    }
	
	public function refreshMenu(){
		$pmenu = $arr = array();
		$rs = M('system_module')->where('level>1 AND visible=1')->order('mod_id ASC')->select();
		foreach($rs as $row){
			if($row['level'] == 2){
				$pmenu[$row['mod_id']] = $row['title'];//父菜单
			}
		}

		foreach ($rs as $val){
			if($row['level']==2){
				$arr[$val['mod_id']] = $val['title'];
			}
			if($row['level']==3){
				$arr[$val['mod_id']] = $pmenu[$val['parent_id']].'/'.$val['title'];
			}
		}
		return $arr;
	}

        
        /**
         * 清空系统缓存
         */
        public function cleanCache(){
			delFile(RUNTIME_PATH);
			Cache::clear();
			$this->ajaxReturn(['status'=>1,'msg'=>'操作成功']);
            exit();
        }
	    
    /**
     * 清空静态商品页面缓存
     */
      public function ClearGoodsHtml(){
            $goods_id = I('goods_id');            
            if(unlink("./Application/Runtime/Html/Home_Goods_goodsInfo_{$goods_id}.html"))
            {
                // 删除静态文件                
                $html_arr = glob("./Application/Runtime/Html/Home_Goods*.html");
                foreach ($html_arr as $key => $val)
                {            
                    strstr($val,"Home_Goods_ajax_consult_{$goods_id}") && unlink($val); // 商品咨询缓存
                    strstr($val,"Home_Goods_ajaxComment_{$goods_id}") && unlink($val); // 商品评论缓存
                }
                $json_arr = array('status'=>1,'msg'=>'清除成功','result'=>'');
            }
            else 
            {
                $json_arr = array('status'=>-1,'msg'=>'未能清除缓存','result'=>'' );
            }                                                    
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      } 
    /**
     * 商品静态页面缓存清理
     */
      public function ClearGoodsThumb(){
            $goods_id = I('goods_id');
            delFile(UPLOAD_PATH."goods/thumb/".$goods_id); // 删除缩略图
            $json_arr = array('status'=>1,'msg'=>'清除成功,请清除对应的静态页面','result'=>'');
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      } 
    /**
     * 清空 文章静态页面缓存
     */
      public function ClearAritcleHtml(){
            $article_id = I('article_id');            
            unlink("./Application/Runtime/Html/Index_Article_detail_{$article_id}.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_api.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_phper.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_android.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_ios.html"); // 清除文章静态缓存
            $json_arr = array('status'=>1,'msg'=>'操作完成','result'=>'' );                                                          
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      }

     function ajax_get_action()
     {
     	$control = I('controller');
     	$advContrl = get_class_methods("app\\admin\\controller\\".str_replace('.php','',$control));
     	$baseContrl = get_class_methods('app\admin\controller\Base');
     	$diffArray  = array_diff($advContrl,$baseContrl);
     	$html = '';
     	foreach ($diffArray as $val){
     		$html .= "<option value='".$val."'>".$val."</option>";
     	}
     	exit($html);
     }
     
     function right_list(){
     	$group = array(
			'system'=>'系统设置','goods'=>'商品中心','member'=>'会员中心','tools'=>'扩展工具','count'=>'统计报表',
			'wxcard'=>'卡券中心','recommend'=>'首页推荐','tags'=>'标签管理'
     	);
     	
     	$name = I('name');
     	if($name){
     	    $condition['name|right'] = array('like',"%$name%");
     	    $right_list = M('system_menu')->where($condition)->order('id desc')->select();
     	}else{
     	    $right_list = M('system_menu')->order('id desc')->select();
     	}
     	
     	$this->assign('right_list',$right_list);
     	$this->assign('group',$group);
     	return $this->fetch();
     }
     
     public function edit_right(){
     	if(IS_POST){
     		$data = I('post.');
     		$data['right'] = implode(',',$data['right']);
     		if(!empty($data['id'])){
     			M('system_menu')->where(array('id'=>$data['id']))->save($data);
     		}else{
     			if(M('system_menu')->where(array('name'=>$data['name']))->count()>0){
     				$this->error('该权限名称已添加，请检查',U('System/right_list'));
     			}
     			unset($data['id']);
     			M('system_menu')->add($data);
     		}
     		$this->success('操作成功',U('System/right_list'));
     		exit;
     	}
     	$id = I('id');
     	if($id){
     		$info = M('system_menu')->where(array('id'=>$id))->find();
     		$info['right'] = explode(',', $info['right']);
     		$this->assign('info',$info);
     	}
     	$group = array(
			'system'=>'系统设置','goods'=>'商品中心','member'=>'会员中心','tools'=>'扩展工具','count'=>'统计报表',
			'wxcard'=>'卡券中心','recommend'=>'首页推荐','tags'=>'标签管理'
     	);
     	$planPath = APP_PATH.'admin/controller';
     	$planList = array();
     	$dirRes   = opendir($planPath);
     	while($dir = readdir($dirRes))
     	{
     		if(!in_array($dir,array('.','..','.svn')))
     		{
     			$planList[] = basename($dir,'.php');
     		}
     	}
     	$this->assign('planList',$planList);
     	$this->assign('group',$group);
        return $this->fetch();
     }
     
     public function right_del(){
     	$id = I('del_id');
     	if(is_array($id)){
     		$id = implode(',', $id); 
     	}
     	if(!empty($id)){
     		$r = M('system_menu')->where("id in ($id)")->delete();
     		if($r){
     			respose(1);
     		}else{
     			respose('删除失败');
     		}
     	}else{
     		respose('参数有误');
     	}
     }
}