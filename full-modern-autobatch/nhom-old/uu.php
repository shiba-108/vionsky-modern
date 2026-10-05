<?php
/*///////////////////////
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');

echo '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="author" content="Diendanvn.me" /><meta http-equiv="content-language" content="vi" />
<title>Cài Đặt Modules Nhóm</title></head>
<body>';
switch($act) {
default:
echo '<div align="center"><h1>Cài Đặt Nhóm</h1></div><br/>Tên mod: Modules tạo nhóm cho JohnCMS<br/>Tác giả: Nguyên Ary<br/>Edit Diendanvn.me<br/><br/><div align="center"><a href="?act=caidat" style="color:red; font-weight:bold;">Click để bắt đầu >></a><br/><br/></div>';
break;
case 'caidat':
$connect->query("CREATE TABLE IF NOT EXISTS `nhom` (`id` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR(30) NOT NULL, `gt` VARCHAR(300) NOT NULL, `set` INT(1) NOT NULL, `time` INT NOT NULL, `user_id` INT NOT NULL, PRIMARY KEY(`id`)) CHARSET=utf8") or die("Lỗi khởi tạo nhom!");

$connect->query("CREATE TABLE IF NOT EXISTS `nhom_user` (`user_id` INT NOT NULL, `id` INT NOT NULL, `time` INT NOT NULL, `rights` INT(1) NOT NULL, `duyet` INT(1) NOT NULL) CHARSET=utf8") or die("Lỗi khởi tạo nhom_user!");

$connect->query("CREATE TABLE IF NOT EXISTS `nhom_bd` (`id` INT NOT NULL AUTO_INCREMENT, `sid` INT NOT NULL, `cid` INT NOT NULL, `user_id` INT NOT NULL, `time` INT NOT NULL, `stime` INT NOT NULL, `text` TEXT NOT NULL, `type` INT(1) NOT NULL, PRIMARY KEY(`id`)) CHARSET=utf8") or die("Lỗi khởi tạo nhom_bd!");

$connect->query("CREATE TABLE IF NOT EXISTS `nhom_like` (`user_id` INT NOT NULL, `id` INT NOT NULL, `time` INT NOT NULL, `type` INT(1) NOT NULL) CHARSET=utf8") or die("Lỗi khởi tạo nhom_like!");

$connect->query("CREATE TABLE IF NOT EXISTS `nhom_tb` (`vid` INT NOT NULL AUTO_INCREMENT, `id` INT NOT NULL, `sid` INT NOT NULL, `user_id` INT NOT NULL, `fr_user` INT NOT NULL,`type` INT(1) NOT NULL,  `time` INT NOT NULL, `read` INT(1) NOT NULL, PRIMARY KEY(`vid`)) CHARSET=utf8") or die("Lỗi khởi tạo nhom_tb!");

echo 'Cài đặt thành công!<br/><b>Hãy xoá file install.php đi!</b>';
break;
}
?>
