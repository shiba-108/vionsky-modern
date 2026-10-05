<?php
$thongtinonline1 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$thongtinonline2 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$thongtinonline3 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$thongtinonline4 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));

if (empty($areanonline['user_id']) && empty($areanonline['nguoichoi']) && empty($areanonline['nguoichoi2']) && empty($areanonline['nguoichoi3'])) {
$connect->query("DELETE FROM `boss` WHERE `id`='".$id."'");
$connect->query("DELETE FROM `bosscmt` WHERE `sid`='".$id."'");
$connect->query("DELETE FROM `boss_chien_arena` WHERE `phong`='".$id."'");
$connect->query("DELETE FROM `boss_danh` WHERE `phong`='".$id."'");
$connect->query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
$connect->query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
}
if (time() > $thongtinonline1['lastdate'] + 120) {
$connect->query("UPDATE `boss` SET `user_id`='0' WHERE `id`='$id'");
}
if (time() > $thongtinonline2['lastdate'] + 120) {
$connect->query("UPDATE `boss` SET `nguoichoi`='0' WHERE `id`='$id'");
}
if (time() > $thongtinonline3['lastdate'] + 120) {
$connect->query("UPDATE `boss` SET `nguoichoi2`='0' WHERE `id`='$id'");
}
if (time() > $thongtinonline4['lastdate'] + 120) {
$connect->query("UPDATE `boss` SET `nguoichoi3`='0' WHERE `id`='$id'");
}
if (empty($areanonline['user_id'])) {
$connect->query("UPDATE `boss` SET `user_id`= '".$areanonline['nguoichoi']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi`= '".$areanonline['nguoichoi2']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi2`= '".$areanonline['nguoichoi3']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
header("Location: /boss/$id");
}
if (empty($areanonline['nguoichoi'])) {
$connect->query("UPDATE `boss` SET `nguoichoi`= '".$areanonline['nguoichoi2']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi2`= '".$areanonline['nguoichoi3']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
}
if (empty($areanonline['nguoichoi2'])) {
$connect->query("UPDATE `boss` SET `nguoichoi2`= '".$areanonline['nguoichoi3']."' WHERE `id`='".$id."'");
$connect->query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
}

?>