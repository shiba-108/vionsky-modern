<?php
$time = time();
if($user_id){
include 'str.php';
$post = ($connect->query("select count(*) from `fermer_gr` WHERE  `id_user` = '{$user_id}'  LIMIT 1")->fetch_row()[0] ?? 0);
if($post<5){
$connect->query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
$connect->query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
$connect->query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
$connect->query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
$connect->query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
}
}
?>