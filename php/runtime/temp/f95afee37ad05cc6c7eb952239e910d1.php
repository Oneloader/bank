<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:41:"./application/admin/view2/index\pubs.html";i:1540807704;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" type="image/x-icon" href="__PUBLIC__/images/favicon.ico" media="screen"/>
<title>商品兑换系统</title>
<script type="text/javascript">

var SITEURL = window.location.host +'/admin';
 
</script>

<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.bgColorSelector.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/admincp1.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script src="__PUBLIC__/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
</head>
<body>
<div class="admincp-header">
  <div class="bgSelector"></div>
  <div id="foldSidebar"><i class="fa fa-outdent " title="展开/收起侧边导航"></i></div>
  <div class="admincp-name">
    <img src="__PUBLIC__/static/images/TPlogo.png" alt="">
  </div>
  <div class="admincp-header-r">
    <div class="manager">
      <dl>
        <dt class="name"><?php echo $admin_info['user_name']; ?></dt>
        <dd class="group">管理员</dd>
      </dl>
      <span class="avatar">
      <img alt="" tptype="admin_avatar" src="__PUBLIC__/static/images/admint.png"> </span><i class="arrow" id="admin-manager-btn" title="显示快捷管理菜单"></i>
      <div class="manager-menu">
        <div class="title">
          <h4>最后登录</h4>
          <a href="javascript:void(0);" onClick="CUR_DIALOG = ajax_form('modifypw', '修改密码', '<?php echo U('Admin/modify_pwd',array('admin_id'=>$admin_info['admin_id'])); ?>');" class="edit-password">修改密码</a> </div>
        <div class="login-date"> <?php echo date('Y-m-d H:i:s',session('last_login_time'));?> <span>(IP: <?php echo session('last_login_ip');?> )</span> </div>
      </div>
    </div>
    <ul class="operate nc-row">
      <li style="display: none !important;" tptype="pending_matters"><a class="toast show-option" href="javascript:void(0);" onClick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'http://www.K11APP.cn/admin/index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>0</em></a></li>
      <li><a class="login-out show-option" href="<?php echo U('Admin/logout'); ?>" title="安全退出管理中心">&nbsp;</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="admincp-container unfold">
  <div class="admincp-container-left">
    <div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>
    <div id="admincpNavTabs_pubs" class="nav-tabs">
      <dl>
        <dt><a href="javascript:void(0);"><span class="ico-microshop-3"></span><h3>银行管理</h3></a></dt>
        <dd class="sub-menu">
          <ul>
            <li><a href="javascript:void(0);" data-param="pubs_list|Index">所有银行</a></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt><a href="javascript:void(0);"><span class="ico-microshop-1"></span><h3>商品管理</h3></a></dt>
        <dd class="sub-menu">
          <ul>
            <li><a href="javascript:void(0);" data-param="goodsList|Goods">商品管理</a></li>
            <li><a href="javascript:void(0);" data-param="categoryList|Goods">商品分类</a></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt><a href="javascript:void(0);"><span class="ico-microshop-4"></span><h3>管理员日志</h3></a></dt>
        <dd class="sub-menu">
          <ul>
            <li><a href="javascript:void(0);" data-param="adminlog|Index">我的日志</a></li>
          </ul>
        </dd>
      </dl>
    </div>
  </div>
  <div class="admincp-container-right">
    <div class="top-border"></div>
    <iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
</body>
<script type="text/javascript">
    //管理显示与隐藏
    $("#admin-manager-btn").click(function () {
      if ($(".manager-menu").css("display") == "none") {
        $(".manager-menu").css('display', 'block');
        $("#admin-manager-btn").attr("title","关闭快捷管理");
        $("#admin-manager-btn").removeClass().addClass("arrow-close");
      }
      else {
        $(".manager-menu").css('display', 'none');
        $("#admin-manager-btn").attr("title","显示快捷管理");
        $("#admin-manager-btn").removeClass().addClass("arrow");
      }
    });
</script>
</html>