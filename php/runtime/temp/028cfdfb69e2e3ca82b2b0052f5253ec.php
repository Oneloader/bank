<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"./application/admin/view2/index\_sales_exchange.html";i:1541675841;s:44:"./application/admin/view2/public\layout.html";i:1542249927;}*/ ?>
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
            <li>活动将根据配置好的有效期，自动上下线。</li>
            <li>如果需要活动商品分档次兑换，请在活动列表页配置该活动的档次</li>
        </ul>
    </div>

    <form method="post" class="form-horizontal" id="branch_form">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="name"><em>*</em>活动名称：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="name" placeholder="请输入活动名称" class="input-txt" name="name" value="<?php echo $info['name']; ?>">
                    <span class="err" id="err_name" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <?php if($type == 1): ?>
                        <label><em>*</em>首页背景图：</label>
                        <?php else: ?><label><em>*</em>活动封面图：</label>
                    <?php endif; ?>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
                        <span class="show">
                            <a id="img_a" class="nyroModal" rel="gal" href="javascript:void(0)">
                                <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['img']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="img" name="img" value="<?php echo $info['img']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','activity','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <span class="err" id="err_img"></span>

                    <?php if($type == 1): ?>
                        <p class="notic">请上传750px*1215px大小图片格式文件</p>
                        <?php else: ?><p class="notic">请上传750px*350px大小图片格式文件</p>
                    <?php endif; ?>

                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>内页banner图：</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
                        <span class="show">
                            <a id="img_b" class="nyroModal" rel="gal" href="javascript:void(0)">
                                <i id="img_back" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['back_img']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
                        <span class="type-file-box">
                            <input type="text" id="back_img" name="back_img" value="<?php echo $info['back_img']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button2" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','activity','img_call_back1')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <span class="err" id="err_img"></span>
                    <p class="notic">请上传750px*350px大小图片格式文件</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>内页背景色：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="text-field" class="demo" name="back_color" value="<?php echo $info['back_color']; ?>">
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>显示商品价格：</label>
                </dt>
                <dd class="opt">
                    <input type="radio" value="0" name="is_price" <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?> disabled <?php endif; ?>checked />&nbsp;否&emsp;&emsp;
                    <input type="radio" value="1" name="is_price" <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?> disabled <?php endif; if($info['is_price'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                    <p class="notic">前端页面是否显示商品价格</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>显示商品库存：</label>
                </dt>
                <dd class="opt">
                    <input type="radio" value="0" name="is_stock" checked />&nbsp;否&emsp;&emsp;
                    <input type="radio" value="1" name="is_stock" <?php if($info['is_stock'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                    <p class="notic">前端页面是否显示商品库存</p>
                </dd>
            </dl>


            <?php if($type == 1): else: ?>
                <dl class="row">
                    <dt class="tit">
                        <label><em>*</em>是否选择商品数量：</label>
                    </dt>
                    <dd class="opt">
                        <input type="radio" value="0" name="choice_num" checked />&nbsp;否&emsp;&emsp;
                        <input type="radio" value="1" name="choice_num" <?php if($info['choice_num'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                        <p class="notic">订单页面是否选择商品数量(如果不能选择数量,默认选择商品数量为1)</p>
                    </dd>
                </dl>
            <?php endif; ?>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>商品档次：</label>
                </dt>
                <dd class="opt">
                    <input type="radio" value="0" name="is_level" <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?> disabled <?php endif; ?>checked />&nbsp;否&emsp;&emsp;
                    <input type="radio" value="1" name="is_level" <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?> disabled <?php endif; if($info['is_level'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                    <p class="notic">活动商品是否需要分为不同档次商品兑换</p>
                </dd>
            </dl>

            <div id="is_ID">
                <dl class="row">
                    <dt class="tit">
                        <label><em>*</em>订单客户姓名、<br>身份证号是否显示：</label>
                    </dt>
                    <dd class="opt">
                        <input type="radio" value="0" class="must_name_id" name="must_name_id" checked />&nbsp;否&emsp;&emsp;
                        <input type="radio" value="1" class="must_name_id" name="must_name_id" <?php if($info['must_name_id'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                        <p class="notic">订单页面是否显示客户姓名、身份证号(如果显示则是必填)</p>
                    </dd>
                </dl>
            </div>

            <dl class="row" id="IDnum_length">
                <dt class="tit">
                    <label for="name"><em>*</em>身份证位数：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="id_length" placeholder="请输入需要用户输入的身份证位数" class="input-txt" name="id_length" value="<?php echo $info['id_length']; ?>">
                    <span class="err" id="err_id_length" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <div>
                <dl class="row">
                    <dt class="tit">
                        <label><em>*</em>订单客户电话是否显示：</label>
                    </dt>
                    <dd class="opt">
                        <input type="radio" value="0" class="must_user_phone" name="must_user_phone" checked />&nbsp;否&emsp;&emsp;
                        <input type="radio" value="1" class="must_user_phone" name="must_user_phone" <?php if($info['must_user_phone'] == '1'): ?>checked<?php endif; ?> />&nbsp;是
                        <p class="notic">订单页面是否显示客户电话(如果显示则是必填)</p>
                    </dd>
                </dl>
            </div>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>开始时间：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="start_time" name="start_time" value="<?php echo date('Y-m-d H:i:s',$info['start_time']); ?>"  class="input-txt">
                    <span class="err" id="err_start_time"></span>
                    <p class="notic">活动开始时间</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>结束时间：</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="end_time" name="end_time" value="<?php echo date('Y-m-d H:i:s',$info['end_time']); ?>" class="input-txt">
                    <span class="err" id="err_end_time"></span>
                    <p class="notic">活动结束时间</p>
                </dd>
            </dl>

            <?php if(empty($new_field) != true): if(is_array($new_field) || $new_field instanceof \think\Collection || $new_field instanceof \think\Paginator): if( count($new_field)==0 ) : echo "" ;else: foreach($new_field as $k=>$vo): ?>
                    <dl class="row" id="dl_<?php echo $k; ?>">
                        <dt class="tit">
                            <label><em>*</em>标题：</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" id='new_field[<?php echo $k; ?>][title]' name='new_field[<?php echo $k; ?>][title]' value="<?php echo $vo['title']; ?>" class="input-txt">
                            <span class="err" id=""></span>
                            <p class="notic">用于前端页面显示</p>
                        </dd>

                        <!--<dt class="tit">-->
                            <!--<label><em>*</em>字段英文名：</label>-->
                        <!--</dt>-->
                        <!--<dd class="opt">-->
                            <!--<input type="text" id="new_field[<?php echo $k; ?>][en_title]" name="new_field[<?php echo $k; ?>][en_title]" value="<?php echo $vo['en_title']; ?>" class="input-txt">-->
                            <!--<span class="err" id=""></span>-->
                            <!--<p class="notic">唯一标识</p>-->
                        <!--</dd>-->
                        <input type="hidden" value="<?php echo $info['id']; ?>" id="a_id">

                        <dt class="tit">
                            <label><em>*</em>提示：</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" id="new_field[<?php echo $k; ?>][remarks]" name="new_field[<?php echo $k; ?>][remarks]" value="<?php echo $vo['remarks']; ?>" class="input-txt">
                            <a class="ncap-btn-mini ncap-btn-red del_field" id="<?php echo $k; ?>" href="javascript:void(0)">删除</a>
                            <span class="err" id=""></span>
                            <p class="notic">用于前端页面提示用户</p>
                        </dd>
                    </dl>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            <input type="hidden" id='num' name="num" value="<?php echo $k; ?>">
            <span id="field"></span>

            <dl class="row">
                <dt class="tit">
                    <label>自定义字段：</label>
                </dt>
                <dd class="opt">
                    <a id="addBtn" style="" class="ncap-btn-big ncap-btn-green"
                       href="JavaScript:void(0);">新增</a>
                    <!--<span id="field"></span>-->
                </dd>
            </dl>

            <div class="bot">
                <a id="submitBtn" data-status="0" style="margin:20px 90px;" class="ncap-btn-big ncap-btn-green"
                   href="JavaScript:void(0);">确认提交</a>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:0); ?>">
        <?php if(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty())): ?>
            <input type="hidden" name="type" value="<?php echo (isset($type) && ($type !== '')?$type:0); ?>">
        <?php endif; ?>
    </form>
</div>
</body>
</html>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<script type="text/javascript">
        var index = 0;
        var num = $('#num').val();
    $('#addBtn').click(function () {
//            <dl class="row">
//                <dt class="tit">
//                <label></label>
//                </dt>
//                <dd class="opt">
//                <a id="addBtn" style="margin:0px 90px;" class="ncap-btn-big ncap-btn-green"
//            href="JavaScript:void(0);">+</a>
//                <span id="field"></span>
//                </dd>
//                </dl>
//            <dl class="row">
//                <dt class="tit">
//                <label><em>*</em>字段名：</label>
//                </dt>
//                <dd class="opt">
//                    <input type="text" id="" name="end_time" value="" class="input-txt">
//                    <span class="err" id=""></span>
//                    <p class="notic">用于前端页面显示</p>
//                    </dd>
//
//                    <dt class="tit">
//                    <label><em>*</em>字段英文名：</label>
//                </dt>
//                <dd class="opt">
//                    <input type="text" id="" name="end_time" value="" class="input-txt">
//                    <span class="err" id=""></span>
//                    <p class="notic">唯一标识</p>
//                    </dd>
//
//                    <dt class="tit">
//                    <label><em>*</em>字段备注：</label>
//                </dt>
//                <dd class="opt">
//                    <input type="text" id="" name="end_time" value="" class="input-txt">
//                    <span class="err" id=""></span>
//                    <p class="notic">用于前端页面提示用户</p>
//                </dd>
//            </dl>
        if(num == null){
            var index = 0;
        }else{
            var index = num++;
        }
        $("#field").before(
            "<dl class='row'>" +
            "<dt class='tit'><label><em>*</em>标题：</label></dt>" +
            "<dd class='opt'>" +
            "<input type='text' id='new_field[" + ++index + "][title]' name='new_field[" + index + "][title]' value='' class='input-txt'>" +
            "<span class='err' id=''></span>" +
            "<p class='notic'>用于前端页面显示</p>" +
            "</dd>" +

//            "<dt class='tit'><label><em>*</em>字段英文名：</label></dt>" +
//            "<dd class='opt'>" +
//            "<input type='text' id='new_field[" + index + "][en_title]' name='new_field[" + index + "][en_title]' value='' class='input-txt'>" +
//            "<span class='err' id=''></span>" +
//            "<p class='notic'>唯一标识</p>" +
//            "</dd>" +

            "<dt class='tit'><label><em>*</em>提示：</label></dt>" +
            "<dd class='opt'>" +
            "<input type='text' id='new_field[" + index + "][remarks]' name='new_field[" + index + "][remarks]' value='' class='input-txt'>" +
            "<span class='err' id=''></span>" +
            "<p class='notic'>用于前端页面提示用户</p>" +
            "</dd>" +
            "</dl>"
        );
    });

    $('.del_field').click(function () {
        if((window.confirm("删除是不可恢复的，你确认要删除吗？"))){
            var this_id = this.id;
//            var aid = $("#a_id").val();
//            $.ajax({
//                type: "POST",
//                dataType:'json',
//                url:"<?php echo U('Admin/Index/del_new_field'); ?>",
//                data: {'id':this_id,'aid':aid},// 你的formid
//                success: function (data) {
//                    console.log(data);return;
                    $('#dl_'+this_id).remove();
                    alert("删除成功");
//                },
//                error : function() {
//                    alert("请求失败");
//                }
//            });
//            $.ajax({
//                url : "<?php echo U('Admin/Index/del_new_field'); ?>",
//                type:'post',
//                dataType:'json',
//                data :{"id" : this_id},
//                // 成功后开启模态框
//                success : function(obj){
//                    console.log(obj);return;
//                    $('#dl_'+this_id).remove();
//                    alert("删除成功");
//                },
//                error : function() {
//                    alert("请求失败");
//                }
//            });
        }else{
            return false;
        }
    });

    $(document).ready(function(){
        var obj1=document.getElementsByName("must_name_id");
        for (var b=0;b<obj1.length;b++){ //遍历Radio
            if(obj1[b].checked){
                chkObjs1=obj1[b].value;
            }
        }
        if(chkObjs1==0){
            $("#IDnum_length").hide();
        }else{
            $('#IDnum_length').show();
        }
        $('#is_ID').click(function () {
            var obj=document.getElementsByName("must_name_id")
            for (var i=0;i<obj.length;i++){ //遍历Radio
                if(obj[i].checked){
                    chkObjs=obj[i].value;
                }
            }
            if(chkObjs>0){
                $('#IDnum_length').show();
            }else{
                $('#IDnum_length').hide();
            }
        });
    });
</script>
<script>
    $(function(){

        $('#start_time').layDate();
        $('#end_time').layDate();

        $('#submitBtn').click(function(){
            $('#branch_form').submit();
        });

        $("#branch_form").validate({
            debug: false, //调试模式取消submit的默认提交功能
            focusInvalid: false, //当为false时，验证无效时，没有焦点响应
            onkeyup: false,
            submitHandler: function(form){   //表单提交句柄,为一回调函数，带一个参数：form
                var index = layer.load(2); //0代表加载的风格，支持0-2
                $.ajax({
                    url:"<?php echo U('Admin/Index/addEditSalesExchange'); ?>",
                    type:'post',
                    dataType:'json',
                    data: $("#branch_form").serialize(),
                    success:function(obj){
                        layer.close(index);
                        if(obj.status !=1){
                            layer.msg(obj.msg, {icon: 2, time: 3000}); //alert(v.msg);
                        }else{
                            layer.msg(obj.msg, {icon: 1, time: 1000}); //alert(v.msg);
                            setTimeout(function(){
                                parent.location.reload();
                            },1000);
                        }
                    },
                    error:function () {
                        layer.close(index);
                    }
                });
            },
            ignore:":button",	//不验证的元素
            rules:{
                name:{
                    required:true
                },
                start_time:{
                    required:true
                },
                end_time:{
                    required:true
                }
            },
            messages:{
                name:{
                    required:"请输入支行名称"
                },
                start_time:{
                    required:"请选择活动开始时间"
                },
                end_time:{
                    required:"请选择活动结束时间"
                }
            }
        });
    });

    function img_call_back(fileurl_tmp)
    {
        $("#img").val(fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }

    function img_call_back1(fileurl_tmp)
    {
        $("#back_img").val(fileurl_tmp);
        $("#img_img_back").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }
</script>