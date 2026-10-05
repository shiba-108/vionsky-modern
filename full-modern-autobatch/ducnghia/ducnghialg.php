<?php 
//Mod By ducnghia khong xoa ban quy ton trong nguoi khac.mod TOM (myslg_$ducnghia defuld last $tom)
define('_IN_JOHNCMS', 1); 
$textl = 'tìm noel bằng vina'; 
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
if ($user['vinaxu'] < 5) 
echo '<div class="menu">cần 5 vina để tìm ông già :))</div>'; 
else { 

echo'<div class="phdr">Kết Quả Tìm Kiếm</div> ';
$tom= rand(5,20);
$qua= rand(1,10);


if ($qua == 1) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 2) {
                        echo'<div class="menu">Bạn không Tìm được gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 3) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 4) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 5) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 6) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 7) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 8) {
                        echo'<div class="menu">Xin chúc mừng bạn đã Tìm được ông già noel và được tặng <b>'.$tom.' mũ len</b></div> ';

                $connect->query("UPDATE `users` SET `kem`=`kem`+'$tom', `allkem`=`allkem`+'$tom' WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 9) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 10) {
                        echo'<div class="menu">Bạn không Tìm gì cả. Cố gắng lên nhé!</div> ';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-5 WHERE `id` = '$user_id' LIMIT 1");
}


} 
break; 
default: 


echo '<div class="main"><div class="phdr"><b>tìm noel bằng vina</b> </div>';
echo '<div class="menu"><b>Tài sản ' . $datauser['tienxu'] . ' xu và ' . $datauser['vinaxu'] . ' vinaxu</b></div>';
echo '<div class="menu">';
echo '<div class="menu"><b>Bạn Đang Sở Hữu ' . $datauser['kem'] . ' mũ len<img src="../icon/vao.png"/></b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div></div>';
echo '<form action="ducnghialg.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm</div><div class="menu">mùa đông kinh hoàng<b><font color="0000ff"> tìm ông già noel </font></b><br>Giá 1 Tìm là 5 vinaxu<br/><input type="submit" name="submit" value="Đào Thôi"/></form></form>';

echo'</div>';

echo'</div>';


break; 
} 
echo '<br/>';
/*
echo '<div class="phdr">Sự Kiện Được Viết Bởi ducnghia</div>';
*/
require_once ("../incfiles/end.php"); 
?>