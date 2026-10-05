<?php

define('_IN_JOHNCMS', 1);

$textl = 'Nhắn tin cho thành viên ducnghia';
require ('../incfiles/core.php');
require ('../incfiles/head.php');

if($rights < 9)
  header("Location: $home");

if(isset($_POST['submit']))
{
  $text = stripslashes(htmlspecialchars(trim($_POST['text']), ENT_QUOTES));
  if($_POST['non_adm'])
    $query = $connect->query("SELECT `id` FROM `users` WHERE `rights` > 1;");
  else
    $query = $connect->query("SELECT `id` FROM `users` WHERE NOT `id` = $user_id;");

  $i = 0;

  while($user = $connect->fetch_array($query))
  {
    $connect->query("INSERT INTO `cms_mail` SET `user_id` = '" . $user_id . "', `from_id` = '" . $user['id'] . "', `text` = '" . $text . "', `time` = '" . time() . "';");
    $i++;
  }
  echo '<div class="rmenu">Bạn đã gửi tin nhắn thành công cho ' . $i . ' người.</div>';
}

echo '<div class="phdr">Nhắn tin đến member - ducnghia.ga</div>';
echo '<div class="menu">';
echo '<form action="" method="POST">';
echo '<label>Nội Dung:<br/>';
echo '<textarea name="text"></textarea></label><br/>';
echo '<label><input type="checkbox" name="non_adm" value="1" checked="checked"/>Không gửi thành viên</label><br/>';
echo '<input type="submit" name="submit" value="Gửi"/>';
echo '</form>';
echo '</div>';
////code by ddvn.me////
require ('../incfiles/end.php');

?>