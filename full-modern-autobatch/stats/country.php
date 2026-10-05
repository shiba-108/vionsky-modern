<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Countries (hits)</div>';
$count = ($connect->query("SELECT COUNT(DISTINCT `country`) FROM `counter`;")->fetch_row()[0] ?? 0);
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` GROUP BY `country` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_hits = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `country` = '".$arr['country']."'") , 0);
        
        echo '<img src="icons/country.png" alt="."/> '.$arr['country'].'
        <div class="sub">Hits: '.$count_hits.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Total: '.$count.'</div>';
    if ($count > $kmess){
        echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=country&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="country"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">No providers for today!</div>';   
}
?>