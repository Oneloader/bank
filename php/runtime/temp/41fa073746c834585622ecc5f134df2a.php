<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/index\sales_list.html";i:1539138094;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<div class="page" style="margin-top: -50px;">
    <div class="flexigrid">
        <div class="mDiv">
            <form class="navbar-form form-inline"  method="post" action="<?php echo U('Admin/Index/addEditAuth'); ?>"  name="search-form2" id="search-form2">
                <input type="hidden" name="aid" value="<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>" />
                <div class="sDiv">
                    <div class="sDiv2">
                        <select name="branch_id" id="branch_id" class="select">
                            <option value="">所有分行</option>
                            <?php if(is_array($branches) || $branches instanceof \think\Collection || $branches instanceof \think\Paginator): if( count($branches)==0 ) : echo "" ;else: foreach($branches as $key=>$v): ?>
                                <option value="<?php echo $key; ?>" <?php if($key == $branch_id): ?>selected<?php endif; ?> ><?php echo $v; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="sDiv2" style="border:0px">
                        <input type="text" name="keywords" value="<?php echo $keywords; ?>" placeholder="请输入销售经理姓名关键字" class="input-txt">
                    </div>
                    <div class="sDiv2" style="border:0px">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                </div>
            </form>
        </div>

        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th abbr="article_title" axis="col3" class="" align="left">
                            <div style="text-align: left; width: 50px;" class="">
                                <input type="checkbox" onclick="$('input[name*=\'sales_ids\']').prop('checked', this.checked);">
                            </div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">销售经理名称</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">所属分行</div>
                        </th>

                        <th style="width:100%" axis="col7">
                            <div></div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="bDiv" style="height: auto;padding-bottom:0px; ">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <form id="branch_form">
                    <input type="hidden" name="aid" value="<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>" />
                    <table>
                        <tbody>
                        <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td class="" align="left">
                                        <div style="text-align: left; width: 50px;">
                                            <input type="checkbox" name="sales_ids[]" value="<?php echo $list['id']; ?>"/>
                                        </div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 180px;"><?php echo $list['name']; ?></div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 180px;"><?php echo $branches[$list['branch_id']]; ?></div>
                                    </td>

                                    <td align="" class="" style="width: 100%;">
                                        <div></div>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; else: ?>
                            <tr>
                                <td class="no-data" align="center" axis="col0" colspan="50">
                                    <i class="fa fa-exclamation-circle"></i>没有可选的销售经理了
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): ?>
            <div class="bot">
                <a onclick="select_goods();" data-status="0" style="margin:20px 90px;" class="ncap-btn-big ncap-btn-green" href="JavaScript:void(0);">确认提交</a>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function select_goods()
        {
            if($("input[type='checkbox']:checked").length == 0)
            {
                layer.alert('请选择销售经理', {icon: 2});
                return false;
            }
            $.ajax({
                url:"<?php echo U('Admin/Index/addEditAuth'); ?>",
                type:'post',
                dataType:'json',
                data: $("#branch_form").serialize(),
                success:function(obj){
                    if(obj.status !=1){
                        layer.msg(obj.msg, {icon: 2, time: 3000}); //alert(v.msg);
                    }else{
                        layer.msg(obj.msg, {icon: 1, time: 1000}); //alert(v.msg);
                        setTimeout(function(){
                            parent.location.reload();
                        },1000);
                    }
                }
            });
        }

        $(document).ready(function () {
            // 点击刷新数据
            $('.fa-refresh').click(function () {
                location.href = location.href;
            });
        });
    </script>
</body>
</html>