<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:32:"./template/bank/sales\index.html";i:1540970502;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>客户经理-活动列表</title>
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
<div class="head_menu clearfix" style="background-color: <?php echo $nav_color; ?>">
    <img src="<?php echo $sign; ?>" class="top_logo am-fl" alt="">
    <div class="manage_names am-fl">
        <p class="top_name"><span style="display: block;max-width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float: left"><?php echo $bank['name']; ?></span><em style="float: left">-</em><span style="float: left"><?php echo $sales['name']; ?></span></p>
    </div>
    <div class="righr_menu am-fr clearfix">
        <p class="exit am-fr" id="logout">
            <i class="iconfont icon-tuichu"></i>
            <span>退出</span>
        </p>
    </div>
</div>
<div class="page_content refreshWrap" id="app">
    <ul class="activity_list">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $k=>$v): ?>
            <li class="activity_list_li">
                <a class="list_link" href="<?php echo url('Bank/sales/manager',['sid'=>$sid,'aid'=>$v['id']]); ?>">
                    <p class="item_title clearfix"><span class="am-fl"><?php echo $v['name']; ?></span><em class="am-fr">截止：<?php echo $v['end_time']; ?></em></p>
                    <img src="<?php echo $v['img']; ?>" alt="">
                    <span class="activity_status running">进行中</span>
                </a>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<div class="center_box">
    <div>
        <div>
            <div>
                <div class="contents-box">
                    <div id="input">
                    </div>
                    <div id="result">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/public/static/change/js/jquery-1.9.1.min.js"></script>
<!--<script src="js/amazeui.min.js"></script>-->
<!--<script src="js/jquery.imgpreload.min.js"></script>-->
<script type="text/javascript" src="/public/static/change/js/zepto.min.js"></script>
<script type="text/javascript" src="/public/static/change/js/PullToRefresh.min.js"></script>
<script>
//    var n=0,flag=true;
//    function appendTestData(){
//        var html = '';
//        html+=' <li class="activity_list_li">';
//        html+='<a class="list_link" href="manager.html">';
//        html+='<p class="item_title clearfix"><span class="am-fl">2018贵宾升级，专享好礼</span><em class="am-fr">截止：2019-09-30</em></p>';
//        html+='<img src="/public/static/change/images/item.jpg" alt="">';
//        html+='<span class="activity_status running">进行中</span>';
//        html+='</a>';
//        html+='</li>';
//        return html;
//    }
//    function addhtml(type){
//
//        $("#app .activity_list")[type](appendTestData())
//    }
//    var refreshBox=new PullToRefresh({
//        container:"#app",
//        up:{
//            callback:function(){
//                console.log(n);
//                setTimeout(function(){
//                    if(n<5){
//                        n++;
//
//                        addhtml("append");
//                        refreshBox.endUpLoading(true)
//                    }else{    //没有数据
//                        refreshBox.endUpLoading(false)
//                    }
//                },1000)
//            }
//        }
//    })
</script>
<script type="text/javascript">
    $(function () {
        $('#logout').on('click',function(){
            var url = "<?php echo url('Bank/Sales/logout',['sid'=>$sid]); ?>";
            $.ajax({
                async:false,
                url:url,
                //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
                type:'post',
                dataType:'json',
                success:function(res){
//                    console.log(res);return;
                    if(res.status != 1){
                        $('#input').hide();
                        $('#result').html(
                            '<div class="user_btns clearfix" style="margin-top: 10px;">'
                            +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $nav_color; ?>">确定</a>'
                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $nav_color; ?>">取消</a>'
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
                            +'<a href="javascript:void(0)" style="margin-left: 30%;background-color: <?php echo $nav_color; ?>" class="conform_btn btn_conform am-fl">确定</a>'
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
                    alert('网络失败，请刷新页面后重试!');
                }
            });
        })
    })
</script>
</body>
</html>