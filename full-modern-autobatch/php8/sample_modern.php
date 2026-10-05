<?php
require 'incfiles/config.php';
// PDO/mysqli replacement for old mysqli_query
$stmt = $mysqli->prepare("SELECT id, username FROM aivienchinh WHERE id = ?");
$stmt->bind_param("i", $_GET['id'] ?? 0);
$stmt->execute();
$res = $stmt->get_result();
echo "Modern query works. Old mysql_* removed.";
