<?php

class Cache
{
    private $cache;
    private $amazon_id;
    private $itemKey;
    private $disable_cache = 0;

    function __construct($cache)
    {
        $this->setCache($cache);
    }

    private function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function setAmazonId($amazon_id)
    {
        $this->amazon_id = $amazon_id;
    }

    public function setItemKey($key)
    {
        $this->itemKey = $key;
    }

    public function disableCache($bool)
    {
        $this->disable_cache = $bool;
    }

    private function isCacheEnabled()
    {
        if ($this->disable_cache == true)
        {
            return false;
        }

        return true;
    }

    public function loadCache($data)
    {
        $cache_key = $this->amazon_id . '-' . $this->itemKey;

        $this->cache->set(
            $cache_key,
            json_encode($data)
        );
    }

    public function checkCache()
    {
        if ($this->isCacheEnabled())
        {
            $cache_key = $this->amazon_id . '-' . $this->itemKey;

            $keys = $this->cache->KEYS(
                $cache_key . '*'
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
