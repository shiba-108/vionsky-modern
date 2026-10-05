<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
//Error_Reporting(E_ALL & ~E_NOTICE);
@ini_set('session.use_trans_sid', '0');
@ini_set('arg_separator.output', '&amp;');
date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');

// Корневая папка
define('ROOTPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);


spl_autoload_register('autoload');
function autoload($name)
{
$file = ROOTPATH . 'incfiles/classes/' . $name . '.php';
if (file_exists($file))
require_once($file);
}


new core;

$rootpath = ROOTPATH;
$ip = core::$ip; // Адрес IP
$agn = core::$user_agent; // User Agent
$set = core::$system_set; // Системные настройки
$lng = core::$lng; // Фразы языка
$is_mobile = core::$is_mobile; // Определение мобильного браузера
$home = $set['homeurl']; // Домашняя страница

/*
-----------------------------------------------------------------
Получаем пользовательские переменные
-----------------------------------------------------------------
*/
$user_id = core::$user_id; // Идентификатор пользователя
$rights = core::$user_rights; // Права доступа
$datauser = core::$user_data; // Все данные пользователя
$set_user = core::$user_set; // Пользовательские настройки
$ban = core::$user_ban;
$login = isset($datauser['name']) ? $datauser['name'] : false;
$imgmeta = ''.$home.'/icon-meta.png';
$navbar_item = 'item';
$kmess = $set_user['kmess'] > 4 && $set_user['kmess'] < 100 ? $set_user['kmess'] : 10;
$teamkmess = $set_user['teamkmess'] > 4 && $set_user['teamkmess'] < 100 ? $set_user['teamkmess'] : 10;
$homekmess = $set_user['homekmess'] > 4 && $set_user['homekmess'] < 100 ? $set_user['homekmess'] : 10;
$phannua = $set_user['phannua'] > 4 && $set_user['phannua'] < 100 ? $set_user['phannua'] : 10;
function validate_referer()
{
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if (@!empty($_SERVER['HTTP_REFERER'])) {
$ref = parse_url(@$_SERVER['HTTP_REFERER']);
if ($_SERVER['HTTP_HOST'] === $ref['host']) return;
}
die('Invalid request');
}

if ($rights) {
validate_referer();
}

/*
-----------------------------------------------------------------
Получаем и фильтруем основные переменные для системы
-----------------------------------------------------------------
*/
$id = isset($_REQUEST['id']) ? abs(intval($_REQUEST['id'])) : false;
$user = isset($_REQUEST['user']) ? abs(intval($_REQUEST['user'])) : false;
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$mod = isset($_REQUEST['mod']) ? trim($_REQUEST['mod']) : '';
$do = isset($_REQUEST['do']) ? trim($_REQUEST['do']) : false;
$page = isset($_REQUEST['page']) && $_REQUEST['page'] > 0 ? intval($_REQUEST['page']) : 1;
$start = isset($_REQUEST['page']) ? $page * $kmess - $kmess : (isset($_GET['start']) ? abs(intval($_GET['start'])) : 0);
$teamnext = isset($_REQUEST['teamnext']) && $_REQUEST['teamnext'] > 0 ? intval($_REQUEST['teamnext']) : 1;
$teampage = isset($_REQUEST['teamnext']) ? $teamnext* $teamkmess - $teamkmess : (isset($_GET['teampage']) ? abs(intval($_GET['teampage'])) : 0);
$homenext = isset($_REQUEST['homenext']) && $_REQUEST['homenext'] > 0 ? intval($_REQUEST['homenext']) : 1;
$homepage = isset($_REQUEST['homenext']) ? $homenext* $homekmess - $homekmess : (isset($_GET['homepage']) ? abs(intval($_GET['homepage'])) : 0);
$next = isset($_REQUEST['next']) && $_REQUEST['next'] > 0 ? intval($_REQUEST['next']) : 1;
$chuyentrang = isset($_REQUEST['next']) ? $next* $phannua - $phannua : (isset($_GET['chuyentrang']) ? abs(intval($_GET['chuyentrang'])) : 0);
$noionline = isset($noionline) ? $noionline : '';

/*
-----------------------------------------------------------------
Закрытие сайта / редирект гостей на страницу ожидания
-----------------------------------------------------------------
*/
if ((core::$system_set['site_access'] == 0 || core::$system_set['site_access'] == 1) && $noionline != 'login' && !core::$user_id) {
header('Location: ' . core::$system_set['homeurl'] . '/closed.php');
}

/*
-----------------------------------------------------------------
Буфферизация вывода
-----------------------------------------------------------------
*/
if ($set['gzip'] && @extension_loaded('zlib')) {
@ini_set('zlib.output_compression_level', 3);
ob_start('ob_gzhandler');
} else {
ob_start();
}

include'function.php';
include'sys/capbac.php';
function nick($id, $mod = false) {
$ngoitu = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '" . $id. "'")->fetch_row()[0] ?? 0);
$user = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$tong = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `duyet` = '1' AND `user_id` = '" . $id . "'")->fetch_row()[0] ?? 0);
$thongtintenthat = $connect->fetch_array($connect->query("SELECT `ten` FROM `tenthat` WHERE `user_id`='".$user['id']."'"));
if($ngoitu > 0) {
$out .= '<img src="/icon/tunhan.png" alt="icon" style="vertical-align: -3px;"/> <span style="color:#000;">'.($mod == 1 ? '<small>' : '').'' . $user['name'] . ''.($mod == 1 ? '</small>' : '').'</span>';
} else {
if($user['vip'] == 0) {$vipMem = '';}
if($user['vip'] == 1 || $user['rights'] >= 10) {$vipMem = '<b style="color:red;">[V.I.P]</b>';}
if($user['rights'] == 0) {$font = '<img src="/images/9.gif"/><span style="color:#444;"> ';}
if($user['rights'] == 1) {$font = '<img src="/images/vip.gif" alt="PRO"/> <span style="color:#417394;"><b>';}
if($user['rights'] == 2) {$font = '<img src="/icon/bqt/tm.gif"/> <span style="color:Peru;">';}
if($user['rights'] == 3) {$font = '<img src="/icon/bqt/p.gif"/> <span style="color:#555555;">';}
if($user['rights'] == 4) {$font = '<img src="/icon/bqt/m.gif"/> <span style="color:#008000;">';}
if($user['rights'] == 6) {$font = '<img src="/icon/bqt/sm.gif"/> <span style="color:#7f1ea6;">';}
if($user['rights'] == 7) {$font = '<img src="/icon/bqt/ad.gif"/> <span style="color:#ff1234;">';}
if($user['rights'] == 9) {$font = '<img src="/icon/bqt/ad.gif"/> <span style="color:#ff1234;">';}
if($user['rights'] == 10) {$font = '<span style="color:#ff1234;">';}
if ($tong == 0) {
$out .= ''.$vipMem.''.$font.'' . $user['name'] . '</b></span>';
} else {
$out .= ''.$vipMem.''.$font.'' . $thongtintenthat['ten'] . '</b></span>';
}
}
return $out;
}

function user_nick($id, $mod = false) {
$ngoitu = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '" . $id. "'")->fetch_row()[0] ?? 0);
$user = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
if($ngoitu > 0) {
$out .= '<img src="/icon/tunhan.png" alt="icon" style="vertical-align: -3px;"/> <span style="color:#000;">'.($mod == 1 ? '<small>' : '').'' . $user['name'] . ''.($mod == 1 ? '</small>' : '').'</span>';
} else {
if($user['rights'] == 0) {$font = '<img src="/images/9.gif"/><span style="color:#444;">';}
if($user['rights'] == 1) {$font = '<img src="/images/vip.gif" alt="PRO"/> <span style="color:#417394;"><b>';}
if($user['rights'] == 2) {$font = '<img src="/icon/bqt/tm.gif"/> <span style="color:Peru;">';}
if($user['rights'] == 3) {$font = '<img src="/icon/bqt/p.gif"/> <span style="color:#555555;">';}
if($user['rights'] == 4) {$font = '<img src="/icon/bqt/m.gif"/> <span style="color:#008000;">';}
if($user['rights'] == 6) {$font = '<img src="/icon/bqt/sm.gif"/> <span style="color:#7f1ea6;">';}
if($user['rights'] == 7) {$font = '<img src="/icon/bqt/ad.gif"/> <span style="color:#ff1234;">';}
if($user['rights'] == 9) {$font = '<img src="/icon/bqt/ad.gif"/> <span style="color:#ff1234;">';}
if($user['rights'] == 10) {$font = '<span style="color:#ff1234;">';}
$out .= '<span style="color:#444;">'.$user['name'].'</span>';
}
return $out;
}
//func cat ngan
function thugon($text,$id,$luong=50) {
$tach = explode(' ',$text);
$dem = count($tach);
if($dem > $luong) {
$xuat =functions::checkout($text);
$xuat = functions::smileys($xuat);
$xuat = ''.catchu($xuat,0,$luong).' <a href="/groups/post/'.$id.'">Đọc tiếp...</a>';
} else {
$xuat =functions::checkout($text, 1, 1);
$xuat = functions::smileys($xuat);
}
return $xuat;
}
//func lay bd theo id
function baidang($id) {
$var = $connect->fetch_array($connect->query("SELECT * FROM `nhom_bd` WHERE `id`='".$id."'"));
return $var;
}

function catchu($string,$start,$length){
$arrwords = explode(" ",$string);
$arrsubwords=array_slice($arrwords,$start,$length);
$result = implode(" ",$arrsubwords);
return $result;
}
//func lay info nhom theo id
function nhom($id) {
$var = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
return $var;
}
//func chuc vu trong nhom
function quyen_nhom($id,$user) {
$var = $connect->fetch_array($connect->query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$user."'"));
$mang = array(
0 => 'Thành viên', 1 => 'Quản trị viên', 2 => 'Trưởng nhóm');
return $mang[$var['rights']];
}

