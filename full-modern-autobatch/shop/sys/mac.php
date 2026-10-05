<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mặc Đồ</div>';
if ($thongtinnhanvat['sucmanh'] >= 100) {
$arr = $connect->fetch_array($connect->query("select * from kho WHERE `id` = '" . $kill . "'"));
if ($arr[user_id] == $user_id) {
if ($arr['loai'] == 'mat') {
if ($thongtinnhanvat[hp] <= 0) {
echo '<div class="menu">Bạn đang bầm mặt hãy đợi hồi lành cái đã !<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
echo'</div>';
require_once ("../incfiles/end.php");
exit;
}
}


           if ($arr['id'] != $_GET['id_loai']) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } elseif ($arr['id'] != $_GET['id_loai']) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } elseif (empty($arr['id_loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else
            if (empty($_GET['loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else {
if(isset($_POST['submit'])) {
$dmac = $connect->fetch_array($connect->query("select * from `kho` WHERE `id` = '".$arr['id']."'"));
$mac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
if ($dmac[id_loai] == $mac[$_GET['loai']]) {
echo'<div class="menu">Bạn đã mặc món đồ này rồi nhé !</div>';
} else {
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
$settrusucmanh = $connect->fetch_array($connect->query("SELECT * FROM `kho` WHERE `id_loai`='" .$dangmac[$_GET['loai']]. "' AND `user_id` = '" .$user_id. "' AND `loai` = '" .$_GET['loai']. "'"));
$setsucmanh = $connect->fetch_array($connect->query("SELECT * FROM `kho` WHERE `id` = '".$arr['id']."'"));
$hetsucmanh = $connect->fetch_array($connect->query("select * from `nhanvat` WHERE `user_id` = '".$user_id."'"));
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`-'".$settrusucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`-'".$settrusucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`+'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`+'".$setsucmanh[tangsucmanh]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hp` = `hp`-'".$settrusucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hpfull` = `hpfull`-'".$settrusucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hp` = `hp`+'".$setsucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hpfull` = `hpfull`+'".$setsucmanh[tanghp]."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `users` SET `" . $arr['loai'] . "` = '" . $arr['id_loai'] . "'  WHERE `id` = '$user_id' LIMIT 1");
if ($arr['loai'] == 'mat') {
$connect->query("UPDATE `users` SET `matcu` = '" . $arr['id_loai'] . "'  WHERE `id` = '$user_id' LIMIT 1");
}
header('Location: '.$home.'/account/ruong/');
}
} else {
$dodangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
$setdo = $connect->fetch_array($connect->query("SELECT * FROM `kho` WHERE `id_loai`='" .$dodangmac[$_GET['loai']]. "' AND `user_id` = '" .$user_id. "' AND `loai` = '" .$_GET['loai']. "'"));
$dangmac = $connect->fetch_array($connect->query("select * from `kho` WHERE `id` = '".$arr['id']."'"));
$mac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
if ($dangmac[id_loai] == $mac[$_GET['loai']]) {
echo'<div class="menu">Bạn đã mặc món đồ này rồi nhé !</div>';
} else {
if ($thongtinnhanvat['sucmanh']-$setdo[tangsucmanh] >= 0){
echo'<img src="'.$home.'/images/' . $_GET['loai'] . '/' . $dangmac[id_loai]. '.png" alt="'.$_GET['id'].'"/>';
echo '<form action="/shop/'.$_GET['loai'].'/mac/'.$arr['id'].'" method="post">'.$hetsucmanh[sucmanh].' Bạn muốn mặc món đồ này !<br /><input type="submit" name="submit" value="Mặc" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
echo $setsucmanh[tanghp];
} else {
echo'<div class="menu">Bạn không đủ điều kiên để mặc đồ nhé !</div>';
}
}
}
echo '</div>';
}
} else {
echo '<div class="menu">Đây không phải món đồ của bạn nhé !<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
echo '</div>';
}
} else {
echo'<div class="menu">Bạn phải trên 100 sức mạnh để mặc đồ nhé !</div>';
echo '</div>';
}
?>