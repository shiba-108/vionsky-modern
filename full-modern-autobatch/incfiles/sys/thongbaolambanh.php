<?php
$sqllambanh = $connect->query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `type` = '1' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($thongtinbanh = $connect->fetch_array($sqllambanh)){
$tenvatlieu = $connect->fetch_array($connect->query("SELECT `tenvatlieu` FROM `farm_nhabep` WHERE `id`='".$thongtinbanh['loaibanh']."'"));
echo'<div class="thongbaomini"><img src="/farm/nhabep/icon/'.$thongtinbanh['loaibanh'].'.png" alt="icon" /> '.htmlspecialchars($tenvatlieu['tenvatlieu']).' đã chín rồi vào <a href="/farm/nhabep/?id='.$thongtinbanh['loaibanh'].'">[ <b>đổi điểm</b> ]</a> thôi !</div>';
if (($thongtinbanh[time] + $thongtinbanh[timexong]) < $time) {
$connect->query("UPDATE `farm_nhabep_naubanh` SET `type` = '1', `timexong` = '0', `time` = '0' WHERE `id` = $user_id LIMIT 1");
}
}
$sqltimebanh = $connect->query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `type` = '0' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($timebanh = $connect->fetch_array($sqltimebanh)){
if (($timebanh[time] + $timebanh[timexong]) < $time) {
$connect->query("UPDATE `farm_nhabep_naubanh` SET `type` = '1', `timexong` = '0', `time` = '0' WHERE `user_id` = $user_id LIMIT 1");
}
}
?>