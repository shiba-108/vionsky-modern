<?php
$tong = ($connect->query("SELECT COUNT(*) FROM `quayso`")->fetch_row()[0] ?? 0);
$res = $connect->query("SELECT * FROM `quayso` ORDER BY `id` DESC LIMIT $start, $kmess");
while ($post = $connect->fetch_array($res)){
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img src="/khuvuichoi/icon/'.$post['id'].'.png" alt="icon"/>&#160;';
echo'</td><td>';
echo"<a href='/khuvuichoi/quacauquayso/$post[id]'>[ <b>Quả cầu ".htmlspecialchars($post['name'])."</b> ]</a><br/>";
echo'Giá: '.$post[gia].''.($post[loaixu] == tienxu ? 'xu':' vinaxu').'  = 1 quả<br/>';
echo'</td></tr></table></div>';
}
if ($tong > $kmess) { 
echo '<div class="menu">' . functions::phan_trang('/khuvuichoi/quacauquayso/', $start, $tong, $kmess) . '</div>'; 
}
?>
