<?php get_header(); ?>

<!-- ##### Welcome Area Start ##### -->
<style scoped>
    @media only screen and (max-width:767px){
        #banner-home {
            background-image: url(<?php the_field('banner-mobile'); ?>);
        }
    }

    @media only screen and (min-width:768px){
        #banner-home{
            background-image: url(<?php the_field('banner-desktop'); ?>);
        }
    }
</style>

<section id="banner-home" class="welcome_area bg-img background-overlay" style="">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="hero-content">
                    <h6><?php the_field('banner-petit'); ?></h6>
                    <h2><?php the_field('banner-grand'); ?></h2>
                    <a href="#" class="btn essence-btn">Découvrir</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Welcome Area End ##### -->

<!-- ##### Top Catagory Area Start ##### -->
<!-- Banner -->
<div class="sec-banner bg0 p-t-95 p-b-55">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="<?php the_field('category-cover'); ?>" alt="IMG-BANNER">

                    <a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?php the_field('category-grand'); ?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?php the_field('category-petit'); ?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="<?php the_field('category-cover2'); ?>" alt="IMG-BANNER">

                    <a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?php the_field('category-grand2'); ?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?php the_field('category-petit2'); ?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="<?php the_field('category-cover3'); ?>" alt="IMG-BANNER">

                    <a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?php the_field('category-grand3'); ?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?php the_field('category-petit3'); ?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="<?php the_field('category-cover4'); ?>" alt="IMG-BANNER">

                    <a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?php the_field('category-grand4'); ?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?php the_field('category-petit4'); ?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="<?php the_field('category-cover5'); ?>" alt="IMG-BANNER">

                    <a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?php the_field('category-grand5'); ?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?php the_field('category-petit5'); ?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Top Catagory Area End ##### -->

<!-- ##### New Arrivals Area Start ##### -->
<section style="padding-top: 0; padding-bottom: 20px;" class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2 style="font-family: unset;">Produits <span class="accent">Récents</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page' => '15',
                    );
                    $products = new WP_Query($args);
                    ?>
                    <?php
                    $i = 0;
                    while ($products->have_posts()) {
                        $products->the_post();
                        ?>
                        <!-- Single Product -->
                        <div class=" single-product-item ">
                            <div class="single-product-wrapper">
                                <?php
                                $image = GetImageUrlsByProductId(get_the_ID());
                                $feature = getFeaturedImage(get_the_ID());
                                ?>
                                <!-- Product Image -->
                                <div class="product-img">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <img src="<?php echo $feature; ?>" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="<?php echo $image[0]; ?>" alt="">
                                    </a>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <?php
                                    $brands = wp_get_post_terms($product->get_id(), 'pwb-brand');
                                    $name = 'No name';
                                    foreach ($brands as $brand) {
                                        $name = $brand->name . ' ';
                                    }
                                    ?>
                                    <span class="single-mark"><?= $name; ?></span>
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <h6><?php echo get_the_title() ?></h6>
                                    </a>
                                    <?php $prices = getProductPrice2(get_the_ID()); ?>
                                    <p class="product-price">
                                        <?php if ($prices['sale_price'] !== '') { ?>
                                            <span class="old-price">  <?php echo number_format($prices['regular_price']) . ' ' . get_woocommerce_currency_symbol(); ?></span> <?php echo number_format($prices['sale_price']) . ' ' . get_woocommerce_currency_symbol(); ?>
                                        <?php } else {
                                            ?>
                                            <?php
                                            echo number_format($prices['regular_price']) . ' ' . get_woocommerce_currency_symbol();
                                        }
                                        ?>
                                        <?php
                                        if (!$product->is_type('variable')) {
                                            ?>
                                            <a href="<?php echo '/?add-to-cart=' . $product->get_id(); ?>" id="essenceCartBtn">
                                                <img class="add-logo" src="<?php echo get_theme_file_uri('img/core-img/bag.svg'); ?>" alt="Fait par kaizer web design"> 
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo esc_url($product->get_permalink()); ?>" id="essenceCartBtn">
                                                <img class="add-logo" src="<?php echo get_theme_file_uri('img/core-img/bag.svg'); ?>" alt="Fait par kaizer web design"> 
                                            </a>
                                        <?php } ?>
                                    </p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <?php
                                            if (!$product->is_type('variable')) {
                                                ?>
                                                <a href="<?php echo home_url( add_query_arg( array(), $wp->request ) ) . '/?add-to-cart=' . $product->get_id(); ?>" class="btn essence-btn">Ajouter panier</a>
                                            <?php } else { ?>
                                                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="btn essence-btn">Choisir options</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### New Arrivals Area End ##### -->

<!-- ##### CTA Area Start ##### -->
<?php
while (have_posts()) {
    the_post();
    ?>
    <div  class="academy-courses-area section-padding-100-0">
        <div class="container">
            <div style="margin-bottom: 20px;" class="row align-items-center">
                <div style="" class="col-md-6 order-md-1  mosaic">
                    <h1 style="font-size: 27px; margin-bottom: 15px; color: #e91e63; text-transform: uppercase;" class="welcome-h"><?php the_field('focus-titre'); ?></h1>
                    <div class="welcome-txt" style=" text-align: justify; color: black; line-height: 2.29; margin-bottom: 25px;">
                        <?php the_field('focus-texte'); ?>
                    </div>
                    <div class="full-width">
                        <a style="font-size: 20px;" href="#" class="accent bold">Découvrir
                            <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div style="padding: 0" class="col-md-6 order-first order-md-last ">
                    <img style="max-width: 100%; border-radius: 1px;" src="<?php the_field('focus-cover'); ?>" alt="Ngola Shops">
                </div>
            </div>


            <div style="margin-bottom: 20px;" class="row align-items-center">
                <div style="padding: 0" class="col-md-6">
                    <img style="max-width: 100%; border-radius: 1px;" src="<?php the_field('focus-cover2'); ?>" alt="Ngola Shops">
                </div>

                <div class="col-md-6 mosaic">
                    <h1 style="font-size: 27px; margin-bottom: 15px; color: #e91e63; text-transform: uppercase;" class="welcome-h"><?php the_field('focus-titre2'); ?></h1>
                    <div class="welcome-txt" style=" text-align: justify; color: black; line-height: 2.29; margin-bottom: 25px;">
                        <?php the_field('focus-text2'); ?>
                    </div>
                    <div class="full-width">
                        <a style="font-size: 20px;" href="#" class="accent bold">Découvrir
                            <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php } ?>
<!-- ##### CTA Area End ##### -->



<?php
get_footer();
?>

