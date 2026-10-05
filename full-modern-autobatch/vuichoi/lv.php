<?php
$lv = $datauser['truyna'];
If ($lv >=0 AND $lv < 100000){
$lvg = 'Nhóm: 10';
$max = 100000;
}
If ($lv >=100000 AND $lv < 500000){
$lvg = 'Nhóm: 9';
$max = 500000;
}
If ($lv >=500000 AND $lv < 2000000){
$lvg = 'Nhóm: 8';
$max = 2000000;
}
If ($lv >=2000000 AND $lv < 45000000){
$lvg = 'Nhóm: 7';
$max = 45000000;
}
If ($lv >=45000000 AND $lv < 90000000){
$lvg = 'Nhóm: 6';
$max = 90000000;
}
If ($lv >=90000000 AND $lv < 220000000){
$lvg = 'Nhóm: 5';
$max = 220000000;
}
If ($lv >=220000000 AND $lv < 500000000){
$lvg = 'Nhóm: 4';
$max = 500000000;
}
If ($lv >=500000000 AND $lv < 900000000){
$lvg = 'Nhóm: 3';
$max = 900000000;
}
If ($lv >=900000000 AND $lv < 1500000000){
$lvg = 'Nhóm: 2';
$max = 1500000000;
}
If ($lv >=1800000000){
$lvg = 'Nhóm: 1';
}
If ($datauser['set'] <10000000){
$class = 'cap'.$datauser['capset'].'';
} else {
$class = 'trangphuc';
}
$tinhtoanchuaxuly = ($lv/$max)*100;
$tinhtoan = round($tinhtoanchuaxuly);
if($type==1){
$lv = $res['truyna'];
If ($lv >=0 AND $lv < 100000){
$lvg = 'Nhóm: 10';
$max = 100000;
}
$lv = $res['truyna'];
If ($lv >=100000 AND $lv < 500000){
$lvg = 'Nhóm: 9';
$max = 500000;
}
If ($lv >=500000 AND $lv < 2000000){
$lvg = 'Nhóm: 8';
$max = 2000000;
}
If ($lv >=2000000 AND $lv < 45000000){
$lvg = 'Nhóm: 7';
$max = 45000000;
}
If ($lv >=45000000 AND $lv < 90000000){
$lvg = 'Nhóm: 6';
$max = 90000000;
}
If ($lv >=90000000 AND $lv < 220000000){
$lvg = 'Nhóm: 5';
$max = 220000000;
}
If ($lv >=220000000 AND $lv < 500000000){
$lvg = 'Nhóm: 4';
$max = 500000000;
}
If ($lv >=500000000 AND $lv < 900000000){
$lvg = 'Nhóm: 3';
$max = 900000000;
}
If ($lv >=900000000 AND $lv < 1500000000){
$lvg = 'Nhóm: 2';
$max = 1500000000;
}
If ($lv >=1800000000){
$lvg = 'Nhóm: 1';
}
If ($datauser['set'] <10000000){
$class = 'cap'.$datauser['capset'].'';
} else {
$class = 'trangphuc';
}
$tinhtoanchuaxuly = ($lv/$max)*100;
$tinhtoan = round($tinhtoanchuaxuly);
}
?>