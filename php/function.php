<?php

/// FUNCTION SECOND, INCLUDE ONLY IN AND FOR HTML;

function error($con) {
    echo mysqli_error($con);
//header('location: C:/xampp/htdocs/abstudent1/php/error.php');
}

function checksess() {
    if (empty($_SESSION)) {
//echo 'go back';
        header('location: login.php');
    }
}

function dnttouch() {
    echo 'You wish :p.';
}

function stillLogged($con, $id) {
    $sqli = 'SELECT user_id FROM users WHERE user_id=' . $id . '';
    $qu = mysqli_query($con, $sqli);
    if (isset($id) && $qu) {
        header('location: inhome.php');
    }
}

/* INHOME FUNCTIONS */

function uniname($con) {
    $stm = $con->prepare('SELECT uniname, email, website, pic_logo, pic_uni, about_uni, learn_more, city, moto FROM users WHERE user_id=' . $_SESSION['id']);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {
            header("location: /index.php");
            return;
        }
        global $uni;
        $uni = $res->fetch_assoc();
        if (isset($_SESSION['last_savedu']) && !empty($_SESSION['last_savedu'])) {
            $uni['about_uni'] = $_SESSION['last_savedu']['about_uni'];
            $uni['learn_more'] = $_SESSION['last_savedu']['learn_more'];
            $_SESSION['last_savedu'] = [];
        }
        if (isset($_SESSION['last_savedus']) && !empty($_SESSION['last_savedus'])) {
            $uni['uniname'] = $_SESSION['last_savedus']['uniname'];
            $uni['city'] = $_SESSION['last_savedus']['city'];
            $uni['moto'] = $_SESSION['last_savedus']['moto'];
            $uni['email'] = $_SESSION['last_savedus']['email'];
            $uni['website'] = $_SESSION['last_savedus']['website'];
            $_SESSION['last_savedus'] = [];
        }
    } else {
        error($con);
    }
}

function spec_table($con) {
    $sql = 'SELECT spec_id, spec_name, tax, durt, last_date, is_active FROM spec_list WHERE user_id=' . $_SESSION["id"] . ' ORDER BY spec_list.is_active DESC, spec_list.spec_name ASC';
    $q = mysqli_query($con, $sql);
    global $i, $spec;
    if ($q) {
        $i = 0;
        while ($row = $q->fetch_assoc()) {
            $sd = $row['spec_id'];     //$sd=2*$sd.'abs'.$sd*9;
            $spec_name = $row['spec_name'];
            $tax = $row['tax'];
            $durt = $row['durt'];
            $last_date = $row['last_date'];
            $is_active = $row['is_active'];
            $p = (int) (($i / 20) + 1);
            if ($is_active == 1) {
                $x = 'style="background:#dee;"';
            } else {
                $x = '';
            }
            $spec[$i] = '<tr class="c a' . $p . '"><td ' . $x . '><input type="checkbox" name="date' . $sd . '"></td><td ' . $x . '><a href="pageredact.php?name=' . $sd . '">' . $spec_name . '</a></td><td>' . $tax . '</td><td>' . $durt . ' Семестъра</td><td>' . $last_date . '</td></tr>';
            $i++;
        }
        if ($i > 0) {
            $p = $p + 1;
            return $p;
        }
    } else {
        error($con);
    }
}

function imp_dates($con) {
    $stm = $con->prepare('SELECT is_active, dates_id, date, date_name, date_descript FROM imp_dates WHERE user_id=' . $_SESSION["id"] . ' ORDER BY imp_dates.is_active DESC');
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        global $imp_dates, $i;
        $i = 0;
        if ($numrows < 1) {
            $imp_dates[$i] = '<tr><td colspan="4">Нямате добавени дати.</td></tr>';
            return;
        }
        while ($sdd = $res->fetch_assoc()) {
            $i++;
            if ($sdd['is_active'] == 1) {
                $x = 'style="background:#dee;"';
            } else {
                $x = '';
            }
            $imp_dates[$i] = '<tr><td ' . $x . '><input type="checkbox" name="date' . $sdd["dates_id"] . '"></td><td ' . $x . '><a href="impdatesred.php?name=' . $sdd["dates_id"] . '">' . $sdd["date"] . '</a></td><td>' . $sdd["date_name"] . '</td><td>' . $sdd["date_descript"] . '</td></tr>';
        }
    } else {
        error($con);
    }
}

