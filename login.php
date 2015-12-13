
<?php 
$title='Вход';
include '/includes/headerout.php'; ?>

<div class='maincontent'>

    <div class="form">
        <h2>Вход</h2>
        <form action="/php/phplogin.php" method="POST">
            <table>
                <tr><td>Потребителско име:</td><td><input name="user_name" class="input" type="text"></td></tr>
                <tr><td>Парола:</td><td><input name="password" class="input" type="password"></td></tr>
                <tr><td><img id="secondb" class="infob" src="/img/info.png" alt="info" title="Информация"/></td><td><input name="login" class="button" type="submit" value="ВЛЕЗ"></td></tr>
                <tr><td colspan="2"><div class="infobox" id="second">Моля, въведете валидни входящи данни, ако искате да влезете в профила на съответния университет. 
                            Уведомете ни при възникнала грешка.<br><br>
                            Инструкции за ползване на сайта ще намерите <a href="/instruct.php" target="_blank" class="link">ТУК</a>. </div></td></tr>
                <tr><td colspan="2"><div class="smalltxt"><a href="/loginerror.php">Забравена парола или/и потребителско име?</a></div></td></tr>
            </table>
        </form>
    </div>
</div>
<?php include '/includes/footerout.php'; ?>
<!--Footer outside the account-->
