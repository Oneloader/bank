<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:34:"./template/bank/sales\manager.html";i:1540970453;}*/ ?>
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
<!--<div>
    <img src="/public/static/change/images/order_bg.jpg" class="top_logo am-fl" style="width: 100%;" alt="">
</div>-->

<div class="tab_menu clearfix">
    <a href="" class="menu_item am-fl active">数据统计</a>
    <a href="<?php echo url('Bank/sales/order_list',['sid'=>$sid]); ?>" class="menu_item am-fl">订单列表</a>
</div>

<div class="data_content">
    <ul class="data_list">
        <?php if($is_leader == '1'): ?>
            <li class="data_li clearfix">
                <p class="li_data"><span><?php echo $sales_info['bank_name']; ?></span><em><?php echo $bank_order['count']; ?>单</em></p>
                <i class="iconfont icon-next"></i>
                <div class="order_box">
                    <ol class="order_list">
                        <?php if(is_array($bank_order['goods_order']) || $bank_order['goods_order'] instanceof \think\Collection || $bank_order['goods_order'] instanceof \think\Paginator): if( count($bank_order['goods_order'])==0 ) : echo "" ;else: foreach($bank_order['goods_order'] as $key=>$value): ?>
                            <li class="order_list_li clearfix">
                                <img src="<?php echo $value['original_img']; ?>" class="am-fl" alt="">
                                <div class="order_names am-fl">
                                    <p><?php echo $value['goods_name']; ?></p>
                                    <span class="hui_text">兑换个数:<?php echo (isset($value['goods_sum']) && ($value['goods_sum'] !== '')?$value['goods_sum']:0); ?></span>
                                </div>
                                <div class="order_right am-fr">
                                    <span class="hui_text">单数:<?php echo (isset($value['order_sum']) && ($value['order_sum'] !== '')?$value['order_sum']:0); ?></span>
                                    <a href="<?php echo url('Bank/sales/order_list',['sid'=>$sid,'good_id'=>$value['goods_id'],'all_order'=>1,'sales_id'=>$sales_id]); ?>">查看订单</a>
                                </div>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ol>
                </div>
            </li>
            <?php else: endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $k=>$v): ?>
            <li class="data_li clearfix">
                <p class="li_data"><span>#<?php echo $v['name']; ?></span><em><?php echo $v['count']; ?>单</em></p>
                <i class="iconfont icon-next"></i>
                <div class="order_box">
                    <ol class="order_list">
                        <?php if(is_array($v['orders']) || $v['orders'] instanceof \think\Collection || $v['orders'] instanceof \think\Paginator): if( count($v['orders'])==0 ) : echo "" ;else: foreach($v['orders'] as $key=>$val): ?>
                            <li class="order_list_li clearfix">
                                <img src="<?php echo $val['original_img']; ?>" class="am-fl" alt="">
                                <div class="order_names am-fl">
                                    <p><?php echo $val['goods_name']; ?></p>
                                    <span class="hui_text">兑换个数:<?php echo $val['goods_sum']; ?></span>
                                </div>
                                <div class="order_right am-fr">
                                    <span class="hui_text">单数:<?php echo $val['order_sum']; ?></span>
                                    <a href="<?php echo url('Bank/sales/order_list',['sid'=>$sid,'good_id'=>$val['goods_id'],'sales_id'=>$v['id']]); ?>">查看订单</a>
                                </div>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ol>
                </div>
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
                        <a href="javascript:void(0)" class="conform_cancel am-fl" style="background-color: <?php echo $nav_color; ?>;color: white;border: hidden">取消</a>
                        <a href="javascript:void(0)" class="conform_btn am-fr" style="background-color: <?php echo $nav_color; ?>">确认</a>
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
    $('.data_list .data_li').on('click',function(){
        var list_h = $(this).find('.order_list').height();
        if($(this).hasClass('show')){
            $(this).find('.order_box').css('height','0px');
            $(this).removeClass('show');
        }else{
            $(this).find('.order_box').css('height',list_h);
            $(this).addClass('show');
        }
    });

    $('.gift').click(function(){
        var le = $('#is_level').val();
//        console.log(le<1);return;
        if(le<1){
            var url = "<?php echo url('Bank/sales/goodsList',['sid'=>$sid,'aid'=>$aid,'sales_id'=>$sales_id]); ?>";
            location.href=url;
        }else{
            $('.center_box').fadeIn(200);
            $('.conform_btn').click(function(){
                var level = document.getElementById("level").value;
                var first_url = "<?php echo url('Bank/sales/goodsList',['sid'=>$sid,'aid'=>$aid,'sales_id'=>$sales_info['id'],'level_id'=>'levelid']); ?>";
                url = first_url.replace("levelid",level);
                location.href=url;
                $('.center_box').fadeOut(200);
            });
        }
    });

    $('.conform_cancel').click(function(){
        window.location.reload();
        $('.center_box').fadeOut(200);
    });
</script>

<script type="text/javascript">
//    var jsondata = JSON;
//    console.log(jsondata);

</script>
</body>
</html>