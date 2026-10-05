<?php
$tab = 'vui';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

require('../incfiles/head.php');
$text1 = 'Ocean Game';
Require_once('lv.php');
echo '<div class="phdr">OCEAN Game</div>';
Echo '<div class="rmenu"><a href="/nhanqua2/nhanqua.php"><center><b style="color:red">Nhận Quà Hero</b></center></a></div>';
If ($datauser['rights'] ==9){
Echo '<div class="rmenu"><a href="hethong.php">OCEAN PANEL</a> | <a href="/qly">PHPMYADMIN LITE</a></div>';
}
If ($user_id){
$ime = $datauser['timex2truyna'] - time();

if ($datauser['x2truyna'] >=1 Or $ime >0){
if(isset($_POST['use'])){
$gettime = time() + 259200;
if ($datauser['usex2truyna'] ==1){
echo '<div class="rmenu">Thẻ đã sử dụng rồi! Không sử dụng nữa</div>';
} else {
if ($datauser['x2truyna'] >=1){
$connect->query("UPDATE users SET usex2truyna = '1', x2truyna = x2truyna - 1, timex2truyna = '$gettime' WHERE id = $user_id");
echo '<div class="bmenu">Sử dụng thẻ thành công</div>';
} else {
echo '<div class="rmenu">Không đủ thẻ X2 truy nã</div>';
}
}
}
if ($datauser['usex2truyna'] ==1){
if (time() > $datauser['timex2truyna']){
$connect->query("UPDATE users SET timex2truyna = '', usex2truyna = '0' WHERE id = $user_id LIMIT 1");
echo '<div class="rmenu">Thẻ của bạn đã hết hạn sử dụng</div>';
}
}
echo '<div class="gmenu"><table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/x2truyna.png" class="cap5"></td><td>Có <b>'.$datauser['x2truyna'].'</b> thẻ x2 β<br>';
if ($datauser['usex2truyna'] ==0){
echo ' <form method="post"><input type="submit" name="use" value="Sử dụng"> (HSD: 3 ngày)</form>';
} else {
$time = $datauser['timex2truyna'] - time();
echo ' <font color="green">Sau <b>'.date('d', $time).'</b> ngày nữa thì card hết hạn</font><br>';
}
$count_vote3 = $datauser['editenergy'] ? round(($datauser['editenergy'] / $datauser['allenergy']) * 100) : 0;
echo '</td></tr></tbody></table><center><img src="/vuichoi/theluc.php?img='.$count_vote3.'" alt="'.$count_vote3.' Energy"></center></div>';
}
if ($datauser['x2truyna'] ==0 and $ime <0){
$count_vote3 = $datauser['editenergy'] ? round(($datauser['editenergy'] / $datauser['allenergy']) * 100) : 0;
echo '<div class="menu"><center><img src="/vuichoi/theluc.php?img='.$count_vote3.'" alt="'.$count_vote3.' Energy"></center></div>';
}
echo '<div class="menu"><center><table><tbody><tr><td width=75><a href="/vuichoi/ruong.php"><img class="'.$class.'" src="/heroes/'.$datauser['set'].'.png" width=100; height=150;></a><small><center>'.nick($datauser['id']).'</center></small></b></td><td><small><p>
<b><font color="brown">'.$datauser['nameset'].'</font> (<font color="red">+'.$datauser['capset'].'</font>)</p>';
If ($datauser['truyna'] < 1800000000){
Echo '<p>'.$lvg.' (<font color="green">'.$tinhtoan.'%</font>)</p>';
} else {
Echo '<p><font color="red">'.$lvg.'</font></p>';
}
echo '<p><br><b class="wanted"><font color="cc00cc">Truy Nã: '.$datauser['truyna'].' β</font></b></p>';
echo '<br><font color=red><b>'.$datauser['edithp'].'/'.$datauser['allhp'].'</b> HP</font><br>';
echo '<font color=blue><b>'.$datauser['editmana'].'/'.$datauser['allmana'].'</b> MP</font><br>';

echo ' <font color="green">'.$datauser['cong'].' SM</font></b></small>';
echo '</td></tr></tbody></table></center></div>';
echo '<div class="phdr">Thông tin bản thân</div>';
echo '<img src="/images/kcx.png" alt="kc"> '.$datauser['kc'].' Kim cương<br>';
echo '<img src="/images/dollar.png" alt="G"> '.$datauser['balans'].' Vàng<br>';
echo '<img src="/icon/xu.png" alt="vnd"> '.$datauser['vnd'].' VNĐ';
echo '<div class="phdr">Cửa hàng</div><div class="menu"> <a href="/vuichoi/shophero.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/shopdown.png" class="cap2"></td><td>Shop hero</a></td></tr></tbody></table></div>
<div class="menu"><a href="/vuichoi/daugia.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/daugia.png" class="cap3"></td><td>Đấu giá</a></td></tr></tbody></table></div>
<div class="menu"> <a href="/vuichoi/shoptrangphuc.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/shopdown.png" class="cap5"></td><td>Shop trang phục</a></td></tr></tbody></table></div> <div class="menu"> <a href="/vuichoi/shopworld.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/shopdown.png" class="npc"></td><td>Shop Thế Giới</a></td></tr></tbody></table></div> <div class="menu"> <a href="/vuichoi/shop.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/shopdown.png" class="cap4"></td><td>Shop vật phẩm</a></td></tr></tbody></table></div></div></a>'; echo '<div class="phdr">Chiến đấu</div>
<div class="menu"><a href="/vuichoi/garena.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/arena.gif" class="npc" width="16" height="16"></td><td>Đấu trường 1V1</td></tr></tbody></table></a></div><div class="menu"><a href="/vuichoi/solo.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/fake.png" class="npc" width="16" height="16"></td><td>Tỉ thý [SOLO 1V1]</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/rank.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/arena.png" class="npc" width="16" height="16"></td><td>Đấu Rank</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/boss.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/strlen.png" class="npc" width="16" height="16"></td><td>Đấu boss 3V1 lính</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/doctor.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/thanhcong.png" class="npc"></td><td>Trị thương</td></tr></tbody></table></div></font></div></a>'; echo '<div class="phdr">Tài sản</div>
<div class="menu"><a href="/vuichoi/trungvuabien.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/baohiem.gif" class="cap5"></td><td>Đập trứng vua biển</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/khobau.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/khobau.png" class="cap3"></td><td>Đảo kho báu</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/code.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/matma.png" class="cap4"></td><td>Mật mã đại dương</a></td></tr></tbody></table></div></a>
<div class="menu"><a href="/vuichoi/napthe"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/naptien2.png" width="16" height="16" class="cap5"></td><td> Nạp  tiền</a></td></tr></tbody></table></div>
<div class="menu"><a href="/vuichoi/napthe"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/otp.png" width="16" height="16" class="cap5"></td><td> Nạp Qua Tài Khoản Điện Thoại</a></td></tr></tbody></table></div>
<div class="menu"><a href="/vuichoi/bank.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/chuyenxu.png" class="cap2"></td><td>Ngân hàng</td></tr></tbody></table></a></div>
<div class="phdr">More</div>
<div class="menu"><a href="/vuichoi/kethon.php"><table><tbody><tr><td width="30"><img src="/icon/tinhyeu.png" class="npc"></td><td>Kết hôn</td></tr></table></a></div>
<div class="menu"> <a href="/vuichoi/world.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/cm.png" class="cap5" width="16" height="16"></td><td>Bảo vệ thế giới</a></td></tr></tbody></table></div>
<div class="menu"><a href="/vuichoi/mission.php"> <table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/mission.png" class="npc" width="16" height="16"></td><td>Nhiệm vụ</td></tr></tbody></table></a></div>
<div class="menu"><a href="/vuichoi/quaytay.php"><table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/love.png" class="npc"></td><td>Lầu xanh</td></tr></table></a></div>

<div class="menu"><a href="/vuichoi/baomat.php"><table><tbody><tr><td width="30"><img src="/vuichoi/img/shop/key.png" class="cap5"></td><td>Mật khẩu cấp 2</td></tr></tbody></table></a></div>


<div class="menu"><a href="/vuichoi/top.php"><table><tbody><tr><td width="30"><img src="/images/rate.gif" width="16" height="16" class="cap1"></td><td>Bảng xếp hạng</a></td></tr></tbody></table></div>';
}else{
Echo '<div class="rmenu">Bạn không phải thành viên!</div>';
}
echo '<div class="rmenu">Menu bar - Thịnh Gà Gô</div>';



require('../incfiles/end.php');
?>
