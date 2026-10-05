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
<div class="omenu">Khu này đang thử nghiệm, vui lòng quay lại sau</br></br><center><img src="/images/on.png"><font color="red">NPC Lái Buôn</font></br><img src="/avatar/343.png"></center></br>- Đã có cá thì vào đổi.Không thì đi câu cá đi.</br><br/><a href="/doica/doicalayqua.php"><img src="/muahe/vo.png">Đổi Cá</a><br/><a href="/khusinhthai"><img src="/<br/><a href="/muahe/muaqua.php"><img src="/muahe/vo.png">Đổi Item Sự kiên Item Sự kiện</a><br/>/vo.png">Đi câu cá</a><br/></div>
';
echo '<div class="phdr">Đổi cá mod by Giang Henry</div></div>';
require_once('../incfiles/end.php');
?>
