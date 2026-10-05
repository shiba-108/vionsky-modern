<?php
//////////////////////////////////////////
//   Модуль статистики для JohnCMS      //
//////////////////////////////////////////
//  Автор: Максим (Simba)               //
//  Wap site - http://symbos.su         //
//////////////////////////////////////////

@ini_set('max_execution_time', 5);
@set_time_limit(5);

define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'Site Statistics';
require_once '../incfiles/core.php';
require_once '../incfiles/head.php';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$model = isset($_GET['model']) ? functions::check($_GET['model']) : '';

// Дополнительные страницы //
$do = array('robots', 'robot_types', 'hosts', 'point_in', 'opsos', 'allstat',
 'country', 'users', 'referer', 'siteadr', 'pop', 'phones', 'phone', 'os');
if (in_array($act, $do)){
$back_links = '';
include_once ($act . '.php');
echo '<div class="gmenu">'.$back_links.'<a href="index.php">To the statistics</a></div>';
include '../incfiles/end.php';
exit;
}


// Главная статистики //

$begin_day = strtotime(date("d F y", statistic::$system_time));
$my_url = parse_url($home);
$sql = "
(SELECT COUNT(*) FROM `counter` WHERE `robot` != '') UNION ALL
(SELECT COUNT(DISTINCT `pop`) FROM `counter` WHERE `robot` = '') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$begin_day."') UNION ALL
(SELECT COUNT(DISTINCT `country`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `operator`, `country`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `robot`) FROM `counter` WHERE `robot` != '') UNION ALL
(SELECT COUNT(DISTINCT `user`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `site`) FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."')
";

$query = $connect->query($sql);
$count_stat = array();
while($result_array = $connect->fetch_array($query)) {
        $count_stat[] = $result_array[0];
        }


$hitnorob = statistic::$hity - $count_stat[0];

echo '<div class="phdr">Statistics</div>
<div class="gmenu"><h3><img src="icons/statistic.png" alt="."/> General Information</h3>
<li>Hits for today: '.statistic::$hity.'</li>
<li>Hosts for today: '.statistic::$hosty.'</li>
<li>Hits by robots: '.$count_stat[0].'</li>
<li>Hits without robots: '.$hitnorob.'</li>';


//////// Максимум хостов //////
$maxhost = $connect->query("SELECT `date`, `host` FROM `countersall` ORDER BY `countersall`.`host` DESC LIMIT 0 , 1");
if($connect->query("SELECT * FROM ...")$maxhost) > 0){
$maxhost = $connect->fetch_array($maxhost);
/////// Максимум хитов ////////
$maxhits = $connect->fetch_array($connect->query("SELECT `date`, `hits` FROM `countersall` ORDER BY `countersall`.`hits` DESC LIMIT 0 , 1"));
$max_host_time = date("d M Y", $maxhost['date']);
$max_hits_time = date("d M Y", $maxhits['date']);
echo '<li>Most users ever online was (<b>'.$maxhost['host'].'</b>) on <b>'.statistic::month($max_host_time).'.</b></li>
<li>Most hits (<b>'.$maxhits['hits'].'</b>) on <b>'.statistic::month($max_hits_time).'.</b></li>';
}

echo '<li>The average number of hits per visitor: '.round($hitnorob/statistic::$hosty).'</li></div>';

$percent = statistic::$hosty/100; // 1%
$searchpercent = $count_stat[2]/$percent; // % поисковиков
echo '<div class="menu"><h3><img src="icons/stats.png" alt="."/> Detailed statistics</h3>';

echo'<li><a href="index.php?act=hosts">Hosts</a> ('.statistic::$hosty.')</li>
<li><a href="index.php?act=opsos">Providers</a> ('.$count_stat[4].')</li>
<li><a href="index.php?act=country">Countries</a> ('.$count_stat[3].')</li>
<li><a href="index.php?act=robots">Robots</a> ('.$count_stat[5].')</li>
<li><a href="index.php?act=users">Users</a> ('.$count_stat[6].')</li>
<li><a href="stat_search.php">Visits from search engines</a> ('.$count_stat[2].' | '.round($searchpercent, 2).'%)</li>
<li><a href="index.php?act=phones">Phones / Browsers</a></li>
<li><a href="index.php?act=os">Operating Systems (OS)</a></li>
<li><a href="index.php?act=referer">Where visitors come from</a> ('.$count_stat[7].')</li>';

echo'<li><a href="index.php?act=point_in">Entry pages</a></li>';
echo'<li><a href="index.php?act=pop">Most popular pages</a> ('.$count_stat[1].')</li>';
echo'<li><a href="http://www.cy-pr.com/analysis/'.$my_url['host'].'">SEO Site analysis</a></li>';
echo'<li><a href="index.php?act=allstat">Statistics by days</a></li></div>';

if ($rights >= 9)
echo'<div class="bmenu"><a href="ip_base.php?act=base">IP base management</a></div>';


echo'<div class="phdr">Module version: 6.3</div>';


require_once '../incfiles/end.php';
?>