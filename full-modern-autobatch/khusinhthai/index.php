<?php

define('_IN_JOHNCMS', 1);
$textl = 'Khu Sinh Thái Vina4u';
$hamcancau3 = 2;
$noionline = 'khusinhthai';
require_once ('../incfiles/core.php');
require_once ('../incfiles/head.php');
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Sinh Thái</div>';
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$prov = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `fish` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if($prov < 1){
    $connect->query("INSERT INTO `fish` SET 
    `name` = '".$login."',
    `user_id` = '".$user_id."',
    `lvl` = '1',
    `time` = '0',
    `vsego` = '0',
    `rand_time` = '0',
    `status` = '0',
    `loc` = '0',
    `kg` = '0',
    `sorv` = '0'
    ");
    
    $connect->query("INSERT INTO `fish_in` SET 
    `user_id` = '".$user_id."',
    `ud` = '0',
    `ud_d` = '0',
    `kr` = '0',
    `kr_d` = '0',
    `ka` = '0',
    `ka_d` = '0',
    `na` = '0',
    `na_d` = '0'
    ");
header('Location: '.$home.'/khusinhthai/');
}

$connect->query("UPDATE `fish` SET `time` = '0', `rand_time` = '0', `status` = '0' WHERE `user_id` = '".$user_id."' LIMIT 1");
$chisocancau = $connect->fetch_array($connect->query("SELECT * FROM `fish_in` WHERE `user_id` = '".$user_id."' LIMIT 1"));
$res = $connect->fetch_array($connect->query("SELECT * FROM `fish` WHERE `user_id` = '".$user_id."' LIMIT 1"));
$xacnhancancau = $connect->fetch_array($connect->query("SELECT * FROM `fish_in` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if ($xacnhancancau['ud'] > '0') {
$connect->query("UPDATE `users` SET `cancau` = '" .$xacnhancancau['ud']. "'  WHERE `id` = '$user_id' LIMIT 1");
}
switch ($act) {
default:
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Sinh Thái</div>';
if(isset($_POST['vaocau'])) {
header('Location: '.$home.'/khusinhthai/?act=cauca');
}
echo '<div class="honuoc"><div class="vaocau"><br/><form method="post"><input type="submit" name="vaocau" value="Câu cá"/></form></div></div>';
echo '<div class="da">';
echo '<div class="menu"><a href="/khusinhthai/shop.php"><img src="/khusinhthai/img/shopcauca.png" alt="shopcauca"/></a> <a href="bangxephang.php"><img src="/khusinhthai/img/bxh.png" alt="bxh" style="vertical-align: 4px;"/></a> <img src="/khusinhthai/img/den.png" alt="den" style="vertical-align: 4px;"/></div>';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khusinhthai'");
while ($res = $connect->fetch_array($req)) {
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';

}
echo'</div>';
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin vật phẩm câu</div>';
if ($chisocancau['ud_d'] > '0') {
echo'<div class="menu list-bottom congdong">';
} else {
echo'<div class="menu congdong">';
}
echo'<img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$datauser[level].'+'.$datauser[chisolevel].'%</span> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
if ($chisocancau['ud'] == '1') {
echo '<div class="menu"><img src="cancau/cancau'.$chisocancau['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu tre (chất lượng '.$chisocancau['ud_d'].'%)</div>';
}
if ($chisocancau['ud'] == '2') {
echo '<div class="menu"><img src="cancau/cancau'.$chisocancau['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu sắt (chất lượng '.$chisocancau['ud_d'].'%)</div>';
}
if ($chisocancau['ud'] == '3') {
echo '<div class="menu"><img src="cancau/cancau'.$chisocancau['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu vip (chất lượng '.$chisocancau['ud_d'].'%)</div>';
}
if ($chisocancau['na'] == '1') {
echo '<div class="menu"><img src="moi/moi'.$chisocancau['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi cơm còn '.$chisocancau['na_d'].' miếng</div>';
}
if ($chisocancau['na'] == '2') {
echo '<div class="menu"><img src="moi/moi'.$chisocancau['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trùng còn '.$chisocancau['na_d'].' miếng</div>';
}
if ($chisocancau['na'] == '3') {
echo '<div class="menu"><img src="moi/moi'.$chisocancau['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trứng kiến còn '.$chisocancau['na_d'].' miếng</div>';
}
echo'</div>';
break;
case 'cauca':
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Sinh Thái</div>';
### chi so ca
if ($chisocancau['na'] == '1') {
$ca = rand(1,17);
}
if ($chisocancau['na'] == '2') {
$ca = rand(1,13);
}
if ($chisocancau['na'] == '3') {
$ca = rand(1,9);
}
$res = $connect->fetch_array($connect->query("SELECT * FROM `fish_in` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if(isset($_POST['giatcau'])) {
echo'<div class="honuoccauca"><div class="ngoicau"><img src="/avatar/'.$datauser['id'].'.png" alt="'.$login.'"/>';
if ($res['na_d'] <= '0' || $res['ud_d'] <= '0') {
} else {
if ($ca == 1) {
echo'<img src="/icon/cacancau.png" alt="icon" style="vertical-align: -6px;"/>';
} else {
echo'<img src="/icon/giangcau.png" alt="icon" style="vertical-align: -6px;"/>';
}
}
echo'<form method="post"><input type="submit" name="giatcau" value="Giật"/></form>';
echo'</div></div>';
echo'</div>';
$batca = array("cá rô","cá mè","cá trê","cá tràu");
$rand = rand(0,5);
$randxu = rand(100,700);
$randchisolevel = rand(1,15);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin và vật phẩm câu</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$datauser[level].'+'.$datauser[chisolevel].'%</span> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
if ($datauser[cahomnay] >= '100') {
echo'<div class="list-bottom" style="color:red;padding : 2px 5px;">Hôm nay bạn đã câu được 100 con rồi hãy chờ ngày mai nhé !</div>';
} else {
if ($res['ud_d'] <= '0') {
echo'<div class="list-bottom" style="color:red;padding : 2px 5px;">Cần câu của bạn đã <b>hỏng</b> hãy <a href="shop.php" style="color:green">[mua]</a> cần câu mới để tiếp tục !</div>';
} else {
if ($res['na_d'] <= '0') {
echo'<div class="list-bottom" style="color:red;padding : 2px 5px;">Bạn đã <b>hết mồi câu</b> hãy <a href="shop.php" style="color:green">[mua]</a> thê để tiếp tục !</div>';
} else {
$timecau = $connect->fetch_array($connect->query("SELECT `timecauca` FROM `users` WHERE `id`='{$user_id}'"));
if(($timecau['timecauca'] + 5) > time()) {
echo '<div class="list-bottom" style="color:red;padding : 2px 5px;">Bạn câu quá nhanh hãy đợi <b>'.(($timecau['timecauca'] + 5) - time()).' giây </b> nữa nhé !</div>';
} else {
if ($ca == 1) {
echo'<div class="list-bottom" style="color:green;padding : 2px 5px;"><img src="/icon/caboi.png" alt="icon" style="vertical-align: -5px;"/> Câu được 1 con <b>'.$batca[$rand].'</b> bạn nhận được <b>'.$randxu.'</b> xu !</div>';
if ($randchisolevel == '1') {
@$connect->query("update `users` set `chisolevel` = `chisolevel`+'1' where `id` = '" . $user_id . "'");
echo'<div class="list-bottom" style="color:green;padding : 2px 5px;">Bạn nhận <b>1%</b> kinh nghiệm !</div>';
## tb kinh 
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '".$user_id."',
`sid` = '".$randchisolevel."',
`time` = '" . time() . "',
`type` = 'y'
");
}
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$user_id."'");
@$connect->query("update `fish_in` set `na_d` = `na_d`-'1' where `user_id` = '" . $user_id . "'");
@$connect->query("update `users` set `timecauca` = '".time()."' where `id` = '" . $user_id . "'");
@$connect->query("update `users` set `cauca` = `cauca`+'1' where `id` = '" . $user_id . "'");
@$connect->query("update `users` set `cahomnay` = `cahomnay`+'1' where `id` = '" . $user_id . "'");
@$connect->query("update `users` set `tienxu` = `tienxu`+'".$randxu."' where `id` = '" . $user_id . "'");
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '".$user_id."',
`sid` = '".$randxu."',
`time` = '" . time() . "',
`type` = 'f'
");
} else {
@$connect->query("update `fish_in` set `na_d` = `na_d`-'1' where `user_id` = '" . $user_id . "'");
@$connect->query("update `users` set `timecauca` = '".time()."' where `id` = '" . $user_id . "'");
echo'<div class="list-bottom" style="color:red;padding : 2px 5px;">Bạn câu <b>trật</b> rồi hãy kiên trì nhé !</div>';
if ($randchisolevel == '1') {
@$connect->query("update `users` set `chisolevel` = `chisolevel`+'1' where `id` = '" . $user_id . "'");
echo'<div class="list-bottom" style="color:green;padding : 2px 5px;">Bạn nhận <b>1%</b> kinh nghiệm !</div>';
## tb kinh 
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '".$user_id."',
`sid` = '".$randchisolevel."',
`time` = '" . time() . "',
`type` = 'y'
");
}
}
}
}
}
}
if ($res['ud'] == '1') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu tre (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '2') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu sắt (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '3') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu vip (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['na'] == '1') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi cơm còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '2') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trùng còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '3') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trứng kiến còn '.$res['na_d'].' miếng</div>';
}
### chi so can cau
if ($chisocancau['ud'] == '1') {
$randcancau = rand(1,4);
$trucancau = ($randcancau == 1 ? '1':NULL);
@$connect->query("update `fish_in` set `ud_d` = `ud_d`-'".$trucancau."' where `user_id` = '" . $user_id . "'");
}
if ($chisocancau['ud'] == '2') {
$randcancau = rand(1,7);
$trucancau = ($randcancau == 1 ? '1':NULL);
@$connect->query("update `fish_in` set `ud_d` = `ud_d`-'".$trucancau."' where `user_id` = '" . $user_id . "'");
}
if ($chisocancau['ud'] == '3') {
$randcancau = rand(1,10);
$trucancau = ($randcancau == 1 ? '1':NULL);
@$connect->query("update `fish_in` set `ud_d` = `ud_d`-'".$trucancau."' where `user_id` = '" . $user_id . "'");
}
} else {
if(isset($_POST['cau'])) {
echo'<div class="honuoccauca"><div class="ngoicau"><img src="/avatar/'.$datauser['id'].'.png" alt="'.$login.'"/><img src="/icon/giangcau.png" alt="icon" style="vertical-align: -6px;"/><form method="post"><input type="submit" name="giatcau" value="Giật"/></form></div></div>';
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin và vật phẩm câu</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$datauser[level].'+'.$datauser[chisolevel].'%</span> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
if ($res['ud'] == '1') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu tre (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '2') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu sắt (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '3') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu vip (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['na'] == '1') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi cơm còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '2') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trùng còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '3') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trứng kiến còn '.$res['na_d'].' miếng</div>';
}
} else {
if(isset($_POST['play'])) {
echo'<div class="honuoccauca"><div class="ngoicau"><img src="/avatar/'.$datauser['id'].'.png" alt="'.$login.'"/>';
if ($datauser[cancau] > '0'){ 
echo'<form method="post"><input type="submit" name="cau" value="Giăng"/></form>';
}
echo'</div></div></div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin và vật phẩm câu</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$datauser[level].'+'.$datauser[chisolevel].'%</span> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
if ($datauser[cancau] == '0'){ 
echo'<div style="color:red;padding : 2px 5px;">Bạn chưa có cần câu hãy <a href="shop.php" style="color:green">[mua]</a> để vào câu nhé !</div>';
}
if ($res['ud'] == '1') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu tre (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '2') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu sắt (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '3') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu vip (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['na'] == '1') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi cơm còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '2') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trùng còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '3') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trứng kiến còn '.$res['na_d'].' miếng</div>';
}
} else {
echo'<div class="honuoccauca"><div class="datcauca"><form method="post"><input type="submit" name="play" value="Bắt đầu"/></form><img src="/avatar/'.$datauser['id'].'.png" alt="'.$login.'" style="vertical-align: 20px;"/></div></div>';
if ($res['ud_d'] > '0') {
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin vật phẩm câu</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$datauser[level].'+'.$datauser[chisolevel].'%</span> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
if ($res['ud'] == '1') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu tre (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '2') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu sắt (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['ud'] == '3') {
echo '<div class="menu"><img src="cancau/cancau'.$res['ud'].'.png" alt="" style="vertical-align: -4px;"/> Cần câu vip (chất lượng '.$res['ud_d'].'%)</div>';
}
if ($res['na'] == '1') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi cơm còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '2') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trùng còn '.$res['na_d'].' miếng</div>';
}
if ($res['na'] == '3') {
echo '<div class="menu"><img src="moi/moi'.$res['na'].'.png" alt="" style="vertical-align: -4px;"/> Mồi trứng kiến còn '.$res['na_d'].' miếng</div>';
}
}
}
} 
}
echo'</div>';
break;
}
require_once ("../incfiles/end.php");

?>