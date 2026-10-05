<?php


define('_IN_JOHNCMS', 1);

$rootpath = '';
require('../incfiles/core.php');
$textl = 'Đăng kí thành viên';
$mota = 'Hãy tham gia cộng đồng để cùng nhau giải trí và chém gió';
$headmod = 'registration';
require('../incfiles/head.php');
$lng_reg = core::load_lng('registration');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đăng kí</div>';
if (core::$deny_registration || !$set['mod_reg']) {
echo '<p>' . $lng_reg['registration_closed'] . '</p>';
require('../incfiles/end.php');
exit;
}

$gt = intval($_GET['id']);
$ktgt  =  mysqli_result($connect->query("SELECT COUNT(`id`)FROM `users` WHERE `id`='".$gt."'" ), 0);
if($ktgt == 0) {
echo '<div class="menu">Link giới thiệu không tồn tại!</div>';
echo '</div>';
require( '../incfiles/end.php' );
exit;
}
$ktip = ($connect->query("SELECT COUNT(`ip`) FROM `users` WHERE `ip`='" . core::$ip . "'")->fetch_row()[0] ?? 0);
if ($ktip >= 1) {
echo '<div class="menu"><font color="red">Bạn đã đăng kí 1 nick và không thể đăng kí thêm !</font></div></div>';
require('../incfiles/end.php');
exit;
}
$quydinh = intval($_POST['quydinh']);
$reg_nick = isset($_POST['nick']) ? trim($_POST['nick']) : '';
$lat_nick = functions::rus_lat(mb_strtolower($reg_nick));
$reg_pass = isset($_POST['password']) ? trim($_POST['password']) : '';
$reg_name = isset($_POST['imname']) ? trim($_POST['imname']) : '';
$reg_about = isset($_POST['about']) ? trim($_POST['about']) : '';
$reg_sex = isset($_POST['sex']) ? functions::check(mb_substr(trim($_POST['sex']), 0, 2)) : '';

