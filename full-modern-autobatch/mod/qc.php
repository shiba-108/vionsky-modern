<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}

$textl = 'Nộp Link QC cho Đức Nghĩa';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Nộp Link QC</b></div>';
if(isset($_POST['submit'])){
$link = functions::checkout($_POST['link']);

$rand = rand(0,0);
$u = $connect->fetch_array($connect->query("SELECT name FROM users WHERE id = '$nguoinhan'"),0);
if(empty($link)) {echo 'Nhập link đi rồi gửi';} 

else if($datauser['quangcao'] < 0 ) 
{
echo 'Bạn hết lượt gửi rồi. Hãy điểm danh hằng ngày để lấy lượt gửi';
} 





else {


if($rand == 1) {
echo '<div class="menu list-top">Bạn vừa gửi link quảng cáo hôm nay thành công</div>';
$connect->query("UPDATE `users` SET `quangcao`=`quangcao` - '1' WHERE `id`='".$user_id."'");
$connect->query("INSERT INTO `quangcao` SET `user`='" . $user_id . "',`link`='$link',`duyet`='0'");
$time = time();
$bot = ' @'.$login.' vừa gửi link quảng cáo hôm nay :))';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '256',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");



} 
}
}else{
echo '' .
'<div class="list1"><img src="/avatar/5002.png"> • Tích cực quảng cáo để nhận được nhiều phần thưởng xứng đáng!</b><br><form method="post">' .
'Link QC Hôm Nay: 
<textarea rows="5" name="link">' . htmlspecialchars($link) . '</textarea>' .

'<br/>' .
'<input type="submit" value="Gửi Cho Admin" name="submit" /><br />' .'</div>';
}
echo '<div class="phdr"><a href="/index.php">' . $lng['back'] . '</a></div></div>';
require_once('../incfiles/end.php');
?>