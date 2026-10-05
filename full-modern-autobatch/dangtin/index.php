<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

define('_IN_JOHNCMS', 1);

$headmod = 'news';
require('../incfiles/core.php');
$lng_news = core::load_lng('news'); // Загружаем язык модуля
$textl = $lng['news'];
require('../incfiles/head.php');
switch ($do) {
    case 'add':
        /*
        -----------------------------------------------------------------
        Добавление новости
        -----------------------------------------------------------------
        */
        if ($rights >= 6) {
            echo '<div class="danhmuc">Thông báo</div>';
            $old = 20;
            if (isset($_POST['submit'])) {
                $error = array();
                $name = isset($_POST['name']) ? functions::check($_POST['name']) : false;
                $text = isset($_POST['text']) ? trim($_POST['text']) : false;
                if (!$name)
                    $error[] = $lng_news['error_title'];
                if (!$text)
                    $error[] = $lng_news['error_text'];
                $flood = functions::antiflood();
                if ($flood)
                    $error[] = $lng['error_flood'] . ' ' . $flood . '&#160;' . $lng['seconds'];
                if (!$error) {
                    $rid = 0;
                    if (!empty($_POST['pf']) && ($_POST['pf'] != '0')) {
                        $pf = intval($_POST['pf']);
                        $rz = $_POST['rz'];
                        $pr = $connect->query("SELECT * FROM `forum` WHERE `refid` = '$pf' AND `type` = 'r'");
                        while ($pr1 = $connect->fetch_array($pr)) {
                            $arr[] = $pr1['id'];
                        }
                        foreach ($rz as $v) {
                            if (in_array($v, $arr)) {
                                $connect->query("INSERT INTO `forum` SET
                                    `refid` = '$v',
                                    `type` = 't',
                                    `time` = '" . time() . "',
                                    `user_id` = '$user_id',
                                    `from` = '$login',
                                    `text` = '$name'
                                ");
                                $rid = mysql_insert_id();
                                $connect->query("INSERT INTO `forum` SET
                                    `refid` = '$rid',
                                    `type` = 'm',
                                    `time` = '" . time() . "',
                                    `user_id` = '$user_id',
                                    `from` = '$login',
                                    `ip` = '" . long2ip($ip) . "',
                                    `soft` = '" . mysql_real_escape_string($agn) . "',
                                    `text` = '" . mysql_real_escape_string($text) . "'
                                ");
                            }
                        }
                    }
                    $connect->query("INSERT INTO `news` SET
                        `time` = '" . time() . "',
                        `avt` = '$login',
                        `name` = '$name',
                        `text` = '" . mysql_real_escape_string($text) . "',
                        `kom` = '$rid'
                    ");
                    $connect->query("UPDATE `users` SET
                        `lastpost` = '" . time() . "'
                        WHERE `id` = '$user_id'
                    ");
                    echo '<p>' . $lng_news['article_added'] . '<br /><a href="index.php">' . $lng_news['to_news'] . '</a></p>';
                } else {
                    echo functions::display_error($error, '<a href="index.php">' . $lng_news['to_news'] . '</a>');
                }
            } else {
                echo '<form action="index.php?do=add" method="post"><div class="menu">' .
                     '<p><h3>' . $lng_news['article_title'] . '</h3>' .
                     '<input type="text" name="name"/></p>' .
                     '<p><h3>' . $lng['text'] . '</h3>' .
                     '<textarea rows="' . $set_user['field_h'] . '" name="text"></textarea></p>';
                $fr = $connect->query("SELECT * FROM `account` WHERE `type` = 'f'");
                echo '<input type="hidden" name="pf" value="0" checked="checked" />';
                echo '</p></div><div class="menu">' .
                     '<input type="submit" name="submit" value="Đăng tin"/>' .
                     '</div></form>';
            }
        } else {
            header("location: index.php");
        }
        break;

    case 'edit':
        /*
        -----------------------------------------------------------------
        Редактирование новости
        -----------------------------------------------------------------
        */
        if ($rights >= 6) {
            echo '<div class="danhmuc">Thông báo</div>';
            if (!$id) {
                echo functions::display_error($lng['error_wrong_data'], '<a href="index.php">' . $lng_news['to_news'] . '</a>');
                require('../incfiles/end.php');
                exit;
            }
            if (isset($_POST['submit'])) {
                $error = array();
                if (empty($_POST['name']))
                    $error[] = $lng_news['error_title'];
                if (empty($_POST['text']))
                    $error[] = $lng_news['error_text'];
                $name = functions::check($_POST['name']);
                $text = mysql_real_escape_string(trim($_POST['text']));
                if (!$error) {
                    $connect->query("UPDATE `news` SET
                        `name` = '$name',
                        `text` = '$text'
                        WHERE `id` = '$id'
                    ");
                } else {
                    echo functions::display_error($error, '<a href="index.php?act=edit&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
                }
                echo '<p>' . $lng_news['article_changed'] . '<br /><a href="index.php">' . $lng['continue'] . '</a></p>';
            } else {
                $req = $connect->query("SELECT * FROM `news` WHERE `id` = '$id'");
                $res = $connect->fetch_assoc($req);
                echo '<div class="menu"><form action="index.php?do=edit&amp;id=' . $id . '" method="post">' .
                     '<p><h3>' . $lng_news['article_title'] . '</h3>' .
                     '<input type="text" name="name" value="' . $res['name'] . '"/></p>' .
                     '<p><h3>' . $lng['text'] . '</h3>' .
                     '<textarea rows="' . $set_user['field_h'] . '" name="text">' . htmlentities($res['text'], ENT_QUOTES, 'UTF-8') . '</textarea></p>' .
                     '<p><input type="submit" name="submit" value="' . $lng['save'] . '"/></p>' .
                     '</form></div>';
            }
        echo'</div>';
        } else {
            header('location: index.php');
        }
        break;

    case 'clean':
        /*
        -----------------------------------------------------------------
        Чистка новостей
        -----------------------------------------------------------------
        */
        if ($rights >= 7) {
        echo '<div class="danhmuc">Thông báo</div>';
            if (isset($_POST['submit'])) {
                $cl = isset($_POST['cl']) ? intval($_POST['cl']) : '';
                switch ($cl) {
                    case '1':
                        // Чистим новости, старше 1 недели
                        $connect->query("DELETE FROM `news` WHERE `time`<='" . (time() - 604800) . "'");
                        $connect->query("OPTIMIZE TABLE `news`");
                        echo '<p>' . $lng_news['clear_week_confirmation'] . '</p><p><a href="index.php">' . $lng_news['to_news'] . '</a></p>';
                        break;

                    case '2':
                        // Проводим полную очистку
                        $connect->query("TRUNCATE TABLE `news`");
                        echo '<p>' . $lng_news['clear_all_confirmation'] . '</p><p><a href="index.php">' . $lng_news['to_news'] . '</a></p>';
                        break;
                    default :
                        // Чистим сообщения, старше 1 месяца
                        $connect->query("DELETE FROM `news` WHERE `time`<='" . (time() - 2592000) . "'");
                        $connect->query("OPTIMIZE TABLE `news`;");
                        echo '<p>' . $lng_news['clear_month_confirmation'] . '</p><p><a href="index.php">' . $lng_news['to_news'] . '</a></p>';
                }
            } else {
                
            }

        } else {
            header("location: index.php");
        }
        break;

    case 'del':
        /*
        -----------------------------------------------------------------
        Удаление новости
        -----------------------------------------------------------------
        */
        if ($rights >= 6) {
            echo '<div class="danhmuc">Thông báo</div>';
            echo '<div class="menu">';
            if (isset($_GET['yes'])) {
                $connect->query("DELETE FROM `news` WHERE `id` = '$id'");
                echo '<p>' . $lng_news['article_deleted'] . '<br/><a href="index.php">' . $lng_news['to_news'] . '</a></p>';
            } else {
                echo '<p>' . $lng['delete_confirmation'] . '<br/>' .
                     '<a href="index.php?do=del&amp;id=' . $id . '&amp;yes">' . $lng['delete'] . '</a> | <a href="index.php">' . $lng['cancel'] . '</a></p>';
            }
 echo'</div>';
        } else {
            header("location: index.php");
        }
        break;

    default:
        /*
        -----------------------------------------------------------------
        Вывод списка новостей
        -----------------------------------------------------------------
        */
        echo '<div class="danhmuc">Thông báo</div>';
        if ($rights >= 6)
            echo '<div class="topmenu"><a href="index.php?do=add">' . $lng['add'] . '</a> | <a href="index.php?do=clean">' . $lng['clear'] . '</a></div>';
        $req = $connect->query("SELECT COUNT(*) FROM `news`");
        $total = mysqli_result($req, 0);
        $req = $connect->query("SELECT * FROM `news` ORDER BY `time` DESC LIMIT $start, $kmess");
        $i = 0;
        while ($res = $connect->fetch_array($req)) {
            echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
            $text = functions::checkout($res['text'], 1, 1);
            if ($set_user['smileys'])
                $text = functions::smileys($text, 1);
            echo '<b>' . $res['name'] . '</b><br/>' .
                 '<span class="gray"><small>' . $lng['author'] . ': ' . $res['avt'] . ' (' . functions::display_date($res['time']) . ')</small></span>' .
                 '<br />' . $text . '<div class="gray">';
            if ($res['kom'] != 0 && $res['kom'] != "") {
                $mes = $connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `refid` = '" . $res['kom'] . "'");
                $komm = mysqli_result($mes, 0) - 1;
                if ($komm >= 0)
                    echo '<a href="../forum/' . $res['kom'] . '.html"><b>' . $lng_news['discuss_on_forum'] . '</b> (' . $komm . ')</a><br/>';
            }
            if ($rights >= 6) {
                echo '<a href="index.php?do=edit&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a> | ' .
                     '<a href="index.php?do=del&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>';
            }
            echo '</div></div>';
            ++$i;
        }
            
        echo '<div class="phdr">' . $lng['total'] . ':&#160;' . $total . '</div>';
        if ($total > $kmess) {
            echo '<div class="topmenu">' . functions::display_pagination('index.php?', $start, $total, $kmess) . '</div>' .
                 '<p><form action="index.php" method="post">' .
                 '<input type="text" name="page" size="2"/>' .
                 '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
        }
}

require('../incfiles/end.php');
?>