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

	private $proto = '--socks5-hostname';
	private $proxy = '127.0.0.1:9050';
	private $ua = 'Mozilla/5.0 (X11; Linux i686; rv:7.0.1) Gecko/20100101 Firefox/7.0.1';
	private $params = '-s';
	private $session = 'c95as9fp2t7d67moe20ftdq8u6';
	private $debug = true;


	public function __construct($options) {
		$this->setProtocol(isset($options['protocol'])    ? $options['protocol']  : $this->proto);
		$this->setProxy(isset($options['proxy'])          ? $options['proxy']     : $this->proxy);
		$this->setUserAgent(isset($options['ua'])         ? $options['ua']        : $this->ua);
		$this->setParams(isset($options['params'])        ? $options['params']    : $this->params);
		$this->setSession(isset($options['session'])      ? $options['session']   : $this->session);
		$this->setDebug(isset($options['debug'])          ? $options['debug']     : $this->debug);
	}

    public static function fetch($url, $file, $options = null) {
    	$file = ' -o "' . $file . '" ';
    	$socked = new Socked($options);
        return $socked->exec($url, $file);
    }

    public static function post($url, $fields, $options = null) {
    	$arrFields = array();
    	foreach ($fields as $field => $value) {
    		array_push($arrFields, " -F $field=$value ");
    	}
    	$fields = join(' ', $arrFields);

    	$socked = new Socked($options);
        return $socked->exec($url, $fields);
    }

    private function exec($url, $params) {
		$command = 'curl '.$this->params.' '.$this->proto.' '.$this->proxy.' -A "'.$this->ua.'" --cookie PHPSESSID='.$this->session.' '.$url .' '.$params;
		if ($this->debug) echo $command;
        return shell_exec($command);
    }
    
    public function setProtocol($proto) {
    	$this->proto = $proto;
    }
    
    public function setProxy($proxy) {
    	$this->proxy = $proxy;
    }

    public function setUserAgent($ua) {
    	$this->ua = $ua;
    }

    public function setParams($params) {
    	$this->params = $params;
    }

    public function setSession($session) {
    	$this->session = $session;
    }

    public function setDebug($debug) {
    	$this->debug = $debug;
    }
}
