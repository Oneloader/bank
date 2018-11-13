<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view2/orders\do_shipping.html";i:1541389973;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto; ">
<div>
    <!-- 操作说明 -->
    <div id="explanation" class="explanation"
         style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 95%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
            <li></li>
        </ul>
    </div>

    <form method="post" class="form-horizontal" id="branch_form">
        <input type="hidden" name="oid" value="<?php echo (isset($oid) && ($oid !== '')?$oid:0); ?>" />
        <input type="hidden" name="shipping_id" value="<?php echo (isset($info['shipping_id']) && ($info['shipping_id'] !== '')?$info['shipping_id']:0); ?>" />
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="consignee"><em>*</em>收货人姓名：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="consignee" class="input-txt" name="consignee" value="<?php echo $info['consignee']; ?>" >
                    <span class="err" id="err_consignee" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="phone"><em>*</em>联系电话：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="phone" class="input-txt" name="phone" value="<?php echo $info['phone']; ?>" >
                    <span class="err" id="err_phone" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="address"><em>*</em>收货地址：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="address" class="input-txt" name="address" value="<?php echo $info['address']; ?>" >
                    <span class="err" id="err_address" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="shipping_com"><em>*</em>快递公司：</label>
                </dt>
                <dd class="opt">
                    <div>
                        <select name="shipping_com" id="shipping_com" class="input-txt class-select valid">
                            <option value="-1">请选择快递公司</option>
                            <?php if(is_array($shipping_coms) || $shipping_coms instanceof \think\Collection || $shipping_coms instanceof \think\Paginator): $i = 0; $__LIST__ = $shipping_coms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $key; ?>"><?php echo $v; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <option value="0">其他快递</option>
                        </select>
                    </div>
                    <span class="err" id="err_shipping_com" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <div id="shipping_names">
                <dl class="row">
                    <dt class="tit">
                        <label for="shipping_name"><em>*</em>快递公司名称：</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" id="shipping_name" class="input-txt" name="shipping_name" value="<?php echo $info['shipping_com']; ?>" >
                        <span class="err" id="err_shipping_name" style="color:#F00; display:none;"></span>
                    </dd>
                </dl>
            </div>

            <dl class="row">
                <dt class="tit">
                    <label for="shipping_sn"><em>*</em>发货单号：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="shipping_sn" class="input-txt" name="shipping_sn" value="<?php echo $info['shipping_sn']; ?>" >
                    <span class="err" id="err_shipping_sn" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <div class="bot">
                <a id="submitBtn" data-status="0" style="margin:20px 90px;" class="ncap-btn-big ncap-btn-green"
                   href="JavaScript:void(0);">确认提交</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var chkObjs1 = $('#shipping_com option:selected') .val();
        if(chkObjs1==0){
            $('#shipping_names').show();
        }else{
            $("#shipping_names").hide();
        }
        $('#shipping_com').click(function () {
            var chkObjs = $('#shipping_com option:selected') .val();
            if(chkObjs!=0){
                $('#shipping_names').hide();
            }else{
                $('#shipping_names').show();
            }
        });
    });
</script>
<script>
    $(function(){
        $('#submitBtn').click(function(){
            $('#branch_form').submit();
        });

        $("#branch_form").validate({
            debug: false, //调试模式取消submit的默认提交功能
            focusInvalid: false, //当为false时，验证无效时，没有焦点响应
            onkeyup: false,
            submitHandler: function(form){   //表单提交句柄,为一回调函数，带一个参数：form
                $.ajax({
                    url:"<?php echo U('Admin/Orders/save_shipping'); ?>",
                    type:'post',
                    dataType:'json',
                    data: $("#branch_form").serialize(),
                    success:function(obj){
                        if(obj.status !=1){
                            layer.msg(obj.msg, {icon: 2, time: 5000}); //alert(v.msg);
                        }else{
                            layer.msg(obj.msg, {icon: 1, time: 1000}); //alert(v.msg);
                            setTimeout(function(){
                                parent.location.reload();
                            },1000);
                        }
                    }
                });
            },
            ignore:":button",	//不验证的元素
            rules:{
                username:{
                    required:true
                },
                phone:{
                    required:true
                },
                address:{
                    required:true
                },
                shipping_sn:{
                    required:true
                },
                shipping_com:{
                    required:true
                }
            },
            messages:{
                username:{
                    required:"请输入收货人姓名"
                },
                phone:{
                    required:"请输入收货人手机号码"
                },
                address:{
                    required:"请输入收货人详细地址"
                },
                shipping_sn:{
                    required:"请输入发货单号"
                },
                shipping_com:{
                    required:"请选择快递公司"
                }
            }
        });
    });

    function img_call_back(fileurl_tmp)
    {
        $("#img").val(fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }
</script>