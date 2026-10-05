<? 
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../incfiles/core.php');
@set_time_limit(6000);
if($rights < 9) {
echo'Accecss define';
exit;
}

function cat_trang ($data){
if(preg_match ('#<a\sclass=\"page\"#',$data)){
preg_match_all ('#<a\sclass=\"page\"(.+?)\">([0-9]+)</a>#',$data,$page);
return max($page[2]);
}else{
return '1';
}
}
function kiemtra($title){
if($connect->query("SELECT * FROM ...")$connect->query("SELECT `text`,`type` FROM `forum` WHERE `text` = '" . mysql_real_escape_string ($title) . "' AND `type` = 't'" )) == 0){
return true;
}else{
return false;
}
}
// đây là mấy hàm tách ký tự ý mà
function del($content){
$nd = array("<div class=\"left\">" => "", "<div class=\"content\">" => "", "<p>" => "", "<b>" => "", "<center>" => "", "</span>" => "", "<o:p></o:p>" => "", "<?xml:namespace prefix = o ns = \"urn:schemas-microsoft-com:office:office\" />" => "", "<SPAN Roman?? Times New>" => "", "<SPAN style=\"FONT-STYLE: italic\">" => "", "</b>" => "", "</div>" => "", "<div>" => "");
$content = str_ireplace(array_keys($nd), array_values($nd), $content);
return $content;
}
function del2($content){
$nd = array("/\<div(.*?)\>/is" => "", "/\<span(.*?)\>/is" => "");
$content = preg_replace(array_keys($nd), array_values($nd), $content);
return $content;
}
function del_link($content){
$content = preg_replace('/\'/i', '<img src="$2"/>', $content);
$content = preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)\/>/i', ' ', $content);
$content = preg_replace('/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i', ' ', $content);
return $content;
}
function delhtml($content){
$nd = array("/\<em\>(.*?)\<\/em\>/is" => "$1", "/\<b\>(.*?)\<\/b\>/is" => "$1",
"/\<i\>(.*?)\<\/i\>/is" => "$1",
"/\<u\>(.*?)\<\/u\>/is" => "$1",
"/\<s\>(.*?)\<\/s\>/is" => "$1",
"/\<h3\>(.*?)\<\/h3\>/is" => "",
"/\<br \/\>
\<br \/\>/is" => "\n",
"/\<center\>(.*?)\<\/center\>/is" => "$1", "/\<h2\>(.*?)\<\/h2\>/is" => "$1", "/\<p\>(.*?)\<\/p\>/is" => "$1", "/\<ul\>(.*?)\<\/ul\>/is" => "$1", "/\<li\>(.*?)\<\/li\>/is" => "$1", "/\<div class=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<div align=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<span style=(.*?)\>(.*?)\<\/span\>/is" => "$2", "/\<span class=(.*?)\>(.*?)\<\/span\>/is" => "$2", "/\<I class=(.*?)\>(.*?)\<\/I\>/is" => "$2", "/\<I style=(.*?)\>(.*?)\<\/I\>/is" => "$2", "/\<strong\>(.*?)\<\/strong\>/is" => "$1", "/\<br class=(.*?)\>/is" => "", "/\<z (.*?)\>/is" => "", "/\<em\>(.*?)\<\/em\>/is" => "$1", "/\<font size=(.*?)\>(.*?)\<\/font\>/is" => "$2", "/\<div style=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<font(.*?)\>(.*?)\<\/font\>/is" => "$2", "/\<td(.*?)\>(.*?)\<\/td\>/is" => "$2", "/\<tr(.*?)\>(.*?)\<\/tr\>/is" => "$2", "/\<p(.*?)\>(.*?)\<\/p\>/is" => "$2", "/\<a href=(.*?)\>Tải ảnh về máy\<\/a\>/is" => "");

$content = preg_replace(array_keys($nd), array_values($nd), $content);
$text = preg_replace('/TraSua.Mobi/i', 'wapxiteen.net', $text);
$var = preg_replace('#\TraSua.(.*?)\Mobi#si', 'wapxiteen.net', $var); 
return $content;
}
	
	
	 function get_content($noidung, $start, $stop) {
        $bd = strpos($noidung, $start);
        $kt = strpos(substr($noidung, $bd), $stop) + $bd;
        $content = substr($noidung, $bd, $kt - $bd);
        return $content;
    }