function imp_notes($con) {
    $stm = $con->prepare('SELECT is_active, note_id, note_txt FROM imp_notes WHERE user_id=' . $_SESSION["id"] . ' ORDER BY is_active DESC');
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        global $imp_notes, $i;
        $i = 0;
        if ($numrows < 1) {
            $imp_notes[$i] = '<tr><td colspan="2">Нямате добавени забележки.</td></tr>';
            return;
        }
        while ($sdd = $res->fetch_assoc()) {
            $i++;
            if ($sdd['is_active'] == 1) {
                $x = 'style="background:#dee;"';
            } else {
                $x = '';
            }
            $imp_notes[$i] = '<t><td ' . $x . '><input type="checkbox" name="date' . $sdd["note_id"] . '"></td><td><a href="imp_notesred.php?name=' . $sdd["note_id"] . '">' . $sdd["note_txt"] . '</a></td></tr>';
        }
    } else {
        error($con);
    }
}

function pages($page) {
    if ($page > 2) {
        for ($p = 1; $p < $page; $p++) {
            echo '<li class="cd" id="b' . $p . '">' . $p . '</li>';
        }
    }
}

function viewTable($spec, $i) {
    for ($j = 0; $j < $i + 1; $j++) {
        if (isset($spec[$j])) {
            echo $spec[$j];
        }
    }
}

//Settings

/* function settings($con) {
  $sql = 'SELECT email, pic_logo, pic_uni FROM users WHERE user_id=' . $_SESSION['id'];
  $q = mysqli_query($con, $sql);
  global $s;
  if ($q) {
  $row = $q->fetch_assoc();
  $s['email'] = $row['email'];
  $s['pic_logo'] = $row['pic_logo'];
  $s['pic_uni'] = $row['pic_uni'];
  }
  } */

function redactsd($con, $sd) {
    $stm = $con->prepare('SELECT spec_name, is_active, last_update, last_date, durt, tax, ned_docs, to_apply, to_expect  FROM spec_list WHERE spec_id=' . $sd . ' AND user_id=' . $_SESSION["id"]);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {header("location: /inhome.php");return;}
        global $sdd;
        $sdd = $res->fetch_assoc();
        if (isset($_SESSION['last_saveds']) && !empty($_SESSION['last_saveds'])) {
            $sdd['spec_name'] = $_SESSION['last_saveds']['spec_name'];
            $sdd['ned_docs'] = $_SESSION['last_saveds']['ned_docs'];
            $sdd['to_apply'] = $_SESSION['last_saveds']['to_apply'];
            $sdd['to_expect'] = $_SESSION['last_saveds']['to_expect'];
            $_SESSION['last_saveds'] = [];
        }
        if ($sdd['is_active'] == 1) {$sdd['is_activex'] = 'checked="checked"';} else {$sdd['is_activex'] = '';}
    } else {
        error($con);
    }
}

function redactimpd($con, $id) {
    $stm = $con->prepare('SELECT is_active, date, date_name, date_descript FROM imp_dates WHERE dates_id=' . $id . ' AND user_id=' . $_SESSION["id"]);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {
            header("location: /inhome.php");
            return;
        }
        global $sddx, $sdd;
        $sdd = $res->fetch_assoc();
        if ($sdd['is_active'] == 1) {
            $sdd['is_activex'] = 'checked="checked"';
        } else {
            $sdd['is_activex'] = '';
        }
        if (isset($_SESSION['last_savedd']) && !empty($_SESSION['last_savedd'])) {
            $sdd['date_descript'] = $_SESSION['last_savedd']['descr'];
            $sdd['date_name'] = $_SESSION['last_savedd']['name'];
            $_SESSION['last_savedd'] = [];
        }
        $sddx = '<tr><td><input type="checkbox" name="is_active" ' . $sdd["is_activex"] . '></td><td><input type="text" name="ddate" value="' . $sdd['date'] . '"></td><td><input type="text" name="ddate_name" value="' . $sdd['date_name'] . '"></td><td><textarea name="ddate_descript">' . $sdd['date_descript'] . '</textarea></td></tr>';
    } else {
        error($con);
    }
}

