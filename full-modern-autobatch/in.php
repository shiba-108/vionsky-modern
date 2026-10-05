<?php
define('_IN_JOHNCMS', 1);
require('incfiles/core.php');
$name = json_decode(file_get_contents('https://graph.facebook.com/andaik.pro'), true);
echo $name['id'];
?>