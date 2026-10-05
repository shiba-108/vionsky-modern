<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('../incfiles/core.php');
if($_POST['noidung'] && $_POST['tid']){
		$message= strip_tags(functions::checkout($_POST['noidung'], 1, 1));
 $sql_ary_chat = array(
			'uid'			=> $datauser['id'],
			'cmt'			=> $message,
			'tid'			=> $_POST['tid'],
				);
		$sql = 'INSERT INTO carocmt (uid, cmt, tid) VALUES ('.$datauser['id'].', "'.$message.'", '.$_POST['tid'].') ';
		$connect->query($sql);
}
header('Location: '.$home.'/caro/?id='.$_POST['tid'].'#chat');
?>
