<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

defined('_IN_JOHNCMS') or die('Restricted access');


class statistic
{
    private $query_text = FALSE;
    private $http_referer = 'Undefined';
    private $stat_user_agent = '';
    private $request_uri = '';
    private $http_site = 'Undefined';
    private $operator = 'Undefined';
    private $country = 'Undefined';
    private $stat_ip_via_proxy = false;
    private $current_data = array();
    public static $hosty = false;
    public static $hity = false;
    private $robot = false;
    private $robot_type = false;
    private $new_host = 0;
    private $page_title = '';
    public static $system_time = false;
    

    function __construct($title = '')
    {
        self::$system_time = time() + core::$system_set['timeshift'] * 3600;
        $this->get_data();
        $this->get_query_text();
        $this->detect_oper_country();
        self::$hosty = $this->current_data['host'];
        self::$hity = $this->current_data['hity'];
        $_SESSION["host"] = $this->current_data['host'];
        $_SESSION["hity"] = $this->current_data['hity'];
        $this->page_title = isset($title) ? functions::check($title) : core::$system_set['copyright'];
        $time1 = date("d.m.y", $this->current_data['date']);
        $time2 = date("d.m.y", self::$system_time);
        if ($time1 !== $time2)
            $this->close_day();
        $this->check_host();
    }

    /*
    -----------------------------------------------------------------
    Сохраняем все данные
    -----------------------------------------------------------------
    */
    function __destruct()
    {
        if ($query_text !== FALSE) {
            $req = $connect->query("SELECT * FROM `stat_robots` WHERE `query` = '" . $this->
                query_text . "' AND `engine` = '" . $this->http_site . "' LIMIT 1");
            if ($req) { {
                $quer = $connect->fetch_array($req);
                $time1 = date("d.m.y", $quer['date']);
                $time2 = date("d.m.y", self::$system_time);
                if ($time1 !== $time2) {
                    $today = 1;
                } else {
                    $today = $quer['today'] + 1;
                }
                $count = $quer['count'] + 1;
                $connect->query("UPDATE `stat_robots` SET `date` = '" . self::$system_time .
                    "', `url` = '" . $this->http_referer . "', `ua` = '" . $this->stat_user_agent .
                    "', `ip` = '" . core::$ip . "', `count` = '" . $count . "', `today` = '" . $today .
                    "' WHERE `query` = '" . $this->query_text . "' AND `engine` = '" . $this->
                    http_site . "'");
            } else {
                $connect->query("INSERT INTO `stat_robots` SET `engine` = '" . $this->http_site .
                    "', `date` = '" . self::$system_time . "', `url` = '" . $this->http_referer .
                    "', `query` = '" . $this->query_text . "', `ua` = '" . $this->stat_user_agent .
                    "', `ip` = '" . core::$ip . "', `count` = '1', `today` = '1'");
            }
        }
        
        $sql = '';
        if ($this->stat_ip_via_proxy)
            $sql = ', `ip_via_proxy` = "' . long2ip($this->stat_ip_via_proxy) . '"';
        if (core::$user_id)
            $sql = ', `user` = "' . core::$user_id . '"';
        if ($this->robot)
            $sql .= ', `robot` = "' . $this->robot . '", `robot_type` = "' . $this->
                robot_type . '"';

        $connect->query("INSERT INTO `counter` SET `date` = '" . self::$system_time .
            "', `browser` = '" . $this->stat_user_agent . "', `ip` = '" . long2ip(core::$ip) .
            "', `ref` = '" . $this->http_referer . "', `host` = '" . $this->new_host .
            "', `site` = '" . $this->http_site . "', `pop` = '" . $this->request_uri .
            "', `head` = '" . $this->page_title . "', `operator` = '" . $this->operator .
            "', `country` = '" . $this->country . "' " . $sql . ";");

    }

    /*
    -----------------------------------------------------------------
    Получаем исходные данные
    -----------------------------------------------------------------
    */
    private function get_data()
    {
        $this->stat_user_agent = functions::check(substr($_SERVER['HTTP_USER_AGENT'], 0,
            200));
        if (strpos($this->stat_user_agent, "Opera Mini") !== false) {
            $this->stat_user_agent = isset($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"]) ?
                'Opera Mini: ' . $_SERVER["HTTP_X_OPERAMINI_PHONE_UA"] : $this->stat_user_agent;
        }

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $stat_ip_via_proxy = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
            $stat_ip_via_proxy = trim($stat_ip_via_proxy[0]);
            $this->stat_ip_via_proxy = isset($stat_ip_via_proxy) && core::ip_valid($stat_ip_via_proxy) &&
                core::$ip !== ip2long($stat_ip_via_proxy) ? ip2long($stat_ip_via_proxy) : false;
        }

        $request_uri = urldecode(functions::check($_SERVER['REQUEST_URI']));
        $this->request_uri = strtok($request_uri, '?');
        $this->http_referer = isset($_SERVER['HTTP_REFERER']) ? functions::check($_SERVER['HTTP_REFERER']) :
            $this->http_referer;

        if (isset($_SERVER['HTTP_REFERER'])) {
            $http_site = parse_url($_SERVER['HTTP_REFERER']);
            $this->http_site = isset($http_site['host']) ? functions::check($http_site['host']) :
                $this->http_site;
        }

        $this->current_data = $connect->fetch_array($connect->query("SELECT MAX(`date`) AS date, MAX(`host`) AS host, MAX(hits) AS hity FROM `counter`"));

        $rob_detect = new RobotsDetect($this->stat_user_agent);
        $this->robot = $rob_detect->getNameBot();
        $this->robot_type = $rob_detect->getTypeBot();

    }

    /*
    -----------------------------------------------------------------
    Функция вывода русского названия месяца
    -----------------------------------------------------------------
    */
    public static function month($str)
    {
        $en = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
            "Nov", "Dec");
        $rus = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct", "Nov", "Dec");
        $str = str_replace($en, $rus, $str);
        return $str;
    }


