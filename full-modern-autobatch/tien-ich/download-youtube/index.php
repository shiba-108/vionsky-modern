<?php
include'func.php';
$q=$_GET['q'];
if(!empty($q)){
$title=$q;}
else{$title='Free download videos';}
$textl = ''.$vina4u1.''.$vina4u.''.$q.' Tải Download Video Youtube';
include'config.php';
echo $head;
echo'<div class="main-xmenu">';
if(!empty($_GET['q'])){echo'<div class="danhmuc">Video Tìm Được</div>';}
else{
echo'<div class="danhmuc">Video Mới</div>';}
$qu=$q;
$qu=str_replace(" ","+", $qu);
$qu=str_replace("-","+", $qu);
$qu=str_replace("_","+", $qu); if(!empty($_GET['page'])){$noPage = $_GET['page'];
}
else{$noPage = 1;}
if($_GET['page'] > 1){$yesPage=1+(($_GET['page']-1)*5);}
else{$yesPage='1';}
$grab=ngegrab('https://gdata.youtube.com/feeds/api/videos?q='.$qu.'&max-results=5&v=2&alt=jsonc&start-index='.$yesPage.'');
$json = json_decode($grab);
$responada = $json->data->items;
$respon = $json->data->items->totalItems;
if (!empty($responada)) {$jumlah = $json->data->totalItems;
$jumlah=str_replace(',','',$jumlah);
foreach($json->data->items as $hasil) {$name = $hasil->title;
$ln=preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$name);
$ln=str_replace(' ','-',$ln);
$link = $hasil->id;
$duration = $hasil->duration;
$tgl = $hasil->uploaded;
$date = dateyt($tgl);
$rating = $hasil->duration;
$rate=substr($rating,0,1);
$durasi=format_time($duration);
echo '<div class="menu"><table width="500"><td class="file" align="center"><img src="http://img.youtube.com/vi/'.$link.'/default.jpg" alt="'.$name.'" width="70px" height="60px" /></td><td width="85%" class="file" align="left"><a href="/tien-ich/download-youtube/download/'.$link.'"><b>'.$name.'</b></a><br/>Thời gian phát:  '.$durasi.'<br /><img src="/tien-ich/download-youtube/'.$rate.'.0.gif" alt="" /></td></table></div>';}
if(!empty($jumlah)){$dataPerPage = 5;
$jumData = $jumlah;
$jumPage1 = ceil($jumData/$dataPerPage);
if($jumPage1>199){$jumPage='199';}else{$jumPage = ceil($jumData/$dataPerPage);}
echo'<div class="menu">';
if(!empty($_GET['q'])){$next='/tien-ich/download-youtube/?q='.$_GET['q'].'&page='.($noPage+1).'';
$prev='/tien-ich/download-youtube/?q='.$_GET['q'].'&page='.($noPage-1).'';}else{$next='/&page='.($noPage+1).'';
$prev='/tien-ich/download-youtube/?page='.($noPage-1).'';
$next='/tien-ich/download-youtube/?page='.($noPage+1).'';}
if ($noPage > 1) {echo'<a href="'.$prev.'" class="nb">&laquo; Trước</a> ';}
else{echo '&laquo; Trước ';}
if ($noPage < $jumPage) {echo'- <a href="'.$next.'" class="nb">Sau &raquo;</a>';}
else {echo '- Sau &raquo;';}
echo'</div>';
}}
if(!empty($_GET['q']) AND empty($_GET['page'])){$user_query = ''.$_GET['q'].'
';
write_to_file($user_query);}
echo'</div>';
require ('../../incfiles/end.php');

?>