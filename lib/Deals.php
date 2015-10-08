<?php

class Deals
{
    const TATCHA_PRODUCTS_URL = 'http://api.tatcha.com/shop/api/rest/products';

    const TOP_DEALS_COUNT = 5;

    private $deals = array();

    function __construct()
    {
        // Nada.
    }

    public function getDeals()
    {
        $url = $this->getProductsApiUrl();

        // Overwrite URL for testing.
        //
        //$url = 'http://tatcha/tatcha/products.json';

        $curl = new CurlRequest($url);
        $curl->createCurl();
        $response = $curl->getResponse();

        if (is_object($jsonResponse = json_decode($response)))
        {
            $this->getProductArrayFromJson($jsonResponse);

            // Because the product feed lacks prices, we'll sort alphabetically
            // by sku and take TOP_DEALS_COUNT.
            //
            $this->getTopDeals();

            return $this->deals;
        }
    }

    private function getTopDeals()
    {
        function sort_callback($a, $b)
        {
            return strcmp($a->product['sku'], $b->product['sku']);
        }

        // Sort deals with user-defined comparison function.
        //
        uasort($this->deals, 'sort_callback');

        // Splice TOP_DEALS_COUNT from array.
        //
        array_splice($this->deals, self::TOP_DEALS_COUNT);
    }

    private function getProductsApiUrl()
    {
        return self::TATCHA_PRODUCTS_URL;
    }

    private function getProductApiUrl($productId)
    {
        return self::TATCHA_PRODUCT_URL . $productId;
    }

    private function getProductArrayFromJson($json)
    {
        foreach($json as $data_item)
        {
            $product = new Product($data_item);
            $this->deals[] = $product;
        }
    }
}
