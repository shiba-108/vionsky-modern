<?php 
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
$id = intval(trim(abs($_GET['id'])));
if(!isset($_GET['id'])) {

$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT 5");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
if ($vina4u['user_id'] == '559') {
echo '<img class="avatar" src="'.$home.'/icon/bot.png" alt="'.$vina4u['name'].'"/>';
} else {
echo '<img class="avatar" src="'.$home.'/avatar/'.$vina4u['user_id'].'.png" alt="'.$vina4u['name'].'"/>';
}
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo'<div class="menu list-bottom">';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.png" title="OFF"/> ' : '<img src="/icon/online.png" title="ON"/> ');
echo'<a href="/account/'.$vina4u['user_id'].'">'.nick($vina4u['user_id']).'</a>: ';
echo'</div>';
echo'<div class="box_ndung_bviet">';
$vina4u['text'] = functions::noscrip($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
echo' <span style="font-size:11px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>';
if ($rights >= 3) {echo' <span style="font-size:11px;"><a href="/teamchat/del.php?id='.$vina4u['id'].'">[x]</a></span>';}
echo'</div></div></td></tr></table>';
echo'</div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có ai chát !</div>';
}
}
?>