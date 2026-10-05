<?php
if(isset($_GET['antromxong'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;">Cây trồng đã được ăn trộm thành công !</div>';
if(!empty($muacho[id_user])) {
$rand=rand(1,1000);
$connect->query("UPDATE `users` SET `tienxu` = `tienxu` - $rand WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `tienxu` = `tienxu` + $rand WHERE `id` = $ank[id] LIMIT 1");
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;"><img src="icon/thunuoi/cho.png" alt="icon" style="vertical-align: 0px;"/> Bạn vừa bị một con chó tấn công đánh rơi mất '.$rand.' xu!</div>';
}
}
$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
$vremja= $post['time']-$time;
$timediff=$vremja;
$oneMinute=60; 
$oneHour=60*60; 
$oneDay=60*60*24; 
$dayfield=floor($timediff/$oneDay); 
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour); 
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute); 
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute)); 
if($dayfield>0)$day=$dayfield.' ngày ';
if($post['semen']!=0){ 
if($time<$post['time'])$time_1=$day.$hourfield." giờ ".$minutefield." phút";
else$time_1=0;
}
$nuatimeitem = $post['time_thuhoach']-$post['time_ki'];
$nuatime = $nuatimeitem/2;
$nuatimechin = $post['time']-$time;
$nuatimeitem2 = $nuatimeitem;
$timegieohat2 = $nuatimeitem2/2;
$timegieohat3 = $nuatimeitem2/4;
$timegieohat = $timegieohat2+$timegieohat3;
if ($post['semen'] > 0) {
if($post['time']>0 && $post['time']<=$time){
echo'<img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" />';
} else {
if ($post['semen'] == 0) {
} else {
if ($nuatime >= $nuatimechin) {
echo'<img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" />';
} else {
if ($timegieohat <= $nuatimechin) {
echo'<img id="raucu" src="icon/gieohat.png" alt="*" />';
} else {
echo'<img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" />';
}
}
}
echo'&#160;</td><td>';

if($time>$post['time']){
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
if($time<$post['time']){
if($post['woter']==0){
echo '<a href="/farm/account.php?id='.$idnick.'&view='.$post[id].'&amp;woter"><img src="/icon/tuoinuoc.gif" alt="*" /></a><br/>';
} else { 
echo'Đã tưới nước<br/>';
}
echo'[ <b>'.htmlspecialchars($semen['name']).'</b> ]&#160;';
echo'Còn '.$time_1.' thu hoạch';
}
echo'</td></tr></table>';
}
}
if($post['semen']!=0){
if($post['semen']!=0 && $time>$post['time'] && $post['kol']==0)
{
$pt=rand($semen['rand1'],$semen['rand2']);
if($post['woter']==0)$pt=floor($pt/2);
$connect->query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = $int LIMIT 1");
}
if($time<$post['time']){
$k2=($connect->query("SELECT COUNT(*) FROM `fermer_udobr` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
if($k2!=0){
$res2 = $connect->query("select * from `fermer_udobr` WHERE `id_user` = '$user_id' "); 
echo '<div class="menu">
<form method="post" action="/farm/account.php?id='.$idnick.'&view='.$post[id].'">
<select name="udobr">';
while ($post2 = $connect->fetch_array($res2)){
$semen2=$connect->fetch_array($connect->query("select * from `fermer_udobr_name` WHERE  `id` = '$post2[udobr]'  LIMIT 1")); 
echo "<option value='".$post2['id']."'>".htmlspecialchars($semen2['name'])." [".$post2['kol']."]</option>";
}
echo "</select><br />\n";
echo "<input type='submit' name='save' value='Bón phân' />\n";
echo "</form>\n";
echo "</div>";
}else{
echo "<div class='menu'>";
echo '<select name="cad" disabled="disabled" >
<option value="0" selected="selected">Không có phân bón!</option>
</select>';
echo "</div>";
}
}else{
$dohod=$post['kol']*$semen['dohod'];
if(isset($_GET['thuhoach']) && $idnick==$post['id_user'] && $post['semen']!=0 && $post['time']<$time) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`+ $dohod WHERE `id` = $id_user LIMIT 1");
$connect->query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $id_user LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
header("Location: ?id=".$int."&thuhoachxong");
}
echo'<b>'.htmlspecialchars($semen['name']).'</b><br/>';
echo"Sản lượng: <b>".$post['kol']."</b> <br/>";
if(!isset($_GET['antromxong'])) {
$idtrom =intval($_GET['trom']);
$trom = $connect->fetch_assoc($connect->query("SELECT * FROM `fermer_vor` WHERE `gr` = '".$post[id]."' LIMIT 1"));
if($trom['time']<$time){
if(!isset($_GET['antromxong'])) {
if ($post['antrom'] == '1') {
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Cây đã bi ăn trộm rồi !</div>';
} else {
echo '<a href="/farm/account.php?id='.$idnick.'&view='.$post['id'].'&trom='.$post['id'].'">[ <b>Ăn trộm</b> ]</a>';
}
}
}else{
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Bạn đã ăn trộm nông sản của bạn này rồi !</div>';
}
}
}
}else{
$k=($connect->query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
if($k!=0){
$res = $connect->query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` "); 
echo "<div class='menu'>";
echo "<form method='post' action='/farm/account.php?id=".$idnick."&view=".$post[id]."'>\n";
echo "<select name='sadit'>";
while ($post = $connect->fetch_array($res)){
$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]' LIMIT 1")); 
$name_gr=$semen['name'];
echo "<option value='".$post['id']."'>".$name_gr." [".$post['kol']."]</option>";
}
echo "</select><br />\n";
echo "<input type='submit' name='save' value='Gieo hạt giống' />\n";
echo "</form>\n";
echo "</div>";
}else{
echo '<div class="menu">
<select name="cad" disabled="disabled" ><br />
<option value="0" selected="selected">Không có hạt giống nào!</option>
</select></div>';
}
}





$ank = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='$idnick' LIMIT 1"));
if(isset($_GET['trom'])){
$vor=intval($_GET['trom']);
if($user_id) {
# Ham xac thuc
if(!$vor){
echo '<div class="ferma_menu">Chưa có người chơi nào!</div>';
echo "<div class='ferma_rekl'>";
echo "&laquo; <a href='fermers.php'>Hàng xóm</a><br/>";
echo "&laquo; <a href='index.php'>Trang chủ</a><br/>";
echo "</div>";
require('../incfiles/end.php');
exit;
}
# Kiem tra cac item
$sql=$connect->query("SELECT `id` FROM `fermer_gr` WHERE `id`='$vor' ");
$row=$connect->fetch_assoc($sql);
if(!$connect->query("SELECT * FROM ...")$sql)){
echo '<div class="ferma_menu">Không có bản vá đó!</div>';
echo "<div class='ferma_rekl'>";
echo "&laquo; <a href='fermers.php'>Hàng xóm</a><br/>";
echo "&laquo; <a href='index.php'>Trang chủ</a><br/>";
echo "</div>";require('../incfiles/end.php');
exit;
}
$gr = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE `id` ='$vor' "));
$semen = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE `id` = '$gr[semen]' "));
$qi = $connect->fetch_assoc($connect->query("SELECT * FROM `fermer_vor` WHERE `id_user` = '$user_id'  AND `gr` = '$vor' LIMIT 1"));
if($qi['time']<$time){
$rand1=floor($semen['rand1']/5);
$rand2=floor($semen['rand2']/5);
$rand=rand($rand1,$rand2);
$connect->query("INSERT INTO `fermer_vor` (`id_user` , `gr`, `time`) VALUES  ('".$user_id."', '".$vor."', '".$t."') ");
$connect->query("UPDATE `users` SET `fermer_oput` = `fermer_oput`- '10' WHERE `id` = $user_id LIMIT 1");
if($gr['kol']>$rand){
$connect->query("UPDATE `fermer_gr` SET `kol` = `kol`- $rand WHERE `id` = $vor LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `antrom` = '1' WHERE `id` = '".$post['id']."' LIMIT 1");
$remils = ($connect->query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '$gr[semen]'")->fetch_row()[0] ?? 0);
if($remils>0) $connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$rand."' WHERE `id_user` = $user_id AND `semen` = '$gr[semen]' LIMIT 1");
else $connect->query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$rand."', '".$gr['semen']."', '".$user_id."') ");
}else{
$rand=($connect->query("SELECT `kol` FROM `fermer_gr` WHERE `id` = $_GET[vor] ")->fetch_row()[0] ?? 0);
$connect->query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $vor LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time_ki` = NULL WHERE `id` = $vor LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $vor LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `kol` = NULL WHERE `id` = $vor LIMIT 1");
$remils = ($connect->query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '$gr[semen]'")->fetch_row()[0] ?? 0);
if($remils>0) $connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$rand."' WHERE `id_user` = $user_id AND `semen` = '$gr[semen]' LIMIT 1");
else $connect->query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$rand."', '".$gr['semen']."', '".$user_id."') ");
}
$se=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$gr[semen]'  LIMIT 1"));
$noticearena = 
mysqli_result($connect->query("SELECT COUNT(*) 
FROM `notice` WHERE
`user_id` = '".$idnick."' AND 
`user_fr` = '".$user_id."' AND 
`sid` = '".$idnick."' AND 
`view` = '0' AND 
`type` = 'h'
"), 0);

if($noticearena == 0) {
$connect->query("INSERT INTO `notice` SET
`user_id` = '$idnick',
`user_fr` = '".$user_id."',
`sid` = '".$idnick."',
`time` = '" . time() . "',
`type` = 'h'
");
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$idnick."'");
}
header('Location: /farm/account.php?id='.$idnick.'&view='.$post[id].'&antromxong#menu');
require('../incfiles/end.php');
exit;
}
}else{
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Bạn đã ăn trộm nông sản của bạn này rồi !</div>';
}
}

?>