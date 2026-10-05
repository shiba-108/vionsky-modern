<?php
$arr = $connect->fetch_array($connect->query("select * from shop WHERE `id` = '" . $kill . "'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua Đồ</div>';
$sosanhkhodo = ($connect->query("SELECT COUNT(*) FROM `kho` WHERE `loai` = '".$_GET['loai']."' AND `id_loai` = '".$arr['id_loai']."' AND `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);
if ($sosanhkhodo > 0) {
echo '<div class="menu">Bạn đã mua món đồ này rồi nhé hãy vào rương kiểm tra !<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
echo'</div>';
require_once ("../incfiles/end.php");
exit;
}
if(isset($_POST['submit'])) {
if ($arr[type] == '1') {
$type = 1;
}
if(!empty($arr[gia])) {
if (!user_id) {
            } else
            if ($datauser['tienxu'] < $arr['gia']) {
                echo '<div class="menu">Bạn không đủ tiền bạn cần phải có '.$arr[gia].' để mua món đồ này<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            }  else
            if (empty($arr['id_loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong shop<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else {
                $tien = $arr['gia'];
                $connect->query("INSERT INTO `kho` SET 
               `user_id`='" . $user_id. "',
               `id_loai`='" . $arr['id_loai'] . "',
               `loai`='" . $kill2 . "',
               `type`='" . $type. "',
               `tenvatpham`='" . $arr['tenvatpham'] . "',
               `tangsucmanh`='" . $arr['tangsucmanh'] . "'
               ");
                @$connect->query("update `users` set `tienxu` = `tienxu`-'" . $tien . "' where `id` = '" . $user_id . "'");
header('Location: /account/ruong/');
            }
} else {
if (!user_id) {
            } else
            if ($datauser['vinaxu'] < $arr['vinaxu']) {
                echo '<div class="menu">Bạn không đủ tiền bạn cần phải có '.$arr[vinaxu].' Vinaxu để mua món đồ này<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            }  else
            if (empty($arr['id_loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong shop<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else {
                $tien = $arr['vinaxu'];
                $connect->query("INSERT INTO `kho` SET 
               `user_id`='" . $user_id. "',
               `id_loai`='" . $arr['id_loai'] . "',
               `loai`='" . $kill2 . "',
               `type`='" . $type. "',
               `tenvatpham`='" . $arr['tenvatpham'] . "',
               `tangsucmanh`='" . $arr['tangsucmanh'] . "'
               ");
                @$connect->query("update `users` set `vinaxu` = `vinaxu`-'" . $tien . "' where `id` = '" . $user_id . "'");
header('Location: /account/ruong/');
            }
} 
} else {
if(!empty($arr[gia])) {
$phantien = $arr['gia'].'xu';
} else {
$phantien = $arr['vinaxu'].' vinaxu';
}
echo'<img src="'.$home.'/images/' . $_GET['loai'] . '/'.$arr['id_loai'].'.png" alt="'.$_GET['id'].'"/>';
echo '<form action="/shop/'.$_GET['loai'].'/mua/'.$arr['id'].'" method="post">'.$hetsucmanh[sucmanh].' Bạn muốn mua món đồ này với giá '.$phantien.' !<br /><input type="submit" name="submit" value="Mua" />&#160;<a href="/shop/"><input type="button" value="Hủy" /></a></form>';
}
echo'</div>';
?>