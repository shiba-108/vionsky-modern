<?php
define('_IN_JOHNCMS', 1);
$noionline = 'farm-mem';
require_once('../incfiles/core.php');
include_once('func.php');
$idnick = $_GET[id];
$nick = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$idnick}'"));
$textl = 'Khu vườn của '.$nick[name].'!';
require('../incfiles/head.php');
if ($user_id == $idnick) {
header('Location: /farm/');
}
if (!$user_id) {
header('Location: /');
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu vườn của '.$nick[name].'</div>';
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$idnick}'"));
if(empty($thongtin[id])) {
header('Location: '.$home.'');
}
echo'<div class="dat">';
echo'<img src="icon/farm.png" alt="icon" style="vertical-align: 0px;"/>';
echo'<img src="/avatar/nen/'.$idnick.'.png" alt="icon" style="vertical-align: 0px;"/>';
if($user_id) {
$k=($connect->query("SELECT COUNT(*) FROM `fermer_gr` WHERE `id_user` = '$idnick'")->fetch_row()[0] ?? 0);
$res = $connect->query("select * from `fermer_gr` WHERE `id_user` = '$idnick' LIMIT 60"); 
echo'<div class="cola">';
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
if($post['time']>0 && $post['time']<=$time){
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" /></a>';
} else {
if ($post['semen'] == 0) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/0.png" alt="*" /></a>';
} else {
if ($nuatime >= $nuatimechin) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" /></a>';
} else {
if ($timegieohat <= $nuatimechin) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/gieohat.png" alt="*" /></a>';
} else {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" /></a>';
}
}
}
}
}
$muacho = $connect->fetch_array($connect->query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$idnick}'"));
if(!empty($muacho[id_user])) {
echo' <img src="icon/thunuoi/cho.png" alt="icon" style="vertical-align: 0px;"/></a>';
}
echo'</div>';
echo'</div>';
echo'</div>';
if(isset($_GET['muadat'])){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua đất</div>';
if($datauser['tienxu']>=10000) {
echo '<div class="menu">';
echo "Mở thêm 1 đất bạn mất 10000 xu";
echo "<form method='post' action='?gr_add'>\n";
echo "<input type='submit' name='save' value='Mua!' />";
echo'</div>';
} else {
echo '<div class="menu list-top">Bạn phải đủ 10000 xu để mở ô đất mới</div>';
}
echo'</div>';
}
$int = intval($_GET['view']);
if ($int > 0) {
$muacho = $connect->fetch_array($connect->query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$idnick}'"));
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
if(isset($_POST['sadit']) && $post['semen']==0)
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
header('Location: /farm/account.php?id='.$idnick.'&view='.$post['id'].'&ok');
}

if(isset($_POST['udobr'])) {
$res = $connect->fetch_array($connect->query("select * from `fermer_udobr` WHERE `id` = '$_POST[udobr]' ")); 
$semen = $connect->fetch_array($connect->query("select * from `fermer_udobr_name` WHERE `id` = '$res[udobr]' "));
$connect->query("UPDATE `fermer_gr` SET `time` = `time`- $semen[time] WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
$connect->query("UPDATE `fermer_udobr` SET `kol` = `kol`-'1' WHERE `id` = $_POST[udobr] LIMIT 1");
}else{
$connect->query("DELETE FROM `fermer_udobr` WHERE `id` = $_POST[udobr] ");
}
header("Location: /farm/account.php?id=".$idnick."&view=".$post[id]."&bonphan#menu");
}
if(isset($_GET['woter']) && $nickmem['woter']!=1){
$connect->query("UPDATE `fermer_gr` SET `woter` = '1' WHERE `id` = $int LIMIT 1");
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #e0e0e0;">Tưới nước thành công !</div>';
}
if($post){
include '../incfiles/sys/farm/farm-mem.php';
echo'</div>';
}
}

} else {
header('Location: /');
}
echo'<a name="menu" id="menu"></a>';
require('../incfiles/end.php');

?>