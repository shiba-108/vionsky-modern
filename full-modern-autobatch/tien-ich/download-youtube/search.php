<?php include'func.php';
if(!empty($_GET['q'])){
$url='/tien-ich/download-youtube/?q='.preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$_GET['q']).'';
} else{
$url='/';
}
header('location:'.$url.''); ?>