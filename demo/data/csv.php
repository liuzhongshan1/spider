<?php
header("Content-type:text/html;charset=utf-8");
function get_file_line( $file_name, $line ){
  $n = 0;
  $handle = fopen($file_name,'r');
  if ($handle) {
    while (!feof($handle)) {
        ++$n;
        $out = fgets($handle, 4096);
        if($line==$n) break;
    }
    fclose($handle);
  }
  if( $line==$n) return $out;
  return false;
}

echo get_file_line("qiushi.csv", 2);



echo "<hr>";

$pdo = new PDO("mysql:host=localhost;dbname=spider","root","013138");
			
$data['article_shenpinglun_name'] = "刘中山";		
$data['article_shenpinglun_content'] = "刘中山ddddddddgh";		
printf("insert into qiubai_shenhuifu(huifu_name,huifu_content) value('%s','%s');",$data['article_shenpinglun_name'],$data['article_shenpinglun_content']);		

$pdo -> exec(sprintf("insert into qiubai_shenhuifu(huifu_name,huifu_content) value('%s','%s');",$data['article_shenpinglun_name'],$data['article_shenpinglun_content']));


