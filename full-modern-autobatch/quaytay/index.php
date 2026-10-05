<?php
$tab = 'vui';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');








echo '<div class="danhmuc">Khu Nguời Lớn!</div>';
If ($user_id){
switch($act){
default:
echo '<div class="menu">Hãy chắc chắn rằng bạn đủ "sức" để vào =)). Lưu ý: 1000 xu/lần vào<a href="?act=vao"><img src="/systems/vao.gif" width="20", height="20"></a></div>';
break;
case 'vao':
if($datauser['tienxu'] <1000){
echo '<div class="rmenu"><font color="red"><b>Không đủ xu!!!</b></font></div>';
}
if($datauser['tienxu'] >=1000){
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-'1000', quaytay=quaytay+1 WHERE `id`='".$user_id."'");
$rand = rand(1,5);
echo '<div class="menu"><div class="newsx"><marquee><font color=red>Bạn đang nghịch gái lần thứ <b>'.$datauser['quaytay'].'</b>! =))</font></marquee></div>
<center><img src="/quaytay/Rand'.$rand.'.jpg" width= 250; height= 250;><br/><a href="/vuichoi/index.php?act=vao"><button>Quay tiếp</button></a><br>(1000 xu/lần)</center></div>';
}
break;
}
echo '<div class="danhmuc">Top 15 Sinh Lý</div>';
$req = $connect->query("SELECT * FROM users WHERE quaytay > 0 ORDER BY quaytay DESC LIMIT 15");
$i = 1;
while ($res = $connect->fetch_array($req)){
$money = $res['quaytay']*1000;
echo '<div class="list1"><b>'.$i.'</b>: '.nick($res['id']).' - <b>'.$res['quaytay'].'</b> lần quay - Tiêu hết: <font color="gold"><b>'.$money.'</b> xu</font></div>';
++$i;
}
}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>