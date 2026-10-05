<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Robots statistic</div>';
$count = ($connect->query("SELECT COUNT(DISTINCT `robot`) FROM `counter` WHERE `robot` != '';")->fetch_row()[0] ?? 0);
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` WHERE `robot` != '' GROUP BY `robot` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '".$arr['robot']."'") , 0);
        
        echo '<img src="icons/robot.png" alt="."/> <a href="index.php?act=robot_types&amp;robot='.$arr['robot'].'">'.$arr['robot'].'</a>
        <div class="sub">Total hits: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Total robots: '.$count.'</div>';
    
}else{
 echo '<div class="rmenu">No robots for today!</div>';   
}
?>