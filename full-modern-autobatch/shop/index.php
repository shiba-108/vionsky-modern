<?
define('_IN_JOHNCMS', 1);
$noionline = 'shop';
require_once ('../incfiles/core.php');
$loaido = $_GET[mua];
$do = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = '$loaido'"));
$textl = 'Shop Đồ';
require_once ('../incfiles/head.php');
@session_start();
$arr['id_loai'] = '' . $_GET['id_loai'] . '';
$kill = '' . $_GET['id_loai'] . '';
$kill2 = '' . $_GET['loai'] . '';
switch ($act) { 
default:
if ($user_id){
$phantram = floor(($thongtinnhanvat['sucmanh']*100)/$thongtinnhanvat['sucmanhgoc']);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nhân Vật '.$login.'</div>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $user_id. '.png" alt="'. $login. '" class="avatar_vina"/>';
echo'<img src="/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> Xu: '.$datauser[tienxu].'<br/>';
echo'<img src="/icon/sucmanh.png" alt="icon" style="vertical-align: -3px;"/> SM: '.($thongtinnhanvat['sucmanh'] == 0 ? 'chưa có gì' : ''.$thongtinnhanvat['sucmanh'].' <span style="font-size:12px;color:green;">('.$phantram.'%)</span>').'</div>'; 
echo'</div>';
$dohot = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `hot` = '1' AND `hienthi` = '0'"));
if ($dohot) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Món Đồ Hot Nhất</div>';
$loai = '' . $_GET['loai'] . '';
$req = $connect->query("SELECT * FROM `shop` WHERE `hot` = '1' ORDER BY `id` DESC LIMIT 3");
while($mondo = $connect->fetch_array($req))
{
echo'<div class="menu list-top">';
if ($mondo['loai'] == toc) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }
if ($mondo['loai'] == ao) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }

if ($mondo['loai'] == quan) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
}

if ($mondo['loai'] == non) {
echo '<img style="background:url(/icon/nen.png);text-align: center;"src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }


if ($mondo['loai'] == kinh) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina">';
                }


if ($mondo['loai'] == mat) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina">';
                }

if ($mondo['loai'] == matna) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }

if ($mondo['loai'] == canh) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }

if ($mondo['loai'] == thucung) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
                }

if ($mondo['loai'] == docamtay) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }

if ($mondo['loai'] == khuonmat) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
                }
if ($mondo['loai'] == haoquang) {
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do" class="avatar_vina"/>';
                }
if ($mondo['loai'] == nensau) {
echo '<img src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do" class="avatar_vina"/>';
                }

                echo '<a href="'.$mondo['loai'].'/mua/' . $mondo['id'] . '">[<b>Mua</b>]</a>';
                      if ($rights == 9) {
                echo ' <a href="'.$mondo['loai'].'/unhot/' . $mondo['id'] . '">[<b>UnHot</b>]</a>';
                      }
                      if(!empty($mondo[gia])) {
                      echo'<br/>Giá tiền: ' . $mondo['gia'] . ' xu';
                      } else {
                      echo'<br/>Giá tiền: <span style="font-size:12px;color:green;">' . $mondo['vinaxu'] . ' Vinaxu</span>';
                      }
               echo'</div> ';
} 
echo '</div>';
}
if ($user_id) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Danh Sách Đồ</div>';
$toc = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'toc'")->fetch_row()[0] ?? 0);
$ao = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'ao'")->fetch_row()[0] ?? 0);
$quan = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'quan'")->fetch_row()[0] ?? 0);
$non = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'non'")->fetch_row()[0] ?? 0);
$kinh = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'kinh'")->fetch_row()[0] ?? 0);
$mat = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'mat'")->fetch_row()[0] ?? 0);
$matna = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'matna'")->fetch_row()[0] ?? 0);
$khuonmat = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'khuonmat'")->fetch_row()[0] ?? 0);
$canh = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'canh'")->fetch_row()[0] ?? 0);
$thucung = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'thucung'")->fetch_row()[0] ?? 0);
$docamtay = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'thucung'")->fetch_row()[0] ?? 0);
$haoquang = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'haoquang'")->fetch_row()[0] ?? 0);
$nensau = ($connect->query("SELECT COUNT(*) FROM `shop` WHERE `loai` = 'nensau'")->fetch_row()[0] ?? 0);
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="ao/"><b>Mua Áo</b></a> <span style="font-size:12px;color:green;">'.$ao.' item</span></div>';
echo'<div class="menu"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="toc/"><b>Mua Tóc</b></a> <span style="font-size:12px;color:green;">'.$toc.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="quan/"><b>Mua Quần</b></a> <span style="font-size:12px;color:green;">'.$quan.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="non/"><b>Mua Nón</b></a> <span style="font-size:12px;color:green;">'.$non.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="kinh/"><b>Mua Kính</b></a> <span style="font-size:12px;color:green;">'.$kinh.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="mat/"><b>Mua Mắt</b></a> <span style="font-size:12px;color:green;">'.$mat.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="matna/"><b>Mua Mặt Nạ</b></a> <span style="font-size:12px;color:green;">'.$matna.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="khuonmat/"><b>Mua Khuôn Mặt</b></a> <span style="font-size:12px;color:green;">'.$khuonmat.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="canh/"><b>Mua Cánh</b></a> <span style="font-size:12px;color:green;">'.$canh.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="thucung/"><b>Mua Thú Cưng</b></a> <span style="font-size:12px;color:green;">'.$thucung.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="docamtay/"><b>Mua Đồ Cầm Tay</b></a> <span style="font-size:12px;color:green;">'.$docamtay.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="haoquang/"><b>Hào Quang</b></a> <span style="font-size:12px;color:green;">'.$haoquang.' item</span></div>';
echo'<div class="menu list-top"><img src="/icon/next.png" alt="icon" style="vertical-align: -1px;"/>&#160;<a href="nensau/"><b>Nền sau</b></a> <span style="font-size:12px;color:green;">'.$nensau.' item</span></div>';
}
}
echo'</div>';
break;


case 'unhot':
if ($rights == 9) {
$connect->query("UPDATE `shop` SET `hot` = '0'  WHERE `id` = '" . $kill . "' LIMIT 1");
header('Location: '.$home.'/shop/');
} else {
header('Location: '.$home.'/shop/');
}
break;
case 'hot':
if ($rights == 9) {
$connect->query("UPDATE `shop` SET `hot` = '1'  WHERE `id` = '" . $kill . "' LIMIT 1");
header('Location: '.$home.'/shop/');
} else {
header('Location: '.$home.'/shop/');
}
break;

case 'xoa':
if ($rights == 9) {
include'sys/xoa.php';
}
break;
case 'set':
include'sys/mua.php';
break;
case 'deo':
include'sys/mac.php';
break;
case 'chuyen':
include'sys/chuyen.php';
break;
case 'nangcap':
include'sys/cuonghoa.php';
break;
case 'thao':
include'sys/thao.php';
break;
case 'ban':
include'sys/ban.php';
break;
}
require_once ("../incfiles/end.php");


?>