SELECT
	title_trans AS post_title,
	CONCAT(
		"<p>By",
		author,
		" on ",
		pub_date,
		"</p><p>",
		title_trans,
		"</p><p><a href=\"",
		links,
		"\" target=\"_blank\">",
		links,
		"</a></p>",
		"<p>Keywords: ",
		keyword_trans,
		"</p>"
	) AS post_content,
	'post' AS post_type,
	'publish' AS post_status,
	'closed' AS comment_status,
	0 AS menu_order
FROM
	pmc_crispr_v2
