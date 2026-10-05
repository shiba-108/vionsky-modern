<?php
error_reporting(0);
$db_host = 'localhost';
$db_name = 'xemlasuo_ttm';
$db_username = 'xemlasuo_ttm';
$db_password = 'dkm1ga2h3';
$baotri = '0|Dang bao tri !';
$conn = @mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("$baotri");
@mysql_select_db("{$db_name}") or die("$baotri");
$connect->query("SET character_set_results=utf8", $conn);
mb_internal_encoding('UTF-8');
$connect->query("set names 'utf8'",$conn);

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
