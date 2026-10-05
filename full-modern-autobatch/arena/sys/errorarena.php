<?php

if(isset($_GET['batdau']) && $user_id==$areanonline['user_id'] && $areanonline['wait']!=3) {
$tv = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "' AND `id`='".$areanonline['nguoichoi']."'")->fetch_row()[0] ?? 0);
if(empty($areanonline['nguoichoi'])) {
echo '<div class="menu">Chưa thể bắt đầu vì không có người tham gia!</div>';
echo'<a href="phong.php?id='.$id.'"><input type="button" value="Trở lại phòng"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
} else if($tv==0) {
echo '<div class="menu">Đối thủ hiện tại không trực tuyến không thể bắt đầu!</div>';
echo'<a href="phong.php"><input type="button" value="Trở về"/></a>';
require('../incfiles/end.php');
exit;
} else if($datauser['tienxu']<$areanonline['datcuoc'] || $tuser['tienxu']<$areanonline['datcuoc']) {
echo '<div class="rmenu">Bạn hoặc đối thủ của bạn không đủ Xu!</div>';
require('../incfiles/end.php');
exit;
} else {
$connect->query("UPDATE `arena` SET `wait`='3',`time`='".time()."' WHERE `id`='$id'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-'".$areanonline['datcuoc']."' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-'".$areanonline['datcuoc']."' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '".$id."' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '".$id."' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
header("Location: phong.php?id=$id");
}
}

?>