# SEO 小知識

該文檔記錄一些日常的SEO小知識，備忘錄。因忘記導致網站權重分流等問題。參考：[https://html.spec.whatwg.org/multipage/links.html](https://html.spec.whatwg.org/multipage/links.html)

## a 標籤部分

記錄 a 標籤鏈接小知識。

### 搜索引擎

為 a 標籤添加 `rel` 屬性，告訴搜索引擎對當前鏈接採取何種處理 -- `external nofollow noopener noreferrer`。

- `rel='nofollow'` 告訴搜索引擎，不要將當前鏈接計入權重。

- `rel='external'` 告訴搜索引擎，當前鏈接不是本站的鏈接，相當於`target='_blank'` 
  
  - 为什么要这样写呢？因为有些网站因为是采用严格的DOCTYPE声名的，如果你在网页源码中的第一行看到：在这种情况下target=”_blank”会失效，因此采用rel=’external’这个参数来替代。

- `rel='noopener'` 針對釣魚安全漏洞，增加該屬性值。
  
  - `window.opener` 將被設置為 `null`

- `rel='noreferrer'`  針對舊版本瀏覽器，以及 FireFox 瀏覽器，大意和 `noopener` 差不多
  
  -  (P.S. 針對 Firefox 最好是兩者一起添加 `rel='noopener noreferrer'`)

- `rel='nofollow noopener noreferrer'` 針對 a 標籤中存在`target='_blank'`屬性，從而告訴搜索引擎，對當前鏈接不要計算權重，堵住安全漏洞。

- P.S. 針對 `noopener` 和 `noreferrer` 可以使用 javascript 解決。
  
  ```javascript
  var otherWindow = window.open();
  otherWindow.opener = null;
  otherWindow.location = url;
  ```
