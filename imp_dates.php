<?php
$title = 'Важни дати';

include '/php/phplogin.php';
include '/includes/headerin.php';

imp_dates($con);
if(isset($_GET['add_date'])){
    add_date($con);    
}
?>
<div class='maincontent'>
    <form method='POST' action="/php/phplogin.php">
    <div class="fffbackg">
        <div class="inheading">
            <h2><?php echo $title;?></h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo']; ?>" title="" alt=""/>
            <h1><?php echo $uni['uniname']; ?></h1>
        </div>

        <div class="menuonpage">
            <div class="datenote">
                <a href="/imp_dates.php" ><img style='background:#ddd;' alt='ImpDates' title='Важни дати' src='/img/datesimp.png'/></a>
                <a href="/imp_notes.php"><img  alt='ImpNotes' title='Важни бележки' src='/img/notesimp.png'/></a>
                <a href="/inhome.php" ><img  alt='Home' title='Начало' src='/img/home.png'/></a>
            </div>
            <div><img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                <ul class="menu">
                    <li><input name="impd_del" class="opbutton" type="submit" value="ИЗТРИЙ" onclick="return confirm('Сигурни ли сте, че искате да запазите проведените промени?');"></li>
                    <li><input type="image" src="img/active.png" name="is_active" class="active" alt="is_active"><br><input type="image" src="img/activex.png" name="isnt_active" class="active" alt="isnt_active"></li>
                    <li><a href='/imp_dates.php?add_date=1'><img src='/img/plusblue.png' alt='add' title='add date' class="addbutton"></a></li></ul><br></div>
            <div class="infobox" id="second">Публикувайте важни дати. Активните дати (в синьо) биват виждани от всеки потребител, който посещава ваша страница.<br><br>
                При затруднения прегледайте краткия <a href="instructuni.php" target="_blank" class="link">наръчник</a>. </div>
        </div>


        <div class="tableborders">
            <table class="intable">
                <thead>
                    <tr>
                        <th><input id="allchecked" name="allcheck" type="checkbox"></th>
                        <th>Дата</th>
                        <th>Име</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    viewTable($imp_dates, $i);
                    ?>
                </tbody>
            </table>
        </div>
        <br><br>
    </div>
    </form>
</div>
<?php
include '/includes/footerin.php';
