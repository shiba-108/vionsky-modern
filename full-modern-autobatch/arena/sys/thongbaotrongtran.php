<?php

if($areanonline['wait'] == 3) {
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Trong trận</div>';
$ndarena = $connect->query("SELECT * FROM `arena_noidung` WHERE `phong` = '".$id."' ORDER BY `time` DESC LIMIT 10");
while ($res = $connect->fetch_array($ndarena)) {
echo'<div class="menu list-bottom">';
if ($res['type'] == '1'){
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo nick($res[nguoidanh1]).' vừa '.$res[cachdanh].' '.nick($res[nguoidanh2]).' làm bạn ấy mất '.$res[sodanh].' HP';
}
if ($res['type'] == '2'){
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo '<b>'.nick($res[nguoidanh1]).' đã xin thua '.nick($res[nguoidanh2]).'</b>';
}
if ($res['type'] == '3'){
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo '<b>'.nick($res[nguoidanh1]).' đã đánh chết '.nick($res[nguoidanh2]).'</b>';
}
echo '</div>';
}
}

?>