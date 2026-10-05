<?php include'autoload.php'; ?>
<table>
<tr class="navbar">
<td id="right">
<a href="<? echo $home; ?>"><img src="<? echo $home; ?>/icon/bangtin.png" height="20" alt="Bảng Tin" style="vertical-align: -4px;"/>
</td><td id="center">
<?php if (!$user_id){ ?>
<a href="<? echo $home; ?>/login.vn4u"><img src="<? echo $home; ?>/icon/dangnhap.png" height="20" alt="Đăng Kí" style="vertical-align: -4px;"/>
</td><td id="center">
<a href="<? echo $home; ?>/registry.vn4u"><img src="<? echo $home; ?>/icon/dangki.png" height="20" alt="Đăng Nhập" style="vertical-align: -4px;"/></a>
<?php } else { ?>
<a href="<? echo $home; ?>/notice/"><img src="<? echo $home; ?>/icon/thongbao.png" height="20" alt="Thông Báo" style="vertical-align: -4px;"/><span id="notice"></span></a>
</td><td id="center">
<a href="<? echo $home; ?>/mail/"><img src="<? echo $home; ?>/icon/tinnhan.png" height="20" alt="Tin Nhắn" style="vertical-align: -4px;"/><span id="mail"></span></a>
<?php } ?>
</td><td id="center">
<a href="<? echo $home; ?>/store/"><img src="<? echo $home; ?>/icon/store.png" height="20" alt="Store" style="vertical-align: -4px;"/>
<?php if (!empty($storenew)){echo '<span class="mitemCount">' . $storenew. '</span>';} ?></a>
</td><td id="left">
<a href="<? echo $home; ?>/photo/"><img src="<? echo $home; ?>/icon/photo.png" height="20" alt="Hình Ảnh" style="vertical-align: -4px;"/>
<?php if (!empty($thoigiananhmoi)){echo '<span class="mitemCount">' . $thoigiananhmoi. '</span>';} ?></a>
</td></tr></table>