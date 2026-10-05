<?php

echo '<div class="menu">';
echo '<form method="post">'.(empty($areanonline['nguoichoi']) && $areanonline['user_id']!=$user_id ? '<a href="phong.php?id='.$id.'&thamgia"><input type="button" value="Sẵn Sàng"/></a>':''.($areanonline['nguoichoi']==$user_id ? '<a href="phong.php?id='.$id.'&bothamgia"><input type="button" value="Bỏ Sẵn Sàng"/></a>':'').'').''.($areanonline['user_id']==$user_id ? '<a href="phong.php?id='.$id.'&batdau"><input type="button" value="Bắt đầu chơi"/></a><a href="phong.php?id='.$id.'&huyphong"><input type="button" value="Huỷ phòng"/></a>':'').'</form>';
echo'</div>';

?>