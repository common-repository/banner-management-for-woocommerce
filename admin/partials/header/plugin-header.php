<?php

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
global $wcbm_fs;
$version_label = '';
$version_label = 'Free';
$plugin_slug = 'basic_woo_banner';
$plugin_name = 'Banner Management';
$wcbm_admin_object = new woocommerce_category_banner_management_Admin('', '');
?>

<div id="dotsstoremain">
    <div class="all-pad">
        <?php 
$wcbm_admin_object->wcbm_get_promotional_bar( $plugin_slug );
?>
        <header class="dots-header">
            <div class="dots-plugin-details">
                <div class="dots-header-left">
                    <div class="dots-logo-main">
                        <img  src="<?php 
echo esc_url( plugins_url( 'images/wcbm-logo.png', dirname( dirname( __FILE__ ) ) ) );
?>">
                    </div>
                    <div class="plugin-name">
                        <div class="title"><?php 
esc_html_e( $plugin_name, 'banner-management-for-woocommerce' );
?></div>
                    </div>
                    <span class="version-label <?php 
echo esc_attr( $plugin_slug );
?>"><?php 
echo esc_html_e( $version_label, 'banner-management-for-woocommerce' );
?></span>
                    <span class="version-number"><?php 
echo esc_html( 'v2.5.0' );
?></span>
                </div>
                <div class="dots-header-right">
                    <div class="button-dots">
                        <a target="_blank" href="<?php 
echo esc_url( 'http://www.thedotstore.com/support/' );
?>">
                            <?php 
esc_html_e( 'Support', 'banner-management-for-woocommerce' );
?>
                        </a>
                    </div>
                    <div class="button-dots">
                        <a target="_blank" href="<?php 
echo esc_url( 'https://www.thedotstore.com/feature-requests/' );
?>">
                            <?php 
esc_html_e( 'Suggest', 'banner-management-for-woocommerce' );
?>
                        </a>
                    </div>
                    <div class="button-dots <?php 
echo ( wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code() ? '' : 'last-link-button' );
?>">
                        <a target="_blank" href="<?php 
echo esc_url( 'https://docs.thedotstore.com/collection/252-banner-management' );
?>">
                            <?php 
esc_html_e( 'Help', 'banner-management-for-woocommerce' );
?>
                        </a>
                    </div>

                    <?php 
?>
                        <div class="button-dots">
                            <a class="dots-upgrade-btn" target="_blank" href="javascript:void(0);">
                                <?php 
esc_html_e( 'Upgrade Now', 'banner-management-for-woocommerce' );
?>
                            </a>
                        </div>
                    <?php 
?>
                </div>
            </div>
            <?php 
$wcbm_setting = '';
$wcbm_glob_setting = '';
$wcbm_banner_account = '';
$active_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$active_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$wbm_settings_menu = ( isset( $active_page ) && 'wcbm-banner-setting' === $active_page ? 'active' : '' );
$whsm_free_dashboard = ( isset( $active_page ) && 'wcbm-upgrade-dashboard' === $active_page ? 'active' : '' );
$wbm_display_submenu = ( !empty( $wbm_settings_menu ) && 'active' === $wbm_settings_menu ? 'display:inline-block' : 'display:none' );
$wbm_slider_menu = ( isset( $active_page ) && 'wcbm-sliders-settings' === $active_page ? 'display:inline-block' : 'display:none' );
if ( 'wcbm-banner-setting' === $active_page ) {
    $wcbm_setting = 'active';
}
if ( 'wcbm-banner-setting' === $active_page ) {
    $wcbm_glob_setting = 'active';
}
if ( empty( $active_tab ) && 'wcbm-banner-setting-account' === $active_page ) {
    $wcbm_banner_account = 'active';
}
if ( 'wcbm-plugin-get-started' === $active_page ) {
    $banner_active_tab = 'active';
} else {
    $banner_active_tab = '';
}
if ( !empty( $active_tab ) && 'wcbm-product-sliders' === $active_tab ) {
    $wcbm_product_slider_cls = 'active';
} else {
    $wcbm_product_slider_cls = '';
}
if ( !empty( $active_tab ) && 'wcbm-category-sliders' === $active_tab ) {
    $wcbm_category_slider_cls = 'active';
} else {
    $wcbm_category_slider_cls = '';
}
if ( !empty( $active_tab ) && ('wcbm-category-sliders' === $active_tab || 'wcbm-product-sliders' === $active_tab) ) {
    $slider_active_tab = 'active';
} else {
    $slider_active_tab = '';
}
?>
            <div class="dots-bottom-menu-main">
                <div class="dots-menu-main">
                    <nav>
                        <ul>
                            <li>
                                <a class="dotstore_plugin <?php 
