<?php

define('_IN_JOHNCMS', 1);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Content-type: application/xhtml+xml; charset=UTF-8");
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en'>
<head>
<meta http-equiv='content-type' content='application/xhtml+xml; charset=utf-8'/>";
echo "<title>Statistics update</title>
<style type='text/css'>
body { font-weight: normal; font-family: Century Gothic; font-size: 12px; color: #FFFFFF; background-color: #000033}
a:link { text-decoration: underline; color : #D3ECFF}
a:active { text-decoration: underline; color : #2F3528 }
a:visited { text-decoration: underline; color : #31F7D4}
a:hover { text-decoration: none; font-size: 12px; color : #E4F992 }
.red { color: #FF0000; font-weight: bold; }
.green{ color: #009933; font-weight: bold; }
.gray{ color: #FF0000; font: small; }
</style>
</head><body>";
echo '<big><b>Statistics module 6.2</b></big><br />Update<hr />';

// Подключаемся к базе данных
require_once ("../incfiles/db.php");
$connect = mysql_connect($db_host, $db_user, $db_pass) or die('cannot connect to server</body></html>');
mysql_select_db($db_name) or die('cannot connect to db');
$connect->query("SET NAMES 'utf8'", $connect);

$do = isset($_GET['do']) ? $_GET['do'] : '';
switch ($do)
{
    case 'step1':
        echo '<b><u>Preparing tables</u></b><br />';
        // Таблица
		$connect->query("ALTER TABLE `counter` ADD `ip_via_proxy` VARCHAR( 15 ) NOT NULL AFTER `ip`;");
        echo '<span class="green">OK</span> counter table has been updated successfully<br />';

        echo '<hr /><a href="update.php?do=final">Continue</a>';
        break;

    case 'final':
        echo '<b><span class="green">Congratulations!</span></b><br />The installation procedure was successful finished.<br />Do not forget to delete update.php and install.php files';
        echo '<hr /><a href="../../index.php">Go to site</a>';
        break;

    default:
        echo '<p><big><span class="red">WARNING!</span></big><ul>';
        echo '<li>Before starting the installation procedure, make sure you did the database back up. If the installation will not finished succesful for some reason, you will have to restore the database from backup.</li>';
        echo '<li>If you click the "Continue" link, canceling will not be possible without restoring from a backup.</li>';
        echo '<li></li>';
        echo '</ul></p>';
        echo '<hr />Are you sure?<br /><a href="update.php?do=step1">Continue</a>';
}

echo '</body>
</html>';

?>