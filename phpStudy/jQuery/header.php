<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/public.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>
    <div class="container w980">
        <header>
            <?php include_once("navbar.php"); navbar($filename);?>
        </header>

<?php $author='<a href="https://github.com/huimingdeng/" target="_blank" title="author:DHM">DHM(huimingdeng)</a>'; ?>