<?php
defined('_IN_JOHNCMS') or die('Error: restricted');
$db_host = 'localhost';
$db_user = 'xwdqlnhn_ducnghia';
$db_pass = 'vionsky_2026_secure';
$db_name = 'xwdqlnhn_ducnghia';
$connect = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) die('DB modern connect failed — check vionsky config');
mysqli_set_charset($connect, 'utf8mb4');
$set = array();
$lng = 'vi';
$is_mobile = false;
$home = 'https://vionsky.com';
