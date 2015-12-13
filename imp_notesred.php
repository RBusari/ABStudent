<?php
$title = 'Редактор - Важни Бележки';

include '/php/phplogin.php';
include '/includes/headerin.php';
if (!isset($_GET['name'])) {header("location: /inhome.php");}
redactimpn($con, $_GET['name']);
strlenfunc('Бележка', $sdd['note_txt'], 450);
?>
<!--<script>alert('<?php //echo $sdd['note_txt']; ?>'.length);</script>-->

<div class='maincontent'>
    <div class="fffbackg">
        <div class="inheading">
            <h2><?php echo $title;?></h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo']; ?>" title="" alt=""/>
            <h1><?php echo $uni['uniname']; ?></h1>
        </div>
        <form method='POST' <?php echo 'action="/php/phplogin.php?name=' . $_GET['name'] . '"' ?>>
            <div class="menuonpage">
                <div class="datenote">
                    <a href="/imp_dates.php" ><img  alt='ImpDates' title='Важни дати' src='/img/datesimp.png'/></a>
                    <a href="/imp_notes.php"><img style='background:#ddd;' alt='ImpNotes' title='Важни бележки' src='/img/notesimp.png'/></a>
                    <a href="/inhome.php" ><img  alt='Home' title='Начало' src='/img/home.png'/></a>
                </div>
                <div><img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                    <ul class="menu"><li><input name="impn_redact" class="opbutton" type="submit" value="ЗАПАЗИ"></li></ul></div><br>
                <div class="infobox" id="second">Редактирайте посочената бележка. <br>Допустим брой знаци в полето 'Бележка': 450<br><br>
                    При затруднения прегледайте краткия <a href="instructuni.php" target="_blank" class="link">наръчник</a>. </div>
            </div>


            <div class="tableborders">
                <table class="intable notes">
                    <thead>
                        <tr>
                            <th style="min-width: 100px;">Активирай</th>
                            <th style="width: 400px;">Бележка</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $sddx; ?>
                    </tbody>
                </table>

            </div>
            <br><br>
        </form>
    </div>
</div>
<?php
include '/includes/footerin.php';
