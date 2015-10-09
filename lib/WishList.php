<?php

class WishList
{
    private $product_obj;
    private $cache_obj;

    private $wishlist_lib;

    // an array of product arrays.
    //
    private $wishlist_array = array();

    // an array of product objects.
    //
    private $wishlist = array();

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
        //$this->cache_obj->setCacheKey('vallemar-');

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
            //print_r($wishlist_array);

            $this->setListData($wishlist_array);

            $this->getProductsFromList();
        }

        return $this->wishlist;
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
