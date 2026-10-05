<?php
$text1 = 'Phòng khám';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');







echo '<div class="danhmuc">Bác sĩ</div>';
If ($user_id){
echo '<form method="post"><font color=red>Phục hồi máu! 300 xu/lần!</font><br><input type="submit" name="submit" value="Hồi phục"></form>';
if(isset($_POST['submit'])){
if($datauser['tienxu'] <300){
echo 'Không đủ tiền';
} else {
$connect->query("UPDATE users SET tienxu = tienxu -300 WHERE id = $user_id");
$connect->query("UPDATE nhanvat SET hp = hpfull WHERE user_id = $user_id");
echo 'Hồi phục thành công!';
}
}

}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>