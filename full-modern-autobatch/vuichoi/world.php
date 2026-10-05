<?php

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');
        require('../incfiles/head.php');
$text1 = 'Thế Giới';

echo '<div class="phdr">Khu vực cai quản</div>';
if($user_id){
$world = ($connect->query("SELECT COUNT(*) FROM world WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
if($world ==0){
if(isset($_POST['nhan'])){
$connect->query("INSERT INTO world SET user_id = '{$user_id}', odat = 'Vietnam', cap = '1', danso = '1000', giamua = '3000'");
echo '<div class="bmenu">Quốc gia nhận được Việt Nam! Reload trang hoặc <a href="/vuichoi/world.php">Click đây</a> để thao tác!</div>';
}
echo '<div class="rmenu">Bạn chưa có quốc gia để cai quản và bảo vệ! Bạn được tặng 1 quốc gia! Hãy click nhận!<form method="post"><input type="submit" id="submit" name="nhan" value="Nhận đất miễn phí"></form></div>'; 
} else {
if(isset($_GET['id'])){
$id = $_GET['id'];
$check = ($connect->query("SELECT COUNT(*) FROM world WHERE user_id = $user_id AND id = $id")->fetch_row()[0] ?? 0);
if($check ==0){
echo '<div class="rmenu">Đây không phải quốc gia của bạn</div>';
include '../incfiles/end.php';
exit;
}
$qg = $connect->fetch_array($connect->query("SELECT * FROM world WHERE id = $id"),0);
if($qg['baove'] ==0){
if(isset($_POST['submit'])){
$luong = time() + 10800;
$connect->query("UPDATE world SET baove = 1, time = $luong WHERE id = $id");
echo '<div class="rmenu">Bảo vệ thành công!</div>';
}
} 
if(time() > $qg['time'] AND $qg['baove'] ==1){
if(isset($_POST['submit'])){
$gold = $qg['danso'];
$connect->query("UPDATE users SET balans = balans + $gold WHERE id = $user_id");
$connect->query("UPDATE world SET baove = '0' WHERE id = $id");
echo '<div class="rmenu">Nhận lương thành công</div>';
}
}
if(isset($_GET['ban'])){
if(isset($_POST['ban'])){
$khoa = $_POST['khoa'];
if($khoa != $datauser['macap2']){
echo '<div class="rmenu">Mã cấp 2 sai!</div>';
} else {
$connect->query("DELETE FROM world WHERE id = $id");
$giaban = $qg['giaban'];
$connect->query("UPDATE users SET balans = balans + $giaban WHERE id = $user_id");
echo '<div class="bmenu">Bán thành công!</div>';
}
}
echo '<div class="rmenu"><form method="post">Nhập mã cấp 2 (mặc định: 0):<br><input type="password" name="khoa" value="0"><br><input type="submit" name="ban" id="submit" value="Xác nhận"></form></div>';
}
if(isset($_GET['nangcap'])) {
if (isset($_POST['up'])){
$ds = $qg['danso']*2;
$ds2 = $qg['danso']*3;
$tang = rand($ds,$ds2);
$cap = $qg['cap'];
$tangthanhcong = $_POST['tangthanhcong'];
$newm=$qg['giamua']*3;
if ($qg['cap'] >=5){
echo '<div class="rmenu">Đất nước đã quá phát triển</div>';
}
if ($datauser['balans'] >= $newm && $qg['cap'] < 5) {
if ($tangthanhcong ==0){
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
}
if ($tangthanhcong ==1){
if ($datauser['tangthanhcong'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong` = `tangthanhcong`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if ($tangthanhcong ==2){
if ($datauser['tangthanhcong2'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong2` = `tangthanhcong2`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if ($tangthanhcong ==3){
if ($datauser['tangthanhcong3'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong3` = `tangthanhcong3`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if($cap ==1){
if ($tangthanhcong ==0){
$tc = rand(1,7);
}
if ($tangthanhcong ==1){
$tc = rand(1,5);
}
if ($tangthanhcong ==2){
$tc = rand(1,3);
}
if ($tangthanhcong ==3){
$tc = 3;
}
if($tc ==3){
$connect->query("UPDATE world SET danso = danso + $tang, cap = cap +1 WHERE id = $id");
echo '<div class="bmenu">Nâng cấp thành công. Tăng dân số lên: '.$tang.' người</div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại</div>';
} 
} if($cap ==2){
if ($tangtancong ==0){
$tc = rand(1,7);
}
if ($tangtancong ==1){
$tc = rand(1,5);
}
if ($tangtancong ==2){
$tc = rand(1,3);
}
if ($tangtancong ==3){
$tc = rand(2,3);
}
if($tc ==3){
$connect->query("UPDATE world SET danso = danso + $tang, cap = cap +1 WHERE id = $id");
echo '<div class="bmenu">Nâng cấp thành công. Tăng dân số lên: '.$tang.' người</div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại</div>';
}
} if($cap ==3){
if ($tangtancong ==0){
$tc = rand(1,11);
} 
if ($tangtancong ==1){
$tc = rand(1,8);
}
if ($tangtancong ==2){
$tc = rand(1,5);
}
if ($tangtancong ==3){
$tc = rand(2,4);
}
if($tc ==3){
$connect->query("UPDATE world SET danso = danso + $tang, cap = cap +1 WHERE id = $id");
echo '<div class="bmenu">Nâng cấp thành công. Tăng dân số lên: '.$tang.' người</div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại </div>';
}
} if($cap ==4){
if($tangtancong ==0){
$tc = rand(1,15);
}
if ($tangtancong ==1){
$tc = rand(1,12);
}
if ($tangtancong ==2){
$tc = rand(1,8);
}
if ($tangtancong ==3){
$tc = rand(1,5);
}
if($tc ==3){
$connect->query("UPDATE world SET danso = danso + $tang, cap = cap +1 WHERE id = $id");
echo '<div class="bmenu">Nâng cấp thành công. Tăng dân số lên: '.$tang.' người</div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." nâng cấp thành công ".$qg['odat']." lên +5 trở thành tỷ phú',
            `ip` = '" . core::$ip . "'
       ");
} else {
echo '<div class="rmenu">Nâng cấp thất bại!</div>';
}
}
} else {
if ($qg['cap'] <5){
echo '<div class="rmenu">Không đủ tiền!</div>';
}
}
}
echo '<div class="phdr">Nâng cấp đất nước</div><div class="gmenu"><small><center><table><tbody><tr><td><img class="cap3" src="img/shop/thanhcong.png" alt="Cẩn thận:"> <b>'.$datauser['tangthanhcong'].'</b></td><td><img class="cap4" src="img/shop/thanhcong.png" alt="Khéo léo:"> <b>'.$datauser['tangthanhcong2'].'</b></td><td><img class="cap5" src="img/shop/thanhcong.png" alt="Tinh tế:"> <b>'.$datauser['tangthanhcong3'].'</b></td></tr></tbody></table></center></div>';
echo '<div class="newsx">Sau khi nâng cấp thành công, khi bảo vệ xong bạn vẫn nhận được lương sau khi nâng cấp (nếu bạn đang bảo vệ)! <form method="post"><select name="tangthanhcong"><option value="0">Thường</option><option value="1">Cẩn thận</option><option value="2">Khéo léo</option><option value="3">Tinh tế</option></select>';
echo '<input type="submit" name="up" value="Nâng cấp" id="submit"> [<font color="gold">-'.intval($qg['giamua']*3).' vàng</font>] </form></div>';
}
echo '<div class="bmenu">Thao tác tại quốc gia: <b>'.$qg['odat'].'</b><br>Lương:<font color=gold><b> '.$qg['danso'].'</b> G</font>/3h <a href="?id='.$id.'&ban">[$Bán$]</a><br>';
echo ' Cấp:<b> <font color=red>'.$qg['cap'].'</font></b> - <a href="?id='.$id.'&nangcap">[↑Nâng cấp↑]</a>';
if($qg['baove'] ==0){
echo '<form method="post"><input type="submit" name="submit" id="submit" value="Bảo vệ"></form></div>';
} else {
$ttime2 = $qg['time'] - time();
echo ' <br>Nhận lương sau: <font color=green>'.date('H:i', $ttime2).' (h:m)</font></div>';
}
if(time() > $qg['time'] AND $qg['baove'] ==1){
echo '<form method="post"><input type="submit" id="submit" name="submit" id="submit" value="Nhận lương"></form></div>';
}
}
$dat = $connect->query("SELECT * FROM world WHERE user_id = $user_id");
while ($res = $connect->fetch_array($dat)){
echo '<div class="newsx"><table><tbody><tr><td width="40%"><img src="/world/'.$res['odat'].'.png" alt="'.$res['odat'].'" width="70" height="45" class="'.$res['cap'].'"></td><td><small>Quốc gia: <b>'.$res['odat'].'</b><br>Dân số: <b>'.$res['danso'].' </b><br><a href="?id='.$res['id'].'">[Thao tác]</a></td></tr></tbody></table></div>';

}
}
} else {
echo '<div class="rmenu">Bạn không phải thành viên</div>';
}
require('../incfiles/end.php');
?>