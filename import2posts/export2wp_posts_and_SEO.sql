SELECT
	title_trans AS post_title,
	CONCAT(
		"<p>By",
		author,
		" on ",
		pub_date,
		"</p><p><img class=\"alignnone size-full\" src=\"",
		CONCAT(
			"http://sgrna.igenebio.net/temp/",
			pmc_id,
			'-',
			img_file_name
		),
		"\" alt=\"",
		title_trans,
		"\" /></p><p>",
		abstract_trans,
		"</p><p><a href=\"",
		links,
		"\" target=\"_blank\">",
		links,
		"</a></p>",
		"<p>Keywords: ",
		keyword_trans,
		"</p>"
	) AS post_content,
	abstract_trans AS post_excerpt,
	'' AS post_date,
	title_trans AS post_name,
	'' AS post_category,
	'' AS post_tag,
	1 AS post_author,
	CONCAT(
		"http://sgrna.igenebio.net/temp/",
		pmc_id,
		'-',
		img_file_name
	) AS featured_image,
	'' AS post_slug,
	0 AS post_parent,
	'publish' AS post_status,
	keyword_trans AS Keywords,
	'closed' AS comment_status,
	keyword_trans AS seo_keywords,
	abstract_trans AS seo_description,
	title_trans AS seo_title
FROM
	pmc_crispr_v2