<?php
defined('ABSPATH') || exit;

get_header();

do_action('woocommerce_before_main_content');
?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(<?php echo get_theme_file_uri('img/bg-img/breadcumb.jpg'); ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2><?php woocommerce_page_title(); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <?php
    do_action('woocommerce_archive_description');
    ?>
</div>
<!-- ##### Breadcumb Area End ##### -->

<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div id="almghty-row"  class="row">
            <?php do_action('woocommerce_sidebar'); ?>




            <?php
            if (woocommerce_product_loop()) {

                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();
                ?>
                <div class="row">

                    <?php
                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();

                            do_action('woocommerce_shop_loop');
                            ?>


                            <?php
                            wc_get_template_part('content', 'product');
                        }
                    }
                    woocommerce_product_loop_end();
                    ?>


                    <?php
                    do_action('woocommerce_after_shop_loop');
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <?php
} else {
    do_action('woocommerce_no_products_found');
}

do_action('woocommerce_after_main_content');



get_footer();
?>