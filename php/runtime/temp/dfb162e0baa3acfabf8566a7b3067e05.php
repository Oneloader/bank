<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"./template/bank/sales\order_list.html";i:1540970475;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $sales_info['activity']; ?></title>
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
        <!--<p class="top_name activity_in"><span><?php echo $sales_info['bank_name']; ?></span><em>-</em><span><?php echo $sales_info['name']; ?></span></p>-->
        <p class="top_name activity_in"><span style="display: block;max-width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float: left"><?php echo $sales_info['bank_name']; ?></span><em style="float: left">-</em><span style="float: left"><?php echo $sales_info['name']; ?></span></p>

        <span class="activity_name"><?php echo $sales_info['activity']; ?></span>
    </div>
    <div class="righr_menu am-fr clearfix">
         <a href="javascript:void(0)" class="gift am-fl">
             <i class="iconfont icon-gift"></i>
             <span>兑换</span>
             <input type="hidden" value="<?php echo $is_level; ?>" id="is_level">
         </a>
         <a href="javascript:history.go(-1);" class="back am-fl">
             <i class="iconfont icon-fanhui2"></i>
             <span>返回</span>
         </a>
    </div>
</div>

<div class="tab_menu clearfix">
    <a href="<?php echo url('Bank/sales/manager',['sid'=>$sid,'aid'=>$aid]); ?>" class="menu_item am-fl">数据统计</a>
    <a href="" class="menu_item am-fl active">订单列表</a>
</div>

<div class="data_content">
    <!--<ul class="data_list">-->
        <!--<li class="data_li clearfix">-->
            <!--<p class="li_data am-fl"><span>高升桥支行</span><em>69单</em></p>-->
            <!--<a href="" class="looking_gift am-fr" style="border: none;">全部订单</a>-->
        <!--</li>-->
    <!--</ul>-->
    <ul class="order_info_list">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $k=>$v): ?>
            <li class="info_list_li">
                <p class="order_title clearfix"><span class="am-fl">订单编号：<?php echo $v['order_sn']; ?></span><em class="am-fr"><?php echo $v['create_time']; ?></em></p>
                <div class="order_shop clearfix">
                    <img src="<?php echo $v['original_img']; ?>" alt="">
                    <p><?php echo $v['goods_name']; ?></p>
                    <span>数量:<?php echo $v['goods_num']; ?></span>
                </div>
                <p class="other_text clearfix">
                    <span class="am-fl">收货人：<?php echo $v['consignee']; ?></span>
                    <span class="am-fr">电话：<?php echo $v['phone']; ?></span>

                </p>
                <p class="other_text clearfix">
                    <!--<span class="am-fl">编号：<?php echo $v['sales_sn']; ?></span>-->
                    <span class="am-fr"><?php echo $v['bank_name']; ?>_<?php echo $v['name']; ?></span>
                </p>
                <input type="hidden" value="<?php echo $v['shipping_id']; ?>" id="shipping_id">
                <?php if($v['shipping_time'] == '0'): ?>
                    <p class="other_text clearfix">
                        <em class="am-fl" style="color: darkgrey">未发货</em>
                        <!--<a href="javascript:void(0)" class="looking_gift am-fr" style="color: darkgrey">查看物流</a>-->
                    </p>
                    <?php else: ?>
                    <p class="other_text clearfix">
                        <em class="am-fl">已发货</em>
                        <a href="<?php echo url('Bank/sales/logistics',['sid'=>$sid,'shipping_id'=>$v['shipping_id']]); ?>" class="looking_gift am-fr">查看物流</a>
                    </p>
                <?php endif; ?>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<div class="center_box">
    <div>
        <div>
            <div>
                <div class="contents-box">
                    <h2>请选择商品等级分类</h2>
                    <select name="" id="level" class="ipt_login" style="border: 1px solid <?php echo $nav_color; ?>">
                        <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$value): ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="user_btns clearfix">
                        <a href="javascript:void(0)" class="conform_cancel am-fl" style="background-color: <?php echo $nav_color; ?>">取消</a>
                        <a href="javascript:void(0)" class="conform_btn am-fr" style="background-color: <?php echo $nav_color; ?>">确认</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="logistics">-->
    <!--<div class="logistics_hd">-->
        <!--<p>订单编号：85412547854</p>-->
        <!--<p>承运人：圆通快递</p>-->
    <!--</div>-->
    <!--<div class="logistics_box">-->
        <!--<ul class="logistics_blist">-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->
            <!--<li>-->
                <!--<p>科技感和拉丁方会计师噶塑料袋噶速度快垃圾收代理费哈师大</p>-->
                <!--<span>2018-10-10 22:32:28</span>-->
                <!--<i></i>-->
            <!--</li>-->


            <!--&lt;!&ndash;保留不要套&ndash;&gt;-->
            <!--<li class="set_pos_line"></li>-->
            <!--&lt;!&ndash;保留不要套&ndash;&gt;-->
        <!--</ul>-->
    <!--</div>-->
