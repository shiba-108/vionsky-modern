<?php
defined('_IN_JOHNCMS') or die('Restricted access');
class bbcode extends core
{
public static function skill($var)
{
$var = preg_replace('#tag:([\w\d]{2,})#si', '@<span style="color:#668a3b;">$1</span></a>', $var);
$var = self::parse_time($var);  
$var = self::highlight_chat($var);
return $var;
}
public static function tags($var)
{
$var = preg_replace('#tag:([\w\d]{2,})#si', '@<span style="color:#668a3b;">$1</span></a>', $var);
$var = self::parse_time($var);  
$var = self::youtube($var);
$var = self::iconyoutube($var);
$var = self::highlight_code($var);
$var = self::highlight_text($var);
$var = self::highlight_url($var);
$var = self::highlight_bb($var);
$var = self::OLD_highlight_url($var);
return $var;
}
public static function youtube($var) 
{ 
if (!function_exists('process_youtube')) { 
function process_youtube($id) 
{ 
return '<div class="youtube"><iframe width="100%" height="360" src="http://www.youtube.com/embed/' . $id[4] . '?showinfo=0&iv_load_policy=3&modestbranding=1&nologo=1&vq=large" frameborder="0" allowfullscreen="1"></iframe></div>'; 
}
}
return preg_replace_callback('~\\[youtube\\](https?:\/\/|www.)(.*)youtube.com(.*)v=(.*)\/?\\[/youtube\\]~i', 'process_youtube', $var); 
}


// bbcode video
public static function iconyoutube($var) { 
if (!function_exists('process_iconyoutube')) { 
function process_iconyoutube($id) { 
global $is_mobile; 
return '<img src="http://img.youtube.com/vi/' . $id[4] . '/0.jpg" width="30" height="30" alt="" style="padding: 1px;border: 1px solid #d1d1d1;"/>'; 
} }
return preg_replace_callback('~\\[iconyoutube\\](https?:\/\/|www.)(.*)youtube.com(.*)v=(.*)\/?\\[/iconyoutube\\]~i', 'process_iconyoutube', $var); }
// het

    private static function parse_time($var)
    {
        if (!function_exists('process_time')) {
            function process_time($time)
            {
                $shift = (core::$system_set['timeshift'] + core::$user_set['timeshift']) * 3600;
                if($out = strtotime($time)){
                    return date("d.m.Y / H:i", $out + $shift);
                } else {
                    return false;
                }
            }
        }
        return preg_replace(array('#\[time\](.+?)\[\/time\]#se'), array("''.process_time('$1').''"), $var);
    }


