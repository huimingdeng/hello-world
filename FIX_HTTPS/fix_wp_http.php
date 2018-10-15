<?php 
/**
 * Script Name: fix_wp_http
 * Version: 2.1
 * Author: huimingdeng
 * CreateTime: Oct,10,2018
 * MTime: Oct,10,2018 17:00
 */
error_reporting(0);
require './wp-config.php';

date_default_timezone_set("Asia/Shanghai");
global $wpdb;
// 获取文章数量，返回对象
$post_count_obj = wp_count_posts('post'); # 函数参数为 post/page

$post_publish = $post_count_obj->publish;

// 查询wp中已经发布状态下的文章，获取一条
$page = 0;
$update = "UPDATE wp_posts SET `post_content`='%s' WHERE ID=%s";
for ($i=0; $i < $post_publish; $i++) { 
	$page = $i;
	$offset = 1;
	$sql = sprintf("SELECT * FROM wp_posts WHERE post_status='publish' and post_type='post' order by ID limit %s;",$page.','.$offset);

	// $post_one_array = array();//清空数组
	$post_one_array = $wpdb->get_row($sql,ARRAY_A);
	
	if(!empty($post_one_array['post_content'])&&haveDomainHttp($post_one_array['post_content'])){
		$new_content = getReplaceDomain($post_one_array['post_content']);
		$post_one_array['post_content'] = '';
		$post_one_array['post_content'] = $new_content;
		// $bool = wp_update_post($post_one_array);
		$query = $wpdb->query(sprintf($update,addslashes($new_content),$post_one_array['ID']));
		if($query){
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Notec: 文章 '.$post_one_array['ID'].' 中的 http 协议替换成 https 协议。'."\n",FILE_APPEND);
		}else{
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Error: 文章 '.$post_one_array['ID'].' 中的 http 协议无法替换成 https 协议。'."\n",FILE_APPEND);
		}
		/*if($bool>0){
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Notec: 文章 '.$bool.' 中的 http 协议替换成 https 协议。'."\n",FILE_APPEND);
		}else{
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Error: 文章 '.$bool.' 中的 http 协议无法替换成 https 协议。'."\n",FILE_APPEND);
		}*/
	}else{
		file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Notec: 文章 '.$post_one_array['ID'].' 中的正文无 http 协议。'."\n",FILE_APPEND);
	}

	/*if(!empty($post_one_array['post_content'])&&haveDomainHttps($post_one_array['post_content'])){
		$new_content = getRestoreDomain($post_one_array['post_content']);
		$post_one_array['post_content'] = '';
		$post_one_array['post_content'] = $new_content;
		wp_update_post($post_one_array);
		if($bool>0){
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Notec: 文章 '.$bool.' 中的 https 协议替换成 http 协议。'."\n",FILE_APPEND);
		}else{
			file_put_contents("./fix-wp_posts-https.logs.txt",'['.date('Y-m-d H:i:s').'] Error: 文章 '.$bool.' 中的 https 协议无法替换成 http 协议。'."\n",FILE_APPEND);
		}
	}*/
}


function haveDomainHttp($conetent){
	if(preg_match_all('/(http:\/\/www\.genecopoeia\.com|http:\/\/genecopoeia\.com|http:\/\/othello\.genecopoeia\.com)/', $conetent, $matches)){
		return true;
	}else{
		return false;
	}
}

function getReplaceDomain($conetent){
	if(haveDomainHttp($conetent))
	{
		$new_content_v0 = preg_replace('/(http:\/\/www\.genecopoeia\.com)/','https://www.genecopoeia.com',$conetent);
		$new_content_v1 = preg_replace('/(http:\/\/genecopoeia\.com)/','https://genecopoeia.com',$new_content_v0);
		$new_content = preg_replace('/(http:\/\/othello\.genecopoeia\.com)/','https://othello.genecopoeia.com',$new_content_v1);
		return $new_content;
	}else{
		return $conetent;
	}
}

// -------------------------------------------------------------------------------

function haveDomainHttps($conetent){
	if(preg_match_all('/(https:\/\/www\.genecopoeia\.com|https:\/\/genecopoeia\.com|https:\/\/othello\.genecopoeia\.com)/', $conetent, $matches)){
		return true;
	}else{
		return false;
	}
}
// 还原
function getRestoreDomain($conetent){
	if(haveDomainHttps($conetent))
	{
		$new_content_v0 = preg_replace('/(https:\/\/www\.genecopoeia\.com)/','http://www.genecopoeia.com',$conetent);
		$new_content_v1 = preg_replace('/(https:\/\/genecopoeia\.com)/','http://genecopoeia.com',$new_content_v0);
		$new_content = preg_replace('/(https:\/\/othello\.genecopoeia\.com)/','http://othello.genecopoeia.com',$new_content_v1);
		return $new_content;
	}else{
		return $conetent;
	}
}

