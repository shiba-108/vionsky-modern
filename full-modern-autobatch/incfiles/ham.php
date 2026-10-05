<?php
$headmod = isset($headmod) ? mysql_real_escape_string($headmod) : '';
$textl = isset($textl) ? $textl : $set['copyright'];
$textl = html_entity_decode($textl, ENT_QUOTES,'UTF-8');
$textl = functions::tranrss($textl, 1, 1);
$statistic = new statistic($textl);
if (strlen($mota) < 5)
$mota = $set['meta_desc'];
$mota = htmlspecialchars($mota, ENT_QUOTES, 'UTF-8');
$mota = preg_replace('#\[img](.+?)\[/img]#si', '$2', $mota);
$mota = preg_replace('#\[code](.+?)\[/code]#si', '$2', $mota);
$mota = preg_replace('#\[url=(.+?)\](.+?)\[/url]#si', '$2', $mota);
$mota = preg_replace('#\[url](.+?)\[/url]#si', '$2', $mota);
$mota = functions::tranrss($mota, 1, 1);
$mota = bbcode::notags($mota);
$_SESSION["{$session_name}"] = time();
$time = time();
$operamini = $_SERVER["HTTP_X_OPERAMINI_PHONE_UA"];
if ($user_id) {
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
if(!$is_mobile || $iphone || $android || $palmpre || $ipod || $berry || $ipad == true) { 
if ($operamini) {
@$connect->query("UPDATE `users` SET `jquery` = '0' WHERE `id` = '".$user_id."'");
} else {
@$connect->query("UPDATE `users` SET `jquery` = '1' WHERE `id` = '".$user_id."'");
}
}
}
?>