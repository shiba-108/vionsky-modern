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
echo '<div class="list1"><b>Bạn chỉ được nhận quà duy nhất một lần một ngày.</b></div>';
if(time() > $datauser['tgiannhanqua'] + 3600 * 24){
echo '<div class="list1">';
if(isset($_POST['submit'])) {
$rand = rand(1,25);
if($rand == 1) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 500 Vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 2) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 1000 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'1000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 3) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 5500 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'5500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 4) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 3000 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'3000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 5) {
echo '<img src="" alt="Nhận quà"/> Bạn nhận được 7000 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'7000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 6) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 250 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'250', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 7) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 10000 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'10000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 8) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 500 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 9) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 4000 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'4000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 10) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 45 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'45', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 11) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 3000 Vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'3000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 12) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 1500 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'1500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 13) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 50 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'50', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 14) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 10 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'10', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 15) {
echo '<img src="" alt="Nhận quà"/> Bạn nhận được 17 kc từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'17', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 16) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 9000 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'9000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 17) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 2500 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'2500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 18) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 4500 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'4500', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 19) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 14 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'14', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 20) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 25 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'25', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 21) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 30 kim cương từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `kc`=`kc`+'30', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 22) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 15000 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vàng`=`vàng`+'15000', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 23) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 3800 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'14', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 24) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 850 vàng từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `balans`=`balans`+'850', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
} else if($rand == 25) {
echo '<img src="/icon/giftbox.png" alt="Nhận quà"/> Bạn nhận được 2015 VNĐ từ hộp quà may mắn!';
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'2015', `tgiannhanqua` = '".time()."' WHERE `id`='{$user_id}'");
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
