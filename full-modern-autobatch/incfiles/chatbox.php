<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chatbox</div>';
$id = intval(trim(abs($_GET['id'])));
if(!isset($_GET['id'])) {
if(isset($_POST['submit'])) {
$noidung = bbcode::notags($noidung);
$noidung = isset($_POST['text']) ? functions::checkin(functions::autolink(trim($_POST['text']))) : '';
$noidung = functions::camtubay($noidung);
if(empty($_POST['text'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['text']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['text']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='".$noidung."', `time`='".time()."'");
$trave = isset($_POST['trave']) ? base64_decode($_POST['trave']) : 'index.php';
header("Location: $home");
}
}
$trave = base64_encode($_SERVER['REQUEST_URI']);
if($user_id){
echo '<div class="menu list-bottom">';
echo'<form name="text" action="'.$home.'" method="post">';
echo'<input name="text" type="text">';
echo'<input type="submit" name="submit" value="Gửi"/>';
echo'</form>';
echo'</div>';
} else {
echo'<div class="luuy" style="margin: 0px -3px;">Hãy là thành viên để chat .Code mod by Đức Nghĩa!</div>';
}

$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT 5");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<a href="/account/'.$vina4u['user_id'].'">'.nick($vina4u['user_id']).'</a>: ';

$vina4u['text'] = functions::noscrip($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
echo' <span style="font-size:11px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>';
if ($rights >= 3) {echo' <span style="font-size:11px;"><a href="/teamchat/del.php?id='.$vina4u['id'].'">[x]</a></span>';}
echo'</div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có ai chát .code mod by Đức Nghĩa!</div>';
}
}
echo '<div class="menu">»&#160;<a href="'.$home.'/teamchat/">Xem Thêm</a></div>';
echo'</div>';
?>