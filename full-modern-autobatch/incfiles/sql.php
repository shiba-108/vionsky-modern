<?php
$sql = '';
$set_karma = unserialize($set['karma']);
if ($user_id) {
// Фиксируем местоположение авторизованных
if (!$datauser['karma_off'] && $set_karma['on'] && $datauser['karma_time'] <= (time() - 86400)) {
$sql .= " `karma_time` = '" . time() . "', ";
}
$movings = $datauser['movings'];
if ($datauser['lastdate'] < (time() - 300)) {
$movings = 0;
$sql .= " `sestime` = '" . time() . "', ";
}
if ($datauser['place'] != $noionline) {
++$movings;
$sql .= " `place` = '" . mysql_real_escape_string($noionline) . "', ";
}
if ($datauser['browser'] != $agn)
$sql .= " `browser` = '" . mysql_real_escape_string($agn) . "', ";
$totalonsite = $datauser['total_on_site'];
if ($datauser['lastdate'] > (time() - 300))
$totalonsite = $totalonsite + time() - $datauser['lastdate'];
$connect->query("UPDATE `users` SET $sql
`movings` = '$movings',
`total_on_site` = '$totalonsite',
`lastdate` = '" . time() . "'
WHERE `id` = '$user_id'
");
} else {
// Фиксируем местоположение гостей
$movings = 0;
$session = md5(core::$ip . core::$ip_via_proxy . core::$user_agent);
$req = $connect->query("SELECT * FROM `cms_sessions` WHERE `session_id` = '$session' LIMIT 1");
if ($req) { {
// Если есть в базе, то обновляем данные
$res = $connect->fetch_assoc($req);
$movings = ++$res['movings'];
if ($res['sestime'] < (time() - 300)) {
$movings = 1;
$sql .= " `sestime` = '" . time() . "', ";
}
if ($res['place'] != $noionline) {
$sql .= " `place` = '" . mysql_real_escape_string($noionline) . "', ";
}
$connect->query("UPDATE `cms_sessions` SET $sql
`movings` = '$movings',
`lastdate` = '" . time() . "'
WHERE `session_id` = '$session'
");
} else {
// Если еще небыло в базе, то добавляем запись
$connect->query("INSERT INTO `cms_sessions` SET
`session_id` = '" . $session . "',
`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`browser` = '" . mysql_real_escape_string($agn) . "',
`lastdate` = '" . time() . "',
`sestime` = '" . time() . "',
`place` = '" . mysql_real_escape_string($noionline) . "'
");
}
}
?>