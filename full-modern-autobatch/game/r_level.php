<?php
/*//////////////////////////////////VUI LÒNG TÔN TRỌNG BẢN QUYỀN TÁC GIẢ KHÔNG XOÁ DÒNG NÀY///////////////////////////*/
// Game rồng city                                                                                                     //
//  Tác giả: Hoàng Anh                                                                                                //
// Support: tuoitre4u.com                                                                                             //
//  Contact: hoanganh185995@gmail.com hoặc 0949784127/////////////////////////////////////////////////////////////////*/

function dlevel($var) {
$dlevel = $connect->fetch_array($connect->query("SELECT `exp` FROM `rong_city` WHERE `user_id`='{$var}'"));
if($dlevel['exp'] >= 0 &&
$dlevel['exp'] < 50) {
$exp = 50;
$level = 1;
$mau = 1000;
$mana = 500;
}
if($dlevel['exp'] >= 50 &&
$dlevel['exp'] < 100) {
$exp = 100;
$level = 2;
$mau = 1500;
$mana = 750;
}
if($dlevel['exp'] >= 100 &&
$dlevel['exp'] < 175) {
$exp = 175;
$level = 3;
$mau = 2000;
$mana = 1000;
}
if($dlevel['exp'] >= 175 &&
$dlevel['exp'] < 280) {
$exp = 280;
$level = 4;
$mau = 2500;
$mana = 1250;
}
if($dlevel['exp'] >= 280 &&
$dlevel['exp'] < 400) {
$exp = 400;
$level = 5;
$mau = 3000;
$mana = 1500;
}
if($dlevel['exp'] >= 400 &&
$dlevel['exp'] < 540) {
$exp = 540;
$level = 6;
$mau = 3500;
$mana = 1750;
}
if($dlevel['exp'] >= 540 &&
$dlevel['exp'] < 670) {
$exp = 670;
$level = 7;
$mau = 4000;
$mana = 2000;
}
if($dlevel['exp'] >= 670 &&
$dlevel['exp'] < 800) {
$exp = 800;
$level = 8;
$mau = 4500;
$mana = 2250;
}
if($dlevel['exp'] >= 800 &&
$dlevel['exp'] < 1000) {
$exp = 1000;
$level = 9;
$mau = 5000;
$mana = 2500;
}
if($dlevel['exp'] >= 1000 &&
$dlevel['exp'] < 1250) {
$exp = 1250;
$level = 10;
$mau = 5500;
$mana = 2750;
}
if($dlevel['exp'] >= 1250 &&
$dlevel['exp'] < 1600) {
$exp = 1600;
$level = 11;
$mau = 6000;
$mana = 3000;
}
if($dlevel['exp'] >= 1600 &&
$dlevel['exp'] < 2000) {
$exp = 2000;
$level = 12;
$mau = 6500;
$mana = 3250;
}
if($dlevel['exp'] >= 2000 &&
$dlevel['exp'] < 2450) {
$exp = 2450;
$level = 13;
$mau = 7000;
$mana = 3500;
}
if($dlevel['exp'] >= 2450 &&
$dlevel['exp'] < 3000) {
$exp = 3000;
$level = 14;
$mau = 7500;
$mana = 3750;
}
if($dlevel['exp'] >= 3000 &&
$dlevel['exp'] < 3700) {
$exp = 3700;
$level = 15;
$mau = 8000;
$mana = 4000;
}
if($dlevel['exp'] >= 3700 &&
$dlevel['exp'] < 4600) {
$exp = 4600;
$level = 16;
$mau = 8500;
$mana = 4200;
}
if($dlevel['exp'] >= 4600 &&
$dlevel['exp'] < 5500 ) {
$exp = 5500;
$level = 17;
$mau = 9000;
$mana = 4500;
}
if($dlevel['exp'] >= 5500 &&
$dlevel['exp'] < 6500) {
$exp = 6500;
$level = 18;
$mau = 9500;
$mana = 4750;
}
if($dlevel['exp'] >= 6500 &&
$dlevel['exp'] < 7600) {
$exp = 7600;
$level = 19;
$mau = 10000;
$mana = 5000;
}
if($dlevel['exp'] >= 7600 &&
$dlevel['exp'] < 8900) {
$exp = 8900;
$level = 20;
$mau = 10500;
$mana = 5250;
}
if($dlevel['exp'] >= 8900 &&
$dlevel['exp'] < 10200) {
$exp = 10200;
$level = 21;
$mau = 11000;
$mana = 5500;
}
if($dlevel['exp'] >= 10200 &&
$dlevel['exp'] < 11800) {
$exp = 11800;
$level = 22;
$mau = 11500;
$mana = 5750;
}
if($dlevel['exp'] >= 11800 &&
$dlevel['exp'] < 12900) {
$exp = 12900;
$level = 23;
$mau = 12000;
$mana = 6000;
}
if($dlevel['exp'] >= 12900 &&
$dlevel['exp'] < 14400) {
$exp = 14400;
$level = 24;
$mau = 12500;
$mana = 6250;
}
if($dlevel['exp'] >= 14400 &&
$dlevel['exp'] < 16700) {
$exp = 16700;
$level = 25;
$mau = 13000;
$mana = 6500;
}
if($dlevel['exp'] >= 16700 &&
$dlevel['exp'] < 17500) {
$exp = 17500;
$level = 26;
$mau = 13500;
$mana = 6750;
}
if($dlevel['exp'] >= 17500 &&
$dlevel['exp'] < 18000) {
$exp = 18000;
$level = 27;
$mau = 14000;
$mana = 7000;
}
if($dlevel['exp'] >= 18000 &&
$dlevel['exp'] < 20000) {
$exp = 20000;
$level = 28;
$mau = 14500;
$mana = 7250;
}
if($dlevel['exp'] >= 20000 &&
$dlevel['exp'] < 22500) {
$exp = 22500;
$level = 29;
$mau = 15000;
$mana = 7500;
}
if($dlevel['exp'] >= 25000 &&
$dlevel['exp'] < 26000) {
$exp = 25000;
$level = 30;
$mau = 15500;
$mana = 7750;
}
if($dlevel['exp'] >= 30000 &&
$dlevel['exp'] < 31000) {
$exp = 30000;
$level = 31;
$mau = 17500;
$mana = 8250;
}
if($dlevel['exp'] >= 34000 &&
$dlevel['exp'] < 35000) {
$exp = 34000;
$level = 32;
$mau = 19000;
$mana = 9500;
}
if($dlevel['exp'] >= 36700 &&
$dlevel['exp'] < 38000) {
$exp = 36700;
$level = 33;
$mau = 21500;
$mana = 10750;
}
if($dlevel['exp'] >= 40900 &&
$dlevel['exp'] < 41900) {
$exp = 40900;
$level = 34;
$mau = 23000;
$mana = 16000;
}
if($dlevel['exp'] >= 45000 &&
$dlevel['exp'] < 45000) {
$exp = 45000;
$level = 35;
$mau = 50000;
$mana = 20000;
}
$xuat = ''.$exp.'|'.$level.'|'.$mau.'|'.$mana.'';
return $xuat;
}
function tienhoa($var) {
$tienhoa = $connect->fetch_array($connect->query("SELECT `level` FROM `rong_city` WHERE `user_id`='{$var}'"));
if(empty($tienhoa['level'])) {
$th = 1;
} else
if($tienhoa['level'] >= 1 && $tienhoa['level'] < 5) {
$th = 1;
} else if($tienhoa['level'] >= 5 && $tienhoa['level'] < 10) {
$th = 2;
} else if($tienhoa['level'] >= 10 && $tienhoa['level'] < 15) {
$th = 3;
} else if($tienhoa['level'] >= 15 && $tienhoa['level'] < 20) {
$th = 4;
} else if($tienhoa['level'] >= 20 && $tienhoa['level'] < 25) {
$th = 5;
} else if($tienhoa['level'] >= 25 && $tienhoa['level'] < 30) {
$th = 6;
} else if($tienhoa['level'] >= 30 && $tienhoa['level'] < 35) {
$th = 6;
} else if($tienhoa['level'] >= 35) {
$th = 6;
}
return $th;
}
?>