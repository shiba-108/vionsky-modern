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
$textl = 'Sửa thông tin '. $user['name'] . ''; 
require('../incfiles/head.php');
if ($user['id'] != $user_id && ($rights < 7 || $user['rights'] > $rights)) {
    header('Location: '.$home.'/account/'.$user['id'].'');
    require('../incfiles/end.php');
    exit;
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Sửa thông tin</div>';
if ($rights >= 7 && $rights > $user['rights'] && $act == 'reset') {
    $connect->query("UPDATE `users` SET `set_user` = '', `set_forum` = '', `set_chat` = '' WHERE `id` = '" . $user['id'] . "'");
    echo '<div class="menu"><p>' . $lng['settings_default'] . '<br /><a href="profile.php?user=' . $user['id'] . '">' . $lng['to_form'] . '</a></p></div>';
    require('../incfiles/end.php');
    exit;
}
if (isset($_GET['delavatar'])) {

    @unlink('../files/users/avatar/' . $user['id'] . '.png');
    echo '<div class="menu">' . $lng_profile['avatar_deleted'] . '</div>';
} elseif (isset($_GET['delphoto'])) {

    @unlink('../files/users/photo/' . $user['id'] . '.jpg');
    @unlink('../files/users/photo/' . $user['id'] . '_small.jpg');
    echo '<div class="rmenu">' . $lng_profile['photo_deleted'] . '</div>';
} elseif (isset($_POST['submit'])) {

    $error = array ();
    $user['imname'] = isset($_POST['imname']) ? functions::check(mb_substr($_POST['imname'], 0, 25)) : '';
    $user['facebook'] = isset($_POST['facebook']) ? functions::check(mb_substr($_POST['facebook'], 0, 50)) : '';
    $user['dayb'] = isset($_POST['dayb']) ? intval($_POST['dayb']) : 0;
    $user['monthb'] = isset($_POST['monthb']) ? intval($_POST['monthb']) : 0;
    $user['yearofbirth'] = isset($_POST['yearofbirth']) ? intval($_POST['yearofbirth']) : 0;
    $user['about'] = isset($_POST['about']) ? functions::check(mb_substr($_POST['about'], 0, 500)) : '';
    $user['mibile'] = isset($_POST['mibile']) ? functions::check(mb_substr($_POST['mibile'], 0, 40)) : '';
    $user['mail'] = isset($_POST['mail']) ? functions::check(mb_substr($_POST['mail'], 0, 40)) : '';
    $user['mailvis'] = isset($_POST['mailvis']) ? 1 : 0;
    $user['icq'] = isset($_POST['icq']) ? intval($_POST['icq']) : 0;
    $user['skype'] = isset($_POST['skype']) ? functions::check(mb_substr($_POST['skype'], 0, 40)) : '';
    $user['jabber'] = isset($_POST['jabber']) ? functions::check(mb_substr($_POST['jabber'], 0, 40)) : '';
    $user['www'] = isset($_POST['www']) ? functions::check(mb_substr($_POST['www'], 0, 40)) : '';
    // Данные юзера (для Администраторов)
    $user['name'] = isset($_POST['name']) ? functions::check(mb_substr($_POST['name'], 0, 20)) : $user['name'];
    $user['status'] = isset($_POST['status']) ? functions::check(mb_substr($_POST['status'], 0, 50)) : '';
    $user['karma_off'] = isset($_POST['karma_off']);
    $user['sex'] = isset($_POST['sex']) && $_POST['sex'] == 'm' ? 'm' : 'zh';
    $user['tienxu'] = isset($_POST['tienxu']) ? functions::check(mb_substr($_POST['tienxu'], 0, 500)) : ''; 
    $user['vinaxu'] = isset($_POST['vinaxu']) ? functions::check(mb_substr($_POST['vinaxu'], 0, 500)) : ''; 
    $user['cauca'] = isset($_POST['cauca']) ? functions::check(mb_substr($_POST['cauca'], 0, 500)) : ''; 
    $user['level'] = isset($_POST['level']) ? functions::check(mb_substr($_POST['level'], 0, 500)) : ''; 
    $user['chisolevel'] = isset($_POST['chisolevel']) ? functions::check(mb_substr($_POST['chisolevel'], 0, 500)) : ''; 
    $user['rights'] = isset($_POST['rights']) ? abs(intval($_POST['rights'])) : $user['rights'];
    // Проводим необходимые проверки
    if($user['rights'] > $rights || $user['rights'] > 9 || $user['rights'] < 0)
        $user['rights'] = 0;
    if ($rights >= 7) {
        if (mb_strlen($user['name']) < 2 || mb_strlen($user['name']) > 20)
            $error[] = $lng_profile['error_nick_lenght'];
        $lat_nick = functions::rus_lat(mb_strtolower($user['name']));
        if (preg_match("/[^0-9a-z\-\@\*\(\)\?\!\~\_\=\[\]]+/", $lat_nick))
            $error[] = $lng_profile['error_nick_symbols'];
    }
    if ($user['dayb'] || $user['monthb'] || $user['yearofbirth']) {
        if ($user['dayb'] < 1 || $user['dayb'] > 31 || $user['monthb'] < 1 || $user['monthb'] > 12)
            $error[] = $lng_profile['error_birth'];
    }
    if ($user['icq'] && ($user['icq'] < 10000 || $user['icq'] > 999999999))
        $error[] = $lng_profile['error_icq'];
    if (!$error) {
        $connect->query("UPDATE `users` SET
            `imname` = '" . $user['imname'] . "',
            `facebook` = '" . $user['facebook'] . "',
            `dayb` = '" . $user['dayb'] . "',
            `monthb` = '" . $user['monthb'] . "',
            `yearofbirth` = '" . $user['yearofbirth'] . "',
            `about` = '" . $user['about'] . "',
            `mibile` = '" . $user['mibile'] . "',
            `mail` = '" . $user['mail'] . "',
            `mailvis` = '" . $user['mailvis'] . "',
            `icq` = '" . $user['icq'] . "',
            `skype` = '" . $user['skype'] . "',
            `jabber` = '" . $user['jabber'] . "',
            `www` = '" . $user['www'] . "'
            WHERE `id` = '" . $user['id'] . "'
        ");
        if ($rights >= 7) {
            $connect->query("UPDATE `users` SET
                `name` = '" . $user['name'] . "',
                `tienxu` = '" . $user['tienxu'] . "',
                `cauca` = '" . $user['cauca'] . "',
                `level` = '" . $user['level'] . "',
                `chisolevel` = '" . $user['chisolevel'] . "',
                `status` = '" . $user['status'] . "',
                `karma_off` = '" . $user['karma_off'] . "',
                `sex` = '" . $user['sex'] . "',
                `rights` = '" . $user['rights'] . "'
                WHERE `id` = '" . $user['id'] . "'
            ");
        }
        if ($rights == 9) {
            $connect->query("UPDATE `users` SET
                `vinaxu` = '" . $user['vinaxu'] . "'
                WHERE `id` = '" . $user['id'] . "'
            ");
        }


        echo '<div class="menu">' . $lng_profile['data_saved'] . '</div>';
    } else {
        echo functions::display_error($error);
    }
    header('Location: /account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '');
    exit;
}

echo '<form action="'.$home.'/account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '/edit" method="post">';
$link = '';
echo'<div class="menu">Điện thoại<br/><input type="text" value="' . $user['mibile'] . '" name="mibile" /></div>';
echo'<div class="menu">Facebook<br/><input type="text" value="' . $user['facebook'] . '" name="facebook" /></div>';
echo'<div class="menu">Email<br/><input type="text" value="' . $user['mail'] . '" name="mail" /></div>';
echo'<div class="menu"><input type="radio" value="m" name="sex" ' . ($user['sex'] == 'm' ? 'checked="checked"' : '') . '/> Nam</div>' .
    '<div class="menu"><input type="radio" value="zh" name="sex" ' . ($user['sex'] == 'zh' ? 'checked="checked"' : '') . '/> Nữ</div>';
if ($rights >= 7) {
echo'<div class="menu">Xu <input type="text" value="' . $user['tienxu'] . '" name="tienxu" /></div>';
}
if ($rights >= 9) {
echo'<div class="menu">VinaXu <input type="text" value="' . $user['vinaxu'] . '" name="vinaxu" /></div>';
}
if ($rights >= 7) {
echo'<div class="menu">Cá <input type="text" value="' . $user['cauca'] . '" name="cauca" /></div>';
echo'<div class="menu">Level <input type="text" value="' . $user['level'] . '" name="level" size="1"/><input type="text" value="' . $user['chisolevel'] . '" name="chisolevel" size="1"/>%</div>';
}
echo '<div class="menu"><input type="submit" value="' . $lng['save'] . '" name="submit" /></div>' .
    '</form>';
echo '</div>';
require_once ("../incfiles/end.php");
?>