function redactimpn($con, $id) {
    $stm = $con->prepare('SELECT is_active, note_txt FROM imp_notes WHERE note_id=' . $id . ' AND user_id=' . $_SESSION["id"]);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {
            header("location: /inhome.php");
            return;
        }
        global $sddx, $sdd;
        $sdd = $res->fetch_assoc();
        if ($sdd['is_active'] == 1) {
            $sdd['is_activex'] = 'checked="checked"';
        } else {
            $sdd['is_activex'] = '';
        }
        if (isset($_SESSION['last_savedn']) && $_SESSION['last_savedn'] !== '') {
            $sdd['note_txt'] = $_SESSION['last_savedn'];
            $_SESSION['last_savedn'] = '';
        }
        $sddx = '<tr><td><input type="checkbox" name="is_active" ' . $sdd["is_activex"] . '></td><td><textarea name="note_txt">' . $sdd['note_txt'] . '</textarea></td></tr>';
    } else {
        error($con);
    }
}

/* function unidesc_red($con) {
  $stm = $con->prepare("SELECT about_uni, learn_more FROM users where user_id=" . $_SESSION["id"]);
  $stm->execute();
  $res = $stm->get_result();
  $row = $res->fetch_assoc();
  return $row;
  } */

//SHOW IMAGE

function showimg($img) {
    echo '<img src="/test/' . $img . '" title="PicUni" alt="PicUUni"/>';
}

function add_date($con) {
    $stm = $con->prepare("SELECT COUNT(*) FROM imp_dates where user_id=" . $_SESSION["id"]);
    $stm->execute();
    $res = $stm->get_result();
    $row = $res->fetch_assoc();
    if ($row["COUNT(*)"] < 10) {
        $sql = 'INSERT INTO imp_dates (user_id, date, date_name, date_descript) VALUES (' . $_SESSION["id"] . ', "' . date("Y-m-d", time()) . '", "Добави име", "Описание на събитието...")';
        if (mysqli_query($con, $sql)) {
            header('location:/imp_dates.php');
        } else {
            echo errorphp($con);
        }
    } else {
        echo '<div style="color:#fff;">Достигнахте позволения максимум за дати. Изтрийте стара дата, за да добавите нова.</div>';
    }
}

function add_spec($con) {
    $stm = $con->prepare("select COUNT(*) FROM imp_dates where user_id=" . $_SESSION["id"]);
    $stm->execute();
    $res = $stm->get_result();
    $row = $res->fetch_assoc();
    if ($row["COUNT(*)"] < 250) {
        $sql = 'INSERT INTO spec_list (user_id, last_date, spec_name, to_apply, to_expect) VALUES (' . $_SESSION["id"] . ', "' . date("Y-m-d", time()) . '", "Добави име", "<b>удебелен текст</b>, нормален текст,<br> нов ред, <em>наклонен текст</em>", "<b>удебелен текст</b>, нормален текст,<br> нов ред, <em>наклонен текст</em>")';
        if (mysqli_query($con, $sql)) {
            header('location:/inhome.php');
        } else {
            echo errorphp($con);
        }
    } else {
        echo '<div style="color:#fff;">Достигнахте позволения максимум за специалности. Изтрийте стара специалност, за да добавите нова.</div>';
    }
}

function add_note($con) {
    $stm = $con->prepare("select COUNT(*) FROM imp_notes where user_id=" . $_SESSION["id"]);
    $stm->execute();
    $res = $stm->get_result();
    $row = $res->fetch_assoc();
    if ($row["COUNT(*)"] < 10) {
        $sql = 'INSERT INTO imp_notes (user_id, note_txt) VALUES (' . $_SESSION["id"] . ', "Добави описание на бележката")';
        if (mysqli_query($con, $sql)) {
            header('location:/imp_notes.php');
        } else {
            echo errorphp($con);
        }
    } else {
        echo '<div style="color:#fff;">Достигнахте позволения максимум за бележки. Изтрийте стара бележка, за да добавите нова.</div>';
    }
}

/* function data_from_name($con) {
  $stm = $con->prepare("SELECT uniname, email, about_uni, learn_more, pic_uni, pic_logo, website, spec_name, spec_id, last_date, durt, tax FROM users LEFT JOIN spec_list ON users.user_id=spec_list.user_id WHERE user_id='" . $_GET['name'] . "' AND spec_list.is_active=1");
  if ($stm) {
  $stm->execute();
  $res = $stm->get_result();

  global $i, $data;

  $i = 0;
  while ($data = $res->fetch_assoc()) {
  $p = (int) (($i / 20) + 1);
  $data[$i] = '<tr class="c a' . $p . '"><td><a href="specpage?name=' . $row["spec_id"] . '">' . $row["spec_name"] . '</a></td><td>' . $row["tax"] . '</td><td>' . $row["durt"] . ' Семестъра</td><td>' . $row["last_date"] . '</td></tr>';
  $i++;
  }
  return $p++;
  }
  } */

