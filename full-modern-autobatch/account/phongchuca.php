<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$textl = 'Thông tin chức vị '. $user['name'] . ''; 
require('../incfiles/head.php');
if ($user['id'] != $user_id && ($rights < 7 || $user['rights'] > $rights)) {
    echo functions::display_error($lng_profile['error_rights']);
    require('../incfiles/end.php');
    exit;
}
if ($rights >= 7 && $rights > $user['rights'] && $act == 'reset') {
    $connect->query("UPDATE `users` SET `set_user` = '', `set_forum` = '', `set_chat` = '' WHERE `id` = '" . $user['id'] . "'");
    echo '<div class="menu"><p>' . $lng['settings_default'] . '<br /><a href="profile.php?user=' . $user['id'] . '">' . $lng['to_form'] . '</a></p></div>';
    require('../incfiles/end.php');
    exit;
}
if (isset($_POST['submit'])) {
    $error = array ();
    $user['rights'] = isset($_POST['rights']) ? abs(intval($_POST['rights'])) : $user['rights'];
    if($user['rights'] > $rights || $user['rights'] > 9 || $user['rights'] < 0)
        $user['rights'] = 0;

    if ($user['icq'] && ($user['icq'] < 10000 || $user['icq'] > 999999999))
        $error[] = $lng_profile['error_icq'];
    if (!$error) {

        if ($rights >= 7) {
            $connect->query("UPDATE `users` SET
                `name` = '" . $user['name'] . "',
                `status` = '" . $user['status'] . "',
                `karma_off` = '" . $user['karma_off'] . "',
                `sex` = '" . $user['sex'] . "',
                `rights` = '" . $user['rights'] . "'
                WHERE `id` = '" . $user['id'] . "'
            ");
        }
        echo '<div class="menu">' . $lng_profile['data_saved'] . '</div>';
    } else {
        echo functions::display_error($error);
    }
    header('Location: /account/' . $user['id'].'');
    exit;
}
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">Thông tin chức vị '.$user['name']. '</div>';
if ($user['id'] != $user_id) {
echo'<div class="menu">';
echo '<form action="'.$home.'/account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '/positions" method="post">' .
'<input type="radio" value="0" name="rights" ' . (!$user['rights'] ? 'checked="checked"' : '') . '/> <span style="color:#000000;"><b>Thành Viên</b></span><br />' .
'<input type="radio" value="4" name="rights" ' . ($user['rights'] == 4 ? 'checked="checked"' : '') . '/> <span style="color:#1d7ca8;"><b>Tria Mod</b></span><br />' .
'<input type="radio" value="3" name="rights" ' . ($user['rights'] == 3 ? 'checked="checked"' : '') . '/> <span style="color:#008000;"><b>Mod</b></span><br />' .
'<input type="radio" value="6" name="rights" ' . ($user['rights'] == 6 ? 'checked="checked"' : '') . '/> <span style="color:#7f1ea6;"><b>Smod</b></span><br />';
if ($rights == 9) {
echo '<input type="radio" value="7" name="rights" ' . ($user['rights'] == 7 ? 'checked="checked"' : '') . '/> <span style="color:#ff0000;"><b>Admin</b></span><br />' .
'<input type="radio" value="9" name="rights" ' . ($user['rights'] == 9 ? 'checked="checked"' : '') . '/> <span style="color:#ff0000;"><b>Sáng Viên</b></span><br />';

echo '</div>';
}
}
echo '<div class="menu"><input type="submit" value="Chọn chức" name="submit" /></div>' .
    '</form>';
echo '</div>';
require_once ("../incfiles/end.php");
?>