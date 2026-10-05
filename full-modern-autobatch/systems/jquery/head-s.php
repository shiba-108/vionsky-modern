<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
if ($user_id){echo ''.($datauser['thongbaocanhan'] == 0 ? '' : '<span class="mitemCount">'.$datauser['thongbaocanhan'].'</b></span>');}
?>