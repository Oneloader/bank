<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view2/goods\categoryList.html";i:1539846457;s:44:"./application/admin/view2/public\layout.html";i:1539765626;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default;">
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商品分类管理</h3>
                <h5>商城文章分类添加与管理</h5>
            </div>
        </div>
    </div>
    <div id="explanation" class="explanation">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom"></span>
        </div>
        <ul>
            <li>温馨提示：目前前端只支持顶级分类展示</li>
        </ul>
    </div>
    <form method="post">
        <input type="hidden" value="ok" name="form_submit">
        <div class="flexigrid">
            <div class="mDiv">
                <div class="ftitle">
                    <h3>商品分类列表</h3>
                    <h5></h5>
                </div>
                <div class="tDiv2" style="padding:0px;">
                    <a href="<?php echo U('Goods/addEditCategory'); ?>">
                        <div class="fbutton">
                            <div title="新增分类" class="add">
                                <span><i class="fa fa-plus"></i>新增分类</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th align="center" axis="col0" class="sign">
                                <div style="text-align: center; width: 24px;"><i class="ico-check"></i></div>
                            </th>
                            <th axis="col3">
                                <div style="text-align: left; width: 200px;">分类名称</div>
                            </th>
                            <th align="center" axis="col1" class="">
                                <div style="text-align: center; width: 220px;">操作</div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div style="height: auto;" class="bDiv">
                <table cellspacing="0" cellpadding="0" border="0" id="article_cat_table" class="flex-table autoht">
                    <tbody id="treet1">
                    <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$vo): ?>
                        <tr data-level="<?php echo $vo[level]; ?>" parent_id_path="<?php echo $vo['parent_id_path']; ?>"
                            class="parent_id_<?php echo $vo['parent_id']; ?>" nctype="0"
                        <?php if($vo[level] > 1): ?> style="display:none;"<?php endif; ?>
                        >
                        <td class="sign">
                            <?php if($vo[level] < 3): ?>
                                <!--<div style="text-align: center; width: 24px;">
                                    <img onClick="treeClicked(this,<?php echo $vo['id']; ?>,'<?php echo $vo['parent_id_path']; ?>')" nc_type="flex" status="open" fieldid="2" src="/public/static/images/tv-expandable.gif">
                                </div>-->
                                <div style="text-align: center; width: 24px;"><i class="ico-check"></i></div>
                            <?php endif; ?>
                        </td>

                        <td class="name">
                            <div style="text-align: left; width: 200px;">
                                <span><?php echo $vo['name']; ?></span>
                                    <!--<input type="text" value="<?php echo $vo['name']; ?>" onChange="changeTableVal('goods_category','id','<?php echo $vo['id']; ?>','name',this)" style="width:150px;margin-left:<?php echo ($vo[level] * 10); ?>px;"/>-->
                            </div>
                        </td>


                        <td align="center" class="">
                            <div style="text-align: center; width: 220px;">
                               <!-- <a href="<?php echo U('Goods/addEditCategory',array('parent_id'=>$vo['id'])); ?>">新增下级分类</a>-->
                                <a class="btn red" href="javascript:del_fun('<?php echo U('Goods/delGoodsCategory',array('id'=>$vo['id'])); ?>');" ><i class="fa fa-trash-o"></i>删除</a>
                                <!--<input type="hidden" id="void" value="$vo['id']">-->
                                <!--<a class="btn red" href="javascript:void(0)" id="del"><i class="fa fa-trash-o"></i>删除</a>-->
                                <a href="<?php echo U('Goods/addEditCategory',array('id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                            </div>
                        </td>
                        <td style="width: 100%;">
                            <div>&nbsp;</div>
                        </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<script>
    $(document).ready(function () {
        // 表格行点击选中切换
        $('.bDiv > table>tbody >tr').click(function () {
            $(this).toggleClass('trSelected');
        });
    });

    //打标签
    function setTags(id, name) {
        var url = "<?php echo U('Admin/Goods/setTagsToCat'); ?>?id=" + id;
        layer.open({
            type: 2,
            title: '给商品分类【' + name + '】推荐对象',
            shadeClose: true,
            shade: 0.2,
            area: ['50%', '95%'],
            content: url
        });
    }

    // 点击展开 收缩节点
    function treeClicked(obj, cat_id, parent_id_path) {
        var src = $(obj).attr('src');
        if (src == '/public/static/images/tv-expandable.gif') {
            $(".parent_id_" + cat_id).show();
            $(obj).attr('src', '/public/static/images/tv-collapsable-last.gif');
        } else {
            $("tr[parent_id_path^='" + parent_id_path + "_']").hide().find('img').attr('src', '/public/static/images/tv-expandable.gif');
            $(obj).attr('src', '/public/static/images/tv-expandable.gif');

        }
    }
//    $(function () {
//        $('#del').on('click',function(){
//            var id = $('#void').val;
//            var url = "<?php echo U('Goods/delGoodsCategory'); ?>";
//            $.ajax({
//                async:false,
//                url:url,
//                //url:'/index.php?m=Admin&c=Admin&a=login&t='+Math.random(),
//                type:'get',
//                data:{'id':id},
//                dataType:'json',
//                success:function(res){
//                    if(res.status != 1){
//                        alert(res.msg);
//                    }else{
//                        alert(res.msg);
//                    }
//                },
//                error : function(XMLHttpRequest, textStatus, errorThrown) {
//                    alert('网络失败，请刷新页面后重试!');
//                }
//            });
//        })
//    })
</script>
</body>
</html>