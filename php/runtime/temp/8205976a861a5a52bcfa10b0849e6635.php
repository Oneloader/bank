<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"./application/admin/view2/index\sales_exchange.html";i:1540376983;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
                <h3>活动列表</h3>
                <h5>活动管理</h5>
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
            <li>客户经理直接发放商品给客户</li>
        </ul>
    </div>

    <div class="flexigrid">
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="ftitle">
                <h3>活动列表</h3>
                <h5>(共<?php echo (isset($pager->totalRows) && ($pager->totalRows !== '')?$pager->totalRows:0); ?>条记录)</h5>
            </div>

            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>

            <div class="tDiv2" style="padding: 0px;">

                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="addBank(0)">
                        <div class="add" title="新增活动">
                            <span><i class="fa fa-plus"></i>新增活动</span>
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
                            <div style="text-align: center; width: 150px;" class="">活动名称</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">内页banner图</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 120px;" class="">开始时间</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 120px;" class="">结束时间</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">是否显示价格</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">是否开放</div>
                        </th>
                        <th align="center" axis="col1" class="">
                            <div style="text-align: center; width: 300px;">操作</div>
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
                                    <div style="text-align: center; width: 150px;"><?php echo $list['name']; ?></div>
                                </td>

                                <td align="center" class="">
                                    <div style="text-align: center; width: 150px;">
                                        <img width="100" src="<?php echo $list['back_img']; ?>" alt="<?php echo $list['name']; ?>" />
                                    </div>
                                </td>

                                <td align="left" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i:s',$list['start_time']); ?></div>
                                </td>
                                <td align="left" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i:s',$list['end_time']); ?></div>
                                </td>

                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;">
                                        <?php if($list[is_price] == 1): ?>
                                            <span class="yes" onClick="changeTableVal('activity','id','<?php echo $list['id']; ?>','is_price',this)"><i class="fa fa-check-circle"></i>是</span>
                                            <?php else: ?>
                                            <span class="no" onClick="changeTableVal('activity','id','<?php echo $list['id']; ?>','is_price',this)"><i class="fa fa-ban"></i>否</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;">
                                        <?php if($list[status] == 1): ?>
                                            <span class="yes" onClick="changeTableVal('activity','id','<?php echo $list['id']; ?>','status',this)"><i class="fa fa-check-circle"></i>是</span>
                                            <?php else: ?>
                                            <span class="no" onClick="changeTableVal('activity','id','<?php echo $list['id']; ?>','status',this)"><i class="fa fa-ban"></i>否</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td align="left">
                                    <div style="text-align: left; width: 300px;">
                                        <a class="btn red" href="javascript:void(0)" onclick="del('<?php echo $list[id]; ?>')"><i class="fa fa-trash-o"></i>删除</a>
                                        <a href="javascript:void(0)" onclick="addBank('<?php echo $list[id]; ?>')" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                        <a href="javascript:void(0)" onclick="viewAuth('<?php echo $list[id]; ?>')" class="btn blue"><i class="fa fa-group"></i>授权</a>
                                        <!--<a href="javascript:void(0)" onclick="viewInfo('<?php echo $list[id]; ?>')" class="btn blue"><i class="fa fa-eye"></i>兑换详情</a>-->
                                        <?php if($list['is_level'] == '1'): ?>
                                            <a href="javascript:void(0)" onclick="setLevel('<?php echo $list[id]; ?>')" class="btn blue"><i class="fa fa-list-ol"></i>设置档次</a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" onclick="viewGoods('<?php echo $list[id]; ?>')" class="btn blue"><i class="fa fa-gift"></i>查看商品</a>
                                        <?php endif; ?>
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
        function viewInfo(id){
            var url = "<?php echo U('Admin/Index/exchange_list'); ?>?id="+id;
            layer.open({
                type: 2,
                title: '兑换列表',
                shadeClose: false,
                shade: 0.2,
                area: ['1000px', '550px'],
                content: url
            });
        }

        function setLevel(id){
            var url = "<?php echo U('Admin/Bank/change_level'); ?>?aid="+id;
            layer.open({
                type: 2,
                title: '活动档次列表',
                shadeClose: false,
                shade: 0.2,
                area: ['1100px', '580px'],
                content: url
            });
        }

        function addBank(id){
            var url = "<?php echo U('Admin/Index/addEditSalesExchange'); ?>?id="+id+"&type=2";
            layer.open({
                type: 2,
                title: '添加/编辑活动',
                shadeClose: false,
                shade: 0.2,
                area: ['650px', '550px'],
                content: url
            });
        }

        function viewGoods(id){
            var url = "<?php echo U('Admin/Index/select_goods'); ?>?aid="+id;
            layer.open({
                type: 2,
                title: '查看活动商品',
                shadeClose: false,
                shade: 0.2,
                area: ['1000px', '550px'],
                content: url
            });
        }

        function viewAuth(id){
            var url = "<?php echo U('Admin/Index/authorityList'); ?>?aid="+id;
            layer.open({
                type: 2,
                title: '设置活动权限',
                shadeClose: false,
                shade: 0.2,
                area: ['1000px', '550px'],
                content: url
            });
        }

        // 删除操作
        function del(id) {
            layer.confirm('你确认要删除该活动吗？', function ()
            {
                // 确定
                $.ajax({
                    url: "<?php echo U('Admin/Index/sales_exchange_del'); ?>",
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
                            layer.msg(v.msg, {icon: 2, time: 3000}); //alert(v.msg);
                    }
                });
            }, function (index) {
                    layer.close(index);
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