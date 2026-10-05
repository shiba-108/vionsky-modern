<?php
echo'<div class="danhmuc">Chatbox</div>';
if(isset($_POST['submitchat'])) {
$noidungchat = bbcode::notags($noidungchat);
$tg = $_POST['tg'];
$noidungchat = isset($_POST['noidungchat']) ? functions::checkin(trim($_POST['noidungchat'])) : '';
if(empty($_POST['noidungchat'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['noidungchat']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 1 kí tự</div>';
} else if(strlen($_POST['noidungchat']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 4000 kí tự</div>';
} else {
if($user_id){
if($tg !=1){
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.''.$_SERVER['REQUEST_URI'].'');
} else {
if($datauser['vinaxu'] <25){
echo '<font color=red>Không đủ tiền</font>';
} else {
$time = time() + 18;
$connect->query("UPDATE users SET vinaxu = vinaxu -25 WHERE id = $user_id");
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."', `show` = '1', timetg = '$time'");
header('Location: '.$home.''.$_SERVER['REQUEST_URI'].'');
}
}
}
}
}
?>
<?php if($user_id){ ?> 
   <form name="text" method="post">
     <textarea name="noidungchat" placeholder="Nhập nội dung chat"></textarea>
     <input type="checkbox" name="tg" value="1"> Thế giới (25 Vinaxu) <input type="submit" name="submitchat" value="Trò chuyện"/> 
   </form>
<?php } ?>
<?php if(isset($_POST['xoachat']) && $rights >= 6) {
header("Location: $home");
$connect->query("DELETE FROM `guest`");
} 
if(isset($_POST['dondep']) && $rights >= 6){
echo '<div class="menu"><form method="post"><input type="submit" name="xoachat" value="Dọn dẹp ngay" style="background: #d47070;"/></form></div>'; 
}
$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT 5");
for ($j = 0; $vina4u = $connect->fetch_assoc($req); ++$j) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'")); ?>
  <div class="menu">
<?php echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.gif" alt="icon" title="OFF"/> ' : '<img src="/icon/online.gif" alt="icon" title="ON"/> '); ?>
<a href="/account/<?php echo $vina4u['user_id']; ?>"><?php echo nick($vina4u['user_id']); ?></a>: 
<?php $ban = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '" .$vina4u['user_id']. "'")->fetch_row()[0] ?? 0); ?>
<?php if($ban > 0) { ?>
      ******bài viêt ẩn******
<?php } else { ?>
<?php $vina4u['text'] = functions::checkout($vina4u['text'], 1, 1); ?>
<?php echo functions::smileys(bbcode::tags($vina4u['text'])); ?>
<?php } ?>
<?php
if(isset($_GET['comment'])){
$id = intval(abs($_GET['del']));
if ($id && $id == $vina4u[id]) {
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home");
$connect->query("DELETE FROM `guest` WHERE `id` = '$id'");
} else {
echo '<div class="menu"><form method="post"><input type="submit" name="submit" value="Xoá comment" /></form></div>'; 
}
} else {
header("Location: $home");
}
}
}
echo '</div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có ai chát !</div>';
}
If($rights >=6){echo '<form method="post"><input type="submit" name="dondep" value="Dọn dẹp công viên"></form>';}
echo '<div style="padding: 6px"><a href="/congvien/"><img src="/systems/vao.gif" width="20" height="20"> Xem thêm »</a></div>';
?>