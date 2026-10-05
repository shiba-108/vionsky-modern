<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$textl = 'Tên thật của bạn'; 
require('../incfiles/head.php');
echo'<div class="danhmuc">Tên thật của bạn</div>';
if ($user['id'] != $user_id && ($rights < 7 || $user['rights'] > $rights)) {
    header('Location: '.$home.'/account/'.$user['id'].'');
    require('../incfiles/end.php');
    exit;
}
$tongduyet = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `duyet` = '0' AND `user_id`='".$user['id']."'")->fetch_row()[0] ?? 0);
if ($tongduyet) {
echo'<div class="menu" style="color:red;">Tên của bạn đang được chờ BQT xét duyệt !</div>';
echo '</div>';
    require('../incfiles/end.php');
    exit;
}
$thongtin = $connect->fetch_array($connect->query("SELECT `time` FROM `tenthat` WHERE `user_id`='".$user['id']."'"));
if (($thongtin[time] + 2592000) < time() || $rights >= 6) {
echo'<div class="menu list-bottom congdong" style="color:red;margin-top: -2px">Đổi tên "<b>Tiếng Việt</b>" thật chính xác nhé ! Một tháng chỉ đổi được một lần, Lưu ý phải tên thật tiếng việt của bạn nếu đổi tên kiểu sẽ bị cấm luôn chức năng này !</div>';
echo'<div class="menu list-bottom" style="color:green;"><b>Đăng nhập phải sử dụng bằng tài khoản "<span style="color:red;">'.$user['name_lat'].'</span>"</b></div>';
function camtudoiten($str) {
$str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
$str = str_replace("\r\n", ', ', $str);
$str = str_replace("'", '', $str);
$str = bbcode::notags($str);
$str = strtr($str, array(
'&' => ' ',
'!' => ' ',
'@' => ' ',
'#' => ' ',
'$' => ' ',
'^' => ' ',
';' => ' ',
'{' => ' ',
'}' => ' ',
'(' => ' ',
')' => ' ',
':' => ' ',
'~' => ' ',
'`' => ' ',
'%' => ' ',
'*' => ' ',
'<' => ' ',
'>' => ' ',
'_' => ' ',
'.' => ' ',
'?' => ' ',
'â€¦' => ' ',
'"' => ' ',
'=' => ' ',
'[' => ' ',
']' => ' ',
'1' => ' ',
'2' => ' ',
'3' => ' ',
'4' => ' ',
'5' => ' ',
'6' => ' ',
'7' => ' ',
'8' => ' ',
'9' => ' ',
'0' => ' '
));
$str = preg_replace("/, {2,20}/", ', ', $str);
$str = preg_replace("/[,]{2,20}/", ',', $str);
$str = preg_replace("/[ ]{2,20}/", ' ', $str);
$str = trim($str);
return $str;
}
$tong = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `user_id` = '" . $user['id'] . "'")->fetch_row()[0] ?? 0);
if (isset($_POST['submit'])) {
    $tencuaban = camtudoiten($_POST['tencuaban']); 
if(empty($tencuaban)) {
echo '<div class="menu list-bottom" style="color:red;margin-top: -2px">Bạn chưa nhập tên của bạn !</div>';
} else if (mb_strlen($tencuaban) <= 10) {
echo '<div class="menu list-bottom" style="color:red;margin-top: -2px">Tên của bạn phải trên 10 kí tự</div>';
} else if (mb_strlen($tencuaban) >= 25) {
echo '<div class="menu list-bottom" style="color:red;margin-top: -2px">Tên của bạn dài quá chỉ dưới 25 kí tự thôi !</div>';
} else {
if ($rights >= 6) {$duyet = 1;} else {$duyet = 0;}
if ($tong == 0) {
        $connect->query("INSERT INTO `tenthat` SET
            `time` = '" . time() . "',
            `user_id` = '" . $user['id'] . "',
            `duyet` = '" . $duyet. "',
            `ten` = '" . mysql_real_escape_string(ucwords($tencuaban))."'
        ");

} else {

        $connect->query("UPDATE `tenthat` SET
            `time` = '" . time() . "',
            `duyet` = '" . $duyet. "',
            `ten` = '" . mysql_real_escape_string(ucwords($tencuaban))."' WHERE `user_id` = '" . $user['id'] . "'");
}
    header('Location: /account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '');
    exit;
}
}
echo '<form method="post">';
echo'<div class="menu">Tên thật của bạn (VD: Nguyễn Hữu An):<br/><input type="text" value="" name="tencuaban" /></div>';
echo '<div class="menu"><input type="submit" value="Đổi tên" name="submit" /></div>' .
    '</form>';
} else {
$timetinh = $thongtin[time] + 2592000;
echo '<div class="menu" style="color:red;margin-top: -2px">Bạn đã đổi tên 1 lần rồi hãy chờ <b>'.thoigiantinh($timetinh).'</b> nữa để đổi tiếp nhé !</div>';
}
require_once ("../incfiles/end.php");
?>