<?php

if(isset($_POST['gieohat'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
$post = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."'  LIMIT 1")); 
if(isset($_POST['sadit']) && $user_id==$post['id_user']) {
$res = $connect->fetch_array($connect->query("select * from `fermer_hatgiong` WHERE `id` = '$_POST[sadit]' ")); 
$semen = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE `id` = '$res[semen]' "));
$t = $time+$semen['time'];
if ($res[kol] > 0) {
$connect->query("UPDATE `fermer_gr` SET `semen` = $res[semen] WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = '$t' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time_thuhoach` = '$t' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time_ki` = '$time' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'1' WHERE `id` = $_POST[sadit] LIMIT 1");
}
header("Location: /farm/");
}
}
}

if(isset($_POST['tuoinuoc'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
$connect->query("UPDATE `fermer_gr` SET `woter` = '1' WHERE `id` = '".intval($delid)."' LIMIT 1");
header("Location: /farm/");
}
}

if(isset($_POST['thuhoach'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
$post = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."' LIMIT 1")); 
$semen = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
$postauto = $connect->fetch_array($connect->query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."' LIMIT 1")); 
if($time>$postauto['time']){
$dohod = $postauto['kol']*$semen['dohod'];
$connect->query("INSERT INTO `fermer_vor` (`id_user` , `gr`, `time`) VALUES  ('".$user_id."', '".intval($delid)."', '".time()."') ");
$remils = ($connect->query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '".$post[semen]."'")->fetch_row()[0] ?? 0);
if($remils>0) {
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$dohod."' WHERE `id_user` = $user_id AND `semen` = '".$post[semen]."' LIMIT 1");
} else {
$connect->query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$dohod."', '".$post['semen']."', '".$user_id."') ");
}
$connect->query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `antrom` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$connect->query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
}
header("Location: /farm/"); 
}
}
?>