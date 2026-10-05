<?
echo '<div class="homeforum"><div class="icon-home"><div class="home">MXH VNVUICHOI.ME</div></div></div>';
if ($user_id) {
$list = array();
$new_sys_mail = ($connect->query("SELECT COUNT(*) FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `sys`='1' AND `delete`!='$user_id';")->fetch_row()[0] ?? 0);
if ($new_sys_mail) $list[] = '<a href="' . $home . '/mail/index.php?act=systems">&nbsp;&nbsp;<img src="/mail/images/thongbaomoi.gif"><font color="red"> Bạn có ' . $new_sys_mail . ' thông báo</font></a>';
if (!empty($list)) echo'' . functions::display_menu($list, ', ') . '';
}
require('nhanqua.php');
if ($user_id ) {
if(time() > $datauser['tgonline'] + 900 ){
echo '<div class="list1"><img src="/images/qua.png"/> <a href="/users/baodanh.php"><b>Nhận quà online</b></a></div>';
}
echo '<div class="list1"><img src="/images/chongchong.gif"/> <a href="/muahe/index.php"><b>Sự Kiện Mua Quà</b></a></div>';
echo '</br><div class="list1"><img src="/images/chongchong.gif"/> <a href="/muaset/index.php"><b>Mua Set Đồ</b></a></div>';
////////////
$time = time();
$req = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `close`!='1' AND `thongbao` = '1' ORDER BY `time` DESC LIMIT 3");
echo '<div class="mainblok"><div class="phdr"><a href="/news">Thông báo</a></div>';
while ($res = $connect->fetch_assoc($req)) {
echo is_integer($i / 2) ? '<div class="list2">' : '<div class="list1">';
echo ' <a href="'.$home.'/forum/'.functions::nhanhnao($res["text"]).'_' . $res['id'] . '.html">' . functions::smileys(tags($res['text'])) . '</a>';
echo '</div>';
}
$mp = new mainpage();
echo $mp->news;
echo '</div>';
////////////




echo'<hr>';
echo '<div class="phdr">MENU VNVUICHOI</div>';
echo'<div style="text-align:center"><table width="100%" border="0" cellspacing="0"><br/><tr class="list1"><td width="32%">';
echo'<a href="/nongtrai/nongtrai.php"><img src="/images/farmloc.png"/><br/>Nông Trại</a>';
echo'</td><td width="32%">';
echo'<a href="/nangcap"><img src="/images/muasamloc.png"/><br/>Khu mua Sắm</a>';
echo'</td><td width="35%">';
echo'<a href="' . $set['homeurl'] . '/quayso"><img src="/images/giaitri.png"/><br/>Khu Giải Trí</a>';
echo'</td></tr></table></div>';
echo'<div style="text-align:center"><table width="100%" border="0" cellspacing="0"><br/><tr class="list1"><td width="32%">';
echo'<a href="/khusinhthai/index.php"><img src="/khusinhthai/lozz.png"/><br/>Khu sinh thái</a>';
echo'</td><td width="32%">';
echo'<a href="/congvien"><img src="/congvien/congvien.png"/><br/>Công Viên</a>';

echo'</td><td width="35%">';
echo'<a href="/sanbay/sanbay.php"><img src="/images/sanbay.png"/><br/>Sân Bay</a>';
echo'</td></tr></table></div>';
}
echo'<div class="box_list_parent_index">';

//--Phòng Chém--//
echo '<div class="list"><div class="hoanganh"><table width="100%" cellpadding="0" cellspacing="0"><tr><td width="auto"><a href="/"><b><font color="#FFFFFF">Phòng Chém</font</b></a></td></tr></table></div>';
if($user_id){
$refer = base64_encode($_SERVER['REQUEST_URI']);
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="40px;" class="blog-avatar">';
if (file_exists('' .
(isset($_GET['err']) || $headmod != "mainpage" || ($headmod == 'mainpage' && $act) ? '../' : '') . '/avatar/' . $user_id . '.png'))
echo '<img src="../avatar/' . $user_id . '.png" width="45" height="45" alt="' . $user_id . '" align="top" />&#160;';
else
echo '<img src="../avatar/' . $user_id . '.png" width="45" height="45" alt="' . $user_id . '" align="top" />&#160;';
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;
echo'</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0">
<tbody><tr><td class="current-blog" rowspan="2" style="">
<div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div>';
echo '<div class="newsx"><form name="shoutbox" id="shoutbox" action="/guestbook/index.php?act=say" method="post">'.bbcode::auto_bb('shoutbox', 'msg').'<textarea placeholder="Chém vui vẻ cùng VN-LOVE.TK nhé !!!" id="msg" name="msg"></textarea><input type="hidden" name="ref" value="'.$refer.'"/><input name="submit" value="" type="submit" class="btn_write"/><input type="hidden" name="token" value="'.$token.'"></form></div>';
echo'</td></tr></tbody></table></td></tr></tbody></table>';
} else {
echo '<div class="list2">Bạn Cần <a href="/dangnhap.html"> Đăng nhập </a> để chém gió nhé</div>';
}
echo '<div id="datachat"></div>';
echo '</div>';
//--Kết thúc Phòng Chát//

