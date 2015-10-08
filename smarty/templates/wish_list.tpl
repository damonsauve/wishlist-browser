<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/main.css">
<title>Vallemar School Library | Amazon Wish List</title>
</head>

<body>

<header class="header container">
    <h1 class="logo">Vallemar School Library</h1>
    <h2 class="tagline">Amazon Wish List</h3>
</header>

<section class="grid body">

<!--    //[0] => Array
    //    (
    //        [num] => 1
    //        [name] => The Marvels
    //        [link] => http://www.amazon.com/dp/0545448689/ref=wl_it_dp_v_nS_ttl/180-8285179-8724750?_encoding=UTF8&colid=3QO0UVENSYBBJ&coliid=I3FZIQK09I7PPI
    //        [old-price] => N/A
    //        [new-price] =>
    //        [date-added] => October 2, 2015
    //        [priority] =>
    //        [rating] => N/A
    //        [total-ratings] =>
    //        [comment] => "In the final volume of a trilogy connected by theme, structural innovation, and exquisite visual storytelling, Selznick challenges readers to see."--Ki‰ÛÜrkus Reviews. Ages: 8-12. Grades: 3-7.
    //        [picture] => http://ecx.images-amazon.com/images/I/61zNABA0%2BdL._SL500_PIsitb-sticker-arrow-big,TopRight,35,-73_OU01_SL135_.jpg
    //        [page] => 1
    //    )-->

{foreach $products as $product}
    <section class="col-1-2-a">
        <div class="product-info">
            <a href={$product.link} target="_blank"><h3>{$product.name}</h3></a>
            <p>{$product.description}</p>
        </div>
        <div class="product-numbers">
        <h5>ASIN: {$product.asin}</h5></p>
        </div>
    </section><!--
--><section class="col-1-2-b">
            <a href={$product.link} target="_blank"><img src={$product.picture} alt="{$product.name}"></a>
            <div class="buy-it-now">
                <a href={$product.link} target="_blank">But It Now!</a>
            </div>
    </section>

{/foreach}

</section>

<footer class="footer container">
    <p>&copy; 2015. All Rights Reserved.</p>
</footer>

</body>

</html>
