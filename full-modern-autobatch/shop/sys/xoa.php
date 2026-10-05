<?php
if ($user_id) {
$xoa = $connect->fetch_array($connect->query("select * from `shop` WHERE `id` = '".$_GET['id']."'"));
echo '<div class="danhmuc">Bán đồ</div><div class="menu">';
if(isset($_POST['submit'])) {
#@unlink('../images/'.$xoa[loai].'/'.$xoa[id_loai].'.png'); 
header('Location: '.$home.'/shop/'.$xoa[loai].'');
$connect->query("DELETE FROM `shop` WHERE `id`='".$_GET['id']."'");
} else {
echo'<img src="'.$home.'/images/'.$xoa[loai].'/'.$xoa[id_loai].'.png"/>';
echo '<form action="/shop/xoa/'.$_GET['id'].'" method="post">Bạn muốn xóa món đồ này !<br /><input type="submit" name="submit" value="Xóa" /></form>'; 
}
echo '</div>';
}
?>