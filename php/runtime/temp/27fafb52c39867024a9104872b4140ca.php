<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./template/bank/index\goodsList.html";i:1540880695;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="background-color:<?php echo $data['back_color']; ?>">
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
<div class="top_bgs">
    <img src="<?php echo $data['back_img']; ?>" alt="">
</div>
<div style="height:100%;float: left;">
    <ul class="shop_list_box clearfix">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
            <li>
                <a href="<?php echo $v['url']; ?>">
                    <img src="<?php echo $v['original_img']; ?>" alt="">
                    <p class="shop_name"><?php echo $v['goods_name']; ?></p>
                    <?php if($v['goods_price'] != null): ?>
                        <span class="price">零售价格：<i>￥<?php echo $v['goods_price']; ?></i></span>
                        </else><span></span>
                    <?php endif; if($data['is_stock'] != 0): ?>
                        <em>库存：<?php echo $v['store']; ?></em>
                        </else>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>


<script src="/public/static/change/js/jquery-1.9.1.min.js"></script>
<script src="/public/static/change/js/amazeui.min.js"></script>
<script src="/public/static/change/js/jquery.imgpreload.min.js"></script>
</body>
</html>