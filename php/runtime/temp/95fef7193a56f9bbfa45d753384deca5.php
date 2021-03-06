<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/admin\role_info.html";i:1541408710;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
    <link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
    <![endif]-->
    <link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">html, body { overflow: visible;}</style>
    <script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/common.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
    <script src="__PUBLIC__/js/myFormValidate.js"></script>
    <script src="__PUBLIC__/js/myAjax2.js"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <!--拾色器-->
    <!-- MiniColors -->
    <script src="__PUBLIC__/static/js/jquery.minicolors.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/static/css/jquery.minicolors.css">
    <script type="text/javascript">
        function delfunc(obj){
            layer.confirm('确认删除？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    // 确定
                    $.ajax({
                        type : 'post',
                        url : $(obj).attr('data-url'),
                        data : {act:'del',del_id:$(obj).attr('data-id')},
                        dataType : 'json',
                        success : function(data){
                            layer.closeAll();
                            if(data==1){
                                layer.msg('操作成功', {icon: 1});
                                $(obj).parent().parent().parent().remove();
                            }else{
                                layer.msg(data, {icon: 2,time: 2000});
                            }
                        }
                    })
                }, function(index){
                    layer.close(index);
                    return false;// 取消
                }
            );
        }

        function selectAll(name,obj){
            $('input[name*='+name+']').prop('checked', $(obj).checked);
        }

        function delAll(obj,name){
            var a = [];
            $('input[name*='+name+']').each(function(i,o){
                if($(o).is(':checked')){
                    a.push($(o).val());
                }
            })
            if(a.length == 0){
                layer.alert('请选择删除项', {icon: 2});
                return;
            }
            layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
                    $.ajax({
                        type : 'get',
                        url : $(obj).attr('data-url'),
                        data : {act:'del',del_id:a},
                        dataType : 'json',
                        success : function(data){
                            layer.closeAll();
                            if(data == 1){
                                layer.msg('操作成功', {icon: 1});
                                $('input[name*='+name+']').each(function(i,o){
                                    if($(o).is(':checked')){
                                        $(o).parent().parent().remove();
                                    }
                                })
                            }else{
                                layer.msg(data, {icon: 2,time: 2000});
                            }
                        }
                    })
                }, function(index){
                    layer.close(index);
                    return false;// 取消
                }
            );
        }
        $(document).ready( function() {
            $('.demo').each( function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(hex, opacity) {
                        var log;
                        try {
                            log = hex ? hex : 'transparent';
                            if( opacity ) log += ', ' + opacity;
                            console.log(log);
                        } catch(e) {}
                    },
                    theme: 'default'
                });
            });
        });
    </script>
    <style type="text/css">
        body {
            font: 16px sans-serif;
            line-height: 1.8;
            padding: 0 40px;
            margin-bottom: 200px;
        }
        a {
            color: #08c;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .form-group {
            margin: 20px 0;
        }
        label {
            color: #888;
        }
    </style>
</head>
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
			<div class="subject">
				<h3>管理员 - 编辑角色</h3>
				<h5>银行系统角色管理</h5>
			</div>
		</div>
	</div>
	<form class="form-horizontal" action="<?php echo U('Admin/Admin/roleSave'); ?>" id="roleform" method="post">
		<div class="ncap-form-default">
			<dl class="row">
				<dt class="tit">
					<label for="role_name"><em>*</em>角色名称</label>
				</dt>
				<dd class="opt">
					<input type="text" name="data[role_name]" id="role_name" value="<?php echo $detail['role_name']; ?>" class="input-txt">
					<span class="err" id="name_err" style="display: none">导航名称不能为空!!</span>
					<p class="notic"></p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="role_desc"><em>*</em>角色描述</label>
				</dt>
				<dd class="opt">
					<textarea id="role_desc" name="data[role_desc]" class="tarea" rows="6"><?php echo $detail['role_desc']; ?></textarea>
					<span class="err" id="err_tpl_content" style="display:none;">短信内容不能为空</span>
					<p class="notic"></p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="cls_full">权限分配</label>
				</dt>
				<dd style="margin-left:200px;">
					<div class="ncap-account-container" style="border-top:none;">
						<h4>
							<input id="cls_full" onclick="choosebox(this)" type="checkbox">
							<label>全选</label>
						</h4>
					</div>

					<?php if(is_array($modules) || $modules instanceof \think\Collection || $modules instanceof \think\Paginator): if( count($modules)==0 ) : echo "" ;else: foreach($modules as $kk=>$menu): ?>
						<div class="ncap-account-container" style="border-top:none;">
							<h4>
								<label><?php echo $group[$kk]; ?></label>
								<input value="1" cka="mod-<?php echo $kk; ?>" type="checkbox" class="role">
								<label>全部</label>
							</h4>
							<ul class="ncap-account-container-list">
								<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vv): ?>
									<li>
										<label><input class="checkbox role" name="right[]" value="<?php echo $vv['id']; ?>" <?php if($vv['enable'] == 1): ?>checked<?php endif; ?> ck="mod-<?php echo $kk; ?>" type="checkbox"><?php echo $vv['name']; ?></label>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
			</dl>

			<dl class="row">
				<dt class="tit">
					<label for="activity_full">绑定活动</label>
				</dt>
				<dd style="margin-left:200px;">
					<div class="ncap-account-container" style="border-top:none;">
						<h4>
							<input id="activity_full" onclick="choosebox1(this)" type="checkbox">
							<label>全选</label>
						</h4>
					</div>

					<?php if(is_array($activity) || $activity instanceof \think\Collection || $activity instanceof \think\Paginator): if( count($activity)==0 ) : echo "" ;else: foreach($activity as $sho=>$sh): ?>
						<div class="ncap-account-container" style="border-top:none;">
							<h4>
								<label><?php echo $sho; ?></label>
								<!--<input value="1" type="checkbox" class="activity">-->
								<!--<label>全部</label>-->
							</h4>
							<ul class="ncap-account-container-list">
								<?php if(is_array($sh) || $sh instanceof \think\Collection || $sh instanceof \think\Paginator): if( count($sh)==0 ) : echo "" ;else: foreach($sh as $key=>$s): ?>
									<li>
										<label><input class="checkbox activity" name="a_id[]" value="<?php echo $s['id']; ?>" <?php if($s['enable'] == 1): ?>checked<?php endif; ?> ck="mod-<?php echo $kk; ?>" type="checkbox"><?php echo $s['name']; ?></label>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
			</dl>

			<div class="bot"><a href="JavaScript:void(0);" onclick="roleSubmit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
		</div>
		<input type="hidden" name="role_id" value="<?php echo $detail['role_id']; ?>">
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(":checkbox[cka]").click(function(){
			var $cks = $(":checkbox[ck='"+$(this).attr("cka")+"']");
			if($(this).is(':checked')){
				$cks.each(function(){$(this).prop("checked",true);});
			}else{
				$cks.each(function(){$(this).removeAttr('checked');});
			}
		});
	});

	function choosebox(o){
		var vt = $(o).is(':checked');
		if(vt){
			$('input.role').prop('checked',vt);
		}else{
			$('input.role').removeAttr('checked');
		}
	}

    function choosebox1(o){
        var vt = $(o).is(':checked');
        if(vt){
            $('input.activity').prop('checked',vt);
        }else{
            $('input.activity').removeAttr('checked');
        }
    }

	function roleSubmit(){
		if($('#role_name').val() == '' ){
			layer.alert('角色名称不能为空', {icon: 2});
			return false;
		}
		$('#roleform').submit();
	}
</script>
</body>
</html>