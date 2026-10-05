<?php
$int = intval($_GET['id']);
$sql=$connect->query("SELECT `id` FROM `quayso` WHERE `id`='$int' ");
$row=$connect->fetch_assoc($sql);
if(!$connect->query("SELECT * FROM ...")$sql)){
echo '<div class="menu">Quả cầu này Không tồn tại nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$post = $connect->fetch_array($connect->query("select * from `quayso` WHERE  `id` = '$int'  LIMIT 1"));

echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img src="/khuvuichoi/icon/'.$post['id'].'.png" alt="icon" />';
echo'&#160;</td><td>';
echo'[ <b>Quả Cầu '.htmlspecialchars($post['name']).'</b> ]<br/>';
echo 'Giá: '.($post[loaixu] == tienxu ? ''.$post['gia'].'xu':'<span style="color:green">'.$post['gia'].' vinaxu</span>').' = 1 quả<br />';
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu list-bottom">';
echo'số định mức quay <b>'.$post['rand2'].'</b></div>';
$xutru = $post['gia']*$_POST['kupit'];
if (isset($_POST['kupit']) && $xutru > $datauser[$post[loaixu]]) {
echo'<div class="menu list-bottom congdong"><b style="color:red">Bạn không đủ tiền mua quả cầu này nhé bạn cần phải có '.($post[loaixu] == tienxu ? ''.$xutru.'xu':'<span style="color:green">'.$xutru.' vinaxu</span>').' để mua !</b></div>';
}
if(isset($_POST['kupit']) && strlen($_POST['kupit'])==0 || isset($_POST['kupit']) && $_POST['kupit']<1){
echo'<div class="menu list-bottom congdong"><b style="color:red">Chỉ được phép nhập số !</b></div>';
}
echo'<div class="menu list-bottom">';
echo '<form method="post">
Số Lượng <input type="text" name="kupit" size="1" value=""/> Quả<br/><input type="submit" name="save" value="Mua" />
</form>
</div>';
if(isset($_POST['kupit']) && $datauser[$post[loaixu]]>=$xutru && $_POST['kupit']>0) {
if ($post[loaixu] == tienxu) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`- $xutru WHERE `id` = $user_id LIMIT 1");
}
if ($post[loaixu] == vinaxu) {
$connect->query("UPDATE `users` SET `vinaxu` = `vinaxu`- $xutru WHERE `id` = $user_id LIMIT 1");
}
echo'<div class="menu list-bottom congdong"><b style="color:green">Bạn đã mua thành công '.$_POST['kupit'].' quả cầu '.$post['name'].' bạn mất '.$xutru.' '.($post[loaixu] == tienxu ? 'xu':' Vinaxu').'</b></div>';
$remils = ($connect->query("SELECT COUNT(*) FROM `quayso_item` WHERE `id_user` = '$user_id' AND `go` = '$int'")->fetch_row()[0] ?? 0);
if($remils>0) {
$connect->query("UPDATE `quayso_item` SET `soluong` = `soluong`+ '".$_POST['kupit']."' WHERE `id_user` = $user_id AND `go` = '$int' LIMIT 1");
} else {
$connect->query("INSERT INTO `quayso_item` (`soluong` ,`go`, `id_user`) VALUES  ('".$_POST['kupit']."', '".$int."', '".$user_id."') ");
}
}
?>