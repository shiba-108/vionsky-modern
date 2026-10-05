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
$textl = 'Đổi mật khẩu '. $user['name'] . ''; 
require('../incfiles/head.php');
$lng_pass = core::load_lng('pass');
        echo'<div class="main-xmenu">';
        echo '<div class="danhmuc">' . $lng_pass['change_password'] . ' ' . $user['name'] . '</div>';
if ($user['id'] != $user_id && ($rights < 7 || $user['rights'] > $rights)) {
header('Location: '.$home.'');
    exit;
}
if(isset($_POST['submit'])) {
        $error = array ();
        $oldpass = isset($_POST['oldpass']) ? trim($_POST['oldpass']) : '';
        $newpass = isset($_POST['newpass']) ? trim($_POST['newpass']) : '';
        $newconf = isset($_POST['newconf']) ? trim($_POST['newconf']) : '';
        $autologin = isset($_POST['autologin']) ? 1 : 0;
        if ($user['id'] != $user_id) {
            if (!$newpass || !$newconf)
                echo'<div class="menu list-bottom hot" style="margin-top: -2px"><b style="color:red">dczcvxz</b></div>';
        } else {
            if (!$oldpass || !$newpass || !$newconf)
                echo'<div class="menu list-bottom hot" style="margin-top: -2px"><b style="color:red">Bạn chưa nhập mật khẩu</b></div>';
        }
        if (!$error && $user['id'] == $user_id && md5(md5($oldpass)) !== $user['password'])
                echo'<div class="menu list-bottom hot" style="margin-top: -2px"><b style="color:red">Mật khẩu mới không trùng khớp nhau</b></div>';
        if ($newpass != $newconf)
            $error[] = $lng_pass['error_new_password'];
        if (preg_match("/[^\da-zA-Z_]+/", $newpass) && !$error)
            $error[] = $lng['error_wrong_symbols'];
        if (!$error && (strlen($newpass) < 3 || strlen($newpass) > 10))
            $error[] = $lng_pass['error_lenght'];
        if (!$error) {
            // Записываем в базу
            $connect->query("UPDATE `users` SET `password` = '" . mysql_real_escape_string(md5(md5($newpass))) . "' WHERE `id` = '" . $user['id'] . "'");
            // Проверяем и записываем COOKIES
            if (strlen($oldpass)!== 0 && isset($_COOKIE['cuid']) && isset($_COOKIE['cups']))
                setcookie('cups', md5($newpass), time() + 3600 * 24 * 365);
            echo '<div class="menu list-bottom hot" style="margin-top: -2px"><b style="color:green">' . $lng_pass['password_changed'] . '</b></div>';
        } else {

        }
}
        echo '<form method="post">';
        if ($user['id'] == $user_id)
            echo '<div class="menu list-bottom congdong"><p>' . $lng_pass['input_old_password'] . ':<br /><input type="password" name="oldpass" /></p></div>';
        echo '<div class="gmenu"><p>' . $lng_pass['input_new_password'] . ':<br />' .
            '<input type="password" name="newpass" /><br />' . $lng_pass['repeat_password'] . ':<br />' .
            '<input type="password" name="newconf" /></p><br/>' .
            '<p><input type="submit" value="' . $lng['save'] . '" name="submit" />' .
            '</p></div></form>';
       echo'</div>';

require('../incfiles/end.php');
?>