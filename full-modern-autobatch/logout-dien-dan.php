<?php
define('_IN_JOHNCMS', 1);
$baned3 = 2;
require_once ('incfiles/core.php');
$textl = 'Vi pham '. $user['name'] . '';
require('incfiles/head.php');
if (!empty($ban)){
header('Location: '.$home.'/baned.php');
} else {
header('Location: /dangxuatthanhvien.php');
}
require('incfiles/end.php');
?>