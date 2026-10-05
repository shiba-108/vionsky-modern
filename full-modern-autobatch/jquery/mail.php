<?php 
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$new_mail = ($connect->query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'")->fetch_row()[0] ?? 0); ?>
<?php if (!empty($new_mail)){echo '<span class="mitemCount">' . $new_mail . '</span>';} ?>