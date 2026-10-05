<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$lng_forum = core::load_lng('forum');
$congdong = ' id="selected"';
$vietbai = 'style="color:#838c01"';
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);
$id = trim($_GET['id']);
$text = trim($_GET['text']);
$set_forum = $user_id && !empty($datauser['set_forum']) ? unserialize($datauser['set_forum']) : array(
'farea'    => 0,
'upfp'     => 0,
'preview'  => 1,
'postclip' => 1,
'postcut'  => 2
);
$ext_arch = array(
'zip',
'rar',
'7z',
'tar',
'gz',
'apk'
);
$ext_audio = array(
'mp3',
'amr'
);
$ext_doc = array(
'txt',
'pdf',
'doc',
'docx',
'rtf',
'djvu',
'xls',
'xlsx'
);
$ext_java = array(
'sis',
'sisx',
'apk'
);
$ext_pic = array(
'jpg',
'jpeg',
'gif',
'png',
'bmp'
);
$ext_sis = array(
'sis',
'sisx'
);
$ext_video = array(
'3gp',
'avi',
'flv',
'mpeg',
'mp4'
);
$ext_win = array(
'exe',
'msi'
);
$ext_other = array('wmf');
$error = '';
if (!$set['mod_forum'] && $rights < 7)
$error = $lng_forum['forum_closed'];
elseif ($set['mod_forum'] == 1 && !$user_id)
$error = $lng['access_guest_forbidden'];
if ($error) {
require('../incfiles/head.php');
echo '<div class="rmenu"><p>' . $error . '</p></div>';
require('../incfiles/end.php');
exit;
}
$page = ($_GET['trang']);
if ( $page >1 ){
$vina4u = ' - Trang '.$page.'';
}
$page1 = ($_GET['page']);
if ( $page1 >1 ){
$vina4u1 = ' - Trang '.$page1.'';
}
$postres = $connect->fetch_assoc($connect->query("SELECT `account`.* FROM `account` LEFT JOIN `users` ON `account`.`user_id` = `users`.`id` WHERE `account`.`type` = 'm' AND `account`.`refid` = '$id' ORDER BY `account`.`id` ASC LIMIT 1"));
$mota = bbcode::notags($postres['text']);
if (empty($id)) {
$textl = 'Trang chủ diễn đàn YEUDEHON.NET'.$vina4u1.''.$vina4u.'';
} else {
$req = $connect->query("SELECT `text`,`refid` FROM `account` WHERE `id`= '" . $id . "'");
$res = $connect->fetch_assoc($req);
$gettop = $connect->fetch_assoc($connect->query("SELECT * FROM `account` WHERE `type` = 'r' and id = '".$res['refid']."'"));
$textl = $res['text'].''.$vina4u1.''.$vina4u.'';
$tieude = $res['text'].'';
}
$top = $res['text']; 
$top = html_entity_decode($top, ENT_QUOTES,'UTF-8');
$mods = array(
'newtopic',
'bqt'
);
if ($act && ($key = array_search($act, $mods)) !== FALSE && file_exists('includes/' . $mods[$key] . '.php')) {
require('includes/' . $mods[$key] . '.php');
} else {
require('../incfiles/head.php');
}
require_once('../incfiles/end.php');