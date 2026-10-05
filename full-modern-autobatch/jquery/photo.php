<?php 
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$thoigiananhmoi = ($connect->query("SELECT COUNT(*) FROM `photo` WHERE `time` AND `time` > '".(time()-300)."'")->fetch_row()[0] ?? 0); ?>
<?php if (!empty($thoigiananhmoi)){echo '<span class="mitemCount">' . $thoigiananhmoi. '</span>';} ?>