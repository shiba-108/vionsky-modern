<?php
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 208-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);

session_name("SESID");
session_start();
$headmod = 'Shop Boss';
$textl = 'Shop Boss';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
echo'<div class="phdr"><b>Shop Boss </b></div><hr>';

echo'<div class="phdr"><b>Shop Vũ Khí </b></div>
<div class="list2"><img src="/boss/img/1202.png"><a href="/sanbay/asq.php"> Nokia 1202 </a><br/></div>
<div class="list2"><img src="/boss/img/banphim.png"><a href="/sanbay/asq.php"> Hero KeyBoard </a><br/></div>
<div class="list2"><img src="/boss/img/gach.png"><a href="/sanbay/asq.php"> Lu Gạch</a><br/></div>
<div class="list2"><img src="/boss/img/lao.png"><a href="/sanbay/asq.php"> Tông Lào </a><br/></div>
';

echo'<div class="phdr"><b>Shop Tăng HP </b></div><hr>
<div class="list2"><img src="/boss/img/thiensu.png"><a href="/sanbay/asq.php"> Thiên Sứ </a><br/></div>';

require_once ("../incfiles/end.php");
?>