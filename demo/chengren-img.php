<?php
// composer下载方式
// 先使用composer命令下载：
// composer require owner888/phpspider
// 引入加载器
//require './vendor/autoload.php';

// GitHub下载方式
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;

/* Do NOT delete this comment */
/* 不要删除这段注释 */


 $config = [
		'log_show' => false,//是否显示调试信息 面板显示、
		'log_type' => 'warn,debug,error ',//是否显示调试信息 面板显示、
		//'input_encoding' => 'utf-8',
		//'output_encoding' => 'utf-8',

		'tasknum' => 5,//同时爬取  进程数
		
		'interval' => 4*1000,//时间间隔
		'timeout' => 10,//爬取一个网页的超时时间
		'max_try' => 3,//当某个页面爬取失败后 在请求一次  最大爬取两次
		'max_depth' => 3,//网页深度，抓取好友的好友也别有用
		'client_ip' => array(
			'192.168.3.7',
			'192.165.3.7',
			'196.169.3.7',
			'196.170.3.7',
			'196.171.3.7',
			'197.168.3.7',
			'196.168.4.7',
			'196.168.5.7',
			'196.168.6.7',
			'196.168.3.8',
			'196.168.3.9',
			'196.168.3.10',
			'196.168.7.7',
			'196.168.8.7',
			'196.178.3.7',
			'196.168.3.7',
			'199.168.3.7',
			'196.169.39.7',
			'192.198.9.7',
			'60.209.20.34',
			'61.133.51.6',
			'61.133.51.6',
			'61.156.3.166',
			'106.37.177.251',
			'111.1.36.6',
			'111.40.196.68',
			'116.236.216.116',
			'116.236.250.175',
			'117.177.243.47',
			'117.177.243.48',
			'117.177.243.37',
			'120.24.235.192',
			'120.24.235.193',
			'120.24.235.194',
			'120.24.235.195',
			'120.24.235.196',
			'120.24.235.197',
			'120.24.236.195',
			'120.25.235.195',
			'120.26.235.195',
			'121.24.235.195',
			'122.24.235.195',
			'116.178.243.60',
			'116.197.243.60',
			'116.177.243.60',
			'116.177.143.60',
			'116.177.243.60',
			'146.177.243.60',
			'116.187.243.60',
			'116.177.243.70',
			'116.177.249.60',
			'116.177.243.69',
			'116.171.243.60',
			'106.177.243.60',
			'116.117.244.60',
			'116.177.213.60',
			'116.177.223.60',
			'116.177.233.60',
			'116.177.243.60',
			'116.177.253.61',
			'116.177.243.62',
			'116.177.243.63',
			'116.177.243.64',
			'116.177.243.65',
			'116.177.243.66',
			'116.177.243.67',
			'116.177.243.68',
			'116.177.243.69',
			'116.177.243.80',
			'116.177.243.81',
			'116.177.243.82',
			'116.177.243.83',
			'116.177.243.84',
			'116.177.243.85',
			'116.177.243.86',
			'116.177.243.87',
			
		
		),//伪装IP地址
		
		
		
		'db_config' => array(
			 'host'  => '127.0.0.1',
			'port'  => 3306,
			'user'  => 'root',
			'pass'  => '013138',
			'name'  => 'spider',

		),//导出文件时候，数据库的配置
		
		
		'export' => array(
			'type' => 'db',
			'table' => 'chengren_img',
		),
		
		
		'name' => '成人图片',
		
		/*
		'export' => array(
			'type' => 'csv',
			'file' => './ata/qiushi.csv',
			
		),//导出文件 csv sql db  查手册
		*/
		
		
		
		
		
		'domains' => [
			'www.qiubaichengren.com',
			'qiubaichengren.com'
		],
		'scan_urls' => [
			'http://www.qiubaichengren.com/2.html'
		],
		'content_url_regexes' => [

			'http://www.qiubaichengren.com/miss/\d+.html',
			'http://www.qiubaichengren.com/gif/\d+.html'
		],
		'list_url_regexes' => [
			'www.qiubaichengren.com/\d+.html'
		],
		'fields' => [
			
			

			
			
			
		
			
			//内容图片j
			[
				'name' => 'img',
				'selector' => "//div[@class='mala-text']//img/@src",
				'required' => true
			],
			
			
			
			
			
			
			

			
			
			
			
			
			
			
		
			
		],
		


	];
$spider = new phpspider($config);

	//添加新的爬虫地址	
	$spider->on_list_page = function($page, $content, $phpspider) 
	{
			for($i=1;$i<970;$i++){
			
				$urlnew = "http://www.qiubaichengren.com/{$i}.html";
				$phpspider->add_url($urlnew);
			}
			
		
	};






//当开始的时候设置user_agent
$spider -> on_start = function($phpspider){
	// add_sacn_url 没有URL去重机制，可用作增量更新
  

	
	
	requests::set_useragent(
		array(
			"Mozilla/5.0 (Windows NT 6.1; rv,2.0.1) Gecko/20100101 Firefox/4.0.1",
			
			"User-Agent, Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
			
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
			"Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
			
			)
	);
};



//对当前下载的网站内容$page  得到的匹配数据$data做修改 
$spider->on_extract_page = function ($page, $data)
{
	

	
	
	
	
	
	download($data['img']);
	
	$filename = pathinfo($data['img'], PATHINFO_BASENAME);
	$data['img'] = $filename;
	return $data;
};















$spider->start();


//下载图片函数
	function download($url, $path = './meinv/'){
			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			  $file = curl_exec($ch);
			  curl_close($ch);
			  $filename = pathinfo($url, PATHINFO_BASENAME);
			  $resource = fopen($path . $filename, 'a');
			  fwrite($resource, $file);
			  
			  fclose($resource);
			
			
			
			}
					






?>