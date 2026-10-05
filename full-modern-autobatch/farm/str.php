<?php
if($datauser['fermer_oput']>=0 && $datauser['fermer_oput']<=150)$level=0;
elseif($datauser['fermer_oput']>=151 && $datauser['fermer_oput']<=300)$level=1;
elseif($datauser['fermer_oput']>=301 && $datauser['fermer_oput']<=800)$level=2;
elseif($datauser['fermer_oput']>=801 && $datauser['fermer_oput']<=1300)$level=3;
elseif($datauser['fermer_oput']>=1301 && $datauser['fermer_oput']<=2000)$level=4;
elseif($datauser['fermer_oput']>=2001 && $datauser['fermer_oput']<=3000)$level=5;
elseif($datauser['fermer_oput']>=3001 && $datauser['fermer_oput']<=4500)$level=6;
elseif($datauser['fermer_oput']>=4501 && $datauser['fermer_oput']<=6000)$level=7;
elseif($datauser['fermer_oput']>=6001 && $datauser['fermer_oput']<=9000)$level=8;
elseif($datauser['fermer_oput']>=9001 && $datauser['fermer_oput']<=12000)$level=9;
elseif($datauser['fermer_oput']>=12001 && $datauser['fermer_oput']<=16000)$level=10;
elseif($datauser['fermer_oput']>=16001 && $datauser['fermer_oput']<=20000)$level=11;
elseif($datauser['fermer_oput']>=20001 && $datauser['fermer_oput']<=25000)$level=12;
elseif($datauser['fermer_oput']>=25001 && $datauser['fermer_oput']<=30000)$level=13;
elseif($datauser['fermer_oput']>=30001 && $datauser['fermer_oput']<=35000)$level=14;
elseif($datauser['fermer_oput']>=35001 && $datauser['fermer_oput']<=40000)$level=15;
elseif($datauser['fermer_oput']>=40001 && $datauser['fermer_oput']<=50000)$level=16;
elseif($datauser['fermer_oput']>=50001 && $datauser['fermer_oput']<=60000)$level=17;
elseif($datauser['fermer_oput']>=60001 && $datauser['fermer_oput']<=70000)$level=18;
elseif($datauser['fermer_oput']>=70001 && $datauser['fermer_oput']<=85000)$level=19;
elseif($datauser['fermer_oput']>=85001 && $datauser['fermer_oput']<=90000)$level=20;
elseif($datauser['fermer_oput']>=90001 && $datauser['fermer_oput']<=105000)$level=21;
elseif($datauser['fermer_oput']>=105001 && $datauser['fermer_oput']<=115000)$level=22;
elseif($datauser['fermer_oput']>=115001 && $datauser['fermer_oput']<=130000)$level=23;
elseif($datauser['fermer_oput']>=130001 && $datauser['fermer_oput']<=155000)$level=24;
elseif($datauser['fermer_oput']>=155001 && $datauser['fermer_oput']<=170000)$level=25;
elseif($datauser['fermer_oput']>=170001 && $datauser['fermer_oput']<=190000)$level=26;
elseif($datauser['fermer_oput']>=190001 && $datauser['fermer_oput']<=210000)$level=27;
elseif($datauser['fermer_oput']>=210001 && $datauser['fermer_oput']<=230000)$level=28;
elseif($datauser['fermer_oput']>=230001 && $datauser['fermer_oput']<=250000)$level=29;
elseif($datauser['fermer_oput']>=250001 && $datauser['fermer_oput']<=270000)$level=30;
elseif($datauser['fermer_oput']>=270001 && $datauser['fermer_oput']<=290000)$level=31;
elseif($datauser['fermer_oput']>=290001 && $datauser['fermer_oput']<=320000)$level=32;
elseif($datauser['fermer_oput']>=320001 && $datauser['fermer_oput']<=340000)$level=33;
elseif($datauser['fermer_oput']>=340001 && $datauser['fermer_oput']<=360000)$level=34;
elseif($datauser['fermer_oput']>=360001 && $datauser['fermer_oput']<=400000)$level=35;
elseif($datauser['fermer_oput']>=400001 && $datauser['fermer_oput']<=450000)$level=36;
elseif($datauser['fermer_oput']>=450001 && $datauser['fermer_oput']<=500000)$level=37;
elseif($datauser['fermer_oput']>=500001 && $datauser['fermer_oput']<=550000)$level=38;
elseif($datauser['fermer_oput']>=550001 && $datauser['fermer_oput']<=600000)$level=39;
elseif($datauser['fermer_oput']>=600001 && $datauser['fermer_oput']<=650000)$level=40;
elseif($datauser['fermer_oput']>=650001 && $datauser['fermer_oput']<=700000)$level=41;
elseif($datauser['fermer_oput']>=700001 && $datauser['fermer_oput']<=750000)$level=42;
elseif($datauser['fermer_oput']>=750001 && $datauser['fermer_oput']<=800000)$level=43;
elseif($datauser['fermer_oput']>=800001 && $datauser['fermer_oput']<=850000)$level=44;
elseif($datauser['fermer_oput']>=850001 && $datauser['fermer_oput']<=900000)$level=45;
elseif($datauser['fermer_oput']>=950001 && $datauser['fermer_oput']<=1000000)$level=46;
elseif($datauser['fermer_oput']>=1000001 && $datauser['fermer_oput']<=1100000)$level=47;
elseif($datauser['fermer_oput']>=1100001 && $datauser['fermer_oput']<=1200000)$level=48;
elseif($datauser['fermer_oput']>=1200001 && $datauser['fermer_oput']<=1300000)$level=49;
elseif($datauser['fermer_oput']>=1300001)$level=50;

if($datauser['fermer_level']!=$level)
$connect->query("UPDATE `users` SET `fermer_level` = '".$level."' WHERE `id` = $user_id LIMIT 1");
$i = $connect->query("select * from `fermer_gr` WHERE `kol` = '0' ");
while ($ii = $connect->fetch_array($i)){
$semenk=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$ii[semen]'  LIMIT 1"));
$pt=rand($semenk['rand1'],$semenk['rand2']);
if($ii['woter']==0)$pt=floor($pt/2);
$connect->query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = '$ii[id]' LIMIT 1");
}


?>
