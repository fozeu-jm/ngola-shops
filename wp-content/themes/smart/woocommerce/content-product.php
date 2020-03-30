<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<!-- Single Product -->
<div style="padding: 0 5px;" class="col-6 col-sm-6 col-lg-4">
    <div class="single-product-wrapper">
        <!-- Product Image -->
        <?php
        $image = GetImageUrlsByProductId($product->get_id());
        $feature = getFeaturedImage($product->get_id());
        ?>
        <div class="product-img"> 
            <a href="<?php echo $product->get_permalink() ?>">
                <img src="<?php echo $feature; ?>" alt="">
                <!-- Hover Thumb -->
                <img class="hover-img" src="<?php echo $image[0]; ?>" alt="">
            </a>


            <!-- Product Badge -->
            <!--            <div class="product-badge offer-badge">
                            <span>-30%</span>
                        </div>-->
            <!-- Favourite -->
            <div class="product-favourite">
            </div>
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
            <span><?= $name; ?></span>
            <a href="<?php echo $product->get_permalink() ?>">
                <h6><?php echo $product->get_title() ?></h6>
            </a>
            <?php $prices = getProductPrice($product); ?>
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
?>
