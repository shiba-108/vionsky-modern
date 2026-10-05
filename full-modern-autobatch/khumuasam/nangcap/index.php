<?php

define('_IN_JOHNCMS', 1);
$textl = 'Nâng cấp';
$noionline = 'upgrade';
require_once ('../../incfiles/core.php');
require_once ('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="phdr">Upgrade</div>';
echo'<div class="menu">Bạn phải đăng nhập để nâng cấp!</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
echo'<div class="phdr">Nâng Cấp</div>';
$i = 0;
$tong =($connect->query("SELECT COUNT(*) FROM `nangcap` ")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM nangcap LIMIT $start,$kmess");
if ($tong == '0') {
echo '<div class="menu">Khu nâng cấp trống!</div>';
}
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::pages('/khumuasam/nangcap/index.php?page=', $start, $tong, $kmess) . '</div>';
}
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="60px;" class="blog-avatar">';
echo '<img class="avatarforum" src="/icon/kimhoan.gif"/>';
echo'</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left">';
echo'</div>';
echo '<img src="/images/on.png" alt="online"/> ';
echo'<font color="red"><b>Thợ Kim Hoàn</font>';
while($res = $connect->fetch_array($req)){
$vatpham = $connect->fetch_array($connect->query("SELECT * FROM shop WHERE id = '".$res['vatpham']."'"));
$canvp = $connect->fetch_array($connect->query("SELECT * FROM shop WHERE id = '".$res['canvp']."'"));
echo '<div class="omenu">';
echo '<img style="text-align: center;" src="/images/'.$vatpham['loai'].'/'.$vatpham['id_loai'].'.png " alt="do" class="avatar_vina"><span style="color:green"><b>'.$vatpham['tenvatpham'].'</b></span><br />Bạn Cần: <b>'.$canvp['tenvatpham'].'</b><br/>';
echo '<span style="color:black">Giá: <b>'.$res['gia'].'</b> Xu </span><br/>';
echo '<a href="nangcap.php?id='.$res['id'].'">[Đập Ngay]</a></div>';
++$i;
}
echo'</td></tr></tbody></table></td></tr></tbody></table>';
echo '</div>';
require_once ("../../incfiles/end.php");

?>