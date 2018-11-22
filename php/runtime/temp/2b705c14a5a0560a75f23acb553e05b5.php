<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"./application/admin/view2/orders\order_list.html";i:1542352186;s:44:"./application/admin/view2/public\layout.html";i:1542249927;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: scroll; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="margin-top: -50px;">
    <div class="flexigrid">
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="tDiv2" style="padding: 0px;">
                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="downloadOrders('<?php echo count($lists); ?>')">
                        <div class="add" title="导出数字码Excel">
                            <span><i class="fa fa-angle-down"></i>导出兑换单</span>
                        </div>
                    </a>
                </div>
            </div>
            <form action="<?php echo U('orders/order_list',array('aid'=>$aid)); ?>" id="search-form2" class="navbar-form form-inline" method="post">
                <div class="sDiv">
                    <span>订单筛选:</span>
                    <div class="sDiv2">
                        <input type="text" size="30" name="key_word" class="qsbox" placeholder="订单编号/支行/经理名称">
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
                        <th class="sign" axis="col0">
                            <div style="width: 24px;"><i class="ico-check"></i></div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">订单编号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">商品名称</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">商品型号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 30px;" class="">数量</div>
                        </th>

                        <?php if($is_level == '1'): ?>
                            <th align="center" abbr="ac_id" axis="col4" class="">
                                <div style="text-align: center; width: 100px;" class="">商品档次</div>
                            </th>
                        <?php endif; if($activity_type == '1'): ?>
                            <th align="center" abbr="ac_id" axis="col4" class="">
                                <div style="text-align: center; width: 70px;" class="">银行</div>
                            </th>
                            <th align="center" abbr="ac_id" axis="col4" class="">
                                <div style="text-align: center; width: 120px;" class="">使用的兑换码</div>
                            </th>
                            <?php else: ?>
                            <th align="center" abbr="ac_id" axis="col4" class="">
                                <div style="text-align: center; width: 70px;" class="">支行名称</div>
                            </th>
                            <th align="center" abbr="ac_id" axis="col4" class="">
                                <div style="text-align: center; width: 120px;" class="">客户经理名称</div>
                            </th>
                        <?php endif; ?>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 80px;" class="">兑换客户姓名</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">客户身份证号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 80px;" class="">兑换客户电话</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">兑换时间</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">发货时间</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 70px;" class="">发货物流</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">发货单号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 60px;" class="">收货人</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 80px;" class="">联系电话</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">详细地址</div>
                        </th>


                        <?php if(is_array($field_title) || $field_title instanceof \think\Collection || $field_title instanceof \think\Paginator): $i = 0; $__LIST__ = $field_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($i % 2 );++$i;?>
                                <th align="center" abbr="ac_id" axis="col4" class="">
                                    <div style="text-align: center; width: 120px;" class=""><?php echo $title; ?></div>
                                </th>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">备注</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 70px;">操作</div>
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
                                    <div style="text-align: center; width: 150px;"><?php echo $list['order_sn']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: left; width: 150px;"><?php echo $list['goods_name']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: left; width: 150px;"><?php echo $list['goods_name_en']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 30px;"><?php echo $list['goods_num']; ?></div>
                                </td>

                                <?php if($is_level == '1'): ?>
                                    <td align="center" class="">
                                        <div style="text-align: left; width: 100px;"><?php echo $list['level_title']; ?></div>
                                    </td>
                                <?php endif; if($activity_type == '1'): ?>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 70px;"><?php echo $list['shop_name']; ?></div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;"><?php echo $list['code']; ?></div>
                                    </td>
                                    <?php else: ?>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 70px;"><?php echo $list['bank_name']; ?></div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;"><?php echo $list['sales_name']; ?></div>
                                    </td>
                                <?php endif; ?>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;"><?php echo $list['shipping']['username']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo $list['shipping']['ID_num']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;"><?php echo $list['shipping']['user_phone']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo $list['create_time']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;">
                                        <?php if($list['shipping_time'] == '0'): ?>
                                            <span style="color:red;">未发货</span>
                                        <?php else: ?>
                                            <span style="color:green;"><?php echo date('Y-m-d H:i:s',$list['shipping_time']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width:70px;"><?php echo $list['shipping']['shipping_com']; ?></div>
                                </td>

                                <td align="center" class="">
                                    <div style="text-align: center; width: 120px;"><?php echo $list['shipping']['shipping_sn']; ?></br>
                                        <?php if($list['shipping']['shipping_sn'] != ''): ?>
                                            <a href="javascript:void(0)" onclick="checkLogistics('<?php echo $list[shipping][id]; ?>')">查询物流信息</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 60px;"><?php echo $list['shipping']['consignee']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: center; width: 80px;"><?php echo $list['shipping']['phone']; ?></div>
                                </td>
                                <td align="center" class="">
                                    <div style="text-align: left; width: 120px;"><?php echo $list['shipping']['address']; ?></div>
                                </td>

                                <?php if(is_array($list['shipping']['new_field']) || $list['shipping']['new_field'] instanceof \think\Collection || $list['shipping']['new_field'] instanceof \think\Paginator): $i = 0; $__LIST__ = $list['shipping']['new_field'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ship): $mod = ($i % 2 );++$i;if(empty($list['shipping']['new_field']) != true): ?>
                                        <td align="center" class="">
                                            <div style="text-align: left; width: 120px;"><?php echo $ship['content']; ?></div>
                                        </td>
                                        <?php else: ?>
                                        <td align="center" class="">
                                            <div style="text-align: left; width: 120px;"></div>
                                        </td>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                <td align="center" class="">
                                    <div style="text-align: left; width: 120px;"><?php echo $list['shipping']['remarks']; ?></div>
                                </td>

                                <?php if($list['shipping_time'] == '0'): ?>
                                    <td align="center">
                                        <div style="text-align: center; width: 70px;">
                                            <a class="btn blue" href="javascript:void(0)" onclick="doShipping('<?php echo $list[id]; ?>')"><i class="fa fa-plane"></i>发货</a>
                                            <a class="btn blue" href="javascript:void(0)" onclick="doDelete('<?php echo $list[id]; ?>')"><i class="fa fa-close"></i>删除</a>
                                        </div>
                                    </td>
                                <?php endif; ?>

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
         * 导出兑换单
         * @param batch
         * @param num
         * @param type
         * @returns {boolean}
         */
        function downloadOrders(num){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            if(num <= 0){
                layer.msg('还没有订单的噢', {icon: 2, time: 3000});
                return false;
            }

            window.location.href = '<?php echo url("Admin/Orders/order_list"); ?>?export=1&aid='+aid;
        }

        // ajax 抓取页面 form 为表单id  page 为当前第几页
        function ajax_get_table(form, page) {
            cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type: "POST",
                url:"<?php echo U('admin/Order/ajaxOrderList'); ?>?p="+page,
                data: $('#' + form).serialize(),// 你的formid
                success: function (data) {
                    $("#ajax_return").html('');
                    $("#ajax_return").append(data);
                }
            });
        }

        function doShipping(id){
            var url = "<?php echo U('Admin/Orders/do_shipping'); ?>?oid="+id;
            layer.open({
                type: 2,
                title: '订单发货',
                shadeClose: false,
                shade: 0.2,
                area: ['600px', '450px'],
                content: url
            });
        }

        function doDelete(id){
            var url = "<?php echo U('Admin/Orders/do_delete'); ?>?oid="+id;
            layer.confirm('你确认要删除该订单吗？删除后不可恢复', function ()
            {
                // 确定
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {'oid':id},
                    success: function (v) {
                        layer.closeAll();
                        if (v.status == 1) {
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
        
        function checkLogistics(shipping_id) {
            var url = "<?php echo U('Admin/Orders/check_logistics'); ?>?shipping_id="+shipping_id;
            layer.open({
                type: 2,
                title: '订单发货',
                shadeClose: false,
                shade: 0.2,
                area: ['600px', '450px'],
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