<?php
if ($areanonline['win'] == '0') {
$danh = array("cùi trỏ","tát vào má","cùi vào trym","xiết cổ","nắm tóc","bấu má");
$phan = array("tát","đấm vào mặt","phang trả","chống cự","nắm tóc","đấm vào bụng");
$rand = rand(0,5);
if(isset($_POST['danh'])) {
if($areanonline['luotdi']==1) $di=2; else if($areanonline['luotdi']==2) $di=1;
$connect->query("UPDATE `arena` SET `luotdi`='".$di."',`time`='".time()."' WHERE `id`='".$id."'");
echo'<div class="menu list-top">';
$chuphong = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['user_id']."'"));
$thongtinsucmanh = $chuphong['sucmanh'];
$doithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['nguoichoi']."'"));
$thongtinsucmanhdoithu = $doithu['sucmanh'];

$chisodanh = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['user_id']."'"));
$chiasucdanh = $chisodanh[sucmanh]/8;
$chiasucdanh2 = $chiasucdanh+$chiasucdanh/2;
$sucdanh = rand($chiasucdanh,$chiasucdanh2);
### doi thu
$chisodanhdoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$areanonline['nguoichoi']."'"));
$chiasucdanhdoithu = $chisodanhdoithu[sucmanh]/8;
$chiasucdanhdoithu2 = $chiasucdanhdoithu+$chiasucdanhdoithu/2;
$sucdanhdoithu = rand($chiasucdanhdoithu,$chiasucdanhdoithu2);

$tyleexp = $datauser[level]+5;
$exp = rand(1,$tyleexp);
if ($exp == 1) {
echo '<div class="menu list-bottom hot" style="color:green;">Bạn nhận '.$exp.'%  kinh nghiệm !</div>';
        $connect->query("UPDATE `users` SET
            `chisolevel`='" . ($datauser['chisolevel'] + 1) . "'
            WHERE `id` = '".$user_id."'");
}
if ($user_id == $areanonline['nguoichoi']) {
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.nick($areanonline['user_id']).'  mất '.$sucdanhdoithu.' hp.</div>';
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'{$sucdanhdoithu}' WHERE `user_id`='{$areanonline['user_id']}'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`nguoidanh2` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanhdoithu. "',
`type` = '1'
");
if ($chisodanh[hp] < 30) {
$connect->query("UPDATE `nhanvat` SET `hp`='0' WHERE `user_id`='{$areanonline['user_id']}'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
$connect->query("UPDATE `arena` SET `win`='".$areanonline[nguoichoi]."' WHERE `id`='$id'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`nguoidanh2` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`type` = '3'
");
}
}
if ($user_id == $areanonline['user_id']) {
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.nick($areanonline['nguoichoi']).'  mất '.$sucdanh.' hp.</div>';
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'{$sucdanh}' WHERE `user_id`='{$areanonline['nguoichoi']}'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`nguoidanh2` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanh. "',
`type` = '1'
");
if ($chisodanhdoithu[hp] < 30) {
$connect->query("UPDATE `nhanvat` SET `hp`='0' WHERE `user_id`='{$areanonline['nguoichoi']}'");
$connect->query("UPDATE `arena` SET `win`='".$areanonline[user_id]."' WHERE `id`='$id'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`nguoidanh2` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`type` = '3'
");
} 
}
echo'</div>';

}
if ($areanonline['win'] == '0') {
if ($user_id == $areanonline[user_id]) {
if($luotdi==1) {
echo''.(isset($_POST['danh']) ? '':'<div class="menu list-top"><form method="post"><input type="submit" name="danh" value="Đánh" /></form></div>').'';
} 
}
}
if ($user_id == $areanonline[nguoichoi]) {
if ($luotdi==2) {
echo''.(isset($_POST['danh']) ? '':'<div class="menu list-top"><form method="post"><input type="submit" name="danh" value="Đánh" /></form></div>').'';
}
}
}
?>