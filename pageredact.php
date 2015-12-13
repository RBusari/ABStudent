<?php
$title = 'Редактор - Специалност';
include '/php/phplogin.php';
include '/includes/headerin.php';
if (!isset($_GET['name'])) {header("location: /inhome.php");}
redactsd($con, $_GET['name']);
strlenfunc('Име', $sdd['spec_name'], 50);
strlenfunc('Изисквания', $sdd['ned_docs'], 450);
strlenfunc('Как да кандидатстваме?', $sdd['to_expect'], 2500);
strlenfunc('Какво ни очаква?', $sdd['to_apply'], 2500);
?>
<div class='maincontent'>
    <div class="fffbackg">
        <form method="POST" <?php echo 'action="/php/phplogin.php?name=' . $_GET['name'] . '"' ?>>
            <div class="inheading">
                <h2><?php echo $title;?></h2><img class="imglogoin" src="/test/<?php echo $uni['pic_logo']; ?>" title="" alt=""/>
                <h1><?php echo $uni['uniname']; ?></h1>
            </div>
            <div style='min-height: 400px; margin:20px 0; background:#eee;'>
                <div class="phead">
                    <table style=' background:#eee;'>
                        <tr><td><b>Специалност</b></td><td><input style="width:250px;" type="text" name="spec_name" value=" <?php echo $sdd['spec_name']; ?> "></td></tr>
                        <tr><td>Краен срок</td><td><b><input type="text" name="last_date" value=" <?php echo $sdd['last_date']; ?> "></b></td></tr>
                        <tr><td>Продължителност (Семестри)</td><td><input type="number" min='0' name="durt" value=<?php echo $sdd['durt']; ?> ></td></tr>
                        <tr><td>Такса (лв)</td><td><input type="number" min='0'  name="tax" value=<?php echo $sdd['tax']; ?> ></td></tr>
                        <tr><td>Изисквания</td><td><textarea name="ned_docs"><?php echo $sdd['ned_docs']; ?></textarea></td></tr>
                        <tr><td>Активна</td><td><input type="checkbox" name="is_active" <?php echo $sdd['is_activex']; ?>></td></tr>
                    </table>
                </div>
                <div>
                    <div class="redactinstr">Моля попълнете посочените полета с валидна информация на <b>кирилица</b>. 
                        Можете да използвате следните тагове в посочените скоби < >< />:<br>
                        <ul>
                            <li>em - <em>наклонен шрифт</em></li>
                            <li>b - <b>удебелен шрифт</b></li>
                            <li>br - нов ред</li>
                        </ul>
                        Допустим брой знаци в полета <em>'Име' - 50, 'Изисквания' - 450, 'Как да кандидатстваме?' и 'Какво ни очаква?' - 2500.</em><br><br>
                        Изглед на готовата странца можете да видите <a href="/page.php?name=<?php echo $_GET['name']?>&preview=1" target="_blank" class="link">тук</a>.
                        </div>
                    <input name="pageredact" class="button" type="submit" value="ЗАПАЗИ">
                </div>
            </div><br>
            <div style="margin: 0 20px 0 15px;">
            </div>
            <section class="section group unidered">
                <section class="col span_3_of_6">
                    <div>
                        <h3>Как да кандидатстваме?</h3>
                        <textarea name="to_apply"><?php echo $sdd['to_apply']; ?></textarea>
                    </div></section>
                <section class="col span_3_of_6">
                    <div>
                        <h3>Какво ни очаква?</h3>
                        <textarea name="to_expect"><?php echo $sdd['to_expect']; ?></textarea>
                    </div>

                </section>
            </section>

        </form>
    </div>
</div>
<?php
include '/includes/footerin.php';
