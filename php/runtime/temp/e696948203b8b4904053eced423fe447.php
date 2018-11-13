<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./template/bank/sales\logistics.html";i:1540972653;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物流信息</title>
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
<div class="head_menu clearfix">
    <!--<img src="/public/static/change/images/white_logo.png" class="top_logo am-fl" alt="">-->
    <div class="manage_names am-fl">
        <!--<p class="top_name activity_in"><span><?php echo $sales_info['bank_name']; ?></span><em>-</em><span><?php echo $sales_info['name']; ?></span></p>-->
        <p class="top_name activity_in"><span style="display: block;max-width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float: left"><?php echo $sales_info['bank_name']; ?></span><em style="float: left">-</em><span style="float: left"><?php echo $sales_info['name']; ?></span></p>
        <span class="activity_name"><?php echo $sales_info['activity']; ?></span>
    </div>
    <div class="righr_menu am-fr clearfix">
        <a href="javascript:history.go(-1);" class="back am-fl" style="float: right">
            <i class="iconfont icon-fanhui2"></i>
            <span>返回</span>
        </a>
    </div>
</div>
<div class="data_content">
    <div class="logistics_hd">
        <p>订单编号：<?php echo $data['LogisticCode']; ?></p>

        <?php if(is_array($shipping_coms) || $shipping_coms instanceof \think\Collection || $shipping_coms instanceof \think\Paginator): $i = 0; $__LIST__ = $shipping_coms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key == $data['ShipperCode']): ?>
                <p>快递公司：<?php echo $v; ?></p>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <p>承运人：<?php echo $shipping['username']; ?></p>
    </div>
    <div class="logistics_box">
        <ul class="logistics_blist">
            <?php if(is_array($data['Traces']) || $data['Traces'] instanceof \think\Collection || $data['Traces'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['Traces'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li>
                    <p><?php echo $v['AcceptStation']; ?></p>
                    <span><?php echo $v['AcceptTime']; ?></span>
                    <i></i>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            <!--保留不要套-->
            <li class="set_pos_line"></li>
            <!--保留不要套-->
        </ul>
    </div>
</div>
</body>
</html>