<?php
get_header();
while (have_posts()) {
    the_post();
    ?>
    <div class="breadcumb_area bg-img" style="background-image: url(<?php echo get_theme_file_uri('img/bg-img/breadcumb.jpg'); ?>);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php the_title(); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php the_content() ?>
    </div>

    <?php
}
get_footer();
?>

