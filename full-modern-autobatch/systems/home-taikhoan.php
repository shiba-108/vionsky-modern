<?php
if ($user_id){
### hoi phuc hp
$hoiphuchp = $thongtinnhanvat['time_hoiphuchp'] + 3600- time();
$timehoiphuchp1 = date('H', $hoiphuchp);
$timehoiphuchp2 = date('i', $hoiphuchp);
if ($thongtinnhanvat['time_hoiphuchp'] < (time() - 3580)) {
        $connect->query("UPDATE `nhanvat` SET
            `hp` = '".$thongtinnhanvat[hpfull]."',
            `time_hoiphuchp`='".$time."' 
            WHERE `user_id` = '$user_id'");
}
$chatup = ($connect->query("SELECT COUNT(*) FROM `guest` WHERE `time` AND `time` > '".(time()-300)."'")->fetch_row()[0] ?? 0);
}
?>