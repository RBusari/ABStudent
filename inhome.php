<?php
$title = 'Начало';

include '/php/phplogin.php';
include '/includes/headerin.php';

$page = spec_table($con);
$val = "";
if (!isset($_GET['sort'])) {
    $_GET['sort'] = 1;
}
if (isset($_GET['add'])) {
    add_spec($con);
}
if (isset($_GET['k'])) {
    $id= "=".$_SESSION['id'];
    $page = search_spec_in($con, $id, 'pageredact.php');
    $val = $_GET['k'];
}
?>
<!--
Header Outside the account.
-->

<div class='maincontent'>

    <div class="fffbackg">
        <div class="inheading">
            <h2>Добре Дошли</h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo'];?>" title="" alt=""/>
            <h1><?php echo $uni['uniname']; ?></h1>
        </div>
        <div class="searchin">
            <form method="GET" action="/inhome.php">
                <input type="text" name="k" value="<?php echo $val; ?>"><input type="image" src="/img/whitesearchx.png" name="searchin" style="width:30px; margin: 25px 0 -12px 10px;" alt="Search">
            </form>
            <div class="smalltxt"><?php echo $i; ?> специалности</div>
        </div>

        <div><form method='POST' action="/php/phplogin.php">
                <div class="menuonpage">


                    <div class="datenote">
                        <a href="/imp_dates.php" ><img  alt='ImpDates' title='Важни дати' src='/img/datesimp.png'/></a>
                        <a href="/imp_notes.php"><img  alt='ImpNotes' title='Важни бележки' src='/img/notesimp.png'/></a>
                        <a href="/inhome.php" ><img style='background:#ddd;' alt='Home' title='Начало' src='/img/home.png'/></a>
                    </div>
                    <div><img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                        <ul class="menu">
                            <li><input name="del" class="opbutton" type="submit" value="ИЗТРИЙ" onclick="return confirm('Сигурни ли сте, че искате да запазите проведените промени?');"></li>
                            <li><input type="image" src="img/active.png" name="sis_active" class="active" alt="is_active"><br><input type="image" src="img/activex.png" name="sisnt_active" class="active" alt="isnt_active"></li>
                            <li><a href='/inhome.php?add=1'><img src='/img/plusblue.png' alt='add' title='add' class="addbutton"></a></li>                    </ul></div>
                    <br>
                    <div class="infobox" id="second">Тук можете да посочите специалност, която да активирате, деактивирате или редактирате.
                        При затруднения прегледайте краткия <a href="instructuni.php" target="_blank" class="link">наръчник</a></div>
                </div>


                <div class="tableborders">
                    <table class="intable">
                        <thead>
                            <tr>
                                <th><input id="allchecked" name="allcheck" type="checkbox"></th>
                                <th><a href="/inhome.php?k=<?php echo $val ?>&sort=1">Специалност</a></th>

                                <th><a href="/inhome.php?k=<?php echo $val ?>&sort=2">Такса</a></th>
                                <th><a href="/inhome.php?k=<?php echo $val ?>&sort=3">Продължителност</a></th>
                                <th><a href="/inhome.php?k=<?php echo $val ?>&sort=4">Срок</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td colspan="4"><a href="unidescript.php">Собствено описание</a></td>
                            </tr>

                            <?php
                            viewTable($spec, $i);
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <ul class="pages">
                            <?php pages($page); ?>
                        </ul>

                    </div>
                </div>
                <br><br>
            </form></div>
    </div>

</div>
<?php
include '/includes/footerin.php';

