<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$profile} at Amazon.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/wishlist.css">
</head>
<body>

<div class="container">

    <div class="row tab-row">
        <div class="col-sm-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="" class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title="Responsive-design version using Bootstrap.">New Version</a></li>
                <li role="presentation"><a href="index-old.html" class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title="Non-responsive version.">Old Version</a></li>
            </ul>
        </div>
    </div>

    <div class="row header-row">
        <div class="col-sm-8">
            <h1 class="logo">{$profile}</h1>
            <h2 class="logo sub-logo"><a href="{$profile_link}" target="_blank" class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title="Click to visit {$profile} on Amazon.com.">Amazon Wish List</a></h2>
        </div>
    </div>

    <div class="row button-row">
        <div class="col-sm-12">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Hide Carousel</button>
                <div class="btn-group" role="group" aria-label="...">
                    <div class="dropdown ">
                        <button id="sorting" type="button" data-toggle="dropdown">
                            Sort by:
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/wishlist/?id={$amazon_id}&co=&sort=title">Title</a></li>
                            <li><a href="/wishlist/?id={$amazon_id}&co=&sort=price-high">Price (high to low)</a></li>
                            <li><a href="/wishlist/?id={$amazon_id}&co=&sort=price-low">Price (low to high)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="...">
                    <div class="dropdown">
                        <button id="wish-lists" type="button" data-toggle="dropdown">
                            Wish Lists
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/wishlist/?id=3QO0UVENSYBBJ&co=1">Vallemar Library</a></li>
                            <li><a href="/wishlist/?id=3QO0UVENSYBBJ">Vallemar Library (cached)</a></li>
                            <li><a href="/wishlist/?id=3XFAFTBCX52X&co=1">Damon's</a></li>
                            <li><a href="/wishlist/?id=3XFAFTBCX52X">Damon's (cached)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse" id="collapseExample">
        <div class="row carousel-row">
            <div class="col-sm-12">
                <div class="well">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">

    {foreach from=$carousel item=product name=foo}
                        <div class="item{if $smarty.foreach.foo.first} active{else}{/if}">
                                <img class="carousel-image" src="{$product.picture}" alt="{$product.name}">
                                <div class="carousel-caption">
                                {$product.name}
                                </div>
                            </div>
    {/foreach}

                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row body-row">
{foreach $products as $product}
        <div class="col-sm-6 body-col">
            <div class="row">
                <div class="col-sm-5 body-col">
                    <a href={$product.productUrl} target="_blank"><img class="product-image" src={$product.picture} alt="{$product.name}"></a>
                </div>
                <div class="col-sm-7 body-col">
                    <h3 class="product-name product-info"><a href={$product.productUrl} target="_blank" class="right" title="" data-placement="left" data-toggle="tooltip" data-original-title="Click title to visit the product page on Amazon.com.">{$product.name}</a></h3>
                    <div class="product-author product-info">by {$product.author}</div>

    {if isset($product.rating) && !empty($product.rating) }
                <img class="product-star-rating product-info" src="i/rating-{$product.starRating}.png" class="right" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="{$product.rating}.">
                    <!--<div class="product-rating">{$product.rating}</div>-->
        {if isset($product.totalRatings) && !empty($product.totalRatings) }
             <span class="product-total-ratings product-info">(<a href="{$product.productReviewsUrl}" target="_blank" class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title="{$product.totalRatings} product reviews.">{$product.totalRatings}</a>)</span>
        {/if}
    {/if}
        <div class="product-price product-info">{$product.newPrice}</div>

    {if isset($product.priority) && !empty($product.priority) }
               <!-- <div class="product-priority product-info">Priority: {$product.priority}</div>-->
    {/if}

    {if isset($product.comment) && !empty($product.comment) }
                <a href="#" id="product-comment" data-toggle="modal" data-target="#comment-modal">View Comments</a>

                <div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Comments for: {$product.name}</h4>
                      </div>
                      <div class="modal-body"><p>{$product.comment}</p></div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
    {/if}

                    <!--<div class="product-added">Added: {$product.dateAdded}</div>-->
                    <!-- <div class="product-comment">{$product.comment}</div> -->
                    <!--<div class="product-asin">ASIN: {$product.asin}</div>-->
                </div>
            </div>
        </div>
{/foreach}
    </div>

    <div class="row footer-row">
        <div class="col-sm-12">
            &copy; 2015 <a href="https://github.com/damonsauve">Damon Sauve</a></div>
        </div>
    </div>

</div>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/wishlist.js"></script>
</body>
</html>
