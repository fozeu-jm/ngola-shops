<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_single_product');




if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
global $woocommerce;
//$woocommerce->cart->add_to_cart($product_id);

global $product;
?>
<?php if (isset($GLOBALS['success_message']) OR isset($GLOBALS['error_message'])) { ?> 
    <div class="woocommerce-notices-wrapper">
        <?php if (isset($GLOBALS['success_message'])) { ?>
            <div style="margin-bottom: 0px;" class="woocommerce-message" role="alert">
                <a href="#" tabindex="1" class="button wc-forward glissement">Voir panier</a> 
                <?php echo $GLOBALS['success_message']; ?>
            </div>
        <?php } elseif (isset($GLOBALS['error_message'])) { ?>
            <div style="margin-bottom: 0px; border-top-color: red;" class="woocommerce-message" role="alert">
                <a href="#" tabindex="1" class="button wc-forward glissement">Voir panier</a> 
                <?php echo $GLOBALS['error_message']; ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<section class="single_product_details_area">

    <!-- Single Product Thumb -->
    <div style="padding: 0;" class="container-fluid">
        <div style="margin: 0;" class="row">
            <!-- Single Product Thumbnails -->
            <div style="padding: 0px;" class="col-sm-12 col-lg-6">
                <?php
                $images = GetImageUrlsByProductId($product->get_id());
                $feature = getFeaturedImage($product->get_id());
                ?>
                <div class="product_thumbnail_slides ">
                    <img class="thumb-item" src="<?php echo $feature; ?>" alt="Ballerine by Kaizerwebdesign">
                    <?php foreach ($images as $img) { ?>
                        <img class="thumb-item" src="<?php echo $img; ?>" alt="">
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Single Product Description -->
            <div class="product-descri col-sm-12 col-lg-6">
                <?php
                $brands = wp_get_post_terms($product->get_id(), 'pwb-brand');
                $name = 'No name';
                foreach ($brands as $brand) {
                    $name = $brand->name . ' ';
                }
                ?>
                <span class="single-mark"><?= $name; ?></span>
                <a  href="#">
                    <h2 class="single-title"><?php echo $product->get_title() ?></h2>
                </a>
                <?php $prices = getProductPrice($product); ?>
                <p class="single-product-price">
                    <?php if ($prices['sale_price'] !== '') { ?>
                        <span class="single-old-price">  <?php echo number_format($prices['regular_price']) . ' ' . get_woocommerce_currency_symbol(); ?></span> <?php echo number_format($prices['sale_price']) . ' ' . get_woocommerce_currency_symbol(); ?>
                    <?php } else {
                        ?>
                        <?php
                        echo number_format($prices['regular_price']) . ' ' . get_woocommerce_currency_symbol();
                    }
                    ?>

                </p>
                <div style="padding: 0;" class="col-12">
                    <p style="text-align: justify;" class="single-product-desc">
                        <?php echo $product->get_description() ?>
                    </p>
                </div>


                <!-- Form -->
                <form class="cart-form clearfix"  method='post' enctype='multipart/form-data'>
                    <!-- Select Box -->
                    <?php if ($product->is_type('variable')) { ?>
                        <div style="margin-bottom: 42px;" id="testo" class="select-box  mt-50 mb-30">
                            <h5 style="display: block;"><?php echo getVarTitle($product); ?></h5>
                            <?php $list = getVarList($product); ?>
                            <select  required="true" name="var_id" id="productSize" class="mr-5">
                                <!--<option value="">Choissisez une option</option>-->
                                <?php foreach ($list as $value) { ?>
                                    <option value="<?php echo $value['variationid']; ?>"><?php echo $value['attributes']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div style=" margin-top: 40px; margin-bottom: 20px;" class="select-box ">
                        <div style="width: 40%;">
                            <label style="width: 100%;margin-top: 20px;" for="qty-input"> <h5>Quantité</h5></label>
                        </div>
                        <input style="width: 250px;" type="number" class="form-control cus-inp" id="qty-input" name="qty-inp" value="1" required=""> <br>
                        <input name="prod_id" type="hidden" value="<?php echo $product->get_id(); ?>">
                        <p>
                            <strong>Disponiblité : </strong> 
                            <?php
                            if ($product->is_type('variable')) {
                                if ($product->get_manage_stock()) {
                                    if (totalStockVariations($product) > 0) {
                                        echo $const = '<i class="stated">En Stock</i>';
                                    } else {
                                        echo $const = '<i class="stated">Stock Epuisé</i>';
                                    }
                                } else {
                                    echo $const = '<i class="stated">En Stock</i>';
                                }
                            } else {
                                if ($product->get_manage_stock()) {
                                    echo $const = $product->get_stock_quantity() ? '<i class="stated">En Stock</i>' : '<i class="stated">Stock Epuisé</i>';
                                } else {
                                    echo $const = '<i class="stated">En Stock</i>';
                                }
                            }
                            ?>
                        </p>
                    </div>

                    <!-- Cart & Favourite Box -->
                    <div class="cart-fav-box d-flex align-items-center">
                        <!-- Cart -->
                        <button type="submit" name="<?php echo $echo = $product->is_type('variable') ? 'ws-add-to-cart-var' : 'ws-add-to-cart'; ?>" value="5" class="btn essence-btn">Ajouter au panier</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?php
$cat = $product->get_category_ids()[0];
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page' => '-1',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms' => $cat,
            'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
        array(
            'taxonomy' => 'product_visibility',
            'field' => 'slug',
            'terms' => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
            'operator' => 'NOT IN'
        )
    )
);
$products = new WP_Query($args);
?>
<div class="container section-padding-80">
    <div class="row">
        <div class="col-12 section-heading">
            <h2 style="text-transform: uppercase; text-align: center; padding-top: 50px; font-size: 30px;">Produits <span class="accent">Similaire</span></h2>
        </div>
        <div class="col-12">
            <div class=" container ">
                <div class="row">
                    <div class="similar-products-slides">
                        <?php
                        $i = 0;
                        while ($products->have_posts()) {
                            $products->the_post();
                            if ($product->get_id() !== get_the_ID()) {
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
                                            <span>topshop</span>
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
                                                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop')) . '?add-to-cart=' . $product->get_id()); ?>" id="essenceCartBtn">
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
                                                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop')) . '?add-to-cart=' . $product->get_id()); ?>" class="btn essence-btn">Ajouter panier</a>
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
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>