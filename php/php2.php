<?php

//session_cache_expire();
//ob_start();
/* ESTABLISH YOUR CONNECTION */
$con = mysqli_connect('localhost', 'root', 'Godwithme21', 'abs1');
mysqli_query($con, 'SET NAMES utf8');
/* check connection */
date_default_timezone_set('Europe/Sofia');

if (mysqli_connect_errno()) {
    
    error($con);
     exit();
}

$admin['email']="abs@abstudent.com";
