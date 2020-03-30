<?php
get_header();



while (have_posts()) {
    the_post();
    ?>
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(<?php echo get_theme_file_uri('img/bg-img/breadcumb.jpg'); ?>);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2 style="text-transform: capitalize;">Nos Boutiques</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ##### Breadcumb Area End ##### -->
    <section style="padding: 90px 0px 90px 0px;">
        <div style="padding: 0 15px;">
            <?php the_content(); ?>
        </div>
    </section>
    <?php
}


get_footer();
?>