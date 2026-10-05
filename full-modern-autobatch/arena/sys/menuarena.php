<?php

if($areanonline['wait']==3) {
if ($areanonline['win'] == '0') {
echo'<div class="menu list-bottom">';
echo 'Thời gian chờ: '.(($areanonline['time']+120)-time()).'s<br/>Lượt Đi Của <span style="color:green;">'.$bdo.'</span><form method="post"><a href="phong.php?id='.$id.'"><input type="button" value="Làm mới" /></a><a href="phong.php?id='.$id.'&xinthua"><input type="button" value="Xin thua" /></a></form></div>';
}
}

?>