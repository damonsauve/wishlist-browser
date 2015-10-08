<?php

class Cache
{
    private $cache;
    private $key;
    private $enable_cache = 0;

    function __construct($cache)
    {
        $this->setCache($cache);
    }

    private function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function setCacheKey($key)
    {
        $this->key = $key;
    }

    public function enableCache($bool)
    {
        $this->enable_cache = $bool;
    }

    private function isCacheEnabled()
    {
        if ($this->enable_cache == false)
        {
            print "cache is off<p>";

            return false;
        }

        return true;
    }

    public function loadCache($data)
    {
        $this->cache->set(
            $this->key,
            json_encode($data)
        );
    }

    public function checkCache()
    {
        if ($this->isCacheEnabled())
        {
            $keys = $this->cache->KEYS(
                $this->key . '*'
            );

            $data = array();

            foreach($keys as $k => $v)
            {
                $data[] = json_decode(
                    $this->cache->GET($v)
                );
            }

            return $data;
        }
    }

    private function dump($value, $label)
    {
        if(!isset($label))
        {
            $label = '';
        }
        else
        {
            $label = '<b>'. $label . ' = </b>';
        }
        print '<pre>';
        print $label;
        print_r($value);
        print '</pre>';
    }
}
