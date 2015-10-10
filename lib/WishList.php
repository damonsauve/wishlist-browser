<?php

class WishList
{
    private $product_obj;
    private $cache_obj;

    private $wishlist_lib;

    // an array of product arrays.
    //
    private $wishlist_array = array();

    private $profile;
    private $profile_link;
    private $amazon_id;

    // an array of product objects.
    //
    private $wishlist = array();

    private $carousel = array();

    private $product_list;

    function __construct()
    {
        // nada
    }

    public function setWishListLib($wishlist_lib)
    {
        $this->wishlist_lib = $wishlist_lib;
    }

    public function setProductObj($product_obj)
    {
        $this->product_obj = $product_obj;
    }

    public function getList()
    {
        if ($cached_obj = $this->getListFromCache())
        {
            $this->convertToArray($cached_obj);
        }
        else
        {
            $extdir = dirname(__FILE__) . '/../../ext/';

            $wishlist_array = include($this->wishlist_lib);

            //if ((!isset($wishlist_data)) || strlen($wishlist_data) == 0)
            //{
            //    //print "error: Must supply a non-null value to parse";
            //    throw new InvalidArgumentException("Must supply a non-null value to parse.");
            //}

            //echo "\n\n<li><tt>zebug [" . __LINE__ . "] [" . __FILE__ . "] [<i>" . __FUNCTION__ . "()</i>]</tt>\n";
            //$this->dump($wishlist_array);

            $wishlist_array = $this->setProfile($wishlist_array);

            $this->setProfileLink();

            $this->setListData($wishlist_array);

            $this->getProductsFromList();

            $this->setProductsImagesForCarousel();
        }

        return $this->wishlist;
    }

    public function setAmazonId($id)
    {
        $this->amazon_id = $id;
    }

    private function setProfile($wishlist_array)
    {
        $this->profile = array_shift($wishlist_array);

        return $wishlist_array;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfileLink()
    {
        $this->profile_link = 'http://www.amazon.com/registry/wishlist/' . $this->amazon_id;
    }

    public function getProfileLink()
    {
        return $this->profile_link;
    }

    private function convertToArray($cached_obj)
    {
        $temp = array();

        foreach ($cached_obj as  $value)
        {
            foreach ($value as $k => $v)
            {
                $temp[$k] = $v;
            }

            $this->wishlist[] = $temp;
        }
    }

    private function setListData($array)
    {
        $this->wishlist_array = $array;
    }

    public function getProductsImagesForCarousel()
    {
        return $this->carousel;
    }

    private function setProductsImagesForCarousel()
    {
        foreach ($this->wishlist as $value)
        {
            // [picture] => http://ecx.images-amazon.com/images/I/41nN1N9WQmL._SL500_SL135_.jpg
            //
            $temp['picture'] = $this->product_obj->cleanImageUrl($value['picture'], 300);
            $temp['name'] = $value['name'];
            $temp['productUrl'] = $value['productUrl'];

            $this->carousel[] = $temp;

            if (count($this->carousel) == 4)
            {
                break;
            }
        }
    }

    private function getProductsFromList()
    {
        $products = array();

        foreach ($this->wishlist_array as $key => $value)
        {
            $product_list[] = $this->getProductData($value);
        }

        // an array of product objects.
        //
        $this->wishlist = $product_list;
    }

    private function getProductData($product_data)
    {
        return $this->product_obj->setProductData($product_data);
    }

    public function setCacheObj($cache_obj)
    {
        $this->cache_obj = $cache_obj;
    }

    private function getListFromCache()
    {
        return $this->cache_obj->checkCache();
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
