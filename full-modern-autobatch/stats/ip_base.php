<?php
//////////////////////////////////////////
//   Модуль статистики для JohnCMS      //
//////////////////////////////////////////
//  Автор: Максим (Simba)               //
//  Wap site - http://symbos.su         //
//////////////////////////////////////////

define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'IP base management';
require_once '../incfiles/core.php';
require_once '../incfiles/head.php';
$act = isset($_GET['act']) ? $_GET['act'] : '';
if ($rights >= 9){

switch ($act){
    ////////////////////////////////////
    //////// Управление базой IP ///////
    ////////////////////////////////////
    case 'base':
    echo'<div class="phdr">IP base management</div>';
    $count_ip = ($connect->query("SELECT COUNT(*) FROM `counter_ip_base`;")->fetch_row()[0] ?? 0);
    if($count_ip > 0){
    $ip_base = $connect->query("SELECT * FROM `counter_ip_base` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = $connect->fetch_array($ip_base)){
    echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
    echo ''.long2ip($arr['start']).' - '.long2ip($arr['stop']).' | '.$arr['operator'].' | '.$arr['country'].'
    <div class="sub"><a href="ip_base.php?act=base_edit&amp;id='.$arr['id'].'">Change</a> | <a href="ip_base.php?act=base_delete&amp;id='.$arr['id'].'">Delete</a></div></div>';
    }

    echo '<div class="phdr">Total IP: ' . $count_ip . '</div>';
    if ($count_ip > $kmess){
        echo '<div class="topmenu">';
    	echo '' . functions::display_pagination('ip_base.php?act=base&amp;', $start, $count_ip, $kmess) . '</div>';
    	echo '<p><form action="ip_base.php" method="get"><input type="hidden" name="act" value="base"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}

    }else{ echo'<div class="rmenu">No IP are found!</div>'; }
    echo'<div class="menu"><a href="ip_base.php?act=base_add">Add IP</a></div>';
    break;

    ////////////////////////////////////
    //////// Изменение IP в базе ///////
    ////////////////////////////////////
    case 'base_edit':
    echo'<div class="phdr">IP editing</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['submit']))
    {
    $connect->query("UPDATE `counter_ip_base` SET
    `start` = '".ip2long($_POST['start'])."',
    `stop` = '".ip2long($_POST['stop'])."',
    `operator` = '".functions::check($_POST['operator'])."',
    `country` = '".functions::check($_POST['country'])."'
    WHERE `id` = '" . $id . "' LIMIT 1;");
    echo '<div class="gmenu">Changes saved!</div>';
    }

    $ip_base = $connect->query("SELECT * FROM `counter_ip_base` WHERE `id` = '".$id."'");
    if ($connect->query("SELECT * FROM ...")$ip_base) > 0) {
    $arr = $connect->fetch_array($ip_base);
    echo '<form action="ip_base.php?act=base_edit&amp;id='.$id.'" method="post">
    <div class="menu">Beginning of the range:<br/>
    <input type="text" name="start" value="'.long2ip($arr['start']).'"/></div><div class="menu">
    Ending of the range:<br/>
    <input type="text" name="stop" value="'.long2ip($arr['stop']).'"/></div><div class="menu">
    Provider:<br/>
    <input type="text" name="operator" value="'.$arr['operator'].'"/></div><div class="menu">
    Country:<br/>
    <input type="text" name="country" value="'.$arr['country'].'"/></div><div class="menu">
    <span class="red">Fill the fields correctly, otherwise there may be problems in the building of the statistics!</span><br/>
    <input type="submit" name="submit" value="Change"/></div>
    </form>';
    }else{
        echo'<div class="rmenu">Error! Not found!</div>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">IP list</a></div>';
    break;

    ////////////////////////////////////
    //////// Удаление IP из базы ///////
    ////////////////////////////////////
    case 'base_delete':
    echo'<div class="phdr">Deleting IP</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $ip_base = $connect->query("SELECT * FROM `counter_ip_base` WHERE `id` = '".$id."'");
    if ($connect->query("SELECT * FROM ...")$ip_base) > 0) {
    $connect->query("DELETE FROM `counter_ip_base` WHERE `id` = '".$id."' LIMIT 1");
    echo'<div class="gmenu">Succesfully deleted!</div>';
    }else{
        echo'<div class="rmenu">Error! Not found!</div>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">IP list</a></div>';
    break;

    ////////////////////////////////////
    //////// Изменение IP в базе ///////
    ////////////////////////////////////
    case 'base_add':
    echo'<div class="phdr">Add IP</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['submit']))
    {
    $operator = ($_POST['operator']) ? functions::check($_POST['operator']) : functions::check($_POST['s_operator']);
    $country = ($_POST['country']) ? functions::check($_POST['country']) : functions::check($_POST['s_country']);
    $error = '';
    $ip1 = ip2long($_POST['start']);
    $ip2 = ip2long($_POST['stop']);
    if (!$ip1)
    $error = '<div>First address is invalid</div>';
    if (!$ip2)
    $error .= '<div>Second address is invalid</div>';
    if (!$error && $ip1 > $ip2)
    $error = 'Second address must be longer than the first';
    if(empty($operator))
    $error .= '<div>Please, enter the provider!</div>';
    if(empty($country))
    $error .= '<div>Please, enter the country!</div>';

    if(!$error){
    $connect->query("INSERT INTO `counter_ip_base` SET
    `start` = '".$ip1."',
    `stop` = '".$ip2."',
    `operator` = '".$operator."',
    `country` = '".$country."';");
    echo '<div class="gmenu">Added!</div>';
    }else{
        echo functions::display_error($error, '<a href="ip_base.php?act=base_add">Back</a>');
    }

    }else{
    echo '<form action="ip_base.php?act=base_add" method="post">
    <div class="menu">Beginning of the range:<br/>
    <input type="text" name="start"/><br/>
    <small>For example: 192.168.192.168</small></div><div class="menu">
    Ending of the range:<br/>
    <input type="text" name="stop"/><br/>
    <small>For example: 192.189.122.18</small></div><div class="menu">
    Provider:<br/>
    <input type="text" name="operator"/><br/>
    <small>For example: Beeline</small></div>';
    echo '<div class="menu">Choice the provider from existing:<br/>
    <select name="s_operator" class="textbox">';
    $impcat = $connect->query("SELECT * FROM `counter_ip_base` GROUP BY `operator`;");
    echo '<option value="">Not selected</option>';
    while ($arr = $connect->fetch_array($impcat)) {
        echo '<option value="' . $arr['operator'] . '">' . $arr['operator'] . '</option>';
            }
            echo '</select><br/>
            <small>To enter manually, leave this "not selected"</small>
            </div>';
    echo '<div class="menu">
    Country:<br/>
    <input type="text" name="country"/><br/>
    <small>For example: Russia</small></div>';
    
    echo '<div class="menu">Choose the country from existing:<br/>
    <select name="s_country" class="textbox">';
    $impcat = $connect->query("SELECT * FROM `counter_ip_base` GROUP BY `country`;");
    echo '<option value="">Not selected</option>';
    while ($arr = $connect->fetch_array($impcat)) {
        echo '<option value="' . $arr['country'] . '">' . $arr['country'] . '</option>';
            }
            echo '</select><br/>
            <small>To enter manually, leave this "not selected"</small></div>';
    
    echo '<div class="menu">
    <span class="red">Fill the fields correctly, otherwise there may be problems in the building of the statistics!<br/>
    Beginning of the range must be less than the ending (look an example)!!</span><br/>
    <input type="submit" name="submit" value="Add"/></div>
    </form>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">IP list</a></div>';    
    break;
}

echo '<div class="gmenu"><a href="index.php">To the statistic</a></div>';

}else{
    echo '<div class="rmenu">Access denied!</div>';
}
require_once '../incfiles/end.php';
?>