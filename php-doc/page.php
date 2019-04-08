<?php

class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 11;// 分页栏每页显示的页数
    public $lastSuffix = true; // 最后一页是否显示总页数

    private $p       = 'p'; //分页参数名
    private $url     = ''; //当前链接URL
    private $nowPage = 1;

    // 分页显示定制
    private $config  = array(
        'header' => '<span class="rows btn btn-white">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );

    /**
     * 构造函数，初始化分页配置
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows=20, $parameter = array(),$firstUrl) {

        $this->p = 'pid';
        /* 基础设置 */
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        $this->parameter  = empty($parameter) ? $_GET : $parameter;
        $this->nowPage    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
        // $this->nowPage    = $this->nowPage>0 ? $this->nowPage : 1;
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
        $this->url        = $firstUrl;
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page){
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if(0 == $this->totalRows) return '';

        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
//        $this->url = //'list.php?pid='.urlencode('[PAGE]');//U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页临时变量 */
        $now_cool_page      = $this->rollPage/2;
        $now_cool_page_ceil = ceil($now_cool_page);
        $this->lastSuffix && $this->config['last']= $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<a class="prev btn btn-white" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;
        $down_page = ($down_row <= $this->totalPages) ? '<a class="next btn btn-white" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';

        //第一页
        $the_first = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
            $the_first = '<a class="first btn btn-white" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
        }

        //最后一页
        $the_end = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
            $the_end = '<a class="end btn btn-white" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
            if(($this->nowPage - $now_cool_page) <= 0 ){
                $page = $i;
            }elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
                $page = $this->totalPages - $this->rollPage + $i;
            }else{
                $page = $this->nowPage - $now_cool_page_ceil + $i;
            }
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<a class="num btn btn-white" href="' . $this->url($page) . '">' . $page . '</a>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<span class="current btn btn-white active">' . $page . '</span>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "<div class='btn-group'>{$page_str}</div>";
    }


    public function shows()
    {
        $pages = '';
        $adjacents=2;
        if(0 == $this->totalRows) return '';
        $p              =   $this->p;
        $this->totalPages = ceil($this->totalRows / $this->listRows);

        // 分析分页参数
        if($this->url){
            $url        =   $this->url;
        }else{
            if($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter,$parameter);
            }elseif(is_array($this->parameter)){
                $parameter      =   $this->parameter;
            }elseif(empty($this->parameter)){
                unset($_GET['pid']);
                $var =  !empty($_POST)?$_POST:$_GET;
                if(empty($var)) {
                    $parameter  =   array();
                }else{
                    $parameter  =   $var;
                }
            }
            $parameter[$p]  =   '__PAGE__';
            $url            =   $parameter;
        }

        //上下翻页字符串
        $upRow          =   $this->nowPage-1;
        $downRow        =   $this->nowPage+1;

        // 上一页
        if ($upRow>0){
            $pages.=   "<a class='btn btn-white prev' href='".str_replace('__PAGE__',$upRow,$url)."' >".$this->config['prev']."</a>";
        }else{
            $pages.=   "<a class='btn btn-white prev current' >".$this->config['prev']."</a>";
        }

        //第一页
        if($this->nowPage>($adjacents+1)) {
            $pages.= "<a class='btn btn-white' href='".str_replace('__PAGE__',1,$url)."'>1</a>";
        }

        // 添加省略号
        if($this->nowPage>($adjacents+2)) {
            $pages.= "<a class='btn btn-white'>...</a>";
        }

        // 12345
        $pmin = ($this->nowPage>$adjacents) ? ($this->nowPage-$adjacents) : 1;
        $pmax = ($this->nowPage<($this->totalPages-$adjacents)) ? ($this->nowPage+$adjacents) : $this->totalPages;
        for($i=$pmin; $i<=$pmax; $i++) {
            if($i==$this->nowPage) {
                $pages.= "<a class='btn btn-white current active'>".$i."</a>";
            }else{
                $pages.= "<a class='btn btn-white' href='".str_replace('__PAGE__',$i,$url)."'>".$i."</a>";
            }
        }

        // 添加省略号
        if($this->nowPage < ($this->totalPages-$adjacents-1)) {
            $pages.= "<a class='btn btn-white'>...</a>";
        }

        // 最后一页
        if($this->nowPage<($this->totalPages-$adjacents)) {

            $pages.= "<a class='btn btn-white' href='".str_replace('__PAGE__',$this->totalPages,$url)."'>".$this->totalPages."</a>";
        }

        // 下一页
        if ($downRow <= $this->totalPages){
            $pages.=   "<a class='btn btn-white' href='".str_replace('__PAGE__',$downRow,$url)."' class='next'>".$this->config['next']."</a>";
        }else{
            $pages.=   "<a  class='next current btn btn-white'>".$this->config['next']."</a>";
        }
        return '<div class="btn-group">'.$pages.'</div>';
    }
}