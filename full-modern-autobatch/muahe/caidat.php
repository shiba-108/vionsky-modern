<?php
define('_IN_JOHNCMS', 1);
$headmod = 'SQL';
require('../incfiles/core.php');
//--Phần Khai Báo SQL
$sql1 = "Câu lệnh SQL thứ 1;";
$sql2 = "Câu lệnh SQL thứ 2;";
$sql3 = "Câu lệnh SQL thứ 3;";
$sql4 = "Câu lệnh SQL thứ .....;";
$sql5 = "Câu lệnh SQL thứ n ;";
//--Phần kiểm tra
$connect->query($sql1) or die('lỗi câu lệnh SQL số 1');
$connect->query($sql2) or die('lỗi câu lệnh SQL số 2');
$connect->query($sql3) or die('lỗi câu lệnh SQL số 3');
$connect->query($sql4) or die('lỗi câu lệnh SQL số ....');
$connect->query($sql5) or die('lỗi câu lệnh SQL số n');
//--Nếu Không lỗi thì
echo 'Bạn đã cài đặt thành công Tất cả câu lệnh trên';
?>
