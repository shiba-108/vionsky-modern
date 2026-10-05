<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
include'ham.php';
$urlhientai = $home.''.$_SERVER['REQUEST_URI'];
$sever = $_SERVER['REQUEST_URI'];
$DOCTYPE = 1;
$DOCTYPE2 = 2;
$hienluot = 1;
$hienluot2 = 2;
$hienluotboss = 1;
$hienluotboss2 = 2;
$table = 1;
$table2 = 2;

if ($DOCTYPE < $DOCTYPE2 -$DOCTYPE3){
echo'<?xml version="1.0" encoding="UTF-8" ?>';
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<?php }
if ($DOCTYPE > $DOCTYPE2 -$DOCTYPE3){
echo'<?xml version="1.0" encoding="UTF-8" ?>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="MobileOptimized" content="100" />
<?php } ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
<title><? echo mb_substr($textl, 0, 80); ?></title>
<link rel="stylesheet" href="http://truyenkute.sextgem.com/css/cdviet.css" type="text/css"/>
<link rel="canonical" href="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>"/>
<meta name="title" content="<? echo mb_substr($textl, 0, 80); ?>" />
<meta name="description" content="<? echo mb_substr($mota, 0, 160); ?>"/>
<meta property="og:site_name" content="Mạng xã hội giải trí trên mobile"/>
<meta property="og:image" content="<? echo $imgmeta; ?>"/>
<meta property="og:title" content="<? echo mb_substr($textl, 0, 80); ?>"/>
<meta property="og:description" content="<? echo mb_substr($mota, 0, 160); ?>" />
<meta property="og:type" content="article"/>
<meta property="og:url" content="<? echo $home.''.$_SERVER['REQUEST_URI']; ?>"/>
<? echo $metaface; ?><meta property="fb:admins" content="145778472262032" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta content="index, follow" name="robots" />
<meta name="revisit-after" content="1 days"/>
<meta name="Language" content="Vietnamese" />
<meta name="google-site-verification" content="Xy46CLz5-_goTG3zIIALSwEtNZXWwNGRkapkpJxK4wE" />
<link rel="image_src" href="<? echo $imgmeta; ?>" / >
<link rel="author" href="https://plus.google.com/107318433845657190540"/>
<link rel="icon" href="<? echo $home; ?>/favicon.ico" type="image/x-icon"/>
</head><body>
<div id="fb-root"></div>
<script type="text/javascript" src="http://khiepqua.wap.sh/CSS/snow.js"></script><script type="text/javascript" src="http://khiepqua.wap.sh/CSS/tuyet.js"></script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-56771351-1', 'auto');
ga('send', 'pageview');
</script>
<style>
.tip {
border: 1px solid #FFDBA8;
background: #FFF7C9 url('/images/tip.png') no-repeat 5px center;
font-size: 11px;
border-radius: 3px;
margin: 1px 1px 5px 1px;
padding: 4px 4px 4px 25px;
color: #333;
}
</style><div class="mainbody">
<?php if (empty($active)) { $active1 = 'class="active"'; } ?>
<div id="navbar">
<table  cellpadding="0" cellspacing="0">
<tbody><tr>
<td <?php echo $active1; ?> width="30"><a href="<?php echo $home; ?>">HOME</a></td>
<td <?php echo $active2; ?> width="30"><a href="<?php echo $home; ?>/groups/">GROUPS</a></td>
<td <?php echo $active3; ?> width="35"><a href="/store/">APP</a></td>
<td <?php echo $active4; ?> width="40"><a href="/photo/">HÀIVL</a></td>
<td <?php echo $active5; ?> width="40"><a href="/truyencuoi/">RELA</a></td>
</tr></tbody>
</table>
</div>
</div>

