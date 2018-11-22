<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view2/index\select_goods.html";i:1542265025;s:44:"./application/admin/view2/public\layout.html";i:1542249927;}*/ ?>
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
//                            console.log(log);
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
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="ftitle">
                <h3>活动商品</h3>
                <h5>(共<?php echo (isset($pager->totalRows) && ($pager->totalRows !== '')?$pager->totalRows:0); ?>条记录)</h5>
            </div>

            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>

            <div class="tDiv2" style="padding: 0px;">

                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="addGoods()">
                        <div class="add" title="添加新商品">
                            <span><i class="fa fa-plus"></i>添加新商品</span>
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
                        <th class="sign" axis="col0">
                            <div style="width: 24px;"><i class="ico-check"></i></div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">活动商品名称</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">活动商品剩余库存</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">是否下架</div>
                        </th>
                        <!--<th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">是否使用</div>
                        </th>-->
                        <th align="center" axis="col1" class="">
                            <div style="text-align: center; width: 180px;">操作</div>
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
                <table>
                    <tbody>
                    <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td class="sign">
                                    <div style="width: 24px;"><i class="ico-check"></i></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 180px;"><?php echo $list['goods_name']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 180px;">
                                        <?php echo $list['store']; ?>
                                    </div>
                                </td>

                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;">
                                        <?php if($list[status] == 2): ?>
                                            <span class="yes" onClick="under('<?php echo $list['id']; ?>',1)"><i class="fa fa-check-circle"></i>是</span>
                                            <?php else: ?>
                                            <span class="no" onClick="under('<?php echo $list['id']; ?>',2)"><i class="fa fa-ban"></i>否</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!--<td align="center" class="">
                                    <div style="text-align: center; width: 180px;">
                                        <?php if($list["status"] == 1): ?>
                                            <span class="yes" onClick="changeTableVal('activity_goods','id','<?php echo $list['id']; ?>','status',this)"><i class="fa fa-check-circle"></i>是</span>
                                            <?php else: ?>
                                            <span class="no" onClick="changeTableVal('activity_goods','id','<?php echo $list['id']; ?>','status',this)"><i class="fa fa-ban"></i>否</span>
                                        <?php endif; ?>
                                    </div>
                                </td>-->
                                <td align="center">
                                    <div style="text-align: center; width: 180px;">
                                        <a class="btn red" href="javascript:void(0)" onclick="del('<?php echo $list[id]; ?>')"><i class="fa fa-trash-o"></i>删除</a>
                                        <a href="javascript:void(0)" onclick="edit_stores('<?php echo $list[id]; ?>','<?php echo $list[store]; ?>','<?php echo htmlspecialchars($list[goods_name]); ?>')" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    </div>
                                </td>
                                <td align="" class="" style="width: 100%;">
                                    <div></div>
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): ?>
                    <!--分页位置-->
                    <?php echo $pager->show(); endif; ?>
            </div>
        </div>
    </div>
    <script>
        function addGoods(){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            var level_id = '<?php echo (isset($level_id) && ($level_id !== '')?$level_id:0); ?>';
            var url = "<?php echo U('Admin/Index/addGoodsToActivity'); ?>?aid="+aid+'&level_id='+level_id;
            layer.open({
                type: 2,
                title: '添加活动商品',
                shadeClose: false,
                shade: 0.2,
                maxmin:true,
                area: ['550px', '500px'],
                content: url
            });
        }

        // 删除操作
        function del(id) {
            layer.confirm('你确认要删除该活动商品吗？', function ()
            {
                // 确定
                $.ajax({
                    url: "<?php echo U('Admin/Index/delActivityGoods'); ?>",
                    type: 'post',
                    data: {id: id},
                    success: function (v) {
                        layer.closeAll();
                        var v = eval('(' + v + ')');
                        if (v.hasOwnProperty('status') && (v.status == 1)) {
                            layer.msg(v.msg, {icon: 1, time: 1000}); //alert(v.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else
                            layer.msg(v.msg, {icon: 2, time: 1000}); //alert(v.msg);
                    }
                });
            }, function (index) {
                    layer.close(index);
            });
        }

        // 下架操作
        function under(id,status) {
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            var level_id = '<?php echo (isset($level_id) && ($level_id !== '')?$level_id:0); ?>';
                // 确定
            $.ajax({
                url: "<?php echo U('Admin/Index/underActivityGoods'); ?>",
                type: 'post',
                data: {id: id,aid:aid,level_id:level_id,status:status},
                success: function (v) {
                    layer.closeAll();
                    var v = eval('(' + v + ')');
                    if (v.hasOwnProperty('status') && (v.status == 1)) {
                        layer.msg(v.msg, {icon: 1, time: 1000}); //alert(v.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else
                        layer.msg(v.msg, {icon: 2, time: 1000}); //alert(v.msg);
                }
            });
        }

        //修改库存
        function edit_stores(activity_id, store_num, goods_name) {
            layer.prompt({
                formType: 0,
                value: store_num,
                title: '修改商品【' + goods_name + '】库存'
            }, function (value, index) {
                if (isNaN(value)) {
                    layer.msg('请输入数字', {icon: 2, time: 2000});
                    return false;
                }
                if (store_num == value) {
                    layer.close(index);
                } else {
                    //修改商品库存
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {id: activity_id, store_num: value},
                        url: "<?php echo U('admin/Index/editGoodStore'); ?>",
                        success: function (v) {
                            layer.close(index);
                            if (v.status == 1) {
                                layer.msg(v.msg, {icon: 1, time: 1000});
                                setTimeout(function () {
                                    location.reload();
                                }, 1000)
                            }
                            else {
                                layer.msg(v.msg, {icon: 2, time: 2000});
                            }
                        }
                    });
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