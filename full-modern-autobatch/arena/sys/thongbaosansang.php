<?php
if (!empty($areanonline['nguoichoi'])) {
$noticearena = mysqli_result($connect->query("SELECT COUNT(*) FROM `arena_notice` WHERE
`chuphong` = '".$areanonline['user_id']."' AND 
`nguoichoi` = '".$areanonline['nguoichoi']."' AND 
`phong` = '".$id."' AND 
`view` = '0' AND 
`type` = 'a'
"), 0);

if($xoatb['luothien'] == 0) {
if($noticearena == 0) {
$connect->query("INSERT INTO `arena_notice` SET
`chuphong` = '".$areanonline['user_id']."',
`nguoichoi` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`luothien` = '1',
`time` = '" . time() . "',
`type` = 'a'
");
}
}
}
?>