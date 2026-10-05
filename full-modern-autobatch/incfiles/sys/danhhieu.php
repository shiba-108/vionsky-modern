<?php
if($datauser['active'] ==1){
 $at = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Active Member' AND user_id = $user_id")->fetch_row()[0] ?? 0);
if($at ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Active Member', cap = '3', user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Active Member</b>]</font></div>';
}
////Rich X////
 $rich = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Rich X' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$rich2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Rich X' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
if($datauser['tienxu'] >=2500000 AND $datauser['tienxu'] < 6000000 AND $rich ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich X' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Rich X</b>]</font></div>';
}
if ($datauser['tienxu'] >=6000000 AND $datauser['tienxu'] <12000000 AND $rich2 == '0'){
if($rich ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich X', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Rich X' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Rich X</b>]</font></div>';
}
if ($datauser['tienxu'] >=12000000 AND $rich2 == '1'){
if($rich ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich X', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Rich X' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Rich X</b>]</font></div>';
}
////End Rich X////
////Rich VX////
 $richvx = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Rich VX' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$richvx2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Rich VX' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
if($datauser['vinaxu'] >=500 AND $datauser['vinaxu'] < 2000 AND $richvx ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich VX' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Rich VX</b>]</font></div>';
}
if ($datauser['vinaxu'] >=2000 AND $datauser['vinaxu'] <8000 AND $richvx2 == '0'){
if($richvx ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich VX', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Rich VX' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Rich VX</b>]</font></div>';
}
if ($datauser['vinaxu'] >=8000 AND $richvx2 == '1'){
if($richvx ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Rich VX2', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Rich VX' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Rich VX</b>]</font></div>';
}
////End Rich VX////
////Start Family///
$fml = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Family' AND user_id = $user_id")->fetch_row()[0] ?? 0);
if($fml ==0 AND $datauser['nguoiyeu'] !=0){
$connect->query("INSERT INTO danhhieu SET text = 'Family' AND user_id = $user_id AND cap = '3'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Family</b>]</font></div>';
}
////End Family////
////Start Good Man///
$cho = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Good Man' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$cho2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Good Man' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
$am = $connect->fetch_array($connect->query("SELECT SUM(tienxu) FROM anmay WHERE user_id = '$user_id' ORDER BY SUM(tienxu) DESC LIMIT 1"),0);
if($am['SUM(tienxu)'] >=50000 AND $am['SUM(tienxu)'] < 500000 AND $cho==0){
$connect->query("INSERT INTO danhhieu SET text = 'Good Man' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Good Man</b>]</font></div>';
}
if ($am['SUM(tienxu)'] >=500000 AND $am['SUM(tienxu)'] <5000000 AND $cho2 == '0'){
if($cho ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Good Man', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Good Man' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Good Man</b>]</font></div>';
}
if ($am['SUM(tienxu)'] >=5000000 AND $cho2 == '1'){
if($cho ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Good Man', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Good Man' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Good Man</b>]</font></div>';
}
////End Good Man///
//Start Student////
 $st = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Student' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$st2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Student' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
if($datauser['level'] >=6 AND $datauser['level'] < 10 AND $st ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Student' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Student</b>]</font></div>';
}
if ($datauser['level'] >=10 AND $datauser['level'] <13 AND $st2 == '0'){
if($st ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Student', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Student' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Student</b>]</font></div>';
}
if ($datauser['level'] >=13 AND $st2 == '1'){
if($st ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Student', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Student' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Student</b>]</font></div>';
}
////End Student////
////Start Billionaire///
$tp = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Billionaire' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$tp2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Billionaire' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
$bl = $connect->fetch_array($connect->query("SELECT * FROM naptien WHERE user_id = '$user_id' ORDER BY menhgia DESC LIMIT 1"),0);
if($bl['menhgia'] >=50000 AND $bl['menhgia'] < 200000 AND $tp==0){
$connect->query("INSERT INTO danhhieu SET text = 'Billionaire' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Billionaire</b>]</font></div>';
}
if ($bl['menhgia'] >=200000 AND $bl['menhgia'] <500000 AND $tp2 == '0'){
if($tp ==0){
$connect->query("INSERT INTO danhhieu SET user_id = $user_id, text = 'Billionaire'");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Billionaire' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Billionaire</b>]</font></div>';
}
if ($bl['menhgia'] >=500000 AND $tp2 =='1'){
if($tp ==0){
$connect->query("INSERT INTO danhhieu SET user_id = $user_id, text = 'Billionaire'");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Billionaire' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Billionaire</b>]</font></div>';
}
////End Billionaire///
//Start Predator////
 $qt = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Predators' AND user_id = $user_id")->fetch_row()[0] ?? 0);
$qt2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Predators' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0);
if($datauser['quaytay'] >=7 AND $datauser['quaytay'] < 20 AND $qt ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Predators', user_id = $user_id, cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Predators</b>]</font></div>';
}
if ($datauser['quaytay'] >=20 AND $datauser['quaytay'] <38 AND $qt2 == '0'){
if($qt ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Predators', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Predators' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Predators</b>]</font></div>';
}
if ($datauser['quaytay'] >=38 AND $qt2 =='1'){
if($qt ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Predators', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Predators' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Predators</b>]</font></div>';
}
////End Predator////
//Start Prisoner///
$tt = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Prisoner' AND user_id = $user_id")->fetch_row()[0] ?? 0);
 $tt2 = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE text = 'Prisoner' AND user_id = $user_id AND cap = '2'")->fetch_row()[0] ?? 0); 
$dtt = ($connect->query("SELECT COUNT(*) FROM cms_ban_users WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
if($dtt >=1 AND $dtt < 4 AND $tt==0){
$connect->query("INSERT INTO danhhieu SET text = 'Prisoner' AND user_id = $user_id AND cap = '1'");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=blue>[<b>Prisoner</b>]</font></div>';
}
if ($dtt ==4 AND $tt2 == '0'){
if($tt ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Prisoner', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '2' WHERE text = 'Prisoner' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=red>[<b>Prisoner</b>]</font></div>';
}
if ($dtt >=5 AND $tt2 == '1'){
if($tt ==0){
$connect->query("INSERT INTO danhhieu SET text = 'Prisoner', user_id = $user_id");
}
$connect->query("UPDATE danhhieu SET cap = '3' WHERE text = 'Prisoner' AND user_id = $user_id");
echo '<div class="thongbaomini"><img src="/icon/cup.png"> Chúc mừng! Bạn đạt được danh hiệu <font color=purple>[<b>Prisoner</b>]</font></div>';
}
////End Prisioner///
}
?>

