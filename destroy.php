<?php

include '/php/function.php';
include '/php/phplogin.php';
$last_logout = date('Y.m.d H:m:s', time());
$sql = "UPDATE logins SET last_logout = '" . $last_logout . "' WHERE user_id=" . $_SESSION['id'] . " AND last_login = '" . $_SESSION['lastlogin'] . "'";

if (mysqli_query($con, $sql)) {
    $_SESSION = [];
    session_destroy();
    checksess();
} else {
    error($con);
    header('location: /php/error.php');
}


/*for($i=100; $i<=122; $i++){
        $sql='INSERT INTO spec_list (user_id, spec_name) VALUES ('.$_SESSION['id'].', "specialnost'.$i.'")';
        if(mysqli_query($con, $sql)){
            echo $i.'<br>';
        }
        else{
            echo mysqli_error($con);
            exit;
        }
        
    }*/