if (isset($_POST['submit'])) {
if($quydinh == 0) {
echo'<div class="menu">Bạn chưa hiểu quy định nên không thể đăng kí nhé !</div>';
echo'</div>'; 
require('../incfiles/end.php');
exit;
}
$error = array();
    if (empty($reg_nick))
        $error['login'][] = $lng_reg['error_nick_empty'];
    elseif (mb_strlen($reg_nick) < 2 || mb_strlen($reg_nick) > 15)

        $error['login'][] = $lng_reg['error_nick_lenght']; 

    if (preg_match("/[^\da-z_\-.]+/", $lat_nick)) 
        $error['login'][] = $lng['error_wrong_symbols'];

if (empty($reg_pass)) $error['password'][] = $lng['error_empty_password'];
elseif (mb_strlen($reg_pass) < 3 || mb_strlen($reg_pass) > 10) $error['password'][] = $lng['error_wrong_lenght'];
if (preg_match('/[^\dA-Za-z] /', $reg_pass)) $error['password'][] = $lng['error_wrong_symbols'];
// Проверка пола
if ($reg_sex != 'm' && $reg_sex != 'zh') $error['sex'] = $lng_reg['error_sex'];
unset($_SESSION['code']);
// Проверка переменных
if (empty($error)) {
$pass = md5(md5($reg_pass));
$reg_name = functions::check(mb_substr($reg_name, 0, 20));
$reg_about = functions::check(mb_substr($reg_about, 0, 500));
// Проверка, занят ли ник
$req = $connect->query("SELECT * FROM `users` WHERE `name_lat`='" . mysql_real_escape_string($lat_nick) . "'");
if ($connect->query("SELECT * FROM ...")$req) != 0) {
$error['login'][] = $lng_reg['error_nick_occupied'];
}
}
if (empty($error)) {
$preg = $set['mod_reg'] > 1 ? 1 : 0;
$connect->query("INSERT INTO `users` SET
`name` = '" . mysql_real_escape_string($reg_nick) . "',
`name_lat` = '" . mysql_real_escape_string($lat_nick) . "',
`password` = '" . mysql_real_escape_string($pass) . "',
`imname` = '$reg_name',
`about` = '$reg_about',
`sex` = '$reg_sex',
`tienxu` = '2000',
`vinaxu` = '10',
`gioithieu` = '".$gt."',
`rights` = '0',
`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`browser` = '" . mysql_real_escape_string($agn) . "',
`datereg` = '" . time() . "',
`lastdate` = '" . time() . "',
`sestime` = '" . time() . "',
`preg` = '$preg',
`set_user` = '',
`set_forum` = '',
`smileys` = ''
") or exit(__LINE__ . ': ' . mysql_error());
$usid = mysql_insert_id();

        // Отправка системного сообщения
        $set_mail = unserialize($set['setting_mail']);
        if (!isset($set_mail['message_include'])) {
            $set_mail['message_include'] = 0;
        }

        if ($set_mail['message_include']) {
            $array = array('{LOGIN}', '{TIME}');
            $array_replace = array($reg_nick, '{TIME=' . time() . '}');

            if (empty($set['them_message']))
                $set['them_message'] = $lng_mail['them_message'];
            if (empty($set['reg_message']))
                $set['reg_message'] = $lng['hi'] . ", {LOGIN}\r\n" . $lng_mail['pleased_see_you'] . "\r\n" . $lng_mail['come_my_site'] . "\r\n" . $lng_mail['respectfully_yours'];
            $theme = str_replace($array, $array_replace, $set['them_message']);
            $system = str_replace($array, $array_replace, $set['reg_message']);
            $connect->query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $usid . "',
			    `text` = '" . mysql_real_escape_string($system) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = '" . mysql_real_escape_string($theme) . "'
			");
        }
        header('Location: /');
        if ($set['mod_reg'] == 1) {
            echo '<p><span class="red"><b>' . $lng_reg['moderation_note'] . '</b></span></p>';
        }  else {
            $_SESSION['uid'] = $usid;
            $_SESSION['ups'] = md5(md5($reg_pass));
        }
        echo '</div>';
        require('incfiles/end.php');
        exit;
    }
}

if ($set['mod_reg'] == 1) echo '<div class="rmenu"><p>' . $lng_reg['moderation_warning'] . '</p></div>';
$sqlgt = $connect->query("SELECT `name` FROM `users` WHERE `id`='".$gt."'");
$sgt = $connect->fetch_array($sqlgt);
echo'<form method="post"><div class="menu">' .
'Tên đăng nhập<br/>' .
(isset($error['login']) ? '<span class="red"><small>' . implode('<br />', $error['login']) . '</small></span><br />' : '') .
'<input type="text" name="nick" maxlength="15" value="' . htmlspecialchars($reg_nick) . '"' . (isset($error['login']) ? ' style="background-color: #FFCCCC"' : '') . '/><br />' .
'' . $lng_reg['password'] . '<br/>' .
(isset($error['password']) ? '<span class="red"><small>' . implode('<br />', $error['password']) . '</small></span><br />' : '') .
'<input type="text" name="password" maxlength="20" value="' . htmlspecialchars($reg_pass) . '"' . (isset($error['password']) ? ' style="background-color: #FFCCCC"' : '') . '/><br/>' .
'Nhập lại mật khẩu<br/>' .
'<input type="text" name="password2" maxlength="20" value=""/><br/>' .
'Giới tính của bạn<br/>' .
(isset($error['sex']) ? '<span class="red"><small>' . $error['sex'] . '</small></span><br />' : '') .
'<select name="sex"' . (isset($error['sex']) ? ' style="background-color: #FFCCCC"' : '') . '>' .
'<option value="?">-?-</option>' .
'<option value="m"' . ($reg_sex == 'm' ? ' selected="selected"' : '') . '>' . $lng_reg['sex_m'] . '</option>' .
'<option value="zh"' . ($reg_sex == 'zh' ? ' selected="selected"' : '') . '>' . $lng_reg['sex_w'] . '</option>' .
'</select><br/>' .
'</div>' .
'<div class="menu list-top">';
echo'Chúng tôi sẽ xóa hoặc band các nick có tên bậy bạ hoặc tên lung tung. Hãy là người văn minh khi tham gia mạng xã hội nhé !';
echo'</div>' .
'<div class="menu list-top list-bottom hot">' .
'<input type="checkbox" name="quydinh" value="1" />Tôi đã hiểu' .
'</div>' .
'<p><input type="submit" name="submit" value="' . $lng_reg['registration'] . '"/></p></form>';
echo'</div>';
require('../incfiles/end.php');