function data_from_users($id, $con) {
    $stm = $con->prepare("SELECT uniname, email, about_uni, learn_more, pic_uni, pic_logo, website, city, moto  FROM users WHERE user_id='" . $id . "' ");

    global $uni_data;
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows !== 1) {
            header("location: /index.php");
            echo "no data from users";
        }
        $uni_data = $res->fetch_assoc();
    }
}

function data_for_userspec($id, $con, $sort) {
    $stm = $con->prepare("SELECT spec_list.spec_id, spec_name, tax, durt, last_date  FROM spec_list LEFT JOIN users ON spec_list.user_id=users.user_id WHERE (users.user_id=" . $id . " AND spec_list.is_active=1 AND users.is_active=1 " . $sort);

    global $specuni_data, $i;
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {
            header("location: /index.php");
            echo "no data for userspec";
            error($con);
        }

        $i = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $p = (int) (($i / 20) + 1);
            $specuni_data[$i] = '<tr class="c a' . $p . '"><td><a href=/page.php?name=' . $row["spec_id"] . ' target="_blank">' . $row["spec_name"] . '</a></td><td>' . $row["tax"] . '</td><td>' . $row["durt"] . ' Семестъра</td><td>' . $row["last_date"] . '</td></tr>';
            $i++;
        }
        $p++;
        return $p;
    }
}

//Function Checked and used 2x
//FOR ALL

function strlenfunc($namecol, $string, $max) {
    $strlen = mb_strlen($string);
    if ($strlen > $max) {
        echo '<div style="color:#fff;">Намалете размера на текста (' . $namecol . '). <br>Допустим брой знаци: <b>' . $max . '</b>. Размер на Вашия текст:' . $strlen . ' </div>';
    }
}

function search_spec_in($con, $id, $topage) {
    $k = $_GET['k'];
    $terms = explode(" ", $k);
//var_dump($k);
    if (!empty($_SESSION)) {
        $query = "SELECT spec_id, spec_name, tax, durt, last_date, is_active FROM spec_list WHERE user_id=" . $id . " AND (";
    } else {
        $query = "SELECT spec_list.user_id, spec_id, spec_name, tax, durt, last_date, uniname FROM spec_list "
                . "LEFT JOIN users ON spec_list.user_id=users.user_id WHERE spec_list.is_active=1 AND users.is_active=1 AND (";
    }
    foreach ($terms as $each) {
        $j = 0;
        $j++;
        if ($j == 1) {
            $query.="spec_name LIKE '%$each%' ";
        } else {
            $query.="OR spec_name LIKE'%$each%' ";
        }
    }

    if (isset($_GET['sort'])) {
        $query.=sortit($_GET["sort"]);
    } else {
        $query.=")ORDER BY spec_list.is_active DESC, spec_list.spec_name ASC";
    }

    $query = mysqli_query($con, $query);
    if (!$query) {
        echo error($con);
    }
    $numrows = mysqli_num_rows($query);
    global $i, $spec;
    $i = 0;
    if ($numrows > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            $p = (int) (($i / 20) + 1);
            if (!empty($_SESSION)) {
                $uniname = '';
                if ($row['is_active'] == 1) {
                    $x = 'style="background:#dee;"';
                } else {
                    $x = '';
                }
                $checkbox = '<td ' . $x . '><input type="checkbox" name="date' . $row["spec_id"] . '"></td>';
            } else {
                $x = '';
                $checkbox = '';
                $uniname = '<td><a href="/unipage.php?name=' . $row["user_id"] . '" target="_blank">' . $row["uniname"] . '</td>';
            }
            $spec[$i] = '<tr class="c a' . $p . '">' . $checkbox . '<td ' . $x . '><a href="' . $topage . '?name=' . $row["spec_id"] . '" target="_blank">' . $row["spec_name"] . '</a></td><td>' . $row["tax"] . '</td><td>' . $row["durt"] . ' Семестъра</td><td>' . $row["last_date"] . '</td>' . $uniname . '</tr>';
            $i++;
        }

        $p++;
    } else {
        $spec[$i] = '<tr><td colspan="5"><em>Няма намерени резултати.</em></td></tr>';
        $p = 0;
    }
    return $p;
}

