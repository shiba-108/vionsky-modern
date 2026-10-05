<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
$connect->query("UPDATE `users` SET `lastdate` = ". time() . " WHERE `id` = '559'");
$dangonline = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 600) . "'")->fetch_row()[0] ?? 0);
?>
<div class="main-xmenu">
<div class="danhmuc"><?php echo 'Có '.$dangonline.' thành viên '; ?></div>
<div class="menu"><?php if ($dangonline > 0){include'../../incfiles/online.php';}else{echo'Không thành viên nào online';} ?>
</div>
</div>
<?php ?>