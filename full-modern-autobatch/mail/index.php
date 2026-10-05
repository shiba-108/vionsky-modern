<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$congdong = ' id="selected"';
$hopthu = 'style="color:#838c01"';
$lng_mail = core::load_lng('mail');
if (isset($_SESSION['ref']))
    unset($_SESSION['ref']);

//Проверка авторизации
if (!$user_id) {
    Header('Location: ' . $home . '/?err');
    exit;
}

function formatsize($size)
{
    // Форматирование размера файлов
    if ($size >= 1073741824) {
        $size = round($size / 1073741824 * 100) / 100 . ' Gb';
    } elseif ($size >= 1048576) {
        $size = round($size / 1048576 * 100) / 100 . ' Mb';
    } elseif ($size >= 1024) {
        $size = round($size / 1024 * 100) / 100 . ' Kb';
    } else {
        $size = $size . ' b';
    }

    return $size;
}

// Массив подключаемых функций
$mods = array(
    'ignor',
    'write',
    'systems',
    'deluser',
    'load',
    'files',
    'input',
    'output',
    'delete',
    'new'
);

//Проверка выбора функции
if ($act && ($key = array_search($act, $mods)) !== FALSE && file_exists('includes/' . $mods[$key] . '.php')) {
    require('includes/' . $mods[$key] . '.php');
} else {
$textl = $lng['mail'];
require_once('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tin nhắn mới</div>';
$total = ($connect->query("SELECT COUNT(*) FROM (SELECT DISTINCT `user_id` FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `spam`='0') a;")->fetch_row()[0] ?? 0);
if($total == 1) {
    //Если все новые сообщения от одного итого же чела показываем сразу переписку
    $max = ($connect->query("SELECT `user_id`, count(*) FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `spam`='0' GROUP BY `user_id`")->fetch_row()[0] ?? 0);
    Header('Location: /mail/'.$max);
    exit();
}
if($total) {
	if($total > $kmess) echo '<div class="topmenu">' . functions::display_pagination('index.php?act=new&amp;', $start, $total, $kmess) . '</div>';
	//Групируем по контактам
	$query = $connect->query("SELECT `users`.* FROM `cms_mail`
		LEFT JOIN `users` ON `cms_mail`.`user_id`=`users`.`id`
		LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`user_id`
		WHERE `cms_mail`.`from_id`='" . $user_id . "' AND `cms_mail`.`read`='0' AND `cms_mail`.`spam`='0' GROUP BY `cms_mail`.`user_id` ORDER BY `cms_contact`.`time` DESC LIMIT " . $start . "," . $kmess
    );
	for ($i = 0; ($row = $connect->fetch_assoc($query)) !== false; ++$i) {
		echo $i % 2 ? '<div class="list3">' : '<div class="list3">';
		$subtext = '<a href="/mail/' . $row['id'] . '">' . $lng_mail['correspondence'] . '</a> | <a href="index.php?act=deluser&amp;id=' . $row['id'] . '">' . $lng['delete'] . '</a> | <a href="index.php?act=ignor&amp;id=' . $row['id'] . '&amp;add">' . $lng_mail['ban_contact'] . '</a>';
		$count_message = ($connect->query("SELECT COUNT(*) FROM `cms_mail` WHERE ((`user_id`='{$row['id']}' AND `from_id`='$user_id') OR (`user_id`='$user_id' AND `from_id`='{$row['id']}')) AND `delete`!='$user_id' AND `spam`='0';")->fetch_row()[0] ?? 0);
		$new_count_message = ($connect->query("SELECT COUNT(*) FROM `cms_mail` WHERE `cms_mail`.`user_id`='{$row['id']}' AND `cms_mail`.`from_id`='$user_id' AND `read`='0' AND `delete`!='$user_id' AND `spam`='0';")->fetch_row()[0] ?? 0);
		$arg = array(
		'header' => '('.$count_message. ($new_count_message ? '/<span class="red">+' . $new_count_message . '</span>' : '') . ')',
		'sub' => $subtext
		);
		echo functions::display_user($row, $arg);
		echo '</div>';
	}
} else {
echo '<div class="menu">Hiện tại bạn chưa có ai tin nhắn !</div>';

}
if ($total > $kmess) {
    echo '<div class="topmenu">' . functions::display_pagination('index.php?act=new&amp;', $start, $total, $kmess) . '</div>';
}
}
echo '</div>';
require_once('../incfiles/end.php');