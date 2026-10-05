<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$tb=trim($_GET['tb']);
$cl=trim($_GET['cl']);
echo "<div class='shout'>
<b>$cl</b> <p align='left'>
<a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a>><a href='?k=$k&tb=$tb&cl=$cl'>$cl</a><br/>- - -<br/>
&#187; <a href='edit_col.php?k=$k&tb=$tb&cl=$cl'>Edit</a><br/><br/>
&#187; <a href='br.php?k=$k&tb=$tb&nm=".base64_encode($cl)."'>Browse</a><br/><br/>
&#187; <a href='dropc.php?k=$k&tb=$tb&cl=$cl'>Drop</a> (delete)
</div>";
include('foot.php');
?>