    public static function highlight_url($text)
    {
        if (!function_exists('url_callback')) {
            function url_callback($type, $whitespace, $url, $relative_url)
            {
                $orig_url = $url;
                $orig_relative = $relative_url;
                $url = htmlspecialchars_decode($url);
                $relative_url = htmlspecialchars_decode($relative_url);
                $text = '';
                $chars = array('<', '>', '"');
                $split = false;
                foreach ($chars as $char) {
                    $next_split = strpos($url, $char);
                    if ($next_split !== false) {
                        $split = ($split !== false) ? min($split, $next_split) : $next_split;
                    }
                }
                if ($split !== false) {
                    $url = substr($url, 0, $split);
                    $relative_url = '';
                } else if ($relative_url) {
                    $split = false;
                    foreach ($chars as $char) {
                        $next_split = strpos($relative_url, $char);
                        if ($next_split !== false) {
                            $split = ($split !== false) ? min($split, $next_split) : $next_split;
                        }
                    }
                    if ($split !== false) {
                        $relative_url = substr($relative_url, 0, $split);
                    }
                }
                $last_char = ($relative_url) ? $relative_url[strlen($relative_url) - 1] : $url[strlen($url) - 1];
                switch ($last_char)
                {
                    case '.':
                    case '?':
                    case '!':
                    case ':':
                    case ',':
                        $append = $last_char;
                        if ($relative_url) $relative_url = substr($relative_url, 0, -1);
                        else $url = substr($url, 0, -1);
                        break;

                    default:
                        $append = '';
                        break;
                }
                $short_url = (mb_strlen($url) > 1000) ? mb_substr($url, 0, 30) . '...' . mb_substr($url, -5) : $url;
                switch ($type)
                {
                    case 1:
                        $relative_url = preg_replace('/[&?]sid=[0-9a-f][32]$/', '', preg_replace('/([&?])sid=[0-9a-f][32]&/', '$1', $relative_url));
                        $url = $url . '/' . $relative_url;
                        $text = $relative_url;
                        if (!$relative_url) {
                            return $whitespace . $orig_url . '/' . $orig_relative;
                        }
                        break;

                    case 2:
                        $text = $short_url;
                        if (!isset(core::$user_set['direct_url']) || !core::$user_set['direct_url']) {
                            $url = ''. $url.'';
                        }
                        break;

                    case 3:
                        $url = 'http://' . $url;
                        $text = $short_url;
                        if (!isset(core::$user_set['direct_url']) || !core::$user_set['direct_url']) {
                            $url = ''. $url.'';
                        }
                        break;

                    case 4:
                        $text = $short_url;
                        $url = 'mailto:' . $url;
                        break;
                }
                $url = htmlspecialchars($url);
                $text = htmlspecialchars($text);
                $append = htmlspecialchars($append);
                return $whitespace . '<a href="' . $url . '">' . $text . '</a>' . $append;
            }
        }

        static $url_match;
        static $url_replace;

        if (!is_array($url_match)) {
            $url_match = $url_replace = array();

            // Обработка внутренние ссылки
            $url_match[] = '#(^|[\n\t (>.])(' . preg_quote(core::$system_set['homeurl'], '#') . ')/((?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])*(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?)#ieu';
            $url_replace[] = "url_callback(1, '\$1', '\$2', '\$3')";

            // Обработка обычных ссылок типа xxxx://aaaaa.bbb.cccc. ...
            $url_match[] = '#(^|[\n\t (>.])([a-z][a-z\d+]*:/{2}(?:(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])+|[0-9.]+|\[[a-zа-яё0-9.]+:[a-zа-яё0-9.]+:[a-zа-яё0-9.:]+\])(?::\d*)?(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?)#ieu';
            $url_replace[] = "url_callback(2, '\$1', '\$2', '')";

            // Обработка сокращенных ссылок, без указания протокола "www.xxxx.yyyy[/zzzz]"
            $url_match[] = '#(^|[\n\t (>])(www\.(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])+(?::\d*)?(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F][2])*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F][2])*)?)#ieu';
            $url_replace[] = "url_callback(3, '\$1', '\$2', '')";
        }
        return preg_replace($url_match, $url_replace, $text);
    }

    /*
    -----------------------------------------------------------------
    Удаление bbCode из текста
    -----------------------------------------------------------------
    */
    static function notags($var = '')
    {
        $var = preg_replace('#\[color=(.+?)\](.+?)\[/color]#si', '$2', $var);
        $var = preg_replace('!\[bg=(#[0-9a-f][3]|#[0-9a-f][6]|[a-z\-]+)](.+?)\[/bg]!is', '$2', $var);
        $var = preg_replace('#\[spoiler=(.+?)\]#si', '$2', $var);
        $var = preg_replace('#\[size=(.+?)\](.+?)\[/size]#si', '$2', $var);
        $replace = array(
            '[img]' => '', 
            '[/img]' => '',
            '[center]' => '', 
            '[/center]' => '',
            '[green]' => '',
            '[/green]' => '',
            '[red]' => '',
            '[/red]' => '',
            '[blue]' => '',
            '[/blue]' => '',
            '[br]' => '',
            '[b]' => '',
            '[/b]' => '',
            '[i]' => '',
            '[/i]' => '',
            '[u]' => '',
            '[/u]' => '',
            '[s]' => '',
            '[/s]' => '',
            '[quote]' => '',
            '[/quote]' => '',
            '[c]' => '',
            '[/c]' => '',
            '[*]' => '',
            '[/*]' => ''
        );
        return strtr($var, $replace);
    }




