<?php
define('_IN_JOHNCMS', 1);
$noionline = 'farm';
require_once('../incfiles/core.php');
$lng_forum = core::load_lng('forum');
include_once('func.php');
$textl = 'Nông trại Online';
require('../incfiles/head.php');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
include'sys/xem.php';
echo'<style>body{min-width: 600px}</style>';
include'autofarm.php';
include'sys/tienhoa.php';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nông Trại</div>';
if ($demvn1 > 0 || $demvn2 > 0 || $demvn3 > 0 || $demvn4 > 0 || $demvn5 > 0) {
if ($timevn1[tinhtrang] == 1 || $timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1 || $timevn5[tinhtrang] == 1) {
echo '<div class="menu list-bottom congdong">';
if ($demvn2 > 0 || $demvn3 > 0 || $demvn4 > 0) {
if ($timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1) {
echo'<a href="/farm/?choheocuuboan"><input type="button" value="Cho Heo, Cừu, Bò ăn"/></a>';

}
}
if ($demvn1 > 0) {
if ($timevn1[tinhtrang] == 1) {
echo'<a href="/farm/?chogaan"><input type="button" value="Cho Gà ăn"/></a>';
}
}
if ($demvn5 > 0) {
if ($timevn5[tinhtrang] == 1) {
echo'<a href="/farm/?chocaan"><input type="button" value="Cho Cá ăn"/></a>';
}
}
echo'</div>';
}
}
include'sys/thuhoachsanluong.php';
include'sys/sanluong.php';
include'sys/thoigiansong.php';
echo'<div class="dat" style="margin-bottom: 3px">';
echo'<img src="icon/farm.png" alt="icon" style="vertical-align: 0px;"/>';
echo'<a href="/farm/shop.php"><img src="../icon/cuahangfarm.png" style="vertical-align: -8px;"></a> <a href="nhakho.php"><img src="icon/nhakho.png" alt="icon" style="vertical-align: -5px;"/></a> <a href="nhabep/"><img src="icon/nhabep.png" alt="icon" style="vertical-align: -5px;"/></a>';
if (($datauser[timethuhoachkhe] + 3600) < $time) {
echo' <a href="thuhoachkhe.php"><img src="/icon/caykhechin.png" alt="icon" style="vertical-align: -5px;"/></a><br/>';
} else {
echo' <a href="thuhoachkhe.php"><img src="/icon/caykhe.png" alt="icon" style="vertical-align: -5px;"/></a><br/>';
}
if($user_id) {

echo'<form method="post">';
$tongodat =($connect->query("SELECT COUNT(*) FROM `fermer_gr` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
$res = $connect->query("select * from `fermer_gr` WHERE `id_user` = '$user_id' LIMIT 60");
echo'<div class="cola" style="margin-top: 5px">';
while ($post = $connect->fetch_array($res)){
$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
$p = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE  `id` = '$post[id]'  LIMIT 1"));
if($p['semen']!=0 && $time>$p['time'] && $p['kol']==0)
{
$pt=rand($semen['rand1'],$semen['rand2']);
if($post['woter']==0)$pt=floor($pt/2);
$connect->query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = '$post[id]' LIMIT 1");
}
if($post['semen']!=0)
echo "".$time_1."";
$nuatimeitem = $post['time_thuhoach']-$post['time_ki'];
$nuatime = $nuatimeitem/2;
$nuatimechin = $post['time']-$time;
$nuatimeitem2 = $nuatimeitem;
$timegieohat2 = $nuatimeitem2/2;
$timegieohat3 = $nuatimeitem2/4;
$timegieohat = $timegieohat2+$timegieohat3;
echo'<label style="display: inline-block;text-align: center;">';
if($post['time']>0 && $post['time']<=$time){
echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" /></a>';
} else {
if ($post['semen'] == 0) {
echo'<img id="raucu" src="icon/0.png" alt="*" />';
} else {
if ($nuatime >= $nuatimechin) {
echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" /></a>';
} else {
if ($timegieohat <= $nuatimechin) {
echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/gieohat.png" alt="*" /></a>';
} else {
echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" /></a>';
}
}
}
}
echo'<br /><input type="checkbox" name="dattrong[]" value="'.$post['id'].'" id="checkItem" checked="checked"></label>';
}
if ($tongodat <= 60) {
if(!isset($_GET['muadat'])){
echo' <a href="?muadat"><img src="/icon/muadat.png" alt="icon" style="vertical-align: 0px;"/></a>';
}
}

echo'</div>';
include'sys/nuoigiasuc.php';
include'sys/choan.php';
echo'</div>';
echo'</div>';
include'sys/muadat.php';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tuỳ chọn</div>';
echo'<div class="menu">';
echo '<select name="sadit">';
$res = $connect->query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` ");
while ($post = $connect->fetch_array($res)){
$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]' LIMIT 1"));
$name_gr= $semen['name'];
echo "<option value='".$post['id']."'>".$name_gr." [".$post['kol']."]</option>";
}
echo'</select>
<input type="submit" name="gieohat" value="Gieo hạt"><input type="submit" name="tuoinuoc" value="Tưới nước"><input type="submit" name="thuhoach" value="Thu hoạch">
</form>';
echo'</div>';
echo'</div>';

$int = intval($_GET['id']);
if ($int > 0) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin rau củ</div>';
$post = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE  `id` = '$int'  LIMIT 1"));
if(isset($_GET['ok'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #e0e0e0;">Thành công !</div>';
}
if(isset($_GET['thuhoachxong'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;">Cây trồng đã được thu hoạch thành công !</div>';
}
if(isset($_GET['bonphan'])) {
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Bón phân thành công!</div>';
}
if(isset($_POST['sadit']) && $post && $user_id==$post['id_user'] && $post['semen']==0)
{
$res = $connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `id` = '$_POST[sadit]' "));
$semen = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE `id` = '$res[semen]' "));
$t=$time+$semen['time'];
$connect->query("UPDATE `fermer_gr` SET `semen` = $res[semen] WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = '$t' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time_thuhoach` = '$t' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time_ki` = '$time' WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
$connect->query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'1' WHERE `id` = $_POST[sadit] LIMIT 1");
}else{
$connect->query("DELETE FROM `fermer_hatgiong` WHERE `id` = $_POST[sadit] ");
}
header("Location: ?id=".$int."");
}

if(isset($_POST['udobr']) && $post && $user_id==$post['id_user'] && $post['semen']!=0)
{
$res = $connect->fetch_array($connect->query("select * from `fermer_udobr` WHERE `id` = '$_POST[udobr]' "));
$semen = $connect->fetch_array($connect->query("select * from `fermer_udobr_name` WHERE `id` = '$res[udobr]' "));
$connect->query("UPDATE `fermer_gr` SET `time` = `time`- $semen[time] WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
$connect->query("UPDATE `fermer_udobr` SET `kol` = `kol`-'1' WHERE `id` = $_POST[udobr] LIMIT 1");
}else{
$connect->query("DELETE FROM `fermer_udobr` WHERE `id` = $_POST[udobr] ");
}
header("Location: ?id=".$int."&bonphan#menu");
}
if($post){
if($user_id == $post['id_user']){
include '../incfiles/sys/farm/farm.php';
} else {
echo "<div class='menu'>Đây không phải là đất của bạn";}
}
echo'</div>';
}
}
echo'<a name="menu" id="menu"></a>';
require('../incfiles/end.php');
?>
