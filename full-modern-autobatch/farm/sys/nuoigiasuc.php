<?php
$trungga = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1' AND `soluong` > '0'")->fetch_row()[0] ?? 0);
$suabo = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2' AND `soluong` > '0'")->fetch_row()[0] ?? 0);
$longcuu = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3' AND `soluong` > '0'")->fetch_row()[0] ?? 0);
echo'<div class="conduong"></div>';
echo'<div class="cola">';
echo'<div class="chuong">';
$vatnuoitruyvan = $connect->query("select * from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."'");
while ($vatnuoi = $connect->fetch_array($vatnuoitruyvan)){
if ($vatnuoi[id_vatnuoi] == '1') {
$chodichuyen1 = rand(-18,-30);
$chodichuyen2 = rand(5,500);
echo'<a href="/farm/thongtinvatnuoi.php?id='.$vatnuoi[id].'"><img src="/farm/vatnuoi/'.$vatnuoi[tienhoa].'/'.$vatnuoi[id_vatnuoi].'.gif" style="position: absolute;vertical-align: 0px;margin:'.$chodichuyen1.'px 0 0 '.$chodichuyen2.'px;"></a>';
}
if ($vatnuoi[id_vatnuoi] == '2') {
$chodichuyen1 = rand(15,70);
$chodichuyen2 = rand(15,74);
echo'<a href="/farm/thongtinvatnuoi.php?id='.$vatnuoi[id].'"><img src="/farm/vatnuoi/'.$vatnuoi[tienhoa].'/'.$vatnuoi[id_vatnuoi].'.gif" style="position: absolute;vertical-align: 0px;margin:'.$chodichuyen1.'px 0 0 '.$chodichuyen2.'px;"></a>';
}
if ($vatnuoi[id_vatnuoi] == '3') {
$chodichuyen1 = rand(15,70);
$chodichuyen2 = rand(15,74);
echo'<a href="/farm/thongtinvatnuoi.php?id='.$vatnuoi[id].'"><img src="/farm/vatnuoi/'.$vatnuoi[tienhoa].'/'.$vatnuoi[id_vatnuoi].'.gif" style="position: absolute;vertical-align: 0px;margin:'.$chodichuyen1.'px 0 0 '.$chodichuyen2.'px;"></a>';
}
if ($vatnuoi[id_vatnuoi] == '4') {
$chodichuyen1 = rand(15,67);
$chodichuyen2 = rand(15,74);
echo'<a href="/farm/thongtinvatnuoi.php?id='.$vatnuoi[id].'"><img src="/farm/vatnuoi/'.$vatnuoi[tienhoa].'/'.$vatnuoi[id_vatnuoi].'.gif" style="position: absolute;vertical-align: 0px;margin:'.$chodichuyen1.'px 0 0 '.$chodichuyen2.'px;"></a>';
}
if ($vatnuoi[id_vatnuoi] == '5') {
$chodichuyen1 = rand(35,60);
$chodichuyen2 = rand(350,400);
echo'<a href="/farm/thongtinvatnuoi.php?id='.$vatnuoi[id].'"><img src="/farm/vatnuoi/'.$vatnuoi[tienhoa].'/'.$vatnuoi[id_vatnuoi].'.gif" style="position: absolute;vertical-align: 0px;margin:'.$chodichuyen1.'px 0 0 '.$chodichuyen2.'px;"></a>';
}
}
$demga = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '1'")->fetch_row()[0] ?? 0);
$demheo = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '2'")->fetch_row()[0] ?? 0);
$dembo = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '3'")->fetch_row()[0] ?? 0);
$demcuu = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '4'")->fetch_row()[0] ?? 0);
$demca = ($connect->query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '5'")->fetch_row()[0] ?? 0);
$tinhtranga = $connect->fetch_array($connect->query("select `tinhtrang` from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '1'"));
$tinhtranheo = $connect->fetch_array($connect->query("select `tinhtrang` from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '2'"));
$tinhtranbo = $connect->fetch_array($connect->query("select `tinhtrang` from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '3'"));
$tinhtrancuu = $connect->fetch_array($connect->query("select `tinhtrang` from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '4'"));
$tinhtranca = $connect->fetch_array($connect->query("select `tinhtrang` from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '5'"));
if ($demga > 0) { 
if ($trungga > 0) { 
echo'<a href="/farm/?thuhoachtrung"><img src="/farm/vatnuoi/trungga.png" style="position: absolute;vertical-align: 0px;margin:2px 0 0 160px"></a>';
} else { 
echo'<img src="/farm/vatnuoi/oga.png" style="position: absolute;vertical-align: 0px;margin:2px 0 0 160px">';
}
}
if ($demheo > 0) {
if ($tinhtranheo[tinhtrang] == 1) {
echo'<img src="/farm/vatnuoi/mang.png" style="position: absolute;vertical-align: 0px;margin:15px 0 0 108px">';
} else { 
echo'<img src="/farm/vatnuoi/mangan.png" style="position: absolute;vertical-align: 0px;margin:15px 0 0 108px">';
}
}
if ($dembo > 0) {
if ($suabo > 0) { 
echo'<a href="/farm/?thuhoachsua"><img src="/farm/vatnuoi/suabo.png" style="position: absolute;vertical-align: 0px;margin:80px 0 0 125px"></a>';
} else { 
echo'<img src="/farm/vatnuoi/xodung.png" style="position: absolute;vertical-align: 0px;margin:80px 0 0 125px">';
}
}
if ($demcuu > 0) {
if ($longcuu > 0) { 
echo'<a href="/farm/?thuhoachlongcuu"><img src="/farm/vatnuoi/longcuu.png" style="position: absolute;vertical-align: 0px;margin:80px 0 0 100px"></a>';
} else { 
echo'<img src="/farm/vatnuoi/mangcuu.png" style="position: absolute;vertical-align: 0px;margin:80px 0 0 100px">';
}
}

$muacho = $connect->fetch_array($connect->query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$user_id}'"));
echo'<img src="'.$home.'/avatar/nen/'.$user_id.'.png" alt="'. $login. '" style="position: absolute;vertical-align: 0px;margin:30px 0 0 180px">
<a href="/farm/bangxephang/"><img src="icon/bxh.png" alt="bxh" style="position: absolute;vertical-align: 0px;margin:30px 0 0 240px"></a>';
if(!empty($muacho[id_user])) {
$dichuyen1 = rand(-10,-240);
$dichuyen2 = rand(30,500);
echo'&#160;<img src="icon/thunuoi/cho.png" alt="icon" style="position: absolute;vertical-align: 0px;margin:'.$dichuyen1.'px 0 0 '.$dichuyen2.'px">';
}

echo'</div>';
echo'<div class="hoca">';
echo'</div>';
echo'<div class="clear"></div>';
echo'</div>';
?>