    static function nobb($var = '')
    {
        $var = preg_replace('#\[color=(.+?)\](.+?)\[/color]#si', '$2', $var);
        $var = preg_replace('!\[bg=(#[0-9a-f][3]|#[0-9a-f][6]|[a-z\-]+)](.+?)\[/bg]!is', '$2', $var);
        $var = preg_replace('#\[spoiler=(.+?)\]#si', '$2', $var);
        $var = preg_replace('#\[size=(.+?)\](.+?)\[/size]#si', '$2', $var);
        $replace = array(
            '[big]' => '', 
            '[/big]' => '',
            '[s]' => '', 
            '[/s]' => '',
            '[small]' => '', 
            '[/small]' => '',
            '[c]' => '', 
            '[/c]' => '',
            'lồn' => '***',
            'cặc' => '***',
            'đụng' => 'đụng',
            'đụ' => '**',
            'sex' => '***',
            'đéo' => '***',
            'gocvuichoi.net' => '*****'
        );
        return strtr($var, $replace);
    }



private static function highlight_code($var)
{
if (!function_exists('process_code')) {
function process_code($code)
{
$code = strtr($code, array('<br />' => '', '\\' => 'slash_JOHNCMS'));
$code = html_entity_decode(trim($code), ENT_QUOTES, 'UTF-8');
$code = highlight_string(stripslashes($code), true);
$code = strtr($code, array('slash_JOHNCMS' => '&#92;', ':' => '&#58;', '[' => '&#91;'));
return '<div class="ma">
<div class="code"><font color="black">Mã:</font></div>
<div class="coder"><code>' . $code . '</code></div></div>';
}
}
return preg_replace(array('#\[code\](.+?)\[\/code\]#se'), array("''.process_code('$1').''"), str_replace("]\n", "]", $var));
}





/// bbcode textarea 
private static function highlight_text($var)
{
if (!function_exists('process_text')) {
function process_text($textarea)
{
$textarea = nl2br(str_replace('<br/>', " ","".$textarea));
$textarea = htmlentities($textarea, ENT_QUOTES, 'UTF-8');
return '<div class="menu"><textarea>' . $textarea. '</textarea></div>';
}
}
return preg_replace(array('#\[text\](.+?)\[\/text\]#se'), array("''.process_text('$1').''"), str_replace("]\n", "]", $var));
}



    private static function OLD_highlight_url($var)
    {
        if (!function_exists('process_url')) {
            function process_url($url)
            {
                $home = parse_url(core::$system_set['homeurl']);
                $tmp = parse_url($url[1]);
                    if ($home['host'] == $tmp['host'] || isset(core::$user_set['direct_url']) && core::$user_set['direct_url']) {
                        return '<a href="' . $url[1] . '">' . $url[2] . '</a>';
                    } else {
                        return '<a href="' . $url[1] . '">' . $url[2] . '</a>';
                    }
            }
        }
return preg_replace_callback('~\\[url=(.+?)](.+?)\\[/url\\]~', 'process_url', $var);
    }

