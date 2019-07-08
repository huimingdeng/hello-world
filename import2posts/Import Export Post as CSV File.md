# Import Export Post as CSV File

Import Export Post as CSV File 插件使用指南。



## 导入 wp_posts 表必须字段

参考链接（国外，可能需要翻墙）： [https://drive.google.com/file/d/0Bx_szbefwadOR1RCTm43UVRkRnc/view](https://drive.google.com/file/d/0Bx_szbefwadOR1RCTm43UVRkRnc/view)

- [WPML Import CSV Sample](https://drive.google.com/open?id=0Bx_szbefwadOR1RCTm43UVRkRnc)
  
  - post_title    -- 文章标题 eg. `Hello World`
  - post_content    -- 文章正文
  - post_excerpt    -- 文章摘要
  - post_date    -- 文章发布时间，建议不填，WordPress 系统自动补充
  - post_category    -- 文章分类，可不填写，填写后将操作 `wp_terms`、`wp_termmeta`、`wp_term_taxonomy`、`wp_term_relationships` 四张表
  - post_tag    -- 文章标签，和上面类似
  - post_author    -- 作者，可不填，WordPress 系统默认为 `admin `用户（当然要有这个账号才行，即 `wp_users`表ID）
  - featured_image    -- WordPress 系统的特色图片设定，这里必须填写图片超链接，然后插件会获取图片，然后上传WordPress媒体库后给文章设定。涉及到的数据表是 `wp_postmeta`
  - post_slug    -- 文章别名 可以选择 post_title 一样，导入会自定修正格式 eg. `hello-world`
  - post_parent    -- 是否存在父级文章 是则需要填写父级的ID，否则 0
  - post_status    -- 文章状态 publish/draft
  - Keywords    -- 关键词，ALL-IN-ONE-SEO 插件中可以使用，不过需要在界面上面进行选择
  - actors    -- 该字段不用，付费版本使用
  - language_code -- 该字段可以不用，默认为 English (en)

- 建议增加的字段：
  
  - comment_status -- 评论是否开启，WordPress 一般默认开启 (open),关闭(closed)

- [使用 All-in-One-SEO-PACK 插件建议增加字段](https://drive.google.com/file/d/0Bx_szbefwadOWG5ZSG0xemYxZ28/view)
  
  - post_title    -- **如果和前面一起组成一份CSV文档，则不用重复填写文章标题**
  
  - seo_keywords    -- SEO 关键词
  
  - seo_description    -- SEO 描述
  
  - seo_title    -- SEO 标题
  
  - seo_noindex    -- 以下为插件设定，可以不使用在CSV文档中
  
  - seo_nofollow    
  
  - seo_disable    
  
  - seo_disable_analytics 

## 操作步骤：

### 第一步：数据导出成CSV文档

对要操作的数据表执行 select 查询，组合上述字段信息，eg. pmc_crispr_v2 表字段如下(*_trans: 表示经 Python深度学习优化后的字段，采用这些字段)

pmc_id    title    author    pub_date    keyword    img_dir    abstract    links    title_trans    keyword_trans    img_trans    abstract_trans    img_file_name

例如，使用 SQL 组合：(mysql的SQL语句)

```sql
-- 查询结果，然后使用 Navicat 导出成为 CSV 文档。
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
```

将上述查询的结果导出形成 CSV 文件。图片操作示意：

![Step One](https://i.loli.net/2019/07/08/5d22dd1e885c654501.png)

![Step Two](https://i.loli.net/2019/07/08/5d22dd54b740983618.png)

![Step Three](https://i.loli.net/2019/07/08/5d22dd723d9a867432.png)

![Step Four](https://i.loli.net/2019/07/08/5d22dd9724f9668682.png)

![Step Five](https://i.loli.net/2019/07/08/5d22ddba82a9222929.png)



### 第二步：获取图片信息并上传到网站临时目录

如CSV表中的字段 `featured_image` 是超链接，不是超链接，则插件无法上传特色图到WordPress的媒体库中。

执行SQL，查询组装服务器图片：

```sql
-- 查询然后将结果导出 CSV 文档 get_images.csv
SELECT CONCAT(img_dir,'/',img_file_name) AS path,pmc_id FROM pmc_crispr_v2`
```

导出 CSV 文档 `get_images.csv`

![图片信息](https://i.loli.net/2019/07/08/5d22de1dcad9599168.png)

编写脚本，把分散在各个目录的图片汇聚到一个目录里面（方便下载和上传到 WordPress 所在服务器）

```php
<?php 
$fn = file("get_images.csv"); // 读取前面导出的文档
foreach ($fn as $lines) {
    $arr = explode(',', $lines);
    $path = str_replace(["\r\n", "\n", "\r", "\""], '', $arr[0]);
    $pmc_id = str_replace(["\r\n", "\n", "\r", "\""], '', $arr[1]);
    if(file_exists($path)){
        $in = pathinfo($path);
        $save = dirname(__FILE__).'/'. $pmc_id. '-' .$in['basename']; // 使用 pmc_id 和图片名组合成唯一图片名。
        @copy($path, $save);
        if(!file_exists($save)){
            echo "复制失败 ". $path. PHP_EOL;
        }
    }else{
        $path = str_replace('pmc_crispr_v2','pmc_crispr_v2_black_and_white',$path);
        if(file_exists($path)){
            $in = pathinfo($path);
            $save = dirname(__FILE__).'/'. $pmc_id. '-' .$in['basename'];
            @copy($path, $save);
            if(!file_exists($save)){
                echo "复制失败 ". $path. PHP_EOL;
            }
        }else{
            echo "黑白图 ".$path." 不存在".PHP_EOL;
        }
    }
}
```

不在同一台服务器，则需要下载汇聚后的图片上传到指定服务器中（要创建一个临时目录 eg. `temp`）

### 第三步：使用插件导入 `wp_posts` 表

执行步骤如图：




