<?php
/**
 * Created by PhpStorm.
 * User: DHM
 * Date: 2017/9/6
 * Time: 10:57
 */

class ajax {
    public function get_user_info(){
        $user = $_GET['user'];
        $pass = md5(trim($_GET['pass']));
    }
}