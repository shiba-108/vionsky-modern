<?php

define('_IN_JOHNCMS', 1);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Content-type: application/xhtml+xml; charset=UTF-8");
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en'>
<head>
<meta http-equiv='content-type' content='application/xhtml+xml; charset=utf-8'/>";
echo "<title>Statistic module Install</title>
<style type='text/css'>
body { font-weight: normal; font-family: Century Gothic; font-size: 12px; color: #FFFFFF; background-color: #000033}
a:link { text-decoration: underline; color : #D3ECFF}
a:active { text-decoration: underline; color : #2F3528 }
a:visited { text-decoration: underline; color : #31F7D4}
a:hover { text-decoration: none; font-size: 12px; color : #E4F992 }
.red { color: #FF0000; font-weight: bold; }
.green{ color: #009933; font-weight: bold; }
.gray{ color: #FF0000; font: small; }
</style>
</head><body>";
echo '<big><b>Statistic module 6.3</b></big><br />Installing<hr />';

// Подключаемся к базе данных
require_once ("../incfiles/db.php");
$connect = mysql_connect($db_host, $db_user, $db_pass) or die('cannot connect to server</body></html>');
mysql_select_db($db_name) or die('cannot connect to db');
$connect->query("SET NAMES 'utf8'", $connect);

$do = isset($_GET['do']) ? $_GET['do'] : '';
switch ($do)
{
    case 'step1':
        echo '<b><u>Preparing tables</u></b><br />';
        // Таблица
        $connect->query("DROP TABLE `counter`;");
		$connect->query("CREATE TABLE IF NOT EXISTS `counter` (
  `date` int(11) NOT NULL,
  `browser` text NOT NULL,
  `robot` text NOT NULL,
  `robot_type` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ip_via_proxy` varchar(15) NOT NULL,
  `ref` text NOT NULL,
  `host` int(11) NOT NULL,
  `hits` int(11) NOT NULL AUTO_INCREMENT,
  `site` text NOT NULL,
  `pop` text NOT NULL,
  `head` text NOT NULL,
  `operator` text NOT NULL,
  `country` text NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hits`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
        echo '<span class="green">OK</span> counter table is created<br />';
         $connect->query("DROP TABLE `countersall`;");

		$connect->query("CREATE TABLE `countersall`(
		`date` int(11) NOT NULL,
		`hits` int(11) NOT NULL,
		`host` int(11) NOT NULL,
		`yandex` int(11) NOT NULL,
		`rambler` int(11) NOT NULL,
		`google` int(11) NOT NULL,
		`mail` int(11) NOT NULL,
		`gogo` int(11) NOT NULL,
		`yahoo` int(11) NOT NULL,
		`bing` int(11) NOT NULL,
		`nigma` int(11) NOT NULL,
		`qip` int(11) NOT NULL,
		`aport` int(11) NOT NULL
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
        $connect->query("DROP TABLE `stat_robots`;");
        $connect->query("CREATE TABLE IF NOT EXISTS `stat_robots` (
  `engine` text NOT NULL,
  `date` int(11) NOT NULL,
  `url` text NOT NULL,
  `query` text NOT NULL,
  `ua` text NOT NULL,
  `ip` bigint(11) NOT NULL,
  `count` int(11) NOT NULL,
  `today` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$connect->query("ALTER TABLE `counter` ADD `user` INT( 11 ) NOT NULL DEFAULT '0'");

$connect->query("CREATE TABLE IF NOT EXISTS `counter_ip_base` (
  `id` int(11) NOT NULL auto_increment,
  `start` bigint(11) NOT NULL,
  `stop` bigint(11) NOT NULL,
  `operator` text NOT NULL,
  `country` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=212 ;");

$connect->query("INSERT INTO `counter_ip_base` (`id`, `start`, `stop`, `operator`, `country`) VALUES
(1, -646561792, -646560769, 'Beeline', 'Russia'),
(2, 1494507776, 1494508031, 'Utel', 'Russia'),
(3, 1601019392, 1601019647, 'UMC', 'Ukraine'),
(4, 1578729472, 1578745855, 'PC', 'Russia'),
(5, 1360162816, 1360164350, 'BWC', 'Russia'),
(6, -1016011816, -1016011781, 'ЕТК', 'Russia'),
(7, 1588723712, 1588854783, 'Utel', 'Ukraine'),
(8, 1427813376, 1427814399, 'Megafon', 'Russia'),
(9, -1041268736, -1041268225, 'life:)', 'Ukraine'),
(10, 1427809280, 1427810303, 'Megafon', 'Russia'),
(11, 1427812352, 1427813375, 'Megafon', 'Russia'),
(12, 1402278912, 1402279935, 'Megafon', 'Russia'),
(13, 1536099328, 1536099839, 'SMARTS', 'Russia'),
(14, 1295298720, 1295298751, 'PC', 'Ukraine'),
(15, 1333559296, 1333575679, 'life:)', 'Ukraine'),
(16, 1402275840, 1402276863, 'Megafon', 'Russia'),
(17, -730603520, -730603009, 'life:)', 'Ukraine'),
(18, -1037271040, -1037270785, 'PC', 'Ukraine'),
(19, -649949184, -649948161, 'MTS', 'Russia'),
(20, -649398016, -649397761, 'MTS', 'Russia'),
(21, 1588920320, 1588932607, 'PC', 'Russia'),
(22, 1295269888, 1295286271, 'MTS', 'Ukraine'),
(23, 1602486272, 1602551807, 'PC', 'Ukraine'),
(24, 1536278528, 1536286719, 'life:)', 'Ukraine'),
(25, 1333575680, 1333592063, 'life:)', 'Ukraine'),
(26, 1486487552, 1486553087, 'life:)', 'Ukraine'),
(27, -1139802112, -1139539969, 'Utel', 'Russia'),
(28, 1310210048, 1310211071, 'SMARTS', 'Russia'),
(29, -730071040, -730066945, 'PC', 'Russia'),
(30, -734353408, -734351361, 'life:)', 'Ukraine'),
(31, 1402279936, 1402280959, 'Megafon', 'Russia'),
(32, 1519796224, 1519800319, 'Utel', 'Russia'),
(33, -646557696, -646556673, 'Beeline', 'Russia'),
(34, 1596293120, 1596325887, 'MTS', 'Russia'),
(35, 1347538944, 1347543039, 'PC', 'Russia'),
(36, 1518993408, 1519058943, 'TELE2', 'Russia'),
(37, 1519321088, 1519386623, 'PC', 'Russia'),
(38, -730284440, -730284433, 'PC', 'Russia'),
(39, -715698176, -715694081, 'MTS', 'Russia'),
(40, 1402273792, 1402275839, 'Megafon', 'Russia'),
(41, 1410269184, 1410334719, 'BITE', 'Lithuania'),
(42, 1441411072, 1441415167, 'PC', 'Russia'),
(43, 1572081664, 1572083711, 'PC', 'Russia'),
(44, -653729792, -653726721, 'MTS', 'Russia'),
(45, 1536286720, 1536294911, 'life:)', 'Ukraine'),
(46, 1336176640, 1336180735, 'PC', 'Russia'),
(47, -649397504, -649397249, 'MTS', 'Russia'),
(48, 1505595392, 1505599487, 'PC', 'Russia'),
(49, 1402284032, 1402285055, 'Megafon', 'Russia'),
(50, 1579745280, 1579778047, 'PC', 'Russia'),
(51, 1294467072, 1294499839, 'PC', 'Russia'),
(52, 1550958592, 1550974975, 'PC', 'Ukraine'),
(53, 1467375616, 1467383807, 'PC', 'Germany'),
(54, 1402277888, 1402278911, 'Megafon', 'Russia'),
(55, 1402281984, 1402283007, 'Megafon', 'Russia'),
(56, 1402286080, 1402287103, 'Megafon', 'Russia'),
(57, 1402287104, 1402288127, 'Megafon', 'Russia'),
(58, -1043733504, -1043732481, 'Megafon', 'Russia'),
(59, -712935520, -712935489, 'PC', 'Russia'),
(60, 1346621440, 1346622463, 'PC', 'Russia'),
(61, 1433657344, 1433657599, 'Beeline', 'Russia'),
(62, -646560768, -646559745, 'Beeline', 'Russia'),
(63, -646558720, -646557697, 'Beeline', 'Russia'),
(64, -646556672, -646555649, 'Beeline', 'Russia'),
(65, -646555648, -646554625, 'Beeline', 'Russia'),
(66, -646554624, -646553601, 'Beeline', 'Russia'),
(67, 1047070464, 1047072255, 'Utel', 'Russia'),
(68, 1401450496, 1401450751, 'Utel', 'Russia'),
(69, 1401451520, 1401451647, 'Utel', 'Russia'),
(70, 1425981440, 1425981695, 'Utel', 'Russia'),
(71, 1441366016, 1441371903, 'Utel', 'Russia'),
(72, -1022602752, -1022602497, 'Utel', 'Russia'),
(73, -730292224, -730291713, 'Utel', 'Russia'),
(74, -730290464, -730290433, 'Utel', 'Russia'),
(75, -723779584, -723775489, 'Utel', 'Russia'),
(76, -653151232, -653150977, 'Utel', 'Russia'),
(77, -653150720, -653150465, 'Utel', 'Russia'),
(78, 1519779840, 1519783935, 'Utel', 'Russia'),
(79, 1347592192, 1347600383, 'BWC', 'Russia'),
(80, -706447360, -706446337, 'BWC', 'Russia'),
(81, -1020368128, -1020367873, 'BWC', 'Russia'),
(82, 1042394624, 1042394879, 'MTS', 'Russia'),
(83, 1346950400, 1346950655, 'MTS', 'Russia'),
(84, 1347674112, 1347674623, 'MTS', 'Russia'),
(85, 1360933376, 1360933887, 'MTS', 'Russia'),
(86, 1372794624, 1372794879, 'MTS', 'Russia'),
(87, 1410457600, 1410459647, 'MTS', 'Russia'),
(88, -1036610560, -1036609537, 'MTS', 'Russia'),
(89, -1017778688, -1017778433, 'MTS', 'Russia'),
(90, -1018539008, -1018538753, 'MTS', 'Russia'),
(91, -1013514240, -1013513985, 'MTS', 'Russia'),
(92, -1007707904, -1007707649, 'MTS', 'Russia'),
(93, -735278080, -735277825, 'MTS', 'Russia'),
(94, -732132608, -732132417, 'MTS', 'Russia'),
(95, -732132416, -732132353, 'MTS', 'Russia'),
(96, -716135424, -716135169, 'MTS', 'Russia'),
(97, -715707904, -715701761, 'MTS', 'Russia'),
(98, -715700224, -715699361, 'MTS', 'Russia'),
(99, -649400320, -649398273, 'MTS', 'Russia'),
(100, -646488576, -646488065, 'MTS', 'Russia'),
(101, 1535627776, 1535628031, 'MTS', 'Russia'),
(102, -715699200, -715698689, 'MTS', 'Russia'),
(103, 1404862464, 1404870655, 'TELE2', 'Russia'),
(104, 1404846080, 1404854271, 'TELE2', 'Russia'),
(105, 1404854272, 1404862463, 'TELE2', 'Russia'),
(106, 1404837888, 1404846079, 'TELE2', 'Russia'),
(107, 1404829696, 1404837887, 'TELE2', 'Russia'),
(108, 1518927872, 1518944255, 'TELE2', 'Russia'),
(109, -2097938432, -2097872897, 'TELE2', 'Sweden'),
(110, -644598784, -644598529, 'Motiv', 'Russia'),
(111, -644599808, -644599553, 'Motiv', 'Russia'),
(112, -1016011008, -1016010753, 'ЕТК', 'Russia'),
(113, -1016007168, -1016006913, 'ЕТК', 'Russia'),
(114, 1389383040, 1389383167, 'НСС', 'Russia'),
(115, 1432330240, 1432334335, 'НСС', 'Russia'),
(116, -1012795392, -1012793345, 'НСС', 'Russia'),
(117, -709795840, -709793025, 'НСС', 'Russia'),
(118, -1027958784, -1027958529, 'НСС', 'Russia'),
(119, -1016974848, -1016974337, 'НСС', 'Russia'),
(120, 1441609984, 1441610239, 'НСС', 'Russia'),
(121, 1346736128, 1346737151, 'SMARTS', 'Russia'),
(122, -1034680960, -1034680833, 'SMARTS', 'Russia'),
(123, -649236224, -649236217, 'SMARTS', 'Russia'),
(124, -707747840, -707747585, 'SMARTS', 'Russia'),
(125, -646672384, -646671361, 'STEK GSM', 'Russia'),
(126, 1481787392, 1481787647, 'Tatincom-T', 'Russia'),
(127, -642969600, -642965505, 'Tatincom-T', 'Russia'),
(128, 1506762752, 1506763007, 'Tatincom-T', 'Russia'),
(129, 1052193280, 1052193535, 'MTT', 'Russia'),
(130, 1347125248, 1347125759, 'MTT', 'Russia'),
(131, 1347125248, 1347129343, 'MTT', 'Russia'),
(132, 1358118912, 1358119423, 'НТК', 'Russia'),
(133, 1358119424, 1358120703, 'НТК', 'Russia'),
(134, 1406740480, 1406746623, 'Sky Link', 'Russia'),
(135, -730374144, -730373377, 'Sky Link', 'Russia'),
(136, -730371328, -730370561, 'Sky Link', 'Russia'),
(137, -730367488, -730365953, 'Sky Link', 'Russia'),
(138, -729718784, -729717249, 'Sky Link', 'Russia'),
(139, -729717248, -729716737, 'Sky Link', 'Russia'),
(140, -729716736, -729712641, 'Sky Link', 'Russia'),
(141, -716144640, -716111873, 'Sky Link', 'Russia'),
(142, -646754304, -646754049, 'Sky Link', 'Russia'),
(143, 1509752832, 1509756927, 'Sky Link', 'Russia'),
(144, 1386348544, 1386349567, 'PC', 'Russia'),
(145, -1054262272, -1054261249, 'Kievstar', 'Ukraine'),
(146, -734354944, -734354433, 'Kievstar', 'Ukraine'),
(147, -734354432, -734353409, 'Kievstar', 'Ukraine'),
(148, 1360467968, 1360470015, 'Kievstar', 'Ukraine'),
(149, 1360465920, 1360467967, 'Kievstar', 'Ukraine'),
(150, -734351360, -734347265, 'life:)', 'Ukraine'),
(151, -734355456, -734355201, 'life:)', 'Ukraine'),
(152, 1295253504, 1295269887, 'UMC', 'Ukraine'),
(153, 1358905344, 1358905471, 'UMC', 'Ukraine'),
(154, 1358907392, 1358907519, 'UMC', 'Ukraine'),
(155, 1358907648, 1358907775, 'UMC', 'Ukraine'),
(156, 1358907904, 1358908031, 'UMC', 'Ukraine'),
(157, 1358908160, 1358908239, 'UMC', 'Ukraine'),
(158, 1358908416, 1358908431, 'UMC', 'Ukraine'),
(159, 1358908928, 1358909439, 'UMC', 'Ukraine'),
(160, 1490436096, 1490444287, 'UMC', 'Ukraine'),
(161, 1490444288, 1490452479, 'UMC', 'Ukraine'),
(162, -1010987520, -1010987009, 'Opera-Mini', 'Norway'),
(163, 1403965440, 1403967487, 'PC', 'Russia'),
(164, -649397760, -649397505, 'MTS', 'Russia'),
(165, -1036908288, -1036908033, 'PC', 'Ukraine'),
(166, 1593212416, 1593212927, 'Opera-Mini', 'Norway'),
(167, 1317601280, 1317609471, 'PC', 'Ukraine'),
(168, 1570762752, 1570763775, 'PC', 'Russia'),
(169, 1360164352, 1360166910, 'BWC', 'Russia'),
(170, 1536521728, 1536521983, 'PC', 'Russia'),
(171, 1347677184, 1347678207, 'MTS', 'Russia'),
(172, -733229056, -733224961, 'Good Line', 'Russia'),
(173, -733233152, -733229057, 'PC', 'Russia'),
(174, -712548352, -712545901, 'PC', 'Russia'),
(175, -1019551744, -1019543553, 'PC', 'Ukraine'),
(176, 1602486272, 1602748415, 'PC', 'Ukraine'),
(177, 1572192256, 1572200447, 'PC', 'Russia'),
(178, 1572087808, 1572089855, 'PC', 'Russia'),
(179, 1467285504, 1467286527, 'PC', 'Russia'),
(180, 1568178176, 1568194559, 'PC', 'Russia'),
(181, 1466826752, 1466859519, 'TELE2', 'Latvia'),
(182, 1365222400, 1365223423, 'GE-MAGTICOM', 'Georgia'),
(183, 1540055040, 1540056063, 'Opera-Mini', 'Norway'),
(184, 1587085312, 1587150847, 'Kievstar', 'Ukraine'),
(185, 1595408384, 1595932671, 'PC', 'Russia'),
(186, 1592803328, 1592811519, 'PC', 'Russia'),
(187, 1475812368, 1475812371, 'PC', 'Kazakhstan'),
(188, 1592811520, 1592815615, 'НСС', 'Russia'),
(189, 1519058944, 1519124479, 'TELE2', 'Russia'),
(190, 1346623232, 1346625535, 'НТК', 'Russia'),
(191, -1016005120, -1016004865, 'PC', 'Russia'),
(192, 1437532160, 1437597695, 'PC', 'Russia'),
(193, 1550867968, 1550868223, 'PC', 'Ukraine'),
(194, -1020264704, -1020264449, 'KCELL', 'Kazakhstan'),
(195, 1297055744, 1297063935, 'PC', 'Russia'),
(196, 1360941312, 1360941567, 'PC', 'Belarus'),
(197, 1550942208, 1550958591, 'PC', 'Ukraine'),
(198, 1042368000, 1042368127, 'PC', 'Russia'),
(199, 1307182080, 1307185151, 'PC', 'Russia'),
(200, 1334149120, 1334153215, 'PC', 'Russia'),
(201, 1357411584, 1357411839, 'PC', 'Norway'),
(202, 1298948736, 1298948799, 'PC', 'Russia'),
(203, 1578948608, 1578950655, 'PC', 'Russia'),
(204, 1495015424, 1495017471, 'PC', 'Moldavia'),
(205, 1053675520, 1053679615, 'PC', 'Latvia'),
(206, 1406855168, 1406856191, 'PC', 'Ukraine'),
(207, -644471296, -644471041, 'PC', 'Russia'),
(208, 1505605632, 1505607679, 'PC', 'Russia'),
(209, 1539824896, 1539825151, 'PC', 'Uzbekistan'),
(210, 1306433280, 1306433535, 'PC', 'Ukraine'),
(211, 2130706433, 2130706433, 'Localhost', 'Local server'),
(212, 3648409600, 3648410623, 'Beeline', 'Russia'),
(213, 3239825408, 3239825919, 'Undefined', 'Ukraine'),
(214, 3253698560, 3253699071, 'Beeline', 'Ukraine'),
(215, 3273026560, 3273027583, 'MTS', 'Russia'),
(216, 1582137344, 1582139391, 'ЦТС Интернет', 'Russia'),
(217, 3645018112, 3645019135, 'MTS', 'Russia'),
(218, 1519124480, 1519190015, 'TELE2', 'Russia'),
(219, 1404870656, 1404872703, 'TELE2', 'Latvia'),
(220, 3261777408, 3261777919, 'KCELL', 'Kazakhstan'),
(221, 1603907584, 1603911679, 'MTS', 'Russia'),
(222, 1402275840, 1402276863, 'Megafon', 'Russia'),
(223, 1599307776, 1599315967, 'SPARK', 'Russia'),
(224, 1601011712, 1601036287, 'MTS', 'Ukraine'),
(225, 3648411648, 3648412671, 'Beeline', 'Russia'),
(226, 1402285056, 1402286079, 'Megafon', 'Russia'),
(227, 1402280960, 1402281983, 'Megafon', 'Russia'),
(228, -1033189888, -1033189377, 'KCELL', 'Kazakhstan'),
(229, 1839349760, 1839366143, 'Kievstar', 'Ukraine'),
(230, 1407035392, 1407036415, 'Sharq Telekom', 'Uzbekistan'),
(231, 1357902336, 1357902847, 'Opera-Mini', 'Undefined'),
(232, -1299906560, -1299890177, 'MTS', 'Ukraine'),
(233, -1299857408, -1299849217, 'MTS', 'Ukraine'),
(234, -1299881984, -1299873793, 'MTS', 'Ukraine'),
(235, -1299873792, -1299857409, 'MTS', 'Ukraine'),
(236, -1055797248, -1055796993, 'Norma-Plus', 'Ukraine'),
(237, 1427814400, 1427815423, 'Megafon', 'Russia'),
(238, 1603903488, 1603907583, 'MTS', 'Russia'),
(239, 1306001408, 1306132479, 'TELE2', 'Russia'),
(240, 1402283008, 1402284031, 'Megafon', 'Russia'),
(241, 1123631104, 1123639295, 'Google Bot', 'BotLand'),
(242, 1311641561, 1311641561, 'SymbOS Monitoring', 'BotLand'),
(243, -1297580032, -1297563649, 'MTS', 'Belorus'),
(244, 1518665728, 1518698495, 'TELE2', 'Russia'),
(245, 1600975872, 1600976127, 'Yandex Bot', 'BotLand'),
(246, 1427826688, 1427828735, 'Megafon', 'Russia'),
(247, 38273024, 38535167, 'KCELL', 'Kazakhstan'),
(248, 1600952064, 1600952319, 'YandexBOT', 'BotLand'),
(249, 1600977152, 1600977407, 'YandexBOT', 'BotLand'),
(250, 1297619968, 1297620223, 'YandexBOT', 'BotLand'),
(251, 1373519872, 1373520383, 'RamblerBOT', 'BotLand'),
(252, -1299644416, -1299611649, 'Kievstar', 'Ukraine'),
(253, 1427823616, 1427824639, 'Megafon', 'Кыргызстан'),
(254, 1441570816, 1441571327, 'PC', 'Russia'),
(255, 1296704512, 1296705535, 'Velcom', 'Belorus'),
(256, -1303584768, -1303582721, 'SPARK', 'Russia'),
(257, 3582611456, 3582615551, 'SPARK', 'Russia'),
(258, -1303969792, -1303904257, 'North-West Telecom', 'Russia'),
(259, 1136852992, 1136918527, 'YahooBOT', 'BotLand'),
(260, 1427806208, 1427807231, 'Megafon', 'Russia'),
(261, -1302593536, -1302528001, 'Ukrtelecom', 'Ukraine'),
(262, -1305526272, -1305518081, 'Уралсвязьинформ', 'Russia'),
(263, -819068928, -819003393, 'BingBOT', 'BotLand'),
(264, 1427826688, 1427828735, 'Megafon', 'Russia');");

        echo '<span class="green">OK</span> countersall table successfully created<br />';

        echo '<hr /><a href="install.php?do=final">Continue</a>';
        break;

    case 'final':
        echo '<b><span class="green">Congratulations!</span></b><br />The installation procedure was successful finished.<br />Do not forget to delete update.php and install.php files';
        echo '<hr /><a href="../../index.php">To the site</a>';
        break;

    default:
        echo '<p><big><span class="red">WARNING!</span></big><ul>';
        echo '<li>Before starting the installation procedure, make sure you did the database back up. If the installation will not finished succesful for some reason, you will have to restore the database from backup.</li>';
        echo '<li>If you click the "Continue" link, canceling will not be possible without restoring from a backup.</li>';
        echo '<li></li>';
        echo '</ul></p>';
        echo '<hr />Are you sure?<br /><a href="install.php?do=step1">Continue</a>';
}

echo '</body>
</html>';

?>