<?php
//by FlySelf
session_name('SESID');//имя сессии
session_start(); //начало сессии
$img = imageCreateFromGIF('icons/counter.gif');//берем изображение для счетчика
$color_hosty = imagecolorallocate($img, 255,255,255);//цвет текста хостов
$color2_hity = imagecolorallocate($img, 11,11,107);//цвет текста хитов
ImageString($img, 1, 3, 4, $_SESSION["host"], $color_hosty);//наносим хосты на счетчик
ImageString($img, 1, 38, 4, $_SESSION["hity"], $color_hity);//наносим хиты на счетчик
Header("Content-type: image/gif");
ImageGIF($img);
ImageDestroy($img);
?>