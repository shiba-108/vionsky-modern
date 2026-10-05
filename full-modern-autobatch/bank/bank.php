<?php
/*

*/
define('_IN_JOHNCMS', 1);
$textl = 'Banks - Ngân Hàng';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
//header("Content-type:text/html; charset=utf-8");

$oldtime=$realtime+43200;

echo '<div class="mainblok"><div class="phdr"><b>Banks - Ngân Hàng</b></div><div class="menu"><br/><br/>';

if (!empty($user_id)){
//--------------- Функция правильного вывода времени -------------------//
function formattime($file_time){

if($file_time >= 86400){
$file_time = 'Ngày: '.round((($file_time / 60) / 60) / 24, 1);
}elseif(
$file_time >= 3600){
$file_time = 'Giờ:  '.round(($file_time / 60) / 60, 1);
}elseif(
$file_time >= 60){
$file_time =  'Phút: '.round($file_time / 60);
}else{
$file_time = 'секунд:  '.round($file_time);}
return $file_time;
}
/////////////

$q=$connect->query("select * from bank where user='".$user_id."';");
$q1=$connect->fetch_array($q);
$usersum=$q1['vklad'];
$userdata=$q1['datatime'];
$usid=$q1['id'];
if(!isset($_GET['action'])){

echo'Bạn có: '.$datauser['balans'].' $<br/>';
if($q1<1){
echo 'Bạn là khách hàng mới của Bank - Ngân Hàng. Chúng tôi rất vui chào mừng bạn đến với hệ thống tiết kiệm có lãi của Banks - Ngân Hàng<br/>';
echo 'Tài khoản ngân hàng của bạn chưa có $ nào, hãy gửi ít nhất 10 $ để tạo tài khoản nhé!<br/>';
} else {
echo 'Bạn đã có một tài khoản trong ngân hàng Bank - Ngân Hàng với số $ là: '.$usersum;}
if($usersum>5000000){echo'<br/><b><font color="#FF0000">Xin lưu ý: Không gửi quá 5 triệu VND, Admin đang nghi ngờ bạn Hack hoặc Bug VND!</font></b>';}


if($userdata>=$realtime){
echo '<br/>Thời gian rút lãi gần nhất còn <b>'.formattime($userdata-$realtime).'</b>';
}else{if($usersum>0){
echo'<br/><b>Số lãi của bạn đã tăng!</b>';}}

//-------------------- Выплата процентов ---------------------//
if($userdata!="" && $realtime>=$userdata && $usersum>0){
$stavka=12;
if($usersum>=100000){$stavka=6;}
if($usersum>=250000){$stavka=3;}
if($usersum>=500000){$stavka=2;}
if($usersum>=1000000){$stavka=1;}
if($usersum<=5000000){
$newgold3=round((($usersum*$stavka)/100)+$usersum);
}else{$newgold3=$usersum;}
$pro_gold=$newgold3-$usersum;
echo '<br/>Một phần trăm : '.$pro_gold;
$connect->query("update `bank` set vklad='" . $newgold3 . "', datatime='".$oldtime."' where user='" . $user_id .
"';");
}
echo '<br/><br/><b>Hoạt động:</b>';
echo '<br/><form action="bank.php?action=operacia" method="post"><input name="gold" /><br/>';
echo '<select name="oper">';
echo '<option value="2">Gửi tiền vào tài khoản</option><option value="1">Rút tiền từ tài khoản</option>';
echo '</select><br/><br/>';
echo '<input type="submit" value="Tiếp tục" /></form><hr/>';
echo'Số $ gửi tối thiểu là 10 $<br/>';
echo'Số $ gửi tối đa là 5.000.000<br/><br/>';
echo'Lãi suất phụ thuộc vào số $ bạn gửi<br/>';
echo'Gửi 100.000 - Tỷ lệ 12%<br/>';
echo'Gửi 100.000 và nhiều hơn. - Tỷ lệ 6%<br/>';
echo'Gửi 250.000 và nhiều hơn. - Tỷ lệ 3%<br/>';
echo'Gửi 500.000 và nhiều hơn. - Tỷ lệ 2%<br/>';
echo'Các thành viên gửi hơn 1.000.000. - Tỷ lệ 1%<br/><br/>';
/*echo'Tổng số người gửi tiền: <b>'.(int)$all_bank.'</b><br/>';
echo'Kho tiền của ngân hàng WT Bank có: '.balanss($banksumm).'<br/>';*/
}
//------------------------------ Операция ------------------------------------//
if($_GET['action']=="operacia"){
if(ctype_digit($_POST['gold']) && $_POST['gold']>=10 && $_POST['oper']!=""){


//----------------------- Снятие с счета ----------------------------//
if($_POST['oper']=="1"){
echo'<b>Rút Lượng từ tài khoản</b><br/>';
if($usersum>0){
if($_POST['gold']<=($usersum-10)){
//------------------------------ Запись в профиль ----------------------------//
$datauser1=($datauser['balans']+$_POST['gold']);
$connect->query("update `users` set `balans`='" . $datauser1 . "' where id='" . $user_id .
"';");
$newgold=($usersum-$_POST['gold']);
$connect->query("update `bank` set `vklad`='" . $newgold . "', `datatime`='".$oldtime."' where `user`='" . $user_id .
"';");
echo'Số tiền <b>'.$_POST['gold'].' $</b> rút thành công!<br/>';
echo'Số $ còn lại trong tài khoản: <b>'.$newgold.'</b><br/>';
echo'$: <b>'.$datauser['balans'].'</b>';
}else{echo'<b>Không thể rút quá 10 $, trong tài khoản phải luôn có 10 $ để duy trì!</b>';}
}else{echo'<b>Bạn không thể rút tiền, trong tài khoản của bạn không có $!</b>';}
}
//-------------------------- Пополение счета --------------------------------//
if($_POST['oper']=="2"){
echo'<b>Gửi tiền thành công!</b><br/>';
if($_POST['gold']<=$datauser['balans']){
//------------------------------ Запись в профиль ----------------------------//
$dataus1=($datauser['balans']-$_POST['gold']);
$connect->query("update `users` set `balans`='" . $dataus1 . "' where `id`='" . $user_id .
"';");
$newgold=($usersum+$_POST['gold']);
if($usid){
$connect->query("update `bank` set `vklad`='" . $newgold . "', datatime='".$oldtime."' where `user`='" . $user_id .
"';");
}else{
$connect->query("insert into `bank` SET `user`='".$user_id."', `vklad`='".$_POST['gold']."', `datatime`='".$oldtime."';");
}
echo'Số tiền <b>'.$_POST['gold'].'</b> $ được gửi vào tài khoản của bạn thành công!<br/>';
echo'Hiện tại tài khoản ngân hàng của bạn có: <b>'.$newgold.' $</b><br/>';
echo'Số $ ngoài hiện có: <b>'.$datauser['balans'].' $</b><br/>';
echo'Không thể nhận số tiền lãi trước 12 giờ sau khi gửi';
}else{echo'<b>Không đủ tiền, bạn không có số tiền này trong tài khoản</b>';}
}
//----------------------------------------------------------------//
}else{echo'Giao dịch ít hơn 10 $ không được thực hiện<br/>';}
echo'<br/><br/><a href="bank.php?">Tiếp tục</a>';
}
}else{
echo '<br/>Bạn không được phép để thực hiện các hoạt động phải<br/>';
echo '<b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/><br/>';
}
echo '</div><div class="phdr"><a href="index.php">' . $lng['back'] . '</a></div></div>';
require_once ("../incfiles/end.php");
?>