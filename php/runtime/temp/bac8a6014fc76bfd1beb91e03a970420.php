<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"./application/admin/view2/index\pubs_add.html";i:1540807738;}*/ ?>

<!--拾色器-->
<!-- MiniColors -->
<script src="__PUBLIC__/static/js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="__PUBLIC__/static/css/jquery.minicolors.css">
<script type="text/javascript">
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
<div class="ncap-form-default">
    <form id="admin_form" method="post" action="" name="admin_form">
        <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?>
            <input type="hidden" name="sid" value="<?php echo $info['id']; ?>"/>
        <?php endif; ?>
        <dl class="row">
            <dt class="tit"><label for="shop_name"><em>*</em>银行名称</label><!-- 银行名称 --></dt>
            <dd class="opt">
                <input id="shop_name" name="shop_name" value="<?php echo $info['name']; ?>" class="txt valid" type="text">
                <span class="err"></span></dd>
        </dl>

        <dl class="row">
            <dt class="tit">
                <label><em>*</em>顶部导航色：</label>
            </dt>
            <dd class="opt">
                <input type="text" id="nav_color" class="demo" name="nav_color" value="<?php echo $info['nav_color']; ?>">
            </dd>
        </dl>

        <dl class="row">
            <dt class="tit">
                <label><em>*</em>银行logo：</label>
            </dt>
            <dd class="opt">
                <div class="input-file-show">
                        <span class="show">
                            <a id="img_a" class="nyroModal" rel="gal" href="javascript:void(0)">
                                <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['logo']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="logo" name="logo" value="<?php echo $info['logo']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','logo','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo">
                        </span>
                </div>
                <span class="err" id="err_logo"></span>
                <p class="notic">请上传500*300px PNG图片格式</p>
            </dd>
        </dl>

        <dl class="row">
            <dt class="tit">
                <label><em>*</em>标志logo：</label>
            </dt>
            <dd class="opt">
                <div class="input-file-show">
                        <span class="show">
                            <a id="img_b" class="nyroModal" rel="gal" href="javascript:void(0)">
                                <i id="img_back" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['sign']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
                    <span class="type-file-box">
                            <input type="text" id="sign" name="sign" value="<?php echo $info['sign']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button2" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','sign','img_call_back2')" size="30" hidefocus="true" nc_type="change_site_logo">
                        </span>
                </div>
                <span class="err" id="err_sign"></span>
                <p class="notic">请上传80*80px PNG图片格式</p>
            </dd>
        </dl>

        <div class="bot">
            <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><span>确认提交</span></a>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        //自定义radio样式
        $(".cb-enable").click(function () {
            var parent = $(this).parents('.onoff');
            $('.cb-disable', parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox', parent).attr('checked', true);
        });
        $(".cb-disable").click(function () {
            var parent = $(this).parents('.onoff');
            $('.cb-enable', parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox', parent).attr('checked', false);
        });
        $('#submitBtn').click(function () {
            $('#admin_form').submit();
        });

        $("#admin_form").validate({
            debug: true, //调试模式取消submit的默认提交功能
            focusInvalid: false, //当为false时，验证无效时，没有焦点响应
            onkeyup: false,
            submitHandler: function (form) {   //表单提交句柄,为一回调函数，带一个参数：form
                var index = layer.load(2); //0代表加载的风格，支持0-2
                $.ajax({
                    url: '<?php echo $url; ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $("#admin_form").serialize(),
                    success: function (obj) {
                        layer.close(index);
                        if (obj.status != 1) {
                            layer.alert(obj.msg, {icon: 3});
                        } else {
                            var dialog = DialogManager.get('pubsadd');
                            dialog.close();
                            layer.msg('操作成功', {icon: 1, time: 1000});
                            setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 1000);
                        }
                    },
                    error:function () {
                        layer.close(index);
                    }
                });
            },
            ignore: ":button",	//不验证的元素
            rules: {
                shop_name: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                shop_name: {
                    required: "请输入银行名称",
                    minlength: "银行名称不能为空"
                }
            }
        });
    });

    function img_call_back(fileurl_tmp)
    {
        $("#logo").val(fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }

    function img_call_back2(fileurl_tmp)
    {
        $("#sign").val(fileurl_tmp);
        $("#img_back").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }
</script>