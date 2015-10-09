
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vallemar School Library | Amazon Wish List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/wishlist.css">
</head>
<body>

<div class="container">

    <div class="row header-row">
        <div class="col-xs-12 col-sm-12">
            <div class="dropdown pull-right">
                <button id="dLabel" type="button" data-toggle="dropdown">
                    Wish Lists
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="http://wishlist/wishlist/?id=3QO0UVENSYBBJ">Vallemar Library (cached)</a></li>
                    <li><a href="http://wishlist/wishlist/?id=3QO0UVENSYBBJ&co=1">Vallemar Library</a></li>
                    <li><a href="http://wishlist/wishlist/?id=3XFAFTBCX52X">Damon's (cached)</a></li>
                    <li><a href="http://wishlist/wishlist/?id=3XFAFTBCX52X&co=1">Damon's</a></li>
                </ul>
            </div>

            <h1 class="logo">Vallemar School Library</h1>
            <h2 class="logo sub-logo">Amazon Wish List</h2>
        </div>
    </div>

    <div class="row">
{foreach $products as $product}
        <div class="col-md-6 col">
            <div class="row">

                <a href={$product.productUrl} target="_blank"><img class="product-image" src={$product.picture} alt="{$product.name}"></a>

                <h3 class="product-name"><a href={$product.productUrl} target="_blank">{$product.name}</a></h3>

    {if isset($product.rating) && !empty($product.rating) }
                <img class="product-star-rating" src="/i/rating-{$product.starRating}.png">
                <div class="product-rating">{$product.rating}

        {if isset($product.totalRatings) && !empty($product.totalRatings) }
                <span class="product-total-ratings">(<a href="{$product.productReviewsUrl}" target="_blank">{$product.totalRatings}</a>)</span>
        {/if}
                </div>
    {/if}
                <div class="product-price">{$product.newPrice}</div>
                <div class="product-added">Date Added: {$product.dateAdded}</div>

    {if isset($product.priority) && !empty($product.priority) }
                <div class="product-priority">Priority: {$product.priority}</div>
    {/if}
                <!-- <div class="product-comment">{$product.comment}</div> -->
                <!--<div class="product-asin">ASIN: {$product.asin}</div>-->
            </div>
        </div>
{/foreach}
    </div>

    <div class="footer"></div>

</div>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wishlist.js"></script>
</body>
</html>
