<?php
$textl = 'DisLike bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$topic_like = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$kiemtra = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `post_like`='$id'")->fetch_row()[0] ?? 0);
if ($kiemtra == 0) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">DisLike bài viết</div>';
echo '<div class="menu">Bạn đã DisLike bài viết này rồi nhé !</div>';
echo '<div class="menu list-top congdong"><a href="/groups/'.$topic_like[groups].'/forum/'.$topic_like[id].'">Trở về bài viết</a></div>';
echo'</div>';
} else {
$connect->query("DELETE FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `post_like`='".$id."'");
Echo 'Dislike thành công!';
if ($topic_like[groups] == 0) {
if ($topchinh[pages] == 1 || $topchinh[pages] == 0) {
header("Location: /users/forum/$topchinh[refid]#post-$id");
}
if ($topchinh[pages] > 1){
header("Location: /users/forum/$topchinh[refid]/page/$topchinh[pages]#post-$id");
}
} else {
if ($topchinh[pages] == 1){
if ($topchinh[pages] == 1 || $topic_like[pages] == 0) {
header("Location: /groups/$topic_like[groups]/forum/$topchinh[refid]#post-$id");
}
if ($topchinh[pages] > 1){
header("Location: /groups/$topic_like[groups]/forum/$topchinh[refid]/page/$topchinh[pages]#post-$id");
}
}
}
}
?>