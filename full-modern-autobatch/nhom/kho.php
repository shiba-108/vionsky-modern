<?php
define('_IN_JOHNCMS',1);	
include('../incfiles/core.php');
$textl='Shop Bang hội';
include('../incfiles/head.php');
echo'<div class="phdr">Kho Bang Hội</div>';
$sql=$connect->query("select `id` from `nhom_user` where `user_id`='".$user_id."' limit 1")or die( mysql_error());
if(!$connect->query("SELECT * FROM ...")$sql)){
	echo functions::display_error('Bạn không phải là thành viên của bất cứ bang nào');
	include('../incfiles/end.php');
	exit;
}
$cl=$connect->fetch_array($sql);
$sqltong=$connect->query("select `id` from `clan_kho` where `clan`='".$cl['id']."'")or die( mysql_error());
$tong=$connect->query("SELECT * FROM ...")$sqltong)or die(mysql_error());
$s=$connect->query("select * from `clan_kho` where `clan`='".$cl['id']."' limit $start,$kmess")or die( mysql_error());
if(!($tong)){
	echo functions::display_error('Bang không có vật phẩm nào!');
	include('../incfiles/end.php');
	exit;
}
switch($_GET['act']){
	case 'mac':
		$id=intval($_GET['id']);
		$check=$connect->query("select `id` from `clan_kho` where `clan`='".$cl['id']."' and `vp`='".$id."' limit 1");
		if(!$connect->query("SELECT * FROM ...")$check)){
			echo functions::display_error('Không tìm thấy vật phẩm này!');
			include('../incfiles/end.php');
			exit;
		}
		$vp=$connect->fetch_array($connect->query("select `loai`,`vp` from `shop_clan` where `id`='$id'"));
		$connect->query("update `users` set `".$vp['loai']."`='".$vp['vp']."' where `id`='$user_id' limit 1")or die( mysql_error());
		echo'<div class="label-success"> Bạn đã mặc thành công</div>';
	break;
	default:
		while($a=$connect->fetch_array($s)){
			echo'<div class="list1">';
			$vp=$connect->fetch_array($connect->query("select `loai`,`vp`,`name` from `shop_clan` where `id`='".$a['vp']."'"));
			echo'<p><img src="'.$home.'/images/'.$vp['loai'].'/'.$vp['vp'].'.png">'.$vp['name'].'</p>';
			echo'<p align="center"><a href="kho.php?act=mac&id='.$a['vp'].'"><button>Dùng vật phẩm</button></a></p>';
			echo'</div>';
		}
	if($tong>$kmess)
			echo '<div class="menu">'.functions::display_pagination('kho.php?page=',$tong,$start,$kmess).'</div>';	
	break;
}
include('../incfiles/end.php');
?>