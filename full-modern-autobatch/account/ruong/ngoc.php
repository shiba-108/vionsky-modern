<?php
echo '<div class="main-xmenu"><div class="danhmuc"><b>Vật phẩm</b></div>';
echo'<div class="menu">Bạn '.($user_id == $user[id] ? '':''.nick($user[id]).' ').'có tổng '.$vatpham.' loai ngọc !</div>';
$req = $connect->query("SELECT * FROM `vatpham` WHERE `id_user` = '".$user[id]."' AND `soluong` > '0' ORDER BY `id` DESC LIMIT 4");
while($mondo = $connect->fetch_array($req)) {
echo'<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img src="'.$home.'/images/vatpham/' . $mondo['item'] . '.png" alt="do"/>';
echo'&#160;</td><td>';
echo '<b>'.$mondo['text'].'</b><br/>';
if(!empty($mondo[chisoch2])) {
echo 'Cường hóa '.$mondo['chisoch1'].' ~ '.$mondo['chisoch2'].'<br />';
}
if(!empty($mondo[hp2])) {
echo 'Cường hóa '.$mondo['hp1'].' ~ '.$mondo['hp2'].'HP<br />';
}
echo 'Số lượng: <span style="color:green;">'.$mondo['soluong'].'</span> Viên<br/>';
echo'</td></tr></table>';
echo'</div>';
}
echo'</div>';



?>