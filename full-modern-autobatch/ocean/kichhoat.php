<?php
$text1 = 'Nhập quốc tịch';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

require('../incfiles/head.php');







echo '<div class="danhmuc">Tòa thị chính</div>';
If ($user_id){
If($datauser['active'] ==1){
echo '<font color=red>Cấp quốc tịch! Quyền lợi:</font><br><font color=green>Giá: 500đ: <b>ON XLS Gửi 8098</b>(hoạt động)<br>Được tặng 50k Xu và bảo mật tài khoản khi quên mật khẩu! Và mở hệ thống bản đồ cùng mã gift code công dân!
<br><a href="/ocean/makh.php"><b>Lấy mã kích hoạt miễn phí!</b></a></font><form method="post">Nhập mã công dân<br><input type="text" name="kh" placeholder="Mã từ sms"><input type="submit" name="submit" value="Kích hoạt"></form>';
if(isset($_POST['submit'])){
$kh = $_POST['kh'];
$check = ($connect->query("SELECT COUNT(*) FROM kichhoat WHERE ma = '$kh'")->fetch_row()[0] ?? 0);
if($check ==0){
echo 'Mã sai';
} else {
$kh1 = $connect->fetch_array($connect->query("SELECT * FROM kichhoat WHERE ma = '$kh'"),0);
$mbxl = '0'.$kh1['mb'].'';
$time = $kh1['time'];
if(time() - $time > 3600){
echo 'Mã đã hết hạn sử dụng';
$connect->query("DELETE FROM kichhoat WHERE ma = '$kh'");
} else {
$connect->query("DELETE FROM kichhoat WHERE ma = '$kh'");
$connect->query("UPDATE users SET active = '1', mibile = '$mbxl', tienxu = tienxu +50000 WHERE id = '$user_id'");
$connect->query("INSERT INTO danhhieu SET text = 'Active Member', user_id = '$user_id', cap = '3'");
If($datauser['gioithieu'] !=0){
$gt = $datauser['gioithieu'];
$connect->query("UPDATE users SET tienxu = tienxu +5000, vinaxu = vinaxu +1 WHERE id = $gt");
}
echo 'Kích hoạt thành công!';
}
}
}
} else {
Echo 'Hãy chứng minh cho họ thấy bạn là công dân VIP!<br>
///////<font color=red>Danh hiệu</font><br>';
echo '<font color=purple>[<b>Active Member</b>] - Có được khi kích hoạt tài khoản 500đ</font><br>';
echo '<font color=blue>[<b>Rich X</b>] - Có được khi đạt 2.500.000 xu</font><br>';
echo '<font color=red>[<b>Rich X</b>] - Có được khi đạt 6.000.000 xu</font><br>';
echo '<font color=purple>[<b>Rich X</b>] - Có được khi đạt 12.000.000 xu</font><br>';
echo '<font color=purple>[<b>Rich X</b>] - Có được khi đạt 12.000.000 xu</font><br>';
echo '<font color=blue>[<b>Rich VX</b>] - Có được khi đạt 500 Vinaxu</font><br>';
echo '<font color=red>[<b>Rich VX</b>] - Có được khi đạt 2.000 Vinaxu</font><br>';
echo '<font color=purple>[<b>Rich VX</b>] - Có được khi đạt 8.000 Vinaxu</font><br>';
echo '<font color=purple>[<b>Family</b>] - Có được khi lập gia đình</font><br>';
echo '<font color=blue>[<b>Good Man</b>] - Có được khi cho ăn mày 1 phát 50.000 Xu</font><br>';
echo '<font color=red>[<b>Good Man</b>] - Có được khi cho ăn mày 1 phát 200.000 Xu</font><br>';
echo '<font color=purple>[<b>Good Man</b>] - Có được khi cho ăn mày 1 phát 500.000 Xu</font><br>';
echo '<font color=blue>[<b>Student</b>] - Có được khi đạt cấp 6</font><br>';
echo '<font color=red>[<b>Student</b>] - Có được khi đạt cấp 10</font><br>';
echo '<font color=purple>[<b>Student</b>] - Có được khi đạt cấp 13 trở lên</font><br>';
echo '<font color=blue>[<b>Billionaire</b>] - Có được khi nạp 50k</font><br>';
echo '<font color=red>[<b>Billionaire</b>] - Có được khi nạp 200k</font><br>';
echo '<font color=purple>[<b>Billionaire</b>] - Có được khi nạp 500k</font><br>Update...<br>';
echo '/////Danh hiệu phê phán:<br>';
echo '<font color=blue>[<b>Prisoner</b>] - Có được khi bị band 2 lần</font><br>';
echo '<font color=red>[<b>Prisoner</b>] - Có được khi bị band 4 lần</font><br>';
echo '<font color=purple>[<b>Prisoner</b>] - Có được khi bị band 5 lần</font><br>';
echo '<font color=blue>[<b>Predator</b>] - Có được khi Quay tay 7 lần</font><br>';
echo '<font color=red>[<b>Predator</b>] - Có được khi Quay tay 20 lần</font><br>';
echo '<font color=purple>[<b>Predator</b>] - Có được khi Quay tay 38 lần</font><br>Update...';
if($datauser['rights'] ==9){
echo '<br>Lịch sử';
$res = $connect->query("SELECT * FROM lichsu WHERE user_id = '6' ORDER BY id ASC");
while ($fix = $connect->fetch_array($res)){
echo '<br>#'.$fix['id'].' - '.$fix['url'].'';
}
}
}
}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





require('../incfiles/end.php');
?>