if ($_GET['box']) {echo 'box đây';require('box.php');}











echo'<div class="hoanganh">Những bài viết mới nhất';
echo'</div>';




$req = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' and kedit='0' AND `close`!='1' ORDER BY `time` DESC LIMIT $start,10");
$view = $connect->query("UPDATE forum SET view = view + 1 WHERE id = $id");
$total = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `close`!='1'")->fetch_row()[0] ?? 0);
while ($arr = $connect->fetch_array($req)) {
$q3 = $connect->query("select `id`, `refid`, `text` from `forum` where type='r' and id='" . $arr['refid'] . "'");
$razd = $connect->fetch_array($q3);
$q4 = $connect->query("select `id`, `refid`, `text` from `forum` where type='f' and id='" . $razd['refid'] . "'");
$frm = $connect->fetch_array($q4);
$nikuser = $connect->query("SELECT `from`,`id`, `time` FROM `forum` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $arr['id'] . "'ORDER BY time DESC");
$colmes1 = $connect->query("SELECT * FROM ...")$nikuser);
$nam = $connect->fetch_array($nikuser);
$trang4 = $connect->query("SELECT * FROM `forum_thank` WHERE `topic` = '" . ($arr['id'] + 1) . "'");
$trang5 = $connect->query("SELECT * FROM ...")$trang4);
$laynoidung = $connect->fetch_array($connect->query("SELECT `text` FROM `forum` WHERE `type`='m' AND `refid`='" . $arr['id'] . "'"));
$gettop = $connect->fetch_assoc($connect->query("SELECT * FROM `forum` WHERE `type` = 'r' and id = '".$arr['refid']."'"));
$chuyenmuc = $gettop['text'];
$laynoidung = $connect->fetch_array($connect->query("SELECT `text` FROM `forum` WHERE `type`='m' AND `refid`='" . $arr['id'] . "'"));
$chude = $arr['text'];
$chude = html_entity_decode($chude, ENT_QUOTES,'UTF-8');
$chude = functions::checkout(mb_substr($chude, ($pos - 100), 50), 1);
echo is_integer ( $i / 2 ) ? '<div class="list1">' : '<div class="list1">' ;
echo'' . ($arr['edit'] == 1 ? '<img src="../images/khoatopic.gif" alt=""/>' : '<img src="/avatar/' . $arr['user_id'] . '.png">') . ' <a href="'.$home.'/forum/' . $arr['id'] . '.html" title="' . $chude . '">';
if ($arr['vip'] == 1)
echo '<b>';
if ($arr['indam'] == 1)
echo '<b>';
echo '<font color="2c5170">' .$chude. '</font></a>';
if ($arr['indam'] == 1)
echo '</b>';
if ($arr['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
if (mb_strlen($arr['text']) > 50)
echo'...';
if ($trang5 !== 0) echo '<font color="red"> [♥' . $trang5. ']</font>';
echo'<br/>';
echo'<span style="font-size:11px;color:#333;">Bởi : </span> <small><a href="'.$home.'/member/'.$arr['user_id'].'.html" title="' . $chude . '">'.$arr['from'].'</small></a>';
echo'<span style="font-size:11px;color:#666;"><i> Trả lời: ' . $colmes1 . ' - Xem '.$arr['view'].'</i></span>';
echo '</div>';
++$i;
}
echo '<div class="hoanganh">Trung Tâm Diễn Đàn</div>';
echo'<div class="list1"><a href="/forums/2.html"><b><font color="2c5170">Thông Báo</font></b></a><br/>';
echo'Mục thông báo chỉ dành cho các ban quản trị đăng bài và các thông báo cho member<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '2'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '2' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forums/5.html"><b><font color="2c5170">Góp ý - ý kiến</font></b></a><br/>';
echo'Mọi ý kiến đóng góp hãy đăng bài tại đây chúng tôi sẽ ghi nhận ý kiến của bạn !<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '5'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '5' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forums/8.html"><b><font color="2c5170">Nhữnh hình thức lừa đảo</font></b></a><br/>';
echo'Quyền tố cáo và khiếu nại sẽ được tập trung tại mục này hãy tố cáo những hành vi sai phạm.<br/>';
echo'<a href="/forums/11.html"><img src="/images/box.png"> Tố cáo spam</a><br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '8'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '11' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forums/9.html"><b><font color="2c5170">Hỏi - Đáp</font></b></a><br/>';
echo'Chuyên mục giải đáp những thắc mắc của mọi người !<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '9'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '9' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forums/10.html"><b><font color="2c5170">Mua - Bán</font></b></a><br/>';
echo'Giao dịch mua bán giữa hai bên ,có thể mua bán bình thường hoặc trung gian !<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '10'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '10' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo '<div class="hoanganh">Danh mục diễn đàn</div>';


echo'<div class="list1"><a href="/forum/index.php?id=14"><b><font color="2c5170">Báo Lỗi</font></b></a><br/>';
echo'Nếu gặp lỗi trên diễn đàn hãy lập topic ở đây để được giải đáp nhé!<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '14'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '14' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forum/index.php?id=15"><b><font color="2c5170">Sự Kiện Diễn Đàn</font></b></a><br/>';
echo'Nơi diễn ra các sự kiện!<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '15'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '15' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forums/46.html"><b><font color="2c5170">Điện Thoại, Máy tính</font></b></a><br/>';
echo'Game Pc , Mobile và các ứng dụng dành cho các bạn ham mê mobile !<br/>';
echo'<a href="/forums/47.html"><img src="/images/box.png"> Điện Thọai </a>';
echo'<a href="/forums/48.html"><img src="/images/box.png"> Máy Tính</a></br>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '46'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '47' OR `refid` = '48' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forum/index.php?id=34"><b><font color="2c5170">Tổng Hợp Thủ Thuật</font></b></a><br/>';
echo'Những thủ thuật mới có ích sẽ được cập nhập tại đây !.<br/>';
echo'<a href="/forum/index.php?id=35"><img src="/images/box.png"> Game </a>';
echo'<a href="/forum/index.php?id=36"><img src="/images/box.png"> Mobile </a>';
echo'<a href="/forum/index.php?id=37"><img src="/images/box.png"> Khác</a><br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '34'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '35' OR `refid` = '36' OR `refid` = '37' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo '<div class="hoanganh">Khu Vui Chơi</div>';
echo'<div class="list1"><a href="/forums/52.html"><b><font color="2c5170">Góc Truyện - Chém Gió</font></b></a><br/>';
echo'Nơi tuyển tập những bộ truyện hay nhất và là nơi ae chém gió!<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '52'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '52' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forum/index.php?id=53"><b><font color="2c5170">Fan Art</font></b></a><br/>';
echo'Nơi dành cho những bạn thích hội họa !<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '53'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '53' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forum/index.php?id=54"><b><font color="2c5170">Trai tài gái sắc</font></b></a><br/>';
echo'Cùng chia thẻ thông tin và hình ảnh của mình tại đây ( vi phạm về nội quy post ảnh sẽ bị ban nick vĩnh viễn trong Forum).<br/>';
echo'<a href="/forum/index.php?id=62"><img src="/images/box.png"> Mục Girl </a>';
echo'<a href="/forum/index.php?id=63"><img src="/images/box.png"> Mục Boy</a><br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '54'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '62' OR `refid` = '63' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo'<div class="list1"><a href="/forum/index.php?id=55"><b><font color="2c5170">Góc Học Tập</font></b></a><br/>';
echo'Thư giãn với diễn đàn cùng góc học tập !<br/>';
$value = 2;
$t = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `refid` = '55'")->fetch_row()[0] ?? 0);
$req_6 = $connect->query("SELECT * FROM `forum` WHERE `kedit` = '0' AND `type` = 't' AND `close`!='1' AND `refid` = '55' ORDER BY `vip` DESC,`time` DESC LIMIT $value");
while ($hoanganh = $connect->fetch_assoc($req_6)) {
if ($hoanganh['vip'] == 1)
echo '<b>';
if ($hoanganh['indam'] == 1)
echo '<b>';
echo '<img src="/images/bv.gif"/> <a href="'.$home.'/forum/'.$hoanganh['id'].'.html"><span style="size:8px;">' .$hoanganh['text'] . '</span></a>';
if ($hoanganh['indam'] == 1)
echo '</b>';
if ($hoanganh['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot_.gif"/>';
echo'<br/>';
$i ;
}
echo'</div>';
echo '<div class="hoanganh">Thống kê diễn đàn</div>';
echo'<div class="list1">Thành viên : <b><font color="0000ff">' . ($connect->query("SELECT COUNT(*) FROM `users`")->fetch_row()[0] ?? 0) . '</font> - </b>Đề tài : <b><font color="0000FF">' . ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `close` != '1'")->fetch_row()[0] ?? 0) . '</font> - </b>Bài gửi : <b><font color="0000FF">' . ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `close` != '1'")->fetch_row()[0] ?? 0) . '</font></b>';
echo'</div>';
// Thống kê online by Hoàng Anh
$usere = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0);
$tamune = ($connect->query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0);
$total = $total+$googlebot+$msnbot+$yandexbot+$bingbot+$yahoobot+$baidu+$DoCoMo+$AhrefsBot+$Sosospider+$usere+$tamune;
$users = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0);
$guests = ($connect->query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0);
$total = $users+$guests;
//--- Mod thống kê diễn đàn ---//
$gbot = 0;$msn = 0;$baidu = 0;$bing = 0;$mj = 0;$coccoc = 0;$facebook = 0;$yandex = 0;
$users = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 600) . "'")->fetch_row()[0] ?? 0);
$guests = ($connect->query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '" . (time() - 600) . "'")->fetch_row()[0] ?? 0);
$tong = $guests;
$onltime = time() - 600;
$spider = $connect->query("SELECT * FROM `cms_sessions` WHERE `lastdate` > '" . (time() - 600) . "' ORDER BY `lastdate` DESC LIMIT 900");
while ($res = $connect->fetch_assoc($spider)) {
if(stristr($res['browser'], 'Google')) {$gbot = $gbot + 1;}
if(stristr($res['browser'], 'msnbot')) {$msn = $msn + 1;}
if(stristr($res['browser'], 'Baidu')) {$baidu = $baidu + 1;}
if(stristr($res['browser'], 'bingbot')) {$bing = $bing + 1;}
if(stristr($res['browser'], 'MJ12')) {$mj = $mj + 1;}
if(stristr($res['browser'], 'coccoc')) {$coccoc = $coccoc + 1;}
if(stristr($res['browser'], 'facebook')) {$facebook = $facebook + 1;}
if(stristr($res['browser'], 'Yandex')) {$yandex = $yandex + 1;}
}
echo '<div class="mainblok"><div class="phdr">Trực tuyến</div>';
//echo '<div class="list1"><font color="green">» </font>Có <a href="/users/online.html">'.$tong.' Members Trực tuyến</a>, '.$users.' user and '.($guests - ($gbot + $msn + $baidu + $bing + $mj + $coccoc + $facebook + $yandex)).' Khách, và '.($gbot + $msn + $baidu + $bing + $mj + $coccoc + $facebook + $yandex).' spider.<br/>';
echo '<div class="list1"><div class="list1">
<font color="green">» <b>Có '.$users.' Members Trực tuyến:</b></font> ';
$req = $connect->query("SELECT `id`, `name` FROM `users` WHERE `preg`='1' and `lastdate` > '$onltime' ORDER BY `name` ASC LIMIT 1000");
while ($res = $connect->fetch_assoc($req)) {
if($user_id)
$user_on[] = '<a href="'.$home.'/member/'.$res['id'].'.html">'.nick($res['id']).'</a>';
else
$user_on[] = nick($res['id']);
}
echo implode(', ',$user_on).'.';
echo '<br/><font color="green">» </font><b> Có '.$tong.' Khách Đang Truy Cập</b>';
$thanhvienmoi=$connect->fetch_assoc($connect->query("SELECT * FROM `users` ORDER BY `datereg` DESC LIMIT 1"));
echo '<br /><font color="green">» </font><b>Chào mừng thành viên mới:</b> <a href="'.$home.'/users/profile.php?user='.$thanhvienmoi['id'].'">'.nick($thanhvienmoi['id']).'</a>.';
echo '</div></div>';
//--Hết--//
echo'</div>';
echo'</div>';

?>