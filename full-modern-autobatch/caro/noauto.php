<?php
define('_IN_JOHNCMS', 1);

$rootpath = '';
require('../../incfiles/core.php');
$textl = 'Caro Online';
require('../../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Caro Online</div>';
$moneycol = 'tienxu';
if(!$datauser['id']){$datauser['id']='0';}
?>
<style>
.smi
{
border:0px solid black;
}
.tab {border-collapse:collapse;}
td
{
padding:0px;
}
</style>
<?php
if(!$_GET['id']){if($datauser['id']!=0){
$cwin=$datauser['cwin'];
$close=$datauser['close'];
if(($cwin+$close)>0) {$tlt=(int)(($cwin/($cwin+$close))*100).'%';} else {$tlt='0%';}
echo'<div class="menu list-bottom congdong">Thành tích: '.$cwin.' thắng và '.$close.' thua, tỉ lệ thắng '.$tlt.'</div>';
$a = explode(".",$datauser[$moneycol]);
$tien = $a[0];
echo '<div class="menu list-bottom">Hiện có '.$tien.' xu</div>';
if($_POST['muccuoc']<0 || $_POST['socot'] < 15 || $_POST['socot'] > 25){ ?>
<div class="menu">
<form action="/vuichoi/caro/" method="post">
Thách đấu với (để trống để tạo bàn chờ):<br>
<?php if($_GET['thachdau']){
$td = ereg_replace("[^0-9]", "", $_GET['thachdau']);
$gettd=$connect->query('SELECT * FROM users WHERE id='.$td);
if(mysql_numrows($gettd)>0){
echo '<b><a href="/account/'.mysqli_result($gettd,0,"id").'">'.mysqli_result($gettd,0,"name").'</a></b>';
} else {echo '<input type="text" name="doituong" value="">';}
} else { ?>
<input type="text" name="doituong" value="">
<?php } ?><br>
Mức cược:<br><input type="text" name="muccuoc" value="0"> <br>
<input type="hidden" name="socot" value="15">
<input type="hidden" name="wt" value="1">
	<input type="submit" value="Chấp nhận" />
</form>
</div>
<div class="menu">Caro Online viet boi Trong Tuan</div>
<?php } else {
if(!$_POST['doituong']){$btrong='1';} else {
$dup = $connect->query("SELECT * FROM users WHERE name_lat='".mb_strtolower($_POST['doituong'], 'UTF-8')."'");
if(mysql_numrows($dup)>0){$poid=mysqli_result($dup,0,'id');}
$nnumrow=mysql_numrows($dup);
}
$kiemtra=$connect->query('SELECT * FROM `carodata` WHERE (`px`='.$datauser['id'].' OR  (`po`='.$datauser['id'].' AND `turn`!=0)) AND `winner`=0');
$demban=mysql_numrows($kiemtra);
if(($nnumrow>0 || $btrong) && $poid!=$datauser['id'] && $datauser[$moneycol]>=$_POST['muccuoc'] && $_POST['muccuoc']<=1000 && ($poid || $btrong) && $_POST['wt']>=1 && $_POST['wt']<=60 && $demban==0){
$oid=($btrong=='1') ? 0 : mysqli_result($dup,0,'id');
$sql="INSERT INTO `carodata` (`id`, `data1`, `data2`, `px`, `po`, `turn`, `winner`, `tinhtrang`, `hl`, `socot`, `muccuoc`, `new`, `waittime`, `lastturn`) VALUES (NULL, '', '', '".$datauser['id']."', '".$oid."', '0', '0', '0', '', '".$_POST['socot']."', '".$_POST['muccuoc']."', '1', '".$_POST['wt']."', '".time()."')";
$result=$connect->query($sql);
echo '<div class="menu">Tạo bàn chơi thành công!</div>';
} else { ?>
<div class="menu"><font color="red">
<?php
if($_POST['socot'] < 15 || $_POST['socot'] > 25){ echo 'Số cột không hợp lệ.<br>';}
if($demban!=0){ echo 'Hãy hoàn thành các bàn chơi chưa xong trước khi tạo bàn.<br>';}
if($nnumrow==0 && $_POST['doituong']){ echo 'Không tìm thấy thành viên này.<br>';}
if($datauser[$moneycol]<$_POST['muccuoc']){ echo 'Tiền cược không đủ.<br>';}
if($_POST['muccuoc']>1000){ echo 'Tiền cược phải nhỏ hơn 1000 Xu<br>';}
if($_POST['wt']<1 || $_POST['wt']>60){ echo 'Thời gian chờ phải từ 1 đến 60 phút.<br>';}
?>
</font></div>
<form action="/vuichoi/caro/" method="post">
Thách đấu với (để trống để tạo bàn chờ):<br>
<?php if($_GET['thachdau']){
$td = ereg_replace("[^0-9]", "", $_GET['thachdau']);
$gettd=$connect->query('SELECT * FROM users WHERE id='.$td);
if(mysql_numrows($gettd)>0){
echo '<b><a href="/account/'.mysqli_result($gettd,0,"id").'">'.mysqli_result($gettd,0,"name").'</a></b>';
} else {echo '<input type="text" name="doituong" value="">';}
} else { ?>
<input type="text" name="doituong" value="">
<?php } ?><br>
Mức cược:<br><input type="text" name="muccuoc" value="0"> <br>
<input type="hidden" name="socot" value="15">
<input type="hidden" name="wt" value="1">
	<input type="submit" value="Chấp nhận" />
</form>
<?php }
}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights, x.lastdate AS xlvs FROM carodata c LEFT JOIN users x ON c.px=x.id LEFT JOIN users o ON c.po=o.id WHERE `turn` = 0 AND `po` = '.$datauser['id'].' AND `winner`=0 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ chờ chấp thuận của bạn:</div>';
$a=0;
while($a<mysql_numrows($result)){
echo'<div class="menu">';
if (time()-mysqli_result($result,$a,"xlvs")>300){echo '<img src="/vuichoi/caro/icons/9.png"> ';}
else {echo '<img src="/vuichoi/caro/icons/30.png"> ';}
echo '<a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (đề nghị bởi <b><a href="/account/'.mysqli_result($result,$a,"px").'">'.nick(mysqli_result($result,$a,"px")).'</a></b>) mức cược '.mysqli_result($result,$a,"muccuoc").'xu';
$a++;
echo'</div>';
}
}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = '.$datauser['id'].' AND `winner`=0 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ chờ lượt của bạn</div>';
$a=0;
while($a<mysql_numrows($result)){
echo'<div class="menu">';
if(mysqli_result($result,$a,'px')==$datauser['id']){$o='o';} elseif(mysqli_result($result,$a,'po')==$datauser['id']){$o='x';}
if(((time()-mysqli_result($result,$a,'lastturn'))/60)>mysqli_result($result,$a,'waittime')){$sp1='<span style="background-color: rgb(249, 240, 218)">';$sp2='</span>';}
echo '<a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (với <b><a href="/account/'.mysqli_result($result,$a,"p".$o).'">'.mysqli_result($result,$a,$o."name").'</a></b>) mức cược '.mysqli_result($result,$a,"muccuoc").'xu';
$a++;
echo'</div>';
}
}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` != '.$datauser['id'].' AND `turn` != 0 AND (`px` = '.$datauser['id'].' OR `po` = '.$datauser['id'].') AND `winner`=0 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ đang tham gia</div>';
$a=0;
while($a<mysql_numrows($result)){
if(mysqli_result($result,$a,'px')==$datauser['id']){$o='o';} elseif(mysqli_result($result,$a,'po')==$datauser['id']){$o='x';}
if(((time()-mysqli_result($result,$a,'lastturn'))/60)>mysqli_result($result,$a,'waittime')){$sp1='<span style="background-color: rgb(249, 240, 218)">';$sp2='</span>';}
echo '<div class="menu"><img src="/vuichoi/caro/icons/pl.png"> <a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (với <b><a href="/account/'.mysqli_result($result,$a,"p".$o).'">'.mysqli_result($result,$a,$o."name").'</a></b>) mức cược '.mysqli_result($result,$a,"muccuoc").'xu</div>';
$a++;
}}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = 0 AND `px` = '.$datauser['id'].' AND `po`!=0 AND `winner`=0 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ chờ chấp thuận của đối thủ</div>';
$a=0;
while($a<mysql_numrows($result)){
if(mysqli_result($result,$a,'px')==$datauser['id']){$o='o';} elseif(mysqli_result($result,$a,'po')==$datauser['id']){$o='x';}
echo'<img src="/vuichoi/caro/icons/30.png"> <a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (với <b><a href="/account/'.mysqli_result($result,$a,"p".$o).'">'.nick(mysqli_result($result,$a,"p".$o)).'</a></b>) mức cược '.mysqli_result($result,$a,"muccuoc").'xu';
$a++;
}}
}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights, x.lastdate AS xlvs FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` = 0 AND `po` = 0 AND `winner`=0 AND '.time().' - x.lastdate <=300 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ trống đang chờ</div>';
$a=0;
while($a<mysql_numrows($result)){
echo'<div class="menu">';
if (time()-mysqli_result($result,$a,"xlvs")>300){echo '<img src="/vuichoi/caro/icons/9.png"> ';}
else {echo '<img src="/vuichoi/caro/icons/30.png"> ';}
echo '<a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (tạo bởi <b><a href="/account/'.mysqli_result($result,$a,"px").'">'.nick(mysqli_result($result,$a,"px")).'</a></b> cược '.mysqli_result($result,$a,"muccuoc").'xu - '.mysqli_result($result,$a,"waittime").' phút trước)</div>';
$a++;
}
}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE `turn` != 0 AND `px` != '.$datauser['id'].' AND  `po` != '.$datauser['id'].' ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ đang đanh</div>';
$a=0;
while($a<mysql_numrows($result)){
echo'<div class="menu">';
if(!mysqli_result($result,$a,"winner")){echo '<img src="/vuichoi/caro/icons/pl.png"> ';}
else {echo '<img src="/vuichoi/caro/icons/'.(mysqli_result($result,$a,"hl") ? 'cp' : 'done').'.png"> ';}
echo '<a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[<b> Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (<b><a href="/account/'.mysqli_result($result,$a,"px").'">'.nick(mysqli_result($result,$a,"px")).'</a></b> và <b><a href="/account/'.mysqli_result($result,$a,"po").'">'.nick(mysqli_result($result,$a,"po")).'</a></b>) mức cược '.mysqli_result($result,$a,"muccuoc").'xu';
$a++;
echo'</div>';
}}
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c LEFT JOIN users x ON c.px = x.id LEFT JOIN users o ON c.po = o.id WHERE (`px` = '.$datauser['id'].' OR `po` = '.$datauser['id'].') AND `winner`!=0 ORDER BY c.id DESC LIMIT 10';
$result=$connect->query($sql);
if(mysql_numrows($result)>0){
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bàn cờ đã hoàn thành</div>';
$a=0;
while($a<mysql_numrows($result)){
if(mysqli_result($result,$a,'winner')==$datauser['id']){$win='bạn thắng';}else{$win='bạn thua';}
if(mysqli_result($result,$a,'px')==$datauser['id']){$o='o';} elseif(mysqli_result($result,$a,'po')==$datauser['id']){$o='x';}
echo '<div class="menu"><img src="/vuichoi/caro/icons/'.(mysqli_result($result,$a,"hl") ? 'cp' : 'done').'.png"> <a href="/vuichoi/caro/?id='.mysqli_result($result,$a,'id').'">[ <b>Bàn số #'.mysqli_result($result,$a,'id').'</b> ]</a> (với <b><a href="/account/'.mysqli_result($result,$a,"p".$o).'">'.nick(mysqli_result($result,$a,"p".$o)).'</a></b>) '.$win.' '.mysqli_result($result,$a,"muccuoc").'xu</div>';
$a++;
}}
} else {
	$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
		LEFT JOIN users x ON c.px = x.id
		LEFT JOIN users o ON c.po = o.id
		WHERE c.id='.$_GET['id'];
	$result=$connect->query($sql);
	if(mysql_numrows($result)>0) {
	if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'po')==$datauser['id']) {
		if($_POST['ap']){
			$kiemtra=$connect->query('SELECT * FROM `carodata` WHERE (`px`='.$datauser['id'].' OR  `po`='.$datauser['id'].') AND `winner`=0 AND `turn`!=0');
			$demban=mysql_numrows($kiemtra);
			if($demban==0){
			$sqls='SELECT lastdate AS session_time FROM users WHERE id='.mysqli_result($result,0,'px').' ORDER BY session_time DESC LIMIT 1';
			$stime=$connect->query($sqls);
			if(mysql_numrows($stime)!=0 && time()-mysqli_result($stime,0,'session_time')<=300){
			if($datauser[$moneycol]>=mysqli_result($result,0,'muccuoc')){
			$rturn=array(mysqli_result($result,0,'px'),mysqli_result($result,0,'po'));
			$setturn=$rturn[rand(0,1)];
			$sql='UPDATE carodata SET `turn`='.$setturn.', `tinhtrang`=1, `lastturn` = '.time().' WHERE `id`='.$_GET['id'];
			$result=$connect->query($sql);

			$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
				LEFT JOIN users x ON c.px = x.id
				LEFT JOIN users o ON c.po = o.id
				WHERE c.id='.$_GET['id'];
			$result=$connect->query($sql);
			} else {echo '<div class="menu list-bottom"><font color="red">Bạn không đủ tiền cược!</font></div>';}
			} else {echo '<div class="menu list-bottom"><font color="red">Không thể chấp nhận bàn cờ của thành viên offline quá 5 phút, vui lòng đợi người này online và thử lại!</font></div>';}
			} else {echo '<div class="menu list-bottom"><font color="red">Bạn không thể tham gia nhiều bàn cùng lúc.</font></div>';}
		}
		if($_POST['dn']){
			$sql='DELETE FROM carodata WHERE `id`='.$_GET['id'];
			$connect->query($sql);
		}}
		if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'po')==0 && $_POST['jn'] && mysqli_result($result,0,'px')!=$datauser['id']){
			$kiemtra=$connect->query('SELECT * FROM `carodata` WHERE (`px`='.$datauser['id'].' OR  `po`='.$datauser['id'].') AND `winner`=0 AND `turn`!=0');
			$demban=mysql_numrows($kiemtra);
			if($demban==0){
			$sqls='SELECT lastdate AS session_time FROM users WHERE id='.mysqli_result($result,0,'px').' ORDER BY session_time DESC LIMIT 1';
			$stime=$connect->query($sqls);
			if(mysql_numrows($stime)!=0 && time()-mysqli_result($stime,0,'session_time')<=300){
			if($datauser[$moneycol]>=mysqli_result($result,0,'muccuoc')){
			$rturn=array(mysqli_result($result,0,'px'),$datauser['id']);
			$setturn=$rturn[rand(0,1)];
			$sql='UPDATE carodata SET `turn`='.$setturn.', `tinhtrang`=1, `po`='.$datauser['id'].', `lastturn`='.time().' WHERE `id`='.$_GET['id'];
			$result=$connect->query($sql);
			$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
				LEFT JOIN users x ON c.px = x.id
				LEFT JOIN users o ON c.po = o.id
				WHERE c.id='.$_GET['id'];
			$result=$connect->query($sql);
			}
			else {echo '<b><font color="red">Bạn không đủ tiền cược!</font></b><br>';}
			} else {echo '<b><font color="red">Không thể tham gia bàn cờ của thành viên offline quá 5 phút, vui lòng đợi người này online và thử lại!</font></b><br>';}
			} else {echo '<b><font color="red">Bạn không thể tham gia nhiều bàn cùng lúc.</font></b><br>';}
		}
		if($_POST['cn'] && mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'px')==$datauser['id'] && $datauser['id'] != ANONYMOUS){
			$sql='DELETE FROM carodata WHERE `id`='.$_GET['id'];
			$connect->query($sql);
		}
		$data1=explode(":",mysqli_result($result,0,'data1'));
		$data1f=mysqli_result($result,0,'data1');
		$data2f=mysqli_result($result,0,'data2');
		$data2=explode(":",mysqli_result($result,0,'data2'));
		$socot=mysqli_result($result,0,'socot');
		$hl=explode(":",mysqli_result($result,0,'hl'));
		if(mysqli_result($result,0,'px')==$datauser['id']){$u='x'; $o='o';} elseif(mysqli_result($result,0,'po')==$datauser['id']) {$u='o'; $o='x';} else {$view=1;}
		if($_GET['action']){
		$action=explode(".",$_GET['action']);
		if(mysqli_result($result,0,'new')==1){
		$actionf=$action[0].'|'.$action[1]; } else {
		$actionf=$action[0].$action[1];}
		if(!in_array($actionf, $data2) && !mysqli_result($result,0,'winner') && mysqli_result($result,0,'turn')==$datauser['id'] && $action[0]<$socot && $action[1]<$socot && $action[0]>0 && $action[1]>0){
			$sql= 'UPDATE carodata SET `data1`="'.$data1f.$u.':'.'",`data2`="'.$data2f.$actionf.':'.'", turn='.mysqli_result($result,0,'p'.$o).', `lastturn` = "'.time().'" WHERE id='.$_GET['id'];
			$result=$connect->query($sql);
			$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
		LEFT JOIN users x ON c.px = x.id
		LEFT JOIN users o ON c.po = o.id
		WHERE c.id='.$_GET['id'];
			$result=$connect->query($sql);
			$data1=explode(":",mysqli_result($result,0,'data1'));
			$data1f=mysqli_result($result,0,'data1');
			$data2f=mysqli_result($result,0,'data1');
			$data2=explode(":",mysqli_result($result,0,'data2'));
			$socot=mysqli_result($result,0,'socot');
			$hl=explode(":",mysqli_result($result,0,'hl'));
			//Bắt đầu kiểm tra thắng thua...
			$d=0;
			while($d<count($data1)){
				$data[$d]=$data1[$d].$data2[$d];
				$d++;
			}
			$x=$action[0];
			$y=$action[1];
			//Các dòng dưới đây sẽ kiểm tra ngay tại điểm thành viên vừa đánh
			if(mysqli_result($result,0,'new')==1){
			if(in_array($u.($x+1).'|'.$y, $data) && in_array($u.($x+2).'|'.$y, $data) && in_array($u.($x+3).'|'.$y, $data) && in_array($u.($x+4).'|'.$y, $data) && (!in_array($o.($x-1).'|'.$y, $data) || !in_array($o.($x+5).'|'.$y, $data))) {$win=1;$hld=$x.$y.':'.($x+1).'|'.$y.':'.($x+2).'|'.$y.':'.($x+3).'|'.$y.':'.($x+4).'|'.$y.':';}
			if(in_array($u.($x-1).'|'.$y, $data) && in_array($u.($x+1).'|'.$y, $data) && in_array($u.($x+2).'|'.$y, $data) && in_array($u.($x+3).'|'.$y, $data) && (!in_array($o.($x-2).'|'.$y, $data) || !in_array($o.($x+4).'|'.$y, $data))) {$win=1;$hld=$x.$y.':'.($x-1).'|'.$y.':'.($x+2).'|'.$y.':'.($x+3).'|'.$y.':'.($x+1).'|'.$y.':';}
			if(in_array($u.($x-1).'|'.$y, $data) && in_array($u.($x+1).'|'.$y, $data) && in_array($u.($x+2).'|'.$y, $data) && in_array($u.($x-2).'|'.$y, $data) && (!in_array($o.($x-3).'|'.$y, $data) || !in_array($o.($x+3).'|'.$y, $data))) {$win=1;$hld=$x.$y.':'.($x-1).'|'.$y.':'.($x+2).'|'.$y.':'.($x-2).'|'.$y.':'.($x+1).'|'.$y.':';}
			if(in_array($u.($x-1).'|'.$y, $data) && in_array($u.($x+1).'|'.$y, $data) && in_array($u.($x-3).'|'.$y, $data) && in_array($u.($x-2).'|'.$y, $data) && (!in_array($o.($x-4).'|'.$y, $data) || !in_array($o.($x+2).'|'.$y, $data))) {$win=1;$hld=$x.$y.':'.($x-1).'|'.$y.':'.($x-3).'|'.$y.':'.($x-2).'|'.$y.':'.($x+1).'|'.$y.':';}
			if(in_array($u.($x-1).'|'.$y, $data) && in_array($u.($x-4).'|'.$y, $data) && in_array($u.($x-3).'|'.$y, $data) && in_array($u.($x-2).'|'.$y, $data) && (!in_array($o.($x-5).'|'.$y, $data) || !in_array($o.($x+1).'|'.$y, $data))) {$win=1;$hld=$x.$y.':'.($x-1).'|'.$y.':'.($x-3).'|'.$y.':'.($x-2).'|'.$y.':'.($x-4).'|'.$y.':';}
			//Kiểm tra hàng ngang
			if(in_array($u.$x.'|'.($y+1), $data) && in_array($u.$x.'|'.($y+2), $data) && in_array($u.$x.'|'.($y+3), $data) && in_array($u.$x.'|'.($y+4), $data) && (!in_array($o.$x.'|'.($y-1), $data) || !in_array($o.$x.'|'.($y+5), $data))) {$win=1;$hld=$x.$y.':'.$x.'|'.($y+1).':'.$x.'|'.($y+2).':'.$x.'|'.($y+3).':'.$x.'|'.($y+4).':';}
			if(in_array($u.$x.'|'.($y+1), $data) && in_array($u.$x.'|'.($y+2), $data) && in_array($u.$x.'|'.($y+3), $data) && in_array($u.$x.'|'.($y-1), $data) && (!in_array($o.$x.'|'.($y-2), $data) || !in_array($o.$x.'|'.($y+4), $data))) {$win=1;$hld=$x.$y.':'.$x.'|'.($y+1).':'.$x.'|'.($y+2).':'.$x.'|'.($y+3).':'.$x.'|'.($y-1).':';}
			if(in_array($u.$x.'|'.($y+1), $data) && in_array($u.$x.'|'.($y+2), $data) && in_array($u.$x.'|'.($y-2), $data) && in_array($u.$x.'|'.($y-1), $data) && (!in_array($o.$x.'|'.($y-3), $data) || !in_array($o.$x.'|'.($y+3), $data))) {$win=1;$hld=$x.$y.':'.$x.'|'.($y+1).':'.$x.'|'.($y+2).':'.$x.'|'.($y-2).':'.$x.'|'.($y-1).':';}
			if(in_array($u.$x.'|'.($y+1), $data) && in_array($u.$x.'|'.($y-3), $data) && in_array($u.$x.'|'.($y-2), $data) && in_array($u.$x.'|'.($y-1), $data) && (!in_array($o.$x.'|'.($y-4), $data) || !in_array($o.$x.'|'.($y+2), $data))) {$win=1;$hld=$x.$y.':'.$x.'|'.($y+1).':'.$x.'|'.($y-3).':'.$x.'|'.($y-2).':'.$x.'|'.($y-1).':';}
			if(in_array($u.$x.'|'.($y-4), $data) && in_array($u.$x.'|'.($y-3), $data) && in_array($u.$x.'|'.($y-2), $data) && in_array($u.$x.'|'.($y-1), $data) && (!in_array($o.$x.'|'.($y-5), $data) || !in_array($o.$x.'|'.($y+1), $data))) {$win=1;$hld=$x.$y.':'.$x.'|'.($y-4).':'.$x.'|'.($y-3).':'.$x.'|'.($y-2).':'.$x.'|'.($y-1).':';}
			//Kiểm tra đường chéo thứ nhất
			if(in_array($u.($x+1).'|'.($y+1), $data) && in_array($u.($x+2).'|'.($y+2), $data) && in_array($u.($x+3).'|'.($y+3), $data) && in_array($u.($x+4).'|'.($y+4), $data) && (!in_array($o.($x-1).'|'.($y-1), $data) || !in_array($o.($x+5).'|'.($y+5), $data))){$win=1;$hld=$x.$y.':'.($x+1).'|'.($y+1).':'.($x+2).'|'.($y+2).':'.($x+3).'|'.($y+3).':'.($x+4).'|'.($y+4).':';}
			if(in_array($u.($x+1).'|'.($y+1), $data) && in_array($u.($x+2).'|'.($y+2), $data) && in_array($u.($x+3).'|'.($y+3), $data) && in_array($u.($x-1).'|'.($y-1), $data) && (!in_array($o.($x-2).'|'.($y-2), $data) || !in_array($o.($x+4).'|'.($y+4), $data))){$win=1;$hld=$x.$y.':'.($x+1).'|'.($y+1).':'.($x+2).'|'.($y+2).':'.($x+3).'|'.($y+3).':'.($x-1).'|'.($y-1).':';}
			if(in_array($u.($x+1).'|'.($y+1), $data) && in_array($u.($x+2).'|'.($y+2), $data) && in_array($u.($x-2).'|'.($y-2), $data) && in_array($u.($x-1).'|'.($y-1), $data) && (!in_array($o.($x-3).'|'.($y-3), $data) || !in_array($o.($x+3).'|'.($y+3), $data))){$win=1;$hld=$x.$y.':'.($x+1).'|'.($y+1).':'.($x+2).'|'.($y+2).':'.($x-2).'|'.($y-2).':'.($x-1).'|'.($y-1).':';}
			if(in_array($u.($x+1).'|'.($y+1), $data) && in_array($u.($x-3).'|'.($y-3), $data) && in_array($u.($x-2).'|'.($y-2), $data) && in_array($u.($x-1).'|'.($y-1), $data) && (!in_array($o.($x-4).'|'.($y-4), $data) || !in_array($o.($x+2).'|'.($y+2), $data))){$win=1;$hld=$x.$y.':'.($x+1).'|'.($y+1).':'.($x-3).'|'.($y-3).':'.($x-2).'|'.($y-2).':'.($x-1).'|'.($y-1).':';}
			if(in_array($u.($x-4).'|'.($y-4), $data) && in_array($u.($x-3).'|'.($y-3), $data) && in_array($u.($x-2).'|'.($y-2), $data) && in_array($u.($x-1).'|'.($y-1), $data) && (!in_array($o.($x-5).'|'.($y-5), $data) || !in_array($o.($x+1).'|'.($y+1), $data))){$win=1;$hld=$x.$y.':'.($x-4).'|'.($y-4).':'.($x-3).'|'.($y-3).':'.($x-2).'|'.($y-2).':'.($x-1).'|'.($y-1).':';}
			//Kiểm tra đường chéo thứ hai
			if(in_array($u.($x-1).'|'.($y+1), $data) && in_array($u.($x-2).'|'.($y+2), $data) && in_array($u.($x-3).'|'.($y+3), $data) && in_array($u.($x-4).'|'.($y+4), $data) && (!in_array($o.($x+1).'|'.($y-1), $data) || !in_array($o.($x-5).'|'.($y+5), $data))){$win=1;$hld=$x.$y.':'.($x-1).'|'.($y+1).':'.($x-2).'|'.($y+2).':'.($x-3).'|'.($y+3).':'.($x-4).'|'.($y+4).':';}
			if(in_array($u.($x-1).'|'.($y+1), $data) && in_array($u.($x-2).'|'.($y+2), $data) && in_array($u.($x-3).'|'.($y+3), $data) && in_array($u.($x+1).'|'.($y-1), $data) && (!in_array($o.($x+2).'|'.($y-2), $data) || !in_array($o.($x-4).'|'.($y+4), $data))){$win=1;$hld=$x.$y.':'.($x-1).'|'.($y+1).':'.($x-2).'|'.($y+2).':'.($x-3).'|'.($y+3).':'.($x+1).'|'.($y-1).':';}
			if(in_array($u.($x-1).'|'.($y+1), $data) && in_array($u.($x-2).'|'.($y+2), $data) && in_array($u.($x+2).'|'.($y-2), $data) && in_array($u.($x+1).'|'.($y-1), $data) && (!in_array($o.($x+3).'|'.($y-3), $data) || !in_array($o.($x-3).'|'.($y+3), $data))){$win=1;$hld=$x.$y.':'.($x-1).'|'.($y+1).':'.($x-2).'|'.($y+2).':'.($x+2).'|'.($y-2).':'.($x+1).'|'.($y-1).':';}
			if(in_array($u.($x-1).'|'.($y+1), $data) && in_array($u.($x+3).'|'.($y-3), $data) && in_array($u.($x+2).'|'.($y-2), $data) && in_array($u.($x+1).'|'.($y-1), $data) && (!in_array($o.($x+4).'|'.($y-4), $data) || !in_array($o.($x-2).'|'.($y+2), $data))){$win=1;$hld=$x.$y.':'.($x-1).'|'.($y+1).':'.($x+3).'|'.($y-3).':'.($x+2).'|'.($y-2).':'.($x+1).'|'.($y-1).':';}
			if(in_array($u.($x+4).'|'.($y-4), $data) && in_array($u.($x+3).'|'.($y-3), $data) && in_array($u.($x+2).'|'.($y-2), $data) && in_array($u.($x+1).'|'.($y-1), $data) && (!in_array($o.($x+5).'|'.($y-5), $data) || !in_array($o.($x-1).'|'.($y+1), $data))){$win=1;$hld=$x.$y.':'.($x+4).'|'.($y-4).':'.($x+3).'|'.($y-3).':'.($x+2).'|'.($y-2).':'.($x+1).'|'.($y-1).':';}
			}
			//Nếu thắng, cập nhật bàn chơi này
			if($win){
				$sql='UPDATE carodata SET `winner`='.mysqli_result($result,0,'p'.$u).', `hl`="'.$hld.'", `tinhtrang`=2, `wline`="'.$wline.'" WHERE id='.$_GET['id'];
				$result=$connect->query($sql);
				$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
					LEFT JOIN users x ON c.px = x.id
					LEFT JOIN users o ON c.po = o.id
					WHERE c.id='.$_GET['id'];
				$result=$connect->query($sql);
				$sql = 'UPDATE users
				SET '.$moneycol.' = '.$moneycol.' + '.mysqli_result($result,0,"muccuoc").', cwin = cwin + 1
				WHERE id = '.mysqli_result($result,0,'p'.$u);
				$connect->query($sql);
				$sql = 'UPDATE users
				SET '.$moneycol.' = '.$moneycol.' - '.mysqli_result($result,0,"muccuoc").', close = close + 1
				WHERE id = '.mysqli_result($result,0,'p'.$o);
				$connect->query($sql);
				$data1=explode(":",mysqli_result($result,0,'data1'));
				$data1f=mysqli_result($result,0,'data1');
				$data2f=mysqli_result($result,0,'data1');
				$data2=explode(":",mysqli_result($result,0,'data2'));
				$socot=mysqli_result($result,0,'socot');
				$hl=explode(":",mysqli_result($result,0,'hl'));
			}
		}}
		 if((mysqli_result($result,0,"waittime")-((int)((time()-mysqli_result($result,0,"lastturn"))/60)))<1 && $view!=1 && mysqli_result($result,0,"turn")!=$datauser['id'] && $_POST['xt'] && !mysqli_result($result,0,"winner") && mysqli_result($result,0,"turn")!=0) {
		 				$sql='UPDATE carodata SET `winner`='.mysqli_result($result,0,'p'.$u).', `hl`="'.$hld.'", `tinhtrang`=2 WHERE id='.$_GET['id'];
				$result=$connect->query($sql);
				$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
					LEFT JOIN users x ON c.px = x.id
					LEFT JOIN users o ON c.po = o.id
					WHERE c.id='.$_GET['id'];
				$result=$connect->query($sql);
				$sql = 'UPDATE users
				SET '.$moneycol.' = '.$moneycol.' + '.mysqli_result($result,0,"muccuoc").', cwin = cwin + 1
				WHERE id = '.mysqli_result($result,0,'p'.$u);
				$connect->query($sql);
				$sql = 'UPDATE users
				SET '.$moneycol.' = '.$moneycol.' - '.mysqli_result($result,0,"muccuoc").', close = close + 1
				WHERE id = '.mysqli_result($result,0,'p'.$o);
				$connect->query($sql);
				$data1=explode(":",mysqli_result($result,0,'data1'));
				$data1f=mysqli_result($result,0,'data1');
				$data2f=mysqli_result($result,0,'data1');
				$data2=explode(":",mysqli_result($result,0,'data2'));
				$socot=mysqli_result($result,0,'socot');
				$hl=explode(":",mysqli_result($result,0,'hl'));
		 }
		echo'<div class="menu list-bottom congdong">Bàn số #'.$_GET['id'].':</div>';
		echo 'Thời gian chờ: <b>'.mysqli_result($result,0,'waittime').' phút</b>.<br>';
		if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'po')==$datauser['id']){
		?>
		<form style="display:inline;" action="/vuichoi/caro/?id=<?php echo $_GET['id']; ?>" method="post" id="ttt">
		<input type="hidden" name="ap" value="1"><input type="submit" name="ttt" id="ttt" value="Chấp nhận thách đấu" />
		</form>
		<form style="display:inline;" action="/vuichoi/caro/caroaction.php?id=<?php echo $_GET['id']; ?>" method="post" id="ttt">
		<input type="hidden" name="dn" value="1"><input type="submit" name="ttt" id="ttt" value="Từ chối" /><br>
		</form>
		<?php } if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'px')==$datauser['id'] && mysqli_result($result,0,'po')!=0){
		echo 'Đang chờ chấp thuận của đối thủ...<br>';
		}
		if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'po')==0 && mysqli_result($result,0,'px')!=$datauser['id'] && $datauser['id'] != ANONYMOUS){ ?>
		<form style="display:inline;" action="/vuichoi/caro/?id=<?php echo $_GET['id']; ?>" method="post" id="ttt">
		<input type="hidden" name="jn" value="1"><input type="submit" name="ttt" id="ttt" value="Tham gia" /><br>
		</form>
		<?php }
		if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'tinhtrang')==0 && mysqli_result($result,0,'po')==0 && mysqli_result($result,0,'px')==$datauser['id']) {
		echo '<span style="color:#ff1234;">Đang chờ đối thủ tham gia...</span>';		
		}
		if(mysqli_result($result,0,'turn')==0 && mysqli_result($result,0,'px')==$datauser['id'] && $datauser['id'] != ANONYMOUS){ ?>
                <div class="menu list-bottom">
		<form style="display:inline;" action="/vuichoi/caro/caroaction.php?id=<?php echo $_GET['id']; ?>" method="post" id="ttt">
		<input type="hidden" name="cn" value="1"><input type="submit" name="ttt" id="ttt" value="Hủy bàn" /><br>
		</form>
                </div>
		<?php }
		if(mysqli_result($result,0,'winner')==0 && mysqli_result($result,0,'turn')!=0){
		if($view!=1){
		if(mysqli_result($result,0,'turn')==$datauser['id'] && $view!=1){echo '<b>Đến lượt của bạn</b>';}
		if(mysqli_result($result,0,'turn')==mysqli_result($result,0,'p'.$o) && $view!=1 && mysqli_result($result,0,'turn')!=0){echo '<b>Lượt của đối thủ</b>';}}
		else{
		echo '<b>Đến lượt của ';
		if(mysqli_result($result,0,'turn')==mysqli_result($result,0,'px')){echo '<a href="/account/'.mysqli_result($result,0,"px").'">'.mysqli_result($result,0,"xname").'</a></b>';}
		else {echo '<a href="/account/'.mysqli_result($result,0,"po").'">'.mysqli_result($result,0,"oname").'</a></b>';}
		}
		if((mysqli_result($result,0,"waittime")*60-(time()-mysqli_result($result,0,"lastturn")))>=0){
		$thoigian=(mysqli_result($result,0,"waittime")-(((time()-mysqli_result($result,0,"lastturn"))/60)));
		$thoigian=explode(".",$thoigian);
		$phut=$thoigian[0];
		$giay=(60-(((time()-mysqli_result($result,0,"lastturn"))%60))==60) ? '00' : (60-(((time()-mysqli_result($result,0,"lastturn"))%60)));
		$time='thời gian còn '.$phut.' phút '.$giay.' giây.';
		} else {$time='hết giờ.';}
		echo ', '.$time.'<br>';}
		if((mysqli_result($result,0,"waittime")-((int)((time()-mysqli_result($result,0,"lastturn"))/60)))<1 && $view!=1 && mysqli_result($result,0,"turn")!=$datauser['id'] && mysqli_result($result,0,"winner")==0 && mysqli_result($result,0,"turn")!=0) {  ?>
		<form style="display:inline;" action="/vuichoi/caro/?id=<?php echo $_GET['id']; ?>" method="post" id="ttt">
		<input type="hidden" name="xt" value="1"><input type="submit" name="ttt" id="ttt" value="Xử thua đối thủ" /><br>
		</form>
		<?php }
                echo'<div class="menu" style="text-align:center;">';
		if($_GET['size']==2){
		$tdsize="10";
		$gsize='&size=2';
		$pg=1;
		echo '<a href="/vuichoi/caro/?id='.$_GET['id'].'">[ <b>Xem kích cỡ lớn hơn</b> ]</a>&#160;';
		$c1='gif';
                $b1='png';
		} else {
		$pg=2;
		echo '<a href="/vuichoi/caro/?id='.$_GET['id'].'&size=2">[ <b>Xem kích cỡ nhỏ</b> ]</a>&#160;';
		$tdsize="20";
		$b1='gif';
                $c1='png';
		}
		echo '<a href="/vuichoi/caro/?id='.$_GET['id'].$gsize.'">[ <b>Cập nhật/tải lại</b> ]</a>';
                echo'</div>';
		echo '
		<style>
