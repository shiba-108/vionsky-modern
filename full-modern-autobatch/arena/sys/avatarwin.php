<?php

if($areanonline['wait']==3) {
if($areanonline['win'] == $areanonline['user_id']) {
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
$ban = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['user_id']."'"));
$capban = $connect->fetch_array($connect->query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$thongtinsucmanh = $ban['sucmanh'];
$phantramban = floor(($ban['hp']*100)/$ban['hpfull']);
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/' . $areanonline['user_id'] . '.png" alt="'. $areanonline['user_id'] . '" class="avatar_vina" /> <b>'.nick($areanonline['user_id']).'</b> <span style="color:green;">dành chiến thắng!</span><br/>';
echo'HP '.$ban['hp'].' <span style="font-size:12px;color:green;">('.$phantramban.'%)</span><br/>';
echo'SM '.$thongtinsucmanh.'';
echo'</div>';
}
if($areanonline['win'] == $areanonline['nguoichoi']) {
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
$ban = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['nguoichoi']."'"));
$capban = $connect->fetch_array($connect->query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$thongtinsucmanh = $ban['sucmanh'];
$phantramban = floor(($ban['hp']*100)/$ban['hpfull']);
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/' . $areanonline['nguoichoi'] . '.png" alt="'. $areanonline['nguoichoi'] . '" class="avatar_vina" /> <b>'.nick($areanonline['nguoichoi']).'</b> <span style="color:green;">dành chiến thắng!</span></br>'; 
echo'HP '.$ban['hp'].' <span style="font-size:12px;color:green;">('.$phantramban.'%)</span><br/>';
echo'SM '.$thongtinsucmanh.'';
echo'</div>';
}
}

?>