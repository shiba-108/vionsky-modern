<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Cường Hóa Đồ</div>';
$arr = $connect->fetch_array($connect->query("select * from kho WHERE `id` = '" . $kill . "'"));
           if ($arr['id'] != $_GET['id_loai']) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } elseif ($arr['id'] != $_GET['id_loai']) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } elseif (empty($arr['id_loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else
            if (empty($_GET['loai'])) {
                echo '<div class="menu">không nhận diện được loại đồ trong rương<br/><a href="/account/ruong/">Tiếp Tục</a></div>';
            } else {
$vatpham =($connect->query("SELECT COUNT(*) FROM `vatpham` WHERE `id_user` = '$user_id' AND `soluong` > '0'")->fetch_row()[0] ?? 0);
if($vatpham > 0){
$mayman = rand(1,2);
if(isset($_POST['submit'])) { 
$songoc = $connect->fetch_array($connect->query("select `soluong` from `vatpham` WHERE `id` ='".$_POST['loaingoc']."'"));
if ($songoc[soluong] > '0') {
if ($mayman == '1') {
$smnn = $connect->fetch_array($connect->query("select * from `vatpham` WHERE `id_user` = '$user_id' AND `id` ='".$_POST['loaingoc']."'"));
$getdangmac = $connect->fetch_array($connect->query("select * from `kho` WHERE `id` = '".$arr['id']."'"));
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
if(!empty($smnn[chisoch2 ])) {
$ch = rand($smnn['chisoch1'],$smnn['chisoch2']);
}
if(!empty($smnn[hp2])) {
$ch = rand($smnn['hp1'],$smnn['hp2']);
}
if ($songoc[soluong] > '0') {
$connect->query("UPDATE `vatpham` SET `soluong` = `soluong`-'1'  WHERE `id` = '".$_POST['loaingoc']."' LIMIT 1");
}
if(!empty($smnn[chisoch2])) {
echo '<div class="menu">Cường hóa thành công tăng cho món đồ này '.$ch.' sức mạnh ^^</div>'; 
if ($dangmac[$getdangmac['loai']] == $getdangmac['id_loai']) {
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`+'".$ch."' WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`+'".$ch."'  WHERE `user_id` = '$user_id' LIMIT 1");
}
$connect->query("UPDATE `kho` SET `tangsucmanh` = `tangsucmanh`+'".$ch."' WHERE `id` = '".$arr['id']."' LIMIT 1");
$connect->query("UPDATE `kho` SET `cong` = `cong`+'1' WHERE `id` = '".$arr['id']."' LIMIT 1");

}
if(!empty($smnn[hp2])) {
echo '<div class="menu">Cường hóa thành công tăng cho món đồ này '.$ch.' HP ^^</div>'; 
if ($dangmac[$getdangmac['loai']] == $getdangmac['id_loai']) {
$connect->query("UPDATE `nhanvat` SET `hp` = `hp`+'".$ch."' WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `hpfull` = `hpfull`+'".$ch."'  WHERE `user_id` = '$user_id' LIMIT 1");
}
$connect->query("UPDATE `kho` SET `tanghp` = `tanghp`+'".$ch."' WHERE `id` = '".$arr['id']."' LIMIT 1");
$connect->query("UPDATE `kho` SET `conghp` = `conghp`+'1' WHERE `id` = '".$arr['id']."' LIMIT 1");
}

echo'<a href="'.$home.''.$_SERVER['REQUEST_URI'].'"><input type="button" value="Tiếp tục" /></a><a href="/account/ruong/"><input type="button" value="Rương" /></a>';
echo "</div>";
} else {
if ($songoc[soluong] > '0') {
$connect->query("UPDATE `vatpham` SET `soluong` = `soluong`-'1'  WHERE `id` = '".$_POST['loaingoc']."' LIMIT 1");
}
echo '<div class="menu">Cường hóa thất bại !</div>'; 
echo'<a href="'.$home.''.$_SERVER['REQUEST_URI'].'"><input type="button" value="Tiếp tục" /></a><a href="/account/ruong/"><input type="button" value="Rương" /></a>';
echo "</div>";
}
} else {
$smnn = $connect->fetch_array($connect->query("select * from `vatpham` WHERE `id_user` = '$user_id' AND `id` ='".$_POST['loaingoc']."'"));
echo '<div class="menu">Bạn đã hết ngọc '.$smnn[item].' rồi nhé !</div>'; 
echo'<a href="/account/ruong/"><input type="button" value="Rương" /></a>';
}
} else {
$dangmac = $connect->fetch_array($connect->query("select * from `kho` WHERE `id` = '".$arr['id']."'"));
echo'<img src="'.$home.'/images/' . $_GET['loai'] . '/' . $dangmac[id_loai]. '.png" alt="'.$_GET['id'].'"/>';
echo '<form action="/shop/'.$_GET['loai'].'/nangcap/'.$arr['id'].'" method="post">';
$res = $connect->query("select * from `vatpham` WHERE `id_user` = '$user_id' AND `soluong` > '0' "); 
echo '<div class="menu"><select name="loaingoc">';
while ($post = $connect->fetch_array($res)){ 
echo "<option value='".$post['id']."'>".htmlspecialchars($post['text'])." [".$post['soluong']." viên]</option>";
}
echo'</select>';
echo "</div>";
echo'<input type="submit" name="submit" value="Cường hóa" />&#160;<a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
echo '</div>';

}
} else {
echo '<div class="menu">Bạn không đủ ngọc để nâng cấp món đồ này !</div>'; 
echo "</div>";
}
}
?>