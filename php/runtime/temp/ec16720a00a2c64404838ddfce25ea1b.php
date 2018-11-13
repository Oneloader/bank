<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/index\pubs_list.html";i:1540378623;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<script type="text/javascript">
    var SITEURL = window.location.host +'/admin';
</script>
<script type="text/javascript" src="__PUBLIC__/static/js/dialog/dialog.js" id="dialog_js"></script>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">

    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>银行管理</h3>
                <h5>所有银行</h5>
            </div>
        </div>
    </div>

    <!-- 操作说明 -->
    <div id="explanation" class="explanation"
         style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
            <li>银行列表</li>
        </ul>
    </div>

    <div class="flexigrid">
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="ftitle">
                <h3>银行列表</h3>
                <h5>(共<?php echo (isset($pager->totalRows) && ($pager->totalRows !== '')?$pager->totalRows:0); ?>条记录)</h5>
            </div>

            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>

            <div class="tDiv2" style="padding: 0px;">
                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="CUR_DIALOG = ajax_form('pubsadd', '添加银行', '<?php echo U('Index/pubs_add'); ?>');" >
                        <div class="add" title="新增银行">
                            <span><i class="fa fa-plus"></i>新增银行</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">银行名称</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">银行Logo</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 450px;" class="">客户经理登录地址</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 100px;" class="">添加时间</div>
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
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <?php if(!(empty($shops) || (($shops instanceof \think\Collection || $shops instanceof \think\Paginator ) && $shops->isEmpty()))): ?>
                    <table>
                        <tbody>
                        <?php if(is_array($shops) || $shops instanceof \think\Collection || $shops instanceof \think\Paginator): $i = 0; $__LIST__ = $shops;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo $list['name']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;">
                                        <img width="100" src="<?php echo $list['logo']; ?>" title="<?php echo $list['name']; ?>" />
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 450px;"><?php echo $list['site_url']; ?>
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 100px;"><?php echo $list['add_time']; ?></div>
                                </td>
                                <td align="center">
                                    <div style="text-align: center; width: 150px;">
                                        <a href="javascript:void(0)" onclick="CUR_DIALOG = ajax_form('pubsadd', '编辑银行信息', '<?php echo U('Index/pubs_edit',array('sid'=>$list['id'])); ?>');" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                        <a href="<?php echo $list['url']; ?>" class="btn blue" target="_top"><i class="fa fa-cogs"></i>管理</a>
                                        <a class="btn red" href="javascript:void(0)" onclick="del_pubs('<?php echo $list[id]; ?>')"><i class="fa fa-trash-o"></i>删除</a>
                                    </div>
                                </td>
                                <td align="" class="" style="width: 100%;">
                                    <div></div>
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <!--分页位置-->
                    <?php echo $pager->show(); endif; ?>
            </div>
        </div>
    </div>
    <script>
        // 删除操作
        function del_pubs(pubs_id){
            var submitS = 0;
            layer.confirm('确定要删除该银行吗？',{
                    btn: ['确定','取消'] //按钮
                }, function(){
                    if(submitS > 0){
                        return false;
                    }
                    submitS ++;
                    // 确定
                    $.ajax({
                        type : 'get',
                        dataType:'json',
                        data:{id:pubs_id},
                        url:"<?php echo U('Index/pubs_del'); ?>",
//                        ,array('sid'=>"+pubs_id+")
                        success: function (v) {
                            if (v.status == 1){
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