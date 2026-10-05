<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Providers (hits)</div>';
$count = ($connect->query("SELECT COUNT(DISTINCT `operator`, `country`) FROM `counter`;")->fetch_row()[0] ?? 0);
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` GROUP BY `operator`, `country` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_hits = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `country` = '".$arr['country']."' AND `operator` = '".$arr['operator']."'") , 0);
        
        echo '<img src="icons/opsos.png" alt="."/> '.$arr['operator'].'
        <div class="sub">Country: '.$arr['country'].' | Hits: '.$count_hits.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Total: '.$count.'</div>';
    if ($count > $kmess){
        echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=opsos&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="opsos"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">No providers for today!</div>';   
}
?>