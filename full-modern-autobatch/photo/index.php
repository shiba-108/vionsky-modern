<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$id = intval(abs($_GET['anh']));
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `photo` WHERE `id`='".$id."'"));
if ($id) {
$textl = $thongtin['tieude'];
$mota = 'Tổng hợp những hình ảnh mới nhất vui nhất cập nhật từng ngày từ thành viên !';
$imgmeta = ''.$home.'/photo/images/'.$id.'.jpg';
} else {
$textl = 'Ảnh Vui - Ảnh Hài - Kho Ảnh Vina4u';
$mota = 'Tổng hợp những hình ảnh mới nhất vui nhất cập nhật từng ngày từ thành viên !';
$truyvanmeta = $connect->query("SELECT * FROM `photo` ORDER BY `id` DESC LIMIT 1");
while ($metaicon = $connect->fetch_array($truyvanmeta)) { 
$imgmeta = ''.$home.'/photo/images/'.$metaicon[id].'.jpg';
}
}
$active = 1;
$active4 = 'class="active"';
require ('../incfiles/head.php');
require('../incfiles/lib/class.upload.php');
include('func.php'); 

if ($id) {
switch ($act) { 
default:
$connect->query("UPDATE photo SET view = view + 1 WHERE id = $id");
$like = ($connect->query("SELECT COUNT(*) FROM `photo_like` WHERE `idphoto` = '".$id."' AND `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);
$tongcomment = ($connect->query("SELECT COUNT(*) FROM `photo_comment` WHERE `idphoto`='$id'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/> <h1>'.htmlspecialchars($thongtin['tieude']).'</h1>';
if ($rights >= 7) {
    echo' <a href="'.$home.''.$_SERVER['REQUEST_URI'].'/rename">[R]</a>';
    echo' <a href="'.$home.''.$_SERVER['REQUEST_URI'].'/delete">[X]</a>';
} 
echo'</div>';
echo'<div class="menu list-bottom congdong"><img src="/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Đăng ảnh bởi: '.nick($thongtin['user_id']).'</div>';
echo'<div class="menu list-bottom"><img src="/icon/facebook.png" alt="icon" style="vertical-align: -3px;"/> <a href="https://m.facebook.com/sharer.php?u='.$urlhientai.'">Chia sẻ ảnh này lên facebook</a></div>';
echo'<div class="menu list-bottom"><img src="/icon/timereg.png" alt="icon" style="vertical-align: -3px;"/> Lúc: '.functions::thoigian($thongtin['time']).'</div>';
echo'<div class="infophoto">';
echo'<img src="/photo/icon/view.png" alt="icon" style="vertical-align: -3px;"/> '.$thongtin['view'].'';
echo'<img src="/photo/icon/like.png" alt="icon" style="vertical-align: -3px;margin-left: 5px"/> '.$like.'';
echo'<img src="/photo/icon/comment.png" alt="icon" style="vertical-align: -3px;margin-left: 5px"/> '.$tongcomment.'';
echo'</div>';
echo '<div class="menu"><div class="post-content_full"><img id="images_post_full" src="/photo/images/'.$id.'.jpg" alt="'.$textl.'" /></div></div>';
if ($like == '0' && $user_id) {
echo'<div class="menu">';
echo'<a href="/photo/'.$id.'/like"><input type="button" value="Thích ảnh"/></a>';
echo'</div>';
}
?>
   <?php $nhanlike = $connect->query("SELECT * FROM `photo_like` WHERE `idphoto` = '".$id."'"); ?>
   <?php $tonglike = ($connect->query("SELECT COUNT(*) FROM `photo_like` WHERE `idphoto` = '".$id."'")->fetch_row()[0] ?? 0); ?>
     <?php if ($tonglike > '0') { ?>
     <div class="likephoto">
   <?php while($forumlike = $connect->fetch_array($nhanlike)) { ?>
     <?php echo nick($forumlike[user_id]); ?>, 
     <?php } ?>
     đã thích ảnh này
     </div>
     <?php } ?>
</div>
<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bình luận</div>';
if (!$user_id) {
echo'<div class="menu list-bottom hot" style="margin-top: -2px;">Hãy đăng nhập để chia sẻ bình luận cho bức ảnh này !</div>';
} else {
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid`='".$id."'")->fetch_row()[0] ?? 0) / $kmess);
$noidung = functions::checkin($_POST['noidung']);
if (isset($_POST['submit'])) {
if(empty($noidung)) {
echo '<div class="menu list-bottom congdong">Bạn chưa nội dung bình luận !</div>';
} else if (mb_strlen($noidung) <= 5) {
echo '<div class="menu list-bottom congdong">Nội dung bài viết phải trên 4 kí tự nhé !</div>';
} else {
        $connect->query("INSERT INTO `photo_comment` SET
            `idphoto` = '".$id."',
            `user_id` = '".$user_id."',
            `time` = '" . time() . "',
            `text` = '".$noidung."'
        ");
if ($thongtin[user_id] !== ''.$user_id.'') {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$tieude[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$thongtin[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$id."',
            `type` = 'i'
        ");
}
header("Location: /photo/$id#commentphoto");
}
}
echo'<form method="post">';
echo'<div style="padding: 4px 0px">';
echo'<textarea name="noidung" type="text" placeholder="Trả lời bình luận"></textarea>';
echo'</div>';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</form>';
}
echo'<div id="commentphoto"></div>';
if($tongcomment) {
$req = $connect->query("SELECT * FROM `photo_comment` WHERE `idphoto`='{$id}' ORDER BY `time` DESC LIMIT $start, $kmess");
$i = 0;
while ($res = $connect->fetch_array($req)) {
echo is_integer($i/2) ? '<div class="menu list-top">' : '<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
echo'<img class="avatar" src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'.$res['from'].'"/>';
$name = $connect->fetch_array($connect->query("SELECT `name`,`lastdate` FROM `users` WHERE `id`='{$res['user_id']}'"));
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $name['lastdate'] + 300 ? '<span style="color:red">[off]</span> ' : '<span style="color:green">[on]</span> ');
echo ''.($user_id && $user_id != $res['user_id'] ? '<a href="/account/'.$res['user_id'].'/">'.nick($res['user_id']).'</a>' : ''.nick($res['user_id']).'').' ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$ban = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$res['user_id']. "' AND `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$res['text'] = html_entity_decode($res['text'], ENT_QUOTES, 'UTF-8');
$res['text'] = functions::checkout($res['text'], 1, 1);
echo functions::smileys(bbcode::tags($res['text']));
}
echo'</div>';
echo' <span style="font-size:11px;color:#777;">' . functions::thoigian($res['time']) . '</span>';
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có bình luận mới !</div>';
}
if ($tongcomment > $kmess){
echo '<div class="menu list-top">' . functions::phantrang('/photo/'.$id.'/', $start, $tongcomment, $kmess) . '</div>';
}
echo'</div>';
break;
case 'like':
include'sys/like.php';
break;
case 'rename':
include'sys/rename.php';
break;
case 'delete':
include'sys/delete.php';
break;
}
} else {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Ảnh hài được cập nhật từng ngày !</div>';
if(isset($_POST['submit']) && $user_id) {
$tieude = functions::checkin($_POST['tieude']);
if(empty($tieude)) {
echo '<div class="menu list-bottom hot" style="margin-top: -2px;color:red;">Bạn chưa tiêu đề ảnh !</div>';
} else if (mb_strlen($tieude) <= 10) {
echo '<div class="menu list-bottom hot" style="margin-top: -2px;color:red;">Tiêu đề ảnh phải trên 10 kí tự nhé !</div>';
} else if (mb_strlen($tieude) >= 100) {
echo '<div class="menu list-bottom hot" style="margin-top: -2px;color:red;">Tiêu đề tối đa 100 kí tự nhé !</div>';
} else {
$file =  $_FILES['imagefile']['tmp_name'];
if(empty($file)) {
echo '<div class="menu list-bottom hot" style="margin-top: -2px;color:red;">Bạn chưa chọn ảnh để đăng nhé !</div>';
} else {
list($chieudai, $chieurong) = getimagesize($file);
if ($chieudai < 300) {
echo '<div class="menu list-bottom hot" style="margin-top: -2px;color:red;">Kích thước ảnh này quá nhỏ. Ảnh cho phép trên 300px thôi nhé !</div>';
} else {
$handle = new upload($_FILES['imagefile']);
if($handle->uploaded) {
@$connect->query("INSERT INTO `photo` SET 
`user_id` = '$user_id', 
`time` = '$time', 
`tieude` = '$tieude'
");
$id = mysql_insert_id();

$handle->file_new_name_body = ''.$id.'';
//$handle->mime_check = false;
$handle->allowed = array('image/jpeg','image/gif','image/png');
$handle->file_max_size = 1024*$set['flsz'];
$handle->file_overwrite = true;
$handle->image_resize = true;
if($chieudai > 350) {
$handle->image_x = 400;
}
if($chieudai > 400) {
$handle->image_x = 450;
}
if($chieudai > 500) {
$handle->image_x = 500;
}
$handle->image_ratio_y = true;
$handle->image_convert ='jpg';
$handle->process('images/');
if($handle->processed) {
$connect->query("UPDATE `users` SET `time_danganh`='".time()."', `tienxu` = `tienxu`+'1000' WHERE `id`='".$user_id."'");
$image = 'images/'.$id.'.jpg';
$save = 'images/'.$id.'.jpg';
$text = 'Đăng tại MXH: YEUDEHON.NET';
watermark($image, $text, $save);
header("Location: /photo/$id");
}
}
$handle->clean();
}
}
}
}


if (!$user_id) {
echo'<div class="menu hot" style="margin-top: -2px;">Hãy đăng nhập để chia sẻ các bức ảnh hay nhé !</div>';
} else {
$timep = $connect->fetch_array($connect->query("SELECT `time_danganh` FROM `users` WHERE `id`='{$user_id}'"));
if(($timep['time_danganh'] + 0) > time()) {
echo '<div class="menu congdong">Bạn có thể đăng ảnh vào <b>'.(($timep['time_danganh'] + 120) - time()).' giây </b> nữa nhé !</div>';
} else {
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu list-bottom hot" style="margin-top: -2px;">';
echo'<input name="tieude" type="text" placeholder="Nhập tiêu đề ảnh">';
echo '</div>';
echo'<div class="menu">';
echo'<input type="file" name="imagefile" value=""/><input type="hidden" name="MAX_FILE_SIZE" value="'. (1024 * $set['flsz']) .'"/><br/>';
echo'<input type="submit" name="submit" value="Chia sẻ ảnh" /></form>';
echo '</div>';
}
}
$tongphoto = ($connect->query("SELECT COUNT(*) FROM `photo`")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `photo` ORDER BY `time` DESC LIMIT $start, $kmess");
while($res = $connect->fetch_array($req)) {
echo'<div class="menu list-top congdong">';
echo'<a href="/photo/'.$res['id'].'"><b>'.htmlspecialchars($res['tieude']).'</b></a>';
echo'</div>';
echo'<div class="menu" style="color:#999;font-size:11px">';
echo'Đăng lúc '.functions::thoigian($res['time']).' bởi '.nick($res['user_id']).'';
echo'</div>';
$like = ($connect->query("SELECT COUNT(*) FROM `photo_like` WHERE `idphoto` = '".$res['id']."'")->fetch_row()[0] ?? 0);
$tongcomment = ($connect->query("SELECT COUNT(*) FROM `photo_comment` WHERE `idphoto`='".$res['id']."'")->fetch_row()[0] ?? 0);
echo'<div class="infophoto">';
echo'<img src="/photo/icon/view.png" alt="icon" style="vertical-align: -3px;"/> '.$res['view'].'';
echo'<img src="/photo/icon/like.png" alt="icon" style="vertical-align: -3px;margin-left: 5px"/> '.$like.'';
echo'<img src="/photo/icon/comment.png" alt="icon" style="vertical-align: -3px;margin-left: 5px"/> '.$tongcomment.'';
echo'</div>';
echo'<div class="post_baiviet">';
echo '<div class="menu"><div class="post-content"><a href="/photo/'.$res['id'].'"><img id="images_post" src="/photo/images/'.$res['id'].'.jpg" alt="image" /></a></div></div>';
echo'</div>';
}
if ($tongphoto > $kmess){
echo '<div class="menu list-top">' . functions::phan_trang('/photo/', $start, $tongphoto, $kmess) . '</div>';
}
echo'</div>';
}
require ('../incfiles/end.php');
