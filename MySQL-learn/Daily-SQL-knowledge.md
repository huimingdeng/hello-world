# 日常SQL知识汇总

目前SQL知识仅针对MySQL数据库，迁移使用需要根据需求变更。



### having 使用：

查询 ORF 克隆长度在某范围内的信息。

例如：查询 1000 到 1200 bp 长度的克隆的 基因编号(gene_id)、产品编号(prod_id)、长度(计算)、价格(priceUSA)

```sql
SELECT
	*
FROM
	(
		SELECT
			gene_id,
			prod_id,
			(cds_stop - cds_start) + 1 AS orflen,
			priceUSA as price
		FROM
			gene
		HAVING
			orflen > 1000
		AND orflen < 1200
		UNION
			SELECT
				gene_id,
				prod_id,
				(cds_stop - cds_start) + 1 AS orflen,
				price1 as price
			FROM
				_glz_Mus_gene
			HAVING
				orflen > 1000
			AND orflen < 1200
	) AS tmp
GROUP BY
	orflen
ORDER BY
	gene_id ASC,orflen DESC
LIMIT 30
```

### TIMESTAMPDIFF 函数使用

TIMESTAMPDIFF(interval, datetime_expr1, datetime_expr2) 函数: 返回日期或日期时间表达式datetime_expr1 和datetime_expr2the 之间的整数差。

例如：购物车只显示产品在添加日期起3个月的时间内的信息。

```sql
SELECT
	id,
	product_class,
	customer_id,
	cat_no,
	prod_id,
	`desc`,
	unit_size,
	qty,
	price,
	dis_price,
	cloned,
	seq_length,
	url,
	TIMESTAMPDIFF(DAY, `date`, NOW()) AS expiration -- NOW() 要用 PHP date()作为变量

FROM
	`_cs_gc_web_shop`
WHERE
	stat IS NULL
AND customer_id = 65125 -- 变量: 客户 ID
HAVING
	expiration <= 90 -- 90 天
ORDER BY
	product_class,
	dis_price,
	cat_no,
	`date`
```




