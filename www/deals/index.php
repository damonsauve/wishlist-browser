<?php

$basedir = dirname(__FILE__) . '/../../lib/';
require $basedir . 'CurlRequest.php';
require $basedir . 'Deals.php';
require $basedir . 'Product.php';
require $basedir . 'Template.php';

$extdir = dirname(__FILE__) . '/../../ext/';
require $extdir . 'smarty-3.1.24/libs/Smarty.class.php';

// predis
//
require $extdir . "predis-1.0/autoload.php";

$productList = array();

$deals = new Deals();
$deal_list = $deals->getDeals();

$tpl = new Template(
    'deal_list.tpl',
    $deal_list,
    ''
);

$html = $tpl->fetch();

echo $html;

?>
