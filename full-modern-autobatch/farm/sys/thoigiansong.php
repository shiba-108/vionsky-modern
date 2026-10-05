<?php
$songvatnuoi = $connect->query("select `id`, `timesong`, `id_vatnuoi` from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."'");
while ($chiso = $connect->fetch_array($songvatnuoi)) {
$tinhtrangsong = $connect->fetch_array($connect->query("select * from `farm_vatnuoi` WHERE `id` = '".$chiso[id_vatnuoi]."'"));
if (($chiso[timesong] + $tinhtrangsong[timesong]) < $time) {
$connect->query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id` = '".$chiso[id]."'");
$connect->query("DELETE FROM `farm_vatnuoi_choan` WHERE `sid` = '".$chiso[id]."'");
header('Location: '.$home.'/farm/');
}
}
?>