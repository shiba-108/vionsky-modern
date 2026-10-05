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
<div class="list1"><img src="/images/canh/106.png"> <a href="/muahe/kiemb.php">Kiếm Buster {500 Lượng}</a>
</div><div class="list1"><img src="/images/canh/666.png"> <a href="/muahe/canhkh.php">{500 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/700.png"> <a href="/muahe/pet.php"> {500 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/888.png"> <a href="/muahe/klpn.php"> {1000 Lượng}</a>
</div><div class="list1"><img src="/images/docamtay/103.png"> <a href="/muahe/tim.php"> {50 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/001.png"> <a href="/muahe/klccx.php"> {500 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/002.png"> <a href="/muahe/rdpl.php"> {500 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/003.png"> <a href="/muahe/cttmx.php"> {1000 Lượng}</a>
</div><div class="list1"><img src="/images/thucung/004.png"> <a href="/muahe/klttmx.php"> {1000 Lượng}</a>
</div><div class="list1"><img src="/images/haoquang/001.png"> <a href="/muahe/hqpsd.php"> {1000 Lượng}</a>
</div><div class="list1"><img src="/images/haoquang/002.png"> <a href="/muahe/hqpsv.php"> {500 Lượng}</a>
</div><div class="list1"><img src="/images/haoquang/003.png"> <a href="/muahe/hqpsx.php"> {500 Lượng}</a>
</div><div class="list1"><img src="/images/toc/001.png"> <a href="/muahe/kks.php"> {50 Lượng}</a>
</div><div class="list1"><img src="/images/toc/002.png"> <a href="/muahe/ssjt.php"> {500 Lượng}</a>
';
echo '<div class="mainblok"><div class="phdr"><a href="/muahe/muaqua2.php">Qua trang 2</a></div>';
require_once('../incfiles/end.php');
?>
