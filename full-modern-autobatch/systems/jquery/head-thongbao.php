<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
$new_mail = ($connect->query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'")->fetch_row()[0] ?? 0);

if ($user_id){
$tbcaro=array();
$sql='SELECT c.* FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = 0 AND `po` = '.$datauser['id'].' AND `winner`=0 AND '.time().' - x.lastdate <=300';
$result=$connect->query($sql);
if(mysql_numrows($result) >0){$tbcaro[]='<img src="/icon/caro-icon.png" style="vertical-align: -3px;"> Bạn có <a href="/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>'.mysql_numrows($result).' bàn cờ</b> ]</a> chờ chấp thuận.';}
$sql='SELECT c.* FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = '.$datauser['id'].' AND `winner`=0';
$result=$connect->query($sql);
if(mysql_numrows($result) >0){$tbcaro[]='<img src="/icon/caro-icon.png" style="vertical-align: -3px;"> Bạn có <a href="/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>'.mysql_numrows($result).' bàn cờ</b> ]</a> chờ lượt.';}
$sql='SELECT * FROM carodata WHERE `turn` != '.$datauser['id'].' AND `turn`!=0 AND `winner`=0 AND (`px`='.$datauser['id'].' OR `po`='.$datauser['id'].') AND (('.time().'-`lastturn`)/60)>`waittime`';
$result=$connect->query($sql);
if(mysql_numrows($result) >0){$tbcaro[]='<img src="/icon/caro-icon.png" style="vertical-align: -3px;"> Bạn có <a href="/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>'.mysql_numrows($result).' bàn cờ</b> ]</a> chờ bạn xử thua.';}
$sql='SELECT c.* FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = 0 AND `po` = 0 AND `winner`=0 AND `px` != '.$datauser['id'].' AND  `po` != '.$datauser['id'].' AND '.time().' - x.lastdate <=300 ORDER BY `id` DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result) >0){$tbcaro[]='<img src="/icon/caro-icon.png" style="vertical-align: -3px;"> Có <a href="/caro/">[ <b>'.mysql_numrows($result).' bàn cờ trống</b> ]</a> đang chờ.';}
if(count($tbcaro)>=1){
$demtb=0;
while($demtb<count($tbcaro)){
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-bottom: 5px;border: 1px solid #e0e0e0;">';
echo $tbcaro[$demtb].(($demtb+1==count($tbcaro)) ? '<br>' : '');
echo '</div>';
$demtb++;
}
}
if ($datauser['hopqua'] =='0') {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-bottom: 5px;border: 1px solid #e0e0e0;"><img src="/icon/giftbox.png" alt="icon" style="vertical-align: -3px;"/>  <a href="'.$home.'/vuichoi/hopqua/">Nhận Quà Mỗi Ngày</a></div>';
}
}
?>