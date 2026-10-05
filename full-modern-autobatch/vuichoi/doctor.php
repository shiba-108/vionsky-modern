<?php
$tab = 'vui';
$text1 = 'Phòng khám';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');







echo '<div class="phdr">Bác sĩ</div>';
If ($user_id){
switch($act){
default:
echo '<div class="menu"><table><tbody><tr><td width="80"><img class="npc" src="/heroes/2.png" width="150" height="200"></td><td>
<div class="newsx">
<div class="menu"><a href="?act=hp">Bị thương</a><br>Phục hồi tất cả máu của bạn. <font color="green">100 VNĐ</font></div>
<div class="menu"><a href="?act=mn">Kiệt sức</a><br>Phục hồi tất cả mana của bạn. <font color="green">100 VNĐ</font></div>
<div class="menu"><a href="?act=all">Cả 2</a><br>Phục hồi tất cả máu/mana của bạn. <font color="green">180 VNĐ</font></div></div>
</td></tr></tbody></table></div>';
break;
case 'hp':
if($datauser['vnd'] <100){
echo '<div class="rmenu"><font color="red"><b>Không đủ tiền!!!</b></font></div>';
}
if($datauser['vnd'] >=100){
$thaotac = $datauser['allhp'];
$connect->query("UPDATE `users` SET `vnd`=`vnd`-'100', `edithp` = '$thaotac' WHERE `id`='".$user_id."'");
echo '<div class="rmenu">Phục hồi máu thành công</div>';
}
break;
case 'mn':
if($datauser['vnd'] <80){
echo '<div class="rmenu"><font color="red"><b>Không đủ tiền!!!</b></font></div>';
}
if($datauser['vnd'] >=80){
$thaotac = $datauser['allmana'];
$connect->query("UPDATE `users` SET `vnd`=`vnd`-'100', `edithp` = '$thaotac' WHERE `id`='".$user_id."'");
echo '<div class="rmenu">Phục hồi mana thành công</div>';
}
break;
case 'all':
if($datauser['vnd'] <100){
echo '<div class="rmenu"><font color="red"><b>Không đủ tiền!!!</b></font></div>';
}
if($datauser['vnd'] >=180){
$thaotac = $datauser['allhp'];
$thaotac2 = $datauser['allmana'];
$connect->query("UPDATE `users` SET `vnd`=`vnd`-'180', `edithp` = '$thaotac', `editmana` = '$thaotac2' WHERE `id`='".$user_id."'");
echo '<div class="rmenu">Phục hồi tất cả thành công</div>';
}
break;
}
}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>