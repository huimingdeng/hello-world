# wpdb 函数

wpdb 操作函数

## 查询类

wpdb 查询类型的函数

### `query()` 查询

成功，返回的是受影响条数；失败返回 `FALSE`





### WordPress数据表关系

wp_posts 表，存储 post/page/attachment ，post/page 和 attachment 的关系如图：

![数据表关系](https://i.loli.net/2019/07/05/5d1ebe7e6e57b57052.png)

wp_posts 主要字段功能：

- ID: post/page/attachment 主键自增，唯一标识

- post_content: 存储post/page的内容，attachment 的描述。

- post_title: post/page/attachment 的名称

- post_name: post/page/attachment 在 `WordPress `生成 `/category/slug/ `形式 URL中的 `slug`

- post_status: 状态，draft/publish 等

- post_parent: 父级ID的值，自动草稿、附件(attachment)使用，记录所属那一篇 post/page .

- guid : 链接,包含网站域名;如果是 attachment 则类型为 https://xxx.com/wp-content/{yyyy}/{mm}/{post_name}

- post_type 存储类型，post/page/attachement 

如图为 post 和所属 attachment 的数据举例：

![5d1ec4a96055494663](https://i.loli.net/2019/07/05/5d1ec4a96055494663.png)



wp_postmeta 主要字段功能: eg. `all-in-one-seo-pack` 插件实现存储SEO三元素 如图

- meta_id: 自增值，唯一标识

- post_id: 关联 wp_posts 表的 ID 值，外键。
  
  - eg. 存储 SEO 元素所属的 post/page 的 ID 值。

- meta_key: 存储自定义键 
  
  - eg. 自定义键为 `_aioseop_description`
  
  - eg. 自定义键为 `_aioseop_title`
  
  - eg. 自定义键为 `_aioseop_keywords`

- meta_value: 存储自定义的键的值
  
  - eg. 自定义键为 `_aioseop_description `的值，也就是 SEO 中的描述(`description`)
  
  - eg. 自定义键 `_aioseop_title` 的值，SEO 的标题
  
  - eg. 自定义键为 `_aioseop_keywords` 的值，SEO的关键词

![wp_postmeta](https://i.loli.net/2019/07/05/5d1ec1ffaad9d20485.png)


