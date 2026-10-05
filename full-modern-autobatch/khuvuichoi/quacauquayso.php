<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khuvuichoi';
require_once('../incfiles/core.php');
$textl = 'Quả cầu quay số';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua vật phẩm</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để quay số nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['tienxu'].' Xu <span style="color:#e2e2e2">|</span> '.$datauser['vinaxu'].' Vinaxu</div>';
if($user_id){
if(isset($_GET['id'])){
include 'thongtinvatpham.php';
}else{
include 'shopvatpham.php';
}
echo "<div class='menu'>";
echo "&laquo; <a href='/khuvuichoi/'>Quay lại</a>";
echo "</div></div>";
}else{


}
require('../incfiles/end.php');
?>