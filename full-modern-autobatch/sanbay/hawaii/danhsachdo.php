<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$loaido = $_GET[mua];
$do = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = '$loaido'"));
$textl = 'Cửa Hàng';
require_once('../../incfiles/head.php');
echo '<div class="mainblok">';
if(!$user_id)
{
echo '<div class="menu">Bạn không phải là thành viên!</div>';
}else{

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Danh Sách Món Đồ</div>';
$loai = '' . $_GET['loai'] . '';
$req = $connect->query("SELECT * FROM `shop` WHERE `loai` = '$loaido' AND `pro` = '2' ORDER BY `id` DESC LIMIT $start, $kmess");
$total = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = '$loaido' AND `pro` = '2'")->fetch_row()[0] ?? 0);
if ($total > '1') {
echo'<div class="menu">Hệ thống đã cập nhật '.$total.' loại đồ này</div>';
}
while($mondo = $connect->fetch_array($req))
{
echo'<div class="menu list-top">';
if ($mondo['loai'] == toc) {
echo '<img style="background:url(/images/khuonmat.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}
if ($mondo['loai'] == ao) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == quan) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == non) {
echo '<img style="background:url(/icon/nen.png);text-align: center;"src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == kinh) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina">';
}

if ($mondo['loai'] == mat) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina">';
}

if ($mondo['loai'] == matna) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == canh) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == thucung) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == docamtay) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == khuonmat) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == haoquang){
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}
if ($mondo['loai'] == nensau) {
echo '<img src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
}
if(!empty($mondo[tenvatpham])) {
echo'<b><font color ="green">' . $mondo['tenvatpham'] . '</font></b>';
}
echo '<span style="color:black"><b>';
if ($mondo[tangsucmanh] > 0 ) {
echo'&nbsp;[+ ' . $mondo['tangsucmanh'] . ' SM]';
}
if ($mondo[hp] > 0) {
echo '&nbsp;[+ '.$mondo['hp'].' HP]';
}
echo '</span><br/>';
if(!empty($mondo[gia])) {
echo'Giá tiền: ' . $mondo['gia'] . ' xu';
} else {
echo'Giá tiền: <span style="font-size:12px;color:green;">' . $mondo['vnd'] . ' VNĐ</span>';
}
echo '<br/><a href="mua/' . $mondo['id'] . '">[<b>Mua</b>]</a>';
if ($rights == 9) {
echo ' <a href="hot/' . $mondo['id'] . '">[<b>HOT</b>]</a> ';
echo ' <a href="/shop/xoa/' . $mondo['id'] . '">[<b>Xóa</b>]</a>';
}
echo'</div> ';
}
if ($total == '0') {
echo '<div class="menu">Hệ thống chưa cập nhật món đồ này</div>';
}
if ($total > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/boss/' . $loaido. '/', $start, $total, $kmess) . '</div>';
}
}
echo '</div>';
echo '</div>';
require('../../incfiles/end.php');
?>