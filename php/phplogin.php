<?php

session_set_cookie_params(3 * 3600, '/', '', false, true);
session_start();
include('php2.php');
include('functphp.php');

if (isset($_POST['login']) && empty($_SESSION)) {
    if ($stmt = $con->prepare("SELECT user_id FROM users WHERE user_name = ? AND pass_word = ?")) { /* CHECK IF THE PREPARED STATEMENT IS TRUE */
        $stmt->bind_param("ss", $_POST["user_name"], sha1(md5($_POST["user_name"]) . $_POST["password"])); /* BIND THESE VARIABLES TO THE QUERY; s STANDS FOR SRINGS */
        $stmt->execute(); /* EXECUTE THE QUERY */
        $stmt->store_result();
        $check = $stmt->num_rows; /* GET THE NUMBER OF ROWS */
        if ($check == 1) {
            $stmt->bind_result($id); /* BIND THE RESULT TO THESE VARIABLES */
            $stmt->fetch(); /* FETCH THE RESULT */
            $_SESSION["id"] = $id; /* STORE THE USERID TO THESE SESSION VARIABLE */
            $_SESSION["isLogged"] = true;
            $_SESSION["lastlogin"] = date('Y-m-d H:m:s', time());
            $sql = 'INSERT INTO logins(user_id, last_login, last_logout) VALUES (' . $id . ', "' . $_SESSION["lastlogin"] . '", "' . date('Y-m-d H:m:s', time() + 3 * 3600) . '")';
            if (mysqli_query($con, $sql)) {
                $sql = 'UPDATE users SET last_login="' . $_SESSION["lastlogin"] . '" WHERE user_id=' . $_SESSION["id"];
                mysqli_query($con, $sql);
                header("location: /inhome.php");
            } else {
                errorphp($con);
            }
        } /* IF SUCCESSFUL */ else {
            $_SESSION = [];
            header('location: /loginerror.php');
        }

        $stmt->close(); /* CLOSE THE PREPARED STATEMENT */
    } /* END OF CHECKING THE PREPARED STATEMENT */
}

/* else if (!empty($_GET['logout']) AND $_GET['logout'] == '1' AND ! empty($_SESSION['user'])) {
  unset($_SESSION['user']); /* UNSET THE USER IN SESSION VARIABLE IF LOGGED-OUT */
/* } else if (!empty($_SESSION['user'])) {
  header("location: users.php"); /* IF THERE IS A LOGGED IN USER, REDIRECT HIM/HER TO users.php */
/* }
  include ('php1.php'); */


