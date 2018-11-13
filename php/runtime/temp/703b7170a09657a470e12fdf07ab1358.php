<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"./application/admin/view2/code\code_list.html";i:1539767773;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="ftitle">
                <h3>兑换码</h3>
                <h5>(共<?php echo (isset($pager->totalRows) && ($pager->totalRows !== '')?$pager->totalRows:0); ?>条记录)</h5>
            </div>

            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>

            <div class="tDiv2" style="padding: 0px;">

                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="addGoods()">
                        <div class="add" title="生成新兑换码">
                            <span><i class="fa fa-plus"></i>生成新兑换码</span>
                        </div>
                    </a>
                </div>
                <!--<div class="fbutton">
                    <a href="javascript:void(0)" onclick="export_goods()">
                        <div class="add" title="导入兑换码">
                            <span><i class="fa fa-upload"></i>导入兑换码</span>
                        </div>
                    </a>
                </div>-->
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
                            <div style="text-align: center; width: 150px;" class="">兑换码批次编号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">兑换码所属档次</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">兑换码总数</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">已使用数量</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">待使用数量</div>
                        </th>
                        <th align="center" axis="col1" class="">
                            <div style="text-align: center; width: 280px;">操作</div>
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
                                    <div style="text-align: center; width: 150px;"><?php echo $list['batch']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo $levels[$list['level_id']]; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;">
                                        <?php echo (isset($list['total']) && ($list['total'] !== '')?$list['total']:0); ?>
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;">
                                        <?php echo (isset($list['used']) && ($list['used'] !== '')?$list['used']:0); ?>
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;">
                                        <?php echo (isset($list['not_use']) && ($list['not_use'] !== '')?$list['not_use']:0); ?>
                                    </div>
                                </td>
                                <td align="center">
                                    <div style="text-align: center; width: 280px;">
                                        <a class="btn blue" href="javascript:void(0)" onclick="viewCodes('<?php echo $list[batch]; ?>')"><i class="fa fa-eye"></i>查看详情</a>
                                        <a class="btn blue" href="javascript:void(0)" onclick="downloadErcodes('<?php echo $list[batch]; ?>','<?php echo $list['used'] + $list['not_use']; ?>',1)"><i class="fa fa-download"></i>下载二维码</a>
                                        <a class="btn blue" href="javascript:void(0)" onclick="downloadErcodes('<?php echo $list[batch]; ?>','<?php echo $list['used'] + $list['not_use']; ?>',0)"><i class="fa fa-angle-down"></i>导出数字码</a>
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
        /**
         * 导出兑换码
         * @param batch
         * @param num
         * @param type
         * @returns {boolean}
         */
        function downloadErcodes(batch,num,type){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            if(num <= 0){
                layer.msg('请先创建兑换码', {icon: 2, time: 3000});
                return false;
            }

            window.location.href = '<?php echo url("Admin/Code/codes"); ?>?export=1&aid='+aid+'&batch='+batch+'&type='+type;
        }

        function addGoods(){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            var level_id = '<?php echo (isset($level_id) && ($level_id !== '')?$level_id:0); ?>';
            var url = "<?php echo U('Admin/Code/addCodes'); ?>?aid="+aid+'&level_id='+level_id;
            layer.open({
                type: 2,
                title: '生成新兑换码',
                shadeClose: false,
                shade: 0.2,
                area: ['550px', '500px'],
                content: url
            });
        }

        function export_goods(){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            var level_id = '<?php echo (isset($level_id) && ($level_id !== '')?$level_id:0); ?>';
            var url = "<?php echo U('Admin/Code/importCodes'); ?>?aid="+aid+'&level_id='+level_id;
            layer.open({
                type: 2,
                title: '导入新兑换码',
                shadeClose: false,
                shade: 0.2,
                area: ['550px', '500px'],
                content: url
            });
        }

        function viewCodes(batch){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            var url = "<?php echo U('Admin/Code/codes'); ?>?aid="+aid+'&batch='+batch;
            layer.open({
                type: 2,
                title: '查看兑换码【'+batch+'】列表',
                shadeClose: false,
                shade: 0.2,
                area: ['900px', '500px'],
                content: url
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