<div class="col-12 col-md-4 col-lg-3">
    <div class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-50">
            <!--  Catagories  -->
            <div class="catagories-menu">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Name of Widgetized Area")) : ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div id="pricy-slide" class="widget price mb-50">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Name of Widgetized Area2")) : ?>
                <?php endif; ?>
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Filtrer par prix</h6>
           

            <div  class="widget-desc">
                <div style="width: 80%;" class="slider-range">
                    <div data-min="49" data-max="360" data-unit="<?php echo get_woocommerce_currency_symbol(); ?>" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Ranges:">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    
                    
                    <div class="range-price"></div>
                    <form style="display: none;" method="GET" action="<?php echo get_permalink(woocommerce_get_page_id('shop')) ?>">
                        <input name="min_price" class="min-input" type="text">
                        <input name="max_price" class="max-input" type="text">
                        <input id="price-submit" type="submit" class="form-control" value="Filtrer">
                    </form>
                </div>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <!--        <div class="widget color mb-50">
                     Widget Title 2 
                    <p class="widget-title2 mb-30">Color</p>
                    <div class="widget-desc">
                        <ul class="d-flex">
                            <li><a href="#" class="color1"></a></li>
                            <li><a href="#" class="color2"></a></li>
                            <li><a href="#" class="color3"></a></li>
                            <li><a href="#" class="color4"></a></li>
                            <li><a href="#" class="color5"></a></li>
                            <li><a href="#" class="color6"></a></li>
                            <li><a href="#" class="color7"></a></li>
                            <li><a href="#" class="color8"></a></li>
                            <li><a href="#" class="color9"></a></li>
                            <li><a href="#" class="color10"></a></li>
                        </ul>
                    </div>
                </div>-->

        <!-- ##### Single Widget ##### -->
        <div class="widget brands mb-50">
            <!-- Widget Title 2 -->
            <div class="widget-desc">
                 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("brand area")) : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>