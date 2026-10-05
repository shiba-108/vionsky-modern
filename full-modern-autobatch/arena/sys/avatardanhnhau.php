<?php

if($areanonline['wait'] == 3) {
if($areanonline['win'] == $areanonline['user_id']) {
} else {
$ban = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['user_id']."'"));
$capban = $connect->fetch_array($connect->query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$thongtinsucmanh = $ban['sucmanh'];
$phantramban = floor(($ban['hp']*100)/$ban['hpfull']); 
echo'<div class="menu list-bottom">';
echo'<img src="'.$home.'/avatar/'.$areanonline['user_id'].'.png" alt="'.$login.'" class="avatar_vina"/>';
echo'<b>'.nick($areanonline['user_id']).'</b> <span style="font-size:12px;color:green;">('.$capban[level].'+'.$capban[chisolevel].'%)</span><br>';
echo'HP '.$ban['hp'].' <span style="font-size:12px;color:green;">('.$phantramban.'%)</span><br/>';
echo'SM '.$thongtinsucmanh.'';
echo'</div>';
}

if($areanonline['win'] == $areanonline['nguoichoi']) {
} else {
echo'<div class="menu">';
$nguoichoi = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline[nguoichoi]."'"));
$capnguoichoi = $connect->fetch_array($connect->query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$thongtinsucmanhnguoichoi = $nguoichoi['sucmanh'];
$phantramnguoichoi = floor(($nguoichoi['hp']*100)/$nguoichoi['hpfull']);
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[nguoichoi]).'</b> <span style="font-size:12px;color:green;">('.$capnguoichoi[level].'+'.$capnguoichoi[chisolevel].'%)</span><br>
HP '.$nguoichoi['hp'].' <span style="font-size:12px;color:green;">('.$phantramnguoichoi.'%)</span><br/>';
echo'SM '.$thongtinsucmanhnguoichoi.'';
echo '</div>';
}
if($areanonline['win'] == 0) {
} else {
echo'<div class="menu">';
echo'<a href="/arena"><input type="button" value="Tiếp tục" /></a>';
echo '</div>';
}
}

?>