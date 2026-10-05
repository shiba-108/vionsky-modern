<?php


echo'<div class="menu" style="margin: 5px 3px;color:#857f19;">';
$random_text = array('
<img src="https://static.mwork.vn/thumbs/unsafe/32x32/lh4.ggpht.com/KLIgLbexb2YBCzm1NEOXdTUIg-Y95k1frr9mDaS3PV9jEQxO6ZMmsuDOqn6CK_YpHQ" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Kungfu Pet - Chọi Sóc Siêu Hay<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1uR7hQs">Tải về</a>
','
<img src="https://static.mwork.vn/thumbs/unsafe/32x32/lh3.ggpht.com/-sgf2fVVPdLhY9bMBu4GJ3fAK1f60xtelZLoo4BqwkvMY0qvXyC8AIheeetcAMkvHg" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Farmery Nông trại nhiều girl xì tin nhất<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1ARdlKJ">Tải về</a>
','
<img src="https://static.mwork.vn/thumbs/unsafe/32x32/lh6.ggpht.com/8Q6Liu3dy89DxT0xA1jGiiH8bifLVMUWqiLcuZ3cJBsZYgLM7Ik16C3A_JO3owafQw" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Mộng Tây Du<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1wnVJp3">Tải về</a>
','
<img src="http://thumbnail.mobigate.vn/?u=%2Fdata%2Fpublish%2Fimages%2Fupload%2F2014%2F08%2F29%2Fda04dddd562376d9.png&w=32&h=32&ps=1" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;UCBrowser - Trình duyệt tiết kiệm tiền dung lượng 3G <br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://aff.mclick.mobi/ucweb/kenan">Tải về</a>
','
<img src="http://thumbnail.mobigate.vn/?u=%2Fdata%2Fpublish%2Fimages%2Fupload%2F2014%2F08%2F22%2F562612fbc5922a5e.png&w=32&h=32&ps=1" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Mobile office – Phần mềm văn phòng miễn phí.<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1pichsX">Tải về</a>
','
<img src="https://lh3.ggpht.com/LZtw8y4HQ4CTJATBOUqHDKXWQdoMBsVLbeg4ibZA0R0w64iqJmuRxRUCcrOrAhonVA=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;MoboMarket<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/YOV70X">Tải về</a>
','
<img src="https://lh3.ggpht.com/028w_ENJu8D81FtK9q8oGD8pDIVml4Bd2u91Uz_sWS-vzglkA1a01iSrs8lLPyaNbA=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Ongame Xì Tố<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1wzXXo2">Tải về</a>
','
<img src="https://lh5.ggpht.com/AzuQ8IHD7fYk__zb3DVi6PzIYwnYD3cwFDoiaSINa_sNMgwNgGjL9k-_v_K0I8wQ9QQ=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Công Thành Xưng Đế<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1uFssGd">Tải về</a>
','
<img src="https://lh3.ggpht.com/unt1UnGLbWlqAMkT_X7RqB3pW-4XMNVQ3XJgLyQJuwsYQcq8oUNM8ORDSWjd7iEp4VM=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Anh Hùng Chiến Hồn<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1u2dad0">Tải về</a>
','
<img src="https://lh5.ggpht.com/armoh5wOfI01_JGLkwnG1abR0RvYjYL3FDn4uK9-WDPRmCX2I7M05OOBZe9nFvMboKQ=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Tiến Lên Miền Nam<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1picg8h">Tải về</a>
','
<img src="https://lh4.ggpht.com/NBKUY14utCM2-tvVfLssVz2I8tkj-Jy-aiQQ09HG7ls2Yp3sCfa1LcYmcAxld03Sbg=w32" alt="icon" style="float: left;margin-right: 3px;"/>
&#160;Tây Du Giáng Ma - Tru Tiên<br/>
<img src="'.$home.'/icon/android.png" alt="icon" style="vertical-align: -3px;"/> <a href="http://bit.ly/1BJg4It">Tải về</a>
');
srand(time(1)); $sizeof = count($random_text);
$random = (rand()%$sizeof); print("$random_text[$random]");
echo'<span style="font-size:11px;color:#ddd;">|</span> <a style="color:#ff6666" href="nhan-iphone-6-mien-phi.php">Nhận Iphone 6</a>';
echo'</div>';


?>