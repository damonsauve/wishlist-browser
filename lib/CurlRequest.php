<?php

class CurlRequest
{
    protected $_url;
    protected $_followlocation;
    protected $_timeout;
    protected $_maxRedirects;
    protected $_binaryTransfer;
    protected $_cookieFileLocation = './cookie.txt';
    protected $_useragent = 'PHP Curl Request';
    protected $_referer = null;
    protected $_response;
    protected $_status;

    public function __construct(
        $url,
        $followlocation     = true,
        $timeOut            = 30,
        $maxRedirecs        = 4,
        $binaryTransfer     = false,
        $includeHeader      = false,
        $noBody             = false
    )
    {
        $this->_url             = $url;
        $this->_followlocation  = $followlocation;
        $this->_timeout         = $timeOut;
        $this->_maxRedirects    = $maxRedirecs;
        $this->_noBody          = $noBody;
        $this->_includeHeader   = $includeHeader;
        $this->_binaryTransfer  = $binaryTransfer;

        $this->_cookieFileLocation = dirname(__FILE__).'/cookie.txt';
    }

    public function setReferer($referer)
    {
        $this->_referer = $referer;
    }

    public function setUserAgent($userAgent)
    {
        $this->_useragent = $userAgent;
    }

    public function createCurl($url = 'nul')
    {
        if ($url != 'nul')
        {
            $this->_url = $url;
        }

        $s = curl_init();

        curl_setopt($s,CURLOPT_URL,             $this->_url);
        curl_setopt($s,CURLOPT_HTTPHEADER,      array('Except:'));
        curl_setopt($s,CURLOPT_TIMEOUT,         $this->_timeout);
        curl_setopt($s,CURLOPT_MAXREDIRS,       $this->_maxRedirects);
        curl_setopt($s,CURLOPT_RETURNTRANSFER,  true);
        curl_setopt($s,CURLOPT_FOLLOWLOCATION,  $this->_followlocation);
        curl_setopt($s,CURLOPT_COOKIEJAR,       $this->_cookieFileLocation);
        curl_setopt($s,CURLOPT_COOKIEFILE,      $this->_cookieFileLocation);
        curl_setopt($s,CURLOPT_USERAGENT,       $this->_useragent);
        curl_setopt($s,CURLOPT_REFERER,         $this->_referer);

        $this->_response = curl_exec($s);
        $this->_status = curl_getinfo($s,CURLINFO_HTTP_CODE);

        curl_close($s);
    }

    public function getResponse()
    {
        return $this->_response;
    }
}
?>
