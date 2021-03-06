<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:40:"./template/bank/sales\order_details.html";i:1541761687;}*/ ?>
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
<div class="top_bgs">
    <img src="<?php echo $data['back_img']; ?>" alt="">
</div>
<div style="padding: 0 0 20px 0;background-color:<?php echo $data['back_color']; ?>">
    <div class="input_form">
        <div class="shop_numbers clearfix">
            <img src="<?php echo $info['original_img']; ?>" alt="">
            <div class="shop_names_number">
                <input type="hidden" id="good_id" value="<?php echo $info['goods_id']; ?>">
                <input type="hidden" id="type" value="<?php echo $type; ?>">
                <input type="hidden" id="total" value="<?php echo $total['store']; ?>">
                <p class="names"><?php echo $info['goods_name']; ?></p>
                <p class="add_num clearfix">
                    <em>数量：</em>
                    <!--<em id="shop_num">1</em>-->
                    <?php if($data['choice_num'] == 1): ?>
                        <i class="num_down">-</i>
                        <em class="shop_num" id="shop_num">1</em>
                        <i class="num_up">+</i>
                        <?php else: ?><em id="shop_num">1</em>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="ipt_group">
            <input type="hidden" id="must_name_id" value="<?php echo $data['must_name_id']; ?>">
            <input type="hidden" id="must_user_phone" value="<?php echo $data['must_user_phone']; ?>">

            <?php if($data['must_name_id'] != 0): ?>
                <div class="ipt_item">
                    <span class="ipt_item_text">客户姓名</span>
                    <input type="text" id="customer" placeholder="请输入姓名">
                    <div id="customer_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                </div>
                <div class="ipt_item">
                    <input type="hidden" value="<?php echo $data['id_length']; ?>" id="length">
                    <span class="ipt_item_text">身份证号</span>
                    <input type="text" id="ID_num" maxlength="<?php echo $data['id_length']; ?>" placeholder="请输入身份证号码后<?php echo $data['id_length']; ?>位">
                    <div id="ID_num_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                </div>
                <?php else: endif; if($data['must_user_phone'] != 0): ?>
                <div class="ipt_item">
                    <span class="ipt_item_text">客户电话</span>
                    <input type="text" id="user_phone" placeholder="请输入客户电话">
                    <div id="user_phone_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                </div>
                <?php else: endif; ?>

            <div class="ipt_item">
                <span class="ipt_item_text">收货人</span>
                <input type="text" id="consignee" placeholder="请输入收货人姓名">
                <div id="consignee_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                </div>
            </div>
            <div class="ipt_item">
                <span class="ipt_item_text">手机号码</span>
                <input type="text" id="phone" placeholder="请输入手机号码">
                <div id="phone_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                </div>
            </div>
            <div class="ipt_item">
                <span class="ipt_item_text">所在地区</span>
                <div data-toggle="distpicker">
                    <select data-province="---- 选择省 ----" id="province"></select>
                    <div id="province_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                    <select data-city="---- 选择市 ----" id="city"></select>
                    <div id="city_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                    <select data-district="---- 选择区 ----" id="district"></select>
                    <div id="district_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="ipt_item">
                <span class="ipt_item_text">详细地址</span>
                <input type="text" id="address" placeholder="请填写有效的收货地址">
                <div id="address_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                </div>
            </div>

            <form action="##" id="form1" onsubmit="return false" method="post">
                <?php if(is_array($new_field) || $new_field instanceof \think\Collection || $new_field instanceof \think\Paginator): if( count($new_field)==0 ) : echo "" ;else: foreach($new_field as $k=>$vo): ?>
                    <div class="ipt_item">
                        <span class="ipt_item_text"><?php echo $vo['title']; ?></span>
                        <input type="hidden" id="{[$k]}[title]" name="[<?php echo $k; ?>][title]" value="<?php echo $vo['title']; ?>">
                        <input type="text" id="[<?php echo $k; ?>][content]" name="[<?php echo $k; ?>][content]" placeholder="<?php echo $vo['remarks']; ?>">
                        <div id="<?php echo $vo['title']; ?>" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                        </div>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </form>

            <div class="ipt_item">
                <div id="remarks_error" class="input_error" style="float:left;bottom: 12px;width:441px;color: red;font-size: 12px">
                </div>
                <span class="ipt_item_text">备注</span>
                <textarea name="remarks" id="remarks" cols="30" rows="3" style="padding: 5px 10px;border: 1px solid #ddd;border-radius: 5px;background: #ffffff;width: 100%;outline: none;font-size: 14px;line-height: 20px" placeholder="不是必填"></textarea>
            </div>

        </div>
    </div>
    <div class="button_dui">
        <button id="submit" data-status="0" class="btn_orange">提交信息</button>
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
                                <a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="background-color: <?php echo $shop_color; ?>">返回首页</a>
                                <a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $shop_color; ?>">继续兑换</a>
                            <?php else: ?>
                                <a href="javascript:void(0)" class="conform_btn btn_conform am-fl" style="text-align:center;background-color: <?php echo $shop_color; ?>">确定</a>
                                <a href="javascript:void(0)" class="conform_btn cont_btn am-fr" style="background-color: <?php echo $shop_color; ?>">取消</a>
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
<script src="/public/static/change/js/distpicker.data.js"></script>
<script src="/public/static/change/js/distpicker.js"></script>
<script src="/public/static/change/js/main.js"></script>
<script>
    $('.num_up').click(function(){
        var num = parseInt($('.shop_num').text());
        var total = $('#total').val();
        if (num<total){
            $('.shop_num').text(num + 1);
        }else {
            alert('订购数量超过库存');
        }
    });
    $('.num_down').click(function(){
        var num = parseInt($('.shop_num').text());
        if(num > 1){
            $('.shop_num').text(num - 1);
        }
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#submit').on('click',function(){
            var btn_status = $(this).attr('data-status');
            if(btn_status == 1){
                return false;
            }
            $(this).attr('data-status',1);

            var province=$('#province option:selected').text();
            var city=$('#city option:selected').text();
            var district=$('#district option:selected').text();
            var customer=$('#customer').val();
            var ID_num=$('#ID_num').val();
            var user_phone=$('#user_phone').val();
            var consignee=$('#consignee').val();
            var phone=$('#phone').val();
//            var address= province+'/'+city+'/'+district+'/'+$('#address').val();
            var address= $('#address').val();
            var good_id=$('#good_id').val();
            var type=$('#type').val();
            var shop_num=$('#shop_num').text();
            var must_name_id=$('#must_name_id').val();
            var must_user_phone=$('#must_user_phone').val();
            var remarks=$('#remarks').val();

            $.fn.serializeObject = function()
            {
                var o = {};
                var a = this.serializeArray();
                $.each(a, function() {
                    if (o[this.name] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
            };


            var jsonObj = $("#form1").serializeObject();  //json对象

//            var jsonStr = JSON.stringify($("#form1").serializeObject());  //json字符串

            var arr = {'customer':customer,'ID_num':ID_num,'consignee':consignee,'phone':phone,'province':province,'city':city,'district':district,'address':address,'good_id':good_id,'type':type,'shop_num':shop_num,'must_name_id':must_name_id,'must_user_phone':must_user_phone,'user_phone':user_phone,'remarks':remarks,'new_field':jsonObj};

//            var new_field1 =
//            if($('#customer').val() == ''){
//                $('#customer_error').html('<span class="error">姓名不能为空!</span>');
//                $('#customer').val().focus();
//                customer = false;
//                return false;
//            }else {
//                $('#customer_error').html('');
//            }
//
//            if($('#consignee').val() == ''){
//                $('#consignee_error').html('<span class="error">收货人姓名不能为空!</span>');
//                $('#consignee').val().focus();
//                consignee = false;
//                return false;
//            }else {
//                $('#consignee_error').html('');
//            }
//
//            if($('#phone').val() == ''){
//                $('#phone_error').html('<span class="error">收货人手机号码不能为空!</span>');
//                $('#phone').val().focus();
//                phone = false;
//                return false;
//            }else {
//                $('#phone_error').html('');
//            }
//
//            if($('#address').val() == ''){
//                $('#address_error').html('<span class="error">详细地址不能为空!</span>');
//                $('#address').val().focus();
//                address = false;
//                return false;
//            }else {
//                $('#address_error').html('');
//            }

            var url = "<?php echo url('Bank/Sales/order_details',['sid'=>$sid,'aid'=>$aid]); ?>";
            $('.input_error').html('');
            $.ajax({
                async:false,
                url:url,
                data:arr,
                type:'post',
                dataType:'json',
                success:function(res){

                    $('#submit').attr('data-status',0);
                    if(res.status != 1){
                        var len=$('#length').val();
                        if(len != undefined){
                            if(ID_num.length<len){
                                $('#ID_num_error').html('<span class="error" style="height: 10px">请输入正确身份证号码后'+len+'位</span>');
                                return false;
                            }
                        }
                        if(res.data != ''){
                            for (var index in res.data) {
                                if (res.data[index] != undefined) {
                                    $('#' + index + '_error').html('<span class="error" style="height: 10px">' + res.data[index] + '</span>');
                                } else {
                                    $('#' + index + '_error').html('');
                                }
                            }
                        }
                        if(res.title != ''){
                            $('#'+res.title).html('<span class="error" style="height: 10px">'+res.title+'不能为空</span>');
                            return false;
                        }
//                        console.log(res.data);return;
                    }else{
                        var len=$('#length').val();
                        if(len != undefined){
                            if(ID_num.length<len){
                                $('#ID_num_error').html('<span class="error" style="height: 10px">请输入正确身份证号码后'+len+'位</span>');
                                return false;
                            }
                        }
                        $('.center_box').fadeIn(200);

                        $('.btn_conform').click(function(){
                            location.href=res.data;
                            $('.center_box').fadeOut(200);
                        });
                        $('.cont_btn').click(function(){
                            location.href="<?php echo url('Bank/Sales/goodsList',['sid'=>$sid,'aid'=>$activity_id,'level_id'=>$level_id]); ?>";
                            $('.center_box').fadeOut(200);
                        });
                    }
//                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
//                        alert(res.msg);
                    $('#submit').attr('data-status',0);
                    alert('网络失败，请刷新页面后重试!');
                }
            });
//            }else{
//                return false;
//            }
        })
    })
</script>
</body>
</html>