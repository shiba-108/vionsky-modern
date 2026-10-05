<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Vật phẩm';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Vật phẩm</div>';
$int = intval($_GET['id']);
if(isset($_GET['id'])){
$post = $connect->fetch_array($connect->query("select * from `shop` WHERE `id` = '".$int."'"));
$sucmanhchia = $post['tangsucmanh']/2;
$sucmanhchianho = $sucmanhchia/2;
$sucmanh = $post['tangsucmanh']-$sucmanhchia+$sucmanhchianho;

$hpchia = $post['hp']/2;
$hpchianho = $hpchia/2;
$hp = $post['hp']-$hpchia+$hpchianho;

echo'<div class="menu list-bottom congdong">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img src="'.$home.'/images/'.$post['loai'].'/' . $post['id_loai'] . '.png" alt="do"/>';
echo'&#160;</td><td>';
echo'<b>'.htmlspecialchars($post['tenvatpham']).'</b><br/>';
if(!empty($post[gia])) {
echo 'Giá: <b>'.$post['gia'].'</b> xu/1 viên<br />';
} else {
echo 'Giá: <b>'.$post['vinaxu'].'</b> vinaxu/1 viên<br />';
}
if(!empty($post[tangsucmanh])) {
echo 'Cường hóa từ '.$sucmanh.' ~ '.$post['tangsucmanh'].'sm';
}
if(!empty($post[hp])) {
echo 'Cường hóa từ '.$hp.' ~ '.$post['hp'].'HP';
}
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu">';
echo '<form method="post" action="?id='.$int.'">
Số Lượng Mua <input type="text" name="kupit" size="2"/><input type="submit" name="save" value="Mua" />
</form>
</div>';
$infovp = $connect->fetch_array($connect->query("select * from `vatpham` WHERE `item`='".$post['id_loai']."' AND `id_user` = '".$user_id."' LIMIT 1"));
if(isset($_POST['kupit'])) {
if ($_POST['kupit'] < '0') {
echo '<div class="menu list-top">Số lượng mua phải trên <b>0</b> nhé !</div>';
echo'<a href="/shop/vatpham/"><input type="button" value="Tiếp tục" /></a>';
echo'</div>';
require('../incfiles/end.php');
exit;
} else {
if(!empty($post[gia])) {
$xu = $post['gia']*$_POST['kupit'];
$errorxu = $post['gia']*$_POST['kupit'].'xu';
$xuco = $datauser['tienxu'];
} else {
$xu = $post['vinaxu']*$_POST['kupit'];
$errorxu = $post['vinaxu']*$_POST['kupit'].' vinaxu';
$xuco = $datauser['vinaxu'];
}
if ($xuco < $xu) {
echo '<div class="menu list-top">Bạn không đủ tiền bạn cần phải có <span style="font-size:12px;color:green;"><b>'.$errorxu.'</b></span> để mua món đồ này !</div>';
echo'<a href="/shop/vatpham/"><input type="button" value="Tiếp tục" /></a>';
} else {
if ($infovp[item] == $post['id_loai']) {
$connect->query("UPDATE `vatpham` SET `soluong` = `soluong`+ '".$_POST['kupit']."' WHERE `id` = '".$infovp[id]."'");
} else {
if(!empty($post[tangsucmanh])) {
        $connect->query("INSERT INTO `vatpham` SET
               `id_user`='" . $user_id. "',
               `item`='" . $post['id_loai'] . "',
               `soluong`='" . $_POST['kupit'] . "',
               `text`='" . $post['tenvatpham'] . "',
               `chisoch1`='" . $sucmanh . "',
               `chisoch2`='" . $post['tangsucmanh'] . "'
        ");
}

if(!empty($post[hp])) {
        $connect->query("INSERT INTO `vatpham` SET
               `id_user`='" . $user_id. "',
               `item`='" . $post['id_loai'] . "',
               `soluong`='" . $_POST['kupit'] . "',
               `text`='" . $post['tenvatpham'] . "',
               `hp1`='" . $hp. "',
               `hp2`='" . $post['hp'] . "'
        ");
}

}
header('Location: /account/ruong/');
if(!empty($post[gia])) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`- $xu WHERE `id` = $user_id LIMIT 1");
} else {
$connect->query("UPDATE `users` SET `vinaxu` = `vinaxu`- $xu WHERE `id` = $user_id LIMIT 1");
}
}
}
}
} else {
$res = $connect->query("SELECT * FROM `shop` WHERE `type`='1' LIMIT 20");
while ($post = $connect->fetch_array($res)){
$sucmanhchia = $post['tangsucmanh']/2;
$sucmanhchianho = $sucmanhchia/2;
$sucmanh = $post['tangsucmanh']-$sucmanhchia+$sucmanhchianho;
$hpchia = $post['hp']/2;
$hpchianho = $hpchia/2;
$hp = $post['hp']-$hpchia+$hpchianho;
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img src="'.$home.'/images/'.$post['loai'].'/' . $post['id_loai'] . '.png" alt="do"/>';
echo'&#160;</td><td>';
echo'<a href="/shop/vatpham/?id='.$post[id].'"><b>' . $post['tenvatpham'] . '</b></a></br>';
if(!empty($post[gia])) {
echo 'Giá: <b>'.$post['gia'].'</b> xu/1 viên<br />';
} else {
echo 'Giá: <b>'.$post['vinaxu'].'</b> vinaxu/1 viên<br />';
}
if(!empty($post[tangsucmanh])) {
echo 'Cường hóa từ '.$sucmanh.' ~ '.$post['tangsucmanh'].'sm';
}
if(!empty($post[hp])) {
echo 'Cường hóa từ '.$hp.' ~ '.$post['hp'].'HP';
}
echo ' <a href="/shop/xoa/' . $post['id'] . '">[<b>Xóa</b>]</a>';
echo'</td></tr></table></div>';
}
}
echo'</div>';
require('../incfiles/end.php');
?>