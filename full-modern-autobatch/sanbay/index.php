<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$headmod='sanbay';
$textl='Khu sân bay';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr">Sân bay</div>';
echo '<div class="menu class"><img src="/icon/next.png"><a href="/sanbay/hawaii/index_hawaii.php" ><b> Hawai</b> </a></div>';
echo '</div>';
require('../incfiles/end.php');
?>