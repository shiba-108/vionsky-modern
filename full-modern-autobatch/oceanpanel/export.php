<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$vmi=$_GET['vmi'];
echo "<div class='shout'>EXPORT<p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='?k=$k'>Export</a><br/>- - -<br/>";
if (!$vmi) {
echo "<form action='?k=$k&vmi=ionutvmi' align='left' method='post'>Export:<br/><select name='extb[]' multiple='multiple'>";
$tables = mysql_list_tables("$dbn");
while($tabs = $connect->fetch_row($tables)):
print "<option value='$tabs[0]' selected> $tabs[0] </option>";
endwhile;
print "</select><br/><select name='tp'><option value='vmi'>structure only</option><option value='full'>structure + data</option></select> <br><input type='checkbox' name='zip' value='vmi'> Zip sql file<br><input type='submit' value='ok'></form>

";
} elseif ($vmi=='ionutvmi') {
/* backup the db OR just a table */
function backup_tables($tables = '*',$dt,$zx)
{
	global $k;
		
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = $connect->query('SHOW TABLES');
		while($row = $connect->fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = $connect->query('SELECT * FROM `'.$table.'`');
		$num_fields = mysql_num_fields($result);
		$return.= 'DROP TABLE `'.$table.'`;';
		$row2 = $connect->fetch_row($connect->query('SHOW CREATE TABLE `'.$table.'`'));
		$return.= "\n\n".$row2[1].";\n\n";
		if($dt=="full"){
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = $connect->fetch_row($result))
			{
				$return.= 'INSERT INTO `'.$table.'` VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		} }
		$return.="\n\n\n";
	}
	//save file
	$dd="backup-".date('d_M_Y')."_".time().".sql";
	
	$handle = fopen("data/$dd","w+");
	fwrite($handle,$return);
	fclose($handle);
if ($zx==1) {
fopen("data/$dd.zip","w");

$zip = new ZipArchive;
if ($zip->open("data/$dd.zip") === TRUE) {
$zip->addFile("data/$dd", "$dd") or die('error');
}
$zip->close();
echo "- File $dd.zip created.<br/><br/>- <a href='data/$dd.zip'>DOWNLOAD $dd.zip </a><br/><br/>- <a href='?k=$k&vmi=del&f=$dd.zip'>DELETE FILE $dd.zip </a><br/>";
} else {
echo "- File $dd created.<br/><br/>- <a href='data/$dd'>DOWNLOAD $dd </a><br/><br/>- <a href='?k=$k&vmi=del&f=$dd'>DELETE FILE $dd </a><br/>";
}
	
	echo $f;
	}
	$tbs=$_POST['extb'];
if(!$tbs) die("No Table Selected !!!");
$z=0;
if (isset($_POST['zip'])) {
$z=1;
}
// echo $_POST['tp'];
backup_tables($tbs,$_POST['tp'],$z);

}
if ($vmi=='del') {
$f=$_GET['f'];
$g= @unlink("data/$f");
if ($g) {
echo "FILE $f DELETED"; } else {
echo 'Some error camed up...';
}
}
echo "</div>";
include('foot.php');
?>