<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$active = 1;
$active2 = 'class="active"';
switch ($act) { 
default:
//// set_forum
$set_forum = $user_id && !empty($datauser['set_forum']) ? unserialize($datauser['set_forum']) : array(
    'farea'    => 0,
    'upfp'     => 0,
    'preview'  => 1,
    'postclip' => 1,
    'postcut'  => 2
);
////
$id = intval(abs($_GET['id']));
$idnhom = intval(abs($_GET['idnhom']));
$tieude = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$thanhviennhom = $connect->fetch_array($connect->query("SELECT `rights` FROM `nhom_user` WHERE `id` = '".$tieude[groups]."' AND `user_id` = '".$user_id."'"));
$metamota = $connect->fetch_array($connect->query("SELECT `text` FROM `forum` WHERE `refid` = '".$id."'"));
$getimgmeta = $connect->fetch_array($connect->query("SELECT `text` FROM `forum` WHERE `refid`='".$id."' ORDER BY `id` ASC LIMIT 1"));
$kiemtra = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `id`='$id'")->fetch_row()[0] ?? 0);
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$tieude[groups]."'"));
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$id."'")->fetch_row()[0] ?? 0);
if ($kiemtra == 0) {
$textl = 'Lỗi truy vấn';
} else {
$textl = $tieude[text];
$mota = $metamota[text];
if(preg_match('#\[img\](https?://.+?)\[\/img\]#i', $getimgmeta['text'], $Img)) {
$imgmeta = $Img[1];
}
}
require ('../../incfiles/head.php');
if ($hoinhom[id] == $idnhom) {
//////////////// bao loi truy van
if ($kiemtra == 0) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu" style="color:red">Bài viết không tồn tại hoặc đã bị xoá !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
require('../../incfiles/end.php');
exit;
}
/////////////// het
if ($tieude[type]!== 't') {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu" style="color:red">Bài viết này là một bình luận nên hệ thống không thể truy vấn !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo'</div>';
require ('../../incfiles/end.php');
exit;
}
if ($tieude[duyet] == '0' && $rights <= 0 && $user_id!=$tieude[user_id] && $thanhviennhom[rights] == 0) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bài viết chờ kiểm duyệt</div>';
echo '<div class="menu">Hiện tại bài viết này đang được BQT kiểm duyệt nên chưa thể hiển thị, nếu bài viết không vi phạm nội quy bài viết của bạn sẽ được duyệt !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo'</div>';
require ('../../incfiles/end.php');
exit;
}
if ($tieude[duyet] == '0' && $rights <= 0 && $thanhviennhom[rights] == 0) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bài viết chờ kiểm duyệt</div>';
echo '<div class="menu">Hiện tại bài viết này đang được BQT kiểm duyệt nên chưa thể hiển thị, nếu bài viết không vi phạm nội quy bài viết của bạn sẽ được duyệt !</div>';
echo'</div>';
}
?>
<?php $total = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$id."'")->fetch_row()[0] ?? 0); ?>
<?php $connect->query("UPDATE forum SET xem = xem + 1 WHERE id = $id"); ?>
<?php $urlforum = $home.'/groups/'.$hoinhom[id].'/forum/'.$id; ?>
<div class="main-xmenu">
<div class="danhmuc"><img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/> <h1><?php echo htmlspecialchars($tieude[text]); ?></h1></div>
<?php if ($tieude[duyet] == '0' && $rights >= 3 || $tieude[duyet] == '0' && $thanhviennhom[rights] > 0) { ?>
<?php if (isset($_POST['duyetbai'])) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$tieude[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$tieude[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$id."',
            `type` = 'd'
        ");
$connect->query("UPDATE `forum` SET `duyet` = '1' WHERE id = $id");
header("Location: $home/groups/$hoinhom[id]/forum/$id");
}
$lydohuybai = $_POST['lydohuybai'];
if (isset($_POST['huybaingay'])) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$tieude[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$tieude[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$id."',
            `mota` = '".$lydohuybai."',
            `type` = 'f'
        ");
$connect->query("DELETE FROM `forum` WHERE `id`='{$id}'");
$connect->query("DELETE FROM `forum` WHERE `refid`='{$id}'");
header("Location: $home");
}
if (isset($_POST['huybai'])) {
echo'<form method="post">
<div class="menu list-bottom congdong">Lý do hủy bài (Báo cho bạn ấy biết)</div>
<input name="lydohuybai" type="text"><br/>
<input type="submit" name="huybaingay" value="Huỷ bài" />
</form>';
echo'</div>';
require ('../../incfiles/end.php');
exit;
} ?>
<form method="post">
<div class="menu list-bottom" style="color:green">Bạn có muốn duyệt cho bài viết này không<br/>
<input type="submit" name="duyetbai" value="Duyệt" /> <input type="submit" name="huybai" value="Huỷ bài" />
</form>
</div>
<?php } ?>
<div class="menu list-bottom congdong" xmlns:v="http://rdf.data-vocabulary.org/#">
<img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> 
<span typeof="v:Breadcrumb">
<a title="Hội Nhóm" href="<?php echo $home; ?>/groups" rel="v:url" property="v:title"><h2>Hội Nhóm</h2></a>
</span> › 
<span typeof="v:Breadcrumb">
<a title="<?php echo $hoinhom[name]; ?>" href="<?php echo $home; ?>/groups/<?php echo $hoinhom[id]; ?>" rel="v:url" property="v:title"><h3><?php echo $hoinhom[name]; ?></h3></a>
</span> › 
<span typeof="v:Breadcrumb">
<a title="Forum" href="<?php echo $home; ?>/groups/<?php echo $hoinhom[id]; ?>/forum" rel="v:url" property="v:title"><h4>Forum</h4></a>
</span>
</div>
<div class="menu list-bottom">
<img src="/icon/facebook.png" alt="icon" style="vertical-align: -3px;"/> 
<a href="https://m.facebook.com/sharer.php?u=<?php echo $urlforum; ?>">Chia sẻ bài viết này lên facebook</a>
</div>
<div class="menu list-bottom">
<img src="/icon/forum/view.png" alt="icon" style="vertical-align: -3px;"/> Lượt xem: <?php echo $tieude[xem]; ?>
</div>
<div class="menu list-bottom">
<img src="/icon/forum/comment.png" alt="icon" style="vertical-align: -3px;"/> Bình luận: <?php echo $commentforum; ?>
</div>
        <?php if ($rights >= 3 || $thanhviennhom[rights] > 0) { ?>
<div class="menu list-bottom hot">
    <a href="<?php echo $urlforum; ?>/rename">Đổi tên chủ đề</a> <span style="font-size:11px;color:#e2e2e2;">|</span>
    <a href="<?php echo $urlforum; ?>/delete">Xóa chủ đề</a> <span style="font-size:11px;color:#e2e2e2;">|</span>
   <?php if ($tieude[close] == '0') { ?>
    <a href="<?php echo $urlforum; ?>/close">Đóng cửa</a>
     <?php } else { ?>
    <a href="<?php echo $urlforum; ?>/unclose">Mở của</a>
   <? } ?>
</div>
   <? } ?>

<?php if ($total > $kmess){echo '<div class="menu list-bottom congdong">' . functions::phan_trang('/groups/'.$hoinhom[id].'/forum/'.$id.'/', $start, $total, $kmess) . '</div>';} ?>
<div class="menu">
<?php $req = $connect->query("SELECT * FROM `forum` WHERE `refid` = '".$id."' ORDER BY `id` LIMIT $start, $kmess"); ?>
<?php while($baiviet = $connect->fetch_array($req)) { ?>
<?php $thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$baiviet['user_id']}'")); ?>
<?php $nhanvat = $connect->fetch_array($connect->query("SELECT `hp` FROM `nhanvat` WHERE `user_id`='{$baiviet['user_id']}'")); ?>
<?php $like = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `post_like` = '".$baiviet['id']."' AND `user_id`='".$user_id."'")->fetch_row()[0] ?? 0); ?>
<?php $quote = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$baiviet['quote']."'")); ?>
<?php $ban = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '" .$baiviet['user_id']. "'")->fetch_row()[0] ?? 0); ?>
 <?php echo $i % 2 ? '<div class="menu">' : '<div class="menu">'; ?>
 <table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td class="list_post">
     <div id="post-<?php echo $baiviet['id']; ?>">
       <img class="item" src="<?php echo $home; ?>/avatar/<?php echo $baiviet['user_id']; ?>.png" alt="<?php echo $baiviet['name']; ?>"/>
       <div class="forum_baiviet">Bài:<?php echo $thongtin['postforum']; ?></div>
       </td><td class="current-blog">
       <div class="users">
       <?php echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.gif" alt="offline"/> ' : '<img src="/icon/online.gif" alt="online"/>  '); ?>
       <a href="/account/<?php echo $baiviet['user_id']; ?>"><b><?php echo nick($baiviet['user_id']); ?></b></a>
       <span class="right">
       <?php if (!empty($thongtin['nguoiyeu'])) { ?>
       <a href="/account/<?php echo $thongtin['nguoiyeu']; ?>"><img src="/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/></a>
       <?php } ?>
       </span>
