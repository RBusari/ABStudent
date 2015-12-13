
<!--
Header Outside the account.
-->
<?php
$title = 'Бъди Студент';
include 'includes/headerout.php';
?>

<div class='maincontent'>
    <section class='section group'>
        <form method="GET" action="/results.php">
            <section class='col span_2_of_3 '>
                <input type="text" class="search" name="k"/>
            </section>
            <section class='col span_1_of_3'>
                <div>
                    <input type="image" class="searchimg" src="/img/whitesearchxx.png" alt='Search'/>
                </div>
            </section>
        </form>
        </section>
    <div class="noback">
        <h3>Здравейте!</h3>
        <p>Кой университет или коя специалност? Как да кандидатствам?...</p>
        <p><b>Потърете и ще намерите</b> отговорите, които търсите!</p><br>
        <p>Екипът на "Бъди Студент" ви желае успех... независимо къде или какво следвате! И нека този успех промени Вас и света за по-добро.</p>
        <img id="secondb" class="infob" src="img/info.png" alt="info" title="Информация"/>
        <div id="second" class="infobox">Ако се затруднявате при ползването на сайта, прочете <a href="/instruct.php" target="_blank" class="link">инструкциите</a> или ни пишете на <em><a href="mailto: <?php echo $admin['email'];?>"><?php echo $admin['email'];?></a></em>. Ще се радваме на Вашите въпроси, идеии и критики!</div>
    </div>
</div>
<?php
include '/includes/footerout.php';
