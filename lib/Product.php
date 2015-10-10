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
    private $productUrl;
    private $starRating;
    private $productReviewsUrl;
    private $author;
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
        $this->author       = $product_data['author'];

        $this->setAsin();
        $this->picture = $this->cleanImageUrl($this->picture);
        $this->buildProductUrl();
        $this->buildProductReviewsUrl();
        $this->setStarRating();

        $this->cache_obj->setItemKey($this->asin);

        // should just return the original array!
        //
        $this->convertToArray();

        // just cache the original array!
        //
        $this->cacheList();

        return $this->product_list;
    }

    private function buildProductReviewsUrl()
    {
        // http://www.amazon.com/Kristys-Great-Idea-Full-Color-Baby-Sitters/product-reviews/0545813867/ref=wl_it_o_cm_cr_acr_txt?ie=UTF8&colid=3XFAFTBCX52X&coliid=INRVJXFQ3U6B6&showViewpoints=1#

        $this->productReviewsUrl = 'http://www.amazon.com/product-reviews/' . $this->asin;
    }

    private function setStarRating()
    {
        if ($this->rating > 4.8)
        {
            $this->starRating = 5;
        }
        elseif ($this->rating > 3.9)
        {
            $this->starRating = 4;
        }
        elseif ($this->rating > 2.9)
        {
            $this->starRating = 3;
        }
        elseif ($this->rating > 1.9)
        {
            $this->starRating = 2;
        }
        elseif ($this->rating > 0.9)
        {
            $this->starRating = 1;
        }
        else
        {
            $this->starRating = 0;
        }
    }

    private function buildProductUrl()
    {
        // http://www.amazon.com/dp/0545813867/ref=wl_it_dp_v_S_ttl/183-5046167-8156964?_encoding=UTF8&colid=3XFAFTBCX52X&coliid=INRVJXFQ3U6B6
        //
        $this->productUrl = 'http://www.amazon.com/dp/' . $this->asin;
    }

    public function cleanImageUrl($image, $width=160)
    {
        // http://ecx.images-amazon.com/images/I/51sHIcSIedL._SL500_PIsitb-sticker-arrow-big,TopRight,35,-73_OU01_SL135_.jpg
        // http://ecx.images-amazon.com/images/I/51HtShvWYsL._SL160_.jpg
        //
        $pattern = '/_SL.*?jpg/';
        $replacement = '_SL' . $width . '_.jpg';

        return preg_replace($pattern, $replacement, $image);
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
