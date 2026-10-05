<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../incfiles/core.php');
$textl = 'Chia sẻ link đăng kí';
$mota = 'Chia sẻ đăng kí thành viên';
$headmod = 'registration';
require('../incfiles/head.php');
$lng_reg = core::load_lng('registration');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chia sẻ link đăng kí</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để sử dụng chức năng này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong" style="margin-top: -2px">Chia sẻ link này cho bạn bè khi có 1 người đăng kí và xác nhận công dân bạn sẽ được nhận 3000xu và 1 vinaxu !</div>';
echo'<div class="menu"><input type="text"value="http://xemlasuong.tk/share/'.$user_id.'"/></div>';
$tong = ($connect->query("SELECT COUNT(*) FROM users WHERE gioithieu = $user_id")->fetch_row()[0] ?? 0);
echo 'Có tổng <b>'.$tong.'</b> bạn được bạn giới thiệu!</div>';
require('../incfiles/end.php');
