<?php
function capbac($id, $mod = false) {
$user = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));

if($user['level'] == 0) {
$chucdanh = '<img src="/item/level/gacon.gif" title="Gà con" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 1) {
$chucdanh = '<img src="/item/level/gacon.gif" title="Gà con" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 2) {
$chucdanh = '<img src="/item/level/buago.gif" title="Búa gỗ" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 3) {
$chucdanh = '<img src="/item/level/buagodoi.gif" title="Búa gỗ đôi"  alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 4) {
$chucdanh = '<img src="/item/level/buada.gif" title="Búa đá" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 5) {
$chucdanh = '<img src="/item/level/buadadoi.gif" title="Búa đá đôi" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 6) {
$chucdanh = '<img src="/item/level/riusat.gif" title="rìu sắt" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 7) {
$chucdanh = '<img src="/item/level/riusatdoi.gif"  title="rìu sắt đôi"  alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 8) {
$chucdanh = '<img src="/item/level/riubac.gif"  title="rìu bạc" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 9) {
$chucdanh = '<img src="/item/level/riubacdoi.gif"  title="rìu bạc đôi" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 10) {
$chucdanh = '<img src="/item/level/riuvang.gif" width="20"  title="rìu vàng" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 11) {
$chucdanh = '<img src="/item/level/riuvangdoi.gif" title="rìu vàng dôi" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 12) {
$chucdanh = '<img src="/item/level/chiensat.gif" title="rìu chiến sắt" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 13) {
$chucdanh = '<img src="/item/level/chiensatcham.gif" title="rìu chiến sắt chấm" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 14) {
$chucdanh = '<img src="/item/level/chienbac.gif" title="rìu chiến bạc" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 15) {
$chucdanh = '<img src="/item/level/chienbaccham.gif" title="rìu chiến bạc chấm" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 16) {
$chucdanh = '<img src="/item/level/chienvang.gif" title="rìu chiến Vàng" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 17) {
$chucdanh = '<img src="/item/level/chienvangcham.gif" title="rìu chiến Vàng chấm" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 18) {
$chucdanh = '<img src="/item/level/rongxanh.gif" title="Rồng xanh" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 19) {
$chucdanh = '<img src="/item/level/rongbac.gif" title="Rồng Bạc" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 20) {
$chucdanh = '<img src="/item/level/rongdo.gif" title="Rồng Đỏ" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 21) {
$chucdanh = '<img src="/item/level/wand1.gif" title="Đúa phép" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 22) {
$chucdanh = '<img src="/item/level/wand2.gif" title="Đúa phép" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 23) {
$chucdanh = '<img src="/item/level/wand3.gif" title="Đúa phép" alt="Level" style="vertical-align: -3px"/>';
}
if($user['level'] == 24) {
$chucdanh = '<img src="/item/level/wand4.gif" title="Đúa phép" alt="Level" style="vertical-align: -3px"/>';
}
return $chucdanh;
}
?>