<?php
$dh = $connect->query("SELECT * FROM danhhieu WHERE user_id = '".$thongtin['id']."' ORDER BY id DESC");
$cdh = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE user_id = '".$thongtin['id']."'")->fetch_row()[0] ?? 0);
If($cdh >=1){
Echo'<img src="/icon/medal_gold_1.png" width="10" height="10"> ';
}
while ($xdh = $connect->fetch_array($dh)){
If($xdh['cap'] ==1){$mdh = 'blue';}
If($xdh['cap'] ==2){$mdh = 'red';}
If($xdh['cap'] ==3){$mdh = 'purple';}
Echo '<small><font color="'.$mdh.'">[<b>'.$xdh['text'].'</b>]</font></small>';
}
?>
       </div>
     <div class="box_ndung_bviet">
     <?php if ($baiviet[quote]) { ?> 
     <div class="forum_quote_user">Trích dẫn bạn <?php echo nick($quote['user_id']); ?></div>
     <div class="forum_quote">
     <?php $quote['text'] = html_entity_decode($quote['text'], ENT_QUOTES, 'UTF-8'); ?>
     <?php $quote['text'] = functions::checkout($quote['text'], 1, 1); ?>
     <?php echo functions::smileys(bbcode::tags(mb_substr($quote['text'], 0, 200))); ?>
     </div>
     <?php } ?>
     <?php if($ban > 0) { ?>
     <?php echo'******bài viêt ẩn******'; ?>
     <?php } else { ?>
     <?php $baiviet['text'] = html_entity_decode($baiviet['text'], ENT_QUOTES, 'UTF-8'); ?>
     <?php $baiviet['text'] = functions::checkout($baiviet['text'], 1, 1);
?>
     <?php echo functions::smileys(bbcode::tags($baiviet['text'])); ?>
     <?php } ?>
     <div class="forum_time"><?php echo functions::thoigian($baiviet['time']); ?></div>
     </div>
