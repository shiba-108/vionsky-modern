<?php

define('_IN_JOHNCMS', 1);
$textl = 'Nâng cấp';
$noionline = 'upgrade';
require_once ('../../incfiles/core.php');
require_once ('../../incfiles/head.php');
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="phdr">Upgrade</div>';
echo'<div class="menu">Bạn phải đăng nhập để nâng cấp!</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
if($rights < 9){
exit;
}

if(isset($_POST['submit'])){
$connect->query("INSERT INTO  `nangcap` (`vatpham` ,`canvp` ,`gia` ,`kcx` ,`kct` ,`nhb` ,`k` ,`id`)VALUES ('".$_POST['vatpham']."',  '".$_POST['canvp']."',  '".$_POST['gia']."',  '".$_POST['kcx']."',  '".$_POST['kct']."',  '".$_POST['nhb']."',  '0', NULL)");

echo '<div class="rmenu">Thêm Thành Công <a href="/nangcap/add.php">Trở Lại</a></div>';
require_once ("../../incfiles/end.php");
exit;
}
echo '<form method="post">
<div class="phdr">Thêm đồ nâng cấp</div>
ID Vật Phẩm Nâng Cấp <br />
<input type="number" name="vatpham" /><br />
ID Vật Phẩm Cần Có (Sẽ mất nếu thành công) <br />
<input type="number" name="canvp" /><br />
Giá Nâng Cấp <br />
<input type="number" name="gia" /><br />
Kim Cương Xanh <br />
<input type="number" name="kcx" /><br />
Kim Cương Hi vọng <br />
<input type="number" name="kchv" /><br />
Kim Cương Tím <br />
<input type="number" name="kct" /><br />
Ngọc Huyền bí <br />
<input type="number" name="nhb" /><br />
<input type="submit" name="submit" value ="Thêm"/>
</form>';







require_once ("../../incfiles/end.php");

?>