    private static function highlight_bb($var)
    {
        // Список поиска
        $search = array(
            '#\[img](.+?)\[/img]#is', // images  
            '#\[center](.+?)\[/center]#is', // images  
            '#\[taive](.+?)\[/taive]#is', // images 
            '#\[b](.+?)\[/b]#is', // Жирный
            '#\[br]#is', // Жирный
            '#\[h1](.+?)\[/h1]#is', // Жирный
            '#\[h2](.+?)\[/h2]#is', // Жирный
            '#\[h3](.+?)\[/h3]#is', // Жирный
            '#\[h4](.+?)\[/h4]#is', // Жирный
            '#\[i](.+?)\[/i]#is', // Курсив
            '#\[u](.+?)\[/u]#is', // Подчеркнутый
            '#\[red](.+?)\[/red]#is', // Красный
            '#\[green](.+?)\[/green]#is', // Зеленый
            '#\[blue](.+?)\[/blue]#is', // Синий
            '!\[color=(#[0-9a-f][3]|#[0-9a-f][6]|[a-z\-]+)](.+?)\[/color]!is', // Цвет шрифта
            '!\[bg=(#[0-9a-f][3]|#[0-9a-f][6]|[a-z\-]+)](.+?)\[/bg]!is', // Цвет фона
            '#\[(quote|c)](.+?)\[/(quote|c)]#is', // Цитата
            '#\[\*](.+?)\[/\*]#is', // Список
            '#\[spoiler=(.+?)](.+?)\[/spoiler]#is' // Спойлер
        );
        // Список замены
        $replace = array(
            '<div><img id="hinhanh" src="$1" alt="Hình ảnh"/></div>',
            '<span style="text-align: center;">$1</span>',
            '<div class="download"><b>$1</b></div>',
            '<span style="font-weight: bold">$1</span>', // Жирный
            '<br/>', // Жирный 
            '<h1>$1</h1>', // Жирный
            '<h2>$1</h2>', // Жирный
            '<h3>$1</h3>', // Жирный
            '<h4>$1</h4>', // Жирный
            '<span style="font-style:italic">$1</span>', // Курсив
            '<span style="text-decoration:underline">$1</span>', // Подчеркнутый
            '<span style="color:red">$1</span>', // Красный
            '<span style="color:green">$1</span>', // Зеленый
            '<span style="color:blue">$1</span>', // Синий
            '<span style="color:$1">$2</span>', // Цвет шрифта
            '<span style="background-color:$1">$2</span>', // Цвет фона
            '<span class="quote" style="display:block">$2</span>', // Цитата
            '<span class="bblist">$1</span>', // Список
            '<div><div class="spoilerhead" style="cursor:pointer;" onclick="var _n=this.parentNode.getElementsByTagName(\'div\')[1];if(_n.style.display==\'none\'){_n.style.display=\'\';}else{_n.style.display=\'none\';}">$1 (+/-)</div><div class="spoilerbody" style="display:none">$2</div></div>' // Спойлер
        );
        return preg_replace($search, $replace, $var);
    }
private static function highlight_chat($var)
    {
        // Список поиска
        $search = array(
         
            '#\[b](.+?)\[/b]#is', // Жирный
         
            '#\[i](.+?)\[/i]#is', // Курсив
            '#\[u](.+?)\[/u]#is', // Подчеркнутый
            '#\[red](.+?)\[/red]#is', // Красный
            '#\[green](.+?)\[/green]#is', // Зеленый
            '#\[blue](.+?)\[/blue]#is', // Синий
            '!\[color=(#[0-9a-f][3]|#[0-9a-f][6]|[a-z\-]+)](.+?)\[/color]!is', // Цвет шрифта
         
        );
        // Список замены
        $replace = array(
          
            '<span style="font-weight: bold">$1</span>', // Жирный
           
            '<span style="font-style:italic">$1</span>', // Курсив
            '<span style="text-decoration:underline">$1</span>', // Подчеркнутый
            '<span style="color:red">$1</span>', // Красный
            '<span style="color:green">$1</span>', // Зеленый
            '<span style="color:blue">$1</span>', // Синий
            '<span style="color:$1">$2</span>' // Цвет шрифта
         // Спойлер
        );
        return preg_replace($search, $replace, $var);
    }