$refid= $_POST['idd'];
echo '<form action ="" method="post"><br>Nhập link chuyên mục (không nhập link bài viết): <br/><input type="text" name="url" value="" size="20"/>';
echo'<li>Thể loại: </li><select name="idd">';
$req = $connect->query("SELECT * FROM `forum` WHERE `type` = 'r' ORDER BY `realid` ASC");
while ($res = $connect->fetch_assoc($req)) {
echo '<option value="'.$res['id'].'">'.$res['text'].'</option>';
}
echo '</select>';
echo '<br/><input type="submit" value="Leech"></form>';
if (isset($_POST['url'])){
$url=trim($_POST['url']);
$header=array();
    $header[] = "Accept: text/xml,application/xml,application/xhtml+xml,";
    $header[] = "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
    $header[] = "Cache-Control: max-age=0";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";
    $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $header[] = "Accept-Language: en-us,en;q=0.5";
    $header[] = "Pragma: ";
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_USERAGENT, "NokiaN73-2/3.0-630.0.2 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1");
    curl_setopt ($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curl, CURLOPT_ENCODING, "");
	curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_REFERER, $url);
    $content= curl_exec ($curl);

///// bắt đầu xử lý tại đây
preg_match_all("/<td><a href=\"(.*?)\" title=\"(.*?)\">(.*?)<\/a>/is",$content,$link); //cái này để lấy link từng bài viết trong 1 chuyên mục
$linktungbaiviet=$link[1];
$tentungbaiviet=$link[3];
foreach($linktungbaiviet as $sothutu=>$linkbaiviet){
$ten=$tentungbaiviet[$sothutu];
curl_setopt ($curl, CURLOPT_URL,'http://trasua.mobi'.$linkbaiviet);
$data= curl_exec ($curl);
$trang=cat_trang($data);
$start = '</font></div><div class="menu">';
$end = '<div class="top">';
$nd=get_content($data);
if($trang>1){
for($i=1;$i<=$trang;$i++){
curl_setopt ($curl, CURLOPT_URL, 'http://trasua.mobi'.$linkbaiviet.'?page='.$i);
$linkk= curl_exec ($curl);
$start = '</font></div><div class="menu">';
$end = '<div class="top">';
$nd = $nd.get_content($linkk, $start, $end);
$nd = str_replace('</font></div><div class="menu">', '', $nd);
$nd = str_replace('<div class="bmenu">(.*?)<\div>', '', $nd);
}
}
else
{
curl_setopt ($curl, CURLOPT_URL, 'http://trasua.mobi'.$linkbaiviet.'?page=1');
$linkk= curl_exec ($curl);
$start = '</font></div><div class="menu">';
$end = '</div><div class="menu">Tags:';
$nd = get_content($linkk, $start, $end);
$nd = str_replace('</font></div><div class="menu">', '', $nd);
$nd = str_replace('<div class="bmenu">(.*?)<\div>', '', $nd);
}
$nd = del(del2(delhtml($nd)));
$nd=del_link($nd);
$nd=str_replace('trasua.mobi','wapxiteen.net',$nd);
$nd = preg_replace('/<br(.*?)\/>/i', ' ', $nd);
$nd = preg_replace('/<img(.*?)src="(.*?)"(.*?)\/>/i', '[img]$2[/img]', $nd);
$nd = str_replace('<br /><br /> <br /><br />','',$nd);
$nd = html_entity_decode($nd, ENT_QUOTES, 'UTF-8');
if(kiemtra($ten) == true)
{
$connect->query("INSERT INTO `blog` SET
`time` = '" . time() . "',
`tieude` = '".$ten."',
`noidung` = '". mysql_real_escape_string($nd) ."'
");
header('Location: /blog/');
} else {
header('Location: /blog/');
}
}
}
?>