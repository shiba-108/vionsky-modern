<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../../incfiles/core.php');
$mota = 'Nhiều lúc thấy một video hay nào đó mà bạn';
require ('../../incfiles/head.php');
?>
<div class="main-xmenu">
<div class="danhmuc">
<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
  <a href="<? echo $home; ?>/tien-ich" itemprop="url">
    <span itemprop="title">Tiện Ích</span>
  </a> ›
</span>
<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
  <a href="<? echo $home; ?>/tien-ich/download-youtube" itemprop="url">
    <span itemprop="title">Tải Video Youtube</span>
  </a>
</span>
</div>
<?php
echo'<div class="menu"><form action="/tien-ich/download-youtube/search.php" method="get"><input type="text" value="'.$q.'" name="q" class="search" size="13"/> <input type="submit" value="Tìm" /></form></div>';
?>
</div>