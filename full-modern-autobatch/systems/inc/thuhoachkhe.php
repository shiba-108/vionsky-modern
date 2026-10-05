<?php
if(empty($datauser[timethuhoachkhe])) {
$connect->query("UPDATE `users` SET `timethuhoachkhe` = '".$time."' where `id` = '" . $user_id . "'");
}
?>