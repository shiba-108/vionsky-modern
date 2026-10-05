<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
$textl = 'Mini Game';
require ('../incfiles/head.php');
if (!$user_id) {
header('Location: '.$home.'');
require('../incfiles/end.php');
exit;
} else {
?>
<div class="main-xmenu">
<div class="danhmuc">Mini Game</div>
 <div class="menu"><img src="/icon/oantuti.png" alt="icon" style="vertical-align: -3px;"/> <a href="/minigame/oan-tu-ti/">Oẳn tù tì</a></div>
 <div class="menu list-top"><img src="/icon/socdia.png" alt="icon" style="vertical-align: -3px;"/> <a href="/minigame/socdia/">Xóc Dĩa</a></div>
 <div class="menu list-top"><img src="/icon/baucua.png" alt="icon" style="vertical-align: -3px;"/> <a href="/minigame/baucua/">Bầu Cua</a></div>
<div class="menu list-top"><img src="/icon/caro.png" width="15" height="15" alt="icon" style="vertical-align: -3px;"/> <a href="/caro/">Caro online</a></div></div>
<?php
}
require ('../incfiles/end.php');