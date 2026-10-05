<?php
if ($hienluotboss < $hienluotboss2 -$hienluotboss3){
if (!$datauser['phongbossdangchoi'] == 0) {
$thongbaoluot = $connect->fetch_array($connect->query("SELECT * FROM `boss` WHERE `id`='".$datauser['phongbossdangchoi']."'"));
if($thongbaoluot['wait'] == 3) {
if (!empty($thongbaoluot['nguoichoi'])) {$timenguoichoi1 = 1;}
if (!empty($thongbaoluot['nguoichoi2'])) {$timenguoichoi2 = 1;}
if (!empty($thongbaoluot['nguoichoi3'])) {$timenguoichoi3 = 1;} 
$timenguoichoi = $timenguoichoi1+$timenguoichoi2+$timenguoichoi3+1;
$headhp1 = $connect->fetch_array($connect->query("SELECT `hp` FROM `nhanvat` WHERE `user_id`='".$thongbaoluot['user_id']."'"));
$headhp2 = $connect->fetch_array($connect->query("SELECT `hp` FROM `nhanvat` WHERE `user_id`='".$thongbaoluot['nguoichoi']."'"));
$headhp3 = $connect->fetch_array($connect->query("SELECT `hp` FROM `nhanvat` WHERE `user_id`='".$thongbaoluot['nguoichoi2']."'"));
$headhp4 = $connect->fetch_array($connect->query("SELECT `hp` FROM `nhanvat` WHERE `user_id`='".$thongbaoluot['nguoichoi3']."'"));
$tonghp = $headhp1[hp]+$headhp2[hp]+$headhp3[hp]+$headhp4[hp];
if ($tonghp <= '0') {
$connect->query("UPDATE `boss` SET `win`= '3' WHERE `id`='".$datauser['phongbossdangchoi']."'");
$connect->query("UPDATE `boss` SET `post`= '0' WHERE `id`='".$datauser['phongbossdangchoi']."'");
$connect->query("DELETE FROM `boss_noidung` WHERE `phong`='".$datauser['phongbossdangchoi']."'");
$connect->query("DELETE FROM `boss_danh` WHERE `phong`='".$datauser['phongbossdangchoi']."'");
}

if ($timenguoichoi == 1) {
if($thongbaoluot['luotdi'] == $thongbaoluot['user_id']) {$luotchoi = $thongbaoluot['user_id'];}
$luotchoi = $thongbaoluot['user_id'];
}

if ($timenguoichoi == 2) {
if($thongbaoluot['luotdi'] == $thongbaoluot['user_id']) {
if ($headhp2[hp] <= 0) {
$luotchoi = $thongbaoluot['user_id'];
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
}
if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi']) {
if ($headhp1[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi'];
} else {
$luotchoi = $thongbaoluot['user_id'];
}
}
}
 
if ($timenguoichoi == 3) {
if($thongbaoluot['luotdi'] == $thongbaoluot['user_id']) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
if ($headhp1[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi'];
} else {
$luotchoi = $thongbaoluot['user_id'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
} 
}

if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi']) {
if ($headhp3[hp] <= 0) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi2'];
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
} else {
$luotchoi = $thongbaoluot['user_id'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
} 
}


if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi2']) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
$luotchoi = $thongbaoluot['user_id'];
} else {
$luotchoi = $thongbaoluot['nguoichoi3'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
} else {
$luotchoi = $thongbaoluot['user_id'];
} 
}
}


if ($timenguoichoi == 4) {
if($thongbaoluot['luotdi'] == $thongbaoluot['user_id']) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
if ($headhp4[hp] <= 0) {
if ($headhp1[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi'];
} else {
$luotchoi = $thongbaoluot['user_id'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi3'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
} 
}

if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi']) {
if ($headhp3[hp] <= 0) {
if ($headhp4[hp] <= 0) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi2'];
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
} else {
$luotchoi = $thongbaoluot['user_id'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi3'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
} 
}


if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi2']) {
if ($headhp4[hp] <= 0) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
$luotchoi = $thongbaoluot['nguoichoi3'];
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
} else {
$luotchoi = $thongbaoluot['user_id'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi3'];
} 
}

if($thongbaoluot['luotdi'] == $thongbaoluot['nguoichoi3']) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
if ($headhp4[hp] <= 0) {
$luotchoi = $thongbaoluot['user_id'];
} else {
$luotchoi = $thongbaoluot['nguoichoi3'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi2'];
}
} else {
$luotchoi = $thongbaoluot['nguoichoi'];
}
} else {
$luotchoi = $thongbaoluot['user_id'];
} 
}
}

if(($thongbaoluot['time']+30) < time()) {
$connect->query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$datauser['phongbossdangchoi']."'");
$thongtinboss = $connect->fetch_array($connect->query("SELECT * FROM `boss_chien` WHERE `idboss`='".$thongbaoluot['boss']."'"));
if (!empty($thongbaoluot['nguoichoi'])) {$songuoichoi1 = 1;}
if (!empty($thongbaoluot['nguoichoi2'])) {$songuoichoi2 = 1;}
if (!empty($thongbaoluot['nguoichoi3'])) {$songuoichoi3 = 1;}
$songuoichoi = $songuoichoi1+$songuoichoi2+$songuoichoi3+1;
$bidanh = rand(1,$songuoichoi); 
#### boss
$chisodanhboss = $connect->fetch_array($connect->query("SELECT * FROM `boss_chien` WHERE `idboss`='".$thongbaoluot['boss']."'"));
$chiasucdanhboss = $chisodanhboss[sucmanh]/8;
$chiasucdanhboss2 = $chiasucdanhboss+$chiasucdanhboss/2;
$sucdanhboss = rand($chiasucdanhboss,$chiasucdanhboss2);
if ($bidanh == '1') {
$nguoibidanh = $thongbaoluot['user_id'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['user_id']."'");
}
if ($bidanh == '2') {
if ($headhp2[hp] <= 0) {
$nguoibidanh = $thongbaoluot['user_id'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['user_id']."'");
} else {
$nguoibidanh = $thongbaoluot['nguoichoi'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi']."'");
}
}

if ($bidanh == '3') {
if ($headhp3[hp] <= 0) {
if ($headhp4[hp] <= 0) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
$nguoibidanh = $thongbaoluot['nguoichoi2'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi2']."'");
} else {
$nguoibidanh = $thongbaoluot['nguoichoi'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi']."'");
}
} else {
$nguoibidanh = $thongbaoluot['user_id'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['user_id']."'");
}
} else {
$nguoibidanh = $thongbaoluot['nguoichoi3'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi3']."'");
}
} else {
$nguoibidanh = $thongbaoluot['nguoichoi2'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi2']."'");
}
}

if ($bidanh == '4') {
if ($headhp4[hp] <= 0) {
if ($headhp1[hp] <= 0) {
if ($headhp2[hp] <= 0) {
if ($headhp3[hp] <= 0) {
$nguoibidanh = $thongbaoluot['nguoichoi3'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi3']."'");
} else {
$nguoibidanh = $thongbaoluot['nguoichoi2'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi2']."'");
}
} else {
$nguoibidanh = $thongbaoluot['nguoichoi'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi']."'");
}
} else {
$nguoibidanh = $thongbaoluot['user_id'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['user_id']."'");
}
} else {
$nguoibidanh = $thongbaoluot['nguoichoi3'];
$connect->query("UPDATE `nhanvat` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `user_id`='".$thongbaoluot['nguoichoi3']."'");
}
}
$connect->query("INSERT INTO `boss_danh` SET
`nguoibidanh` = '".$nguoibidanh."',
`phong` = '".$datauser['phongbossdangchoi']."',
`time` = '" . time() . "',
`sodanh` = '" .$sucdanhboss. "',
`type` = '1'
");
}
if($thongbaoluot['wait']==3) {
if ($thongbaoluot['win'] == '0') {
if ($luotchoi == $user_id) {
if ((($thongbaoluot['time']+30)-time()) > 1) {
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/boss/img/boss_new.png" alt="Boss new" style="vertical-align: -3px;"/>&#160;';
echo 'Bạn có <a href="/boss/phong.php?id='.$datauser['phongbossdangchoi'].'">[ <b>phòng boss</b> ]</a> đang chờ lượt còn '.(($thongbaoluot['time']+30)-time()).' giây !';
echo '</div>';
}
}
}
}
}
}
}
?>