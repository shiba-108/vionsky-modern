<?
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$textl = 'Bài viết theo dõi';
require_once ('../incfiles/head.php');
if ($user_id) {
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
}else{
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach');}
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach/');}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Các bài viết bạn đang theo dõi</div>';
###### get sql chính
$req = $connect->query("SELECT * FROM `theodoi` WHERE `type` = 't' AND `user_id` = '{$user_id}' ORDER BY `time` DESC LIMIT $start, $kmess");
###### get page tong
$tongso = ($connect->query("SELECT COUNT(*) FROM `theodoi` WHERE `type` = 't' AND `user_id` = '{$user_id}'")->fetch_row()[0] ?? 0);
while ($arr = $connect->fetch_array($req)) { 
    $tongsobinhluan = ($connect->query("SELECT COUNT(*) FROM `binh_luan_cong_dong` WHERE `id`='" . $arr['baiviet'] . "'")->fetch_row()[0] ?? 0);
    $arr['text'] = functions::checkout($arr['text'], 1, 1);
    $postup = $connect->fetch_array($connect->query("SELECT * FROM `binh_luan_cong_dong` WHERE `id`='{$arr['baiviet']}' ORDER BY `id_comment` DESC LIMIT 1"));
    $topic = $connect->fetch_array($connect->query("SELECT * FROM `account` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $arr['baiviet'] . "'ORDER BY time DESC"));
    $topictheodoi = $connect->fetch_array($connect->query("SELECT * FROM `account` WHERE `type` = 't' AND `close` != '1' AND `id` = '" . $arr['baiviet'] . "'ORDER BY time DESC"));
###### code xuất bài viết
    if ($arr['tophot'] == 1) {
    echo'<div class="menu list-bottom hot">';
    } else {
    echo'<div class="menu list-bottom congdong">';
    }
    echo'»&#160;';
    echo'<a href="'.$home.'/post/'.$arr[baiviet].'-' . functions::khongdau(mb_substr($topictheodoi['text'], 0, 30)) . '">'.mb_substr($topictheodoi['text'], 0, 100).'</a> <span style="font-size:11px;color:#777;margin-top:5px;">('.$tongsobinhluan.')</span>&#160;';
    if ($postup[user_id] == 0) {
    echo''.nick($topic[user_id]).'';
    } else {
    echo''.nick($postup[user_id]).'';
    }
    if (mb_strlen($arr['text']) > 101){echo'...';}
    echo'</div>';
    +$i;
}
if ($tongso == 0) {
echo '<div class="menu">Bạn không theo dõi bài viết nào !</div>';
}
###### page
if ($tongso > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/', $start, $tongso, $kmess) . '</div>';
}
echo'</div>';
require_once ("../incfiles/end.php");
?>