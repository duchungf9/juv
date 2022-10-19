<?php

use Predis\Client;

$_ENV['COUNT_LOG'] = 0;
const sDS          = DIRECTORY_SEPARATOR;
const S_ROOT       = __DIR__ . sDS;

/**
 * Include library predis.
 */
require_once realpath(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$_ENV['REDIS2']    =  [
    'host'     => env('REDIS_HOST','127.0.0.1'),
    'port'     => 6379,
    'database' => 9, ];
const DATABASE = [
    'HOST'     => '127.0.0.1',
    'PORT'     => '3306',
    'USERNAME' => 'USERNAME',
    'DATABASE' => 'DATABASE',
    'PASSWORD' => 'PASSWORD',
];


/**
 * Exit callback log.
 *
 * @return void
 */
function exitProcessCallBack()
{
    $error = error_get_last();
    if (null != $error && ($_GET['debug'] ?? false)) {
        if (isset($_SERVER['SERVER_ADDR'])) {
            var_dump('=========== Loi chinh: ===========><br/><br/>');
            var_dump($error);
//
        }
    }

    try {
        slog($error);
    } catch (Exception $e) {
        if (null != $error && ($_GET['debug'] ?? false)) {
            var_dump($e);
            var_dump('error in slog function');
        }
    }

    if (null != $error && ($_GET['debug'] ?? false)) {
        checkWhyError();
        die;
    }
} //fn

/*
 * Function calll
 */
register_shutdown_function('exitProcessCallBack');
if (isset($_SERVER['REQUEST_URI'])) {
    blockBadChacterOnUrl(ltrim($_SERVER['REQUEST_URI'], '/'));
}

/**
 * Monitor visit realtime.
 *
 * @param mixed $message
 * @return mixed
 */
function slog(mixed $message = '')
{
    $_ENV['COUNT_LOG'] = $_ENV['COUNT_LOG'] + 1;
    $isHttps           = (isset($_SERVER['HTTPS'])    && $_SERVER['HTTPS']                  === 'on')
        || (isset($_SERVER['REQUEST_SCHEME'])         && $_SERVER['REQUEST_SCHEME']         === 'https')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    $fullLink = ($isHttps ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
    if (str_contains($fullLink, '/_debugbar') ||
        str_contains($fullLink, '/_tt') ||
        str_contains($fullLink, 'js.map')
    ) {
        return false;
    }
    $a     = (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2));
    $msg   = [
        'id'      => $_ENV['COUNT_LOG'],
        'time'    => round(microtime(true) - LARAVEL_START, 2),
        'ip'      => myGetIpAddress(),
        'url'     => $fullLink,
        'referer' => 'Refer ' . ($_SERVER['HTTP_REFERER'] ?? 'no'),
        'file'    => $a[0]['file'] . ':' . $a[0]['line'] . ' (' . (isset($a[1]['function']) ? $a[1]['function'] : '--') . ')',
        'method'  => ($_SERVER['REQUEST_METHOD'] ?? 'NONE') . ':' . json_encode(http_response_code()),
        'msg'     => $message,

    ];
    $redis = redisInit();
    $redis->publish('visit_all_slow', json_encode($msg));

    return  true;
}

function slogConsole(string $message = '')
{
    $_ENV['COUNTLOG'] = $_ENV['COUNTLOG'] ?? 0 + 1;
    $a                = (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2));
    $msg              = [
        'id'      => $_ENV['COUNTLOG'],
        'time'    => round(microtime(true) - LARAVEL_START, 2),
        'mem'     => round(memory_get_usage() / (1024 * 1024), 2),
        'file'    => $a[0]['file'] . ':' . $a[0]['line'] . ' (' . (isset($a[1]['function']) ? $a[1]['function'] : '--') . ')',
        'msg'     => $message,
    ];
    $redis = redisInit();
    $redis->publish('log_console_admin', json_encode($msg));
}//fn
/**
 * Get IP Adress info.
 */