<!--</div>-->

<script src="/public/static/change/js/jquery-1.9.1.min.js"></script>
<script src="/public/static/change/js/amazeui.min.js"></script>
<script src="/public/static/change/js/jquery.imgpreload.min.js"></script>
<script type="text/javascript">
//    $('.logistics').on('click',function () {
//        var shipping_id=$('#shipping_id').val();
//        var url = "<?php echo url('Bank/sales/check_logistics',['sid'=>$sid]); ?>";
//        if(shipping_id != ''){
//            $.ajax({
//                async:false,
//                url:url,
//                //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
//                data:{'shipping_id':shipping_id},
//                type:'get',
//                dataType:'json',
//                success:function(res){
//                    console.log(res);return;
//                    if(res.status != 1){
//                        $('#input').hide();
//                        $('#result').html(
//                            '<div class="user_btns clearfix" style="margin-top: 10px;">'
//                            +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
//                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl">确定</a>'
//                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr">取消</a>'
//                            +'</div>');
//                        $('#result').show();
//                        $('.center_box').fadeIn(200);
//
//                        $('.btn_conform').click(function(){
//                            window.location.reload();
//                            $('.center_box').fadeOut(200);
//                        });
//                        $('.cont_btn').click(function(){
//                            window.location.reload();
//                            $('.center_box').fadeOut(200);
//                        });
//                    }else{
//                        $('#input').hide();
//                        $('#result').html(
//                            '<div class="user_btns clearfix" style="margin-top: 10px;">'
//                            +'<h2 style="line-height: 100px;">'+res.msg+'!</h2>'
//                            +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl">确定</a>'
//                            +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr">取消</a>'
//                            +'</div>');
//                        $('#result').show();
//                        $('.center_box').fadeIn(200);
//
//                        $('.btn_conform').click(function(){
////                                console.log(res.data);return;
////                                location.href=res.data;
//                            $('.center_box').fadeOut(200);
//                        });
//                        $('.cont_btn').click(function(){
//                            window.location.reload();
//                            $('.center_box').fadeOut(200);
//                        });
//                    }
//                },
//                error : function(XMLHttpRequest, textStatus, errorThrown) {
//                    $('#input').hide();
//                    $('#result').html(
//                        '<div class="user_btns clearfix" style="margin-top: 10px;">'
//                        +'<h2 style="line-height: 100px;">网络失败，请刷新页面后重试!</h2>'
//                        +'<a href="javascript:void(0)" class="conform_btn btn_conform am-fl">确定</a>'
//                        +'<a href="javascript:void(0)" class="conform_btn cont_btn am-fr">取消</a>'
//                        +'</div>');
//                    $('#result').show();
//                    $('.center_box').fadeIn(200);
//
//                    $('.btn_conform').click(function(){
//                        window.location.reload();
//                        $('.center_box').fadeOut(200);
//                    });
//                    $('.cont_btn').click(function(){
//                        window.location.reload();
//                        $('.center_box').fadeOut(200);
//                    });
//                }
//            });
//        }else{
//            return false;
//        }
//    });

    $('.gift').click(function(){
        var is_level = $('#is_level').val();
//        console.log(is_level);return;
        if(is_level = 1){
            $('.center_box').fadeIn(200);
            $('.conform_btn').click(function(){
                var level = document.getElementById("level").value;
                var first_url = "<?php echo url('Bank/sales/goodsList',['sid'=>$sid,'aid'=>$aid,'sales_id'=>$sales_info['id'],'level_id'=>'levelid']); ?>";
                url = first_url.replace("levelid",level);
                location.href=url;
                $('.center_box').fadeOut(200);
            });
        }else{
            var url = "<?php echo url('Bank/sales/order_list',['sid'=>$sid,'aid'=>$aid,'sales_id'=>$sales_id]); ?>";
            location.href=url;
        }
    });

    $('.conform_cancel').click(function(){
        window.location.reload();
        $('.center_box').fadeOut(200);
    });
</script>
</body>
</html>