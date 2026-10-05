<?php
$thongtinnhanvat = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='{$user_id}'"));
$time = time();
if ($user_id){
if(empty($thongtinnhanvat[nick])) {
$connect->query("INSERT INTO `nhanvat` SET 
`user_id`='{$user_id}', 
`nick`='1',
`time_hoiphuc`='{$time}',
`hpfull`='1000',
`hp`='1000',
`sucmanh`='500', 
`sucmanhgoc`='500'");
header('Location: '.$home.'');
}
if (($datauser[datareg] + 10 ) > $time) {
$connect->query("UPDATE `nhanvat` SET `hp` = '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
}
if($thongtinnhanvat['hp'] < 0) {
$connect->query("UPDATE `nhanvat` SET `hp` = '0'  WHERE `user_id` = '$user_id' LIMIT 1");
}
if($thongtinnhanvat[hpfull] < 0) {
$connect->query("UPDATE `nhanvat` SET `hpfull` = '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
}

$insertkhumo = ($connect->query("SELECT COUNT(*) FROM `khumo` WHERE `user_id`='{$user_id}'")->fetch_row()[0] ?? 0);
if($insertkhumo == 0) {
$connect->query("INSERT INTO `khumo` SET `suckhoe`='100', `xu`='0', `kimcuong`='0', `vang`='0', `user_id`='{$user_id}'");
header('Location: /');
}
}
?>