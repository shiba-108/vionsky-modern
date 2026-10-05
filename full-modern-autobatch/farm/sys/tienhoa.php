<?php
$vatnuoitruyvanth = $connect->query("select * from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."'");
while ($vatnuoitienhoa = $connect->fetch_array($vatnuoitruyvanth)){
$thongtinvatnuoi = $connect->fetch_array($connect->query("select * from `farm_vatnuoi` WHERE `id` = '".$vatnuoitienhoa[id_vatnuoi]."'"));
$thuhoachga = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1'")->fetch_row()[0] ?? 0);
$thuhoachbo = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'")->fetch_row()[0] ?? 0);
$thuhoachcuu = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'")->fetch_row()[0] ?? 0);
if ($vatnuoitienhoa[tienhoa] == 1) {
if (($vatnuoitienhoa['timetienhoa']+$thongtinvatnuoi['timelon']) < $time) {
$connect->query("UPDATE `farm_vatnuoi_cuaban` SET `tienhoa` = '2', `timesanluong` = '".time()."' WHERE `id` = '".$vatnuoitienhoa[id]."'");
if ($vatnuoitienhoa[id_vatnuoi] == 1) {
$autotrung = rand(15,20);
if ($thuhoachga > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autotrung."' WHERE `user_id` = '".$user_id."' AND `type`='1'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='1', `soluong`='".$autotrung."'");
}
}


if ($vatnuoitienhoa[id_vatnuoi] == 3) {
$thuhoach = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'")->fetch_row()[0] ?? 0);
$autosua = rand(150,250);
if ($thuhoachbo > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autosua."' WHERE `user_id` = '".$user_id."' AND `type`='2'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='2', `soluong`='".$autosua."'");
}
}


if ($vatnuoitienhoa[id_vatnuoi] == 4) {
$thuhoach = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'")->fetch_row()[0] ?? 0);
$autolongcuu = rand(100,150);
if ($thuhoachcuu > 0) {
$connect->query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autolongcuu."' WHERE `user_id` = '".$user_id."' AND `type`='3'");
} else {
$connect->query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='3', `soluong`='".$autolongcuu."'");
}
}
}
}
}
?>