<?php 

/** 
 * @package     JohnCMSVN 
 * @link        http://johncmsvn.com 
 * @copyright   Copyright (C) 2014 JohnCMSVN Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      Văn Việt 
 */ 

define('_IN_JOHNCMS', 1); 

require_once('../incfiles/core.php'); 
$textl = 'Nhận quà hàng ngày.'; 
require_once('../incfiles/head.php'); 
echo '<div class="mainblok"><div class="phdr">Hộp quà may mắn!</div>'; 
echo '<div class="list1"><b>Bạn chỉ được nhận quà hằng ngày duy nhất một lần một ngày.</b></div>'; 
if(time() > $datauser['tgiannhanqua'] + 3600 * 24){ 
echo '<div class="list1">'; 
if(isset($_POST['submit'])) { 
$rand = rand(1,20); 
if($rand == 1) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1000 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'1000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 2) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'1', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 3) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1000 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'1000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 4) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1200 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'1200', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 5) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'2', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 6) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1200 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'1200', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 7) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 900 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'900', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 8) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'1', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 9) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 900 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'900', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 10) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1500 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'1500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 11) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'2', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 12) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 1500 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'1000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 13) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2000 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'2000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 14) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'2', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 15) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2000 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'2000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 16) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2300 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'2300', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 17) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 3 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'3', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 18) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 2300 VNĐ từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'2300', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
}
 
if($rand == 19) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 5000 vàng từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'1000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 

if($rand == 20) { 
echo '<img src="/images/qua.png" alt="Nhận quà"/> Bạn nhận được 5 D từ hộp quà hằng ngày!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'5', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} 
} 
echo '<form method="post"><input type="submit" name="submit" value="Nhận Quà" /></form> 
</div>'; 
} else { 
echo '<div class="list1"><b><font color="red">Lỗi </font> Bạn đã nhận quà rồi</b></div>'; 
} 
echo '</div>'; 
require_once('../incfiles/end.php'); 
?>