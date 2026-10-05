<?
define('_IN_JOHNCMS', 1);
$headmod = 'shop';
require_once ('../../incfiles/core.php');
$loaido = $_GET[mua];
$do = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = '$loaido'"));
$textl = 'Shop Đồ';
require_once ('../../incfiles/head.php');
echo '<div class="mainblok">';
@session_start();
$arr['id_loai'] = '' . $_GET['id_loai'] . '';
$kill = '' . $_GET['id_loai'] . '';
$kill2 = '' . $_GET['loai'] . '';
switch ($act) { 
default:
if ($user_id){
//--ĐỒ HOT--//
$dohot = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `hot` = '1' AND `pro` = '2'"));
if ($dohot) {
echo'<div class="danhmuc">Món Đồ Hot Nhất</div>';
echo '<div class="omenu">';
$loai = '' . $_GET['loai'] . '';
$req = $connect->query("SELECT * FROM `shop` WHERE `hot` = '1' AND `pro` ='2' ORDER BY `id` DESC LIMIT 5");
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
                      if ($user_id ==1) {
                       echo ' <a href="'.$mondo['loai'].'/an/' . $mondo['id'] . '">[<b>Ẩn</b>]</a>';
                      }
                      if(!empty($mondo[gia])) {
                      echo'<br/>Giá tiền: ' . $mondo['gia'] . ' xu';
                      } else {
                      echo'<br/>Giá tiền: <span style="font-size:12px;color:green;">' . $mondo['vnd'] . ' VNĐ</span>';
                      }
               echo'</div> ';
} 
echo '</div>';
}
if ($user_id) {
echo'<div class="phdr">Danh mục cửa hàng </div>';

echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="60px;" class="blog-avatar">';
echo '<img class="avatarforum" src="../../avatar/'.$datauser['id'].'.png" width="45" height="48" alt="'.$datauser['name'].'"/>';
echo'</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left">';
echo'</div>';
echo '<img src="/images/on.png" alt="online"/> ';
echo'<a href="/member/'.$datauser['id'].'.html"><b>'.nick($datauser['id']).'</b></a><span style="font-size:11px;color:#777;"></span><span style="float:right;"></span>';
echo'<div class="text">';
echo '
<div class="omenu"><a href="toc/">Mua Tóc</a></div>
<div class="omenu"><a href="ao/">Mua Áo</a></div>
<div class="omenu"><a href="quan/">Mua Quần</a></div>
<div class="omenu"><a href="non/">Mua Nón</a></div>
<div class="omenu"><a href="mat/">Mua Mắt</a></div>
<div class="omenu"><a href="kinh/">Mua Kính</a></div>
<div class="omenu"><a href="matna/">Mua Mặt Nạ</a></div>
<div class="omenu"><a href="canh/">Mua Cánh</a></div>
<div class="omenu"><a href="thucung/">Mua Thú Cưng</a></div>
<div class="omenu"><a href="docamtay/">Mua Đồ Cầm Tay</a></div>
<div class="omenu"><a href="khuonmat/">Mua Khuôn Mặt</a></div>
<div class="omenu"><a href="nensau/">Mua Nền Sau</a></div>
<div class="omenu"><a href="haoquang/">Mua Hào Quang</a></div>
';
if ($rights >= 9)
{
echo '<div class="omenu"><span class="red"><a href="/shop/them.php"><b>Thêm đồ mới</b></a></span></div>';
}

echo'</div></div></td></tr></tbody></table></td></tr></tbody></table>';
}
}
break;
break;
case 'unhot':
if ($rights == 9) {
$connect->query("UPDATE `shop` SET `hot` = '0'  WHERE `id` = '" . $kill . "' LIMIT 1");
header('Location: '.$home.'/shop/');
} else {
header('Location: '.$home.'/shop/');
}
break;
case 'hien':
if ($rights == 9) {
$connect->query("UPDATE `shop` SET `hienthi` = '0'  WHERE `id` = '" . $kill . "' LIMIT 1");
header('Location: '.$home.'/shop/');
} else {
header('Location: '.$home.'/shop/');
}
break;
case 'an':
if ($rights == 9) {
$connect->query("UPDATE `shop` SET `hienthi` = '1'  WHERE `id` = '" . $kill . "' LIMIT 1");
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
echo '</div>';
require_once ("../../incfiles/end.php");


?>