<?php 
include'func.php'; 
$yf=ngegrab('https://gdata.youtube.com/feeds/api/videos/'.$_GET['id'].'?v=2&alt=jsonc');
$yf=json_decode($yf);
$respon=$yf->data;
$name=$yf->data->title;
$durasi=$yf->data->duration;
$duration= format_time($durasi);
$stream=$yf->data->content->{'5'};
$streamm=$yf->data->content->{'1'};
$streammm=$yf->data->content->{'6'};
$tgl=$yf->data->uploaded;
$date=dateyt($tgl);
$file=ngegrab('http://www.fullrip.net/video-m/'.$_GET['id'].'');
$file=potong($file,'<div class="video_links">','<div id="dloptions">');
$file=str_replace('</div>','',$file);
$file=str_replace('</span>','',$file);
$file=str_replace('<a ','Định dạng: <a ',$file);
if(!empty($respon) AND !empty($_GET['id'])){$title='Download '.$name.'';
$textl = $name;
include'config.php';
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">'.$name.'</div>';
echo'<div class="menu">';
if (!$is_mobile){
echo'<iframe width="600" height="350" src="http://www.youtube.com/embed/'.$_GET['id'].'?rel=0&showinfo=0&vq=large&iv_load_policy=3&modestbranding=1&nologo=1" frameborder="0" allowfullscreen="1"></iframe>';
} else {
echo'<img src="http://img.youtube.com/vi/'.$_GET['id'].'/default.jpg" />';
}
echo'</div>';
echo'<div class="menu">Tải lên lúc: '.$date.', <br />Thời gian Video: '.$duration.'</div>';
if ($is_mobile){
echo'<div class="menu">Xem online: <a href="'.$streamm.'"><b>Chất lượng cao</b></a> - <a href="'.$streammm.'"><b>Chất lượng thấp</b></a></div>';
}
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tải Video</div>';
if (preg_match('/fullrip.net/', $file)){
echo '<div class="menu">'.$file.'</div>';
}else{
echo'<div class="menu">Please wait...</div>';}
}else{
$title='Download';
$textl = $name;
include'config.php';
echo '<div class="danhmuc">Lỗi tải về</div>';
echo'<div class="menu">Video không tồn tại</div>';}
echo'</div>';
require ('../../incfiles/end.php');
?>