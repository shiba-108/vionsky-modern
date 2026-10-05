<?php

define('_IN_JOHNCMS', 1);
require('incfiles/core.php');
$lng_faq = core::load_lng('faq');
$lng_smileys = core::load_lng('smileys');
$textl = 'Biểu cảm';
require('incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Biểu cảm</div>';
if (empty($_SESSION['ref'])) {
    $_SESSION['ref'] = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : $home;
}
if(!$user_id) {
header('Location: /');
}
$user_ = 20;

switch ($act) {

    case 'smusr':
        /*
        -----------------------------------------------------------------
        Каталог пользовательских Смайлов
        -----------------------------------------------------------------
        */
        $dir = glob(ROOTPATH . 'images/smileys/user/*', GLOB_ONLYDIR);
        foreach ($dir as $val) {
            $val = explode('/', $val);
            $cat_list[] = array_pop($val);
        }
        $cat = isset($_GET['cat']) && in_array(trim($_GET['cat']), $cat_list) ? trim($_GET['cat']) : $cat_list[0];
        $smileys = glob(ROOTPATH . 'images/smileys/user/' . $cat . '/*.{gif,jpg,png}', GLOB_BRACE);
        $total = count($smileys);
        $end = $start + $kmess;
        if ($end > $total) $end = $total;
        if ($total) {
            if ($user_id) {
                $user_sm = isset($datauser['smileys']) ? unserialize($datauser['smileys']) : '';
                if (!is_array($user_sm)) $user_sm = array();
            }
            if ($total > $kmess) echo '<div class="topmenu">' . functions::display_pagination('smileys.php?act=smusr&amp;cat=' . urlencode($cat) . '&amp;', $start, $total, $kmess) . '</div>';
            for ($i = $start; $i < $end; $i++) {
                $smile = preg_replace('#^(.*?).(gif|jpg|png)$#isU', '$1', basename($smileys[$i], 1));
                echo $i % 2 ? '<div class="menu list-top">' : '<div class="menu list-top">';
                echo '<img src="../images/smileys/user/' . $cat . '/' . basename($smileys[$i]) . '" alt="" />&#160;:' . $smile . ':';
                echo '</div>';
            }
        } else {
            echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
        }
        if ($total > $kmess) {
            echo '<div class="menu list-top">' . functions::display_pagination('smileys.php?act=smusr&amp;cat=' . urlencode($cat) . '&amp;', $start, $total, $kmess) . '</div>';
       }
        break;
    default:

        $dir = glob(ROOTPATH . 'images/smileys/user/*', GLOB_ONLYDIR);
        foreach ($dir as $val) {
            $cat = explode('/', $val);
            $cat = array_pop($cat);
            if (array_key_exists($cat, $lng_smileys)) {
                $smileys_cat[$cat] = $lng_smileys[$cat];
            } else {
                $smileys_cat[$cat] = ucfirst($cat);
            }
        }
        asort($smileys_cat);
        $i = 0;
        foreach ($smileys_cat as $key => $val) {
            echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
            echo '<a href="smileys.php?act=smusr&amp;cat=' . urlencode($key) . '">' . htmlspecialchars($val) . '</a>' .
                ' (' . count(glob(ROOTPATH . 'images/smileys/user/' . $key . '/*.{gif,jpg,png}', GLOB_BRACE)) . ')';
            echo '</div>';
            ++$i;
        }

}
echo '</div>';
require('incfiles/end.php');