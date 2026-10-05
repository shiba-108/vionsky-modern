<?php
$load = sys_getloadavg();
$limit = 15000;
if ($load[0] >= $limit) {header('location: /index.php');

}
function ngegrab($url){$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$header[] = "Accept-Language: en";
$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3
";
$header[] = "Pragma: no-cache";
$header[] = "Cache-Control: no-cache";
$header[] = "Accept-Encoding: gzip,deflate";
$header[] = "Content-Encoding: gzip";
$header[] = "Content-Encoding: deflate";
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$load = curl_exec($ch);
curl_close($ch);
return $load;}
function potong($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];}
return '';}}
function format_time($t,$f=':') {if($t < 3600){
return sprintf("%02d%s%02d", floor($t/60)%60, $f, $t%60);}else{return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);}}
function write_to_file($q)
{$filename = 'sitemap.dat';
$fh = fopen($filename, "a");
if(flock($fh, LOCK_EX))
{fwrite($fh, $q);
flock($fh, LOCK_UN);}
fclose($fh);}
function dateyt($date){$date=substr($date,0,10); $date=explode('-',$date);
$mn=date('F',mktime(0,0,0,$date[1])); $dates=''.$date[2].' '.$mn.' '.$date[0].''; return $dates;}
?>
