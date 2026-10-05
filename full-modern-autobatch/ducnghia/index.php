<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
$bhead = 2;
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Sự Kiện Mùa Đông Kinh Hoàng';
require('../incfiles/head.php');

echo'<div class="phdr">Sự Kiện Mùa Đông Kinh Hoàng</div>';
echo'<center> <div class="dz"><b><font color="FF0000">Code Mod By Đức Nghĩa.Coppy Ghi Nguồn </b></font></center>  ';
echo'<div class="dz"> Bạn đang có ' . $datauser['allkem'] . ' mũ len Và  '.$datauser['kem'].' chưa đổi quà.</div>';
echo'<div class="omenu"><a href="/ducnghia/"><img src="/icon/giftbox.png">Ông Già NOel(bảo trì) </font></b></a></div>';
echo'<div class="omenu"><a href="/ducnghia/ducnghiaxu.php"><img src="/icon/2.gif">Tìm ông già noel xu (30%)</font></b></a></div>';
echo'<div class="omenu"><a href="/ducnghia/ducnghialg.php"><img src="/icon/1.gif">TÌm ông già noel Lượng (50%)</font></b></a></div>';
echo'<div class="omenu"><a href="/ducnghia/bxh.php"><img src="/icon/tien.png">Bảng Xếp Hạng</a></div>';
echo'<div class="omenu"><a href="/"><img src="/icon/vao.png">Hướng Dẫn</font></b></a></div>';
/*
echo'<div class="phdr">Sự kiện được thiết kế bởi Đức Nghĩa</div>';

echo'</td></tr></tbody></table></td></tr></tbody></table>';
*/
require('../incfiles/end.php');
?>
