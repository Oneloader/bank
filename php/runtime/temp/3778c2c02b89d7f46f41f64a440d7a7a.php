<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:32:"./template/bank/sales\login.html";i:1540978954;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache,must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="format-detection" content="telephone=no, address=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style">
     <link rel="stylesheet" href="/public/static/change/css/amazeui.min.css">
    <link rel="stylesheet" href="/public/static/change/css/style.css">
</head>
<body>
<div class="login_box">
    <img src="<?php echo $bank['logo']; ?>" class="login_logo" alt="">
    <div class="login_ipt">
        <input type="text" class="ipt_login" name="phone" id="phone" placeholder="请输入手机号码" style="border:1px solid <?php echo $bank['nav_color']; ?>">
        <div class="code_ipt clearfix">
            <input type="text" id="code" class="ipt_code am-fl" placeholder="验证码" style="border:1px solid <?php echo $bank['nav_color']; ?>">
            <input type="hidden" id="nav_color" value="<?php echo $bank['nav_color']; ?>">
            <button class="btn_blue am-fr" id="get_code" style="background-color: <?php echo $bank['nav_color']; ?>">获取验证码</button>
        </div>
        <a href="javascript:void(0)" class="btn_orange am-fr" id="submit" style="width: 100%;">登   录</a>
    </div>
</div>

<div class="center_box">
    <div>
        <div>
            <div>
                <div class="contents-box">
                    <div id="input">
                        <h2 style="line-height: 100px;">恭喜您兑换成功！</h2>
                        <div class="user_btns clearfix" style="margin-top: 10px;">
                            <?php if($type == 2): ?>
                                <a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>
                                <a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">继续兑换</a>
                                <?php else: ?>
                                <a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="text-align:center;background-color: <?php echo $bank['nav_color']; ?>">确定</a>
                                <a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="result">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/static/change/js/jquery-1.9.1.min.js"></script>
<script src="/public/static/change/js/amazeui.min.js"></script>
<script src="/public/static/change/js/jquery.imgpreload.min.js"></script>
<script>
</script>
<script type="text/javascript">
    $(function () {
        $('#get_code').on('click',function () {
//            var nav_color = <?php echo $bank['nav_color']; ?>;
//            console.log(nav_color);return;
            var phone=$('#phone').val();
            var url = "<?php echo url('Bank/sales/get_message_code',['sid'=>$sid]); ?>";
            if(phone != ''){
                $.ajax({
                    async:false,
                    url:url,
                    //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
                    data:{'phone':phone},
                    type:'get',
                    dataType:'json',
                    success:function(res){
                        if(res.status != 1){
                            $('#input').hide();
                            $('#result').html(
                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                                +'</div>');
                            $('#result').show();
                            $('.center_box').fadeIn(200);

                            $('.btn_conform').click(function(){
                                window.location.reload();
                                $('.center_box').fadeOut(200);
                            });
                            $('.cont_btn').click(function(){
                                window.location.reload();
                                $('.center_box').fadeOut(200);
                            });
                        }else{
                            var tim = 60;
                            var interval = setInterval(function(){
                                if(tim > 0){
                                    tim -= 1;
                                    $('.btn_blue').addClass('send');
                                    $('.btn_blue').text(tim + 'S后重新发送');
                                    $('.btn_blue').attr('disabled','disabled');
                                }else{
                                    clearInterval(interval);
                                    $('.btn_blue').removeClass('send');
                                    $('.btn_blue').text('获取验证码');
                                    $('.btn_blue').removeAttr('disabled');
                                }
                            },1000);

                            $('#input').hide();
                            $('#result').html(
                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                                +'</div>');
                            $('#result').show();
                            $('.center_box').fadeIn(200);

                            $('.btn_conform').click(function(){
//                                console.log(res.data);return;
//                                location.href=res.data;
                                $('.center_box').fadeOut(200);
                            });
                            $('.cont_btn').click(function(){
                                window.location.reload();
                                $('.center_box').fadeOut(200);
                            });
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#input').hide();
                        $('#result').html(
                            '<div class="user_btns clearfix" style="margin-top: 10px;">'
                            +'<h2 style="line-height: 100px;">网络失败，请刷新页面后重试!</h2>'
                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                            +'</div>');
                        $('#result').show();
                        $('.center_box').fadeIn(200);

                        $('.btn_conform').click(function(){
                            window.location.reload();
                            $('.center_box').fadeOut(200);
                        });
                        $('.cont_btn').click(function(){
                            window.location.reload();
                            $('.center_box').fadeOut(200);
                        });
                    }
                });
            }else{
                $('#input').hide();
                $('#result').html(
                    '<div class="user_btns clearfix" style="margin-top: 10px;">'
                    +'<h2 style="line-height: 100px;">请先输入手机号码</h2>'
                    +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                    +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                    +'</div>');
                $('#result').show();
                $('.center_box').fadeIn(200);

                $('.btn_conform').click(function(){
                    window.location.reload();
                    $('.center_box').fadeOut(200);
                });
                $('.cont_btn').click(function(){
                    window.location.reload();
                    $('.center_box').fadeOut(200);
                });
            }
        });

        $('#submit').on('click',function(){
            var phone=$('#phone').val();
            var code=$('#code').val();
            var url = "<?php echo url('Bank/sales/login',['sid'=>$sid]); ?>";
            if(phone != ''){
                $.ajax({
                    async:false,
                    url:url,
                    //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
                    data:{'phone':phone,'code':code},
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status != 1){
                            $('#input').hide();
                            $('#result').html(
                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                                +'</div>');
                            $('#result').show();
                            $('.center_box').fadeIn(200);

                            $('.btn_conform').click(function(){
                                $('.center_box').fadeOut(200);
                            });
                            $('.cont_btn').click(function(){
                                window.location.reload();
                                $('.center_box').fadeOut(200);
                            });
                        }else{
                            /*---------登陆成功不提示,直接跳转---------*/
                            location.href=res.data;

                            /*---------登陆成功提示后再跳转---------*/
//                            $('#input').hide();
//                            $('#result').html(
//                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
//                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
//                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl">确定</a>'
//                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr">取消</a>'
//                                +'</div>');
//                            $('#result').show();
//                            $('.center_box').fadeIn(200);
//
//                            $('.btn_conform').click(function(){
//                                console.log(res.data);return;
//                                location.href=res.data;
//                                $('.center_box').fadeOut(200);
//                            });
//                            $('.cont_btn').click(function(){
//                                window.location.reload();
//                                $('.center_box').fadeOut(200);
//                            });
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#input').hide();
                        $('#result').html(
                            '<div class="user_btns clearfix" style="margin-top: 10px;">'
                            +'<h2 style="line-height: 100px;">网络失败，请刷新页面后重试!</h2>'
                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $bank['nav_color']; ?>">确定</a>'
                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $bank['nav_color']; ?>">取消</a>'
                            +'</div>');
                        $('#result').show();
                        $('.center_box').fadeIn(200);

                        $('.btn_conform').click(function(){
                            window.location.reload();
                            $('.center_box').fadeOut(200);
                        });
                        $('.cont_btn').click(function(){
                            window.location.reload();
                            $('.center_box').fadeOut(200);
                        });
                    }
                });
            }else{
                return false;
            }
        })
    })
</script>
</body>
</html>