<div style="margin: 0px 5px">
<?php if (!$user_id) { ?>
<div class="header">
<form action="<?php echo $home; ?>/dangnhapthanhvien.php" method="post">
<p><input class="inputlogin" type="text" name="n" value="" maxlength="28" size="10"/></p>
<p><input class="inputlogin" type="password" name="p" maxlength="28" size="10"/></p>
<p><input type="hidden" name="mem" value="1" checked="checked"/></p>
<p><input class="inputsubmit" type="submit" value="Đăng Nhập"/></p><br />
<p><a href="/account/quenmatkhau.php?continue">Quên mật khẩu?</a></p>
</form>
</div>
<div class="menu list-top hot">
<a href="<?php echo $home; ?>/dangkithanhvien.php" style="color:#d48550"><b>ĐĂNG KÝ <font color="#009933;">TÀI KHOẢN </font></a> HOẶC <a href="<?php echo $home; ?>/registry.facebook" style="color:#d48550">ĐĂNG KÝ QUA <font color="blue">FACEBOOK</font>(bảo trì)</b></a>
</div>
<?php } else { ?>
<?php include'sys/insertnhanvat.php'; ?>
<?php $tongduyetuser_id = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0); ?>
<?php $new_mail = ($connect->query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'")->fetch_row()[0] ?? 0); ?>
<div class="header_menu">
<table class="main-xmenu" cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="48" class="list_post">
<img src="<?php echo $home; ?>/avatar/<?php echo $user_id; ?>.png" alt="<?php echo $login; ?>"/>
</td><td>
<div class="menu list-bottom"><?php echo nick($user_id); ?> <?php if ($tongduyetuser_id == 0 && $user_id) {echo'<a href="'.$home.'/account/tenthat.php?id='.$user_id.'">[ Đặt tên thật ]</a></div>'; } else {echo '<font color="red">(LV'.$datauser['level'].' + '.$datauser['chisolevel'].'%)</font>';
} ?><br/></div>
<div class="menu list-bottom"><img src="/icon/xu.png" alt="Xu"> <?php echo $datauser[tienxu]; ?> Xu<span style="font-size:11px;color:#e2e2e2;">|</span> <img src="/images/dollar.png" width="18px" alt="$"> <?php echo $datauser[vinaxu]; ?> Vina</div>
<div class="menu list-bottom"><img src="/icon/hp.png" alt="HP"> <?php echo $thongtinnhanvat[hp]; ?> <span style="font-size:11px;color:#e2e2e2;">/</span> <?php echo $thongtinnhanvat[hpfull]; ?></div>
</td></tr></table>
<a href="<?php echo $home; ?>/account/">Tường nhà</a>
<span style="font-size:11px;color:#e2e2e2;">|</span>
<a href="<?php echo $home; ?>/account/ruong/">Rương</b></a>
<span style="font-size:11px;color:#e2e2e2;">|</span>
<a href="<?php echo $home; ?>/notice/">Thông báo<?php if (!empty($datauser['thongbaocanhan'])){echo ' <span class="mitemCount">' .$datauser['thongbaocanhan']. '</span>';} ?></a>
<span style="font-size:11px;color:#e2e2e2;">|</span>
<?php if (!empty($new_mail)){echo ' <a href="/mail/">Tin nhắn mới<span class="mitemCount">' . $new_mail . '</span></a><span style="font-size:11px;color:#e2e2e2;">|</span>';} ?><a href="<?php echo $home; ?>/napthe/">Nạp thẻ</b></a>
</div>
<?php
$req = $connect->query("SELECT * FROM `thongbao_head` ORDER BY `time` DESC LIMIT 1");
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="menu list-top hot"> <marquee> ' . functions::smileys(bbcode::tags($res['text'])) .'</marquee></div>';
}
?>
<?php }
$time = time();
$kttg = $connect->fetch_array($connect->query("select * from `guest` WHERE `show` = '1' ORDER BY `timetg` ASC LIMIT 1"));
If ($kttg >=1){
$xss = htmlspecialchars($kttg['text']);
Echo ' <div style="border: 1px solid purple"><marquee><b>'.nick($kttg['user_id']).'</b>: '.functions::smileys(bbcode::skill($xss)).'</marquee></div>';
}
If ($time > $kttg['timetg']){
$connect->query("UPDATE `guest` SET `show` = '' WHERE `id` = '".$kttg['id']."'");
} ?>



<?php if ($user_id) { ?>
<?php $tongduyet = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `duyet` = '0'")->fetch_row()[0] ?? 0); ?>
<div class="chuyenmuc">
<a href="<?php echo $home; ?>/shop/">Cửa hàng đồ</b></a>
| <a href="<?php echo $home; ?>/khuvuichoi/quayso/">Quay số</b></a>
<?php if ($datauser['hopqua'] =='0') { ?>
| <a href="<?php echo $home; ?>/hopqua.php"><b style="color:red">Nhận Quà</b></a>
<?php } ?>
| <a href="<?php echo $home; ?>/vuichoi/">Game hero</b></a> |
<?php if ($tongduyet && $rights >= 6) 
{ ?>
| <a href="<?php echo $home; ?>/account/duyetten.php">Duyệt tên thành viên</b> (<span style="color:red;font-size:11px;"><?php echo $tongduyet ?></b>)</a>
<?php } ?>
<a href="<?php echo $home; ?>/groups/">Hội nhóm</b></a>
| <a href="<?php echo $home; ?>/mail/thu-den/">Hộp thư đến</b></a>
| <a href="<?php echo $home; ?>/bang-xep-hang/">Bảng xếp hạng</b></a>
| <a href="<?php echo $home; ?>/minigame/">Mini Games</b></a>
| <a href="/magift.php"><b style="color:red;">Đổi mã Gift</b></a>
| <a href="/mod/mauqc.php"><b style="color:green;">Mẫu Quảng Cáo</b></a>
| <a href="<?php echo $home; ?>/logout">Đăng Xuất</a>
 </div>

<?php } ?>
<?php
if ($user_id) {
include'sql.php';
include'sys/danhhieu.php';
include'sys/level.php';
include'sys/kethon.php';
include'sys/boss/luotbatdau.php';
require('sys/boss/luotchoi.php');
require('sys/luotchoi.php');
include'sys/insertnhanvat.php';
include'sys/thuhoachkhe.php';
include'sys/luotbatdau.php';
include'sys/thongbaovatnuoi.php';
include'sys/cancau.php';
include'sys/thongbaolambanh.php';
include'sys/khuonmat.php';
include'sys/caro.php';
include'sys/hopqua.php';
include'sys/baned.php';
}
?>

