<?php
$tab = 'vui';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');
$text1 = 'Mission';
if($user_id){
$nvuoc = $datauser['nvuoc'];
$nvufr = $datauser['nvufr'];
$nvuot = $datauser['nvuot'];
$win = $datauser['win'];
echo '<div class="phdr">Nhiệm vụ OCEAN</div>';
if (isset($_POST['oc'])){
if($nvuoc ==0){
$qg = ($connect->query("SELECT COUNT(*) FROM world WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
if($qg ==0){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
} else {
$connect->query("UPDATE users SET nvuoc = '1', balans = balans +150 WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công</div>';
}
}
if ($nvuoc ==1){
if ($datauser['set'] ==0){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 100, vnd = vnd + 1000, nvuoc = '2' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} 
if ($nvuoc ==2){
if ($datauser['win'] ==0){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 250, vnd = vnd + 2000, nvuoc = '3' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} 
if ($nvuoc ==3){
if ($datauser['capset'] <1){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 500, vnd = vnd + 8000, nvuoc = '4' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} elseif($nvuoc >2){
echo '<div class="rmenu">Bạn đã làm qua nhiệm vụ này</div>';
}
if ($nvuoc ==4){
if ($datauser['op1'] ==0){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 700, vnd = vnd + 10000, nvuoc = '5' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} 
if ($nvuoc ==5){
if ($datauser['truyna'] <5500){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 2000, vnd = vnd + 15000, nvuoc = '6' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} 
if ($nvuoc ==6){
if ($datauser['win'] <5){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 500, vnd = vnd + 4000, nvuoc = '7' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
}
if ($nvuoc ==7){
if ($datauser['capset'] <3){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 5000, vnd = vnd + 40000, nvuoc = '8' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
}
if ($nvuoc ==8){
if ($datauser['capset'] <5){
echo '<div class="rmenu">Nhiệm vụ chưa hoàn thành</div>';
}
else {
$connect->query("UPDATE users SET balans = balans + 10000, vnd = vnd + 120000, nvuoc = '9' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công! <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
}
} 
}
echo '<div class="menu"><font color=green>';
if($nvuoc ==0){
 $qg = ($connect->query("SELECT COUNT(*) FROM world WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
echo 'Hãy bắt đầu bảo vệ thế giới bằng cách nhận một quốc gia miễn phí để bắt đầu sự nghiệp kinh doanh của bạn nào! Ocean > Bảo vệ thế giới</font>. Tiến độ: '.$qg.'/1<br><font color="red">Phần thưởng: <b>150</b> G</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==1){
echo 'Trang bị 1 hero vào vị trí chủ lực</font>';
if ($datauser['set'] ==0){
echo ' Tiến độ: <b>0/1</b>';
} else {
echo ' Tiến độ: <b>1/1</b>';
}
echo '<br><font color=red>Phần thưởng: <b>100</b> G + <b>1000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==2){
echo 'Đánh thắng 1 trận đấu trường!</font> Tiến độ: <b>'.$win.'/1</b><br><font color=red>Phần thưởng: <b>250</b> G + <b>2000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
} if($nvuoc ==3){
echo 'Nâng cấp hero lên cấp 1 rồi trang bị chúng!</font> Tiến độ: <b>'.$datauser['capset'].'/1</b><br><font color=red>Phần thưởng: <b>500</b> G + <b>8000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
} if($nvuoc ==4){
echo 'Thăm dò boss (Ải viễn chinh > chọn boss > Chiến đấu) thăm dò không phải đánh thắng!</font>';
if($datauser['op1'] !=0){
echo ' Tiến độ: <b>1/1</b>';
} else {
echo ' Tiến độ: <b>0/1</b>';
}
echo '<br><font color=red>Phần thưởng: <b>700</b> G + <b>10000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==5){
echo 'Đạt truy nã (WANTED) 5500!</font>';
echo ' Tiến độ: <b>'.$datauser['truyna'].'/5500</b>';
echo '<br><font color=red>Phần thưởng: <b>2000</b> G + <b>15000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==6){
echo 'Thắng 5 trận đấu trường!</font> Tiến độ: <b>'.$datauser['win'].'/5</b><br><font color=red>Phần thưởng: <b>500</b> G + <b>4000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==7){
echo 'Nâng cấp hero lên cấp 3 rồi trang bị chúng!</font> Tiến độ: <b>'.$datauser['capset'].'/3</b><br><font color=red>Phần thưởng: <b>5000</b> G + <b>40000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==8){
echo 'Nâng cấp hero lên cấp 5 rồi trang bị chúng!</font> Tiến độ: <b>'.$datauser['capset'].'/5</b><br><font color=red>Phần thưởng: <b>10000</b> G + <b>120000</b> V</font><form method="post"><input type="submit" name="oc" id="submit" value="Nhận thưởng"></form>';
}
if($nvuoc ==9){
echo 'Hiện tại đã hết nhiệm vụ dành cho bạn</font>';
}
echo '</div><div class="phdr">Nhiệm vụ Hòa Đồng (cấm Spam)</div>';
echo '<div class="menu"><font color=green>';
$nvufr = $datauser['nvufr'];
if(isset($_POST['hoadong'])){
if($nvufr ==0){
if($datauser['postforum'] >=3){
$connect->query("UPDATE users SET nvufr = '1', balans = balans + 100, vnd = vnd + 2000 WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công. <a href="/vuichoi/mission.php">Nhận nhiệm vụ mới</a></div>';
} else {
echo '<div class="rmenu">Nhiệm vụ đã giao chưa hoàn thành!</div>';
}
}
}
if($nvufr ==0){
echo 'Bình luận 3 lần.</font> Tiến độ: '.$datauser['postforum'].'/3<br><font color=red><b>100</b> G + <b>2000</b> V</font><form method="post"><input type="submit" name="hoadong" id="submit" value="Nhận thưởng"></form>';
}
if($nvufr ==1){
echo 'Hiện tại đã hết nhiệm vụ dành cho bạn</font>';
}
echo '</div><div class="phdr">Nhiệm vụ khác</div><div class="menu"><font color=green>';
$nvuot = $datauser['nvuot'];
if(isset($_POST['khac'])){
if($nvuot ==1){
if($datauser['user_id2'] !=0){
$connect->query("UPDATE users SET balans = balans + 20000, nvuot = '2' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công</div>';
} else {
echo '<div class="rmenu">Chưa hoàn thành nhiệm vụ!</div>';
}
}
if($nvuot ==0){
 $checkpay = ($connect->query("SELECT COUNT(*) FROM naptien WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
if($checkpay >=1){
$pay1 = $connect->query("SELECT * FROM naptien WHERE user_id = $user_id ORDER BY id ASC LIMIT 1");
$pay = $connect->fetch_array($pay1);
$tien = $pay['tien'];
$menhgia = $pay['menhgia'];
if ($tien == 'g'){
$connect->query("UPDATE users SET balans = balans + $menhgia, nvuot = '1' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công</div>';
}
if($tien == 'd'){
$connect->query("UPDATE users SET kc = kc + $menhgia, nvuot = '1' WHERE id = $user_id");
echo '<div class="bmenu">Nhận thưởng thành công</div>';
}
} else {
echo '<div class="rmenu">Bạn chưa nạp tiền lần nào cả!</div>';
}
}
}
$paydem = ($connect->query("SELECT COUNT(*) FROM naptien WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
if($nvuot ==0){
echo 'Nạp tiền lần đầu.</font> Tiến độ: '.$paydem.'/1</font><br><font color=red>Phần thưởng: <b>100% giá trị nạp</b></font><form method="post"><input type="submit" name="khac" id="submit" value="Nhận thưởng"></form>';
echo '</div>';
}
if($nvuot ==1){
if($datauser['user_id2'] !=0){
$kh = '1';
} else {
$kh = '0';
}
echo 'Kết hôn 1 lần.</font> Tiến độ: '.$kh.'/1</font><br><font color=red>Phần thưởng: <b>20.000 G</b></font><form method="post"><input type="submit" name="khac" id="submit" value="Nhận thưởng"></form>';
echo '</div>';
}
if($nvuot ==2){
echo '<div class="rmenu">Đã hết nhiệm vụ dành cho bạn.</div>';
}
} else {
echo '<div class="rmenu">Bạn không phải thành viên</div>';
}
        require('../incfiles/end.php');
?>