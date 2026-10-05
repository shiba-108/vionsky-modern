<?php
$areanonlinehead = $connect->fetch_array($connect->query("SELECT * FROM `arena` WHERE `id`='".$datauser['phongdautruongdangchoi']."'"));
if($areanonlinehead['win']==0) {
if($areanonlinehead['wait']==3) {
if(($areanonlinehead['time']+120) < time()) {
if($areanonlinehead['luotdi']==1) {
$di=2; 
} else if($areanonlinehead['luotdi']==2) {
$di=1;
$connect->query("UPDATE `arena` SET `luotdi`='".$di."',`time`='".time()."' WHERE `id`='".$datauser['phongdautruongdangchoi']."'");
$connect->query("UPDATE `arena` SET `soluot`= `soluot`+'1' WHERE `id`='".$datauser['phongdautruongdangchoi']."'");
}
}
if ($hienluot < $hienluot2 -$hienluot3){
if ($datauser['phongdautruongdangchoi'] > 0) {
if($areanonlinehead['luotdi']==1) {
if($user_id == $areanonlinehead['user_id']) { 
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo 'Bạn có <a href="/arena/phong.php?id='.$datauser['phongdautruongdangchoi'].'">[ <b>phòng</b> ]</a> đang chờ lượt !';
echo '</div>';
} 

} else {
if($areanonlinehead['luotdi']==2) {
if($user_id==$areanonlinehead['nguoichoi']) {
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo 'Bạn có <a href="/arena/phong.php?id='.$datauser['phongdautruongdangchoi'].'">[ <b>phòng</b> ]</a> đang chờ lượt !';
echo '</div>';
}
}
}
}
}
}
}
?>