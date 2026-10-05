<?php
if ($datauser['phongdautruongdangchoi'] > 0) {
$areanonlinehead = $connect->fetch_array($connect->query("SELECT * FROM `arena` WHERE `id`='".$datauser['phongdautruongdangchoi']."'"));
if(($areanonlinehead['time']+120) < time()) {
if($areanonlinehead['luotdi']==1) $di=2; else if($areanonlinehead['luotdi']==2) $di=1;
$connect->query("UPDATE `arena` SET `luotdi`='".$di."',`time`='".time()."' WHERE `id`='".$datauser['phongdautruongdangchoi']."'");
}
if($areanonlinehead['luotdi']==1) {
if($user_id == $areanonlinehead['user_id']) { 
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-bottom: 5px;border: 1px solid #e0e0e0;">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo 'Bạn có <a href="/arena/phong.php?id='.$datauser['phongdautruongdangchoi'].'">[ <b>phòng</b> ]</a> đang chờ lượt !';
echo '</div>';
} else  if($user_id==$areanonlinehead['nguoichoi']) {
}
} else {
if($areanonlinehead['luotdi']==2) {
if($user_id == $areanonlinehead['user_id']) { 
} else if($user_id==$areanonlinehead['nguoichoi']) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-bottom: 5px;border: 1px solid #e0e0e0;">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo 'Bạn có <a href="/arena/phong.php?id='.$datauser['phongdautruongdangchoi'].'">[ <b>phòng</b> ]</a> đang chờ lượt !';
echo '</div>';
}
}
}
}
?>