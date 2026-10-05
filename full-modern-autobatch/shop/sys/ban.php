<?php
if ($user_id) {
$xoa = $connect->fetch_array($connect->query("select * from kho WHERE `id` = '".$_GET['id']."'"));
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Bán đồ</div><div class="menu">';
if ($xoa[user_id] == $user_id) {
$getdo = mysql_fetch_array ($connect->query("SELECT * FROM `kho` WHERE `id`='".$_GET['id']."'"));
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
$setsucmanh = $connect->fetch_array($connect->query("SELECT * FROM `kho` WHERE `id` = '".$_GET['id']."'"));
$xacnhan = $thongtinnhanvat['sucmanh'];
if ($dangmac[$getdo['loai']]!== $getdo['id_loai']) {
$giashop = mysql_fetch_array ($connect->query("SELECT * FROM `shop` WHERE `id_loai`='".$getdo[id_loai]."' AND `loai`='".$getdo[loai]."'"));
if ($giashop[vinaxu] <= '0' && $giashop[gia] <= '0') {
$giaban = '0';
} else {
if(!empty($giashop[gia])) {
$chiagia = $giashop[gia]/2;
$giaban = $giashop[gia]-$chiagia;
} else {
if ($giashop[vinaxu] == '2') {
$giaban = $giashop[vinaxu]-1;
} else {
$giaban = $giashop[vinaxu]-2;
}
}
}
if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `kho` WHERE `id`='".$_GET['id']."' LIMIT 1;");
if ($getdo[type] == 2) {
@$connect->query("update `users` set `tienxu` = `tienxu`+'2000' where `id` = '" . $user_id . "'");
} else {
if(!empty($giashop[gia])) {
@$connect->query("update `users` set `tienxu` = `tienxu`+'".$giaban."' where `id` = '" . $user_id . "'");
} else {
@$connect->query("update `users` set `vinaxu` = `vinaxu`+'".$giaban."' where `id` = '" . $user_id . "'");
}
}
if ($dangmac[$getdo['loai']] == $getdo['id_loai']) {
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`-'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`-'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `users` SET `" . $xoa['loai'] . "` = '0'  WHERE `id` = '$user_id' LIMIT 1");
}
header('Location: '.$home.'/account/ruong/');  
} else {
echo'<img src="'.$home.'/images/'.$getdo[loai].'/'.$getdo[id_loai].'.png"/>';

if ($getdo[type] == 2) {
echo '<form action="/shop/ban/'.$_GET['id'].'" method="post">Đây là đồ quay số nên chỉ bán với gia 2000xu bạn muốn bán không!<br /><input type="submit" name="submit" value="Bán" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
} else {
if ($giashop[vinaxu] <= '0' && $giashop[gia] <= '0') {
echo '<form action="/shop/ban/'.$_GET['id'].'" method="post">Bạn muốn bán món đồ này với giá 0xu !<br /><input type="submit" name="submit" value="Bán" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
} else {
if(!empty($giashop[gia])) {
echo '<form action="/shop/ban/'.$_GET['id'].'" method="post">Bạn muốn bán món đồ này với giá '.$giaban.'xu không!<br /><input type="submit" name="submit" value="Bán" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
} else {
echo '<form action="/shop/ban/'.$_GET['id'].'" method="post">Bạn muốn bán món đồ này với giá  <span style="color:green;">'.$giaban.' vinaxu</span>  không!<br /><input type="submit" name="submit" value="Bán" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
}
}
}
}
} else {
echo'Bạn phải <span style="color:red;">tháo</span> món đồ này ra rồi mới được bán nó nhé !<br/>
<a href="/account/ruong/"><input type="button" value="Trở về" /></a>';
}
} else {
header('Location: '.$home.'/account/ruong/');  
}
echo '</div>';
echo '</div>';
}
?>