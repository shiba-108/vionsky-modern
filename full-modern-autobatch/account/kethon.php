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
$textl = 'Kết hôn với '. $user['name'] . ''; 
require('../incfiles/head.php');
echo'<div class="danhmuc">Kết hôn với '. $user['name'] . '</div>';
if ($user['nguoiyeu'] == $user_id) {
echo'<div class="menu list-top">Bạn đã kết hôn với '.nick($user['id']).' rồi nhé !</div>';
require('../incfiles/end.php');
exit;
}
if ($user['id']==$user_id) {
echo'<div class="menu list-top">Bạn không thể kết hôn với bạn !</div>';
require('../incfiles/end.php');
exit;
}
if ($user['sex']==$datauser['sex']) {
echo'<div class="menu list-top">Bạn không thể kết hôn với người cùng giới tính !</div>';
require('../incfiles/end.php');
exit;
}
if (!empty($datauser['nguoiyeu'])) {
echo'<div class="menu list-top">Bạn đã có '.($user['sex']== zh ? 'vợ':'chồng').' rồi đừng ngoại tình nhé, nếu chán '.($user['sex']== zh ? 'con vợ':'thằng chồng').' thì hãy ly hôn để yêu người mới!</div>';
require('../incfiles/end.php');
exit;
}
if (!empty($user['nguoiyeu'])) {
echo'<div class="menu list-top">'.nick($user['id']).' đã có '.($user['sex']== zh ? 'chồng':'vợ').' rồi đừng nên không thể kết hôn với bạn !</div>';
require('../incfiles/end.php');
exit;
}
if ($datauser['tienxu'] < 50000) { 
echo'<div class="menu list-top">Bạn phải có 50000 xu để làm đám cưới nhé !</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '" . $user['id'] . "',
            `time` = '" . time() . "',
            `type` = 'b'
        ");
$connect->query("INSERT INTO `thongbaokethon` SET
                `time` = '" . $time . "',
                `dongy` = '1',
                `user_id` = '" . $user['id'] . "',
                `musers` = '" . $user_id. "'
                ;");
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`-'50000' WHERE `id` = '" . $user_id. "'");
echo'<div class="menu list-top">Bạn đã cầu hôn thành công bạn mất 50000 xu nếu đối phương không đồng ý bạn sẽ được hoàn tiền 30000 xu!</div>';
} else {
echo'<div class="menu list-top congdong">Nếu thấy '.nick($user['id']).' thích hợp làm '.($user['sex']== zh ? 'vợ':'chồng').' tương lai hãy cầu hôn '.($user['sex']== zh ? 'cô':'anh').' ấy !</div>';
echo'<div class="menu list-top">';
echo'<img src="'.$home.'/avatar/'.$user_id.'.png"/>';
echo' <img src="/icon/tinhyeu.png" alt="icon" style="vertical-align: top;"/> ';
echo'<img src="'.$home.'/avatar/'.$user[id].'.png" class="xavt"/>';
echo '<form method="post">Bạn muốn cầu hôn với '.nick($user['id']). ' !<br /><input type="submit" name="submit" value="Đồng ý" /></form>'; 
echo'</div>';
}
require_once ("../incfiles/end.php");
?>