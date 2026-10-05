<?php
/*//////////////////////////////////VUI LÒNG TÔN TRỌNG BẢN QUYỀN TÁC GIẢ KHÔNG XOÁ DÒNG NÀY///////////////////////////*/
// Game rồng city                                                                                                     //
//  Tác giả: Hoàng Anh                                                                                                //
// Support: tuoitre4u.com                                                                                             //
//  Contact: hoanganh185995@gmail.com hoặc 0949784127/////////////////////////////////////////////////////////////////*/

define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Thành Phố Của Rồng';
require('../incfiles/head.php');
include 'r_level.php';
$dragon = dlevel($user_id);
$dra = explode('|', $dragon);
echo '<div class="danhmuc">Nhân vật của bạn</div>';
echo '<div class="menu"><b>Tài sản ' . $datauser['tienxu'] . ' Xu và ' . $datauser['vinaxu'] . ' Vina</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<div class="danhmuc">Thành Phố Rồng</div>';
$time = time();
$kt = ($connect->query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$user_id}'")->fetch_row()[0] ?? 0);
if($kt == 0) {
$kt1 = ($connect->query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$user_id}'")->fetch_row()[0] ?? 0);
if($kt1 == 1) {
echo 'Bạn đã có rồng rồi. Nếu muốn đổi con khác. Bạn cần hủy con rồng đang có!';
require('../incfiles/end.php');
exit;
}
echo '<div class="newsx">';
if(isset($_POST['submit'])) {
$dragon = intval($_POST['dragon']);
if(empty($dragon)) {
echo 'Bạn chưa chọn rồng!';
} else if($datauser['tienxu'] < 400000) {
echo 'Bạn cần có >= 400000 xu để có thể mua rồng!';
} else {
$connect->query("INSERT INTO `rong_city` SET `user_id`='{$user_id}', `dragon`='{$dragon}',`hp`='1000', `level`='1', `mp`='500', `time`='{$time}', `time_an`='{$time}'");
$connect->query("UPDATE `users` SET `tienxu` =`tienxu`- '400000' WHERE `id`='{$user_id}'");

echo 'Mua rồng thành công! Tài khoản của bạn bị trừ 400.000xu.<br><a href="/game/rongcity.php">Quay lại</a> <b>để chăm sóc chú rồng của mình nào!</b></div>';
}
} else {
echo 'Hiện tại bạn chưa có con rồng nào, hãy mua ngay một con rồng nào giá chỉ 500.000 xu 1 con !<br/><form method="post">';
for($i=1; $i<=9; $i++){
echo '<input type="radio" name="dragon" value="'.$i.'" /> <img src="img/rong/'.$i.'/1.gif" alt="" /><br/>';
}
echo '<input type="submit" name="submit" value="Mua Rồng" /></form></div>';
}
} else {
$dr = $connect->fetch_array($connect->query("SELECT * FROM `rong_city` WHERE `user_id`='{$user_id}'"));
switch($act) {
default:
if($dr['level'] != $dra[1]) {
$connect->query("UPDATE `rong_city` SET `level`='{$dra[1]}', `hp`='{$dra[2]}', `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
}
//time trung no
$dratime = $dr['time'] + 43200 - time();
$timetrung = date('H:i', $dratime);
//time cho an
$draan = $dr['time_an'] + 43200 - time();
$timean = date('H:i', $draan);

echo '<div class="list1">'.($dr['time'] > (time() - 43200) ? 'Trứng của bạn còn '.$timetrung.' phút nữa sẽ nở.':''.(($dr['time_an'] + 43200) < time() ? 'Rồng của bạn đang đói!':'Cậu chủ ơi! Em no quá rồi. :))<br/>» '.$timean.' phút nữa bạn có thể cho rồng ăn tiếp!').'').'';
echo '<table width="100%"><tr><td align="center" width="40%">'.($dr['time'] > (time() - 43200) ? '<img src="img/rong/trung.gif" alt="Trứng" />':'<img src="img/rong/'.$dr['dragon'].'/'.tienhoa($user_id).'.gif" alt="Dragon" />').'</td><td align="left"><span style="padding:6px;"><font color="blue"><b>Level: '.$dr['level'].'</b></font><br/>Tiến hoá: <b>'.tienhoa($user_id).'</b><br/>EXP: <b>'.$dr['exp'].'</b>/'.$dra[0].'<br/>HP: <b>'.$dr['hp'].'</b>/'.$dra[2].'<br/>MP: <b>'.$dr['mp'].'</b>/'.$dra[3].'</span></td></tr></table>';
echo '<div style="padding:6px;"><a href="rongcity.php?act=choan" style="background-color: #cc9933; padding: 3px; margin-right: 5px;"><b>Cho ăn</b></a><a href="rongcity.php?act=play" style="background-color: #9999ff; padding: 3px; margin-right:5px;"><b>Cho chơi</b></a><a href="rongcity.php?act=shop" style="background-color: #ffcc00; padding: 3px; margin-right:5px;"><b>Shop</b></a><a href="rongcity.php?act=del" style="background-color: #cccccc; padding: 3px;"><b>Xoá</b></a><br/><br/><center><a href="rongcity.php?act=kill" style="background-color: #52d017; margin-right: 6px; padding: 3px;"><b>Đấu trường</b></a><a href="rongcity.php?act=nhiemvu" style="background-color: #ff9999; padding: 3px;"><b>Nhiệm vụ</b></a></center></div><br/>';
echo '</div>';
break;
case 'choan':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho ăn! :D</div>';
require('../incfiles/end.php');
exit;
}
if(($dr['time_an'] + 43200) > time()) {
echo '<div class="list1" style="padding:6px;">Rồng của bạn chưa đói!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1" style="padding:4px;">';
if(isset($_POST['sub'])) {
if($datauser['tienxu'] < 5000) {
echo 'Bạn không đủ 5000 xu!';
} else {
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'30', `time_an`='{$time}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`= `tienxu`-'5000' WHERE `id`='{$user_id}'");
if($dr['nvan'] == 100) {
echo '<b>Chúc mừng bạn đã hoàn thành nhiệm vụ cho ăn 100 lần ,bạn nhận được 100 exp</b>';
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'100' WHERE `id`='{$user_id}'");
} else if($dr['nvan'] < 100) {
$connect->query("UPDATE `rong_city` SET `nvan`= `nvan`+'1' WHERE `user_id`='{$user_id}'");
}

echo 'Cho ăn thành công! <a href="rongcity.php">Trở về</a>';
}
} else {
echo 'Cho rồng ăn bạn sẽ mất 5000 Xu và nhận được 30 exp!<br/><form method="post"><input type="submit" name="sub" value="Cho ăn" />&#160;&#160;<a href="rongcity.php"><input type="button" value="Hủy" /></a></form>';
}
echo '</div>';
break;
case 'play':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho đi chơi! :D</div>';
require('../incfiles/end.php');
exit;
}

//time cho choi
$drachoi = $dr['time_ball'] + 3600 - time();
$timechoi = date('H:i', $drachoi);
if(($dr['time_ball'] + 3600) > time()) {
echo '<div class="list1" style="padding:6px;">Cậu chủ ơi! Em vừa mới chơi lúc nãy. Giờ em hơi mệt mỏi. Sau '.$timechoi.' phút nữa em mới chơi tiếp được! <a href="rongcity.php">Trở về</a></div>';
require('../incfiles/end.php');
exit;
}
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'20', `time_ball`='{$time}' WHERE `user_id`='{$user_id}'");
if($dr['nvchoi'] == 100) {
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'100' WHERE `id`='{$user_id}'");
echo '<b>Chúc mừng bạn đã hoàn thành nhiệm vụ cho chơi 100 lần, bạn nhận được 100 exp!</b>';
} else if($dr['nvchoi'] < 100) {
$connect->query("UPDATE `rong_city` SET `nvchoi`= `nvchoi`+'1' WHERE `user_id`='{$user_id}'");
}
echo '<div class="list1" style="padding:3px;">Vui quá...Vui quá cậu chủ ơi! (^_^)<center><img src="img/dragon/ball.png" alt="" /></center>Đá bóng thật là vui. Cậu chủ nhận được 20 exp. 1 tiếng sau chúng ta chơi tiếp nhé! <a href="rongcity.php">Trở về</a></div>';
break;
case 'shop':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng chưa nở mà cậu chủ! :D</div>';
require('../incfiles/end.php');
exit;
}

echo '<b>Bạn muốn mua gì</b><br/><img src="img/dragon/hp.png" alt="" /><a href="rongcity.php?act=hp">Mua máu (1000 xu/bình/+100 HP)</a><br/><img src="img/dragon/mp.png" alt="" /><a href="rongcity.php?act=mp">Mua mana (1000 xu/bình/+50 MP)</a><br/><img src="img/dragon/hp.png" alt="" /><a href="rongcity.php?act=allhp">Hồi phục đầy máu (5000 xu/bình)</a><br/><img src="img/dragon/mp.png" alt="" /><a href="rongcity.php?act=allmp">Hồi phục đầy mana (5000 xu/bình)</a>';
break;
case 'hp':
if($dr['hp'] == $dra[2]) {
echo '<div class="list1" style="padding:6px;">Máu của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['tienxu'] < 1000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 1000 xu!</div>';
require('../incfiles/end.php');
exit;
}
if(($dr['hp'] + 100) > $dra[2]) {
$connect->query("UPDATE `rong_city` SET `hp`='{$dra[2]}' WHERE `user_id`='{$user_id}'");
} else {
$connect->query("UPDATE `rong_city` SET `hp`= `hp`+'100' WHERE `user_id`='{$user_id}'");
}
$connect->query("UPDATE `users` SET `tienxu` =`tienxu`- '1000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được cộng 100 HP. <a href="rongcity.php">Trở về</a></div>';
break;
case 'mp':
if($dr['mp'] == $dra[3]) {
echo '<div class="list1" style="padding:6px;">Mana của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['tienxu'] < 1000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 1000 xu!</div>';
require('../incfiles/end.php');
exit;
}
if(($dr['mp'] + 50) > $dra[3]) {
$connect->query("UPDATE `rong_city` SET `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
} else {
$connect->query("UPDATE `rong_city` SET `mp`= `mp`+'50' WHERE `user_id`='{$user_id}'");
}
$connect->query("UPDATE `users` SET `tienxu` =`tienxu`- '1000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được cộng 50 MP. <a href="rongcity.php">Trở về</a></div>';
break;
case 'allhp':
if($dr['hp'] == $dra[2]) {
echo '<div class="list1" style="padding:6px;">Máu của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['tienxu'] < 5000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 5000 xu!</div>';
require('../incfiles/end.php');
exit;
}
$connect->query("UPDATE `rong_city` SET `hp`='{$dra[2]}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu` =`tienxu`- '5000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được nạp đầy HP. <a href="rongcity.php">Trở về</a></div>';
break;

case 'allmp':
if($dr['mp'] == $dra[3]) {
echo '<div class="list1" style="padding:6px;">Mana của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['tienxu'] < 5000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 5000 xu!</div>';
require('../incfiles/end.php');
exit;
}
$connect->query("UPDATE `rong_city` SET `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu` =`tienxu`- '5000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được nạp đầy MP. <a href="rongcity.php">Trở về</a></div>';
break;

case 'del':
echo '<div class="list1" style="padding:4px;">';
if(isset($_POST['sub'])) {
$connect->query("DELETE FROM `rong_city` WHERE `user_id`='{$user_id}'");
echo 'Xoá dữ liệu thành công! <a href="rongcity.php">Mua rồng mới!</a>';
} else {
echo '<b>Cảnh báo:</b> Chức năng này dùng để xoá dữ liệu mà con rồng bạn đang nuôi và bạn có thể mua con khác. Đồng nghĩa với việc bạn phải bắt đầu lại từ đầu!<br/><form method="post"><input type="submit" name="sub" value="Đồng ý" />&#160;&#160;<a href="rongcity.php"><input type="button" value="Hủy" /></a></form>';
}
echo '</div>';
break;
case 'dautruong':
$id = intval(trim(abs($_GET['id'])));
$drag = dlevel($id);
$drb = explode('|', $drag);
$dr2 = $connect->fetch_array($connect->query("SELECT * FROM `rong_city` WHERE `user_id`='{$id}'"));
$dr3 = $connect->fetch_array($connect->query("SELECT `name`,`id` FROM `users` WHERE `id`='{$id}'"));
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng chưa nở mà cậu chủ! :D</div>';
require('../incfiles/end.php');
exit;
}
if($dr2['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng của đối thủ chưa nở!</div>';
require('../incfiles/end.php');
exit;
}
$ktx = ($connect->query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$id}'")->fetch_row()[0] ?? 0);
if($ktx == 0) {
echo '<div class="list1" style="padding:3px;">Đối tượng bạn muốn quyết chiến không nuôi rồng nên không chiến được! <a href="rongcity.php">Quay về</a></div>';
require('../incfiles/end.php');
exit;
}

if($dr['hp'] == 0 || $dr['mp'] == 0) {
echo '<div class="list1" style="padding:3px;">Bạn không còn máu hoặc mana. Hãy nạp thêm để có thể tiếp tục chiến đấu! <a href="rongcity.php">Quay về</a></div>';
require('../incfiles/end.php');
exit;
}
if($dr2['hp'] == 0) {
echo '<div class="list1" style="padding:3px;">Đối thủ của bạn đã hết máu. Nên không thể chiến tiếp! <a href="rongcity.php">Quay về</a></div>';
require('../incfiles/end.php');
exit;
}
if($user_id == $id) {
echo '<div class="list1" style="padding:3px;">Không thể tự mình đánh mình! <a href="rongcity.php">Quay về</a></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1"><table width="100%" border="1"><tr><th width="50%" align="center"><a href="/users/profile.php?user='.$user_id.'"><b>'.$login.'</b></a></th><th width="50%" align="center"><a href="/users/profile.php?user='.$dr3['id'].'"><b>'.$dr3['name'].'</b></a></th></tr><tr>
<td width="50%"><span style="padding-left: 3px;"><font color="blue"><b>Level: '.$dr['level'].'</b></font><br/>Tiến hoá: <b>'.tienhoa($user_id).'</b><br/>EXP: <b>'.$dr['exp'].'</b>/'.$dra[0].'<br/>HP: <b>'.$dr['hp'].'</b>/'.$dra[2].'<br/>MP: <b>'.$dr['mp'].'</b>/'.$dra[3].'</span></td>
<td width="50%"><span style="padding-left: 3px;"><font color="blue"><b>Level: '.$dr2['level'].'</b></font><br/>Tiến hoá: <b>'.tienhoa($id).'</b><br/>EXP: <b>'.$dr2['exp'].'</b>/'.$drb[0].'<br/>HP: <b>'.$dr2['hp'].'</b>/'.$drb[2].'<br/>MP: <b>'.$dr2['mp'].'</b>/'.$drb[3].'</span></td>
</tr></table>';
echo '<br/><div align="center">
<img src="img/rong/'.$dr['dragon'].'/'.tienhoa($user_id).'.gif" alt="Dragon" /><font size="4"><span style="color:red;"> Chiến Đấu </span></font><img src="img/rong/'.$dr2['dragon'].'/'.tienhoa($id).'.gif" alt="Dragon" />
<br/><form method="post"><input type="submit" name="danh" value="'.(isset($_POST['danh']) ? 'Đánh tiếp':'Tấn công').'" /></form></div><br/>';
echo '</div>';

$phan = array("phản dam","dùng chiêu","đánh trả","phản đòn","dùng tabala đánh trả","xuất kill","dùng tuyệt kĩ rồng","nội thương","huyết thực");
$rand = rand(0,5);

if(isset($_POST['danh'])) {
$ahp = rand(40,200);
$amp = rand(20,60);
$bhp = rand(40,200);
$rexp = rand(5,20);
if($dr['nvkill'] == 100) {
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'100' WHERE `id`='{$user_id}'");
echo '<b>Chúc mừng bạn đã hoàn thành nhiệm vụ đánh nhau 100 lần, bạn nhận được 100 exp</b>';
} else if($dr['nvkill'] < 100) {
$connect->query("UPDATE `rong_city` SET `nvkill`= `nvkill`+'1' WHERE `user_id`='{$user_id}'");
}

//ngau nhien hp
if(($dr['hp'] - $ahp) < 0) {
$connect->query("UPDATE `rong_city` SET `hp`='0' WHERE `user_id`='{$user_id}'");
} else {
$connect->query("UPDATE `rong_city` SET `hp`=`hp`-'{$ahp}' WHERE `user_id`='{$user_id}'");
}
//ngau nhien mp
if(($dr['mp'] - $amp) < 0) {
$connect->query("UPDATE `rong_city` SET `mp`='0' WHERE `user_id`='{$user_id}'");
} else {
$connect->query("UPDATE `rong_city` SET `mp`=`mp`-'{$amp}' WHERE `user_id`='{$user_id}'");
}
//rand hp doi thu
if(($dr2['hp'] - $bhp) < 0) {
$connect->query("UPDATE `rong_city` SET `hp`='0' WHERE `user_id`='{$id}'");
} else {
$connect->query("UPDATE `rong_city` SET `hp`=`hp`-'{$bhp}' WHERE `user_id`='{$id}'");
}
$theme = 'Rồng bị tấn công';
$system = '[b]'.$login.'[/b] đã tấn công rồng của bạn. Khiến rồng của bạn bị thương! Hãy vào xem thế nào.';
$ktm = mysqli_result($connect->query("SELECT COUNT(*) FROM `cms_mail` WHERE
`user_id` = '2' AND `from_id` = '".$id."' AND `read` = '0' AND `text` = '" . $system . "' AND `sys` = '1' AND `them` = '" . $theme . "'
"), 0);
if($ktm == 0) {
$connect->query("INSERT INTO `cms_mail` SET
`user_id` = '2',
`from_id` = '".$id."',
`text` = '" . mysql_real_escape_string($system) . "',
`time` = '" . time() . "',
`sys` = '1',
`them` = '" . mysql_real_escape_string($theme) . "'
");
}
$connect->query("UPDATE `rong_city` SET `exp`= `exp`+'{$rexp}' WHERE `user_id`='{$user_id}'");

echo '<div class="list1"> Bạn đã đánh '.$dr3['name'].' làm '.$dr3['name'].' mất '.$bhp.' máu. Bạn mất '.$amp.' mana và được cộng '.$rexp.' exp!<br/>- '.$dr3['name'].' '.$phan[$rand].' làm bạn mất '.$ahp.' máu!</div>';
}
break;
case 'kill':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho đi chiến! :D</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="main-xmenu"><div class="danhmuc">Tất cả rồng chiến</div>';
$dr3 = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='{$id}'"));
$dem = ($connect->query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`!='{$user_id}' and `time` < '".(time() - 43200)."'")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT `user_id` FROM `rong_city` WHERE `user_id`!='{$user_id}' and `time` < '".(time() - 43200)."' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
$tkm = @$connect->fetch_array($connect->query("SELECT * FROM users WHERE id='{$res['user_id']}'"));
echo '<div class="list1"><b><font color="2c5170">Rồng của '.$tkm['name'].'</font></b> '.($res['hp'] >= 1 ? '(Sẳn Sàng)':NULL).'<br/><img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'. $datauser['name'] . '" /><br />[<a href="rongcity.php?act=dautruong&id='.$res['user_id'].'"><font color="ff0000">Đánh</font></a>]  [<a href="rongcity.php?act=info&id='.$res['user_id'].'"><font color="008000">Thông tin</font></a>]</div>';
}
if ($dem > $kmess){
echo '<div class="phantrang">' . functions::display_pagination('rongcity.php?act=kill&page=', $start, $dem, $kmess) . '</div></div>';
}
break;
case 'info':
$id = intval(trim(abs($_GET['id'])));
$ktx = ($connect->query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$id}'")->fetch_row()[0] ?? 0);
if($ktx == 0) {
echo '<div class="list1" style="padding:3px;">Đối tượng bạn muốn không tồn tại! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}


$drag = dlevel($id);
$drb = explode('|', $drag);
$dr2 = $connect->fetch_array($connect->query("SELECT * FROM `rong_city` WHERE `user_id`='{$id}'"));
$dr3 = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='{$id}'"));

if(isset($_GET['id'])) {
echo '<div class="menu" align="center"><b>Rồng của '.$dr3['name'].'</b></div><div class="menu list-bottom"><table width="100%"><tr><td align="center" width="40%">'.($dr2['time'] > (time() - 43200) ? '<img src="img/rong/trung.gif" alt="Trứng" />':'<img src="img/rong/'.$dr2['dragon'].'/'.tienhoa($id).'.gif" alt="Dragon" />').'</td><td align="left"><span style="padding:6px;"><font color="blue"><b>Level: '.$dr2['level'].'</b></font><br/>EXP: <b>'.$dr2['exp'].'</b>/'.$drb[0].'<br/>HP: <b>'.$dr2['hp'].'</b>/'.$drb[2].'<br/>MP: <b>'.$dr2['mp'].'</b>/'.$drb[3].'</span></td></tr></table></div>';
} else {
header("Location: rongcity.php");
}
break;
case 'nhiemvu':
echo '<div class="list1"><b>Nhiệm vụ 1:</b>Cho rồng ăn 100 lần. Phần thưởng nhận được là 100 exp!<br/>'.($dr['nvan'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvan'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div>';
echo '<div class="list1"><b>Nhiệm vụ 2:</b>Cho rồng chơi 100 lần. Phần thưởng nhận được là 100 exp!<br/>'.($dr['nvchoi'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvchoi'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div>';
echo '<div class="list1"><b>Nhiệm vụ 3:</b>Cho rồng đi đánh nhau 100 lần. Phần thưởng nhận được là 100 exp!<br/>'.($dr['nvkill'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvkill'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div>';
break;
}
}
require('../incfiles/end.php');
?>
