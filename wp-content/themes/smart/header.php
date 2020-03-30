<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    </head>
    <body <?php body_class() ?> >
        <!-- ##### Header Area Start ##### -->
        <header class="header_area">
            <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
                <!-- Classy Menu -->
                <nav class="classy-navbar" id="essenceNav">
                    <!-- Logo -->
                    <a class="nav-brand" href="<?php echo esc_url(site_url('')); ?>">
                        <img id="logo" style="" src="<?php echo get_theme_file_uri('img/core-img/ngola_logo.png'); ?>" alt="">
                    </a>
                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="<?php echo site_url('/store-listing'); ?>">BOUTIQUES</a></li>
                                <li><a href="#">MODE FEMME</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Vêtements Femme</li>
                                            <li><a href="#">Robes</a></li>
                                            <li><a href="#">Pantalons</a></li>
                                            <li><a href="#">T-shirts</a></li>
                                            <li><a href="#">Chemises</a></li>
                                            <li><a href="#">Lingérie</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Accessoires Femmes</li>
                                            <li><a href="#">Bijoux</a></li>
                                            <li><a href="#">Sacs</a></li>
                                            <li><a href="#">Ceintures</a></li>
                                            <li><a href="#">Montres</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Chaussures Femmes</li>
                                            <li><a href="#">Escarpins</a></li>
                                            <li><a href="#">Compensées</a></li>
                                            <li><a href="#">Sandales</a></li>
                                            <li><a href="#">Tennis</a></li>
                                        </ul>
                                        <div class="single-mega cn-col-4">
                                            <img src="<?php echo get_theme_file_uri('img/bg-img/femmes.jpg'); ?>" alt="">
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">MODE HOMME</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Vêtements Homme</li>
                                            <li><a href="#">Costumes</a></li>
                                            <li><a href="#">Chemises</a></li>
                                            <li><a href="#">Pantalons</a></li>
                                            <li><a href="#">T-shirts</a></li>
                                            <li><a href="#">Lingérie</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Accessoires Hommes</li>
                                            <li><a href="#">Montres</a></li>
                                            <li><a href="#">Cravates</a></li>
                                            <li><a href="#">Bijoux</a></li>
                                            <li><a href="#">Ceintures</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Chaussures Hommes</li>
                                            <li><a href="#">Moccassins</a></li>
                                            <li><a href="#">Paires</a></li>
                                            <li><a href="#">Sandales</a></li>
                                            <li><a href="#">Tennis</a></li>
                                        </ul>
                                        <div class="single-mega cn-col-4">
                                            <img src="<?php echo get_theme_file_uri('img/bg-img/hommes.jpg'); ?>" alt="">
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">BEAUTÉ</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Cosmétiques</li>
                                            <li><a href="#">Déodorants</a></li>
                                            <li><a href="#">Maquillages</a></li>
                                            <li><a href="#">Soins Visage</a></li>
                                            <li><a href="#">Soins Corps</a></li>
                                            <li><a href="#">Soins Cheveux</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Parfums</li>
                                            <li><a href="#">Hommes</a></li>
                                            <li><a href="#">Femmes</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Meches</li>
                                            <li><a href="#">Brésiliennes</a></li>
                                            <li><a href="#">Indiennes</a></li>
                                            <li><a href="#">Péruviennes</a></li>
                                        </ul>
                                        <div class="single-mega cn-col-4">
                                            <img src="<?php echo get_theme_file_uri('img/bg-img/beaute.jpg'); ?>" alt="">
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">ELECTRO</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Electroniques</li>
                                            <li><a href="#">Téléphones</a></li>
                                            <li><a href="#">Tablettes</a></li>
                                            <li><a href="#">Tv</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Electromenager</li>
                                            <li><a href="#">Electromenager</a></li>
                                        </ul>
                                        <div class="single-mega cn-col-4">
                                            <img src="<?php echo get_theme_file_uri('img/bg-img/electro.jpg'); ?>" alt="">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>

                <!-- Header Meta Data -->
                <div class="header-meta d-flex clearfix justify-content-end">
                    <!-- Search Area -->
                    <div class="search-area">
                        <form action="<?php echo esc_url(site_url('/shop')) ?>" method="GET">
                            <input type="search" name="s" id="headerSearch" placeholder="Type for search">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <!-- User Login Info -->
                    <div class="user-login-info">

                        <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>"><img src="<?php echo get_theme_file_uri('img/core-img/user.svg'); ?>" alt="Fait par kaizer web design"></a>
                    </div>
                    <!-- Cart Area actual-->
                    <div class="cart-area">
                        <a href="#" id="essenceCartBtn">
                            <img src="<?php echo get_theme_file_uri('img/core-img/bag.svg'); ?>" alt="Fait par kaizer web design"> 
                            <span style="position: relative;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                    </div>
                </div>

            </div>
        </header>
        <!-- ##### Header Area End ##### -->


        <div class="cart-bg-overlay"></div>

        <!-- ##### Right Side Cart Area ##### -->
        <div class="right-side-cart-area">

            <!-- Cart Button -->
            <div class="cart-button">
                <a href="#" id="rightSideCart"><img src="<?php echo get_theme_file_uri('img/core-img/bag.svg'); ?>" alt=""> 
                    <span style="position: relative;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
            </div>

            <div class="cart-content d-flex">

                <!-- Cart List Area -->
                <div style="background-color: #45454594;" class="cart-list">

                    <?php
                    // WC()->cart->empty_cart();
                    $test = WC()->cart->get_cart_contents();
                    foreach ($test as $cart_item_key => $values) {
                        $_product = wc_get_product($values['data']->get_id());
                        $product1 = new WC_Product($values['product_id']);
                        $the_product_factory = new WC_Product_Factory();
                        $product1 = $the_product_factory->get_product($product1);
                        ?>
                        <!-- Single Cart Item -->
                        <div class="single-cart-item">
                            <div class="product-image">
                                <?php
                                $feature = getFeaturedImage($values['product_id']);
                                ?>
                                <img src="<?php echo $feature; ?>" class="cart-thumb" alt="">
                                <!-- Cart Item Desc -->
                                <div style="overflow: auto;" class="cart-item-desc">
                                    <a href="<?php echo wc_get_cart_remove_url($cart_item_key); ?>">
                                        <span class="product-remove"><i style="font-size: 18px;" class="fa fa-close" aria-hidden="true"></i></span>
                                    </a>
                                    <?php
                                    $brands = wp_get_post_terms($product1->get_id(), 'pwb-brand');
                                    $name = 'No name';
                                    foreach ($brands as $brand) {
                                        $name = $brand->name . ' ';
                                    }
                                    ?>
                                    <span class="badge"><?= $name; ?></span>
                                    <a href="<?php echo $product1->get_permalink(); ?>">
                                        <h6><?php echo $_product->get_name() ?></h6>
                                    </a>
                                    <p style="color: whitesmoke;" class="size">Quantité: <?php echo $values['quantity']; ?></p> 
                                    <?php if ($_product->get_sale_price() !== '') { ?>
                                        <p class="price">
                                            Prix :  <?php echo number_format($_product->get_sale_price()) . ' ' . get_woocommerce_currency_symbol(); ?>
                                        </p>
                                    <?php } else {
                                        ?>
                                        <p class="price">Prix : <?php echo number_format($_product->get_regular_price()) . ' ' . get_woocommerce_currency_symbol(); ?></p>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Cart Summary -->
                <div class="cart-amount-summary">

                    <h2>Resumé</h2>
                    <ul class="summary-table">
                        <li><span>Sous Total :</span> <span><?php echo number_format(WC()->cart->get_subtotal()) . ' ' . get_woocommerce_currency_symbol(); ?></span></li>
                        <?php
                        $test = WC()->cart->get_applied_coupons();
                        if (!empty($test)) {
                            foreach ($test as $value) {
                                $coupon = new WC_Coupon($value);
                                ?>
                                <li><span> <?php echo $coupon->get_code() . ' '; ?> [coupon] :</span> <span>- <?php echo number_format(($coupon->get_amount() / 100) * WC()->cart->get_subtotal()) . ' ' . get_woocommerce_currency_symbol(); ?></span></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <div class="checkout-btn text-center mt-100">
                        <a href="<?php echo wc_get_cart_url(); ?>" class="btn essence-btn mb-30">Panier</a>
                        <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="btn essence-btn">Commander</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Right Side Cart End ##### -->