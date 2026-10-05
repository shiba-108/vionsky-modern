<?php
if($areanonline['wait'] == 0) {
echo'<div class="menu list-bottom">';
$ban = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline[user_id]."'"));
$phantramban = floor(($ban['hp']*100)/$ban['hpfull']);
$thongtinsucmanh = $ban['sucmanh'];
echo'<img src="'.$home.'/avatar/'.$areanonline[user_id].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[user_id]).'</b> <span style="font-size:12px;color:green;">Chủ Phòng</span><br>
HP '.$ban['hp'].' <span style="font-size:12px;color:green;">('.$phantramban.'%)</span><br/>
SM '.$thongtinsucmanh.'';
echo '</div>';


if (!empty($areanonline['nguoichoi'])) {
echo'<div class="menu list-bottom">';
$nguoichoi = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline[nguoichoi]."'"));
$thongtinsucmanhnguoichoi = $nguoichoi['sucmanh'];
$phantramnguoichoi = floor(($nguoichoi['hp']*100)/$nguoichoi['hpfull']);
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[nguoichoi]).'</b> <span style="font-size:12px;color:green;">Sẵn Sàng</span><br>
HP '.$nguoichoi['hp'].' <span style="font-size:12px;color:green;">('.$phantramnguoichoi.'%)</span><br/>
SM '.$thongtinsucmanhnguoichoi.'';
echo '</div>';
}
}
?>