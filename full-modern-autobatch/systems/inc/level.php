<?php
if($datauser['chisolevel'] > 99) {
$connect->query("UPDATE `users` SET `level` = `level`+'1'  WHERE `id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `users` SET `chisolevel` = '0'  WHERE `id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hp` = `hp` + '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hpfull` = `hpfull` + '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh` + '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc` + '1000'  WHERE `user_id` = '$user_id' LIMIT 1");
}
?>