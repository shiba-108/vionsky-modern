<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$id = intval(abs($_GET['doctin']));
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `baivietgiaitri` WHERE `type` = '1' AND `id`='".$id."'"));
$getimgmeta = $connect->fetch_array($connect->query("SELECT `noidung` FROM `baivietgiaitri` WHERE `type` = '1' AND  `id`='".$id."' ORDER BY `id` ASC LIMIT 1"));
if(preg_match('#\[img\](https?://.+?)\[\/img\]#i', $getimgmeta['noidung'], $Img)) {
$imgmeta = ''.$Img[1].'';
}
if ($id) {
$textl= $thongtin['tieude'];
$mota = $thongtin['noidung'];
} else {
$textl= 'Hack Game - Mod Game';
$mota = 'Cập nhật các bản hack mod game mới nhất, các bản hack hỗ trợ trên thị trường !';
}
require('../incfiles/head.php');
if ($id) {
switch ($act) { 
default:
$connect->query("UPDATE baivietgiaitri SET xem = xem + 1 WHERE id = $id");
$thongtin['tieude'] = html_entity_decode($thongtin['tieude'], ENT_QUOTES, 'UTF-8');
$thongtin['tieude'] = functions::checkout($thongtin['tieude'], 1, 1);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/> <h1>'.$thongtin['tieude'].'</h1>';
?>
<?php if ($rights >= 1) { ?>
    <a href="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>/rename">[R]</a>
    <a href="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>/edit">[E]</a>
    <a href="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>/ganurl">[U]</a>
    <a href="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>/delete">[X]</a>
   <? } ?>
<?php
echo'</div>';
echo'<div class="menu list-bottom congdong"><img src="/icon/forum/view.png" alt="icon" style="vertical-align: -3px;"/> Lượt xem: '.$thongtin[xem].' - Đăng '.thoigian($thongtin[time]).'</div>';
echo'<div class="menu list-bottom"><img src="/icon/facebook.png" alt="icon" style="vertical-align: -3px;"/> <a href="https://m.facebook.com/sharer.php?u='.$urlhientai.'">Chia sẻ bài này lên facebook</a></div>';
echo'<div class="menu list-bottom"><img src="/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Nguồn: '.$thongtin['nguon'].'</a></div>';
echo'<div class="menu">';
if($thongtin['html'] == 0){
$thongtin['noidung'] = html_entity_decode($thongtin['noidung'], ENT_QUOTES, 'UTF-8');
$thongtin['noidung'] = functions::checkout($thongtin['noidung'], 1, 1);
echo functions::smileys(bbcode::tags($thongtin['noidung']));
echo'</div>';
} else {
echo $thongtin['noidung'];
}
$ganlink = $connect->query("SELECT * FROM `baivietgiaitri_url` WHERE `baiviet` = '" .$id."'");
if ($connect->query("SELECT * FROM ...")$ganlink) > 0) {
while ($vina4u_ganurl = $connect->fetch_assoc($ganlink)) {					
echo '<div class="download"><img src="/icon/down.png" alt="download" />&#160;';
echo '<a href="'.$vina4u_ganurl['url'].'" title="'.$thongtin['tieude'].'" style="color:red" rel="nofollow"><b>'.$vina4u_ganurl['tieude'].'</b></a>';
if($rights >= 7){
echo '&#160;<a href="'.$urlhientai.'/ganurl/edit/'.$vina4u_ganurl['id'].'">[E]</a>&#160;<a href="'.$urlhientai.'/ganurl/del/'.$vina4u_ganurl['id'].'">[X]</a>';
}
echo '</div>';
}} 
echo'</div>';
break;
case 'edit':
include'sys/edit.php';
break;
case 'rename':
include'sys/rename.php';
break;
case 'delete':
include'sys/delete.php';
break;
case 'ganurl':
include'sys/ganurl.php';
break;
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Còn nhiều bản hack nữa</div>';
$truyvan = $connect->query("SELECT * FROM `baivietgiaitri` WHERE `type` = '1' AND `id`!= '".$id."' ORDER BY `time` DESC LIMIT 7");
while ($blogs = $connect->fetch_array($truyvan)) { 
?>
  <div class="menu list-bottom">
  <img src="/icon/game.png" alt="icon" style="vertical-align: -3px;"/>
  <a href="<?php echo $home; ?>/hackgame/<?php echo $blogs[id]; ?>-<?php echo functions::khongdau($blogs['tieude']); ?>"><?php echo mb_substr($blogs['tieude'], 0, 100); ?></a>

 </div>
<?php $i++;} ?>
<div class="menu congdong">
<a href="/hackgame/">Còn nhiều lắm vào xem thêm</a>
</div>
</div>
<?php
} else {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><h1>Hack Game Cập Nhật</h1></div>';
echo'<div class="menu list-bottom congdong"><a href="/hackgame/vietbai.php"><input type="button" value="Viết bài mới"/></a></div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `baivietgiaitri` WHERE `type` = '1'")->fetch_row()[0] ?? 0);
$truyvan = $connect->query("SELECT * FROM `baivietgiaitri` WHERE `type` = '1' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($blogs = $connect->fetch_array($truyvan)) { 
?>
  <div class="menu list-bottom">
  <img src="/icon/game.png" alt="icon" style="vertical-align: -3px;"/>
  <a href="<?php echo $home; ?>/hackgame/<?php echo $blogs[id]; ?>-<?php echo functions::khongdau($blogs['tieude']); ?>"><?php echo mb_substr($blogs['tieude'], 0, 100); ?></a>

 </div>
<?php $i++;} ?>
<?php if ($tong > $kmess) { echo '<div class="menu">' . functions::phan_trang('/hackgame/', $start, $tong, $kmess) . '</div>'; } ?>
<?php echo'</div>'; 
}
require('../incfiles/end.php');
?>