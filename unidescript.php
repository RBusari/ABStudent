<?php
$title = 'Описание';

include '/php/phplogin.php';
include '/includes/headerin.php';

strlenfunc('За университета', $uni['about_uni'], 2500);
strlenfunc('Научи повече', $uni['learn_more'], 2500);

/* $unidesc = unidesc_red($con); */
?>
<div class='maincontent'>
    <form method='POST' action="/php/phplogin.php">
        <div class="fffbackg">
            <div class="inheading">
                <h2>За университета</h2>
                <h1><?php echo $uni['uniname']; ?></h1>
            </div>

            <div class="menuonpage">
                <div class="datenote">
                    <a href="/imp_dates.php" ><img  alt='ImpDates' title='Важни дати' src='/img/datesimp.png'/></a>
                    <a href="/imp_notes.php"><img  alt='ImpNotes' title='Важни бележки' src='/img/notesimp.png'/></a>
                    <a href="/inhome.php" ><img style='background:#ddd;' alt='Home' title='Начало' src='/img/home.png'/></a>
                </div>
                <div><img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                    <ul class="menu">

                        <li><input name="unidesc_red" class="opbutton" type="submit" value="ЗАПАЗИ"> <a class="clbutt" href="/unipage.php?name=<?php echo $_SESSION['id'];?>&preview=1" target="_blank">Изглед</a></li></ul></div><br>
                <div class="infobox" id="second">Добавете информация за университета. За форматиране на текста използвайте познатите тагове <em>(br - нов ред, em - наклонен шрифт, b - удебелен шрифт)</em>, както е посочено в началния текст. <br>
                    Допустим брой знаци за полетата (За университета, Научи повече): 2500. 
                    <br><br>За повече информация прочетете <a href="instructuni.php" target="_blank" class="link">наръчника</a>. </div><br>
            </div>

            <section class="section group unidered">
                <section class="col span_3_of_6">
                    <div>
                        <h3>За университета:</h3>
                        <textarea name="about_uni"><?php echo $uni['about_uni']; ?></textarea>
                    </div></section>
                <section class="col span_3_of_6">
                    <div>
                        <h3>Научи повече:</h3>
                        <textarea name="learn_more"><?php echo $uni['learn_more']; ?></textarea>
                    </div>

                </section>
            </section>

            <br><br>
        </div>
    </form>
</div>
<?php
include '/includes/footerin.php';
