<?php
defined('_IN_JOHNCMS') or die('Restricted');
// Modern PHP 8 config — DB credentials should come from env, not hardcoded
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'xwdqlnhn_ducnghia';
$db_user = getenv('DB_USER') ?: 'xwdqlnhn_ducnghia';
$db_pass = getenv('DB_PASS'); // No hardcoded password
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) die('DB connection failed');
$mysqli->set_charset('utf8mb4');
