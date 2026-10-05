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
$textl = 'Đổi Cá';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Sự kiện</b></div>';
echo'
<div class="list1"><img src="/images/canh/011.png"></br> <a href="/doica/duoiholy.php">Đuôi Hồ Ly [50 Con cá]</a>
</div><div class="list1"><img src="/images/canh/012.png"></br> <a href="/doica/canhvang.php">Cánh Vàng [100 Con cá]</a>
</div><div class="list1"><img src="/images/non/011.png"></br> <a href="/doica/nonbo.php">Nón Bò [50 Con cá]</a>
</div><div class="list1"><img src="/images/non/012.png"></br> <a href="/doica/nontom.php">Nón Tôm [50 Con cá]</a>
</div><div class="list1"><img src="/images/non/013.png"></br> <a href="/doica/nonsutu.php">Nón Sư Tử [50 Con cá]</a>
</div><div class="list1"><img src="/images/toc/011.png"></br> <a href="/doica/sjjdo.php">Tóc SSJ Đỏ [100 Con cá]</a>
</div><div class="list1"><img src="/images/docamtay/011.png"></br> <a href="/doica/caykeo.php">Cây kẹo [100 Con cá]</a>
';
echo '<div class="mainblok"><div class="phdr">Đổi cá mod by Giang Henry</div>';
require_once('../incfiles/end.php');
?>
