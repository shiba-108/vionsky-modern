<?php
define('_IN_JOHNCMS', 1);

$textl = 'Cửa Hàng Sinh Thái';
$hamcancau3 = 2;
require_once ('../incfiles/core.php');
require_once ('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Cửa Hàng Sinh Thái</div>';
if (!$user_id) {
    echo display_error('Dành cho thành viên nhá !');
    require_once ('../incfiles/end.php');
    exit;
}
$xacnhancancau = $connect->fetch_array($connect->query("SELECT * FROM `fish_in` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if ($xacnhancancau['ud'] > '0') {
$connect->query("UPDATE `users` SET `cancau` = '" .$xacnhancancau['ud']. "'  WHERE `id` = '$user_id' LIMIT 1");
}
$prov = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `fish` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if($prov < 1){
    header('Location: index.php');
    exit;
}

$connect->query("UPDATE `fish` SET `time` = '0', `rand_time` = '0', `status` = '0' WHERE `user_id` = '".$user_id."' LIMIT 1");

$res = $connect->fetch_array($connect->query("SELECT `money` FROM `fish` WHERE `user_id` = '".$user_id."' LIMIT 1"));

switch ($act) {

case 'mua':
$ud = intval($_POST['ud']);

if($ud < 1 or $ud > 3){
header('Location: '.$home.'/khusinhthai/');
}

if($ud == '1'){
    $mon = '1000';
}elseif($ud == '2'){
    $mon = '3000';
}elseif($ud == '3'){
    $mon = '5000';
}else{
    echo '<div class="menu">Không có gì ở đây cả.</div>';
}
if($datauser['tienxu'] > $mon){
@$connect->query("update `users` set `tienxu` = `tienxu`-'" . $mon. "' where `id` = '" . $user_id . "'");
$connect->query("UPDATE `fish_in` SET `ud`= '".$ud."', `ud_d` = '100' WHERE `user_id` = '$user_id' LIMIT 1");

echo '<div class="menu">Chúc mừng bạn đã mua một cần câu mới!</div>';
echo '<div class="menu"><a href="shop.php">Quay lại shop</a></div>';
} else {
echo '<div class="menu">Bạn đủ tiền để mua cần câu !<br/><a href="shop.php">Quay lại shop</a></div>';
}
break;

case 'muamoi':
$na = intval($_POST['na']);

if($na < 1 or $na > 3){
header('Location: '.$home.'/khusinhthai/');
}

if($na == '1'){
    $mon = '20';
}elseif($na == '2'){
    $mon = '40';
}elseif($na == '3'){
    $mon = '60';
}else{
    echo '<div class="menu">Không có gì ở đây cả.</div>';
}
if($datauser['tienxu'] > $mon){
@$connect->query("update `users` set `tienxu` = `tienxu`-'" . $mon. "' where `id` = '" . $user_id . "'");
$connect->query("UPDATE `fish_in` SET `na` = '".$na."', `na_d` = '100' WHERE `user_id` = '$user_id' LIMIT 1");

echo '<div class="menu">Chúc mừng bạn đã mua một mồi mới!</div>';
echo '<div class="menu"><a href="shop.php">Quay lại shop</a></div>';
} else {
echo '<div class="menu">Bạn đủ tiền để mua mồi câu !<br/><a href="shop.php">Quay lại shop</a></div>';
}
break;

default:

echo '<div class="menu list-bottom"><img src="/avatar/'.$datauser['id'].'.png" class="avatar_vina"/>Các bạn có thể mua các vật phẩm cần thiết để câu cá tại đây !<br/>Tài sản: '.$datauser['tienxu'].' Xu</div>';
    echo'<div class="menu list-bottom hot">Mua cần câu</div>';
    echo '<div class="menu"><form action="shop.php?act=mua" name="ud" method="post">
    <input type="radio" name="ud" value="1"/><img src="/khusinhthai/cancau/cancau1.png"/> Cần câu tre<br />giá: 1000 xu<br />
    <input type="radio" name="ud" value="2"/><img src="/khusinhthai/cancau/cancau2.png"/> Cần câu sắt<br />giá: 3000 xu<br />
    <input type="radio" name="ud" value="3"/><img src="/khusinhthai/cancau/cancau3.png"/> Cần câu vip<br />giá: 5000 xu<br />
    <input type="submit" name="submit" value="Mua"/></form></div>';

    echo'<div class="menu list-bottom hot">Mua mồi</div>';
    echo '<div class="menu"><form action="shop.php?act=muamoi" name="na" method="post">
    <input type="radio" name="na" value="1"/><img src="/khusinhthai/moi/moi1.png"/> 100 Mồi cơm<br />Giá: 200 xu (30% cá ăn)<br />
    <input type="radio" name="na" value="2"/><img src="/khusinhthai/moi/moi2.png"/> 100 Mồi trùng<br />Giá: 400 xu (50% cá ăn)<br />
    <input type="radio" name="na" value="3"/><img src="/khusinhthai/moi/moi3.png"/> 100 Mồi trứng kiến<br />Giá: 600 xu (70% cá ăn)<br />
    <input type="submit" name="submit" value="Mua"/></form></div>';

}

echo'</div>';
require_once ("../incfiles/end.php");

?>