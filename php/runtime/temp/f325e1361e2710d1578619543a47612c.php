<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:32:"./template/bank/index\event.html";i:1540968585;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['name']; ?></title>
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
    <link rel="stylesheet" href="/public/static/change/css/iconfont.css">
    <link rel="stylesheet" href="/public/static/change/css/style.css">
</head>
<body>
<div class="user_pages">
    <img class="pages_img" src="<?php echo $data['img']; ?>" alt="">
    <a href="javascript:void(0);" class="btn_orange user_btn">立即兑换</a>
</div>


<div class="center_box">
    <div>
        <div>
            <div>
                <div class="contents-box">
                    <div id="input">
                        <h2>请输入您的兑换码</h2>
                        <!--<form action="" method="post">-->
                        <input type="text" class="ipt_login" id="code" name="code" placeholder="请输入兑换码" value="<?php echo $code; ?>" style="border: 1px solid <?php echo $shop_color; ?>">
                        <input type="hidden" id="sid" value="<?php echo $sid; ?>">
                        <input type="hidden" id="aid" value="<?php echo $aid; ?>">
                        <div class="user_btns clearfix">
                            <a href="javascript:void(0)" class="conform_cancel am-fl" style="background-color: <?php echo $shop_color; ?>;color: white;border: hidden">取消</a>
                            <a href="javascript:void(0)" id="submit" class="conform_btn am-fr" style="background-color: <?php echo $shop_color; ?>">确认</a>
                        </div>
                        <!--</form>-->
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
    $('.btn_orange').click(function(){
        $('#result').hide();
        $('.center_box').fadeIn(200);
    });

    $('.conform_cancel').click(function(){
        $('.center_box').fadeOut(200);
    });

</script>
<script type="text/javascript">
    $(function () {
        $('#submit').on('click',function(){
            var code=true;
            var change=$('#code').val();
            var url = "<?php echo url('Bank/Index/doLogin',['sid'=>$sid,'aid'=>$aid]); ?>";
            if(change != ''){
                $.ajax({
                    async:false,
                    url:url,
                    //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
                    data:{'code':change},
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status != 1){
                            $('#input').hide();
                            $('#result').html(
                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $shop_color; ?>">确定</a>'
                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $shop_color; ?>">取消</a>'
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
                            $('#input').hide();
                            $('#result').html(
                                '<div class="user_btns clearfix" style="margin-top: 10px;">'
                                +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                                +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $shop_color; ?>">确定</a>'
                                +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $shop_color; ?>">取消</a>'
                                +'</div>');
                            $('#result').show();
                            $('.center_box').fadeIn(200);

                            $('.btn_conform').click(function(){
                                location.href=res.data;
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
                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $shop_color; ?>">确定</a>'
                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $shop_color; ?>">取消</a>'
                            +'</div>');
                        $('#result').show();
                        $('.center_box').fadeIn(200);

                        $('.btn_conform').click(function(){
                            location.href=res.data;
                            $('.center_box').fadeOut(200);
                        });
                        $('.cont_btn').click(function(){
                            $('.center_box').fadeOut(200);
                        });
                        alert('网络失败，请刷新页面后重试!');
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