function myGetIpAddress()
{
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && myValidateIp($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (str_contains($_SERVER['HTTP_X_FORWARDED_FOR'], ',')) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (myValidateIp($ip)) {
                    return $ip;
                }
            }
        } else {
            if (myValidateIp($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && myValidateIp($_SERVER['HTTP_X_FORWARDED'])) {
        return $_SERVER['HTTP_X_FORWARDED'];
    }
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && myValidateIp($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && myValidateIp($_SERVER['HTTP_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (!empty($_SERVER['HTTP_FORWARDED']) && myValidateIp($_SERVER['HTTP_FORWARDED'])) {
        return $_SERVER['HTTP_FORWARDED'];
    }

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'] ?? '';
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 *
 * @param mixed $ip
 */
function myValidateIp($ip)
{
    if ('unknown' === strtolower($ip)) {
        return false;
    }

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if (false !== $ip && -1 !== $ip) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) {
            return false;
        }
        if ($ip >= 167772160 && $ip <= 184549375) {
            return false;
        }
        if ($ip >= 2130706432 && $ip <= 2147483647) {
            return false;
        }
        if ($ip >= 2851995648 && $ip <= 2852061183) {
            return false;
        }
        if ($ip >= 2886729728 && $ip <= 2887778303) {
            return false;
        }
        if ($ip >= 3221225984 && $ip <= 3221226239) {
            return false;
        }
        if ($ip >= 3232235520 && $ip <= 3232301055) {
            return false;
        }
        if ($ip >= 4294967040) {
            return false;
        }
    }

    return true;
}

/**
 * Khởi tạo Redis hiện tại site.
 *
 * @return Client
 */
function redisInit()
{
    if (isset($_ENV['REDIS_SITE'])) {
        return $_ENV['REDIS_SITE'];
    }
    $_ENV['REDIS_SITE'] = new Client($_ENV['REDIS2']);

    return $_ENV['REDIS_SITE'];
}

/**
 * Dung de check khi loi.
 *
 * @return void
 */
function checkWhyError()
{
    try {
        $html = "<!DOCTYPE html><html lang='en'><meta> <meta charset='UTF-8'><meta name='robots' content='noindex,nofollow' /><title>Check status</title><body><ul style='font-size: 13px;font-family: \"Roboto\", sans-serif'>";
        /**
         * Check quyền ghi các thư mục.
         */
        $isWriteAbleArr = [
            S_ROOT . 'storage',
            S_ROOT . 'storage' . sDS . 'app',
            S_ROOT . 'storage' . sDS . 'app' . sDS . 'public',
            S_ROOT . 'storage' . sDS . 'framework',
            S_ROOT . 'storage' . sDS . 'framework' . sDS . 'cache',
            S_ROOT . 'storage' . sDS . 'framework' . sDS . 'sessions',
            S_ROOT . 'storage' . sDS . 'framework' . sDS . 'views',
            S_ROOT . 'storage' . sDS . 'logs',
            S_ROOT . 'bootstrap' . sDS . 'cache',
        ];
        $isAllWrite     = true;
        foreach ($isWriteAbleArr as $path) {
            if (!is_writable(dirname($path . sDS . 'isWrite.txt'))) {
                $html       .= '<li style="color:red">Chua có quyền ghi ' . $path . '</li>';
                $isAllWrite = false;
            }
        }
        if ($isAllWrite) {
            $html .= '<li style="color:green">Cau hinh ghi folder thanh cong</li>';
        }

        /**
         * Check connect database.
         */
        $host = DATABASE['HOST'];
        $port = 3306;
        $html .= pingServer($host, $port, 'Server database');

        /**
         * Check connect redis.
         */
        $host = $_ENV['REDIS2']['host'];
        $port = $_ENV['REDIS2']['port'];
        $html .= pingServer($host, $port, 'Server Redis');

        /**
         * Check time change two file bootrap cache.
         */
        $bootStrapPath         = S_ROOT . 'bootstrap' . sDS . 'cache' . sDS;
        $packageFileTimeModify = date('Y.m.d H:i:s.', filemtime($bootStrapPath . 'packages.php'));
        $serviceFileTimeModify = date('Y.m.d H:i:s.', filemtime($bootStrapPath . 'services.php'));
        $html                  .= "<li style='color:green'>Bootstrap package time: " . $packageFileTimeModify . '</li>';
        $html                  .= "<li style='color:green'>Bootstrap service time: " . $serviceFileTimeModify . '</li>';

        /*
         * Print error
         */
        $html .= '</ul></body></html>';
        echo $html;
    } catch (Exception $exception) {
        // var_dump('checkWhyError');
        var_dump('Co loi xay ra trong WhyError');
    }

    /**
     * @param $host
     * @param $port
     * @param $nameServer
     * @return string
     */
    function pingServer($host, $port, $nameServer)
    {
        $tB     = microtime(true);
        $errno  = '';
        $errstr = '';
        $fP     = fsockopen($host, $port, $errno, $errstr, 3);
        if (!$fP) {
            return "<li style='color:red'>Khong kết dc" . $nameServer . '</li>';
        }
        $tA = microtime(true);

        return '<li style="color:green">' . $nameServer . ' ket noi thanh cong sau ' . round((($tA - $tB) * 1000), 0) . 'ms</li>';
    }
}

/**
 * Check block các url chắc chắn không có.
 *
 * @param string $url
 */
function blockBadChacterOnUrl(string $url)
{
    //redirect if exit index.php in url
    redirectIndexPHPinUrl($url);

    $xssExtAccept   = ['html', 'php', '', 'rss', 'config', 'com', 'xml', 'vn'];
    $xssChacterDeny = [
        '@',
        '$',
        '<',
        '>',
        '(',
        ')',
        '{',
        '}',
        '[',
        ']',
        '"',
        '*',
        '%3C',
        '%3E',
        '%7D',
        '%7B',
        '%22',
        '\'',
        ';',
        ',',
        ':',
        '/u003c',
        '/u003e',
    ];

    //process check url
    $parseUrl = parse_url($url);
    $pathUrl  = isset($parseUrl['path']) ? $parseUrl['path'] : '';

    //Check nếu chứa ký tự vi phạm trong url sẽ hiện là 404 và exit luôn tránh phải xử lý gì nhiều
    if (textHasOneOfListWord($pathUrl, $xssChacterDeny)) {
        redirect302('/');
        exit();
    }
}//fnc

/**
 * Tự động remove index.php trong url và redirect về link mới sau khi remove.
 *
 * @param string $url
 */
function redirectIndexPHPinUrl(string $url)
{
    if (strpos($url, 'index.php') == true && strpos($url, 'oauth') < 0) {
        $request_uri_new = str_replace('index.php', '', $url);
        redirect301('https://' . $_SERVER['SERVER_NAME'] . '/' . $request_uri_new);
    }//if
}

/**
 * Đoạn text chứa một từ cần tìm sẽ trả ra true.
 *
 * @return bool
 */
function textHasWord(string $text, string $wordSearch)
{
    $pos = strpos($text, $wordSearch);
    if (false !== $pos) {
        return true;
    }

    return false;
} //fn

/**
 * Đoạn text chứa một trong các word nằm trong mảng sẽ trả ra true.
 *
 * @return bool
 */
function textHasOneOfListWord(string $text, array $arrayWordSearch)
{
    foreach ($arrayWordSearch as $wordSearch) {
        if (textHasWord($text, $wordSearch)) {
            return true;

            break;
        }
    }

    return false;
} //fn

/**
 * @description Chuyển hướng website 301
 */
function redirect301(string $url)
{
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $url);
} //end writeLogLdap

/**
 * @description Chuyển hướng website 302
 */
function redirect302(string $url)
{
    header('Location: ' . $url);
} //end writeLogLdap
