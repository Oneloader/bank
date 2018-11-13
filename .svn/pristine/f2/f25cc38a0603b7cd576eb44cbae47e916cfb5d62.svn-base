<?php
namespace app\admin\validate;
use think\Validate;
class Goods extends Validate
{
    // 验证规则
    protected $rule = [
        ['goods_name','require','商品名称必填'],
        ['goods_remark','require','商品简介必填'],
        ['original_img', 'require', '商品封面图必须上传'],
    ];
}