<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/goods\_category.html";i:1539158653;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3>商品分类 - 添加修改分类</h3>
        <h5>添加或编辑商品分类</h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span>
    </div>
    <ul>
      <li>温馨提示：目前前端只支持顶级分类展示</li>
    </ul>
  </div>
  <form action="<?php echo U('Goods/addEditCategory'); ?>" method="post" class="form-horizontal" id="category_form">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="t_mane"><em>*</em>分类名称</label>
        </dt>
        <dd class="opt">
          <input type="text" placeholder="分类名称" class="input-txt" name="name" value="<?php echo $goods_category_info['name']; ?>">
          <span class="err" id="err_name" style="color:#F00; display:none;"></span>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label>副名称</label>
        </dt>
        <dd class="opt">
          <input type="text" placeholder="分类英文名称" class="input-txt" name="name_en" value="<?php echo $goods_category_info['name_en']; ?>">
        </dd>
      </dl>
      <div class="bot"><a id="submitBtn" class="ncap-btn-big ncap-btn-green" href="JavaScript:void(0);" onClick="ajax_submit_form('category_form','<?php echo U('Goods/addEditCategory?is_ajax=1'); ?>');">确认提交</a></div>
    </div>
    <input type="hidden" name="id" value="<?php echo $goods_category_info['id']; ?>">
  </form>
</div>
<script>  
    

$(document).ready(function(){
  <?php if(!(empty($goods_category_info) || (($goods_category_info instanceof \think\Collection || $goods_category_info instanceof \think\Paginator ) && $goods_category_info->isEmpty()))): ?>
    /** 以下是编辑时默认选中某个商品分类*/
    <?php if($level_cat['2'] > 0): ?>
      // 如果当前是二级分类就让一级父id默认选中
      $("#parent_id_1").val('<?php echo $level_cat[1]; ?>');
      get_category('<?php echo $level_cat[1]; ?>','parent_id_2','0');
    <?php endif; if($level_cat['3'] > 0): ?>
      // 如果当前是三级分类就一级和二级父id默认 都选中
      $("#parent_id_1").val('<?php echo $level_cat[1]; ?>');
      get_category('<?php echo $level_cat[1]; ?>','parent_id_2','<?php echo $level_cat[2]; ?>');
    <?php endif; else: if($level_cat['1'] > 0): ?>
      // 如果当前是二级分类就让一级父id默认选中
      $("#parent_id_1").val('<?php echo $level_cat[1]; ?>');
      get_category('<?php echo $level_cat[1]; ?>','parent_id_2','0');
    <?php endif; if($level_cat['2'] > 0): ?>
      // 如果当前是三级分类就一级和二级父id默认 都选中
      $("#parent_id_1").val('<?php echo $level_cat[1]; ?>');
      get_category('<?php echo $level_cat[1]; ?>','parent_id_2','<?php echo $level_cat[2]; ?>');
    <?php endif; endif; ?>
});

// 将品牌滚动条里面的 对应分类移动到 最上面
//javascript:document.getElementById('category_id_3').scrollIntoView();
var typeScroll = 0;
function spec_scroll(o){
	var id = $(o).val();	
	//if(!$('#type_id_'+id).is('dt')){
		//return false;
	//} 	 
	$('#ajax_brandList').scrollTop(-typeScroll);
	var sp_top = $('#type_id_'+id).offset().top; // 标题自身往上的 top
	var div_top = $('#ajax_brandList').offset().top; // div 自身往上的top
	$('#ajax_brandList').scrollTop(sp_top-div_top); // div 移动
	typeScroll = sp_top-div_top;
}

function img_call_back(fileurl_tmp)
{
  $("#image").val(fileurl_tmp);
  $("#img_a").attr('href', fileurl_tmp);
  $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
}
</script>
</body>
</html>