if (isset($_POST['settings'])) {
    $id = $_SESSION['id'];

    $uniname = trim($_POST['uniname']);
    $uniname = mysqli_real_escape_string($con, $uniname);
    if ($uniname == '') {
        $uniname = "Добави име";
    }

    $city = trim($_POST['city']);
    $city = mysqli_real_escape_string($con, $city);
    if ($city == '') {
        $city = "Добави град";
    }

    $moto = trim($_POST['moto']);
    $moto = mysqli_real_escape_string($con, $moto);
    if ($moto == '') {
        $moto = "Добави мото";
    }

    $email = trim($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    if ($email == '') {
        $email = "Добваи електронна поща";
    }

    $website = trim($_POST['website']);
    $website = mysqli_real_escape_string($con, $website);
    

    if (mb_strlen($uniname) > 100 or mb_strlen($city) > 100 or mb_strlen($moto) > 100 or mb_strlen($email) > 100 or mb_strlen($website) > 100) {
        $_SESSION['last_savedus']['uniname'] = $uniname;
        $_SESSION['last_savedus']['city'] = $city;
        $_SESSION['last_savedus']['moto'] = $moto;
        $_SESSION['last_savedus']['email'] = $email;
        $_SESSION['last_savedus']['website'] = $website;
        header('location: /settings.php');
        return;
    } else {
        $sql = 'UPDATE users SET uniname="' . $uniname . '", city="' . $city . '", moto="' . $moto . '", email="' . $email . '", website="' . $website . '" WHERE user_id=' . $id;
        if (mysqli_query($con, $sql)) {
            $allowed = array('jpg');
            $filename1 = $_FILES['pic_logo']['name'];
            $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);
            $filename2 = $_FILES['pic_uni']['name'];
            $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);
            if ($_FILES['pic_logo']['error'] == 0 & in_array($ext1, $allowed) & $_FILES['pic_logo']['size'] < 500000) {
                $_FILES['pic_logo']['name'] = 'pic_logo' . $id . '.jpg';
                $pic_logo = $_FILES['pic_logo']['name'];
                $sql = 'UPDATE users SET pic_logo="' . $pic_logo . '" WHERE user_id=' . $id;
                if (mysqli_query($con, $sql)) {
                    move_uploaded_file($_FILES['pic_logo']['tmp_name'], '../test' . DIRECTORY_SEPARATOR . $pic_logo);
                    //echo '<img src="../test/' . $pic_logo . '" alt="LogoABStudent" title="ABStudent" /><br>';
                }
            } else {
                $_FILES['pic_logo'] = [];
            }
            if ($_FILES['pic_uni']['error'] == 0 & in_array($ext2, $allowed) & $_FILES['pic_uni']['size'] < 500000) {
                $_FILES['pic_uni']['name'] = 'pic_uni' . $id . '.jpg';
                $pic_uni = $_FILES['pic_uni']['name'];
                $sql = 'UPDATE users SET pic_uni="' . $pic_uni . '" WHERE user_id=' . $id;
                if (mysqli_query($con, $sql)) {
                    move_uploaded_file($_FILES['pic_uni']['tmp_name'], '../test' . DIRECTORY_SEPARATOR . $pic_uni);
                    //echo '<img src="../test/' . $pic_uni . '" alt="LogoABStudent" title="ABStudent" /><br>';
                }
            } else {
                $_FILES['pic_uni'] = [];
            }

            /* if (isset($_SESSION['last_saveduspics'])) {
              var_dump($_SESSION['last_saveduspics']);
              //header('location: /settings.php');
              exit();
              } */
            /* var_dump($_FILES);
              $file = '../test/pic_logo1.jpg';
              echo "<br>".  filesize($file); */
            header('location: /inhome.php');
        } else {
            errorphp($con);
        }
    }
}

if (isset($_POST['change_pass'])) {
    $id = $_SESSION['id'];

    $password0 = trim($_POST['password0']);
    $password0 = mysqli_real_escape_string($con, $password0);

    $password1 = trim($_POST['password1']);
    $password1 = mysqli_real_escape_string($con, $password1);

    $password2 = trim($_POST['password2']);
    $password2 = mysqli_real_escape_string($con, $password2);
    if (mb_strlen($password0) < 5 or mb_strlen($password1) < 5 or mb_strlen($password2) < 5 or mb_strlen($password0) > 50 or mb_strlen($password0) > 50 or mb_strlen($password0) > 50) {
        header('location: /settings.php?passnc');
    } else {
        $sql = 'SELECT pass_word, user_name FROM users WHERE user_id=' . $id . '';
        $q = mysqli_query($con, $sql);
        if (!$q) {
            header('location: error.php');
            exit;
        } else {
            $row = $q->fetch_assoc();
            $pass_word = $row['pass_word'];
            $password0 = sha1(md5($row["user_name"]) . $password0);
            if ($pass_word == $password0 and $password1 == $password2) {
                $sql = 'UPDATE users SET pass_word="' . sha1(md5($row["user_name"]) . $password1) . '" WHERE user_id=' . $id . '';
                $q = mysqli_query($con, $sql);
                if (!$q) {
                    header('location: error.php');
                    exit;
                } else {
                    header('location: /settings.php?passc');
                }
            } else {
                header('location: /settings.php?passnc');
            }
        }
    }
}

