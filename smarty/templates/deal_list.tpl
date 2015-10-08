<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/main.css">
<title>Tatcha | Japanese Beauty &amp; Skincare Rituals | Moisturizers, Cleansers, Toners</title>
</head>

<body>

<header class="header container">
    <h1 class="logo">Tatcha</h1>
    <h2 class="tagline">Japanese Beauty &amp; Skincare Rituals</h3>
</header>

<section class="grid body">

<h3 class="top-deals">Today's Top Deals</h3>

{foreach $products as $product}
    <section class="col-1-2-a">
        <div class="product-info">
            <a href={$product.url} target="_blank"><h3>{$product.name|lower}</h3></a>
            <p>{$product.description}</p>
        </div>
        <div class="product-numbers">
        <h5>product id: {$product.entity_id|lower}</h5></p>
        <h5>sku: {$product.sku|lower}</h5></p>
        </div>
    </section><!--
--><section class="col-1-2-b">
            <a href={$product.url} target="_blank"><img src={$product.image_url} alt="{$product.name}"></a>
            <div class="buy-it-now">
                <a href={$product.url} target="_blank">But It Now!</a>
            </div>
    </section>

{/foreach}

</section>

<footer class="footer container">
    <p>&copy; 2015 Tatcha, LLC. All Rights Reserved.</p>
</footer>

</body>

</html>
