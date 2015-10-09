<?php

$basedir = dirname(__FILE__) . '/../../lib/';
require $basedir . 'WishList.php';
require $basedir . 'Product.php';
require $basedir . 'Cache.php';
require $basedir . 'Template.php';

$extdir = dirname(__FILE__) . '/../../ext/';
require $extdir . 'smarty-3.1.24/libs/Smarty.class.php';

// predis
//
require $extdir . "predis-1.0/autoload.php";
$redis = new Predis\Client();
$cache = new Cache($redis);

$disable_cache = 0;

if (isset($_GET['co']) && $_GET['co'] = 1)
{
    $disable_cache = 1;
}

$cache->disableCache($disable_cache);

if (!isset($_GET['id']) || empty($_GET['id']))
{
    //vallemar library = '3QO0UVENSYBBJ';
    //damon = '3XFAFTBCX52X';
    $_GET['id'] = '3XFAFTBCX52X';
}

$cache->setAmazonId($_GET['id']);

$product = new Product();
$product->setCacheObj($cache);

$wishlist_lib = $extdir . 'amazon-wish-lister/src/wishlist.php';

$wishlist = new WishList();
$wishlist->setWishListLib($wishlist_lib);
$wishlist->setProductObj($product);
$wishlist->setCacheObj($cache);
$list = $wishlist->getList();

$tpl = new Template(
    'wish_list-responsive.tpl',
    $list,
    ''
);

$html = $tpl->fetch();

echo $html;

?>
