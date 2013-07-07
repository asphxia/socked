<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @copyright Copyleft
 */
namespace Asphyxia\Socked;

/**
 * Socked is an abstraction layer for PHP's cURL functions.
 * 
 * @package Asphyxia\Socked
 */
class Socked {

    public static function fetch($url, $file) {
        $command = 'curl --socks5-hostname 127.0.0.1:9050 -A "Mozilla/5.0 (X11; Linux i686; rv:7.0.1) Gecko/20100101 Firefox/7.0.1" --cookie PHPSESSID=62b471618147bb026fd0af1ead8467c8 ' . $url . ' -o ' . $file;
        return shell_exec($command);
    }
    
}
