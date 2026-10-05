<?php

/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

defined('_IN_JOHNADM') or die('Error: restricted access');

// Проверяем права доступа
if ($rights < 9) {
    header('Location: http://johncms.com/?err');
    exit;
}

$user = false;
$error = false;
if ($id && $id != $user_id) {
    // Получаем данные юзера
    $req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id'");
    if ($req) { {
        $user = $connect->fetch_assoc($req);
        if ($user['rights'] > $datauser['rights'])
            $error = $lng['error_usrdel_rights'];
    } else {
        $error = $lng['error_user_not_exist'];
    }
} else {
    $error = $lng['error_wrong_data'];
}
if (!$error) {
    // Считаем комментарии в галерее
    $comm_gal = ($connect->query("SELECT COUNT(*) FROM `gallery` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'km'")->fetch_row()[0] ?? 0);
    // Считаем комментарии в библиотеке
    $comm_lib = ($connect->query("SELECT COUNT(*) FROM `lib` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'komm'")->fetch_row()[0] ?? 0);
    // Считаем комментарии к загрузкам
    $comm_dl = ($connect->query("SELECT COUNT(*) FROM `download` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'komm'")->fetch_row()[0] ?? 0);
    // Считаем посты в личных гостевых
    $comm_gb = ($connect->query("SELECT COUNT(*) FROM `cms_users_guestbook` WHERE `user_id` = '" . $user['id'] . "'")->fetch_row()[0] ?? 0);
    // Считаем комментарии в личных альбомах
    $comm_al = ($connect->query("SELECT COUNT(*) FROM `cms_album_comments` WHERE `user_id` = '" . $user['id'] . "'")->fetch_row()[0] ?? 0);
    $comm_count = $comm_gal + $comm_lib + $comm_dl + $comm_gb + $comm_al;
    // Считаем посты в Гостевой
    $guest_count = ($connect->query("SELECT COUNT(*) FROM `guest` WHERE `user_id` = '" . $user['id'] . "'")->fetch_row()[0] ?? 0);
    // Считаем созданные темы на Форуме
    $forumt_count = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 't' AND `close` != '1'")->fetch_row()[0] ?? 0);
    // Считаем посты на Форуме
    $forump_count = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 'm'  AND `close` != '1'")->fetch_row()[0] ?? 0);
    echo '<div class="phdr"><a href="index.php"><b>' . $lng['admin_panel'] . '</b></a> | ' . $lng['user_del'] . '</div>';
    // Выводим краткие данные
    echo '<div class="user"><p>' . functions::display_user($user, array (
        'lastvisit' => 1,
        'iphist' => 1
    )) . '</p></div>';

    switch ($mod) {

        case 'del':
            /*
            -----------------------------------------------------------------
            Удаляем личные данные
            -----------------------------------------------------------------
            */
            // Удаляем личную Гостевую
            $connect->query("DELETE FROM `cms_users_guestbook` WHERE `sub_id` = '" . $user['id'] . "'");
            // Удаляем личные Фотоальбомы
            $req = $connect->query("SELECT * FROM `cms_album_files` WHERE `user_id` = '" . $user['id'] . "'");
            if ($req) { {
                while ($res = $connect->fetch_assoc($req)) {
                    // Удаляем файлы картинок
                    @unlink('../files/users/album/' . $user['id'] . '/' . $res['img_name']);
                    @unlink('../files/users/album/' . $user['id'] . '/' . $res['tmb_name']);
                    // Удаляем комментарии к файлам
                    $connect->query("DELETE FROM `cms_album_comments` WHERE `sub_id` = '" . $res['id'] . "'");
                }
            }
            rmdir('../files/users/album/' . $user['id']);
            $connect->query("DELETE FROM `cms_album_files` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_album_cat` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_album_downloads` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_album_views` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_album_votes` WHERE `user_id` = '" . $user['id'] . "'");

            // Удаляем файлы юзера из почты
            $req = $connect->query("SELECT * FROM `cms_mail` WHERE (`user_id` OR `from_id` = '" . $user['id'] . "') AND `file_name` != ''");
            if ($req) { {
                while ($res = $connect->fetch_assoc($req)) {
                    // Удаляем файлы почты
                    if ($res['file_name']) {
                            if (file_exists('../files/mail/' . $res['file_name']) !== false)
                                @unlink('../files/mail/' . $res['file_name']);
                            }
                    }
                }
            // Удаляем почту
            $connect->query("DELETE FROM `cms_mail` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_mail` WHERE `from_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_contact` WHERE `user_id` = '" . $user['id'] . "'");
            $connect->query("DELETE FROM `cms_contact` WHERE `from_id` = '" . $user['id'] . "'");

            // Удаляем карму
            $connect->query("DELETE FROM `karma_users` WHERE `karma_user` = '" . $user['id'] . "'");
            // Удаляем комментарии
            if (isset($_POST['comments'])) {
                if ($comm_gal) {
                    // Удаляем из Галреи
                    $connect->query("DELETE FROM `gallery` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'km'");
                }
                if ($comm_lib) {
                    // Удаляем из Библиотеки
                    $connect->query("DELETE FROM `lib` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'komm'");
                }
                if ($comm_dl) {
                    // Удаляем из Загрузок
                    $connect->query("DELETE FROM `download` WHERE `avtor` = '" . $user['name'] . "' AND `type` = 'komm'");
                }
                if ($comm_gb) {
                    // Удаляем комментарии из личных гостевых
                    $connect->query("DELETE FROM `cms_users_guestbook` WHERE `user_id` = '" . $user['id'] . "'");
                }
                if ($comm_al) {
                    // Удаляем комментарии из личных фотоальбомов
                    $connect->query("DELETE FROM `cms_album_comments` WHERE `user_id` = '" . $user['id'] . "'");
                }
            }
            // Удаляем посты в Гостевой
            if ($guest_count && isset($_POST['guest'])) {
                $connect->query("DELETE FROM `guest` WHERE `user_id` = '" . $user['id'] . "'");
            }
            // Скрываем темы на форуме
            if ($forumt_count && isset($_POST['forum'])) {
                $connect->query("UPDATE `forum` SET `close` = '1', `close_who` = '$login' WHERE `type` = 't' AND `user_id` = '" . $user['id'] . "'");
            }
            // Скрываем посты на форуме
            if (isset($_POST['forum'])) {
                $connect->query("UPDATE `forum` SET `close` = '1', `close_who` = '$login' WHERE `type` = 'm' AND `user_id` = '" . $user['id'] . "'");
            }
            // Удаляем метки прочтения на Форуме
            $connect->query("DELETE FROM `cms_forum_rdm` WHERE `user_id` = '" . $user['id'] . "'");
            // Удаляем историю нарушений
            $connect->query("DELETE FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "'");
            // Удаляем историю IP
            $connect->query("DELETE FROM `cms_users_iphistory` WHERE `user_id` = '" . $user['id'] . "'");
            // Удаляем пользователя
            $connect->query("DELETE FROM `users` WHERE `id` = '" . $user['id'] . "'");
            // Оптимизируем таблицы
            $connect->query("OPTIMIZE TABLE `cms_users_iphistory` , `cms_ban_users` , `guest`, `cms_album_comments`, `cms_users_guestbook`, `karma_users`, `cms_album_votes`, `cms_album_views`, `cms_album_downloads`, `cms_album_cat`, `cms_album_files`, `cms_forum_rdm`");
            echo '<div class="rmenu"><p><h3>' . $lng['user_deleted'] . '</h3></p></div>';
            break;

        default:
            ////////////////////////////////////////////////////////////
            // Форма параметров удаления                              //
            ////////////////////////////////////////////////////////////
            echo '<form action="index.php?act=usr_del&amp;mod=del&amp;id=' . $user['id'] . '" method="post"><div class="menu"><p><h3>' . $lng['user_del_activity'] . '</h3>';
            if ($comm_count)
                echo '<div><input type="checkbox" value="1" name="comments" checked="checked" />&#160;' . $lng['comments'] . ' <span class="red">(' . $comm_count . ')</span></div>';
            if ($guest_count)
                echo '<div><input type="checkbox" value="1" name="guest" checked="checked" />&#160;' . $lng['guestbook'] . ' <span class="red">(' . $guest_count . ')</span></div>';
            if ($forumt_count || $forump_count) {
                echo '<div><input type="checkbox" value="1" name="forum" checked="checked" />&#160;' . $lng['forum'] . ' <span class="red">(' . $forumt_count . '&nbsp;/&nbsp;' . $forump_count . ')</span></div>';
                echo '<small><span class="gray">' . $lng['user_del_forumnote'] . '</span></small>';
            }
            echo '</p></div><div class="rmenu"><p>' . $lng['user_del_confirm'];
            echo '</p><p><input type="submit" value="' . $lng['delete'] . '" name="submit" />';
            echo '</p></div></form>';
            echo '<div class="phdr"><a href="../users/profile.php?user=' . $user['id'] . '">' . $lng['to_form'] . '</a></div>';
    }
} else {
    echo functions::display_error($error);
}
echo '<p><a href="index.php?act=users">' . $lng['users_list'] . '</a><br /><a href="index.php">' . $lng['admin_panel'] . '</a></p>';
?>