<?php
if ($thongtinnhanvat[hp] <= '0') {
$connect->query("UPDATE `users` SET `mat` = '100'  WHERE `id` = '$user_id' LIMIT 1");
} else {
$dangmac = $connect->fetch_array($connect->query("select `matcu` from `users` WHERE `id` = '".$user_id."'")); 
$connect->query("UPDATE `users` SET `mat` = '".$dangmac[matcu]."'  WHERE `id` = '".$user_id."' LIMIT 1");
} 
?>