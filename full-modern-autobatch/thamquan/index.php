<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Tìm Tham Quan';
require('../incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$sub = explode(',',$times);
If ($user_id){
echo '<div class="phdr"><b>Sự kiện tìm tham quan</b></div>';
$times = date("H");
echo '<div class="thanhpho"></div>';
echo ' <div class="cola"> <center> <font color="black"><img src="'.$home.'/avatar/3.png"></br><b>  Đây là lính tham quan đang bỏ trốn ae hãy đi tìm và đánh hắn để được thưởng xu<br><font color="red">code mod by Đức Nghĩa</font><br><a href="/thamquan/danh.php"><input type="button" value="Tìm Hắn"/></a></b> </div> </center>  ';

require('../incfiles/end.php');
}
?>