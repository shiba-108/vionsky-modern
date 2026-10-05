<?php 
//Mod By ducnghia khong xoa ban quy ton trong nguoi khac.mod TOM (myslg_$ducnghia defuld last $tom)
define('_IN_JOHNCMS', 1); 
$textl = 'Tìm ông già noel xxu'; 
$headmod = 'nick'; 
require_once ("../incfiles/core.php"); 
require_once ("../incfiles/head.php"); 
if ($id && $id != $user_id) { 
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1"); 
if ($req) { { 
$user = $connect->fetch_assoc($req); 
} 
else { 
} 
} 
else { 
$id = false; 
$user = $datauser; 
} 
if (!$user_id) { 
require_once ('../incfiles/head.php'); 
echo functions::display_error($lng['access_guest_forbidden']); 
require_once ('../incfiles/end.php'); 
exit; 
} 

switch($act){ 
case 'ok' : 
if ($user['tienxu'] < 7000) 
echo '<div class="menu">Bạn làm gì đủ xu mà đòi Tìm :))</div>'; 
else { 

echo'<div class="phdr">Kết Quả Tìm Kiếm</div> ';
$tom= rand(1,10);
$qua= rand(1,10);


if ($qua == 1) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 2) {
                        echo'<div class="menu">Bạn không Tìm được gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 3) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 4) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 5) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 6) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 7) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 8) {
                        echo'<div class="menu">Xin chúc mừng bạn đã Tìm được ông già noel và nhận được<b>'.$tom.' Mũ len</b></div> ';

                $connect->query("UPDATE `users` SET `kem`=`kem`+'$tom', `allkem`=`allkem`+'$tom' WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 9) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 10) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-7000 WHERE `id` = '$user_id' LIMIT 1");
}


} 
break; 
default: 


echo '<div class="main"><div class="phdr"><b>tìm noel bằng xu</b> </div>';
echo '<div class="menu"><b>Tài sản ' . $datauser['tienxu'] . ' xu và ' . $datauser['luong'] . ' vinaxu</b></div>';
echo '<div class="menu">';
echo '<div class="menu"><b>Bạn Đang Sở Hữu ' . $datauser['kem'] . ' Mũ Len</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div></div>';
echo '<form action="ducnghiaxu.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm</div><div class="menu">giáng sinh kinh hoàng<b><font color="0000ff"> tìm noel xu </font></b><br>Giá 1 Tìm là 7000 xu<br/><input type="submit" name="submit" value="star"/></form></form>';

echo'</div>';

echo'</div>';


break; 
} 
echo '<br/>';
/*
echo '<div class="phdr">Sự Kiện Được Viết Bởi Đức Nghĩa</div>';
*/
require_once ("../incfiles/end.php"); 
?>