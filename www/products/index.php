<?php

$basedir = dirname(__FILE__) . '/../../lib/';
require $basedir . 'CurlRequest.php';
require $basedir . 'ProductList.php';
require $basedir . 'Product.php';
require $basedir . 'Template.php';
require $basedir . 'Tracking.php';

$extdir = dirname(__FILE__) . '/../../ext/';
require $extdir . 'smarty-3.1.24/libs/Smarty.class.php';

// predis
//
require $extdir . "predis-1.0/autoload.php";

$productList = array();
$pagination = array();

$products = new ProductList($_REQUEST);
$productList = $products->getProductList();
$pagination = $products->getPagination();

$tpl = new Template(
    'product_list.tpl',
    $productList,
    $pagination
);

$html = $tpl->fetch();

echo $html;

?>
