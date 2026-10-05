<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');
$robot = isset($_GET['robot']) ? functions::check($_GET['robot']) : FALSE;

if(!$robot){
    echo functions::display_error('Incorrect parameters!', '<a href="index.php">Statistic</a>');
    include_once '../incfiles/end.php';
    exit;
}

echo '<div class="phdr">Robot statistic '.$robot.'</div>';
$count = $connect->query("SELECT * FROM ...")$connect->query("select * from `counter` WHERE `robot` = '".$robot."' GROUP BY `robot_type`;"));
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` WHERE `robot` = '".$robot."' GROUP BY `robot_type` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '".$robot."' AND `robot_type` = '".$arr['robot_type']."'") , 0);
        
        echo '<img src="icons/robot.png" alt="."/> <b>'.$arr['robot_type'].'</b>
        <div class="sub">Total hits: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Total robots: '.$count.'</div>';
    
}else{
 echo '<div class="rmenu">No robots for today!</div>';   
}

$back_links = '<a href="index.php?act=robots">To all robots</a><br/>';

?>