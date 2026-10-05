<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Đổi Quà Sự Kiện Yêu Lao Động'; 
require_once('../incfiles/head.php');
if(!$user_id)
{
echo '<div class="list-me">Bạn không phải là thành viên!</div>';
}else
{
//--Mod sự kiện bởi Trần Văn Hoài--//
if(!isset($_POST['doi']) AND !isset($_POST['doiqua'])){

echo'<div class="danhmuc">Danh Sách Món Đồ Sự Kiện YÊU LAO ĐỘNG</div>';
echo'<div class="list-me">Bạn đang có: '.$datauser['point_sukien'].' điểm sự kiện</div> ';
$req = $connect->query("SELECT * FROM `sukien`");
while($starddvn = $connect->fetch_array($req))
{
$layid = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `id_loai` = '".$starddvn['id_loai']."' AND `loai` = '".$starddvn['loai']."'"));
echo'<div class="list-me"><div style="float:left;width:10%">
            ';
echo'<img style="background:url(/icon/nen.png);text-align: center;"  src="/vatpham/'.$layid['id'].'.png">
	</div>';
		echo'<form action="" method="post"><b>'.$starddvn['tenvatpham'].'</b><br/>'.$starddvn['tangsucmanh'].' SM - '.$starddvn['tanghp'].' HP<input type="hidden" name="id" value="'.$starddvn['id'].'" size="30" />';
		echo'<br/><input type="submit" name="doi" value="Đổi quà"/></b></form>
		
	</div>';
}
//--Mod sự kiện bởi Trần Văn Hoài--//
echo'<div style="background-color: #ecfff4;border-radius: 5px;padding: 8px;margin-bottom: 5px;border: solid 1px #51ccad;">Đang cập nhật thêm...</div>';
}

if(isset($_POST['doi']))
{
$id = $_POST['id'];
$star = $connect->fetch_array($connect->query("SELECT * FROM `sukien` WHERE `id` = '".$id."'"));
if(empty($star['tenvatpham']))
echo'<div class="list-me">Lỗi! Món đồ không tồn tại</div>';
else
{
echo'<div class="danhmuc">Đổi quà sự kiện</div>';
echo'<form action="doiqua.php" method="post">';
echo'<div class="list-me"><div style="float:left;width:10%">
            ';
echo'<img src="/images/'.$star['loai'].'/'.$star['id_loai'].'.png">
	</div>';
		echo'Bạn có chắc muốn đổi '.$star['point_need'].' điểm lấy <b>'.$star['tenvatpham'].'</b> không?<input type="hidden" name="id" value="'.$star['id'].'" size="30" />';
		echo'<br/><input type="submit" name="doiqua" value="Có"/></b></form>
		
	</div>';
//--Mod sự kiện bởi Trần Văn Hoài--//
}
}
if(isset($_POST['doiqua']))
{
$id = $_POST['id'];
$star = $connect->fetch_array($connect->query("SELECT * FROM `sukien` WHERE `id` = '$id'"));
if(empty($star['tenvatpham']))
echo'<div class="list-me">Lỗi! Món đồ không tồn tại</div>';
else
{
$point_need = $star['point_need'];
if($point_need <= $datauser['point_sukien'])
{

$id_loai = $star['id_loai'];
$loai = $star['loai'];
$tenvatpham = $star['tenvatpham'];
$tangsucmanh = $star['tangsucmanh'];
$tanghp = $star['tanghp'];
                     echo'<div class="list-me">Đổi quà thành công! Vui lòng Kiểm tra rương đồ.</div> ';
                       echo'<div class="list-me"><a href="/sukienlaodong" title="Return">Quay lại</a></div> ';
                $connect->query("INSERT INTO `kho` SET 
               `user_id`='" . $user_id. "',
               `id_loai`='" . $id_loai . "',
               `loai`='" . $loai . "',
               `type`='2',
               `tenvatpham`='" . $tenvatpham . "',
               `tangsucmanh`='" . $tangsucmanh . "',
               `tanghp`='" . $tanghp . "',
               `kieudo` = '0'
               ");
}
else
echo'<div class="list-me">Bạn không đủ điểm để đổi món đồ này</div>';
echo'<div class="list-me"><a href="/sukienlaodong/doi-qua-su-kien.html" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';
}
}
}
include'menu.php';
require('../incfiles/end.php');
?>
<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Đổi Quà Sự Kiện Yêu Lao Động'; 
require_once('../incfiles/head.php');
if(!$user_id)
{
echo '<div class="list-me">Bạn không phải là thành viên!</div>';
}else
{
if(!isset($_POST['doi']) AND !isset($_POST['doiqua'])){

echo'<div class="danhmuc">Danh Sách Món Đồ Sự Kiện YÊU LAO ĐỘNG</div>';
echo'<div class="list-me">Bạn đang có: '.$datauser['point_sukien'].' điểm sự kiện</div> ';
$req = $connect->query("SELECT * FROM `sukien`");
while($starddvn = $connect->fetch_array($req))
{
$layid = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `id_loai` = '".$starddvn['id_loai']."' AND `loai` = '".$starddvn['loai']."'"));
echo'<div class="list-me"><div style="float:left;width:10%">
            ';
echo'<img style="background:url(/icon/nen.png);text-align: center;"  src="/vatpham/'.$layid['id'].'.png">
	</div>';
		echo'<form action="" method="post"><b>'.$starddvn['tenvatpham'].'</b><br/>'.$starddvn['tangsucmanh'].' SM - '.$starddvn['tanghp'].' HP<input type="hidden" name="id" value="'.$starddvn['id'].'" size="30" />';
		echo'<br/><input type="submit" name="doi" value="Đổi quà"/></b></form>
		
	</div>';
}
echo'<div style="background-color: #ecfff4;border-radius: 5px;padding: 8px;margin-bottom: 5px;border: solid 1px #51ccad;">Đang cập nhật thêm...</div>';
}

if(isset($_POST['doi']))
{
$id = $_POST['id'];
$star = $connect->fetch_array($connect->query("SELECT * FROM `sukien` WHERE `id` = '".$id."'"));
if(empty($star['tenvatpham']))
echo'<div class="list-me">Lỗi! Món đồ không tồn tại</div>';
else
{
echo'<div class="danhmuc">Đổi quà sự kiện</div>';
echo'<form action="doiqua.php" method="post">';
echo'<div class="list-me"><div style="float:left;width:10%">
            ';
echo'<img src="/images/'.$star['loai'].'/'.$star['id_loai'].'.png">
	</div>';
		echo'Bạn có chắc muốn đổi '.$star['point_need'].' điểm lấy <b>'.$star['tenvatpham'].'</b> không?<input type="hidden" name="id" value="'.$star['id'].'" size="30" />';
		echo'<br/><input type="submit" name="doiqua" value="Có"/></b></form>
		
	</div>';

}
}
if(isset($_POST['doiqua']))
{
$id = $_POST['id'];
$star = $connect->fetch_array($connect->query("SELECT * FROM `sukien` WHERE `id` = '$id'"));
if(empty($star['tenvatpham']))
echo'<div class="list-me">Lỗi! Món đồ không tồn tại</div>';
else
{
$point_need = $star['point_need'];
if($point_need <= $datauser['point_sukien'])
{

$id_loai = $star['id_loai'];
$loai = $star['loai'];
$tenvatpham = $star['tenvatpham'];
$tangsucmanh = $star['tangsucmanh'];
$tanghp = $star['tanghp'];
                     echo'<div class="list-me">Đổi quà thành công! Vui lòng Kiểm tra rương đồ.</div> ';
                       echo'<div class="list-me"><a href="/sukienlaodong" title="Return">Quay lại</a></div> ';
                $connect->query("INSERT INTO `kho` SET 
               `user_id`='" . $user_id. "',
               `id_loai`='" . $id_loai . "',
               `loai`='" . $loai . "',
               `type`='2',
               `tenvatpham`='" . $tenvatpham . "',
               `tangsucmanh`='" . $tangsucmanh . "',
               `tanghp`='" . $tanghp . "',
               `kieudo` = '0'
               ");
}
else
echo'<div class="list-me">Bạn không đủ điểm để đổi món đồ này</div>';
echo'<div class="list-me"><a href="/sukienlaodong/doi-qua-su-kien.html" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';
}
}
}
include'menu.php';
require('../incfiles/end.php');
?>
