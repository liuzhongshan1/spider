<?php
// composer下载方式
// 先使用composer命令下载：
// composer require owner888/phpspider
// 引入加载器
//require './vendor/autoload.php';

// GitHub下载方式
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(

	'log_show' => false,
	
	
	
    'name' => '神段子网',
	
	
	
	'log_show' => false,
	'interval' => 7000,
	'export' => array(
		'type' => 'csv',
		'file' =>'./data/shen.csv',
	
	),
	'user_agent' => array(
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
    "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
	),
	
	 'client_ip' => array(
		'58.254.132.81',
		'60.195.3.180',
		'61.133.51.6',
	 
	 ),

	
	
	
    'domains' => array(
        
        'www.shenduanzi.cn',
        'shenduanzi.cn'
    ),
    'scan_urls' => array(
        'http://www.shenduanzi.cn/'
    ),
    'content_url_regexes' => array(
        "www.caoegg.cn/\d+\.html"
    ),
    'list_url_regexes' => array(
        "www.caoegg.cn/page/\d+"
    ),
    'fields' => array(
        array(
            // 抽取内容页的文章内容
            'name' => "article_content",
            'selector' => "//div[@class='main clearfix']/p[1]",
            'required' => true
        ),
        array(
            // 抽取内容页的文章作者
            'name' => "article_author",
            'selector' => "//div[@class='top clearfix']/h2/a/text()",
            'required' => true
        ),
    ),
);
$spider = new phpspider($configs);
$spider->start();