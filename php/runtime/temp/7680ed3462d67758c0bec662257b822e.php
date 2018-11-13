<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:41:"./application/admin/view2/code\codes.html";i:1542092322;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
                            console.log(log);
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="margin-top: -50px;">
    <div class="flexigrid">
        <div class="mDiv" style="padding-bottom: 10px;">
            <div class="tDiv2" style="padding: 0px;">

                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="downloadErcodes('<?php echo $batch; ?>','<?php echo count($lists); ?>',0)">
                        <div class="add" title="导出数字码Excel">
                            <span><i class="fa fa-angle-down"></i>导出数字码Excel</span>
                        </div>
                    </a>
                </div>
                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="downloadErcodes('<?php echo $batch; ?>','<?php echo count($lists); ?>',1)">
                        <div class="add" title="下载二维码">
                            <span><i class="fa fa-download"></i>打包下载二维码</span>
                        </div>
                    </a>
                </div>

                <div class="fbutton">
                    <a onclick="annul_all_code();" href="javascript:void(0)" id="">
                        <div class="add" title="作废">
                            <span><i class="fa fa-remove"></i>作废二维码</span>
                        </div>
                    </a>
                </div>

                <form action="<?php echo U('code/codes',array('aid'=>$aid,'batch'=>$batch)); ?>" id="search-form2" class="navbar-form form-inline" method="post" style="float: right">
                    <div class="sDiv" style="float: right">
                        <span>兑换码筛选:</span>
                        <div class="sDiv2">
                            <select name="type" id="type">
                                <option value="0" <?php if($type==0): ?> selected = "selected"<?php endif; ?>>未使用</option>
                                <option value="1" <?php if($type==1): ?> selected = "selected"<?php endif; ?>>已使用</option>
                            </select>
                            <input type="text" size="30" name="key_word" class="qsbox" placeholder="订单编号/支行/经理名称" value="<?php echo $keyword; ?>">
                            <input type="submit" class="btn" value="搜索">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th align="sign" abbr="ac_id" axis="col0" class="">
                            <div style="text-align: center; width: 80px;" class="">
                                <input type="checkbox" id="chk_all" onclick="$('input[name*=\'code_id\']').prop('checked', this.checked);">
                                全选
                            </div>
                        </th>
                        <!--<th class="sign" axis="col0">-->
                            <!--<div style="width: 24px;"><i class="ico-check"></i></div>-->
                        <!--</th>-->
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">兑换码编号</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 150px;" class="">二维码</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">兑换码所属档次</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">创建时间</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">使用时间</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 120px;" class="">操作</div>
                        </th>
                        <th style="width:100%" axis="col7">
                            <div></div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table>
                    <tbody>
                    <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): ?>
                        <form id="code_form">
                            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td align="sign" class="">
                                        <div style="text-align: center; width: 80px;">
                                            <input type="checkbox" name="code_id[]" value="<?php echo $list['id']; ?>">
                                        </div>
                                    </td>
                                    <!--<td class="sign">-->
                                        <!--<div style="width: 24px;"><i class="ico-check"></i></div>-->
                                    <!--</td>-->
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 150px;"><?php echo $list['code']; ?></div>
                                    </td>
                                    <td align="center" class="">
                                        <div class="show_ercode" style="text-align: center; width: 150px;">
                                            <img style="cursor:pointer;" width="50" height="50" data-src="<?php echo $list['code_url']; ?>" src="/public/images/ercode.png" />
                                        </div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;"><?php echo $levels[$list['level_id']]; ?></div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;">
                                            <?php echo $list['create_time']; ?>
                                        </div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;">
                                            <?php if($list['use_status'] == '1'): ?>
                                                <span style="color:blue;"><?php echo $list['use_time']; ?></span>
                                            <?php else: ?>
                                                <span style="color:green;"></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td align="center" class="">
                                        <div style="text-align: center; width: 120px;">
                                            <?php if($list['use_status'] == 1): ?>
                                                <span style="color:green;">已使用</span>
                                                <?php elseif($list['use_status'] == 2): ?>
                                                <span style="color:red;">已作废</span>
                                                <?php else: ?>
                                                <div class="fbutton">
                                                    <a href="javascript:void(0)" class="annul_code" id="<?php echo $list['id']; ?>">
                                                        <div class="del" title="作废">
                                                            <span><i class="fa fa-remove"></i>作废</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td align="" class="" style="width: 100%;">
                                        <div></div>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </form>
                        <?php else: ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): ?>
                    <!--分页位置-->
                    <?php echo $pager->show(); endif; ?>
            </div>
        </div>
    </div>

    <div id="hover_box" style="position: fixed;width: 200px;height: 200px;background: #fff;padding: 10px;display: none;z-index: 99">
        <img id="show_img" style="width: 100%" src="" alt="">
    </div>

    <script>
        //全选
        function ckAll(){
            var flag=document.getElementById("chk_all").checked;
            var cks=document.getElementsByName("check");
            for(var i=0;i<cks.length;i++){
                cks[i].checked=flag;
            }
        }

        $('.show_ercode>img').hover(
                function(event){
                    var e = event || window.event;
                    var img_src = $(this).attr('data-src');
                    $('#show_img').attr('src',img_src);
                    $('#hover_box').css({
                        'top':e.clientY-50,
                        'left':e.clientX-250,
                        'display':'block'
                    });
                },
                function(){
                    $('#show_img').attr('src','');
                    $('#hover_box').css({
                        'display':'none'
                    });
                }
        );

        /**
         * 导出兑换码
         * @param batch
         * @param num
         * @param type
         * @returns {boolean}
         */
        function downloadErcodes(batch,num,type){
            var aid = '<?php echo (isset($aid) && ($aid !== '')?$aid:0); ?>';
            if(num <= 0){
                layer.msg('请先创建兑换码', {icon: 2, time: 3000});
                return false;
            }

            window.location.href = '<?php echo url("Admin/Code/codes"); ?>?export=1&aid='+aid+'&batch='+batch+'&type='+type;
        }

        $(document).ready(function () {
            // 点击刷新数据
            $('.fa-refresh').click(function () {
                location.href = location.href;
            });
        });

        /**
         * 作废兑换码
         */
        $('.annul_code').click(function () {
            if((window.confirm("删除是不可恢复的，你确认要删除吗？"))){
                var this_id = this.id;
//                console.log(this_id);return;
//            var aid = $("#a_id").val();
                $.ajax({
                    type: "POST",
                    dataType:'json',
                    url:"<?php echo U('Admin/Code/change_status'); ?>",
                    data: {'id':this_id},// 你的formid
                    success: function (data) {
//                        console.log(data);return;
                        alert("删除成功");
                        window.location.reload();
//                    $('#code_'+this_id).remove();
                    },
                    error : function() {
                        alert("请求失败");
                    }
                });
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


        function annul_all_code()
        {
            if((window.confirm("删除是不可恢复的，你确认要删除吗？"))){
                if($("input[type='checkbox']:checked").length == 0)
                {
                    layer.alert('请选择要作废的兑换码', {icon: 2});
                    return false;
                }
                $.ajax({
                    url:"<?php echo U('Admin/Code/change_all_status'); ?>",
                    type:'post',
                    dataType:'json',
                    data: $("#code_form").serialize(),
                    success:function(obj){
    //                    console.log(obj);return;
                        if(obj.status !=1){
                            layer.msg(obj.msg, {icon: 2, time: 3000}); //alert(v.msg);
                        }else{
                            layer.msg(obj.msg, {icon: 1, time: 1000}); //alert(v.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },1000);
                        }
                    }
                });
            }else{
                return false;
            }
        }
    </script>
</body>
</html>