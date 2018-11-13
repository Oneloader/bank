<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./application/admin/view2/goods\ajaxGoodsList.html";i:1540362874;}*/ ?>
<style>
    .has{
        color:white!important;
        background-color: #0ba4da!important;
    }
</style>
<table>
    <tbody>
    <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td class="sign">
                <div style="width: 24px;"><i class="ico-check"></i></div>
            </td>
            <td align="center" axis="col0">
                <div style="text-align: left; width: 150px;"><?php echo getSubstr($list['goods_name'],0,15); ?></div>
            </td>
            <td align="center" axis="col0">
                <div style="text-align: left; width: 150px;"><?php echo getSubstr($list['goods_name_en'],0,15); ?></div>
            </td>
            <td align="center" axis="col0">
                <div style="text-align: center;width: 80px;"><?php echo $list[cat_str]; ?></div>
            </td>
            <td align="center" axis="col0">
                <div style="text-align: left; width: 150px;"><?php echo round($list['goods_price'],2); ?></div>
            </td>
            <!--<td align="center" axis="col0">-->
                <!--<div style="text-align: left; width: 150px;"><?php echo $list['goods_spu']; ?></div>-->
            <!--</td>-->
            <td align="center" axis="col0">
                <div style="text-align: center; width: 200px;">
                    <img width="100" src="<?php echo $list['original_img']; ?>" title="<?php echo $list['goods_name']; ?>" />
                </div>
            </td>

            <td align="center" class="">
                <div style="text-align: center; width: 150px;">
                    <a class="btn red" href="javascript:void(0)" onclick="del_goods('<?php echo $list[goods_id]; ?>',this)"><i class="fa fa-trash-o"></i>删除</a>
                    <a href="<?php echo U('Admin/goods/addEditGoods',array('id'=>$list['goods_id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                </div>
            </td>

            <td align="" class="" style="width: 100%;">
                <div>&nbsp;</div>
            </td>
        </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<!--分页位置--> <?php echo $page; ?>
<script>
    // 点击分页触发的事件
    $(".pagination  a").click(function () {
        cur_page = $(this).data('p');
        ajax_get_table('search-form2', cur_page);
    });
</script>