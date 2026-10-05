<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Mua Item ';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Sự kiện</b></div>';
echo'
<div class="list1"><img src="/images/canh/001.png"> <a href="/muahe/canhdoi.php"> {500 Lượng}</a></div>
</div><div class="list1"><img src="/images/docamtay/001.png"> <a href="/muahe/sung.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/docamtay/002.png"> <a href="/muahe/longden.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/docamtay/003.png"> <a href="/muahe/phan.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/docamtay/004.png"> <a href="/muahe/tim1.php"> {50 Lượng}</a>
</div><div class="list1"><img src="/images/docamtay/005.png"> <a href="/muahe/tim2.php"> {50 Lượng}</a>
</div><div class="list1"><img src="/images/non/003.png"> <a href="/muahe/ntp.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/non/001.png"> <a href="/muahe/vmcc.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/non/002.png"> <a href="/muahe/nht.php"> {300 Lượng}</a>
</div><div class="list1"><img src="/images/ao/002.png"> <a href="/muahe/aht.php">{300 Lượng}</a>
</div><div class="list1"><img src="/images/quan/002.png"> <a href="/muahe/qht.php"> {300 Lượng}</a>
';
echo '<div class="mainblok"><div class="phdr"><a href="/muahe/muaqua.php">Quay lại trang 1</a></div>';
require_once('../incfiles/end.php');
?>
