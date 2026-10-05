<?php
$thongtinnhanvat = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='{$user_id}'"));
if ($thongtinnhanvat[sucmanh] >= 20000) {
if ($thongtinnhanvat[sucmanh] >= 500000) {
$connect->query("UPDATE `users` SET `khac` = '2'  WHERE `id` = '$user_id' LIMIT 1");
} else {
$connect->query("UPDATE `users` SET `khac` = '1'  WHERE `id` = '$user_id' LIMIT 1");
}
} else {
$connect->query("UPDATE `users` SET `khac` = '0'  WHERE `id` = '$user_id' LIMIT 1");
}
$time = time();
if ($user_id){
if(empty($thongtinnhanvat[nick])) {
$connect->query("INSERT INTO `nhanvat` SET 
`user_id`='{$user_id}', 
`nick`='1',
`time_hoiphuc`='{$time}',
`hp`='1000',
`hpfull`='1000',
`sucmanh`='200', 
`sucmanhgoc`='200'");
}

if($thongtinnhanvat['hp'] < 0) {
$connect->query("UPDATE `nhanvat` SET `hp` = '0'  WHERE `user_id` = '$user_id' LIMIT 1");
}
if($thongtinnhanvat[hpfull] == 0) {
$connect->query("UPDATE `nhanvat` SET `hpfull` = '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
}
}
?>