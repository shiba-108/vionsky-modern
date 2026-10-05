<?php $connect->query("UPDATE `users` SET `lastdate` = ". time() . " WHERE `id` = '1'"); ?>
<?php $dangonline1 = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0); 
$dangonline = $dangonline1 + 10;
   echo '
   </div><div class="footer"><div class="footer_info">
     <a href="http://fb.com/ducnghiaprovn"><img src="/icons/facebook-info.png" alt="Hình Ảnh"/></a>
     <a href="/lienhe.php"><img src="/icons/call-info.png" alt="Hình Ảnh"/></a>
     <a href="/"><img src="/icons/store-info.png" alt="Hình Ảnh"/></a><br><small><font color=blue><b>Đức NGhĩa 2016</b></font> 
</body></html>';