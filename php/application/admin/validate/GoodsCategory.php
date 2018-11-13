<?php
/**
 * K11APP
 *
 *
 *
 *
 *
 *
 *
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\admin\validate;
use think\Validate;
class GoodsCategory extends Validate {   
    // 验证规则
    protected  $rule = [
        'name'  => 'require|max:25',
        //'parent_id_1' => 'number|gt:0',
    ];
    protected $message = [
        'name.require' => '分类名称必须填写',
        'name.max'     => '名称最多不能超过8个中文字符',
        //'parent_id_1.number'   => '父级分类id必须为数字',
        //'parent_id_1.gt'  => '请选择顶级分类',
    ];
}
