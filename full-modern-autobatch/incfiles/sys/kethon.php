<?php
$kethon = $connect->query("SELECT * FROM `thongbaokethon` WHERE `dongy` = '3' ORDER BY `time` DESC LIMIT 1");
while($arr = $connect->fetch_array($kethon)) {
if (($arr[time] + 20) < time()) {
$connect->query("UPDATE `thongbaokethon` SET `dongy` = '4' WHERE `id` = '" . $arr[id]. "'");
$connect->query("UPDATE `thongbaokethon` SET `time` = '0' WHERE `id` = '" . $arr[id]. "'");
}
echo'<div class="thongbaomini"><img src="/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/>&#160;Xin chúc mừng '.nick($arr[user_id]).' và '.nick($arr[musers]).' giờ đã là vợ chồng của nhau mọi người hãy chúc phúc cho họ nhé !</div>';
}

$req = $connect->query("SELECT * FROM `thongbaokethon` WHERE `user_id`='$user_id' AND `dongy` = '1' ORDER BY `time` DESC LIMIT 3");
while($res = $connect->fetch_array($req)) {
if(isset($_POST['dongy'])) {
$connect->query("UPDATE `thongbaokethon` SET `dongy` = '3' WHERE `id` = '" . $res[id]. "'");
$connect->query("UPDATE `users` SET `nguoiyeu` = '".$res['musers']."' WHERE `id` = '" .$user_id. "'");
$connect->query("UPDATE `users` SET `nguoiyeu` = '".$user_id."' WHERE `id` = '".$res['musers']."'");
echo'Chính thức tuyên bố bạn và '.nick($res['musers']).' là vợ chồng của nhau !';
header('Location: '.$home.'');
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$res['musers']."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$res['musers']."',
            `time` = '" . time() . "',
            `type` = 'k'
        ");
if ($datauser['sex'] == 'zh'){
$connect->query("INSERT UPDATE `kethon` SET
                `time` = '" . $time . "',
                `vo` = '" . $user_id. "',
                `chong` = '" . $user['id'] . "'
                ;");
} else {
$connect->query("INSERT UPDATE `kethon` SET
                `time` = '" . $time . "',
                `vo` = '" . $user['id'] . "',
                `chong` = '" . $user_id. "'
                ;");
}
}
if(isset($_POST['tuchoi'])) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$res['musers']."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$res['musers']."',
            `time` = '" . time() . "',
            `type` = 'o'
        ");
header('Location: '.$home.'');
$connect->query("DELETE FROM `thongbaokethon` WHERE `id`='".$res['id']."'");
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`+'30000' WHERE `id` = '" .$res['musers']. "'");
} else {
if(isset($_POST['tuchoi']) || isset($_POST['tuchoi'])) {
} else {
echo ''.($res['read']==0 ? '<div class="thongbaomini">':'<div class="thongbaomini">').'';
echo '<img src="/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['musers'].'">'.nick($res['musers']).'</a> đã cầu hôn bạn bạn đồng ý làm '.($datauser['sex']==zh ? 'vợ':'chồng').' của '.($datauser['sex']==zh ? 'anh ấy':'cô ấy').' không <span style="font-size:13px;color:#777;">('.functions::thoigian($res['time']).')</span>';
echo '<div class="menu" style="margin-left:12px"><form method="post"><input type="submit" name="dongy" value="Đồng ý" /><input type="submit" name="tuchoi" value="Từ chối" /></form></div>'; 
echo '</div>';
}
}
}
?>