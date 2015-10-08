<?php

class Product
{
    private $cache_obj;

    private $name;
    private $link;
    private $oldPrice;
    private $newPrice;
    private $dateAdded;
    private $priority;
    private $rating;
    private $totalRatings;
    private $comment;
    private $picture;
    private $page;

    private $product_list = array();

    function __construct()
    {
        // nada
    }

    public function setCacheObj($cache_obj)
    {
        $this->cache_obj = $cache_obj;
    }

    public function setProductData($product_data)
    {
        $this->num          = $product_data['num'];
        $this->name         = $product_data['name'];
        $this->link         = $product_data['link'];
        $this->oldPrice     = $product_data['old-price'];
        $this->newPrice     = $product_data['new-price'];
        $this->dateAdded    = $product_data['date-added'];
        $this->priority     = $product_data['priority'];
        $this->rating       = $product_data['rating'];
        $this->totalRatings = $product_data['total-ratings'];
        $this->comment      = $product_data['comment'];
        $this->picture      = $product_data['picture'];
        $this->page         = $product_data['page'];

        $this->setAsin();
        $this->setPicture();

        $this->cache_obj->setCacheKey('vallemar-' . $this->asin);

        $this->convertToArray();
        $this->cacheList();

        return $this->product_list;
    }

    private function setPicture()
    {
        // http://ecx.images-amazon.com/images/I/61JCfmhZY5L._SL500_SL135_.jpg
        //
        $pattern = '/_SL135_/i';
        $replacement = '_SL260_';

        $this->picture = preg_replace($pattern, $replacement, $this->picture);
    }

    private function setAsin()
    {
        $pieces = explode('/', $this->link);

        //[0] => http:
        //[1] =>
        //[2] => www.amazon.com
        //[3] => dp
        //[4] => 1338029991

        $this->asin = $pieces[4];

        // to do: error checking.
    }

    private function convertToArray()
    {
        foreach ($this as $key => $value)
        {
            if ($key != 'product_list' && $key != 'cache_obj')
            {
                $this->set($key, (string) $value);
            }
        }
    }

    private function set($key, $value)
    {
        $this->product_list[$key] = $value;
    }

    private function cacheList()
    {
        $this->cache_obj->loadCache($this->product_list);
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