.smi .cr:hover
{
background-image:url("/'.$u.'.'.$b1.'"); height:<php echo $tdsize; ?>px; width: <php echo $tdsize; ?>px; border:0px;display:inline-block;
}
</style>
		<div width="100%" align="center">
		<table cellspacing="0" class="tab" align="center">';
		$a=1;
		while($a<$socot){
			$b=1;
			echo '<tr class="trc">';
			while($b<$socot) {
				if(mysqli_result($result,0,'new')==1){
				$tds=((array_search($a.'|'.$b, $data2)==(count($data2)-2) && (count($data2)-2) !=0) || in_array($a.'|'.$b, $hl)) ? ' style="background-color: rgb(249, 240, 218)"' : ' style="background-image:url(p'.$pg.'.png)"';
				echo '<td class="smi"'.$tds.'>';
				if(in_array($a.'|'.$b, $data2)){echo '<img src="/vuichoi/caro/'.$data1[array_search($a.'|'.$b, $data2)].'.'.$b1.'">';}
				else {
					if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '<a class="cr" href="/vuichoi/caro/?id='.$_GET['id'].'&action='.$a.'.'.$b.$gsize.'">';}
					if($_GET['size']==2 && $datauser['cview']==1){echo '<img src="tdi/'.$a.'.'.$b.'.png">';}else {echo '<img src="/vuichoi/caro/b.'.$c1.'">';}
					if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '</a>';}
				}
				echo '</td>';
				$b++;
				} else {
				if(mysqli_result($result,0,'new')==1){
$tds=((array_search($a.$b, $data2)==(count($data2)-2) && (count($data2)-2) !=0) || (!mysqli_result($result,0,"wline") && in_array($a.$b, $hl))) ? ' style="background-color: rgb(249, 240, 218)"' : ' style="background-image:url(p'.$pg.'.png)"';
				echo '<td class="smi"'.$tds.'>';
				if(in_array($a.$b, $data2)){ ?><span style="background-image: url(/<?php echo $data1[array_search($a.$b, $data2)].'.'.$b1; ?>); height:<php echo $tdsize; ?>px; width: <php echo $tdsize; ?>px; border:0px;display:inline-block;">
				<?php if(mysqli_result($result,0,"wline") && in_array($a.$b, $hl)){ echo '<img src="/vuichoi/caro/'.mysqli_result($result,0,"wline").'_'.$tdsize.'.png">';} else { ?>
				<img src="/vuichoi/caro/b.<?php echo $c1; ?>"> <?php } ?>
				</span> <?php }
				else {
					if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '<a href="/vuichoi/caro/?id='.$_GET['id'].'&action='.$a.'.'.$b.$gsize.'">';}
					echo '<img src="/vuichoi/caro/b.'.$c1.'">';
					if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '</a>';}
				}
				echo '</td>';
				$b++;
}
				}
			}
			echo '</tr>';
			$a++;
		}
		echo '</table></div>';
		?>
		<?php
		if(mysqli_result($result,0,"winner")){if(mysqli_result($result,0,"winner")==mysqli_result($result,0,"px")){
		echo '<b><a href="/account/'.mysqli_result($result,0,"px").'">'.nick(mysqli_result($result,0,"px")).'</a></b> chiến thắng!';}
		else {
		echo '<b><a href="/account/'.mysqli_result($result,0,"po").'">'.nick(mysqli_result($result,0,"po")).'</a></b> chiến thắng!';
		}
		if (mysqli_result($result,0,"hl")==''){echo ' Vì đối thủ hết giờ mà không đánh';}
		}
		echo '<br><center><b><img src="/vuichoi/caro/x.png"> <a href="/account/'.mysqli_result($result,0,"px").'">'.nick(mysqli_result($result,0,"px")).'</a>';
		echo ' VS <img src="/vuichoi/caro/o.png"> <a href="/account/'.mysqli_result($result,0,"po").'">'.nick(mysqli_result($result,0,"po")).'</a></b><br>Mức cược: '.mysqli_result($result,0,"muccuoc").'xu</center>';
		if($datauser['id']!=0) { ?>
</div>
<div class="main-xmenu">
<div class="danhmuc">Chatbox</div>
<div class="menu list-bottom congdong">
<form action="/vuichoi/caro/carocmt.php" method="post">
<input type="hidden" name="tid" value="<?php echo $_GET['id']; ?>"><span id="chat"><input type="text" name="noidung" value=""></span> <input type="submit" name="login" value="Chat"/>
</form>
</div>
<? }
$sql3 = 'SELECT c.*, u.name, u.rights FROM carocmt c LEFT JOIN users u ON c.uid = u.id WHERE tid='.$_GET['id'].' ORDER BY id DESC LIMIT 0, 10';
$result3 = $connect->query($sql3);
$num=mysql_numrows($result3);
$a=0;
while($a<$num) {
$cmt=mysqli_result($result3,$a,"cmt");
echo'<div class="menu">';
echo '<img src="'.$home.'/avatar/'.mysqli_result($result3,$a,"uid").'.png" alt="'. $login. '" style="vertical-align: top;"/>&#160;<a href="/account/'.mysqli_result($result3,$a,"uid").'">'.nick(mysqli_result($result3,$a,"uid")).'</a>: '.functions::smileys(functions::checkout(mysqli_result($result3,$a,"cmt"), 1, 1), mysqli_result($result3,$a,"rights") ? 1 : 0).'<br>'; $a++; 
echo'</div>';
}
} else {
header('Location: '.$home.'/vuichoi/caro/');
}
}
?>
</div>
<?php require('../../incfiles/end.php');

?>