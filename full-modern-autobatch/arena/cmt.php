<?php
$dcmt = ($connect->query("SELECT COUNT(*) FROM `arena_cmt` WHERE `sid`='$id' AND `type`='0'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chat</div>';
if(isset($_POST['dang'])) {
$text = isset($_POST['text']) ? functions::checkin(functions::autolink(trim($_POST['text']))) : '';
if(empty($text)) {
echo '<div class="tb">Chưa nhập nội dung!</div>';
} else {
$connect->query("INSERT INTO `arena_cmt` SET `sid`='".$id."',`user_id`='".$user_id."',`text`='".$text."', `time`='".time()."'");
header("Location: phong.php?id=$id");
}
}
echo '<div class="menu"><form method="post"><textarea name="text" cows="3"></textarea><br/><input type="submit" name="dang" value="Đăng" /></form></div>';
if($dcmt) {
$cmt=$connect->query("SELECT * FROM `arena_cmt` WHERE `sid`='".$id."' ORDER BY `time` DESC LIMIT $start,$kmess");
while($vina4u = $connect->fetch_array($cmt)) {
echo'<div class="menu list-top"><a href="/account/'.$res['user_id'].'">'.nick($vina4u['user_id']).'</a> ';
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
echo '<span class="xam">('.functions::thoigian($vina4u['time']).')</span></div>';
}
if($dcmt > $kmess){ echo '<div class="menu list-top">' . functions::display_pagination('phong.php?id='.$id.'&', $start, $dcmt, $kmess) . '</div>';
} } else {
echo '<div class="menu"></div>';
}
echo '</div>';
?>
