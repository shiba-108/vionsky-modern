<?php 
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
?>
<?php echo ''.($datauser['thongbaocanhan'] == 0 ? '' : '<span class="mitemCount">'.$datauser['thongbaocanhan'].'</b></span>'); ?>