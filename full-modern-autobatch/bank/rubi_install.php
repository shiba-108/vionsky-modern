<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
$sql1 = "ALTER TABLE users ADD rubi int(11) not null default '0';";
$connect->query($sql1) or die('lỗi1!');
echo 'Bạn đã cài đặt thành công';
?>