if (isset($_POST['pageredact'])) {
    $sid = $_GET['name'];
    $spec_name = trim($_POST['spec_name']);
    $spec_name = mysqli_real_escape_string($con, $spec_name);
    if ($spec_name == '') {
        $spec_name = 'Добави име';
    }
    $last_date = trim($_POST['last_date']);
    $last_date = mysqli_real_escape_string($con, $last_date);

    $durt = trim($_POST['durt']);
    $durt = mysqli_real_escape_string($con, $durt);

    $tax = trim($_POST['tax']);
    $tax = mysqli_real_escape_string($con, $tax);

    $ned_docs = trim($_POST['ned_docs']);
    $ned_docs = mysqli_real_escape_string($con, $ned_docs);
    if ($ned_docs == '') {
        $ned_docs = 'Добави описание';
    }

    if (isset($_POST['is_active']) AND $spec_name !== 'Добави име') {
        $is_active = 1;
    } else {
        $is_active = 0;
    }

    $to_apply = trim($_POST['to_apply']);
    $to_apply = mysqli_real_escape_string($con, $to_apply);
    if ($to_apply == '') {
        $to_apply = 'Добави описание';
    }
    $to_expect = trim($_POST['to_expect']);
    $to_expect = mysqli_real_escape_string($con, $to_expect);
    if ($to_expect == '') {
        $to_expect = 'Добави описание';
    }

    if (mb_strlen($spec_name) > 50 or mb_strlen($ned_docs) > 450 or mb_strlen($to_apply) > 2500 or mb_strlen($to_expect) > 2500) {
        $_SESSION['last_saveds']['spec_name'] = $spec_name;
        $_SESSION['last_saveds']['ned_docs'] = $ned_docs;
        $_SESSION['last_saveds']['to_apply'] = $to_apply;
        $_SESSION['last_saveds']['to_expect'] = $to_expect;
        header('location: /pageredact.php?name=' . $sid);
        exit();
    } else {
        $sql = 'UPDATE spec_list SET spec_name="' . $spec_name . '", last_date="' . $last_date . '", durt="' . $durt . '", tax="' . $tax . '", ned_docs="' . $ned_docs . '", is_active=' . $is_active . ', '
                . 'to_apply="' . $to_apply . '", to_expect="' . $to_expect . '" WHERE spec_id=' . $sid . ' AND user_id=' . $_SESSION["id"];
        if (mysqli_query($con, $sql)) {
            header('location: /inhome.php');
        } else {
            echo errorphp($con);
        }
    }
}

if (isset($_POST['impd_redact'])) {
    $id = $_GET['name'];
    $ddate = trim($_POST['ddate']);
    $ddate = mysqli_real_escape_string($con, $ddate);

    $ddate_name = trim($_POST['ddate_name']);
    $ddate_name = mysqli_real_escape_string($con, $ddate_name);
    if ($ddate_name == '') {
        $ddate_name = 'Добави име';
    }
    $ddate_descript = trim($_POST['ddate_descript']);
    $ddate_descript = mysqli_real_escape_string($con, $ddate_descript);
    if ($ddate_descript == '') {
        $ddate_descript = 'Добави описание';
    }

    if (isset($_POST["is_active"])) {
        $is_active = 1;
    } else {
        $is_active = 0;
    }
    if (mb_strlen($ddate_descript) > 450 or mb_strlen($ddate_name) > 50) {
        $_SESSION['last_savedd']['descr'] = $ddate_descript;
        $_SESSION['last_savedd']['name'] = $ddate_name;
        header('location: /impdatesred.php?name=' . $id);
        exit();
    } else {
        $sql = 'UPDATE imp_dates SET is_active=' . $is_active . ', date="' . $ddate . '", date_name="' . $ddate_name . '", date_descript="' . $ddate_descript . '" WHERE dates_id=' . $id . ' AND user_id=' . $_SESSION["id"];
        if (mysqli_query($con, $sql)) {
            header('location: /imp_dates.php');
        } else {
            echo errorphp($con);
        }
    }
}

if (isset($_POST['impn_redact'])) {
    $id = $_GET['name'];
    $note_txt = trim($_POST['note_txt']);
    $note_txt = mysqli_real_escape_string($con, $note_txt);
    if ($note_txt == '') {
        $note_txt = 'Добави описание';
    }
    if (isset($_POST["is_active"]) and $note_txt !== 'Добави описание') {
        $is_active = 1;
    } else {
        $is_active = 0;
    }

    if (mb_strlen($note_txt) > 450) {
        $_SESSION['last_savedn'] = $note_txt;
        header('location: /imp_notesred.php?name=' . $id);
        exit();
    } else {
        $sql = 'UPDATE imp_notes SET is_active=' . $is_active . ', note_txt="' . $note_txt . '" WHERE note_id=' . $id . ' AND user_id=' . $_SESSION["id"];
        if (mysqli_query($con, $sql)) {
            header('location: /imp_notes.php');
        } else {
            echo errorphp($con);
        }
    }
}


