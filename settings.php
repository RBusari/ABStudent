<?php
$title = 'Настройки';
include '/php/phplogin.php';
include '/includes/headerin.php';

strlenfunc('Име', $uni['uniname'], 100);
strlenfunc('Град', $uni['city'], 100);
strlenfunc('Мото', $uni['moto'], 100);
strlenfunc('Ел. поща', $uni['email'], 100);
strlenfunc('Website', $uni['website'], 100);

if (isset($_GET['passnc'])) {
    echo '<div style="color:#fff;">Паролата не беше променена!<br>'
    . 'Допустима дължина на паролата: <b>от 5 до 50</b> символа.<br>'
    . 'За да увеличите сигурността на Вашата парола Ви препоръчваме да използвате числа <b>(0-9)</b> и латински букви <b>(a-z)</b>, както и някои специални символи <b>(_-/@)</b>.</div>';
}
if (isset($_GET['passc'])) {
    echo '<div style="color:#fff;">Паролата беше променена успешно!<br></div>';
   }
?>

<div class='maincontent'>
    <div class="fffbackg" style='width: 500px;'>
        <div class="inheading">
            <h2><?php echo $title; ?></h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo']; ?>" title="" alt=""/>
            <h1><?php echo $uni['uniname']; ?></h1>
        </div>
        <div class="settings">
            <section>
                <form action="php/phplogin.php" method="POST" enctype="multipart/form-data">
                    <img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
                    <div class="infobox" id="second">Моля попълнете посочените полета коректно. Снимка може да бъде запазена само във формат <b>"jpg"</b> и при размер по-малък от <b>485 KB</b>. <br><br>
                        При затруднения прочетете <a href="instructuni.php" target="_blank" class="link">наръчника</a>. </div><br>
                    <table>
                        <tr><td>Име:</td><td><input type="text" name="uniname" value=" <?php echo $uni['uniname']; ?> "></td>
                        <tr><td>Град:</td><td><input type="text" name="city" value=" <?php echo $uni['city']; ?> "></td>
                        <tr><td>Мото:</td><td><input type="text" name="moto" value=" <?php echo $uni['moto']; ?> "></td>
                        <tr><td>E-mail:</td><td><input type="email" name="email" value=" <?php echo $uni['email']; ?> "></td></tr>
                        <tr><td>Website:</td><td><input type="text" name="website" value=" <?php echo $uni['website']; ?> "></td></tr>
                        <tr><td>Лого:</td><td><input type="file" name="pic_logo"></td></tr>
                        <tr><td>Снимка:</td><td><input type="file" name="pic_uni"></td></tr>
                        <tr><td colspan="2"><input class="settbutt" type="submit" name="settings" value="ЗАПАЗИ" onclick="return confirm('Сигурни ли сте, че искате да запазите проведените промени?');"></td></tr>
                    </table>
                </form>
                <form action="php/phplogin.php" method="POST">
                    <table>
                        <tr><td>Нова парола:</td><td><input type="password" name="password1"></td></tr>
                        <tr><td>Повтори:</td><td><input type="password" name="password2"></td></tr>
                        <tr><td>Стара парола:</td><td><input type="password" name="password0"></td></tr>
                        <tr><td colspan="2"><input class="settbutt" type="submit" name="change_pass" value="ПРОМЕНИ" onclick="return confirm('Сигурни ли сте, че искате да запазите проведените промени?');"/></td></tr>
                    </table>
                </form></section>
        </div>
    </div>
</div>
<?php
include '/includes/footerin.php';

