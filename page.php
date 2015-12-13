<?php
$title = 'Специалност';
include '/includes/headerout.php';
$id=$_GET['name'];
data_for_spec($id, $con);

$stm = $con->prepare("SELECT date, date_name, date_descript FROM imp_dates LEFT JOIN spec_list ON imp_dates.user_id=spec_list.user_id WHERE spec_list.spec_id='" . $id . "' AND imp_dates.is_active=1");
view_imp_dates($stm);

$stm = $con->prepare("SELECT note_txt FROM imp_notes LEFT JOIN spec_list ON imp_notes.user_id=spec_list.user_id WHERE spec_list.spec_id='" . $id . "' AND imp_notes.is_active=1");
view_imp_notes($stm);
/* $unidesc = unidesc_red($con); */
?>

<div class='maincontent'>
    <div class="fffbackg">
        <div class="pageinf">
            <a href="/unipage.php?name=<?php echo $spec_data['user_id'];?>"><h1><?php echo $spec_data['uniname']; ?></h1><img class="imglogo" src="/test/<?php echo $spec_data['pic_logo'];?>" title="" alt=""/></a>
            <div style="background:url('../test/<?php echo $spec_data['pic_uni'];?>') no-repeat; background-size: 600px 300px;" class="imguni" ><h2><?php echo $spec_data['spec_name']; ?></h2></div>

            <div class="pageinf0">
                <div>
                    <div class="pageinf1"><?php echo $spec_data['last_date']; ?></div>
                    <div class="pageinf2">Краен срок</div>
                </div>
                <div>
                    <div class="pageinf1"><?php echo $spec_data['durt']; ?> Семестъра</div>
                    <div class="pageinf2">Продължителност на обучение</div>
                </div>
                <div>
                    <div class="pageinf1"><?php echo $spec_data['tax']; ?> лв</div>
                    <div class="pageinf2">Семестриална такса</div>
                </div>
                <div>
                    <div class="pageinf1"><em><?php echo $spec_data['email']; ?></em></div>
                    <div class="pageinf2">За Контакт</div>
                </div>
                <div>
                    <div class="pageinf1"><em><?php echo $spec_data['website']; ?></em></div>
                </div>
            </div>
        </div>
        <div class="pageinf10">
            <div class="pageinf11">Общи изисквания:</div>
            <div class="pageinf12"><?php echo $spec_data['ned_docs']; ?></div>
        </div>
        <section class="section group">
            <section class="col span_4_of_5 ptext">
                <div class="box">
                    <h3 id="firstb">Как да кандидатстваме?</h3>
                    <div id="first"><?php echo $spec_data['to_apply']; ?></div>
                </div>
                <div class="box">
                    <h3 id="secondb">Какво ни очаква?</h3>
                    <div id="second"><?php echo $spec_data['to_expect']; ?></div>
                </div>
                <div class="box">
                    <h3 id="thirdb">За университета</h3>
                    <div id="third"><?php echo $spec_data['about_uni']; ?></div>
                </div>
                <div class="box">
                    <h3 id="forthb">Научи повече</h3>
                    <div id="forth"><?php echo $spec_data['learn_more']; ?></div>
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
    </div>
</div>
<?php
include '/includes/footerout.php';
