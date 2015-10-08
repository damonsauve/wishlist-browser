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

$enable_cache = 0;

if (isset($_GET['c']))
{
    print "cache on";
    $enable_cache = 1;
}

$cache->enableCache($enable_cache);

$wishlist_lib = $extdir . 'amazon-wish-lister/src/wishlist.php';

$product = new Product();
$product->setCacheObj($cache);

$wishlist = new WishList();
$wishlist->setWishListLib($wishlist_lib);
$wishlist->setProductObj($product);
$wishlist->setCacheObj($cache);
$list = $wishlist->getList();

$tpl = new Template(
    'wish_list.tpl',
    $list,
    ''
);

$html = $tpl->fetch();

echo $html;

?>
