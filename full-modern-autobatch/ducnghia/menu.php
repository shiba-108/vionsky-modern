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
$textl = 'Ông Già Noel ';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Sự Kiện Mùa Đông Kinh Hoàng</b></div>';
echo'
<div class="list1"><img src="/images/khuonmat/7.png"> <a href="/ducnghia/kmtd.php">Khuôn Mặt Thần Đèn [300 mũ len]</a></div>
<div class="list1"><img src="/images/ao/1114.png"> <a href="/ducnghia/aotd.php">Áo Thần Đèn [mũ len]</a></div>
<div class="list1"><img src="/images/quan/1114.png"> <a href="/ducnghia/qtd.php">Quần Thần Đèn [300 mũ len]</a></div>
<div class="list1"><img src="/images/canh/105.png"> <a href="/ducnghia/canhat.php">Cánh Âm Ti [600 mũ len]</a></div>
<div class="list1"><img src="/images/canh/640.png"> <a href="/ducnghia/canhttk.php">Cánh Tiểu Thần Kì [700 mũ len]</a></div>
<div class="list1"><img src="/images/canh/70.png"> <a href="/ducnghia/ssj1.php">Chớp Siêu Xay Da [700mũ len ]</a></div>
<div class="list1"><img src="/images/haoquang/57.png"> <a href="/ducnghia/hqav.php">Hào Quang Ánh Vàng [300 mũ len]</a></div>
<div class="list1"><img src="/images/thucung/105.png"> <a href="/ducnghia/petrong.php">Pet Rồng Đen Bay [400 mũ len]</a></div>
<div class="list1"><img src="/images/vatpham/99.png"> <a href="/ducnghia/petrongx.php">Pet Rồng Xanh Bay [500 mũ len]</a></div>
<div class="list1"><img src="/images/toc/810.png"> <a href="/ducnghia/tocgk.php">Tóc Siêu Xayda VIP [1000 Que Kem]</a></div>


';

echo '<div class="phdr"><a href="index.php">' . $lng['back'] . '</a></div></div>';
require_once('../incfiles/end.php');
?>