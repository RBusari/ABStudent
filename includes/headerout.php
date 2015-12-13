<!DOCTYPE html>
<?php
include '/php/phplogin.php';
include '/php/function.php';
if (!empty($_SESSION) & !isset($_GET['preview'])) {
    stillLogged($con, $_SESSION['id']);
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/outstyle.css" />
        <link rel="stylesheet" type="text/css" href="css/incss.css" />
        <link rel="stylesheet" type="text/css" href="css/grid.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/ajs.js"></script>
        <script type="text/javascript" src="js/injs.js"></script>
    </head>
    <body class="acontent">
        <div class="wrapper">
            <header><div class="alogo"><a href="/index.php"><img src="img/logoABS.png" alt="LogoABStudent" title="ABStudent"/></a></div></header>
