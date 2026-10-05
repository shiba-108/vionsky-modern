<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Thông tin vật nuôi';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin vật nuôi</div>';
echo'<div class="menu list-bottom congdong" style="margin-top: -2px;">'.nick($user_id).' bạn có '.$datauser['tienxu'].' xu - '.$datauser['vinaxu'].' Vinaxu</div>';
if($user_id){
$id = intval($_GET['id']);
if($id){
$post = $connect->fetch_array($connect->query("select * from `farm_vatnuoi_cuaban` WHERE  `id` = '".$id."'  LIMIT 1"));
$thongtinvn = $connect->fetch_array($connect->query("select * from `farm_vatnuoi_choan` WHERE  `vatnuoi` = '".$post[id_vatnuoi]."' AND `user_id` = '".$user_id."' LIMIT 1"));
if ($post[user_id]!=$user_id) {
header('Location: '.$home.'/farm/');
}
if (empty($post[id])) {
header('Location: '.$home.'/farm/');
}
$thongtin = $connect->fetch_array($connect->query("select * from `farm_vatnuoi` WHERE  `id` = '".$post[id_vatnuoi]."'  LIMIT 1"));
if(isset($_POST['ok'])) {
$connect->query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id`='".$id."'");
if ($post[tienhoa] == '2') {
$connect->query("UPDATE users SET `tienxu` = `tienxu`+'{$thongtin['banfull']}' WHERE `id` = '{$user_id}'");
} else {
$connect->query("UPDATE users SET `tienxu` = `tienxu`+'{$thongtin['ban']}' WHERE `id` = '{$user_id}'");
}
header('Location: '.$home.'/farm/');
}
if(isset($_POST['ban'])) {
echo'<img src="/farm/vatnuoi/'.$post['tienhoa'].'/'.$post['id_vatnuoi'].'.gif" alt="icon"/>';
if ($post[tienhoa] == '2') {
echo '<form method="post">Bạn muốn con '.htmlspecialchars($thongtin['tenvatnuoi']).' này với giá '.$thongtin['banfull'].' xu !<br />';
} else {
echo '<form method="post">Bạn muốn con '.htmlspecialchars($thongtin['tenvatnuoi']).' này với giá '.$thongtin['ban'].' xu !<br />';
}
echo'<input type="submit" name="ok" value="Bán" /></form>'; 
} else {
$timesongvatnuoi = $post['timesong']+$thongtin['timesong'];
$timetienhoavatnuoi = $post['timetienhoa']+$thongtin['timelon'];
echo'<div class="menu">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;"  width="35">';
echo'<img src="/farm/vatnuoi/'.$post['tienhoa'].'/'.$post['id_vatnuoi'].'.gif" alt="icon"/>&#160;';
echo'</td><td width="500">';
echo'[ <b>'.htmlspecialchars($thongtin['tenvatnuoi']).'</b> ]<br/>';
if ($post[tienhoa] == '1') {
echo 'Thời Gian Lớn: <span style="color:green">'.thoigiantinh($timetienhoavatnuoi).' nữa<br/></span>';
}
echo'Thời gian sống: <span style="color:green">'.thoigiantinh($timesongvatnuoi).' nữa</span><br/>';
if ($thongtinvn[tinhtrang] == '2') {
echo'Tình trạng: <b style="color:green">No</b><br/>';
} else {
echo'Tình trạng: <b style="color:red">Đói</b><br/>';
}
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu list-top congdong">';
echo '<form method="post">';
if ($post[tienhoa] == '2') {
echo'<input type="submit" name="ban" value="Bán '.htmlspecialchars($thongtin['tenvatnuoi']).' với giá '.$thongtin['banfull'].' xu" />';
} else {
echo'<input type="submit" name="ban" value="Bán '.htmlspecialchars($thongtin['tenvatnuoi']).' với giá '.$thongtin['ban'].' xu" />';
}
echo'</form>';
echo'</div>';
}
} else {
header('Location: '.$home.'/farm/');
}
echo'</div>';
}
require('../incfiles/end.php');
?>