if (isset($_POST['unidesc_red'])) {
    $about_uni = trim($_POST['about_uni']);
    $about_uni = mysqli_real_escape_string($con, $about_uni);
    if ($about_uni == '') {
        $about_uni = 'Няма добавено описание.';
    }
    $learn_more = trim($_POST['learn_more']);
    $learn_more = mysqli_real_escape_string($con, $learn_more);
    if ($learn_more == '') {
        $learn_more = 'Няма добавено описание.';
    }

    if (mb_strlen($about_uni) > 2500 or mb_strlen($learn_more) > 2500) {
        $_SESSION['last_savedu']['about_uni'] = $about_uni;
        $_SESSION['last_savedu']['learn_more'] = $learn_more;
        header('location: /unidescript.php');
        return;
    } else {
        $sql = 'UPDATE users SET about_uni="' . $about_uni . '", learn_more="' . $learn_more . '" WHERE user_id=' . $_SESSION["id"];
        if (mysqli_query($con, $sql)) {
            header('location: /inhome.php');
        } else {
            echo errorphp($con);
        }
    }
}


/* DELETES */

if (isset($_POST['impd_del'])) {
    deleted($con, 'imp_dates', 'dates_id', 'imp_dates.php');
}
if (isset($_POST['impn_del'])) {
    deleted($con, 'imp_notes', 'note_id', 'imp_notes.php');
}
if (isset($_POST['del'])) {
    deleted($con, 'spec_list', 'spec_id', 'inhome.php');
}

/* * ******************************GETS* */
/* if(isset($_POST['is_active_x'])){
  for ($i = 0;
  $i < 100;
  $i++) {
  if (isset($_POST["date$i"])) {
  set_active($con, 'imp_dates', 1, 'dates_id', $i);
  }}
  header('location: /imp_dates.php');
  }
  if(isset($_POST['isnt_active_x'])){
  for ($i = 0;
  $i < 100;
  $i++) {
  if (isset($_POST["date$i"])) {
  set_active($con, 'imp_dates', 0, 'dates_id', $i);
  }
  header('location: /imp_dates.php');
  }
  } */
// SET ACTIVE SPEC, IMP_DATES, IMP_NOTES
if (isset($_POST['is_active_x'])) {
    active($con, 'imp_dates', 'dates_id', 1);
    header("location:/imp_dates.php");
}

if (isset($_POST['sis_active_x'])) {
    active($con, 'spec_list', 'spec_id', 1);
    header("location:/inhome.php");
}

if (isset($_POST['nis_active_x'])) {
    active($con, 'imp_notes', 'note_id', 1);
    header("location:/imp_notes.php");
}



if (isset($_POST['isnt_active_x'])) {
    active($con, 'imp_dates', 'dates_id', 0);
    header("location:/imp_dates.php");
}

if (isset($_POST['sisnt_active_x'])) {
    active($con, 'spec_list', 'spec_id', 0);
    header("location:/inhome.php");
}

if (isset($_POST['nisnt_active_x'])) {
    active($con, 'imp_notes', 'note_id', 0);
    header("location:/imp_notes.php");
}


/*Search Engine

$k=$_GET['k'];
$terms=  explode(" ", $k);
$query = "SELECT * FROM search WHERE";
foreach ($terms as $each){
    $i++;
    if($i==1){
        $query.="keywords LIKE '%$each%' ";
    }
    else{
        $query.="OR keywords LIKE'%$each%' ";
    }
    
}

mysqli_connect($host, $user, $password, $database, $port, $socket);
mysqli_select_db($link, $query);

$query = mysqli_query($con, $query);
$numrows = mysqli_num_rows($query);
if($numrows>0){
    while ($row = mysqli_fetch_assoc($query)) {
        $id=$row['id'];
        $title=$row['title'];
        
        echo "";
    }
}
mysqli_close();*/
