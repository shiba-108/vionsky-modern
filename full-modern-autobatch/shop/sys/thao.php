<?php
if ($user_id) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Tháo đồ</div><div class="menu">';
if ($_GET['id'] == 'mat') {
if ($thongtinnhanvat[hp] <= 0) {
echo '<div class="menu">Bạn đang bầm mặt hãy đợi hồi lành cái đã !<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
echo'</div>';
echo'</div>';
require_once ("../incfiles/end.php");
exit;
}
}
$thao = $connect->fetch_array($connect->query("select * from kho WHERE `id` = '".$_GET['id']."'"));
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
$idmondo = $connect->fetch_array($connect->query("select * from kho WHERE `loai` = '".$_GET['id']."' AND `id_loai` = '".$dangmac[$_GET['id']]."' AND `user_id` = '".$user_id."'"));
$setsucmanh = $connect->fetch_array($connect->query("SELECT * FROM `kho` WHERE `id` = '".$idmondo[id]."'"));
$xacnhan = $thongtinnhanvat['sucmanh'];
if ($xacnhan > $setsucmanh[tangsucmanh]) {
if(isset($_POST['submit'])) {
if ($dangmac[$getdo['loai']] == $getdo['id_loai']) {
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`-'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`-'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hp` = `hp`-'".$setsucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hpfull` = `hpfull`-'".$setsucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `users` SET `" . $_GET['id'] . "` = '0'  WHERE `id` = '$user_id' LIMIT 1");
}
if ($_GET['id'] == 'mat') {
$connect->query("UPDATE `users` SET `matcu` = '0'  WHERE `id` = '$user_id' LIMIT 1");
}
header('Location: '.$home.'/account/ruong/');
} else {
echo'<img src="'.$home.'/images/'.$_GET['id'].'/'.$dangmac[$_GET['id']].'.png"/>';
echo '<form action="/shop/'.$_GET['id'].'/thao" method="post">Bạn muốn tháo món đồ này ra !<br /><input type="submit" name="submit" value="Tháo" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
}
} else {
echo'Hiện tại sức mạnh của bạn <span style="color:red;">ít hơn</span> món đồ này nên không thể <span style="color:red;">tháo</span> nó ra ! Hãy chờ hồi phục sức mạnh rồi hãy <span style="color:red;">tháo</span> nó nhé !<br/>
<a href="/account/ruong/"><input type="button" value="Trở về" /></a>';
}
echo '</div>';
echo '</div>';
}
?>