<?php $urlforumpost = $home.'/groups/'.$hoinhom[id].'/forum/'.$baiviet['id']; ?>


<?php $ganlink = $connect->query("SELECT * FROM `ganurl` WHERE `refid` = '" .$baiviet['id']."'");
if ($connect->query("SELECT * FROM ...")$ganlink) > 0) {
while ($vina4u_ganurl = $connect->fetch_assoc($ganlink)) {					
echo '<div class="download"><img src="/icon/down.png" alt="download" />&#160;';
echo '<a href="'.$vina4u_ganurl['url'].'"><b>'.$vina4u_ganurl['tenurl'].'</b></a>';
if($rights >= 7){
echo '&#160;<a href="'.$urlforumpost.'">[E]</a>&#160;<a href="'.$urlforumpost.'/ganurl/del/'.$vina4u_ganurl['id'].'">[X]</a>';
}
echo '</div>';
}} ?>

     <?php if ($user_id) { ?>
     <div class="forum_menu">
     <?php if ($baiviet['user_id']!== ''.$user_id.'' && $user_id) { ?>
     <?php if ($like == '0') { ?>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/like">Like</a>
     <?php } else { ?>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/dislike">UnLike</a>
     <?php } ?>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/quote">Trích</a>
     <?php } ?>
     <?php if ($baiviet['user_id'] == $user_id || $rights >= 3) { ?>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/ganurl">Gắn Url</a>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/edit">Sửa</a>
       <a class="forum_buton" href="<?php echo $urlforumpost; ?>/del">Xóa</a>
     <?php } ?>
     <?php } ?>
  </div>
   <?php $nhanlike = $connect->query("SELECT * FROM `hoinhom_forum_like` WHERE `post_like` = '".$baiviet['id']."'"); ?>
   <?php $tonglike = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `post_like` = '".$baiviet['id']."'")->fetch_row()[0] ?? 0); ?>
     <?php if ($tonglike > '0') { ?>
     <div class="forum_like">
     [<b>Like <?php echo $tonglike; ?></b>]
   <?php while($forumlike = $connect->fetch_array($nhanlike)) { ?>
     <?php echo nick($forumlike[user_id]); ?>,
     <?php } ?>
     </div>
     <?php } ?>
     </td></tr></tbody></table></div>
     <?php } ?>
