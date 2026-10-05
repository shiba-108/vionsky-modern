<?php
define('_IN_JOHNCMS', 1);
$headmod = 'forumsearch';
require('incfiles/core.php');
$page = ($_GET['trang']);
if ( $page >1 ){
$vina4u = ' | Page '.$page.'';
}
$page1 = ($_GET['page']);
if ( $page1 >1 ){
$vina4u1 = ' | Page '.$page1.'';
}
$lng_forum = core::load_lng('forum');
$title_post = isset($_POST['search']) ? trim($_POST['search']) : false;
$title_get = isset($_GET['search']) ? rawurldecode(trim($_GET['search'])) : false;
$title = $title_post ? $title_post : $title_get;
$textl = $title ? '' .functions::text_timkiem($title) . ''.$vina4u1.''.$vina4u.'' : 'Tìm kiếm cho bạn';
$mota = $title ? 'Xem ' .functions::text_timkiem($title) . ' , Đọc ' .functions::text_timkiem($title) . ',  Tải ' .functions::text_timkiem($title) . '' : 'Tìm kiếm bài viết của thành viên, tìm kiếm game, tìm kiếm ứng dụng, tìm kiếm thủ thuật, truyện';
require('incfiles/head.php');
if ($_SERVER['REQUEST_URI'] == '/seo/index.html') {
header('Location: '.$home.'/seo/' .functions::khongdau($title).'');
}
function ReplaceKeywords($search, $text)
{
$search = str_replace('*', '', $search);
return mb_strlen($search) < 3 ? $text : preg_replace('|(' . preg_quote($search, '/') . ')|siu', '<span style="background-color: #FFFF33">$1</span>', $text);
}

switch ($act) {
default:

$search_post = isset($_POST['search']) ? trim($_POST['search']) : false;
$search_get = isset($_GET['search']) ? rawurldecode(trim($_GET['search'])) : false;
$search_text = $search_post ? $search_post : $search_get;
$search = $search_post ? $search_post : $search_get;
$search = html_entity_decode(trim($search), ENT_QUOTES, 'UTF-8');
$search = str_replace(" ","-", $search);
$search_t = isset($_REQUEST['t']);
$to_history = false;
echo'<div class="main-xmenu">';
if(empty($title)) {
echo '<div class="danhmuc">Tìm kiếm</div>';
} else {
echo '<div class="danhmuc">Tìm thấy <h1>' .functions::text_timkiem(($search ? functions::checkout($search_text) : '')) . '</h1></div>';
}
echo '<div class="menu congdong"><form action="'.$home.'/seo/index.html" method="post">' .
'<input type="text" value="' .functions::text_timkiem(($search ? functions::checkout($search_text) : '')) . '" name="search" />' .
'<input type="submit" value="Tìm" name="submit" /><br />' .
'</form></div>';
if(empty($title)) {
echo '<div class="menu list-top">Nhập từ khóa mà bạn muốn tìm !</div>';
}
$error = $search && mb_strlen($search) < 4 || mb_strlen($search) > 64 ? true : false;

if ($search && !$error) {
/*
-----------------------------------------------------------------
Выводим результаты запроса
-----------------------------------------------------------------
*/
$array = explode(' ', $search);
$count = count($array);
$query = mysql_real_escape_string($search);
$total = mysqli_result($connect->query("
SELECT COUNT(*) FROM `forum`
WHERE MATCH (`text`) AGAINST ('$query' IN BOOLEAN MODE)
AND `type` = 't'" . ($rights >= 7 ? "" : " AND `close` != '1'
")), 0);
if ($total) {
if ($total) {
$to_history = true;
$req = $connect->query("
SELECT *, MATCH (`text`) AGAINST ('$query' IN BOOLEAN MODE) as `rel`
FROM `forum`
WHERE MATCH (`text`) AGAINST ('$query' IN BOOLEAN MODE)
AND `type` = 't'
ORDER BY `time` DESC
LIMIT $start, 8
");
$i = 0;
while (($baiviet = $connect->fetch_array($req)) !== false) { 
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
###### code xuất bài viết
?>
 <div class="menu list-top forum">
  <img src="/icon/post.png" alt="icon"/>
  <a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><?php echo mb_substr($baiviet['text'], 0, 100); ?></a>
  <span style="color:red">[♥<?php echo $likeforum; ?>/<?php echo ($commentforum-1); ?>]</span> <?php echo nick($nguoicomment[user_id]); ?>
 </div>
<?php
}
++$i;
}
} else {
echo '<div class="menu list-top">Từ khóa bạn tìm không có trên hệ thống xin hãy nhập từ khóa khác</div>';
}
} else {
if ($error) echo functions::display_error(core::$lng['error_wrong_lenght']);
}
if (isset($total) && $total > $kmess) {
echo '<div class="menu list-top">' . functions::phan_trang('/seo/' . urlencode($search) . '/', $start, $total, $kmess) . '</div>';
}
echo'</div>';
}
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">Từ khóa mới</div>';
echo '<div class="menu congdong">Các từ khóa được tìm kiếm từ google</div>';
$sql = " AND `engine` LIKE '%google%'";
$sql = str_replace('AND', 'WHERE', $sql);
$total = ($connect->query("SELECT COUNT(*) FROM `stat_robots` ".$sql."")->fetch_row()[0] ?? 0);
if($total > 0)
$req = $connect->query("SELECT * FROM `stat_robots` ".$sql." ORDER BY `date` DESC LIMIT 10");
if($total > 0){
while ($arr = $connect->fetch_array($req)){
echo '<div class="menu list-top">';
echo '› <a href="'.$home.'/seo/'.functions::khongdau(str_replace(' ','-',$arr['query'])). '"><h2>'.$arr['query'].'</h2></a>';
echo '</div>';
}
}
echo '</div>';
require('incfiles/end.php');