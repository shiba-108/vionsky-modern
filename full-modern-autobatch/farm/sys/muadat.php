<?php
if (isset($_POST['muadat'])) {
if ($datauser['tienxu']>=10000) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`- '10000' WHERE `id` = $user_id LIMIT 1");
$connect->query("INSERT INTO `fermer_gr` (`semen`, `id_user`) VALUES  ( '0', '".$user_id."') ");
header('Location: /farm/');
} else {
echo '<div class="menu">Bạn phải đủ 10000 xu để mở ô đất mới</div>';
}
}
if(isset($_GET['muadat'])){
if ($tongodat <= 60) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua đất</div>';
echo '<div class="menu">';
echo "Mở thêm 1 đất bạn mất 10000 xu";
echo "<form method='post'>\n";
echo "<br/><input type='submit' name='muadat' value='Mua!' />";
echo'</div>';
echo'</div>';
}
}
?>