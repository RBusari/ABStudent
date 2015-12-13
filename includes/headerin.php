<!DOCTYPE html>
<?php
include '/php/function.php';
checksess();
$id = $_SESSION['id'];
uniname($con);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title?></title>
        <link rel="stylesheet" type="text/css" href="css/outstyle.css" />
        <link rel="stylesheet" type="text/css" href="css/incss.css" />
        <link rel="stylesheet" type="text/css" href="css/grid.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/ajs.js"></script>
        
        <script type="text/javascript" src="js/injs.js"></script>
    </head>
    <body class="acontent">
        <div class="wrapper">
            <header><div class="inlogo"><img src="img/logoABS.png" alt="LogoABStudent" title="ABStudent"/></div>
                    <div class="opthead">
                        <ul>
                            <li><a href="/destroy.php">Изход</a></li>
                            <li><a href="/settings.php">Настройки</a></li>
                            <li><a href="/inhome.php">Начало</a></li>
                        </ul>
                    </div></header>
