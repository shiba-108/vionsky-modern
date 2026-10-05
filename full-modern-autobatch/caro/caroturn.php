<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('.././incfiles/core.php');
if($_GET['id']){
$getturn=$connect->query('select turn from carodata where id='.$_GET[id]);
if(mysql_numrows($getturn)>0) echo mysqli_result($getturn,0,"turn");
}
?>