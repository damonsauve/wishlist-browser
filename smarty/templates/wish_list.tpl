<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/main.css">
<title>Vallemar School Library | Amazon Wish List</title>
</head>

<body>

<header class="header container">
    <h1 class="logo">Vallemar School Library</h1>
    <h2 class="tagline">Amazon Wish List</h3>
</header>

<section class="grid body">

{foreach $products as $product}
    <section class="col-1-2-a">
        <div class="product-info">
            <a href={$product.link} target="_blank"><h3>{$product.name}</h3></a>

    {if isset($product.comment) && !empty($product.comment) }
            <p>{$product.comment}</p>
    {/if}

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
