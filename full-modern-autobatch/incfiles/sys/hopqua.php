<?php
if(time() > $datauser['time_nhanqua'] + 3600 * 24) {
$connect->query("UPDATE `users` SET `time_nhanqua` = '".time()."' where `id` = '" . $user_id . "'");
$connect->query("UPDATE `users` SET `hopqua` = '0' where `id` = '" . $user_id . "'");
$connect->query("UPDATE `users` SET `cahomnay` = '0' where `id` = '" . $user_id . "'");
$connect->query("UPDATE `daovang` SET `doben`= '100', `coin`='0', `kcuong`='0', `vang`='0' where `id` = '" . $user_id . "'");
}
?>