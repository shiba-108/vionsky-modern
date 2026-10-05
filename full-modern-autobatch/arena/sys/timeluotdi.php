<?php

if($areanonline['wait']==3) {
//update time luot di
if(($areanonline['time']+120) < time()) {
if($areanonline['luotdi']==1) $di=2; else if($areanonline['luotdi']==2) $di=1;
$connect->query("UPDATE `arena` SET `luotdi`='".$di."',`time`='".time()."' WHERE `id`='".$id."'");
header("Location: phong.php?id=$id");
}
//thoi gian cho
if($areanonline['luotdi']==1) {$luot=2;$luotdi=1;}
if($areanonline['luotdi']==2) {$luot=1;$luotdi=2;}
if($areanonline['luotdi']==1) {
if($user_id==$areanonline['user_id']) { 
$luotdanh=1; $bdo='Bạn';
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$areanonline['id']."' LIMIT 1;");
} else  if($user_id==$areanonline['nguoichoi']) {
$bdo='Đối Thủ';
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$areanonline['id']."' LIMIT 1;");
}
} else {
if($areanonline['luotdi']==2) {
if($user_id==$areanonline['user_id']) { 
$luotdanh=2; $bdo='Đối Thủ';
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$areanonline['id']."' LIMIT 1;");
} else if($user_id==$areanonline['nguoichoi']) {
$bdo='Bạn';
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$areanonline['id']."' LIMIT 1;");
}
}
}
}

?>