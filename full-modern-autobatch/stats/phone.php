<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

$arr_model = array('Nokia', 'Siemens', 'SE', 'Samsung', 'LG', 'Motorola', 'NEC', 'Philips', 'Sagem', 'Fly', 'Panasonic', 'Opera', 'komp'); 
if(!in_array($model, $arr_model)){
    echo functions::display_error('Incorrect data!', '<a href="index.php">Statistic</a>');
    include '../incfiles/end.php';
    exit;
}


$model1 = $model;
$sql = '';
if($model == "Nokia"){
    $sql = "WHERE `browser` LIKE '%nokia%'";
}elseif($model == "Siemens"){
    $sql = "WHERE `browser` LIKE 'SIE%' OR `browser` LIKE '%benq%'";
}elseif($model == "SE"){
    $model1 = 'Sony Ericsson';
    $sql = "WHERE `browser` LIKE '%sony%' OR `browser` LIKE '%sonyeric%'";
}elseif($model == "Samsung"){
    $sql = "WHERE `browser` LIKE '%sec%' OR `browser` LIKE '%samsung%'";
}elseif($model == "LG"){
    $sql = "WHERE `browser` LIKE '%lg%'";
}elseif($model == "Motorola"){
    $sql = "WHERE `browser` LIKE '%mot%' OR `browser` LIKE '%motorol%'";
}elseif($model == "NEC"){
    $sql = "WHERE `browser` LIKE '%nec%'";
}elseif($model == "Philips"){
    $sql = "WHERE `browser` LIKE '%philips%'";
}elseif($model == "Sagem"){
    $sql = "WHERE `browser` LIKE '%sagem%'";
}elseif($model == "Fly"){
    $sql = "WHERE `browser` LIKE '%fly%'";
}elseif($model == "Panasonic"){
    $sql = "WHERE `browser` LIKE '%panasonic%'";
}elseif($model == "Opera"){
    $model1 = 'Opera Mini';
    $sql = "WHERE `browser` LIKE '%opera mini%'";
}elseif($model == "komp"){
    $model1 = 'PC';
    $sql = "WHERE `browser` LIKE '%windows%' OR `browser` LIKE '%linux%'";
}

echo '<div class="phdr">Statistic for '.$model1.'</div>';
$count = ($connect->query("SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` ".$sql.";")->fetch_row()[0] ?? 0);
if($count > 0){
    $req = $connect->query("SELECT * FROM `counter` ".$sql." GROUP BY `ip`, `browser` ORDER BY `counter`.`date` DESC LIMIT " . $start . "," . $kmess);
    $i = 0;
    while($arr = $connect->fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `browser` = '".$arr['browser']."' AND `ip` = '".$arr['ip']."'") , 0);
        
		$time = date("H:i", $arr['date']);
        
        echo '<b>'.$time.'</b> - '.$arr['browser'].'
        <div class="sub">Ip: <a href="'.$home.'/panel/index.php?act=search_ip&amp;ip='.$arr['ip'].'">'.$arr['ip'].'</a> <a href="http://ip-whois.net/ip_geo.php?ip='.$arr['ip'].'" title="WhoIS IP">[?]</a> '; 
        
        if($arr['ip_via_proxy'])
        echo '| <a href="'.$home.'/panel/index.php?act=search_ip&amp;ip='.$arr['ip_via_proxy'].'">'.$arr['ip_via_proxy'].'</a> <a href="http://ip-whois.net/ip_geo.php?ip='.$arr['ip_via_proxy'].'" title = "WhoIS ip">[?]</a> ';
        
        echo '| '.$arr['operator'].' | '.$arr['country'].' | Hits: '.$count_view.'</div>';
        
        echo '</div>';
        }
    
    echo '<div class="phdr">Total: '.$count.'</div>';
    if ($count > $kmess){
        echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=phone&amp;model='.$model.'&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="phone"/><input type="hidden" name="model" value="'.$model.'"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">No data to build a chart!</div>';   
}
$back_links = '<a href="index.php?act=phones">Back</a><br/>';
?>