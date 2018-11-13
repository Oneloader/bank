<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think\log\driver;

use think\App;

/**
 * 本地化调试输出到文件
 */
class File1
{
    protected $config = [
        'time_format' => ' c ',
        'file_size'   => 2097152,
        'path'        => LOG_PATH,
        'apart_level' => [],
    ];

    // 实例化并传入参数
    public function __construct($config = [])
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 日志写入接口
     * @access public
     * @param array $log 日志信息
     * @param bool  $depr 是否写入分割线
     * @return bool
     */
    public function save($log,$depr = true)
    {
        /*if($this->config['switch'] == 0) return false;*/
        $now         = date($this->config['time_format']);
        $destination = $this->config['path'] . date('Ym') . DS . date('d') . '.log';

        $path = dirname($destination);
        !is_dir($path) && mkdir($path, 0755, true);

        //检测日志文件大小，超过配置大小则备份日志文件重新生成
        if (is_file($destination) && floor($this->config['file_size']) <= filesize($destination)) {
            rename($destination, dirname($destination) . DS . $_SERVER['REQUEST_TIME'] . '-' . basename($destination));
        }

        $depr = $depr ? "---------------------------------------------------------------\r\n" : '';
        $url = $log['url'];
        $params = json_encode($log['params']);
        $result = mb_substr(json_encode($log['data']),0,300);
        return error_log("[{$now}] {$url}\r\n{$params}\r\n{$result}\r\n{$depr}", 3, $destination);
    }
}
