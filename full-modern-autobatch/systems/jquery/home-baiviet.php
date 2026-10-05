<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
if ($user_id){
###### get sql chính
$req = $connect->query("SELECT * FROM `account` WHERE `type` = 't' AND `close` != '1' AND `refid`='2' ORDER BY `time_top` DESC LIMIT $start, $kmess");

###### get page tong
$tongcongdong = ($connect->query("SELECT COUNT(*) FROM `account` WHERE `type` = 't' AND `close` != '1' AND `refid`='2'")->fetch_row()[0] ?? 0);
$tongso = $tongcongdong;


while ($arr = $connect->fetch_array($req)) { 
    $tongsobinhluan = ($connect->query("SELECT COUNT(*) FROM `binh_luan_cong_dong` WHERE `id`='" . $arr['id'] . "'")->fetch_row()[0] ?? 0);
    $arr['text'] = functions::noscrip($arr['text'], 1, 1);
    $postup = $connect->fetch_array($connect->query("SELECT * FROM `binh_luan_cong_dong` WHERE `id`='{$arr['id']}' ORDER BY `id_comment` DESC LIMIT 1"));
    $topic = $connect->fetch_array($connect->query("SELECT * FROM `account` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $arr['id'] . "'ORDER BY time DESC"));
###### code xuất bài viết
    if ($arr['tophot'] == 1) {
    echo'<div class="menu list-bottom hot">';
    } else {
    echo'<div class="menu list-bottom">';
    }
    echo'<img src="'.$home.'/icon/post.png" alt="icon"/>&#160;';
    if ($arr['edit']) {
    echo'<img src="'.$home.'/icon/khoatopic.png" alt="icon" style="vertical-align: -3px;"/>&#160;';
    } 
    if(600 > (time()-$arr['time']))
    echo ' <img src="/icon/new.png" alt="New" style="vertical-align: -4px;"/>&#160;';
    echo'<a href="'.$home.'/post/'.$arr[id].'-' . functions::khongdau(mb_substr($arr['text'], 0, 30)) . '">'.mb_substr($arr['text'], 0, 100).'</a> <span style="font-size:11px;color:#777;margin-top:5px;">('.$tongsobinhluan.')</span>&#160;';
    if ($postup[user_id] == 0) {
    echo''.nick($topic[user_id]).'';
    } else {
    echo''.nick($postup[user_id]).'';
    }
    if (mb_strlen($arr['text']) > 101){echo'...';}
    echo'</div>';
    +$i;
}
}
?>