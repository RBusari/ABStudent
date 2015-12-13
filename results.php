<?php
$title = 'Резултати';

include '/includes/headerout.php';
$val = "";
if (!isset($_GET['sort'])) {
    $_GET['sort'] = 1;
}
if(!isset($_GET['k'])){
    $_GET['k']='';
}
    $id = ">0";
    $page = search_spec_in($con, $id, '/page.php');
    $val = $_GET['k'];
?>

<div class='maincontent'>

    <div class="fffbackg">
        <div class="inheading"><h1>Резулатати</h1></div>
        <div class="searchin">
            <form method="GET" action="/results.php">
                <input type="text" name="k" value="<?php echo $val; ?>"><input type="image" src="/img/whitesearchx.png" name="searchin" style="width:30px; margin: 25px 0 -12px 10px;" alt="Search">
            </form>
            <div class="smalltxt"><?php echo $i; ?> специалности</div>
        </div>

        <div>
            <div class="tableborders">
                <table class="intable">
                    <thead>
                        <tr>
                            <th><a href="/results.php?k=<?php echo $val ?>&sort=1">Специалност</a></th>
                            <th><a href="/results.php?k=<?php echo $val ?>&sort=2">Такса</a></th>
                            <th><a href="/results.php?k=<?php echo $val ?>&sort=3">Продължителност</a></th>
                            <th><a href="/results.php?k=<?php echo $val ?>&sort=4">Срок</a></th>
                            <th><a href="/results.php?k=<?php echo $val ?>&sort=5">Университет</a></th>
                        </tr>
                    </thead>
                    <tbody><?php viewTable($spec, $i);?>
                    </tbody>
                </table>
                <div><ul class="pages"><?php pages($page); ?></ul></div>
            </div>
            <br><br>
        </div>
    </div>

</div>
<?php
include '/includes/footerout.php';
