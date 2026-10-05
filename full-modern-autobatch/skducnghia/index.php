<?
define('_IN_JOHNCMS', 1);
$noionline = 'quayso';
require_once ('../incfiles/core.php');
$textl = 'Sự Kiện Yêu Lao Động - TeenVui.Me';
require_once ('../incfiles/head.php');
if ($user_id){
//--Mod sự kiện bởi Trần Văn Hoài--//
echo'<div style="background-color: #ecfff4;border-radius: 5px;padding: 8px;margin-bottom: 5px;border: solid 1px #51ccad;">Bạn đang có: '.$datauser['point_sukien'].' điểm sự kiện, '.$datauser['lkn'].' <img src="/icon/lkn.png" title="LKN"/> và '.$datauser['lkl'].' <img src="/icon/lkl.png" alt="LKL"/></div>';
include'menu.php';
if($datauser['rights'] >=7)
echo'<div class="list-me"><a href="/sukienlaodong/themdo.php"><font color="red">Thêm đồ sự kiện</font></a></div>';
}
require_once ("../incfiles/end.php");


?>