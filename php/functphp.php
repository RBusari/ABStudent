<?php

/// FUNCTION FIRST, INCLUDE ONLY IN PHP; 
function errorphp($con) {
    echo mysqli_error($con);
    //header('location: C:/xampp/htdocs/abstudent1/php/error.php');
}

function deleted($con, $table, $id, $link) {
    $stm = $con->prepare("SELECT MAX(" . $id . ") FROM $table WHERE user_id=" . $_SESSION["id"]);
    $stm->execute();
    $res = $stm->get_result();
    $row = $res->fetch_assoc();

    for ($i = 0; $i < $row["MAX($id)"]+1; $i++) {
        if (isset($_POST["date$i"])) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $id . '=' . $i.' AND user_id='.$_SESSION["id"];
            
            if (mysqli_query($con, $sql)) {
                header('location: /'.$link);
                //echo 'deleted';
                
            }else{errorphp($con);}
        }
        if ($i > 250) {
            echo "stopp";
            exit;
        }
       
    }
    //
}

function set_active($con, $table, $bool, $id, $idd) {
    $sql = 'UPDATE ' . $table . ' SET is_active=' . $bool . ' WHERE ' . $id . '=' . $idd;
    if (!mysqli_query($con, $sql)) {
        echo errorphp($con);
    }
    mysqli_query($con, $sql);
}

function active($con, $table, $col, $b) {
    

    for ($i = 0; $i < 220; $i++) {
        if (isset($_POST["date$i"])) {
            set_active($con, $table, $b, $col, $i);
            echo $i . '<br>';
        }
    }
}

/*PASSWORD CRYPTING*/
function pass_crypt($salt, $pass) {
    $string = sha1(md5($salt) . $pass);
    $sub_char=mb_substr($string, 4, 1);
    $explode = explode($sub_char, $string);
    $string1 = '';
    for ($i = count($explode) - 1; $i >= 0; $i = $i - 1) {
        $string1.=$sub_char . $explode[$i];
    }
    $string1 = mb_substr($string1, 1, 41);
    return $string1;
}
