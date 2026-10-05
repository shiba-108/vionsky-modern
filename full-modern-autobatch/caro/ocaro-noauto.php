<?php
if($_GET['id']){
$sql='SELECT c.*, x.name AS xname, x.rights AS xrights, o.name AS oname, o.rights AS orights FROM carodata c
LEFT JOIN users x ON c.px = x.id
LEFT JOIN users o ON c.po = o.id
WHERE c.id='.$_GET['id'];
$result=$connect->query($sql);
if(mysql_numrows($result)>0) {
$data1=explode(":",mysqli_result($result,0,'data1'));
$data1f=mysqli_result($result,0,'data1');
$data2f=mysqli_result($result,0,'data2');
$data2=explode(":",mysqli_result($result,0,'data2'));
$socot=mysqli_result($result,0,'socot');
$hl=explode(":",mysqli_result($result,0,'hl'));
if(mysqli_result($result,0,'px')==$datauser['id']){$u='x'; $o='o';} elseif(mysqli_result($result,0,'po')==$datauser['id']) {$u='o'; $o='x';} else {$view=1;}
if($_GET['size']==2){
$tdsize="10";
$gsize='&size=2';
$pg=1;
$c1='gif';$b1='png';
} else {
$pg=2;
$tdsize="20";
$b1='gif';$c1='png';
}
echo '<table cellspacing="0" class="tab" align="center">';#
$a=1;
while($a<$socot){
$b=1;
echo '<tr class="trc">';
while($b<$socot) {
if(mysqli_result($result,0,'new')==1){
$tds=((array_search($a.'|'.$b, $data2)==(count($data2)-2) && (count($data2)-2) !=0) || in_array($a.'|'.$b, $hl)) ? ' style="background-color: rgb(249, 240, 218)"' : ' style="background-image:url(p'.$pg.'.png)"';
echo '<td class="smi"'.$tds.'>';
if(in_array($a.'|'.$b, $data2)){echo '<img src="'.$data1[array_search($a.'|'.$b, $data2)].'.'.$b1.'">';}
else {
if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '<a class="cr" href="/caro/?id='.$_GET['id'].'&action='.$a.'.'.$b.$gsize.'">';}
if($_GET['size']==2 && $datauser['cview']==1){echo '<img src="tdi/'.$a.'.'.$b.'.png">';}else {echo '<img src="b.'.$c1.'">';}
if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '</a>';}
}
echo '</td>';
$b++;
} else {
$tds=((array_search($a.$b, $data2)==(count($data2)-2) && (count($data2)-2) !=0) || (!mysqli_result($result,0,"wline") && in_array($a.$b, $hl))) ? ' style="background-color: rgb(249, 240, 218)"' : ' style="background-image:url(p'.$pg.'.png)"';
echo '<td class="smi"'.$tds.'>';
if(in_array($a.$b, $data2)){ ?><span style="background-image: url(/<?php echo $data1[array_search($a.$b, $data2)].'.'.$b1; ?>); height:<php echo $tdsize; ?>px; width: <php echo $tdsize; ?>px; border:0px;display:inline-block;">
<?php if(mysqli_result($result,0,"wline") && in_array($a.$b, $hl)){ echo '<img src="'.mysqli_result($result,0,"wline").'_'.$tdsize.'.png">';} else { ?>
<img src="b.<?php echo $c1; ?>"> <?php } ?>
</span> <?php }
else {
if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '<a class="cr" href="/caro/?id='.$_GET['id'].'&action='.$a.'.'.$b.$gsize.'">';}

if($_GET['size']==2 && $datauser['cview']==1){echo '<img src="tdi/'.$a.'.'.$b.'.png">';}else {echo '<img src="/b.'.$c1.'">';} if(mysqli_result($result,0,'turn')==$datauser['id']) {echo '</a>';}
}
echo '</td>';
$b++;
}
}
echo '</tr>';
$a++;
}
echo '</table>';
}
}
?>