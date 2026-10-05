<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl ='Oẳn tù tì';
$noionline = 'ott';
require('../../incfiles/head.php');

$a = $datauser['tienxu'];
$tien = $datauser['tienxu'];
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Oẳn tù tì</div>';
echo' <div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['tienxu'].' xu</div>';
if ($_GET['muccuoc']) {
if ($_GET['muccuoc'] <= 0) {
echo '<div class="menu">Số tiền cược phải trên 0xu nhé !</div>';
echo '</div>';
require('../../incfiles/end.php'); 
exit;
}
if ($_GET['muccuoc'] > 3000) {
echo '<div class="menu">Số tiền cược phải dưới 3000xu nhé !</div>';
echo '</div>';
require('../../incfiles/end.php'); 
exit;
}
}
if ($user_id) { if (!$_POST['ott'] ) { if ($_GET['muccuoc']) { $_GET['muccuoc'] = preg_replace('/[^0-9]/','',$_GET['muccuoc']); ?>
<?php if ($_GET['muccuoc'] > $tien ) { ?>
<div class="menu list-bottom">Chú có <?php echo $tien ?> Xu mà đòi cược <?php echo $_GET['muccuoc'] ?> Xu à? bớt giỡn đi nhé!
Cược lại!</div>
<form action="index.php" method="get">
<input type="text" name="muccuoc" value=""> 
	<input type="submit" value="Cược" />
</form>
Ô hay cái thằng này định chơi xoáy anh à? tưởng anh ngu đến nỗi cho cược tiền âm hả ku?<br><form action="index.php" method="get">
<input type="text" name="muccuoc" value=""> 
	<input type="submit" value="Cược" />
</form> <?php } else { ?>
<div class="menu list-bottom">Roài, cược <?php echo $_GET['muccuoc']; ?>Xu.</div>
<div class="menu list-bottom">
Oẳn tù tì ra cái gì là...</div>
<form action="?muccuoc=<?php echo $_GET['muccuoc']; ?>" method="post">
<input type="radio" name="ott" value="keo"> <img src="img/keo.png" style="vertical-align: -5px;"> Kéo <br/>
<input type="radio" name="ott" value="bua"> <img src="img/bua.png" style="vertical-align: -5px;"> Búa <br/>
<input type="radio" name="ott" value="bao"> <img src="img/bao.png" style="vertical-align: -5px;"> Bao <br/>
<input type="submit" value="Oẳn!" />
</form>
<?php }} else { ?>
<div class="menu list-bottom">Chào ku <?php echo $user->data['username'] ?>, muốn oẳn tù tì với anh à? Cược bao nhiêu?</div>
<form action="index.php" method="get">
<input type="text" name="muccuoc" value=""> 
	<input type="submit" value="Cược" />
</form>
<?php }} elseif ($_POST['ott'] && $_GET['muccuoc']) { $p = $_POST['ott']; $_GET['muccuoc'] = preg_replace('/[^0-9]/','',$_GET['muccuoc']);
 if($p=='keo'){ $a = array ( 'keo', 'bua', 'bao', 'keo');}
elseif($p=='bua'){ $a = array ( 'keo', 'bua', 'bua', 'bao');}
elseif($p=='bao'){ $a = array ( 'keo', 'bua', 'bao', 'bao');} 
$i = rand(0 ,count($a)-1); $c = $a[$i]; $l = array ( 'keo' => 'Kéo', 'bua' => 'Búa', 'bao' => 'Bao',);
if (($p=='keo'&&$c=='bua')||($p=='bua'&&$c=='bao')||($p=='bao'&&$c=='keo')) {$ctl='Hé hé thắng rồi nhé, trình chú còn gà, thôi cho mình xin '.$_GET['muccuoc'].' Xu nhé :))'; 

$tt= $_GET['muccuoc'];
$cm='+ '.$_GET['muccuoc'];
$connect->query("UPDATE `users` SET `tienxu`=`tienxu` - '{$tt}' WHERE `id`='{$user_id}'");
}
elseif (($p=='keo'&&$c=='bao')||($p=='bua'&&$c=='keo')||($p=='bao'&&$c=='bua')) {$ctl='Trời thua rồi.. Ta cho mi '.$_GET['muccuoc'].' Xu rồi đấy, hôm nào quay lại chơi ta sẽ trả thù!'; 

$tt= $_GET['muccuoc'];
$cm='- '.$_GET['muccuoc'];
$connect->query("UPDATE `users` SET `tienxu`=`tienxu` + '{$tt}' WHERE `id`='{$user_id}'");
}
else {$ctl='Hề hề hòa rồi nhé, may quá, suýt thua.';}
if ($tt) {if ($_GET['muccuoc'] <= $tien ) {
/////////err//////
}}
?>

<div class="menu list-bottom hot"><?php echo $login; ?>: <img src="img/<?php echo $p; ?>.png" style="vertical-align: -5px;"> <?php echo $l[$p]; ?></div>
<div class="menu list-bottom hot">BOT: <img src="img/<?php echo $c; ?>.png" style="vertical-align: -5px;"> <?php echo $l[$c]; ?></div>
<div class="menu list-bottom"><?php echo $ctl; ?></div>
<form action="?muccuoc=<?php echo $_GET['muccuoc']; ?>" method="post">
<input type="radio" name="ott" value="keo"> <img src="img/keo.png" style="vertical-align: -5px;"> Kéo <br/>
<input type="radio" name="ott" value="bua"> <img src="img/bua.png" style="vertical-align: -5px;"> Búa <br/>
<input type="radio" name="ott" value="bao"> <img src="img/bao.png" style="vertical-align: -5px;"> Bao <br/>
<input type="submit" value="Oẳn!" />
</form>
<?php }} else { ?><div class="menu forum">Mi là thằng nào? Vô danh tiểu tốt mà bày đặt thách đấu với ta à? Đăng nhập đi rồi quay lại đây.</div> <?php } ?>


<?php
echo '</div>';
require('../../incfiles/end.php'); 
?>