echo esc_attr( $slider_active_tab );
?>" href="<?php 
echo esc_url( admin_url( '/admin.php?page=wcbm-sliders-settings&tab=wcbm-category-sliders' ) );
?>"><?php 
esc_html_e( 'Manage Slider', 'banner-management-for-woocommerce' );
?></a>
                            </li>
                            <li>
                                <a class="dotstore_plugin <?php 
echo esc_attr( $wcbm_setting );
?>" href="<?php 
echo esc_url( admin_url( '/admin.php?page=wcbm-banner-setting' ) );
?>"><?php 
esc_html_e( 'Settings', 'banner-management-for-woocommerce' );
?></a>
                            </li>
                            <?php 
if ( wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code() ) {
    ?>
                                    <li>
                                        <a class="dotstore_plugin <?php 
    echo esc_attr( $wcbm_banner_account );
    ?>" href="<?php 
    echo esc_url( $wcbm_fs->get_account_url() );
    ?>"><?php 
    esc_html_e( 'License', 'banner-management-for-woocommerce' );
    ?></a>
                                    </li>
                                <?php 
} else {
    ?>
                                <li>
                                    <a class="dotstore_plugin dots_get_premium <?php 
    echo esc_attr( $whsm_free_dashboard );
    ?>" href="<?php 
    echo esc_url( add_query_arg( array(
        'page' => 'wcbm-upgrade-dashboard',
    ), admin_url( 'admin.php' ) ) );
    ?>"><?php 
    esc_html_e( 'Get Premium', 'banner-management-for-woocommerce' );
    ?></a>
                                </li>
                                <?php 
}
?>
                        </ul>
                    </nav>
                </div>
                <div class="dots-getting-started">
                    <a href="<?php 
echo esc_url( add_query_arg( array(
    'page' => 'wcbm-plugin-get-started',
), admin_url( 'admin.php' ) ) );
?>" class="<?php 
echo esc_attr( $banner_active_tab );
?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z" fill="#a0a0a0"></path></svg></a>
                </div>
            </div>
        </header>
        <!-- Upgrade to pro popup -->
        <?php 
if ( !(wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code()) ) {
    require_once WCBM_PLUGIN_BASE_DIR . 'admin/partials/dots-upgrade-popup.php';
}
?>
        <div class="dots-settings-inner-main">
            <div class="dots-settings-left-side">
                <div class="dotstore-submenu-items" style="<?php 
echo esc_attr( $wbm_display_submenu );
?>">
                    <ul>
                        <li><a class="<?php 
echo esc_attr( $wcbm_glob_setting );
?>" href="<?php 
echo esc_url( add_query_arg( array(
    'page' => 'wcbm-banner-setting',
), admin_url( 'admin.php' ) ) );
?>"><?php 
esc_html_e( 'Global Settings', 'banner-management-for-woocommerce' );
?></a></li>
                        <li><a href="<?php 
echo esc_url( 'https://www.thedotstore.com/plugins/' );
?>" target="_blank"><?php 
esc_html_e( 'Shop Plugins', 'banner-management-for-woocommerce' );
?></a></li>
                    </ul>
                </div>
                <div class="dotstore-submenu-items" style="<?php 
echo esc_attr( $wbm_slider_menu );
?>">
                    <ul>
                        <li><a class="<?php 
echo esc_attr( $wcbm_category_slider_cls );
?>" href="<?php 
echo esc_url( add_query_arg( array(
    'page' => 'wcbm-sliders-settings',
    'tab'  => 'wcbm-category-sliders',
), admin_url( 'admin.php' ) ) );
?>"><?php 
esc_html_e( 'Category Slider', 'banner-management-for-woocommerce' );
?></a></li>
                        <li><a class="<?php 
echo esc_attr( $wcbm_product_slider_cls );
?>" href="<?php 
echo esc_url( add_query_arg( array(
    'page' => 'wcbm-sliders-settings',
    'tab'  => 'wcbm-product-sliders',
), admin_url( 'admin.php' ) ) );
?>"><?php 
esc_html_e( 'Product Slider', 'banner-management-for-woocommerce' );
?></a></li>
                    </ul>
                    <input type="hidden" name="dpb_api_url" id="dpb_api_url" value="<?php 
echo esc_url( WCBM_STORE_URL );
?>">
                </div>
                <hr class="wp-header-end" />


