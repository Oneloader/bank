<?php
namespace app\bank\validate;
use think\Validate;
class Order extends Validate
{
    // 验证规则
    protected $rule = [
        ['customer','require|/[^\d\x22]+/','姓名必填|姓名不能有数字'],
        //['ID_num',['/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/'],'请填入正确的身份证号码'],
        ['ID_num','require','身份证号码必填'],
		['ID_num','validateIdCardLength','请按要求填入身份证号码',1,'callback'],
        ['consignee', 'require|/[^\d\x22]+/', '收货人姓名必填|收货人姓名不能有数字'],
        ['phone', ['require','max:11','/^(13[0-9]|14[5-9]|15[0-3|5-9]|166|17[1-8]|18[0-9]|19[89])\d{8}$/'], '收货人手机号码必填|请填入正确的手机号码|手机号码格式不正确'],
        ['province', 'require', '请选择省'],
        /*['city', 'require', '请选择市'],
        ['district', 'require', '请选择县'],*/
		['address', 'require|/[^\d\x22]+/', '收货地址必填|收货地址不能为数字'],
//        ['address', ['/^[\x7f-\xffA-Za-z\d\-\_]{5,60}+$/'], '收货地址格式不正确'],
        ['good_id', 'require', '缺少商品参数'],
        ['type', 'require', '缺少类型参数'],
        ['shop_num', 'require', '缺少商品数量参数'],
    ];
//[\u4e00-\u9fa5A-Za-z\d\-\_]{5,60}
//[\x7f-\xffA-Za-z\d\-\_]{5,60}

	/**
	 * 验证输入的身份证长度是否满足要求
	 */
	public function validateIdCardLength(){
		$aid = session('activity_id');
		if(empty($aid)){
			return false;
		}
		
		//查询活动要求输入的身份证长度
		$id_card_length = M('activity')->where(['id'=>$aid])->getField('id_length');
		if($id_card_length <= 0){
			return false;
		}
		
		$id_card = input('ID_num/s','');
		if(empty($id_card)){
			return false;		
		}
		
		if($id_card_length === strlen($id_card) && preg_match('/^[xX0-9]+$/',$id_card)){
			return true;
		}
		
		return false;
	}
}