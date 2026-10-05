<?php

/**
* @package     JohnCMS
* @link        http://xemlasuong.tk
* @copyright   Copyright (C) 2008-2016 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://xemlasuong.tk
*/

@ini_set("max_execution_time", "600");
define('_IN_JOHNCMS', 1);
define('_IN_JOHNADM', 1);

require('../incfiles/core.php');
// Подключаем язык Админ-панели
$lng = array_merge($lng, core::load_lng('admin'));

// Проверяем права доступа
if (core::$user_rights < 1) {
header('Location: http://xemlasuong.tk');
exit;
}

$headmod = 'admin';
$textl = $lng['admin_panel'];
$congdong = ' selected';
require('../incfiles/head.php');
$array = array(
'forum',
'baiviet',
'congdong',
'news',
'ads',
'counters',
'ip_whois',
'languages',
'settings',
'sitemap',
'smileys',
'access',
'antispy',
'httpaf',
'ipban',
'antiflood',
'ban_panel',
'karma',
'reg',
'mail',
'search_ip',
'usr',
'usr_adm',
'usr_clean',
'usr_del'
);
if ($act && ($key = array_search($act, $array)) !== false && file_exists('includes/' . $array[$key] . '.php')) {
require('includes/' . $array[$key] . '.php');
} else {
$regtotal = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `preg`='0'")->fetch_row()[0] ?? 0);
$bantotal = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
echo '<div class="danhmuc">' . $lng['admin_panel'] . '</div>';
echo '<div class="menu"><a href="index.php?act=ban_panel"><b>Danh sách bị band</a> (' . $bantotal . ')</b></div>';
if ($rights >= 7) {
echo'<div class="menu"><a href="index.php?act=baiviet&mod=cat"><b>Tạo chuyên mục bài viết</b></a></div>' .
'<div class="menu"><a href="index.php?act=news"><b>Cài đặt dạng tin tức</b></a></div>' .
'<div class="menu"><a href="index.php?act=ads"><b>' . $lng['advertisement'] . '</b></a></div>' .
'<div class="menu"><a href="index.php?act=ads&type=2"><b>Liên kết</b></a></div>' .
(core::$user_rights == 9 ? '<div class="menu"><a href="index.php?act=settings"><b>Cài đặt sever</b></a></div>' : '') .
'<div class="menu"><a href="index.php?act=smileys"><b>Update biểu tượng mới</b></a></div>' .
(core::$user_rights == 9 ? '<div class="menu"><a href="index.php?act=languages"><b>' . $lng['language_settings'] . '</b></a></div>' : '') .
'<div class="menu"><a href="index.php?act=access"><b>' . $lng['access_rights'] . '</b></a></div>' .
(core::$user_rights == 9 ? '<div class="menu"><a href="index.php?act=ipban"><b>' . $lng['ip_ban'] . '</b></a></div>' : '') .
'';
}
}
require('../incfiles/end.php');
