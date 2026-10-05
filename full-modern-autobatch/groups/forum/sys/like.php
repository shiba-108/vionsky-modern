<?php
$textl = 'Like bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$topic_like = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$kiemtra = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `post_like`='$id'")->fetch_row()[0] ?? 0);
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid`='".$topchinh[refid]."'")->fetch_row()[0] ?? 0) / $kmess);

if ($kiemtra == 0) {
        $connect->query("INSERT INTO `hoinhom_forum_like` SET
            `topic_like` = '".$topic_like[id]."',
            `post_like` = '".$id."',
            `time` = '" . time() . "',
            `user_id` = '".$user_id."',
            `groups` = '".$topic_like[groups]."'
        ");
if ($topchinh[user_id] !== ''.$user_id.'') {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$topchinh[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$topchinh[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$topic_like[id]."',
            `post` = '".$id."',
            `pages` = '".$topchinh[pages]."',
            `type` = 'l'
        ");
if ($rights >= 9) {
$connect->query("UPDATE `users` SET `vinaxu`= `vinaxu` + '1' WHERE `id`='".$topchinh[user_id]."'");
}
}
if ($topic_like[groups] == 0) {
if ($topchinh[pages] == 1 || $topchinh[pages] == 0) {
header("Location: /users/forum/$topchinh[refid]#post-$id");
}
if ($topchinh[pages] > 1){
header("Location: /users/forum/$topchinh[refid]/page/$topchinh[pages]#post-$id");
}
} else {
if ($topchinh[pages] == 1 || $topchinh[pages] == 0) {
header("Location: /groups/$topic_like[groups]/forum/$topchinh[refid]#post-$id");
}
if ($topchinh[pages] > 1){
header("Location: /groups/$topic_like[groups]/forum/$topchinh[refid]/page/$topchinh[pages]#post-$id");
}
}

} else {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Like bài viết</div>';
echo '<div class="menu">Bạn đã like bài viết này rồi nhé !</div>';
echo '<div class="menu list-top congdong"><a href="/groups/'.$topic_like[groups].'/forum/'.$topic_like[id].'">Trở về bài viết</a></div>';
echo'</div>';
}

?>