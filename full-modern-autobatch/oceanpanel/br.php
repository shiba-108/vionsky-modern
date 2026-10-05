<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';

 
$tb=trim($_GET['tb']);
$sql="SELECT * FROM `$tb`";
echo "<div class='shout'>BROWSE<br/>Query: ".htmlspecialchars($sql)."<p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/>Browse</a> |<a href='table.php?k=$k&tb=$tb'> Structure </a>| <a href='in.php?k=$k&tb=$tb'>Insert</a> | <a href='trun.php?k=$k&tb=$tb'>Clear</a> | <a href='dropt.php?k=$k&tb=$tb'>Drop</a><br/>- - -<br/>
";
$result = $connect->query($sql);
if (!$result) {
echo "Table $tb not exist";
} else {


$xx = $connect->query("SHOW INDEXES FROM `$tb` WHERE Key_name = 'PRIMARY'");
$nrr=$connect->query("SELECT * FROM ...")$xx);

if($nrr>0){
while ($row = $connect->fetch_array($xx)) {
$cvn= $row['Column_name'];
$cv[]=$cvn."``0";
}
} else {
$i=0;
while ($i < mysql_num_fields($result)) {
 $meta = mysql_fetch_field($result, $i);
$cvn=$meta->name;
$cv[]=$cvn."``1";
$i++;
}
}

// get column

$nnm=$_GET['nm'];
if(!$nnm) {
$meta = mysql_fetch_field($result, 0);
$nm=$meta->name;
}else{
$nm= trim(base64_decode($nnm));
}
// get nr of columns
$val=$connect->query("SELECT * FROM `$tb`");
$nr=$connect->query("SELECT * FROM ...")$val);
if ($nr >0) {
// get psge

if(!isset($_GET['page'])){
$page = 1;
} else {
$page = (int)$_GET['page'];
}

if($page <= 0) $page=1;
$perp = (int)$_GET['perp'];
if(!$perp) $perp=10; 
if($perp <= 0) $perp=10; 
$from = (($page * $perp) - $perp);
$total_pages = ceil($nr / $perp);
if ($page>$total_pages) {
die("error"); }
$or=$_GET['or'];
if(!$or) $or=0;
if ($or==0) {
$ord='asc'; } else {
$ord='desc'; }
$val=$connect->query("SELECT * FROM `$tb` order by `$nm` $ord LIMIT $from, $perp");

// column list 
$col=$connect->query("SHOW COLUMNS FROM `$tb`");
while ($r = $connect->fetch_array($col)){
$nn[]=$r['Field'];
}
echo "<form action='?' align='left'><select name='nm'>";
foreach($nn as $n){
$nc=base64_encode($n);
if($nm == $n)
echo "<option value='$nc' SELECTED> ".htmlspecialchars($n)." </option>";
else
echo "<option value='$nc'> ".htmlspecialchars($n)." </option>";
}
echo "</select> <input type='hidden' name='k' value='$k'>
<input type='hidden' name='page' value='$page'>
<input type='hidden' name='tb' value='$tb'>
<input type='hidden' name='perp' value='$perp'>
<input type='hidden' name='or' value='$or'>
<input type='submit' value='Show'><br>- - -<br></form><p align='left'>";

// asc/desc

if ($ord=='asc') {
echo "Asc | <a href='?k=$k&nm=$nnm&tb=$tb&or=1&page=$page&perp=$perp'>Desc</a><br/><br/>"; } else {
echo "<a href='?k=$k&nm=$nnm&tb=$tb&page=$page&perp=$perp'>Asc</a> | Desc<br/><br/>"; }

// column values
echo "<form action='mdelc.php?k=$k&tb=$tb' method='post' align='left'>";
while ($row = $connect->fetch_array($val)) {
$v=$row["$nm"];
$pri="";
foreach ($cv as $c){
$cc=explode("``",$c);
$c=$cc[0];
$pv= $row["$c"];
if($cc[1] == 0) {
$cc="`$tb`.`$c`";
} else { 
$cc= "CONVERT(`$tb`.`$c` USING utf8)";
}
$pri.=" $cc = '$pv' AND";
}
$pri=substr($pri,0,-3);
$pri=base64_encode($pri);


echo "<input type='checkbox' name='i[]' value='$pri'> - <b><a href='br2.php?k=$k&tb=$tb&pri=$pri'>".htmlspecialchars($v)."</a></b>";
echo "<br/>
";
}


echo "<br/>- - -<br/><input type='submit' name='delbr' value='DELETE SELECTED'></form><p align='left'>- - -<br/>";
mysql_free_result($val);


// pagination function
function pag($total,$currentPage,$baseLink,$nextPrev=true,$limit=10) { 
if(!$total OR !$currentPage OR !$baseLink) { 
return false; } //Total Number of pages 
$totalPages = ceil($total/$limit); //Text to use after number of pages 
$txtPagesAfter = ($totalPages==1)? " page": " pages"; //Start off the list. 
$txtPageList = '<br />' .$totalPages.$txtPagesAfter .': <br />' ; //Show only 3 pages before current page(so that we don't have too many pages) 
$min = ($currentPage - 3 < $totalPages && $currentPage-3 > 0) ? $currentPage-3 : 1; //Show only 3 pages after current page(so that we don't have too many pages) 
$max = ($currentPage + 3 > $totalPages) ? $totalPages : $currentPage+3; //Variable for the actual page links 
$pageLinks = ""; //Loop to generate the page links 
for($i=$min;$i<=$max ;$i++) { 
if($currentPage==$i) { //Current Page 
$pageLinks .= ' <b class="selected">'.$i.'</b> ' ; } 
else { $pageLinks .= ' <a href="'.$baseLink.$i.'" class="page">'.$i.'</a> ' ; } } 
if($nextPrev ) { //Next and previous links 
$next = ($currentPage + 1 > $totalPages) ? false : '<a href="'.$baseLink.($currentPage + 1) .'">Next</a>' ; 
$prev = ($currentPage - 1 <= 0 ) ? false : '<a href="'.$baseLink.($currentPage - 1).'">Prev</a>' ; } 
$first= ($currentPage > 2) ? '<a href="'.$baseLink.'1">First</a> ': false ;

 $last= ($currentPage < ($totalPages - 2)) ? " <a href='".$baseLink.$totalPages."'>Last</a> " : false ;

return $txtPageList.$first.$prev.$pageLinks.$next.$last; } 
 // end pagination

// show pages
if($total_pages != 1)
echo pag($nr,$page,"?or=$or&nm=$nnm&k=$k&perp=$perp&tb=$tb&page=",true,$perp);
else
echo "1 page<br>- - -";

if ($total_pages>2) {
echo "<form action='?' align='left'><input type='hidden' name='k' value='$k'><input type='hidden' name='tb' value='$tb'><input type='hidden' name='nm' value='$nnm'><input type='hidden' name='perp' value='$perp'><input name='page' value='$page' size='2'>";
if ($ord=='desc') echo "<input type='hidden' name='or' value='$or'>";
echo " <input type='submit' value='Jump'><br/>- - -</form>";
}

echo "<form action='?' align='left'><br/>Show <input type='hidden' name='k' value='$k'><input type='hidden' name='tb' value='$tb'>
<input type='hidden' name='or' value='$or'><input type='hidden' name='nm' value='$nnm'>
<input name='perp' value='$perp' size='2'>";
echo " <input type='submit' value='Per Page'></form>";

} else {
echo "No values inserted<br/>";
}
}
echo "<p align='center'>$nr records</div>";
include('foot.php');
?>