<?php
$title = 'Университет';
include '/includes/headerout.php';

$id =$_GET['name'];
data_from_users($id, $con);

$stm = $con->prepare("SELECT date, date_name, date_descript FROM imp_dates WHERE user_id='" . $id . "' AND is_active=1 ORDER BY date ASC");
view_imp_dates($stm);

$stm = $con->prepare("SELECT note_txt FROM imp_notes WHERE user_id='" . $id . "' AND is_active=1");
view_imp_notes($stm);



$k = "";

if (!isset($_GET['sort'])) {
    $_GET['sort'] = 1;
}
$sort = sortit($_GET['sort']);

$page = data_for_userspec($id, $con, $sort);

if (isset($_GET['k'])) {
    $k = $_GET['k'];
    $query = "SELECT spec_id, spec_name, tax, durt, last_date FROM spec_list WHERE user_id=" . $id . " AND is_active=1 AND (";
    $searchcol = "spec_name";
    $page = search_spec_out($query, $searchcol, $con);
}

/* if (isset($_GET['name'])) {
  $page = data_from_name($con);
  } */
/* if (isset($_GET['k'])) {
  $id = ">0";
  $page = search_spec_in($con, $id, 'unipage.php');
  $val = $_GET['k'];
  } */
?>

<div class='maincontent'>

    <div class="fffbackg">
        <div class="pageinf">
            <h1><?php echo $uni_data['uniname']; ?></h1><img class="imglogo" src="/test/<?php echo $uni_data['pic_logo'] ?>" title="" alt=""/>
            <div style="background:url('../test/<?php echo $uni_data['pic_uni'] ?>') no-repeat; background-size: 600px 300px;" class="imguni" ><h3><?php echo $uni_data['moto'] ?></h3></div>

            <div class="pageinf0">
                <div>
                    <div class="pageinf1"><?php echo $uni_data['city']; ?></div>
                    <div class="pageinf2">Град</div>
                </div>
                <div>
                    <div class="pageinf1"><em><?php echo $uni_data['email']; ?></em></div>
                    <div class="pageinf2">За Контакт</div>
                </div>
                <div>
                    <div class="pageinf1"><?php echo $uni_data['website']; ?></div>
                </div>
                <div class="searchin">
                    <form method="GET" action="/unipage.php">
                        <input style="display:none;" type="text" name="name" value="<?php echo $id; ?>">
                        <input type="text" name="k" value="<?php echo $k; ?>"><input type="image" src="/img/whitesearchx.png" name="searchin" style="width:30px; margin: 25px 0 -12px 10px;" alt="Search">
                    </form>
                    <div class="smalltxt"><?php echo $i; ?> специалности</div>
                </div>
            </div>
        </div>

        <section>
            <section class="col span_4_of_5 ptext">
                <div class="box">
                    <h3 id="firstb">За университета</h3>
                    <div id="first"><?php echo $uni_data['about_uni']; ?></div>
                </div>
                <div class="box">
                    <h3 id="secondb">Научи повече</h3>
                    <div id="second"><?php echo $uni_data['learn_more']; ?></div>
                </div>

            </section>
            <section class="col span_1_of_5">
                <div class="aside">
                    <h3>Важни дати</h3>
                    <section>
                        <?php viewTable($dates_data, $z); ?>
                    </section>
                </div>
                <div class="aside">
                    <h3>Забележка</h3>
                    <section><?php viewTable($notes_data, $zz); ?>
                    </section>
                </div>
                <br><br><br>
            </section>
        </section>

        <div>


            <div class="tableborders">
                <table class="intable">
                    <thead >
                        <tr>
                            <th><a href="/unipage.php?name=<?php echo $_GET['name']; ?>&k=<?php echo $k ?>&sort=1">Специалност</a></th>

                            <th><a href="/unipage.php?name=<?php echo $_GET['name']; ?>&k=<?php echo $k ?>&sort=2">Такса</a></th>
                            <th><a href="/unipage.php?name=<?php echo $_GET['name']; ?>&k=<?php echo $k ?>&sort=3">Продължителност</a></th>
                            <th><a href="/unipage.php?name=<?php echo $_GET['name']; ?>&k=<?php echo $k ?>&sort=4">Срок</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        viewTable($specuni_data, $i);
                        ?>
                    </tbody>
                </table>
                <div><ul class="pages"><?php pages($page); ?></ul></div>
            </div>

            <!--<div>
                <ul class="pages">
                    <li id="firstt">1</li>
                    <li id="moret"><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>-->
            <br><br></div>
    </div>

</div>
<?php
include '/includes/footerout.php';
