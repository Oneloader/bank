<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//    //'goodsInfo/[:id]' => ['Home/Goods/goodsInfo',['method' => 'get', 'ext' => 'html'],'cache'=>3600]
//    //Home/Goods/goodsInfo/id/104.html
//];
//use think\Route;
// 注册路由到index模块的News控制器的read操作
//Route::get('goodsInfo/:id','home/goods/goodsInfo',['cache'=>['Home/Goods/goodsInfo',300]]);// 访问方式 http://www.K11APP2.0.com/goodsInfo/77.html
return [
    '[bank]'   => [
        ':sid$' => ['Bank/Index/index', ['sid' => '\w+']],      //用户银行首页
        'event/:sid' => ['Bank/Index/event', ['sid' => '\w+']],      //用户活动首页
        'doLogin/:sid' => ['Bank/Index/doLogin', ['sid' => '\w+']],      //用户兑换码登陆页
        'goodsList/:sid' => ['Bank/Index/goodsList', ['sid' => '\w+']],      //商品列表页
        'goods_info/:sid' => ['Bank/Index/goods_info', ['sid' => '\w+']],      //商品列表页
        'order_details/:sid' => ['Bank/Index/order_details', ['sid' => '\w+']],      //商品列表页


        'sales/:sid$' => ['Bank/Sales/index', ['sid' => '\w+']],      //银行客服经理首页
        'sales/login/:sid$' => ['Bank/Sales/login', ['sid' => '\w+']],      //银行客服经理登录页
        'sales/manager/:sid' => ['Bank/Sales/manager', ['sid' => '\w+']],      //银行客服经理数据统计页
        'sales/goodsList/:sid' => ['Bank/Sales/goodsList', ['sid' => '\w+']],      //银行客服经理商品列表页
        'sales/goods_info/:sid' => ['Bank/Sales/goods_info', ['sid' => '\w+']],      //银行客服经理商品详情页
        'sales/order_list/:sid' => ['Bank/Sales/order_list', ['sid' => '\w+']],      //银行客服经理商品详情页
        //'__miss__'  => 'public/error',
    ],
];