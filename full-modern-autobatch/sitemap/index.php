<?php


define('_IN_JOHNCMS', 1);

$headmod = 'sitemap cộng đồng';

require('../incfiles/core.php');

require('../incfiles/head.php');

$xml_th = fopen("../sitemap.xml", "w+");

$header_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

$header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

fwrite($xml_th, $header_xml);

///////////////////

$req_th = $connect->query("SELECT * FROM `forum` WHERE `type`='t' ORDER BY `time` DESC");
if (!$req_th)
die("Không thể đọc data");	
while ($baiviet = $connect->fetch_array($req_th)) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
if ($baiviet[groups] == 0) {
fwrite($xml_th, "<url>\n<loc>".$set["homeurl"]."/users/forum/".$baiviet["id"]."</loc>\n<lastmod>".date("Y-m-d",$baiviet["time"])."</lastmod>\n<changefreq>daily</changefreq>\n<priority>1.0</priority>\n</url>\n");
} else {
fwrite($xml_th, "<url>\n<loc>".$set["homeurl"]."/groups/".$baiviet["groups"]."/forum/".$baiviet["id"]."</loc>\n<lastmod>".date("Y-m-d",$baiviet["time"])."</lastmod>\n<changefreq>daily</changefreq>\n<priority>1.0</priority>\n</url>\n");
}
}


//////////////

   

$footer_xml = "</urlset>";
fwrite($xml_th,$footer_xml);
fclose($xml_f);
fclose($xml_index);

header('Location: /sitemap.xml');

require('../incfiles/end.php');

?>