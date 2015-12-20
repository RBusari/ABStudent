<?php

$DBServer = '-'; 
$DBUser   = '-';
$DBPass   = '-';
$DBName   = '-';

$con = new mysqli($DBServer, $DBUser, $DBPass, $DBName); 
 mysqli_query($con, 'SET NAMES utf8');
// Check Connection
if ($con->connect_error) {
  trigger_error('Database connection failed: '  . $con->connect_error, E_USER_ERROR);
}

$admin['email']='alwaysbstudent@gmail.com';
