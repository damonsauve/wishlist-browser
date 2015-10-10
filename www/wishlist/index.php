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

$amazon_id = '3XFAFTBCX52X';

if (isset($_GET['id']) || !empty($_GET['id']))
{
    //vallemar library = '3QO0UVENSYBBJ';
    //damon = '3XFAFTBCX52X';
    $amazon_id = $_GET['id'];
}
else
{
    $_GET['id'] = $amazon_id;
}

$cache->setAmazonId($amazon_id);

$product = new Product();
$product->setCacheObj($cache);

$wishlist_lib = $extdir . 'amazon-wish-lister/src/wishlist.php';

$wishlist = new WishList();
$wishlist->setWishListLib($wishlist_lib);
$wishlist->setProductObj($product);
$wishlist->setCacheObj($cache);
$wishlist->setAmazonId($amazon_id);

$list['items'] = $wishlist->getList();

$list['meta']['amazon_id'] = $amazon_id;
$list['meta']['profile'] = $wishlist->getProfile();
$list['meta']['profile_link'] = $wishlist->getProfileLink();
$list['carousel'] = $wishlist->getProductsImagesForCarousel();

$tpl = new Template(
    'wish_list-responsive.tpl',
    $list,
    ''
);

$html = $tpl->fetch();

echo $html;

?>
