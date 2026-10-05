<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Tạo nhóm mới';
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tạo Hội Nhóm</div>';
$xacnhan = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `user_id`='$user_id'")->fetch_row()[0] ?? 0);
if($rights == 9) {
$xacnhan = 0;
}
if($xacnhan >= 1) {
echo '<div class="menu">Bạn đã tạo một nhóm rồi nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$ten = functions::check($_POST['ten']);
$mota = $_POST['mota'];
$riengtu = intval($_POST['riengtu']);
$kt = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `name`='$ten'")->fetch_row()[0] ?? 0);
echo'<div class="menu list-bottom congdong">Phí tạo hội nhóm là 200000xu và trên 1000 bài viết</div>';
if ($datauser['tienxu'] < 200000) {
echo '<div class="menu">Bạn không đủ tiền để tạo hội nhóm nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if ($datauser['postforum'] < 1000) {
echo '<div class="menu">Bạn không đủ bài viết để tạo hội nhóm nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['sub'])) {
if(!empty($ban)) {
echo '<div class="menu list-bottom hot">Tài khoản của bạn đang bị khoá nên không thể tạo nhóm !</div>';
} else if(empty($ten)) {
echo '<div class="menu list-bottom hot">Bạn phải nhập tên nhóm !</div>';
} else if(strlen($ten) < 10) {
echo '<div class="menu list-bottom hot">Tên nhóm chỉ trên 10 kí tự !</div>';
} else if($kt > 0) {
echo '<div class="menu list-bottom hot">Tên nhóm đã có người dùng !</div>';
} else if(empty($mota)) {
echo '<div class="menu list-bottom hot">Bạn phải nhập mô tả về nhóm !</div>';
} else if(strlen($mota) > 300) {
echo '<div class="menu list-bottom hot">Mô tả quá dài!</div>';
} else {
$connect->query("update `users` set `tienxu` = `tienxu`-'200000' where `id` = '" . $user_id . "'");
if ($rights >= 8) {
$connect->query("INSERT INTO `nhom` SET `name`='".ucwords($ten)."', `gt`='".mysql_real_escape_string($mota)."', `user_id`='".$user_id."', `time`='".$time."', `duyet`='1'");
} else {
$connect->query("INSERT INTO `nhom` SET `name`='".ucwords($ten)."', `gt`='".mysql_real_escape_string($mota)."', `user_id`='".$user_id."', `time`='".$time."'");
}
$rid = mysql_insert_id();
$connect->query("INSERT INTO `nhom_user` SET `id`='$rid', `user_id`='$user_id', `time`='$time', `rights`='2', `duyet`='1'");
header('Location: /groups/'.$rid.'');
}
}
echo'<div class="menu list-bottom hot" style="color:red">Trước tiên tạo nhóm hãy đọc, với tính năng hội nhóm như bây giờ sẽ thực hiện quy chế nghiêm túc, nhóm được tạo sẽ phục vụ tiêu chuẩn cộng đồng hiện nay, bạn tạo nhóm không sử dụng kiểu cá nhân ( tạo cho vui, cho ai ) bây giờ chúng tôi sẽ kiểm duyệt nhóm của bạn khi bạn tạo nhóm, nếu nhóm phù hợp thì sẽ được tạo. Ví dụ bạn tạo nhóm là "Tin tức" thì chỉ đăng bài viết tin tức trong nhóm đó của bạn, bạn sẽ là "Sáng viên nhóm" có thể kiểm duyệt bài viết của thành viên từ và phong chức cho thành viên hoạt tốt nhóm của bạn !</div>';
echo '<form method="post"><div class="menu">Tên nhóm: (Max 15 kí tự)<br/><input type="text" name="ten" value="" /></div><div class="menu">Mô tả: (Max 300 kí tự)<br/ ><textarea rows="3" name="mota"></textarea><br/ ><span class="xam">Lưu ý: Mô tả phải viết bằng tiếng việt có dấu, không sử dụng ngôn ngữ teen, nghiêm cấm spam và quảng cáo wap nếu không nhóm có thể bị xoá mà không báo trước.</span></div><div class="menu list-top congdong"><input type="submit" name="sub" value="Tạo nhóm" /></div></form>';
echo '</div>';
require('../incfiles/end.php');
?>