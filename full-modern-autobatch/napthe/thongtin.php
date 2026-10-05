<?php
error_reporting(0);
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(empty($user_id)){
echo '<div class="footer">Đăng Nhập</div><div class="menu"><center>Để sử dụng vui lòng đăng nhập!</center></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="danhmuc">Mệnh giá Thẻ nạp</div>
<div class="list1">Card 10.000 VNĐ = 10.000 Xu
Card 20.000 VNĐ = 25.000 Xu
Card 50.000 VNĐ = 75.000 Xu
Card 100.000 VNĐ = 175.000 Xu
Card 200.000 VNĐ = 400.000 Xu
Card 500.000 VNĐ = 1.000.000 Xu</div>';
require('../incfiles/end.php');
?>
