<?php
/**
 * Created user
 * User: DHM
 * Date: 2017/9/6
 * Time: 10:42
 */
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>添加用户</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form class="form-control" action="add_user.php">
        <div class="form-group">
            <lable>email：</lable>
            <input type="text" name="user" class="input-sm">
        </div>
        <div class="form-group">
            <label>密码:</label>
            <input type="password" name="pass" class="input-sm">
        </div>
        <input type="button" class="btn btn-default" value="提交"/>
    </form>
    <
</body>
</html>