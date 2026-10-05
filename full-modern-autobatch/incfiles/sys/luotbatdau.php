<?php
$tbarena = $connect->query("SELECT * FROM `arena_notice` WHERE `chuphong`= '" . $user_id . "' AND `view`='0' ORDER BY `time` DESC LIMIT 3");
while ($res = $connect->fetch_array($tbarena)) {
if ($res['type'] == 'a'){
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo nick($res[nguoichoi]).' vừa sẵn sàng <a href="/arena/phong.php?id='.$res['phong'].'">[ <b>phòng</b> ]</a> của bạn !';
echo '</div>';
}
}
?>