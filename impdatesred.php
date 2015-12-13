<?php
$title = 'Редактор - Важни дати';

include '/php/phplogin.php';
include '/includes/headerin.php';
if (!isset($_GET['name'])) {header("location: /inhome.php");}
$ddid=$_GET['name'];
redactimpd($con, $ddid);
strlenfunc('Описание', $sdd['date_descript'], 450);
strlenfunc('Име', $sdd['date_name'], 50);
?>

<div class='maincontent'>
    <div class="fffbackg">
        <div class="inheading">
            <h2><?php echo $title;?></h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo']; ?>" title="" alt=""/>
            <h1><?php echo $uni['uniname']; ?></h1>
        </div>
        <form method='POST' <?php echo 'action="/php/phplogin.php?name=' . $ddid . '"' ?>>
            <div class="menuonpage">
                <div class="datenote">
                    <a href="/imp_dates.php" ><img style='background:#ddd;' alt='ImpDates' title='Важни дати' src='/img/datesimp.png'/></a>
                <a href="/imp_notes.php"><img  alt='ImpNotes' title='Важни бележки' src='/img/notesimp.png'/></a>
                <a href="/inhome.php" ><img  alt='Home' title='Начало' src='/img/home.png'/></a>
                </div>
                <div><img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                    <ul class="menu">
                        <li><input name="impd_redact" class="opbutton" type="submit" value="ЗАПАЗИ"></li></ul><br></div>
                <div class="infobox" id="second">Редактирайте посоченото събитие. <br>Допустим брой знаци в полето 'Име': 50. Допустим брой знаци в полето 'Описание': 450<br><br>
                    При затруднения прегледайте краткия <a href="instructuni.php" target="_blank" class="link">наръчник</a>. </div>
            </div>


            <div class="tableborders">
                <table class="intable dates">
                    <thead>
                        <tr>
                            <th>Активирай</th>
                            <th>Дата</th>
                            <th>Име</th>
                            <th>Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $sddx; ?>
                    </tbody>
                </table>

            </div>

            <!--<div>
                <ul class="pages">
                    <li id="firstt">1</li>
                    <li id="moret"><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>-->
            <br><br>
        </form>
    </div>
</div>
<?php
include '/includes/footerin.php';
