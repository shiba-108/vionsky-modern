<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
error_reporting(0);
include 'head.php';
$vmi=trim($_GET['vmi']);
if(!$vmi){
print "
<div class='shout'>
<form action='?'>
Database Server:<br/> <input name='dbs'><br/>
Database User:<br/> <input name='dbu'><br/>
Database Password:<br/> <input type='password' name='dbp'><br/>
Database Name:<br/> <input name='dbn'><br/>
<br/><input name='vmi' type='submit' value='ENTER DB'>
</form></div>";
}
else{
$a=trim($_GET['dbs']);
$b=trim($_GET['dbu']);
$c=trim($_GET['dbp']);
$d=trim($_GET['dbn']);
if($a=="" || $b=="" || $c=="" || $d=="") err("Something is blank");
$e=base64_encode($a."^^^".$b."^^^".$c."^^^".$d);
print"<div class='shout'> WELCOME $dbu <br/>
<br/> &#187; <a href='tables.php?k=$e'>ENTER</a> &#171;
</div>";
}

include 'foot.php';
?>