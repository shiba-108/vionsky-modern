<?php
session_name('SESID');
session_start();
setcookie('cuid', '');
setcookie('cups', '');
setcookie('u_drb', '');
setcookie('p_drb', '');
session_destroy();
header('Location: /');

?>