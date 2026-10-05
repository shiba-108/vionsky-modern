<?php
 $demsoxu = ($connect->query("SELECT SUM(tienxu) FROM users")->fetch_row()[0] ?? 0);
$demsovinaxu = ($connect->query("SELECT SUM(vinaxu) FROM users")->fetch_row()[0] ?? 0);
$demsoca = ($connect->query("SELECT SUM(cauca) FROM users")->fetch_row()[0] ?? 0);
 $demsopost = ($connect->query("SELECT SUM(postforum) FROM users")->fetch_row()[0] ?? 0);
$demsoguest = ($connect->query("SELECT COUNT(*) FROM guest")->fetch_row()[0] ?? 0);
$demquaytay = ($connect->query("SELECT SUM(quaytay) FROM users")->fetch_row()[0] ?? 0);
$demdiemtichluy = ($connect->query("SELECT SUM(diemtichluy) FROM users")->fetch_row()[0] ?? 0);
$demvc = ($connect->query("SELECT COUNT(*) FROM users WHERE nguoiyeu !=0")->fetch_row()[0] ?? 0);
$demsoanh = ($connect->query("SELECT COUNT(*) FROM photo")->fetch_row()[0] ?? 0);
$demtien = ($connect->query("SELECT SUM(menhgia) FROM naptien")->fetch_row()[0] ?? 0);
 $demsodh = ($connect->query("SELECT COUNT(*) FROM danhhieu")->fetch_row()[0] ?? 0);
 $demgiftcode = ($connect->query("SELECT COUNT(*) FROM giftcode")->fetch_row()[0] ?? 0);
 $demuser = ($connect->query("SELECT COUNT(*) FROM users")->fetch_row()[0] ?? 0);
 $demsoclick = ($connect->query("SELECT COUNT(*) FROM lichsu")->fetch_row()[0] ?? 0);
$demsokh = ($connect->query("SELECT COUNT(*) FROM kichhoat")->fetch_row()[0] ?? 0);
$total = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `duyet` = '1'")->fetch_row()[0] ?? 0);
Echo '<div class="danhmuc">Thống kê</div>';
Echo '<div class="menu list-top">Số công dân: <b>'.$demuser.'</b></div>';
Echo '<div class="menu list-top">Số xu: <b>'.$demsoxu.'</b></div>';
Echo '<div class="menu list-top">Số vinaxu: <b>'.$demsovinaxu.'</b></div>';
Echo '<div class="menu list-top">Số cá câu đươc: <b>'.$demsoca.'</b></div>';
Echo '<div class="menu list-top">Số bài viết: <b>'.$demsopost.'</b></div>';
Echo '<div class="menu list-top">Chém gió: <b>'.$demsoguest.'</b></div>';
Echo '<div class="menu list-top">Số quay tay: <b>'.$demquaytay.'</b></div>';
Echo '<div class="menu list-top">Điểm tích lũy nhận được: <b>'.$demdiemtichluy.'</b></div>';
Echo '<div class="menu list-top">Số hôn nhân: <b>'.$demvc.'</b></div>';
Echo '<div class="menu list-top">Số ảnh xã hội: <b>'.$demsoanh.'</b></div>';
Echo '<div class="menu list-top">Số Clan: <b>'.$total.'</b></div>';
if($datauser['rights'] ==9){
Echo '<div class="menu list-top">Số giftcode còn lại: <b>'.$demgiftcode.'</b></div>';
Echo '<div class="menu list-top">Số danh hiệu đã cấp: <b>'.$demsodh.'</b></div>';
Echo '<div class="menu list-top">Số truy cập: <b>'.$demsoclick.'</b></div>';
Echo '<div class="menu list-top">Đếm tiền: <b>'.$demtien.'</b></div>';
Echo '<div class="menu list-top">Số kích hoạt: <b>'.$demsokh.'</b></div>';
}
?>