<?php
$semen=$connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
if($post['semen']==0){$name_gr='Ô đất trống';}else{$name_gr=$semen['name'];}
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
echo'<img id="raucu" src="icon/item/'.$post['semen'].'.png" alt="*" />';
if($time>$post['time']){
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
if($time<$post['time']){
echo' <b>'.htmlspecialchars($semen['name']).'</b>&#160;';
echo'Còn '.$time_1.' thu hoạch';
if($post['woter']==0){
echo'&#160;<a href="/farm/?id='.$int.'&amp;woter">[<b>Tưới nước</b>]</a>';
} else { 
echo'&#160;<span style="color:#008000;">[Đã tưới nước]</span><br/>';
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
<form method="post" action="/farm/?id='.$int.'">
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
if(isset($_GET['thuhoach']) && $user_id==$post['id_user'] && $post['semen']!=0 && $post['time']<$time) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`+ $dohod WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `antrom` = '0' WHERE `id` = $int LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
header("Location: ?id=".$int."&thuhoachxong");
}
echo "<div class='menu'>";
echo'[ <b>'.htmlspecialchars($semen['name']).'</b> ]<br/>';
echo"Sản lượng: <b>".$post['kol']."</b> <br/>";
if($post['woter']==0)echo "*Bạn đã bị mất một nửa sản lượng do không chịu tưới nước cho cây phát triển! <br/>";
echo "Giá cho mỗi sản lượng: <b>".$semen['dohod']."</b> <br/>";
echo "Tổng doanh thu: <b>".$dohod."</b> xu</div>";
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
}else{
$k=($connect->query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
if($k!=0){
$res = $connect->query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` "); 
echo "<div class='menu'>";
echo "<form method='post' action='/farm/?id=".$int."&amp;ok'>\n";
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
?>