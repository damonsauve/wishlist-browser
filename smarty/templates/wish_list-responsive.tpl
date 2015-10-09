
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

<!--
to do:
    tool tip quick view -> modal + comment
    carousel for featured items
    on mouseover, increase font size or raise awareness

assignment requirements:
    Navbar with dropdowns
    Modal window
    Tooltip
    Carousel
    Tabs
    Bonus: Collapse
    Bonus: Progress bar with animation

-->

    <div class="row header-row">
        <div class="col-xs-12 col-sm-12">
            <div class="pull-right">
                <div class="dropdown ">
                    <button id="wish-lists" type="button" data-toggle="dropdown">
                        Wish Lists
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/wishlist/?id=3QO0UVENSYBBJ">Vallemar Library (cached)</a></li>
                        <li><a href="/wishlist/?id=3QO0UVENSYBBJ&co=1">Vallemar Library</a></li>
                        <li><a href="/wishlist/?id=3XFAFTBCX52X">Damon's (cached)</a></li>
                        <li><a href="/wishlist/?id=3XFAFTBCX52X&co=1">Damon's</a></li>
                    </ul>
                </div>
                <div class="dropdown ">
                    <button id="sorting" type="button" data-toggle="dropdown">
                        Sort by:
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/wishlist/?id={$amazon_id}&co=&sort=price-low">Price (low to high)</a></li>
                        <li><a href="/wishlist/?id={$amazon_id}&co=&sort=price-high">Price (high to low)</a></li>
                        <li><a href="/wishlist/?id={$amazon_id}&co=&sort=title">Title</a></li>
                    </ul>
                </div>
            </div>

            <h1 class="logo">{$profile}</h1>
            <h2 class="logo sub-logo"><a href="{$profile_link}" target="_blank">Visit Amazon Wish List</a></h2>
        </div>
    </div>

    <div class="row">
{foreach $products as $product}
        <div class="col-md-6 col">
            <div class="row">

                <a href={$product.productUrl} target="_blank"><img class="product-image" src={$product.picture} alt="{$product.name}"></a>

                <h3 class="product-name"><a href={$product.productUrl} target="_blank">{$product.name}</a></h3>

                <div class="product-author">by {$product.author}</div>

    {if isset($product.rating) && !empty($product.rating) }
                <img class="product-star-rating" src="/i/rating-{$product.starRating}.png">
                <!--<div class="product-rating">{$product.rating}</div>-->

        {if isset($product.totalRatings) && !empty($product.totalRatings) }
                <span class="product-total-ratings">(<a href="{$product.productReviewsUrl}" target="_blank">{$product.totalRatings}</a>)</span>
        {/if}

    {/if}
                <div class="product-price">{$product.newPrice}</div>

    {if isset($product.priority) && !empty($product.priority) }
                <div class="product-priority">Priority: {$product.priority}</div>
    {/if}
                <!--<div class="product-added">Added: {$product.dateAdded}</div>-->
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
