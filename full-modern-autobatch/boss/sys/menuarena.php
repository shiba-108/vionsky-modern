<?php

if($areanonline['wait']==3) {
if ($areanonline['win'] == '0') {
echo'<div class="menu list-top">';
echo 'Thời gian chờ "'.(($areanonline['time']+30)-time()).'" giây<br/>Lượt Đi Của <span style="color:green;">'.nick($luotchoi).'</span><br/><a href="/boss/'.$id.'"><input type="button" value="Làm mới" /></a></div>';
}
}
$online1 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$online2 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$online3 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$online4 = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
if ((time() > $online1['lastdate'] + 300)) {
if ($timenguoichoi == 1) {
}
}
?>