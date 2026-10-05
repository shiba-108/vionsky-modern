<?php
$duyetnhom = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `duyet` = '0'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hội Nhóm'.($rights >= 7 ? ''.($duyetnhom > 0 ? '[ <a href="/groups/duyetgroups.php">Có <span style="color:red">'.$duyetnhom.'</span> cần duyệt</a> ]':'').'':'').'</div>';
$req = $connect->query("SELECT * FROM `nhom` ORDER BY `id` DESC LIMIT 5");
for ($j = 0; $res = $connect->fetch_assoc($req); ++$j) {
$tongbaiviet = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `groups` = '".$res[id]."' AND `duyet` = '1'")->fetch_row()[0] ?? 0);
$thanhvien = mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$res['id']."' AND `duyet`='1'") ,0);
if ($j == 0) {
echo '<div class="menu">';
} else {
echo '<div class="menu list-top">';
}
echo'<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td style="vertical-align: top;width:45px;">';
$url = @getimagesize('groups/avatar/'.$res['id'].'.png');
if(is_array($url)) {
echo'<img src="/groups/avatar/'.$res['id'].'.png" height="40" width="40" alt="Logo Đội"/>';
} else {
echo'<img src="/groups/img/nologo.png" height="40" width="40" alt="Logo Đội"/>';
}
echo'</td><td>';
echo'<a href="/groups/'.$res['id'].'"><h3 style="font-size:12px">'.htmlspecialchars($res['name']).'</h3></a><br/>
<span class="post_mota">'.$res['gt'].'</span>';
echo'</td></tr></tbody></table>';
echo'</div>';
}
echo '<div class="menu"><a style="color:red" href="/groups/">[ XEM THÊM TẤT CẢ HỘI NHÓM ]</a></div>';
echo'</div>';
?>