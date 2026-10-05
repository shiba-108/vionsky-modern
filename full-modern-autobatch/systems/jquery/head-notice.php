<?php 
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../../incfiles/core.php');
$new_mail = ($connect->query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'")->fetch_row()[0] ?? 0);
?>

<table>
<tr class="navbar">
<td id="right">
<a href="<? echo $home; ?>"><img src="<? echo $home; ?>/icon/bangtin.png" height="20" alt="icon" style="vertical-align: -5px;"/></a> 
</td><td id="center">
<a href="<? echo $home; ?>/notice/"><img src="<? echo $home; ?>/icon/thongbao.png" height="20" alt="icon" style="vertical-align: -5px;"/>
<?php if ($user_id){echo ''.($datauser['thongbaocanhan'] == 0 ? '' : '<span class="mitemCount">'.$datauser['thongbaocanhan'].'</b></span>');} ?></a>
</td><td id="center">
<a href="<? echo $home; ?>/mail/"><img src="<? echo $home; ?>/icon/tinnhan.png" height="20" alt="icon" style="vertical-align: -5px;"/>
<?php if (!empty($new_mail)){echo '<span class="mitemCount">' . $new_mail . '</span>';} ?></a>
</td><td id="left">
<a href="<? echo $home; ?>/tags/"><img src="<? echo $home; ?>/icon/search.png" height="20" alt="icon" style="vertical-align: -5px;"/></a>
</td></tr></table>

<?php ?>