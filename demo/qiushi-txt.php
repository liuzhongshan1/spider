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
			'table' => 'qiubai_shenghuifu',
		),
		
		
		'name' => '糗事',
		
		/*
		'export' => array(
			'type' => 'csv',
			'file' => './ata/qiushi.csv',
			
		),//导出文件 csv sql db  查手册
		*/
		
		
		
		
		
		'domains' => [
			'qiushibaike.com',
			'www.qiushibaike.com'
		],
		'scan_urls' => [
			'https://www.qiushibaike.com/text/'
		],
		'content_url_regexes' => [
			'https://www.qiushibaike.com/article/\d+'
		],
		'list_url_regexes' => [
			'https://www.qiushibaike.com/text/page/\d+'
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
				'selector' => "//div[contains(@class,'author')]//h2",
				'required' => true
			],
			//作者头像
			[
				'name' => 'post_head',
				'selector' => "//div[@class='author clearfix']/a[1]/img[1]/@src",
				'required' => true
			],
			
			
			
			
			
			
			
			//文章内容
			[
				'name' => 'post_content',
				'selector' => "//div[@class='content']",
				'required' => true
			],
			//点赞数量
			[
				'name' => 'post_like',
				'selector' => "//div[@class='stats']//span[@class='stats-vote']//i",
				'required' => true
			],
			//不喜欢的数量
			[
				'name' => 'post_dislike',
				'selector' => "//div[@class='stats']//span[@class='stats-comments']//i",
				'required' => true
			],
			
			
			
			
			
			
			
			//神评论的名字  需要进一步处理  对应的帖子id  显示三个  状元榜眼探花
			[
				'name' => 'post_shenpinglun_name',
				'selector' => "//article[@id='godCmt']//a[@class='comments-table-main']//div[@class='cmt-name']/text()",
				'required' => true
			],
			//神评论的内容
			
			[
				'name' => 'post_shenpinglun_content',
				'selector' => "//article[@id='godCmt']//a[@class='comments-table-main']/div[2]/text()",
				'required' => true
			],
			
			//神评论的点赞数
			
			[
				'name' => 'post_shenpinglun_like',
				//'selector' => "//article[@id='godCmt']//a[@class='comments-table-main']/div[1]/div[3]/child::node()[3]",
				'selector' => "//*[@id='godCmt']/div/div/div[1]/a/div[1]/div[3]/child::node()[3]",
				'required' => true
			],
			
			//神评论的头像
			[
				'name' => 'post_shenpinglun_head',
				'selector' => "//article[@id='godCmt']//div[@class='comments-list-item']/div[@class='comments-table']/div[1]/a[1]/img/@src",
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
		
		'name' => '糗事百科',

	];
$spider = new phpspider($config);







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

//添加新的爬虫地址	
	$spider->on_list_page = function($page, $content, $phpspider) 
	{
			for($i=6;$i<=12;$i++){
				$urlnew = "https://www.qiushibaike.com/text/page/".$i;
				$phpspider->add_url($urlnew);
			}
			
		
	};




//对当前下载的网站内容$page  得到的匹配数据$data做修改 
$spider->on_extract_page = function ($page, $data)
{
	
	
	$data['post_content'] = trim($data['post_content'],"\n\n");
	
	//帖子的id
	$data['post_id'] = substr($page['url'],36);
	//拼接神回复
	//只能采集一个神回复

	
	
	
	
	
	//将回复插入数据库
	/*
	if($data['article_shenpinglun_name']){
		
		$pdo = new PDO("mysql:host=localhost;dbname=spider","root","013138");
			
		
		
		$pdo -> exec(sprintf("insert into qiubai_shenhuifu(huifu_name,huifu_content) value('%s','%s');",$data['article_author'],$data['article_shenpinglun_content']));

		
		
		

			
		
	}
	*/
	
	
	
	
	
	//if($data['article_head']){
		
	//	download($data['article_head']); 
	//}
	//神评论 名字 做修改  帖子ID  头像 名字 点赞数 内容
	/*
	if($data['article_shenpinglun_name']){
		$num = count($data['article_shenpinglun_name']);
		//神评论 一条一条拼凑起来
		
		for($x=0;$x<=$num;$x++){
			$a[$x] = array($data['article_shenpinglun_head'][$x],$data['article_shenpinglun_name'][$x],$data['article_shenpinglun_like'][$x],$data['article_shenpinglun_content'][$x]);
			
			$a[$x] = implode('!!',$a[$x]);	
		}
		$data['huifu'] = implode('||',$a);
		
		
		
	}
	*/
	return $data;
};















$spider->start();









?>