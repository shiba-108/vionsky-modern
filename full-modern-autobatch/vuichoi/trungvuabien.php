<?php

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');
$text1 = 'Đập trứng';
echo '<div class="phdr">Trứng Vua Biển</div>';
if ($user_id){
echo '<div class="gmenu"><table><tbody><tr><td width="20"><img src="img/shop/baohiem.gif" alt="Card may mắn:"> </td><td>'.$datauser['baohiem'].' [<a href="shop.php">Mua</a>]</td></tr></tbody></table></div>';
$rand = rand(0,10);
$vang = rand(1000,20000);
$vnd = rand(1000,250000);
$soluong = rand(1,7);
switch($act){
default:
echo '
<div class="menu">Mỗi quả trứng của vua biển có thể chứa vàng, vnđ thậm chí chứa nhiều vật phẩm không tưởng! (tối đa x7/1 vật phẩm). Vì sợ bên trong chứa vua biển nên phải cần đến thẻ may mắn tránh sát sinh 1 chú vua biển!</div>';
break;
case '1':
if ($datauser['baohiem'] >=1){
if ($rand ==1){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> Vnđ</font></div>';
} if ($rand ==4){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> Vnđ</font></div>';
}
if ($rand ==7){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> Vnđ</font></div>';
}
if ($rand ==9){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> Vnđ</font></div>';
}
if ($rand ==2){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==8){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==10){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==0){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==6){
$connect->query("UPDATE users SET baohiem = baohiem -1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Xịt rồi @@</div>';
}
if ($rand ==3){
$connect->query("UPDATE users SET baohiem = baohiem + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <b>'.$soluong.'</b> thẻ may mắn</div>';
}
if ($rand ==5){
$connect->query("UPDATE users SET baohiem = baohiem + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <b>'.$soluong.'</b> thẻ may mắn</div>';
}
if ($rand ==7){
$connect->query("UPDATE users SET tangthanhcong = tangthanhcong + $soluong, baohiem = baohiem - 1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> thẻ cẩn thận</font></div>';
}
} else {
echo '<div class="rmenu">Không đủ thẻ may mắn</div>';
}
break;
case '2':
if ($datauser['baohiem'] >=1){
if ($rand ==2 or $rand ==7){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==9){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> VNĐ</font></div>';
}
if ($rand ==8){
$connect->query("UPDATE users SET baohiem = baohiem -1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Xịt rồi @@</div>';
}
if ($rand ==0){
$connect->query("UPDATE users SET baohiem = baohiem -1, tangthanhcong3 = tangthanhcong3 + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card tinh tế</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card nâng cấp tinh tế',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==1){
$connect->query("UPDATE users SET baohiem = baohiem -1, x2truyna = x2truyna + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card x2 truy nã (HSD: 3 ngày)</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card x2 truy nã (HSD: 3 ngày)',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==3){
$connect->query("UPDATE users SET baohiem = baohiem -1, shopdown = shopdown + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card thẻ giảm giá shop</font></div>';
}
if ($rand ==4){
$connect->query("UPDATE users SET baohiem = baohiem -1, tangthanhcong2 = tangthanhcong2 + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card cẩn thận</font></div>';
}
if ($rand ==5){
$connect->query("UPDATE users SET baohiem = baohiem -1, cardchuyentien = cardchuyentien + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card chuyển tiền (HSD: 5 ngày)</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card chuyển tiền (HSD: 5 ngày)',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==6){
$connect->query("UPDATE users SET baohiem = baohiem -1, shopweardown = shopweardown + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card giảm giá trang phục</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card giảm giá trang phục',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==10){
$connect->query("UPDATE users SET baohiem = baohiem -1, blackshopdown = blackshopdown + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card giảm giá chợ đen</font></div>';
}
} else{
echo '<div class="rmenu">Không đủ thẻ để quay</div>';
}
break;
case '3':
if($datauser['baohiem'] >=1){
if ($rand ==8 or $rand ==7 or $rand ==10){
$connect->query("UPDATE users SET baohiem = baohiem -1, balans = balans + $vang WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="gold"><b>'.$vang.'</b> Gold</font></div>';
}
if ($rand ==9 or $rand==6){
$connect->query("UPDATE users SET baohiem = baohiem -1, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="green"><b>'.$vnd.'</b> VNĐ</font></div>';
}
if ($rand ==5){
$connect->query("UPDATE users SET baohiem = baohiem -1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Xịt rồi @@</div>';
}
if ($rand ==0){
$connect->query("UPDATE users SET baohiem = baohiem -1, tangthanhcong3 = tangthanhcong3 + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card tinh tế</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card đập đồ tinh tế',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==1){
$connect->query("UPDATE users SET baohiem = baohiem -1, x2truyna = x2truyna + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card x2 truy nã (HSD: 3 ngày)</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card x2 truy nã (HSD: 3 ngày)',
            `ip` = '" . core::$ip . "'
       ");
}
if ($rand ==3){
$connect->query("UPDATE users SET baohiem = baohiem -1, shopdown = shopdown + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card thẻ giảm giá shop</font></div>';
}
if ($rand ==4){
$connect->query("UPDATE users SET baohiem = baohiem -1, tangthanhcong2 = tangthanhcong2 + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card cẩn thận</font></div>';
}
if ($rand ==2){
$connect->query("UPDATE users SET baohiem = baohiem -1, cardchuyentien = cardchuyentien + $soluong WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Bạn nhận được: <font color="red"><b>'.$soluong.'</b> Card chuyển tiền (HSD: 5 ngày)</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." đập trứng vua biển nhận được ".$soluong." card chuyển tiền (HSD: 5 ngày)',
            `ip` = '" . core::$ip . "'
       ");
}
} else{
echo '<div class="rmenu">Không đủ thẻ để quay</div>';
}
break;
}
echo '<div class="newsx"><div class="list1"><small><center><table><tbody><tr><td><a href="?act=1"><img src="img/shop/trunghuyenbi.png" alt="Quả 1"></a><br>Tiền:<b>70 %</b><br>Vật phẩm:<b>20%</b><br>Xịt:<b>10%</b></td><td> <a href="?act=2"><img src="img/shop/trunghuyenbi.png" alt="Quả 2"></a><br>Tiền:<b>20 %</b><br>Vật phẩm:<b>70%</b><br>Xịt:<b>10%</b></td> <td><a href="?act=3"><img src="img/shop/trunghuyenbi.png" alt="Quả 3"></a><br>Tiền:<b>45 %</b><br>Vật phẩm:<b>45%</b><br>Xịt:<b>10%</b></td></tr></tbody></table></center></small></div></div>';
} else {
echo '<div class="rmenu">Vui lòng đăng nhập</div>';
}




        require('../incfiles/end.php');
?>