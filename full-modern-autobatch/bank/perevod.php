<?php

define('_IN_JOHNCMS', 1);

$headmod = 'perevod';
$textl = 'Chuyển Xu';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

switch($act)
{
	default:
	if(empty($_GET['id']))
	{
		echo '<b>Chuyển Xu Cho Thành Viên</b><br/>';
                            echo '<form method="POST" action="perevod.php?act=ok">';
		echo '<div class="gmenu">';
		echo 'Bạn Đang Có: <b>'.$datauser['balans'].' xu</b><br/>';
		echo 'Chuyển Xu Qua Danh Sách Thành Viên:<br/>';
		echo '1: <input type="radio"  value="1" name="pos" checked="checked"/>';
		echo '<div class="fmenu">Nếu Bạn không nhớ, Hãy Chọn Một Nick :<br/>';
		echo '<select name="users">';
		echo '<option value="">Danh Sách</option>';
		$sql = $connect->query("select `id`,`name` from `users`");
		while($res = $connect->fetch_array($sql))
		{
			echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
		}
		echo '</select></div>';
		echo ' 2: <input type="radio"  value="2" name="pos" />';
		echo '<div class="fmenu">Viết Số ID Hoặc Tên Nick<br/><input name="user"/></div>';
		echo 'Số Xu Cần Chuyển:<br/><input name="bal"/></div>';
		echo '<div class="menu"><input value="Chuyển Xu" type="submit" name="submit"/></div></form>';
	}else{
		$sql = $connect->query("select `id`,`name` from `users` WHERE `id` = '".$id."' LIMIT 1;");
		if($connect->query("SELECT * FROM ...")$sql)!=="0")
		{
			$user = $connect->fetch_array($sql);
			echo '<form method="POST" action="perevod.php?act=ok&amp;id='.$user['id'].'">';
			echo 'Chuyển Xu Cho Thành Viên <b>'.$user['name'].'</b><br/>';
			echo 'Số Xu Chuyển :<br/><input name="bal"/><br/>';
			echo '<input value="Chuyển" type="submit" name="submit"/></form>';
		}
	}
	break;
	case "ok";
	if(empty($_GET['id']))
	{
		if(!empty($_POST['submit']))
		{
			if($_POST['pos'] == "1")
			{
                $user = isset($_POST['users'])?abs(intval($_POST['users'])):false;
			}elseif($_POST['pos'] == "2")
			{
                $user = isset($_POST['user'])?check($_POST['user']):false;
			}
			$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
			$count = ($connect->query("select COUNT(*) from `users` WHERE `id` = '".$user."' or `name` = '".$user."'")->fetch_row()[0] ?? 0);
			if($count > 0 )
			{
				$arr = $connect->fetch_array($connect->query("select `name`,`balans` from `users` WHERE `id` = '".$user."'  or `name` = '".$user."' LIMIT 1"));
				$q = $connect->fetch_array($connect->query("select `name`,`balans` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
				if($q['balans'] >= 20)
				{
				 if($arr['name'] !== $q['name'])
				 {
                  if($ball > 1 && $q['balans'] > $ball)
				  {
				$min_bal = intval($q['balans'] - $ball);
				$plus_bal = intval($arr['balans'] + $ball);
				$connect->query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				$connect->query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
$botsend = '' . $login . ' Đã Chuyển '.$ball.' Xu Cho '.$arr['name'].' ! :cuoito: ';
            $connect->query("INSERT INTO `forum` SET
                `refid` = '156',
                `type` = 'm' ,
                `time` = '" . time() . "',
                `user_id` = '3',
                `from` = 'BOT',
                `ip` = '00000',
                `ip_via_proxy` = '" . core::$ip_via_proxy . "',
                `soft` = '" . mysql_real_escape_string($agn1) . "',
                `text` = '" . mysql_real_escape_string($botsend) . "'
            ");
            $fadd = mysql_insert_id();
            // Обновляем время топика
            $connect->query("UPDATE `forum` SET
                `time` = '" . time() . "'
                WHERE `id` = '156'
            ");
				$msg = 'Chuyển Khoản: <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã chuyễn cho bạn '.$ball.' Xu.<br/>Đây Là Tin Nhắn Tự Động. Chúc Bạn 1 Ngày Vui Vẻ Cùng Vn4Teen.Tk!';
				$connect->query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				$connect->query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
				$connect->query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" .time(). "','BOT[Chuyển Xu]','in','no','Thông tin về chuyển khoản xu','0','','','','" . mysql_real_escape_string($fname) . "');");

				echo '<p>Chuyển Thành Công '.$ball.' Xu Cho Thành Viên '.$arr['name'].'<br/>';
				
                  }else{
                    echo '<p>Không thể chuyển tiền, số xu của bạn ít hơn số xu muốn chuyển!</p>';
                  }
				}else{
                    echo '<p>Có lỗi, không thể chuyển tiền!</p>';
				}
				}else{
					echo '<p>Không thể chuyển tiền, số xu của bạn ít hơn số xu muốn chuyển!</p>';
				}
			}else{
				echo '<p><b>Sai tên thành viên!</b><br/>';
				echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
				require_once ("../incfiles/end.php");
				exit;
			}
		}else{
            echo '<p><b>Có lỗi!!!</b><br/>';
		    echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
			require_once ("../incfiles/end.php");
			exit;
		}
	}else{
        if(!empty($_POST['submit']))
		{
			$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
			$count = ($connect->query("select COUNT(*) from `users` WHERE `id` = '".$id."'")->fetch_row()[0] ?? 0);
			if($count > 0 )
			{
				$arr = $connect->fetch_array($connect->query("select `name`,`balans` from `users` WHERE `id` = '".$id."' LIMIT 1"));
				$q = $connect->fetch_array($connect->query("select `name`,`balans` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
				if($q['balans'] >= 20)
				{
                 if($arr['name'] !== $q['name'])
				 {
				  if($ball > 1 && $q['balans'] > $ball)
				  {
				$min_bal = intval($q['balans'] - $ball);
				$plus_bal = intval($arr['balans'] + $ball);
				$connect->query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				$connect->query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$id."' LIMIT 1");
$botsend = '' . $login . ' đã chuyển '.$ball.' xu cho '.$arr['name'].' ! :cuoito: ';
            $connect->query("INSERT INTO `forum` SET
                `refid` = '156',
                `type` = 'm' ,
                `time` = '" . time() . "',
                `user_id` = '3',
                `from` = 'BOT',
                `ip` = '00000',
                `ip_via_proxy` = '" . core::$ip_via_proxy . "',
                `soft` = '" . mysql_real_escape_string($agn1) . "',
                `text` = '" . mysql_real_escape_string($botsend) . "'
            ");
            $fadd = mysql_insert_id();
            // Обновляем время топика
            $connect->query("UPDATE `forum` SET
                `time` = '" . time() . "'
                WHERE `id` = '156'
            ");
				$msg = 'Chuyển khoản: <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã chuyễn cho bạn '.$ball.' xu.<br/>Đây là tin nhắn tự động.Chúc bạn 1 ngày vui vẻ cùng Zing4vn.org';
				$connect->query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				$connect->query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
				$connect->query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" .time(). "','BOT(Máy Chém Tự Động)','in','no','Thông tin về chuyển khoản xu','0','','','','" . mysql_real_escape_string($fname) . "');");
				echo '<p>Chuyển thành công  '.$ball.' xu cho thành viên '.$arr['name'].'<br/>';
				
				  }else{
                    echo '<p>Không thể chuyển tiền, số xu của bạn ít hơn số xu muốn chuyển!</p>';
				  }
				 }else{
                    echo '<p>Có lỗi, không thể chuyển tiền!</p>';
				}
				}else{
					echo '<p>Không thể chuyển tiền, số xu của bạn ít hơn số xu muốn chuyển!</p>';
				}
			}else{
				echo '<p><b>Sai tên thành viên!</b><br/>';
				echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
				require_once ("../incfiles/end.php");
				exit;
			}
		}else{
            echo '<p><b>Lỗi!!!</b><br/>';
		    echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
			require_once ("../incfiles/end.php");
			exit;
		}
	}
	break;
}

require_once ("../incfiles/end.php");
?>