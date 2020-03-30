<?php get_header() ?>

<section style="padding: 90px 0px 90px 0px;">
    <div class="container">
        <?php
        
        while (have_posts()) {
            the_post();
            the_content();
        }
        
        ?>
    </div>
</section>


<?php get_footer(); ?>