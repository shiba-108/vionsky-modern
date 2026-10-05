<?php
/**
 * @author simba
 * @copyright 2011
 */
 
define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'Site statistic';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$act = isset($_GET['act']) ? $_GET['act'] : '';
if(isset($_GET['sday'])){
    $_SESSION['sday'] = $_GET['sday'];
}
if(isset($_GET['sengine'])){
    $_SESSION['sengine'] = $_GET['sengine'];
}
$day = isset($_SESSION['sday']) ? $_SESSION['sday'] : '';
$engine = isset($_SESSION['sengine']) ? $_SESSION['sengine'] : '';


switch ($act)
{
case 'se':
$sql = '';
$n = 'all';
/////// Выбираем поисковую машину ///////
switch ($engine){
    case 'google':
    $sql = " AND `engine` LIKE '%google%'";
    $n = 'www.google.ru';
    break;
    case 'mail':
    $sql = " AND `engine` LIKE '%mail%'";
    $n = 'mail.ru';
    break;
    case 'rambler':
    $sql = " AND `engine` LIKE '%rambler%'";
    $n='rambler.ru';
    break;
    case 'yandex':
    $sql = " AND `engine` LIKE '%yandex%'";
    $n='yandex.ru';
    break;
    case 'bing':
    $sql = " AND `engine` LIKE '%bing%'";
    $n='bing.com';
    break;
    case 'nigma':
    $sql = " AND `engine` LIKE '%nigma%'";
    $n='nigma.ru';
    break;
    case 'qip':
    $sql = " AND `engine` LIKE '%qip%'";
    $n='search.qip.ru';
    break;
    case 'aport':
    $sql = " AND `engine` LIKE '%aport%'";
    $n='aport.ru';
    break;
    case 'gogo':
    $sql = " AND `engine` LIKE '%gogo%'";
    $n='gogo.ru';
    break;
    case 'yahoo':
    $sql = " AND `engine` LIKE '%yahoo%'";
    $n='yahoo.ru';
    break;
    }
echo'<div class="phdr">Statistic for '.$n.'</div>';
/////// Вычисляем время /////////
$time = strtotime(date("d F y", statistic::$system_time));
$time1 = $time-86400;
$time7 = $time-604800;
///// Выбираем нужный период ////
switch ($day){
        ///// Весь период /////
         case "all":
         $sql = str_replace('AND', 'WHERE', $sql);
         $total = ($connect->query("SELECT COUNT(*) FROM `stat_robots` ".$sql."")->fetch_row()[0] ?? 0);
         if($total > 0)
         $req = $connect->query("SELECT * FROM `stat_robots` ".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
        ///// Семь дней /////
         case "seven":
         $total = ($connect->query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time7."' and `date` < '".$time."' ".$sql."")->fetch_row()[0] ?? 0);
         if($total > 0)
         $req = $connect->query("SELECT * FROM `stat_robots` WHERE `date` > '".$time7."' and `date` < '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
         ///// За прошедший день (вчера) /////
         case "two":
         $total = ($connect->query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time1."' and `date` < '".$time."'".$sql."")->fetch_row()[0] ?? 0);
         if($total > 0)
         $req = $connect->query("SELECT * FROM `stat_robots` WHERE `date` > '".$time1."' and `date` < '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
         /////// Стандарт за сутки /////
         default:
         $total = ($connect->query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time."'".$sql."")->fetch_row()[0] ?? 0);
         if($total > 0)
         $req = $connect->query("SELECT * FROM `stat_robots` WHERE `date` > '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);

         break;
         }
////// Выводим ссылки для выбора периода ////////
         echo'<div class="menu">Period: ';
if($day !== 'seven' && $day !== 'two' && $day !== 'all'){
echo'<b>Today</b> | <a href="?act=se&amp;sday=two">Yesterday</a> | <a href="?act=se&amp;sday=seven">7 days</a> | <a href="?act=se&amp;sday=all">All time</a>';         
}elseif($day == 'two'){
echo'<a href="?act=se&amp;sday=one">Today</a> | <b>Yesterday</b> | <a href="?act=se&amp;sday=seven">7 days</a> | <a href="?act=se&amp;sday=all">All time</a>';    
}elseif($day == 'seven'){
echo'<a href="?act=se&amp;sday=one">Today</a> | <a href="?act=se&amp;sday=two">Yesterday</a> | <b>7 days</b> | <a href="?act=se&amp;sday=all">All time</a>';    
}elseif($day == 'all'){
echo'<a href="?act=se&amp;sday=one">Today</a> | <a href="?act=se&amp;sday=two">Yesterday</a> | <a href="?act=se&amp;sday=seven">7 days</a> | <b>All time</b>';    
}
echo'</div>';

//////// Выводим полученный результат или сообщение об отсутствии ///////

if($total > 0){
while ($arr = $connect->fetch_array($req)){
    echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
    ++$i;
    $vr = date("H:i", $arr['date']);
    echo '<a href="'.$arr['url'].'">'.$arr['query'].'</a> ['.$vr.']<br/>
    <small>IP: <a href="../panel/index.php?act=search_ip&amp;ip='.long2ip($arr['ip']).'">'.long2ip($arr['ip']).'</a>';
    if($day !== 'seven' && $day !== 'two'){ echo' Hits Today: '.$arr['today']; }
    echo' Total: '.$arr['count'];
    echo'<br/>UA: '.$arr['ua'].'</small>
    </div>';
}

        echo '<div class="phdr">Total: ' . $total . '</div>';
		if ($total > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('stat_search.php?act=se&amp;', $start, $total, $kmess) . '</div>';
    	echo '<p><form action="stat_search.php" method="get"><input type="hidden" name="act" value="se"/><input type="text" name="page" size="2"/><input type="submit" value="To the page &gt;&gt;"/></form></p>';}
 }else{
    echo'<div class="rmenu">No referrals from search engines for this period!</div>';
 }      
   echo'<div class="menu"><a href="stat_search.php?">Choosing a search engine</a></div>';     
   echo'<div class="menu"><a href="index.php">To the statistic</a></div><br/>';
 
break;


default:
$where_time = strtotime(date("d F y", statistic::$system_time));
$sql = "
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%yandex%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%mail%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%rambler%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%google%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%gogo%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%yahoo%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%bing%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%nigma%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%qip%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%aport%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."')";

$query = $connect->query($sql);
$count_query = array();
while($result_array = $connect->fetch_array($query)) {
        $count_query[] = $result_array[0];
        }
////// Выводим ссылки и количество переходов ///
echo'<div class="phdr"><img src="icons/search.png" alt="." /> Statistics of search queries</div>';
echo'<div class="menu"><img src="icons/yandex.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=yandex">Yandex.ru</a> ('.$count_query[0].')<br/>';
echo'<img src="icons/mail.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=mail">Mail.ru</a> ('.$count_query[1].')<br/>';
echo'<img src="icons/rambler.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=rambler">Rambler.ru</a> ('.$count_query[2].')<br/>';
echo'<img src="icons/google.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=google">Google.ru</a> ('.$count_query[3].')<br/>';
echo'<img src="icons/gogo.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=gogo">Gogo.ru</a> ('.$count_query[4].')<br/>';
echo'<img src="icons/yahoo.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=yahoo">Yahoo.ru</a> ('.$count_query[5].')<br/>';
echo'<img src="icons/bing.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=bing">Bing.ru</a> ('.$count_query[6].')<br/>';
echo'<img src="icons/nigma.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=nigma">Nigma.ru</a> ('.$count_query[7].')<br/>';
echo'<img src="icons/qip.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=qip">Search.QIP.ru</a> ('.$count_query[8].')<br/>';
echo'<img src="icons/aport.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=aport">Aport.ru</a> ('.$count_query[9].')</div>';
echo'<div class="bmenu"><img src="icons/all1.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=all">All queries</a> ('.$count_query[10].')</div>';
echo'<div class="gmenu"><a href="index.php">To the statistic</a></div><br/>';

break;
}
require_once ('../incfiles/end.php');
?>