//// func time off thanh vien
function timeoff($from, $to = '') {
if (empty($to))
$to = time();
$diff = (int) abs($to - $from);
if ($diff <= 60) {
$since = sprintf('1p');
} elseif ($diff <= 3600) {
$mins = round($diff / 60);
if ($mins <= 1) {
$mins = 1;
}
/* translators: min=minute */
$since = sprintf('%sp', $mins);
} else if (($diff <= 86400) && ($diff > 3600)) {
$hours = round($diff / 3600);
if ($hours <= 1) {
$hours = 1;
}
$since = sprintf('%sp', $hours);
}
return $since;
}
///////// het


function convert ($str){
$str = trim($str);
$unicode = array(
'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
'd'=>'đ',
'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
'i'=>'í|ì|ỉ|ĩ|ị',
'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
'D'=>'Đ',
'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
' '=>'-',
'-'=>'\s+',
'' => '[^A-z0-9\-]'
);
foreach($unicode as $nonUnicode=>$uni){
$str = preg_replace("/($uni)/i", $nonUnicode, $str);
}
return strtolower ($str);
}
$page = ($_GET['trang']);
if ( $page >1 ){
$vina4u = 'Trang '.$page.' - ';
}
$page1 = ($_GET['page']);
if ( $page1 >1 ){
$vina4u1 = 'Trang '.$page1.' - ';
}
$img= ''.$home.'/icon-meta.png';
