<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/goods\goodsList.html";i:1540362890;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>商品管理</h3>
        <h5>商城所有商品索引及管理</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
    <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span title="收起提示" id="explanationZoom" style="display: block;"></span>
    </div>
    <ul>
      <li></li>
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv" style="padding-bottom: 10px;">
      <div class="ftitle">
        <h3>商品列表</h3>
        <h5></h5>
      </div>
        <div class="tDiv2" style="padding: 0px;">
            <div class="fbutton">
                <a href="<?php echo U('Admin/goods/addEditGoods'); ?>">
                    <div class="add" title="添加商品">
                        <span><i class="fa fa-plus"></i>添加商品</span>
                    </div>
                </a>
            </div>
        </div>
	<form action="" id="search-form2" class="navbar-form form-inline" method="post" onSubmit="return false">
      <div class="sDiv">
        <div class="sDiv2">
          <!--<select name="is_on_sale" id="is_on_sale" class="select">
            <option value="">全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
          </select>-->
            <!--排序规则-->
          <input type="text" size="30" name="key_word" class="qsbox" placeholder="请输入商品名称">
          <input type="button" onClick="ajax_get_table('search-form2',1)" class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox">
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="sign" axis="col6">
                <div style="width: 24px;"><i class="ico-check"></i></div>
              </th>
              <th align="left" abbr="ac_id" axis="col4" class="">
                <div style="text-align: left; width: 150px;" class="">商品名称</div>
              </th>
              <th align="left" abbr="ac_id" axis="col4" class="">
                <div style="text-align: left; width: 150px;" class="">商品型号</div>
              </th>
                <th align="center" abbr="article_time" axis="col6" class="">
                    <div style="text-align: center; width: 80px;" class="">分类</div>
                </th>
                <th align="left" abbr="ac_id" axis="col4" class="">
                    <div style="text-align: left; width: 150px;" class="">商品价格</div>
                </th>
                <!--<th align="left" abbr="ac_id" axis="col4" class="">-->
                    <!--<div style="text-align: left; width: 150px;" class="">商品规格</div>-->
                <!--</th>-->
              <th align="center" abbr="article_show" axis="col6" class="">
                <div style="text-align: center; width: 200px;" class="">封面图片</div>
              </th>
                <th align="center" axis="col1" class="">
                    <div style="text-align: center; width: 150px;">操作</div>
                </th>
                <th style="width:100%" axis="col7">
                <div></div>
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>    

    <div class="bDiv" style="height: auto;">
     <!--ajax 返回 --> 
      <div id="ajax_return" cellpadding="0" cellspacing="0" border="0"></div>      
    </div>

     </div>
</div>
<script>
    $(document).ready(function(){
		// 刷选条件 鼠标 移动进去 移出 样式
		$(".hDivBox > table > thead > tr > th").mousemove(function(){
			$(this).addClass('thOver');
		}).mouseout(function(){
			$(this).removeClass('thOver');
		});
	});
</script>
<script>
    $(document).ready(function () {
        // ajax 加载商品列表
        ajax_get_table('search-form2', 1);

    });

    // ajax 抓取页面 form 为表单id  page 为当前第几页
    function ajax_get_table(form, page) {
        cur_page = page; //当前页面 保存为全局变量
        $.ajax({
            type: "POST",
            url:"<?php echo U('admin/Goods/ajaxGoodsList'); ?>?p="+page,
            data: $('#' + form).serialize(),// 你的formid
            success: function (data) {
                $("#ajax_return").html('');
                $("#ajax_return").append(data);
            }
        });
    }

    // 删除操作
    function del_goods(goods_id,obj){
        var submitS = 0;
        layer.confirm('确定要删除商品吗？',{
                btn: ['确定','取消'] //按钮
            }, function(){
                if(submitS > 0){
                    return false;
                }
                submitS ++;
                // 确定
                $.ajax({
                    type : 'post',
                    dataType:'json',
                    data:{id:goods_id},
                    url:"<?php echo U('admin/Goods/delGoods'); ?>",
                    success: function (v) {
                        layer.closeAll();
                        if (v.status == 1){
                            $(obj).parentsUntil('tr').parent().remove();
                            layer.msg(v.msg, {icon: 1, time: 2000});
                        }
                        else{
                            layer.msg(v.msg, {icon: 2, time: 2000}); //alert(v.msg);
                        }
                    }
                });
            }, function(index){
                layer.close(index);
            }
        );
    }
</script>
</body>
</html>