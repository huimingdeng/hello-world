<?php
require_once dirname(dirname(__FILE__)) . "/" . "wp-blog-header.php";
require_once dirname(__FILE__) . "/imgcompress.php";

// 获取网站域名，组装访问路径
$host = get_option('siteurl');
$year = date("Y", time());
$month = date("m", time());

global $wpdb;

$sql = sprintf("SELECT title_trans AS title, keyword_trans as keyword, abstract_trans AS abstract, links, img_trans AS img,author,pub_date FROM pmc_crispr_v2 LIMIT 0,1");

$posts = $wpdb->get_results($sql); // 默认 Object , ARRAY_A: 关联数组
if (!empty($posts)) {
	foreach ($posts as $post) {

		$one = str_replace(["\r\n", "\n", "\r"], '', $post->title);
		$two = str_replace("/", '', $one);
		$replace_name = str_replace(' ', '-', $two);
		$post_names = explode('-', $replace_name);
		// $post_name = strtolower($post_names[0]);
		$post_name = strtolower($replace_name);

		$post_insert = [
			'post_title' => $post->title,
			'post_content' => '',
			'post_excerpt' => '',
			'post_type' => 'post',
			'post_status' => 'publish',
			'comment_status' => 'closed', // 关闭 discussion
			'ping_status' => 'closed', // 关闭
			'post_author' => 1,
		];

		$post_id = wp_insert_post($post_insert);
		$post_data = get_post($post_id, ARRAY_A);
		$post_name = $post_data['post_name'];
		echo "Post " . $post_id . " was inserted successfully" . PHP_EOL;
// 设定SEO 元素
		$seo_meta = [
			"_aioseop_description" => substr($post->abstract, 0, 200),
			"_aioseop_title" => $post->title,
			"_aioseop_keywords" => $post->keyword,
		];

		foreach ($seo_meta as $meta_key => $meta_value) {
			$meta_ids[$meta_key] = add_post_meta($post_id, $meta_key, $meta_value); // 判断 meta_id|false 是否成功
			if ($meta_ids[$meta_key]) {
				echo "Post " . $post_id . " SEO elements(" . str_replace('_aioseop_', '', $meta_key) . ") created successfully." . PHP_EOL;
			} else {
				echo "Post " . $post_id . " SEO elements(" . str_replace('_aioseop_', '', $meta_key) . ") created failed." . PHP_EOL;
			}

		}

// 第二大步，模仿上传媒体库
		echo "Start generating pictures of post" . $post_id . PHP_EOL;
		$img_info = getimagesizefromstring(base64_decode($post->img));

// 根据 mime 判断后缀名
		$img_ext = [
			"image/jpeg" => ".jpg",
			"image/png" => ".png",
			"image/gif" => ".gif",
		];
		// print_r($img_info);
		$img_mime = $img_info['mime'];
		$ext = $img_ext[$img_mime];

		$file_name = $post_name . $ext;

// 模仿上传路径
		$absolute_path = dirname(dirname(__FILE__)) . "/wp-content/uploads/" . $year . "/" . $month . "/";
// 测试路径
		// $absolute_path = dirname(__FILE__) . "/images/";
		// 实际路径
		$path = $absolute_path . $file_name;

		$img_url = $host . '/wp-content/uploads/' . $year . "/" . $month . "/" . $file_name;

		if (file_exists($path)) {
			echo "File with the same name exists. Delete the file with the same name." . PHP_EOL;
			unlink($path);
		}
// 保存原图
		file_put_contents($path, base64_decode($post->img)); // 生成原图
		if (file_exists($path)) {
			echo "Post " . $post_id . " generated the original picture successfully." . PHP_EOL;
		}
// 生成 thumbnail 图 150x150
		$thumbnail_path = $absolute_path . $post_name . '-150x150' . $ext;
		if (file_exists($thumbnail_path)) {
			echo "File with the same name exists(thumbnail). Delete the file with the same name." . PHP_EOL;
			unlink($thumbnail_path);
		}
		$thumbnail_path = (new imgcompress($path, 0.5, true))->compressImg($absolute_path . $post_name);

		$thumbnail_bool = false;
		if (file_exists($thumbnail_path)) {
			$thumbnail_bool = true;
			echo "The Post" . $post_id . " has successfully generated  " . $file_name . " (thumbnail)..." . PHP_EOL;
		} else {
			echo "Failed to generate thumbnail of picture " . $file_name . PHP_EOL;
		}

		$thumbnail = getimagesize($thumbnail_path);

// 生成 medium 图
		$percent = 0.45;
		$medium_path = $absolute_path . $post_name . '-' . round($img_info[0] * $percent) . 'x' . round($img_info[1] * $percent) . $ext;
		if (file_exists($medium_path)) {
			unlink($medium_path);
			echo "File with the same name exists(medium). Delete the file with the same name." . PHP_EOL;
		}
		$medium_path = (new imgcompress($path, $percent))->compressImg($absolute_path . $post_name);
		$medium = getimagesize($medium_path);
		$medium_bool = false;
		if (file_exists($thumbnail_path)) {
			$medium_bool = true;
			echo "The Post" . $post_id . " has successfully generated  " . $file_name . "(medium) ..." . PHP_EOL;
		} else {
			echo "Failed to generate medium of picture " . $file_name . PHP_EOL;
		}

// 获取图片类型
		if (file_exists($path) && file_exists($thumbnail_path) && file_exists($medium_path)) {
			// $imge_size = filesize($tmp_name); // 103369
			// echo $img_mime . PHP_EOL;

			$attachment_insert = [
				'post_title' => $post_name,
				'post_type' => 'attachment',
				'post_status' => 'inherit',
				'post_parent' => $post_id, // 设定附件所属文章
				'guid' => $img_url,
				'post_mine_type' => $img_mime, // image/jpeg image/png image/gif
				'comment_status' => 'open', // 关闭 discussion
				'ping_status' => 'closed', // 关闭
				'post_author' => 1,
			];
			// print_r($attachment_insert);
			$attachment_id = wp_insert_post($attachment_insert);

			if ($attachment_id) {
				echo "The attachment record(" . $attachment_id . ") of post " . $post_id . " was created successfully" . PHP_EOL;
				// 缩略图和中等图判断
				$attachment_type = ($medium_bool) ? ('medium') : (($thumbnail_bool) ? ('thumbnail') : ('full'));
				// 宽高设置
				$attachment_width = ($medium_bool) ? ($medium[0]) : (($thumbnail_bool) ? ($thumbnail[0]) : ($img_info[0]));
				$attachment_height = ($medium_bool) ? ($medium[1]) : (($thumbnail_bool) ? ($thumbnail[1]) : ($img_info[1]));
				// 设置图片显示路径
				$show_img_url = ($medium_bool) ? ($host . '/wp-content/uploads/' . $year . "/" . $month . "/" . $post_name . "-" . $medium[0] . "x" . $medium[1] . $ext) : (($thumbnail_bool) ? ($host . '/wp-content/uploads/' . $year . "/" . $month . "/" . $post_name . "-" . $thumbnail[0] . "x" . $thumbnail[1] . $ext) : ($img_url));
				// 根据情况组织 sizes;
				// $sizes_keys = [];
				// $sizes_values = [];
				// if ($thumbnail_bool) {
				// 	array_push($sizes_keys, "thumbnail");
				// 	array_push($sizes_values, [
				// 		"file" => $year . "/" . $month . "/" . $post_name . "-" . $thumbnail[0] . "x" . $thumbnail[1] . $ext,
				// 		"width" => $thumbnail[0],
				// 		"height" => $thumbnail[1],
				// 		"mime-type" => $thumbnail['mime'],
				// 	]);
				// }

				// if ($medium_bool) {
				// 	array_push($sizes_keys, "medium");
				// 	array_push($sizes_values, [
				// 		"file" => $year . "/" . $month . "/" . $post_name . "-" . $medium[0] . "x" . $medium[1] . $ext,
				// 		"width" => $medium[0],
				// 		"height" => $medium[1],
				// 		"mime-type" => $medium['mime'],
				// 	]);
				// }
				// $sizes = array_combine($sizes_keys, $sizes_values);

				// $attachment_meta = [
				// 	"_wp_attached_file" => $year . '/' . $month . '/' . $post_name . $ext,
				// 	"_wp_attachment_metadata" => [
				// 		"width" => $img_info[0],
				// 		"height" => $img_info[1],
				// 		"file" => $year . "/" . $month . "/" . $file_name,
				// 		"sizes" => $sizes,
				// 		"image_meta" => [
				// 			"aperture" => 0,
				// 			"credit" => '',
				// 			"camera" => '',
				// 			"caption" => '',
				// 			"created_timestamp" => 0,
				// 			"copyright" => '',
				// 			"focal_length" => 0,
				// 			"iso" => 0,
				// 			"shutter_speed" => 0,
				// 			"title" => '',
				// 			"orientation" => 0,
				// 			"keywords" => [],
				// 		],
				// 	],
				// 	"_thumbnail_id" => $attachment_id,
				// ];

				// foreach ($attachment_meta as $meta_key => $meta_value) {
				// 	$meta_ids[$meta_key] = add_post_meta($attachment_id, $meta_key, $meta_value); // 判断 meta_id|false 是否成功
				// }
				/**
				 * alignnone 默认显示方式为无
				 * wp-image-{attachment_id}
				 * size-{%s}: 值为以下
				 * size-full : 原图大小
				 * size-large : 大图
				 * size-medium ： 裁剪后中型图
				 * size-thumbnail : 缩略图
				 * @var string
				 */
// 				$html_template = <<<EOF
				// <p>By:%s on %s</p>
				// <p><img src="%s" class="alignnone wp-image-%s size-%s" alt="" width="%s" height="%s" /></p>
				// <p>%s</p>
				// <p><a href="%s" target="blank">%s</a></p>
				// <p>Keywords: %s</p>
				// EOF;

				// $html = sprintf($html_template, $post->author, date("Y/m/d", strtotime($post->pub_date)), $show_img_url, $attachment_id, $attachment_type, $attachment_width, $attachment_height, $post->abstract, $post->links, $post->links, $post->keyword);
				$html_template_new = <<<EOF
<p>By:%s on %s</p>
<!-- wp:image {"id":%d} -->
<figure class="wp-block-image"><img src="%s" alt="" class="wp-image-%d"/></figure>
<!-- /wp:image -->
<p>%s</p>
<p><a href="%s" target="blank">%s</a></p>
<p>Keywords: %s</p>
EOF;
				$html = sprintf($html_template_new, $post->author, date("Y/m/d", strtotime($post->pub_date)), $attachment_id, $show_img_url, $attachment_id, $post->abstract, $post->links, $post->links, $post->keyword);

				$edit_post = [
					'ID' => $post_id,
					'post_content' => $html,
				];
				wp_update_post($edit_post);

			} else {
				echo "Attachment record creation for post " . $post_id . " A failed" . PHP_EOL;
				// 附件不成功，则只更新无图内容
				$html_template = <<<EOF
<p>By:%s on %s</p>
<p>%s</p>
<p><a href="%s" target="blank">%s</a></p>
<p>Keywords: %s</p>
EOF;

				$html = sprintf($html_template, $post->author, date("Y/m/d", strtotime($post->pub_date)), $post->abstract, $post->links, $post->links, $post->keyword);
				$edit_post = [
					'ID' => $post_id,
					'post_content' => $html,
				];
				wp_update_post($edit_post);
				if (file_exists($thumbnail_path)) {
					unlink($thumbnail_path);
					echo "The attachment record of post " . $post_id . " failed to be created, so the attachment picture(thumbnail) was deleted." . PHP_EOL;
				}
				if (file_exists($medium_path)) {
					unlink($medium_path);
					echo "The attachment record of post " . $post_id . " failed to be created, so the attachment picture(medium) was deleted." . PHP_EOL;
				}
			}
		} else {
			// 否则，删除插入的文章和 postmeta
			wp_delete_post($post_id);
			foreach ($seo_meta as $meta_key => $meta_value) {
				delete_post_meta($post_id, $meta_key);
			}
		}
	}
} else {
	echo "Sorry, failed to query the database..." . PHP_EOL;
}