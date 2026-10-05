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
<div class="omenu">Nơi đây bán những set đồ rẻ hơn mua đồ lẻ </br></br><center><img src="/images/on.png"><font color="red">NPC Ekko</font></br><img src="/avatar/50.png"></center></br>- Hãy lựa chọn khu vực mà bạn muốn đi đến.</br><br/><a href="/muaset/doreamondo.php"><img src="/muahe/vo.png">Set Doreamon Đỏ</a><br/><a href="/muaset/haitac.php"><img src="/muahe/vo.png">Set hải tặc</a><br/></div>
';
echo '<div class="phdr">Giang Henry</div></div>';
require_once('../incfiles/end.php');
?>
