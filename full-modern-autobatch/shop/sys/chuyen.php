<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chuyển đồ</div>';
echo'<div class="menu list-bottom congdong">Chuyển một lần mất 1000 xu phí !</div>';
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
$mayman = rand(1,2);
if(isset($_POST['submit'])) { 
if ($dangmac[$getdangmac['loai']] == $getdangmac['id_loai']) {
$connect->query("UPDATE `nhanvat` SET `sucmanh` = `sucmanh`+'".$ch."' WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `nhanvat` SET `sucmanhgoc` = `sucmanhgoc`+'".$ch."'  WHERE `user_id` = '$user_id' LIMIT 1");
$connect->query("UPDATE `kho` SET `tangsucmanh` = `tangsucmanh`+'".$ch."' WHERE `id` = '".$arr['id']."' LIMIT 1");
$connect->query("UPDATE `kho` SET `cong` = `cong`+'1' WHERE `id` = '".$arr['id']."' LIMIT 1");
}
echo'<div class="menu">Chuyển chỉ số món đồ này thành công !</div>'; 
echo'<a href="/account/ruong/"><input type="button" value="Rương" /></a>';
} else {
$dangmac = $connect->fetch_array($connect->query("select * from `kho` WHERE `id` = '".$arr['id']."'"));
echo'<img src="'.$home.'/images/' . $_GET['loai'] . '/' . $dangmac[id_loai]. '.png" alt="'.$_GET['id'].'"/>';
echo '<form action="/shop/'.$_GET['loai'].'/nangcap/'.$arr['id'].'" method="post">';
$res = $connect->query("select * from `kho` WHERE `loai` = '".$_GET['loai']."' AND `user_id` = '".$user_id."'"); 
echo '<div class="menu"><select name="loaingoc">';
while ($post = $connect->fetch_array($res)){ 
echo "<option value='".$post['id_loai']."'>".$post['tenvatpham']."</option>";
}
echo'</select>';
echo "</div>";
echo'<input type="submit" name="submit" value="Chuyển" /><a href="/account/ruong/"><input type="button" value="Hủy" /></a></form>';
echo '</div>';

}
}
?>