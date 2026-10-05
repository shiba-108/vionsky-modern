<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Nạp Xu';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nạp Xu</div>';
if (!isset($_POST['submit'])) {
echo'<div class="menu list-bottom congdong">Hệ thống nạp thẻ qua trung gian riêng của Vina4u nên khi nạp thẻ bạn phải chờ xác nhận !</div>';
}
$mathe = functions::checkout($_POST['mathe']);
$seri = functions::checkout($_POST['seri']);
$loaithe = functions::checkout($_POST['loaithe']);
$sothe = functions::checkout($_POST['sothe']);
$loaixu = functions::checkout($_POST['loaixu']);
$tienxu = ($sothe == 10000 ? '10000':NULL).($sothe == 20000 ? '25000':NULL). ($sothe == 50000 ? '75000':NULL).($sothe == 100000 ? '150000':NULL).($sothe == 200000 ? '300000':NULL).($sothe == 500000 ? '800000':NULL);
$vinaxu = ($sothe == 10000 ? '10':NULL).($sothe == 20000 ? '25':NULL). ($sothe == 50000 ? '75':NULL).($sothe == 100000 ? '150':NULL).($sothe == 200000 ? '300':NULL).($sothe == 500000 ? '800':NULL);
if (isset($_POST['submit'])) {
if(empty($mathe)) {
} else if (mb_strlen($mathe) !== 13) {
} else if(empty($seri)) {
} else if (mb_strlen($seri) !== 13) {
} else {

if ($loaixu == 'tienxu'){
        $connect->query("INSERT INTO `napthe` SET
            `mathe` = '".$mathe."',
            `seri` = '".$seri."',
            `time` = '" . time() . "',
            `loaithe` = '".$loaithe."',
            `user_id` = '".$user_id."',
            `sothe` = '".$sothe."',
            `loaixu` = '".$loaixu."',
            `xunhan` = '".$tienxu."'
        ");
}
if ($loaixu == 'vinaxu'){
        $connect->query("INSERT INTO `napthe` SET
            `mathe` = '".$mathe."',
            `seri` = '".$seri."',
            `time` = '" . time() . "',
            `loaithe` = '".$loaithe."',
            `user_id` = '".$user_id."',
            `sothe` = '".$sothe."',
            `loaixu` = '".$loaixu."',
            `xunhan` = '".$vinaxu."'
        ");
}
echo '<div class="menu list-bottom congdong" style="color:green">Thẻ cào của bạn đang được xác nhận ! Việc này mất mội chút thời gian</div>';
}
} 

if(isset($_POST['submit']) && empty($mathe)) {
echo '<div class="menu list-bottom" style="color:red">Bạn chưa nhập mã thẻ !</div>';
} else if (isset($_POST['submit']) && mb_strlen($mathe) !== 13) {
echo '<div class="menu list-bottom" style="color:red">Mã thẻ phải 13 kí tự nhé !</div>';
} else if(isset($_POST['submit']) && empty($seri)) {
echo '<div class="menu list-bottom" style="color:red">Bạn chưa nhập seri !</div>';
} else if (isset($_POST['submit']) && mb_strlen($seri) !== 13) {
echo '<div class="menu list-bottom" style="color:red">Seri phải 13 kí tự nhé !</div>';
} else {
?>
<form  method="post" >
<div class="menu list-bottom">Mã Thẻ: <br>
<input type="text" name="mathe" size="22" value="">
</div>
<div class="menu list-bottom">Seri: <br>
<input type="text" name="seri" size="22" value=""><br>
Loại Thẻ:<br>
<select name="loaithe">
<option value="Viettel">Viettel</option>
<option value="Vinaphone">Vinaphone</option>
<option value="Mobifone">Mobifone</option>
</select>
</div>
<div class="menu list-bottom">Thẻ: <br>
<select name="sothe">
<option value="10000">10.000</option>
<option value="20000">20.000</option>
<option value="50000">50.000</option>
<option value="100000">100.000</option>
<option value="200000">200.000</option>
<option value="500000">500.000</option>
</select>
</div>
<div class="menu">
Loại Xu:</br>
<select name="loaixu">
<option value="tienxu">Xu</option>
<option value="vinaxu">Vinaxu</option>
</select>
</div>
<input type="submit" name="submit" value="Nạp"></form>
<?php
}
echo'</div>';
require('../incfiles/end.php');
?>