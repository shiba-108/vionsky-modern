<?php
$timeoffline = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `lastdate` < '" . (time() - 300) . "' AND `id` = '".$user_id."'"));
$connect->query("UPDATE `users` SET `timeoff` = '".time()."'  WHERE `id` = '".$user_id."' LIMIT 1");
?>