function search_spec_out($query, $searchcol, $con) {
    $k = $_GET['k'];
    $terms = explode(" ", $k);
    foreach ($terms as $each) {
        $j = 0;
        $j++;
        if ($j == 1) {
            $query.=$searchcol . " LIKE '%$each%' ";
        } else {
            $query.="OR " . $searchcol . " LIKE '%$each%' ";
        }
    }
    $query.=sortit($_GET["sort"]);

    $stm = $con->prepare($query);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        global $specuni_data, $i;
        $i = 0;

        if ($numrows < 1) {
            error($con);
            $specuni_data[$i] = "<tr><td colspan='4'>Няма намерени резултати.</td></tr>";
            $p = 0;
            return $p;
        }


        while ($row = $res->fetch_assoc()) {
            $p = (int) (($i / 20) + 1);
            $specuni_data[$i] = '<tr class="c a' . $p . '"><td><a href="/page.php?name=' . $row["spec_id"] . '" target="_blank">' . $row["spec_name"] . '</a></td><td>' . $row["tax"] . '</td><td>' . $row["durt"] . ' Семестъра</td><td>' . $row["last_date"] . '</td></tr>';
            $i++;
        }
        $p++;
        return $p;
    } else {
        error($con);
    }
}

function sortit($sort) {
    global $order1;
    if ($sort == 2) {
        $order1 = ") ORDER BY spec_list.tax ASC";
        return $order1;
    }
    if ($sort == 3) {
        $order1 = ") ORDER BY spec_list.durt ASC";
        return $order1;
    }
    if ($sort == 4) {
        $order1 = ") ORDER BY spec_list.last_date ASC";
        return $order1;
    }
    if ($sort == 5) {
        $order1 = ") ORDER BY users.uniname ASC";
        return $order1;
    }
    if ($sort == 1 OR 1 === 1) {
        $order1 = ") ORDER BY spec_list.spec_name ASC";
        return $order1;
    }
}

/* FOR SPEC */

function data_for_spec($id, $con) {
    $query = "SELECT uniname, email, about_uni, learn_more, pic_uni, pic_logo, website, spec_name, last_date, durt, tax, ned_docs, to_apply, to_expect FROM spec_list LEFT JOIN users ON users.user_id=spec_list.user_id WHERE spec_list.spec_id=" . $id. " ";
    if (empty($_SESSION)) {
        $query.="AND spec_list.is_active=1 AND users.is_active=1";
    }
    $stm = $con->prepare($query);
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
        $numrows = mysqli_num_rows($res);
        if ($numrows < 1) {
            header("location: /index.php");
            echo "no data for spec";
        }
        global $spec_data;
        $spec_data = $res->fetch_assoc();
    } else {
        error($con);
    }
}

/* FOR DATES */

function view_imp_dates($stm) {

    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
    } else {
        echo 'no';
    }

    global $dates_data, $z;
    $z = 0;
    $numrows = mysqli_num_rows($res);
    if ($numrows < 1) {
        $dates_data[$z] = "<div><p>Няма отбелязани дати.</p></div>";
        return;
    }

    while ($row = $res->fetch_assoc()) {
        $butt = $z + 1;
        $dates_data[$z] = "<div><p class='ccd' id='bb" . $butt . "'><b>" . $row['date'] . "</b> - " . $row['date_name'] . "</p><p class='cc aa" . $butt . "'><td>" . $row['date_descript'] . "</p></div>";
        $z++;
    }
}

/* FOR NOTES */

function view_imp_notes($stm) {
    if ($stm) {
        $stm->execute();
        $res = $stm->get_result();
    } else {
        echo 'no';
    }
    global $notes_data, $zz;
    $zz = 0;

    $numrows = mysqli_num_rows($res);
    if ($numrows < 1) {
        $notes_data[$zz] = "<div><p>Няма добавени забележки.</p></div>";
        return;
    }


    while ($row = $res->fetch_assoc()) {
        $notes_data[$zz] = "<div><p>" . $row['note_txt'] . "</p></div>";
        $zz++;
    }
}