    /*
    -----------------------------------------------------------------
    Перекодировка запросов из поисковиков
    -----------------------------------------------------------------
    */
    private function to_utf($zapros)
    {
        if (mb_check_encoding($zapros, 'UTF-8')) {
        } elseif (mb_check_encoding($zapros, 'windows-1251')) {
            $zapros = iconv("windows-1251", "UTF-8", $zapros);
        } elseif (mb_check_encoding($zapros, 'KOI8-R')) {
            $zapros = iconv("KOI8-R", "UTF-8", $zapros);
        }
        return $zapros;
    }

    /*
    -----------------------------------------------------------------
    Определение оператора и страны
    -----------------------------------------------------------------
    */
    private function detect_oper_country()
    {
        $ip_check = $this->stat_ip_via_proxy !== false ? $this->stat_ip_via_proxy : core::
            $ip;
        $ip_base = $connect->query("SELECT `operator`, `country` FROM `counter_ip_base` WHERE '" .
            $ip_check . "' BETWEEN `start` AND `stop` LIMIT 1;");
        if ($connect->query("SELECT * FROM ...")$ip_base) > 0) {
            $oper = $connect->fetch_array($ip_base);
            $this->operator = $oper['operator'];
            $this->country = $oper['country'];
        }
    }


    /*
    -----------------------------------------------------------------
    Получаем текст поискового запроса
    -----------------------------------------------------------------
    */
    private function get_query_text()
    {
        $http_ref = str_replace("&amp;", "&", $this->http_referer);
        if (preg_match("/google./i", $this->http_referer) || preg_match("/bing./i", $this->
            http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['q']));
        } elseif (preg_match("/yandex./i", $this->http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['text']));
        } elseif (preg_match("/nigma./i", $this->http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['s']));
        } elseif (preg_match("/search.qip./i", $this->http_referer) || preg_match("/rambler./i",
        $this->http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['query']));
        } elseif (preg_match("/aport./i", $this->http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['r']));
        } elseif (preg_match("/yahoo./i", $this->http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check(urldecode($query_text['p']));
        } elseif (preg_match("/mail./i", $this->http_referer) || preg_match("/gogo./i", $this->
        http_referer)) {
            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = functions::check($this->to_utf(urldecode($query_text['q'])));
        }
    }


    /*
    -----------------------------------------------------------------
    Проверяем хост
    -----------------------------------------------------------------
    */
    private function check_host()
    {
        if (!isset($_COOKIE['hosty'])) {
            setcookie('hosty', '1', strtotime(date("d F y", self::$system_time + 86400)));

            $sql = ($this->stat_ip_via_proxy) ? " AND `ip_via_proxy` = '" . long2ip($this->
                stat_ip_via_proxy) . "'" : '';
            $ip = ($this->stat_ip_via_proxy) ? long2ip($this->stat_ip_via_proxy) : long2ip(core::
                $ip);
            $ip_time = self::$system_time - 900; // Время в течении которого считать 1 ip одним юзером.
            $ip_check = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE (`ip` = '" .
                $ip . "' OR `ip_via_proxy` = '" . $ip . "') AND `date` > '" . $ip_time . "';"),
                0);
            if($ip_check == 0){
            $db_check = mysqli_result($connect->query("SELECT COUNT(*) FROM `counter` WHERE `browser` = '" .
                $this->stat_user_agent . "' AND `ip` = '" . long2ip(core::$ip) . "'" . $sql .
                ";"), 0);
                
            if ($db_check == 0 && !$this->robot)
                $this->new_host = self::$hosty + 1;
            }
        }
    }


    /*
    -----------------------------------------------------------------
    Закрываем прошедший день
    -----------------------------------------------------------------
    */
    private function close_day()
    {
        $where_time = strtotime(date("d F y", self::$system_time));
        $where_time2 = $where_time - 86400;
        $sql = "(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" . $where_time2 .
            "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%yandex%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%mail%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%rambler%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%google%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%gogo%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%yahoo%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%bing%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%nigma%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%qip%') UNION ALL (SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '" .
            $where_time2 . "' AND `date` < '" . $where_time .
            "' AND `engine` LIKE '%aport%')";

        $query = $connect->query($sql);
        $count_query = array();
        while ($result_array = $connect->fetch_array($query)) {
            $count_query[] = $result_array[0];
        }

        $connect->query("insert into `countersall` values('" . $this->current_data['date'] .
            "','" . self::$hity . "','" . self::$hosty . "','" . $count_query[0] . "','" . $count_query[2] .
            "', '" . $count_query[3] . "', '" . $count_query[1] . "', '" . $count_query[4] .
            "', '" . $count_query[5] . "', '" . $count_query[6] . "', '" . $count_query[7] .
            "', '" . $count_query[8] . "', '" . $count_query[9] . "');");

        $connect->query("TRUNCATE TABLE `counter`;");

        self::$hity = 0;
        self::$hosty = 0;
        $_SESSION["host"] = 0;
        $_SESSION["hity"] = 0;
        setcookie('hosty', '');

    }


}

?>