<?php if ($total > $kmess){echo '<div class="menu list-bottom congdong">' . functions::phan_trang('/groups/'.$hoinhom[id].'/forum/'.$id.'/', $start, $total, $kmess) . '</div>';} ?>
</div>
</div>


<?php
if ($user_id) {
if ($tieude[duyet]!=0) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bình luận bài viết</div>';
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid`='".$id."'")->fetch_row()[0] ?? 0) / $kmess);
if ($tieude[close] == '0') {
$noidung = functions::checkin($_POST['noidung']);
if (isset($_POST['submit'])) {
if(empty($noidung)) {
echo '<div class="menu list-bottom congdong">Bạn chưa nội dung bình luận !</div>';
} else if (mb_strlen($noidung) <= 5) {
echo '<div class="menu list-bottom congdong">Nội dung bài viết phải trên 4 kí tự nhé !</div>';
} else {
$connect->query("UPDATE `users` SET `postforum`= `postforum` + '1' WHERE `id`='".$user_id."'");
$connect->query("UPDATE `forum` SET `time`= '" . time() . "' WHERE `id`='".$id."'");
        $connect->query("INSERT INTO `forum` SET
            `refid` = '".$id."',
            `time` = '" . time() . "',
            `user_id` = '".$user_id."',
            `from` = '".$login."',
            `text` = '".$noidung."',
            `groups` = '".$hoinhom[id]."',
            `pages` = '".$pagetopic."'
        ");
$postup = mysql_insert_id();
if ($tieude[user_id] !== ''.$user_id.'') {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$tieude[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$tieude[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$id."',
            `post` = '".$postup."',
            `pages` = '".$pagetopic."',
            `type` = 'c'
        ");
}
if ($pagetopic == 1){
header("Location: /groups/$hoinhom[id]/forum/$id#post-$postup");
} else {
header("Location: /groups/$hoinhom[id]/forum/$id/page/$pagetopic#post-$postup");
}
}
}
echo'<form method="post">';
echo'<div style="padding: 4px 0px">';
echo'<textarea name="noidung" type="text" placeholder="Trả lời bình luận"></textarea>';
echo'</div>';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</div>';
} else {
echo'<div class="menu" style="color:red"><img src="/icon/closed-topic.png" alt="icon" style="vertical-align: -3px;"/> Bài viết bị đóng cửa nên bạn không thể bình luận !</div>';
echo'</div>';
}
}
}
} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu" style="color:red">Không tìm thấy được bài viết ở hội nhóm này !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
}
break;
case 'quote':
include'sys/trichdan.php';
break;
case 'like':
include'sys/like.php';
break;
case 'dislike':
include'sys/dislike.php';
break;
case 'edit':
include'sys/edit.php';
break;
case 'del':
include'sys/del.php';
break;
case 'rename':
include'sys/rename.php';
break;
case 'close':
include'sys/close.php';
break;
case 'unclose':
include'sys/unclose.php';
break;
case 'delete':
include'sys/delete.php';
break;
case 'ganurl':
include'sys/ganurl.php';
break;
}
require ('../../incfiles/end.php');