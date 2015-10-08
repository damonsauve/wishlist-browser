<?php

class ProductList
{
    const TATCHA_PRODUCTS_URL = 'http://api.tatcha.com/shop/api/rest/products';

    const PARAM_PAGE  = 'page';
    const PARAM_LIMIT = 'limit';
    const PARAM_ORDER = 'order';
    const PARAM_DIR   = 'dir';

    private $defaultParams = array(
        'page'  => '1',
        'limit' => '3',
        'order' => 'name',
        'dir'   => 'asc'
    );

    private $params;

    function __construct($params)
    {
        $this->setParams($params);
        $this->setDefaultValuesForParams();
    }

    private function setParams($params)
    {
        foreach ($params as $k => $v)
        {
            switch ($k) {
                case self::PARAM_PAGE:
                    $this->params[self::PARAM_PAGE] = $v;
                    break;
                case self::PARAM_LIMIT:
                    $this->params[self::PARAM_LIMIT] = $v;
                    break;
                case self::PARAM_ORDER:
                    $this->params[self::PARAM_ORDER] = $v;
                    break;
                case self::PARAM_DIR:
                    $this->params[self::PARAM_DIR] = $v;
                    break;
                default:
                    // skip unknown params.
                    break;
            }
        }
    }

    public function getParams()
    {
        $urlParams = array();

        foreach ($this->params as $k => $v)
        {
            $urlParams[] = $k . '=' . $v;
        }

        // Sort params for better SEO URLs.
        //
        sort($urlParams);

        return implode('&', $urlParams);
    }

    protected function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    protected function getParam($key)
    {
        if (isset($this->params[$key]))
        {
            return $this->params[$key];
        }
    }

    private function setDefaultValuesForParams()
    {
        foreach ($this->defaultParams as $k => $v)
        {
            if (!isset($this->params[$k]))
            {
                $this->params[$k] = $v;
            }
        }
    }

    public function getPagination()
    {
        if (isset($this->params[self::PARAM_PAGE]))
        {
            $pagination = array();

            $current_page = $this->params[self::PARAM_PAGE];

            if ($previousUrl = $this->getPreviousUrl($current_page))
            {
                $pagination['previous'] = $previousUrl;
            }

            if ($nextUrl = $this->getNextUrl($current_page))
            {
                $pagination['next'] = $nextUrl;
            }

            return $pagination;
        }
    }

    private function getPreviousUrl($page)
    {
        if ($page > 1)
        {
            $previousPage = $page - 1;

            $this->setParam('page', $previousPage);
            $params = $this->getParams();
            $url = $this->getPaginationUrl($params);

            return $url;
        }
    }

    private function getNextUrl($page)
    {
        if ($page > 0)
        {
            $nextPage = $page + 1;

            $this->setParam('page', $nextPage);
            $params = $this->getParams();
            $url = $this->getPaginationUrl($params);

            return $url;
        }
    }

    public function getProductList()
    {
        $this->products = array();

        $url = $this->getProductsApiUrl($this->getParams());

        // Overwrite URL for testing.
        //
        //$url = 'http://tatcha/tatcha/products.json';

        $curl = new CurlRequest($url);
        $curl->createCurl();
        $response = $curl->getResponse();

        if (is_object($jsonResponse = json_decode($response)))
        {
            $this->getProductArrayFromJson($jsonResponse);

            return $this->products;
        }
    }

    private function getPaginationUrl($params)
    {
        return $_SERVER['PHP_SELF'] . '?' . $params;
    }

    private function getProductsApiUrl($params)
    {
        return self::TATCHA_PRODUCTS_URL . '?' . $params;
    }

    private function getProductArrayFromJson($json)
    {
        foreach ($json as $data_item)
        {
            $product = new Product($data_item);
            $this->products[] = $product;
        }
    }
}
