<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khuvuichoi';
require_once('../incfiles/core.php');
$textl = 'Rương đạo cụ';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Quay số</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để quay số nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu congdong">'.nick($user_id).' bạn có '.$datauser['tienxu'].' Xu <span style="color:#e2e2e2">|</span> '.$datauser['vinaxu'].' Vinaxu</div>';
echo'<div class="menu list-top hot"><a href="'.$home.'/khuvuichoi/quacauquayso/"><b style="color:red">Mua Quả Cầu Quay số</b></a></div>';
if($user_id){
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$sql=$connect->query("SELECT `id` FROM `quayso_item` WHERE `id`='$int' AND `id_user` = $user_id ");
$row=$connect->fetch_assoc($sql);
if(!$connect->query("SELECT * FROM ...")$sql)){
echo '<div class="menu">Vật Phẩm Không Tồn Tại!</div>';
echo "</div>";
require('../incfiles/end.php');

exit;
}
$post=$connect->fetch_array($connect->query("select * from `quayso_item` WHERE `id`= '$int' LIMIT 1"));
$thongtin = $connect->fetch_array($connect->query("select * from `quayso` WHERE  `id` = '$post[go]'  LIMIT 1"));
$sosanhkhodo = ($connect->query("SELECT COUNT(*) FROM `kho` WHERE `loai` = '".$thongtin['loai']."' AND `id_loai` = '".$thongtin['id_loai']."' AND `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);



echo'<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo '<img src="/khuvuichoi/icon/'.$thongtin['id'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'<b>'.htmlspecialchars($thongtin['name']).'</b><br />';
echo "Số lượng: <b>".$post['soluong']."</b>";
if ($sosanhkhodo == 0) {
echo "<br/><form method='post'>\n";
echo "<input type='submit' name='submit' value='Quay' />\n"; 
echo "</form>";
} else {
echo'<div class="menu"><b style="color:red">Bạn đã quay được món đồ này rồi nhé !</b></div>';
}
echo'</td></tr></table></div>';

if (isset($_POST['submit'])) {
echo'</div><div class="main-xmenu"><div class="danhmuc">Quay số</div>
<div class="menu congdong list-bottom">Quay vật phẩm '.htmlspecialchars($thongtin['name']).'</div>';

if ($post['soluong'] <= 0) {
echo'<div class="menu congdong">Bạn không đủ điều kiện để quay</div>';
} else {

$quydinh = $thongtin['rand1']*$thongtin['rand2'];
$qua = rand(1,$quydinh);

echo'<div class="menu congdong list-bottom">Số Quy Định: '.$quydinh.' '.$xuatphat.'</div>';
echo'<div class="menu congdong">Số Quay Được: '.$qua.'</div>';
if ($qua == ''.$quydinh.'') {
echo'<div class="menu congdong list-top" style="color:green">Chúc mừng bạn quay đã trúng <b>'.htmlspecialchars($thongtin['name']).' hãy vào rương đồ để xem nhé !</b></div>';
//*Trừ số lượng*//
$connect->query("UPDATE `quayso_item` SET `soluong` = `soluong`-'1' WHERE `id` = $int LIMIT 1");
//*Lưu thông tin*//
                $connect->query("INSERT INTO `kho` SET 
               `type`='2',
               `user_id`='" . $user_id. "',
               `id_loai`='" . $thongtin['id_loai'] . "',
               `loai`='" . $thongtin['loai'] . "',
               `tenvatpham`='" . $thongtin['name'] . "'
               ");



} else {
echo'<div class="menu congdong list-top" style="color:red"><b>Lượt quay thất bại !</b></b></div>';
$connect->query("UPDATE `quayso_item` SET `soluong` = `soluong`-'1' WHERE `id` = $int LIMIT 1");
}
}


}
} else {
$tong = ($connect->query("SELECT COUNT(*) FROM `quayso_item` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
if($tong == 0) {
echo "<div class='menu'>Hiện tại nhà kho của bạn chưa có quả cầu nào !</div>";
} else {
$res = $connect->query("select * from `quayso_item` WHERE `id_user` = '$user_id'  ORDER BY `id` DESC LIMIT $start, $kmess");
while ($post = $connect->fetch_array($res)){
$thongtin=$connect->fetch_array($connect->query("select * from `quayso` WHERE  `id` = '$post[go]'  LIMIT 1"));
echo'<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo'<img src="/khuvuichoi/icon/'.$thongtin['id'].'.png" alt="icon" />';
echo'&#160;</td><td>';
echo'<a href="/khuvuichoi/quayso/'.$post[id].'">[ <b>Quả cầu '.htmlspecialchars($thongtin['name']).'</b> ]</a><br/>';
echo'Số Lượng: '.$post['soluong'].' <a href="/khuvuichoi/quayso/ban/'.$post[id].'">[ <b style="color:red">Bán</b> ]</a>';
echo'</td></tr></table></div>';
}
}
}
if ($tong > $kmess) { 
echo '<div class="menu">' . functions::phan_trang('/khuvuichoi/quacauquayso/', $start, $tong, $kmess) . '</div>'; 
}
echo "<div class='menu list-top'>";

echo "&laquo; <a href='/khuvuichoi/'>Quay lại</a>";
echo "</div></div>";
}else{
echo'Bạn Chưa Đăng Nhập!';
}require('../incfiles/end.php');


?>