    /*
    -----------------------------------------------------------------
    Панель кнопок bbCode (для компьютеров)
    -----------------------------------------------------------------
    */
    public static function auto_bb($form, $field)
    {
        $colors = array(
            'ffffff', 'bcbcbc', '708090', '6c6c6c', '454545',
            'fcc9c9', 'fe8c8c', 'fe5e5e', 'fd5b36', 'f82e00',
            'ffe1c6', 'ffc998', 'fcad66', 'ff9331', 'ff810f',
            'd8ffe0', '92f9a7', '34ff5d', 'b2fb82', '89f641',
            'b7e9ec', '56e5ed', '21cad3', '03939b', '039b80',
            'cac8e9', '9690ea', '6a60ec', '4866e7', '173bd3',
            'f3cafb', 'e287f4', 'c238dd', 'a476af', 'b53dd2'
        );
        $i = 1;
        $font_color = '';
        $bg_color = '';
        foreach ($colors as $value) {
            $font_color .= '<a href="javascript:tag(\'[color=#' . $value . ']\', \'[/color]\'); show_hide(\'color\');" style="background-color:#' . $value . ';"></a>';
            $bg_color .= '<a href="javascript:tag(\'[bg=#' . $value . ']\', \'[/bg]\'); show_hide(\'bg\');" style="background-color:#' . $value . ';"></a>';
        }
        $smileys = !empty(self::$user_data['smileys']) ? unserialize(self::$user_data['smileys']) : '';
        if (!empty($smileys)) {
            $res_sm = '';
            $bb_smileys = '<small><a href="' . self::$system_set['homeurl'] . '/pages/faq.php?act=my_smileys">' . self::$lng['edit_list'] . '</a></small><br />';
            foreach ($smileys as $value)
                $res_sm .= '<a href="javascript:tag(\':' . $value . '\', \':\'); show_hide(\'sm\');">:' . $value . ':</a> ';
            $bb_smileys .= functions::smileys($res_sm, self::$user_data['rights'] >= 1 ? 1 : 0);
        } else {
            $bb_smileys = '<small><a href="' . self::$system_set['homeurl'] . '/pages/faq.php?act=smileys">' . self::$lng['add_smileys'] . '</a></small>';
        }
        $out = '<style>.color a {float:left; display: block; width: 10px; height: 10px; margin: 1px; border: 1px solid black;}</style>
            <script language="JavaScript" type="text/javascript">
            function tag(text1, text2) {
              if ((document.selection)) {
                document.' . $form . '.' . $field . '.focus();
                document.' . $form . '.document.selection.createRange().text = text1+document.' . $form . '.document.selection.createRange().text+text2;
              } else if(document.forms[\'' . $form . '\'].elements[\'' . $field . '\'].selectionStart!=undefined) {
                var element = document.forms[\'' . $form . '\'].elements[\'' . $field . '\'];
                var str = element.value;
                var start = element.selectionStart;
                var length = element.selectionEnd - element.selectionStart;
                element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
              } else {
                document.' . $form . '.' . $field . '.value += text1+text2;
              }
            }
            function show_hide(elem) {
              obj = document.getElementById(elem);
              if( obj.style.display == "none" ) {
                obj.style.display = "block";
              } else {
                obj.style.display = "none";
              }
            }
            </script>
            <a href="javascript:tag(\'[b]\', \'[/b]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/bold.gif" alt="b" title="' . self::$lng['tag_bold'] . '" border="0"/></a>
            <a href="javascript:tag(\'[i]\', \'[/i]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/italics.gif" alt="i" title="' . self::$lng['tag_italic'] . '" border="0"/></a>
            <a href="javascript:tag(\'[u]\', \'[/u]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/underline.gif" alt="u" title="' . self::$lng['tag_underline'] . '" border="0"/></a>
            <a href="javascript:tag(\'[s]\', \'[/s]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/strike.gif" alt="s" title="' . self::$lng['tag_strike'] . '" border="0"/></a>
            <a href="javascript:tag(\'[*]\', \'[/*]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/list.gif" alt="s" title="' . self::$lng['tag_list'] . '" border="0"/></a>
            <a href="javascript:tag(\'[spoiler=]\', \'[/spoiler]\');"><img src="../images/bb/sp.gif" alt="spoiler" title="Спойлер" border="0"/></a>
            <a href="javascript:tag(\'[c]\', \'[/c]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/quote.gif" alt="quote" title="' . self::$lng['tag_quote'] . '" border="0"/></a>
            <a href="javascript:tag(\'[php]\', \'[/php]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/php.gif" alt="cod" title="' . self::$lng['tag_code'] . '" border="0"/></a>
            <a href="javascript:tag(\'[url=]\', \'[/url]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/link.gif" alt="url" title="' . self::$lng['tag_link'] . '" border="0"/></a>
            <a href="javascript:show_hide(\'color\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/color.gif" title="' . self::$lng['color_text'] . '" border="0"/></a>
            <a href="javascript:show_hide(\'bg\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/color_bg.gif" title="' . self::$lng['color_bg'] . '" border="0"/></a>';
        
        if (self::$user_id) {
            $out .= ' <a href="javascript:show_hide(\'sm\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/smileys.gif" alt="sm" title="' . self::$lng['smileys'] . '" border="0"/></a><br />
                <table id="sm" style="display:none"><tr><td>' . $bb_smileys . '</td></tr></table>
                <div id="sm" style="display:none">'.$bb_smileys.'</div>';
        }else $out .= '<br />';
        $out .= '<div id="color" class="bbpopup" style="display:none;">Шрифт: '.$font_color.'</div>'.
            '<div id="bg" class="bbpopup" style="display:none">Фон: '.$bg_color.'</div>';
        return $out;
    }
}