<?php
$sanluongthuhoach = $connect->query("select * from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi`!= '2'  AND `id_vatnuoi`!= '5'");
while ($thuhoachsanluong = $connect->fetch_array($sanluongthuhoach)){
if ($thuhoachsanluong[tienhoa] == 2) {
if (($thuhoachsanluong[timesanluong] + 21600) < $time) {
if ($thuhoachsanluong[id_vatnuoi] == 1) {
$connect->query("UPDATE `farm_vatnuoi_cuaban` SET `timesanluong` = '".time()."' WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '1'");
$autotrung = rand(15,20);
if ($thuhoachga > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autotrung."' WHERE `user_id` = '".$user_id."' AND `type`='1'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='1', `soluong`='".$autotrung."'");
}
}
if ($thuhoachsanluong[id_vatnuoi] == 3) {
$connect->query("UPDATE `farm_vatnuoi_cuaban` SET `timesanluong` = '".time()."' WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '3'");
$autosua = rand(150,250);
if ($thuhoachbo > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autosua."' WHERE `user_id` = '".$user_id."' AND `type`='2'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='2', `soluong`='".$autosua."'");
}
}
if ($thuhoachsanluong[id_vatnuoi] == 4) {
$connect->query("UPDATE `farm_vatnuoi_cuaban` SET `timesanluong` = '".time()."' WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '4'");
$autolongcuu = rand(100,150);
if ($thuhoachcuu > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autotrung."' WHERE `user_id` = '".$user_id."' AND `type`='3'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='3', `soluong`='".$autolongcuu."'");
}
}
}
}
}
?>