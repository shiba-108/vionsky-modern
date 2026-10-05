<?php
define('_IN_JOHNCMS', 1);
$headmod= 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl= 'Sự kiện mùa hè';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Sự kiện Mùa Hè Sôi Động</b></div>';
echo'
<div class="omenu">Chào mừng bạn đến với Sk Mùa hè sôi động 2015.Sự kéo dài từ 3-6 đến 30-7</br></br><center><img src="/images/on.png"><font color="red">NPC Kid</font></br><img src="/avatar/50.png"></br></center></br>- Hãy lựa chọn khu vực mà bạn muốn đi đến.</br><br/><a href="/muahe/muaqua.php"><img src="/muahe/vo.png">Mua Item Sự kiện</a><br/><a href="/doica"><img src="/muahe/vo.png">Sự kiện câu cá</a><br/></div>
';
echo '<div class="phdr">Sự kiện mùa hè sôi động</div></div>';
require_once('../incfiles/end.php');
?>
