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


//无法爬取 头像 评论 只能爬取 段子内容   

 $config = [
		'log_show' => false,//是否显示调试信息 面板显示、
		'log_type' => 'warn,debug,error ',//是否显示调试信息 面板显示、
		//'input_encoding' => 'utf-8',
		//'output_encoding' => 'utf-8',

		'tasknum' => 4,//同时爬取  进程数
		
		'interval' => 8*1000,//时间间隔
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
			'116.177.243.60',
			
		
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
			'table' => 'budejie_shenhuifu',
		),
		
		
		'name' => '不得姐',
		
		/*
		'export' => array(
			'type' => 'csv',
			'file' => './ata/qiushi.csv',
			
		),//导出文件 csv sql db  查手册
		*/
		
		
		
		
		
		'domains' => [
			'budejie.com',
			'www.budejie.com'
		],
		'scan_urls' => [
			'http://www.budejie.com/text/'
		],
		'content_url_regexes' => [
			'http://www.budejie.com/detail-\d+.html'
			
		],
		'list_url_regexes' => [
			'http://www.budejie.com/txt/\d+'
		],
		'fields' => [
			//文章id号
			
			[
				'name' => 'post_id',
				
				//'required' => true
			],
			
			//文章作者
			[
				'name' => 'post_author',
				'selector' => "//div[@class='j-list-user']/div[@class='u-txt']/a/text()",
				'required' => true
			],
			//作者头像
			[
				'name' => 'post_head',
				'selector' => "//div[@class='j-list-user']/div[@class='u-img']/a[1]/img[1]/@data-original",
				'required' => true
			],
			
			
			
			
			
			
			
			//文章内容
			[
				'name' => 'post_content',
				'selector' => "//div[@class='j-r-list-c-desc']/h1/text()",
				'required' => true
			],
			//点赞数量
			[
				'name' => 'post_like',
				'selector' => "//li[@class='j-r-list-tool-l-up']/span",
				'required' => true
			],
			//不喜欢的数量
			[
				'name' => 'post_dislike',
				'selector' => "//li[@class='j-r-list-tool-l-down ']/span",
				'required' => true
			],
			
			
			
			
			
			
			
			
			//神评论的内容
			
			[
				'name' => 'post_shenpinglun_content',
				'selector' => "//article[@id='godCmt']//a[@class='comments-table-main']/div[2]/text()",
				'required' => true
			],
			
			
			
			
			
			
			/*
			//评论的名字  需要进一步处理  对应的帖子id
			[
				'name' => 'article_shenpinglun_name',
				'selector' => "//article[@id='godCmt']//a[@class='comments-table-main']//div[@class='main-text']/text()",
				'required' => true
			],
			*/
			
			
			
			
			
		],
		
		'name' => '不得姐',

	];
$spider = new phpspider($config);







//当开始的时候设置user_agent
$spider -> on_start = function($phpspider){
	
	//设置请求头
	/*
	requests::set_header("Referer","http://www.budejie.com/text/");
	requests::set_header("Accept","text/html,application/xhtml+xml,application/xml;q=0.9;q=0.8");
	requests::set_header("Accept-Encoding","gzip,deflate");
	requests::set_header("Accept-Language","zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2");
	requests::set_header("Connection","keep-alive");
	requests::set_header("Cookie","Hm_lvt_7c9f93d0379a9a7eb9fb60319911385f=1515423826,1516543403,1516716027,1517062652; _ga=GA1.2.482609433.1491270477; tma=43102518.64520373.1491270477314.1517068933102.1517156920078.12; bfd_g=92d202420a015a0a00000d4a000559d258e2fb4b; tmd=48.43102518.41632093.1515423826431.; _gid=GA1.2.258628545.1517062652; Hm_lpvt_7c9f93d0379a9a7eb9fb60319911385f=1517237128; bfd_s=43102518.28402072.1517237127698; tmc=1.43102518.22370356.1517237127706.1517237127706.1517237127706");
	requests::set_header("Upgrade-Insecure-Requests","1");
*/
	
	
	
	
	
	
	
	
	//随机useragent
	requests::set_useragent(
		array(
			"Mozilla/5.0 (Windows NT 6.1; rv,2.0.1) Gecko/20100101 Firefox/4.0.1",
			
			"User-Agent, Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
			
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
			"Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
			
			)
	);
};




	//添加新的爬虫地址	
	$spider->on_list_page = function($page, $content, $phpspider) 
	{
			for($i=6;$i<50;$i++){
				$urlnew = "www.budejie.com/text/".$i;
				$phpspider->add_url($urlnew);
			}
			
		
	};


//对当前下载的网站内容$page  得到的匹配数据$data做修改 
$spider->on_extract_page = function ($page, $data)
{
	
	
	$data['post_content'] = trim($data['post_content'],"\n\n");
	
	//帖子的id
	$a=explode('/',$page['url']);
		
    $b = explode('.',end($a));
		
	$data['post_id'] =substr($b[0],7);
	
	
	
	
	
	//请求  拼接神回复
	$headers = array(
  
    'Referer: http://www.budejie.com'
	);
	
	$url = "http://api.budejie.com/api/api_open.php?a=datalist&per=5&c=comment&hot=1&appname=www&client=www&device=pc&data_id={$data['post_id']}&page=1";
	
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result,1);
		//var_dump($result);
		
		//var_dump($result['hot']);
		
		$a = array();
		if(is_array($result['hot'])){
			foreach($result['hot'] as $value){
				array_push($a,$value['user']['username']."|".$value['user']['profile_image']."|".$value['content']."|".$value['like_count']);
				
				
			}
			
			
			$d = implode("&&",$a);
			
			$data['post_shenpinglun_content'] = $d;
			
		}
		
		

	return $data;
};


	
	
	
	





















$spider->start();









?>