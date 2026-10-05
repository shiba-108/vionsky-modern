<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Hits sources</div>';

$my_url = parse_url($home);

$count = ($connect->query("SELECT COUNT(DISTINCT `site`) FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."';")->fetch_row()[0] ?? 0);
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."' GROUP BY `site` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $time = date("H:i", $arr['date']);
        $count_hits = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `site` = '".$arr['site']."'") , 0);
        echo '<img src="icons/url.png" alt="."/> <a href="index.php?act=siteadr&amp;site='.$arr['site'].'">'.$arr['site'].'</a>
        <div class="sub">'.$time.' | Hits: '.$count_hits.'</div>
        ';
        echo '</div>';
        }
    
    echo '<div class="phdr">Total: '.$count.'</div>';
    if ($count > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=referer&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="referer"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">No users for today!</div>';   
}
?>