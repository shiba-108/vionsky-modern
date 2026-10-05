<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
$textl = $lng['mail'];
require_once('../incfiles/head.php');
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
echo '<div class="menu">hiện tại không có tin nhắn mới</div>';

}
if ($total > $kmess) {
    echo '<div class="topmenu">' . functions::display_pagination('index.php?act=new&amp;', $start, $total, $kmess) . '</div>';
}
$count_input = mysqli_result($connect->query("
	SELECT COUNT(*) 
	FROM `cms_mail` 
	LEFT JOIN `cms_contact` 
	ON `cms_mail`.`user_id`=`cms_contact`.`from_id` 
	AND `cms_contact`.`user_id`='$user_id' 
	WHERE `cms_mail`.`from_id`='$user_id' 
	AND `cms_mail`.`sys`='0' AND `cms_mail`.`delete`!='$user_id' 
	AND `cms_contact`.`ban`!='1' AND `spam`='0'"), 0);
echo '<div class="menu">';
echo '<a href="/mail/thu-den">Hộp thư đến</a> (' . $count_input . ')';
echo '</div>';
$count_output = mysqli_result($connect->query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`from_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' 
WHERE `cms_mail`.`user_id`='$user_id' AND `cms_mail`.`delete`!='$user_id' AND `cms_mail`.`sys`='0' AND `cms_contact`.`ban`!='1'"), 0);
echo '<div class="menu"><a href="/mail/thu-di">Hộp thư đã gửi</a> (' . $count_output . ')</div>';