<?php
if (!empty($ban)){ 
$baned = 1;
$baned2 = 2;
if ($baned < $baned2-$baned3){
header('Location: '.$home.'/baned.php');
} 
}
$ditu = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);
if ($ditu == 1){ 
$vaotu = $connect->fetch_array($connect->query("SELECT * FROM `nhatu` WHERE `user_id` = '".$user_id."'"));
$tinhthoigianvaotu = $vaotu[time]+$vaotu[timeband];
if ($tinhthoigianvaotu < $time && $vaotu[vinhvien] == 0) {
$connect->query("DELETE FROM `nhatu` WHERE `user_id`='{$user_id}'");
header('Location: '.$home.'');
}
$baned = 1;
$baned2 = 2;
if ($baned < $baned2-$baned3 || $vaotu[vinhvien] == 1){
header('Location: '.$home.'/nhatu/');
} 
}
?>