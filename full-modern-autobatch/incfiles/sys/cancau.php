<?php
if ($datauser[cancau] > '0'){ 
$hamcancau = 1;
$hamcancau2 = 2;
if ($hamcancau < $hamcancau2-$hamcancau3){
$connect->query("UPDATE `users` SET `cancau` = '0'  WHERE `id` = '$user_id' LIMIT 1");
} 
}
?>