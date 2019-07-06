<?php
require_once dirname(dirname(__FILE__)) . "/" . "wp-blog-header.php";
// require_once dirname(dirname(__FILE__)) . "/wp-admin/includes/media.php";

global $wpdb;

$sql = sprintf("SELECT title_trans AS title, keyword_trans as keyword, abstract_trans AS abstract, links, img_trans AS img,author,pub_date FROM pmc_crispr_v2 LIMIT 0,1");

$post = $wpdb->get_row($sql); // 默认 Object , ARRAY_A: 关联数组

// $img_name = $post->title;
// echo $img_name;exit;

// echo str_replace(' ', '-', $post->title);

// exit;

$one = str_replace(["\r\n", "\n", "\r"], '', $post->title);
$post_name = str_replace(' ', '-', $one);

$img_info = getimagesizefromstring(base64_decode($post->img));

print_r($img_info);exit;
// 根据 mime 判断后缀名
$img_ext = [
	"image/jpeg" => ".jpg",
	"image/png" => ".png",
	"image/gif" => ".gif",
];

$img_mime = $img_info['mime'];
$ext = $img_ext[$img_mime];

$year = date("Y", time());
$month = date("m", time());

$path = dirname(dirname(__FILE__)) . "/wp-content/uploads/" . $year . "/" . $month . "/" . $post_name . $ext;
$img_url = get_option('siteurl') . '/wp-content/uploads/' . $year . "/" . $month . "/" . $post_name . $ext;

$html_template = <<<EOF
<p>By:%s on %s</p>
<p><img src="%s"></p>
<p>%s</p>
<p><a href="%s" target="blank">%s</a></p>
<p>Keywords: %s</p>
EOF;

$html = sprintf($html_template, $post->author, date("Y/m/d", strtotime($post->pub_date)), $img_url, $post->abstract, $post->links, $post->links, $post->keyword);

$post_insert = [
	'post_title' => $post->title,
	'post_content' => $html,
	'post_excerpt' => mb_substr($post->abstract, 0, 200),
	'post_type' => 'post',
	'post_status' => 'publish',
	'comment_status' => 'closed', // 关闭 discussion
	'ping_status' => 'closed', // 关闭
	'post_author' => 1,
];

$post_id = wp_insert_post($post_insert);

// 模仿上传图片
// ( [my_image_upload] => Array ( [name] => （微信）分销商城.png [type] => image/png [tmp_name] => C:\Users\DHM\AppData\Local\Temp\php10EA.tmp [error] => 0 [size] => 166661 ) )

$tmp_name = dirname(__FILE__) . "/" . $post_name . $ext;
// print_r(getimagesizefromstring)
exit;

if (file_exists($tmp_name)) {
	unlink($tmp_name);
}
// 保存临时图片
// file_put_contents($tmp_name, base64_decode($post->img));
file_put_contents($path, base64_decode($post->img)); // 生成原图
// 生成 thumbnail 图片，压缩
// $thumbnail_path =
// file_put_contents($thumbnail_path, 'data');
// 获取 thumbnail 信息
$thumbnail = getimagesize($thumbnail_path);
// 生成 medium 图片
$medium = getimagesize($medium_path);
// 生成 medium_large 图片 扩大
$medium_large = getimagesize($medium_large_path);
// 生成 large 图片 扩大
$large = getimagesize($large_path);

// 获取图片类型
if (file_exists($path)) {
	$imge_size = filesize($tmp_name); // 103369

	// exit;
	// echo $tmp_name;exit;
	$file_id = 'my_image_upload';

	$_FILES[$file_id] = [
		"name" => $post_name . $ext,
		"type" => $img_mime,
		"tmp_name" => $tmp_name,
		"error" => 0,
		"size" => $imge_size,
	];

	// $bool = media_handle_upload( $file_id,  $post_id);
	// print_r($bool);
	/*if(file_exists($path)){
	        echo "ok".PHP_EOL;
*/
	// exit;
	$attachment_insert = [
		'post_title' => $post->title,
		'post_content' => '',
		'post_excerpt' => '',
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_parent' => $post_id, // 设定附件所属文章
		'guid' => $img_url,
		'post_mine_type' => $img_mime, // image/jpeg image/png image/gif
		'comment_status' => 'closed', // 关闭 discussion
		'ping_status' => 'closed', // 关闭
		'post_author' => 1,
	];

	$attachment_id = wp_insert_post($attachment_insert);
	// print_r($attachment_id);
	// 设定SEO 元素
	$meta = [
		"_aioseop_description" => substr($post->abstract, 0, 200),
		"_aioseop_title" => $post->title,
		"_aioseop_keywords" => $post->keyword,
		"_wp_attached_file" => $year . '/' . $month . '/' . $post_name . $ext,
		"_wp_attachment_metadata" => serialize([
			"width" => $img_info[0],
			"height" => $img_info[1],
			"file" => $year . "/" . $month . "/" . $post_name . $ext,
			"sizes" =>
			[
				"thumbnail" =>
				[
					"file" => $year . "/" . $month . "/" . $post_name . $thumbnail[0] . "x" . $thumbnail[1] . $ext,
					"width" => $thumbnail[0],
					"height" => $thumbnail[1],
					"mime-type" => $thumbnail['mime'],
				],

				"medium" => [

					"file" => $year . "/" . $month . "/" . $post_name . $medium[0] . "x" . $medium[1] . $ext,
					"width" => $medium[0],
					"height" => $medium[1],
					"mime-type" => $medium['mime'],
				],

				"medium_large" => [
					"file" => $year . "/" . $month . "/" . $post_name . $medium_large[0] . "x" . $medium_large[1] . $ext,
					"width" => $medium_large[0],
					"height" => $medium_large[1],
					"mime-type" => $medium_large['mime'],
				],

				"large" => [

					"file" => $year . "/" . $month . "/" . $post_name . $large[0] . "x" . $large[1] . $ext,
					"width" => $large[0],
					"height" => $large[1],
					"mime-type" => $large['mime'],
				],

			],

			"image_meta" => [
				"aperture" => 0,
				"credit" => '',
				"camera" => '',
				"caption" => '',
				"created_timestamp" => 0,
				"copyright" => '',
				"focal_length" => 0,
				"iso" => 0,
				"shutter_speed" => 0,
				"title" => '',
				"orientation" => 0,
				"keywords" => [],
			],
		])
	];

	foreach ($meta as $meta_key => $meta_value) {
		$meta_ids[$meta_key] = add_post_meta($post_id, $meta_key, $meta_value); // 判断 meta_id|false 是否成功
	}
}
