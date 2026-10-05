<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
$noionline = 'event';
require('../incfiles/core.php');
$textl = 'Tạp Hóa';
$int = intval($_GET['id']);
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tạp Hóa</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}


//----------//

echo'<div class="menu list-bottom"><table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;"><img src="img/1.png" alt="do"/>&#160;</td><td><a href="?lua"><b>Bánh Gạo</b></a> <span style="font-size:12px;color:green;">(5 điểm)</span></br>Nguyên Liệu: <b>50</b> Lúa, <b>300</b> Coin </td></tr></table></div>';

echo'<div class="menu list-bottom"><table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;"><img src="img/banhthanhlong.png" alt="do"/>&#160;</td><td><a href="?thanhlong"><b>Bánh thanh long</b></a> <span style="font-size:12px;color:green;">(10 điểm)</span></br>Nguyên Liệu: <b>200</b> Thanh Long, <b>6</b> iCoin </td></tr></table></div>';


echo'</div>';


if(isset($_GET['lua']))
{
$sql=$connect->query("SELECT `id` FROM `fermer_hatgiong` WHERE `id`='$int' AND `semen` = '1' AND `id_user` = $user_id ");
$l=$connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `semen`= '1' AND `id_user` = $user_id "));
$row=$connect->fetch_assoc($sql);

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đổi bánh gạo</div>';

if(isset($_GET['sell']))
{
if(!$connect->query("SELECT * FROM ...")$sql)){
echo '<div class="menu">Vật Phẩm Không Tồn Tại!</div>';
echo "</div>";
require('../incfiles/end.php');

exit;
}

if($l['semen'] != 1){
echo '<div class="menu">Lỗi loại item -_- bug đéo!</div>';
echo "</div>";
require('../incfiles/end.php');
exit;
}
if ($datauser['tienxu'] < 300) {
echo '<div class="menu">Không đủ số tiền yêu cầu!</div>';
echo "</div>";
require('../incfiles/end.php');
exit;
}
if($l['kol'] < 50) {
echo "<div class='menu'>Bạn chưa có đủ Lúa yêu cầu!</div>";
echo "</div>";
require('../incfiles/end.php');
exit;
}
$post =$connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `semen`= '1' AND `id_user` = '$user_id'"));
if($post['kol'] > 50) {
$connect->query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'50' WHERE `id` = '{$_GET[id]}'");
} else {
$connect->query("DELETE FROM `fermer_hatgiong` WHERE `id` = $_GET[id] ");
}
$connect->query("UPDATE users SET `tienxu` = `tienxu`-'300' WHERE `id` = '{$user_id}'");
$connect->query("UPDATE haloween SET `diem` = `diem`+'5' WHERE `user_id` = '{$user_id}'");
echo "<div class='menu'>Thành công, bạn bị trừ 50 lúa và 300 coin!</div>";
echo'</div>';
require('../incfiles/end.php');
exit;
}



$postt =$connect->fetch_array($connect->query("select COUNT(*) from `fermer_hatgiong` WHERE `semen`= '1' AND `id_user` = '$user_id'"));

$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$postt[semen]'"));

$dohod=$postt['kol']*$semen['dohod'];


$k = ($connect->query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id' AND `semen`= '1'")->fetch_row()[0] ?? 0);

if($k == 0) {
echo "<div class='menu'>Hiện tại bạn chưa có lúa!</div>";
} else {
$res = $connect->query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' AND  `semen`= '1' LIMIT 10");
while ($post = $connect->fetch_array($res)){
$semenz=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
echo'<div class="menu">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo '<img id="raucu" src="/farm/icon/shop/'.$post['semen'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'Tên: <b>'.htmlspecialchars($semenz['name']).'</b><br />
Bạn có: '.$post['kol'].'';
echo "<form method='post' action='?lua&id=".$post['id']."&amp;sell'>\n";
echo "<input type='submit' name='save' value='Đổi Bánh' />\n";
echo "</form>";
echo'</td></tr></table></div>';
}
}

echo'</div>';
}

///////////////////


if(isset($_GET['thanhlong']))
{
$sql=$connect->query("SELECT `id` FROM `fermer_hatgiong` WHERE `id`='$int' AND `semen` = '9' AND `id_user` = $user_id ");
$l =$connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `semen`= '9'  AND `id_user` = '$user_id'"));
$row=$connect->fetch_assoc($sql);

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đổi bánh thanh long</div>';

if(isset($_GET['sell']))
{
if(!$connect->query("SELECT * FROM ...")$sql)){
echo '<div class="menu">Vật Phẩm Không Tồn Tại!</div>';
echo "</div>";
require('../incfiles/end.php');

exit;
}

if($l['semen'] != 9){
echo '<div class="menu">Lỗi loại item -_- bug đéo!</div>';
echo "</div>";
require('../incfiles/end.php');
exit;
}
if($l['kol'] < 200) {
echo "<div class='menu'>Bạn chưa có đủ số Thanh long yêu cầu!</div>";
echo "</div>";
require('../incfiles/end.php');
exit;
}
if ($datauser['vinaxu'] < 6) {
echo '<div class="menu">Không đủ số tiền yêu cầu!</div>';
echo "</div>";
require('../incfiles/end.php');
exit;
}
$post =$connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `semen`= '9' AND `id_user` = '$user_id'"));
if($post['kol'] > 200) {
$connect->query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'200' WHERE `id` = '{$_GET[id]}'");
} else {
$connect->query("DELETE FROM `fermer_hatgiong` WHERE `id` = $_GET[id] ");
}
$connect->query("UPDATE users SET `vinaxu` = `vinaxu`-'6' WHERE `id` = '{$user_id}'");
$connect->query("UPDATE haloween SET `diem` = `diem`+'10' WHERE `user_id` = '{$user_id}'");
echo "<div class='menu'>Thành công, bạn bị trừ 200 thanh long và 6 icoin!</div>";
echo'</div>';
require('../incfiles/end.php');
exit;
}



$postt =$connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `semen`= '9' AND `id_user` = '$user_id'"));

$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$postt[semen]' AND `id_user` = '$user_id'"));

$dohod=$postt['kol']*$semen['dohod'];


$k = ($connect->query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id' AND `semen`= '9'")->fetch_row()[0] ?? 0);

if($k == 0) {
echo "<div class='menu'>Hiện tại bạn chưa có thanh long!</div>";
} else {
$res = $connect->query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' AND  `semen`= '9' LIMIT 10");
while ($post = $connect->fetch_array($res)){
$semenz=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
echo'<div class="menu">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo '<img id="raucu" src="/farm/icon/shop/'.$post['semen'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'Tên: <b>'.htmlspecialchars($semenz['name']).'</b><br />
Bạn có: '.$post['kol'].'';
echo "<form method='post' action='?thanhlong&id=".$post['id']."&amp;sell'>\n";
echo "<input type='submit' name='save' value='Đổi Bánh' />\n";
echo "</form>";
echo'</td></tr></table></div>';
}
}

echo'</div>';
}





require('../incfiles/end.php');
?>