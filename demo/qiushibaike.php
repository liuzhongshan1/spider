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

	//'log_show' => true,
	
	
	
    'name' => '糗事百科',
	
	
	
	'log_show' => false,
	'interval' => 8000,
	'export' => array(
		'type' => 'csv',
		'file' =>'./data/qqq.csv',
	
	),


	
	
	
    'domains' => array(
        'qiushibaike.com',
        'www.qiushibaike.com'
    ),
    'scan_urls' => array(
        'https://www.qiushibaike.com/'
    ),
    'content_url_regexes' => array(
        "https://www.qiushibaike.com/article/\d+"
    ),
    'list_url_regexes' => array(
        "https://www.qiushibaike.com/8hr/page/\d+/"
    ),
    'fields' => array(
        array(
            // 抽取内容页的文章内容
            'name' => "article_content",
            'selector' => "//a[contains(@class,'contentHerf')]/div[1]/span",
            'required' => true
        ),
        array(
            // 抽取内容页的文章作者
            'name' => "article_author",
          //'selector' => "//div[contains(@class,'author')]//h2",
          'selector' => "<div.*?span>(.*?)</span>",
			'selector_type' => 'regex',
            'required' => true
        ),
    ),
	

	
	
	
	
	
	
	
	
	
);
$spider = new phpspider($configs);
$spider->start();