<?php
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
	
	'export' => array(
		'type' => 'csv',
		'file' =>'./data/ma.csv',
	
	),

	'interval' => 5000,
	
	'user_agent' => array(
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
    "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
),
	
	'client_ip' => array(
    '106.121.15.59', 
    '106.121.16.57', 
    '106.121.65.57', 
    '106.161.15.57', 
    '103.121.15.57', 

	),


    'name' => '马蜂窝',
    'tasknum' => 1,
    //'save_running_state' => true,
    'log_show' => false,
    'domains' => array(
        'www.mafengwo.cn'
    ),
    'scan_urls' => array(
        "http://www.mafengwo.cn/travel-scenic-spot/mafengwo/10088.html",            // 随便定义一个入口，要不然会报没有入口url错误，但是这里其实没用
    ),
    'list_url_regexes' => array(
        "http://www.mafengwo.cn/mdd/base/list/pagedata_citylist\?page=\d+",         // 城市列表页
        "http://www.mafengwo.cn/gonglve/ajax.php\?act=get_travellist\&mddid=\d+",   // 文章列表页
    ),
    'content_url_regexes' => array(
        "http://www.mafengwo.cn/i/\d+.html", //入口处得来的文件 再匹配 这个页面中的文章列表页    城市直接ajaxpost
    ),
    //'export' => array(
        //'type' => 'db', 
        //'table' => 'mafengwo_content',
    //),
    'fields' => array(
        // 标题
        array(
            'name' => "name",
            'selector' => "//h1[contains(@class,'headtext')]",
            //'selector' => "//div[@id='Article']//h1",
            'required' => true,
        ),
        // 分类
        array(
            'name' => "city",
            'selector' => "//div[contains(@class,'relation_mdd')]//a",
            'required' => true,
        ),
        // 出发时间
        array(
            'name' => "date",
            'selector' => "//li[contains(@class,'time')]",
            'required' => true,
        ),
    ),
);

$spider = new phpspider($configs);

$spider->on_start = function($phpspider) 
{
    requests::set_header('Referer','http://www.mafengwo.cn/mdd/citylist/21536.html');
};

$spider->on_scan_page = function($page, $content, $phpspider) 
{
    //for ($i = 0; $i < 298; $i++) 
    //测试的时候先采集一个国家，要不然等的时间太长
    for ($i = 0; $i < 1; $i++) 
    {
        // 全国热点城市
        $url = "http://www.mafengwo.cn/mdd/base/list/pagedata_citylist?page={$i}";
        $options = array(
            'method' => 'post',
            'params' => array(
                'mddid'=>21536,
                'page'=>$i,
            )
        );
        $phpspider->add_url($url, $options);
    }
};

$spider->on_list_page = function($page, $content, $phpspider) 
{
    // 如果是城市列表页
    if (preg_match("#pagedata_citylist#", $page['request']['url']))
    {
        $data = json_decode($content, true);
        $html = $data['list'];
        preg_match_all('#<a href="/travel-scenic-spot/mafengwo/(.*?).html"#', $html, $out);
        if (!empty($out[1])) 
        {
            foreach ($out[1] as $v) 
            {
                $url = "http://www.mafengwo.cn/gonglve/ajax.php?act=get_travellist&mddid={$v}";
                $options = array(
                    'method' => 'post',
                    'params' => array(
                        'mddid'=>$v,
                        'pageid'=>'mdd_index',
                        'sort'=>1,
                        'cost'=>0,
                        'days'=>0,
                        'month'=>0,
                        'tagid'=>0,
                        'page'=>1,
                    )
                );
                $phpspider->add_url($url, $options);
            }
        }
    }
    // 如果是文章列表页
    else 
    {
        $data = json_decode($content, true);
        $html = $data['list'];
        // 遇到第一页的时候，获取分页数，把其他分页全部入队列
        if ($page['request']['params']['page'] == 1)
        {
            $data_page = trim($data['page']);
            if (!empty($data_page)) 
            {
                preg_match('#<span class="count">共<span>(.*?)</span>页#', $data_page, $out);
                for ($i = 0; $i < $out[1]; $i++) 
                {
                    $v = $page['request']['params']['mddid'];
                    $url = "http://www.mafengwo.cn/gonglve/ajax.php?act=get_travellist&mddid={$v}&page={$i}";
                    $options = array(
                        'method' => 'post',
                        'params' => array(
                            'mddid'=>$v,
                            'pageid'=>'mdd_index',
                            'sort'=>1,
                            'cost'=>0,
                            'days'=>0,
                            'month'=>0,
                            'tagid'=>0,
                            'page'=>$i,
                        )
                    );
                    $phpspider->add_url($url, $options);
                }
            }
        }

        // 获取内容页
        preg_match_all('#<a href="/i/(.*?).html" target="_blank">#', $html, $out);
        if (!empty($out[1])) 
        {
            foreach ($out[1] as $v) 
            {
                $url = "http://www.mafengwo.cn/i/{$v}.html";
                $phpspider->add_url($url);
            }
        }

    }
};

$spider->on_extract_field = function($fieldname, $data, $page) 
{
    if ($fieldname == 'date') 
    {
        $data = trim(str_replace(array("出发时间","/"),"", strip_tags($data)));
    }
    return $data;
};

$spider->start();
