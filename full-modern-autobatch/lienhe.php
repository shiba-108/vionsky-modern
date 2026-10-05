<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('incfiles/core.php');
$lng_forum = core::load_lng('forum');
$textl = 'Liên hệ các BQT Vina4u';
$mota = 'Thông tin của các ban quản trị Vina4u để các bạn có thể liên hệ khi cần thiết !';
require ('incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Liên hệ hỗ trợ</div>';
echo'<div class="menu list-bottom"><img src="/icon/hotel-kt.png" alt="icon" style="vertical-align: -3px;"/> <span style="color:#318191;">Admin (TGG): 0167.887.2140</span>';
echo'<div class="post_time">Các bạn có thể liên hệ "Thịng" để báo lỗi, góp ý, những vấn đề về kĩ thuật YDH. Thịnh là người sáng lập.</div>';
echo'</div>';
require ('incfiles/end.php');