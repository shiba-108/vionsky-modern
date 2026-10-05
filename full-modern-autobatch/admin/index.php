<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
require_once ('../incfiles/head.php');
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Quản lý</div>';
if ($rights <= 3) {
echo'<div class="menu">Chỉ BQT mới được sử dụng chức năng này !</div>';
echo'</div>';
require_once ('../incfiles/end.php');
exit;
}
echo'</div>';
require_once ('../incfiles/end.php');
?>