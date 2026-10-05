<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../../incfiles/core.php');
$textl = 'Máy Đo Tình Yêu Online';
$mota = 'Máy đo tình yêu ... Máy sẽ cho ra kết quả 2 bạn hợp nhau như thế nào? ';
require ('../../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Máy Đo Tình Yêu Online</div>';
echo'<script language="javascript" src="maydotinhyeu.js"></script>';
?>
            <form name="loveform">
            <input type="text" size="25" value="Chí Phèo" name="name1"><br/>
            <input type="text" size="25" value="Thị Nở" name="name2"><br/>
            <input type="text" size="3" name="output"> <input onclick="calc()" type="button" value="Xem Kết Quả" name="calculate" >
            </form>
</div>
<?php require ('../../incfiles/end.php'); ?>