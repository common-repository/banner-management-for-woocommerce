<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once(plugin_dir_path(__FILE__) .'header/plugin-header.php');

?>
    <div class="wcbm-section-left">
        <div class="wcbm-main-table res-cl">
            <div class="dots-getting-started-main">
                <div class="getting-started-content">
                    <span><?php esc_html_e( 'How to Get Started', 'banner-management-for-woocommerce' ); ?></span>
                    <h3><?php esc_html_e( 'Welcome to Banner Management Plugin', 'banner-management-for-woocommerce' ); ?></h3>
                    <p><?php esc_html_e( 'Thank you for choosing our top-rated WooCommerce Banner Management plugin. Our user-friendly interface makes setting up different banners and sliders easy for effective promotions!', 'banner-management-for-woocommerce' ); ?></p>
                    <p>
                        <?php 
                        echo sprintf(
                            esc_html__('To help you get started, watch the quick tour video on the right. For more help, explore our help documents or visit our %s for detailed video tutorials.', 'banner-management-for-woocommerce'),
                            '<a href="' . esc_url('https://www.youtube.com/@Dotstore16') . '" target="_blank">' . esc_html__('YouTube channel', 'banner-management-for-woocommerce') . '</a>',
                        );
                        ?>
                    </p>
                    <div class="getting-started-actions">
                        <a href="<?php echo esc_url(add_query_arg(array('page' => 'wcbm-banner-setting'), admin_url('admin.php'))); ?>" class="quick-start"><?php esc_html_e( 'Manage Store Banners', 'banner-management-for-woocommerce' ); ?><span class="dashicons dashicons-arrow-right-alt"></span></a>
                        <a href="https://docs.thedotstore.com/article/955-beginners-guide-for-banner-management" target="_blank" class="setup-guide"><span class="dashicons dashicons-book-alt"></span><?php esc_html_e( 'Read the Setup Guide', 'banner-management-for-woocommerce' ); ?></a>
                    </div>
                </div>
                <div class="getting-started-video">
                    <iframe width="960" height="600" src="<?php echo esc_url('https://www.youtube.com/embed/4DYOlgSK5XI'); ?>" title="<?php esc_attr_e( 'Plugin Tour', 'banner-management-for-woocommerce' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
