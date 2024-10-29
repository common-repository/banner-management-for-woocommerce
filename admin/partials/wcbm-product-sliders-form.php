<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to diplay the product sliders settings.
 *
 * @link       http://www.multidots.com/
 * @since      2.3.0
 *
 * @package    woocommerce_category_banner_management
 * @subpackage woocommerce_category_banner_management/admin/partials
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    exit;
}
$get_action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$get_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
/*
 * edit all posted data method define in class-woo-banner-management-admin
 */
if ( $get_action === 'edit' ) {
    if ( !empty( $get_id ) && $get_id !== "" ) {
        $get_post_id = ( isset( $get_id ) ? sanitize_text_field( wp_unslash( $get_id ) ) : '' );
        $dswbm_slider_status = get_post_status( $get_post_id );
        $dswbm_slider_rule_name = __( get_the_title( $get_post_id ), 'banner-management-for-woocommerce' );
        $wbm_product_slider_general_meta = get_post_meta( $get_post_id, 'wbm_product_slider_general_meta', true );
        if ( is_serialized( $wbm_product_slider_general_meta ) ) {
            $wbm_product_slider_general_meta = maybe_unserialize( $wbm_product_slider_general_meta );
        } else {
            $wbm_product_slider_general_meta = $wbm_product_slider_general_meta;
        }
        $wbm_product_slider_display_meta = get_post_meta( $get_post_id, 'wbm_product_slider_display_meta', true );
        if ( is_serialized( $wbm_product_slider_display_meta ) ) {
            $wbm_product_slider_display_meta = maybe_unserialize( $wbm_product_slider_display_meta );
        } else {
            $wbm_product_slider_display_meta = $wbm_product_slider_display_meta;
        }
        $wbm_product_slider_sliders_meta = get_post_meta( $get_post_id, 'wbm_product_slider_sliders_meta', true );
        if ( is_serialized( $wbm_product_slider_sliders_meta ) ) {
            $wbm_product_slider_sliders_meta = maybe_unserialize( $wbm_product_slider_sliders_meta );
        } else {
            $wbm_product_slider_sliders_meta = $wbm_product_slider_sliders_meta;
        }
        $wbm_product_slider_typo_meta = get_post_meta( $get_post_id, 'wbm_product_slider_typo', true );
        if ( is_serialized( $wbm_product_slider_typo_meta ) ) {
            $wbm_product_slider_typo_meta = maybe_unserialize( $wbm_product_slider_typo_meta );
        } else {
            $wbm_product_slider_typo_meta = $wbm_product_slider_typo_meta;
        }
        $title_text = esc_html__( 'Edit Slider', 'banner-management-for-woocommerce' );
    }
} else {
    $get_post_id = '';
    $dswbm_slider_status = '';
    $dswbm_slider_rule_name = '';
    $dswbm_slider_rule_name = ( !empty( $dswbm_slider_rule_name ) ? esc_attr( stripslashes( $dswbm_slider_rule_name ) ) : '' );
    $title_text = esc_html__( 'Add New Slider', 'banner-management-for-woocommerce' );
}
$dswbm_slider_status = ( !empty( $dswbm_slider_status ) && 'publish' === $dswbm_slider_status || empty( $dswbm_slider_status ) ? 'checked' : '' );
$dswbm_admin_object = new woocommerce_category_banner_management_Admin('', '');
?>
<div class="dswbm-slider-section-main">
	<h1 class="wp-heading-inline"><?php 
echo esc_html__( $title_text, 'banner-management-for-woocommerce' );
?></h1>
	<div class="dswbm_slider_rule_name">
		<input type="text" name="dswbm_prod_slider_rule_name" placeholder="<?php 
esc_attr_e( 'Add slider title', 'banner-management-for-woocommerce' );
?>" value="<?php 
echo esc_attr( $dswbm_slider_rule_name );
?>" required>
	</div>
	<div class="wbm-sliders-settings">
		<div class="sliders-settings-tabs">
			<ul>
				<li class="wbm-slider-tab active-tab"><a href="#wbm-slider-section-1"><?php 
echo esc_html__( "General Settings", 'banner-management-for-woocommerce' );
?></a></li>
				<li class="wbm-slider-tab"><a href="#wbm-slider-section-2"><?php 
echo esc_html__( "Display Options", 'banner-management-for-woocommerce' );
?></a></li>
				<li class="wbm-slider-tab"><a href="#wbm-slider-section-4"><?php 
echo esc_html__( "Thumbnail Settings", 'banner-management-for-woocommerce' );
?></a></li>
				<li class="wbm-slider-tab"><a href="#wbm-slider-section-3"><?php 
echo esc_html__( "Slider Settings", 'banner-management-for-woocommerce' );
?></a></li>
				<li class="wbm-slider-tab"><a href="#wbm-slider-section-5"><?php 
echo esc_html__( "Typography", 'banner-management-for-woocommerce' );
?></a></li>
			</ul>
		</div>
		<div class="wbm-sliders-table">
			<div id="wbm-slider-section-1" class="wbm-slider-section">
				<table class="form-table table-outer genral-settings-tbl">
					<tbody>
						<tr valign="top">
							<th class="titledesc" scope="row">
								<label for="dswbm_prod_slider_status"><?php 
esc_html_e( 'Status', 'banner-management-for-woocommerce' );
?></label>
								<span class="banner-woocommerce-help-tip">
									<div class="alert-desc">
										<?php 
esc_html_e( 'Enable or Disable this slider using this button (This slider will work only if it is enabled).', 'banner-management-for-woocommerce' );
?>
									</div>
								</span>
							</th>
							<td class="forminp">
								<label class="dswbm_toggle_switch">
									<input type="checkbox" id="dswbm_prod_slider_status" name="dswbm_prod_slider_status" value="on" <?php 
echo esc_attr( $dswbm_slider_status );
?>>
									<span class="dswbm_toggle_btn"></span>
								</label>
							</td>
						</tr>
						<?php 
if ( isset( $wbm_product_slider_general_meta ) && !empty( $wbm_product_slider_general_meta ) ) {
    foreach ( $wbm_product_slider_general_meta as $general_settings ) {
        $wbm_filter_products = ( isset( $general_settings['wbm_filter_products'] ) ? $general_settings['wbm_filter_products'] : '' );
        $wbm_choose_products = ( isset( $general_settings['wbm_choose_products'] ) ? $general_settings['wbm_choose_products'] : array() );
        $wbm_choose_by_cat = ( isset( $general_settings['wbm_choose_by_cat'] ) ? $general_settings['wbm_choose_by_cat'] : array() );
        $wbm_featured_products = ( isset( $general_settings['wbm_featured_products'] ) ? $general_settings['wbm_featured_products'] : array() );
        $wbm_exclude_products = ( isset( $general_settings['wbm_exclude_products'] ) ? $general_settings['wbm_exclude_products'] : array() );
        $wbm_total_prod_show = ( isset( $general_settings['wbm_total_prod_show'] ) ? $general_settings['wbm_total_prod_show'] : '' );
        $wbm_prod_order_by = ( isset( $general_settings['wbm_prod_order_by'] ) ? $general_settings['wbm_prod_order_by'] : '' );
        $wbm_prod_order = ( isset( $general_settings['wbm_prod_order'] ) ? $general_settings['wbm_prod_order'] : '' );
        $no_cols_large_desktop = ( isset( $general_settings['wbm_prod_no_of_cols']['large_desktop'] ) ? $general_settings['wbm_prod_no_of_cols']['large_desktop'] : '' );
        $no_cols_desktop = ( isset( $general_settings['wbm_prod_no_of_cols']['desktop'] ) ? $general_settings['wbm_prod_no_of_cols']['desktop'] : '' );
        $no_cols_laptop = ( isset( $general_settings['wbm_prod_no_of_cols']['laptop'] ) ? $general_settings['wbm_prod_no_of_cols']['laptop'] : '' );
        $no_cols_tablet = ( isset( $general_settings['wbm_prod_no_of_cols']['tablet'] ) ? $general_settings['wbm_prod_no_of_cols']['tablet'] : '' );
        $no_cols_mobile = ( isset( $general_settings['wbm_prod_no_of_cols']['mobile'] ) ? $general_settings['wbm_prod_no_of_cols']['mobile'] : '' );
        $dswbm_slider_mode = ( isset( $general_settings['dswbm_slider_mode'] ) && !empty( $general_settings['dswbm_slider_mode'] ) ? $general_settings['dswbm_slider_mode'] : 'standard' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="dswbm_cat_slider_status"><?php 
        esc_html_e( 'Slider Mode', 'banner-management-for-woocommerce' );
        ?></label>
									</th>
									<td class="forminp">
										<div class="dswbm-siblings dswbm--button-group" data-multiple="">
											<div class="dswbm--button <?php 
        echo ( 'standard' === $dswbm_slider_mode ? 'dswbm--active' : '' );
        ?>">
												<input type="radio" name="wbm_product_slider_general[dswbm_slider_mode]" value="standard" data-depend-id="wcsp_slider_mode" <?php 
        echo ( 'standard' === $dswbm_slider_mode ? 'checked' : '' );
        ?>>
												<label><?php 
        esc_html_e( 'Standard', 'banner-management-for-woocommerce' );
        ?></label>
											</div>
											<div class="dswbm--button <?php 
        echo ( 'ticker' === $dswbm_slider_mode ? 'dswbm--active' : '' );
        ?>">
												<input type="radio" name="wbm_product_slider_general[dswbm_slider_mode]" value="ticker" data-depend-id="wcsp_slider_mode" <?php 
        echo ( 'ticker' === $dswbm_slider_mode ? 'checked' : '' );
        ?>>
												<label><?php 
        esc_html_e( 'Ticker', 'banner-management-for-woocommerce' );
        ?></label>
											</div>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_filter_products"><?php 
        esc_html_e( 'Filter Products', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Select an option to filter the products.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_general[wbm_filter_products]" id="wbm_filter_products">
											<option value="wbm_all_products" <?php 
        echo ( esc_attr( 'wbm_all_products' === $wbm_filter_products ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'All', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="wbm_specific_products" <?php 
        echo ( esc_attr( 'wbm_specific_products' === $wbm_filter_products ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Specific Product(s)', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="wbm_featured_products" <?php 
        echo ( esc_attr( 'wbm_featured_products' === $wbm_filter_products ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Featured Product(s)', 'banner-management-for-woocommerce' );
        ?></option>
											<?php 
        ?>
												<option value="wbm_by_categories"><?php 
        esc_html_e( 'Specific Category(s) 🔒', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="wbm_exclude_product"><?php 
        esc_html_e( 'Exclude Product(s) 🔒', 'banner-management-for-woocommerce' );
        ?></option>
												<?php 
        ?>
										</select>
									</td>
								</tr>
								<tr class="wbm-select-featured-products">
									<th class="titledesc" scope="row">
										<label for="wbm_featured_products"><?php 
        esc_html_e( 'Choose Featured Product(s)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Choose the featured specific product(s) to show.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<?php 
        ?>
										<select name="wbm_product_slider_general[wbm_featured_products][]" multiple="multiple" id="wbm_featured_products" class="wbm-multiselect" data-placeholder="<?php 
        esc_attr_e( 'Select a featured product', 'banner-management-for-woocommerce' );
        ?>">
											<?php 
        // query for get featured products list
        // phpcs:disable
        $meta_query = WC()->query->get_meta_query();
        $tax_query = WC()->query->get_tax_query();
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        );
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'meta_query'     => $meta_query,
            'tax_query'      => $tax_query,
        );
        // phpcs:enable
        $featured_query = new WP_Query($args);
        if ( $featured_query->have_posts() ) {
            while ( $featured_query->have_posts() ) {
                $featured_query->the_post();
                if ( is_array( $wbm_featured_products ) && !empty( $wbm_featured_products ) ) {
                    foreach ( $wbm_featured_products as &$value ) {
                        $value = (int) $value;
                    }
                }
                ?>
												<option value="<?php 
                esc_attr_e( $featured_query->post->ID, 'banner-management-for-woocommerce' );
                ?>" <?php 
                echo ( in_array( $featured_query->post->ID, $wbm_featured_products, true ) ? 'selected' : '' );
                ?>><?php 
                esc_html_e( '#' . $featured_query->post->ID . ' ' . get_the_title(), 'banner-management-for-woocommerce' );
                ?></option>
											<?php 
            }
        }
        wp_reset_postdata();
        ?>
										</select>
									</td>
								</tr>
								<?php 
        ?>
								<tr valign="top" class="wbm-select-products">
									<th class="titledesc" scope="row">
										<label for="wbm_choose_products"><?php 
        esc_html_e( 'Choose Product(s)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Choose the specific product(s) to show.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_general[wbm_choose_products][]" multiple="multiple" id="wbm_choose_products" class="wbm-multiselect" data-placeholder="<?php 
        esc_attr_e( 'Select a Product', 'banner-management-for-woocommerce' );
        ?>">
											<?php 
        // get woocommerce products list
        $get_prod_args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );
        $product_query = new WP_Query($get_prod_args);
        if ( $product_query->have_posts() ) {
            while ( $product_query->have_posts() ) {
                $product_query->the_post();
                if ( is_array( $wbm_choose_products ) && !empty( $wbm_choose_products ) ) {
                    foreach ( $wbm_choose_products as &$prd ) {
                        $prd = (int) $prd;
                    }
                }
                ?>
													<option value="<?php 
                esc_attr_e( $product_query->post->ID, 'banner-management-for-woocommerce' );
                ?>" <?php 
                echo ( in_array( $product_query->post->ID, $wbm_choose_products, true ) ? 'selected' : '' );
                ?>><?php 
                esc_html_e( '#' . $product_query->post->ID . ' ' . get_the_title(), 'banner-management-for-woocommerce' );
                ?></option>
													<?php 
            }
        }
        wp_reset_postdata();
        ?>
										</select>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_total_prod_show"><?php 
        esc_html_e( 'Total Products to Show', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Total number of products to display.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<input type="number" id="wbm_total_prod_show" min="1" name="wbm_product_slider_general[wbm_total_prod_show]" value="<?php 
        echo esc_attr( $wbm_total_prod_show );
        ?>">
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Product Column(s)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        $alert_desc = __( 'Set number of column(s) in different devices for responsive view.<p><span><i class="fa fa-television"></i>LARGE DESKTOP - Screens larger than 1280px.</span><span><i class="fa fa-desktop"></i>DESKTOP - Screens smaller than 1280px.</span><span><i class="fa fa-laptop"></i>LAPTOP - Screens smaller than 980px.</span><span><i class="fa fa-tablet-screen-button"></i>TABLET - Screens smaller than 736px.</span><span><i class="fa fa-mobile-screen-button"></i>MOBILE - Screens smaller than 480px.</span></p>', 'banner-management-for-woocommerce' );
        ?>
												<?php 
        echo wp_kses( $alert_desc, $dswbm_admin_object->wcbm_allowed_html_tags() );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<div class="wbm-mo-parent">
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-television"></i>
												</span>
												<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][large_desktop]" value="<?php 
        echo esc_attr( $no_cols_large_desktop );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-desktop"></i>
												</span>
												<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][desktop]" value="<?php 
        echo esc_attr( $no_cols_desktop );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-laptop"></i>
												</span>
												<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][laptop]" value="<?php 
        echo esc_attr( $no_cols_laptop );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-tablet-screen-button"></i>
												</span>
												<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][tablet]" value="<?php 
        echo esc_attr( $no_cols_tablet );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-mobile-screen-button"></i>
												</span>
												<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][mobile]" value="<?php 
        echo esc_attr( $no_cols_mobile );
        ?>">
											</div>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_order_by"><?php 
        esc_html_e( 'Order by', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Select an order by option.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_general[wbm_prod_order_by]" id="wbm_prod_order_by">
											<option value="ID" <?php 
        echo ( esc_attr( 'ID' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'ID', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="title" <?php 
        echo ( esc_attr( 'title' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Name', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="date" <?php 
        echo ( esc_attr( 'date' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Date', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="modified" <?php 
        echo ( esc_attr( 'modified' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Modified', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="rand" <?php 
        echo ( esc_attr( 'rand' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Random', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="none" <?php 
        echo ( esc_attr( 'none' === $wbm_prod_order_by ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'None', 'banner-management-for-woocommerce' );
        ?></option>
										</select>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_order"><?php 
        esc_html_e( 'Order', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Select an order option.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_general[wbm_prod_order]" id="wbm_prod_order">
											<option value="ASC" <?php 
        echo ( esc_attr( 'ASC' === $wbm_prod_order ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Ascending', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="DESC" <?php 
        echo ( esc_attr( 'DESC' === $wbm_prod_order ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Descending', 'banner-management-for-woocommerce' );
        ?></option>
										</select>
									</td>
								</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="dswbm_cat_slider_status"><?php 
    esc_html_e( 'Slider Mode', 'banner-management-for-woocommerce' );
    ?></label>
								</th>
								<td class="forminp">
									<div class="dswbm-siblings dswbm--button-group" data-multiple="">
										<div class="dswbm--button dswbm--active">
											<input type="radio" name="wbm_product_slider_general[dswbm_slider_mode]" value="standard" data-depend-id="wcsp_slider_mode">
											<label><?php 
    esc_html_e( 'Standard', 'banner-management-for-woocommerce' );
    ?></label>
										</div>
										<div class="dswbm--button">
											<input type="radio" name="wbm_product_slider_general[dswbm_slider_mode]" value="ticker" data-depend-id="wcsp_slider_mode">
											<label><?php 
    esc_html_e( 'Ticker', 'banner-management-for-woocommerce' );
    ?></label>
										</div>
									</div>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_filter_products"><?php 
    esc_html_e( 'Filter Products', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Select an option to filter the products.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<select name="wbm_product_slider_general[wbm_filter_products]" id="wbm_filter_products">
										<option value="wbm_all_products"><?php 
    esc_html_e( 'All', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="wbm_specific_products"><?php 
    esc_html_e( 'Specific Product(s)', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="wbm_featured_products"><?php 
    esc_html_e( 'Featured Product(s)', 'banner-management-for-woocommerce' );
    ?></option>
										<?php 
    ?>
											<option value="wbm_by_categories"><?php 
    esc_html_e( 'Specific Category(s) 🔒', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="wbm_exclude_product"><?php 
    esc_html_e( 'Exclude Product(s) 🔒', 'banner-management-for-woocommerce' );
    ?></option>
											<?php 
    ?>
									</select>
								</td>
							</tr>
							<tr class="wbm-select-featured-products">
								<th class="titledesc" scope="row">
									<label for="wbm_featured_products"><?php 
    esc_html_e( 'Choose Featured Product(s)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Choose the featured specific product(s) to show.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<?php 
    ?>
									<select name="wbm_product_slider_general[wbm_featured_products][]" multiple="multiple" id="wbm_featured_products" class="wbm-multiselect" data-placeholder="<?php 
    esc_attr_e( 'Select a featured product', 'banner-management-for-woocommerce' );
    ?>">
										<?php 
    // query for get featured products list
    $meta_query = WC()->query->get_meta_query();
    $tax_query = WC()->query->get_tax_query();
    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'featured',
        'operator' => 'IN',
    );
    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => $meta_query,
        'tax_query'      => $tax_query,
    );
    $featured_query = new WP_Query($args);
    if ( $featured_query->have_posts() ) {
        while ( $featured_query->have_posts() ) {
            $featured_query->the_post();
            ?>
											<option value="<?php 
            esc_attr_e( $featured_query->post->ID, 'banner-management-for-woocommerce' );
            ?>"><?php 
            esc_html_e( '#' . $featured_query->post->ID . ' ' . get_the_title(), 'banner-management-for-woocommerce' );
            ?></option>
										<?php 
        }
    }
    wp_reset_postdata();
    ?>
									</select>
								</td>
							</tr>
							<?php 
    ?>
							<tr valign="top" class="wbm-select-products">
								<th class="titledesc" scope="row">
									<label for="wbm_choose_products"><?php 
    esc_html_e( 'Choose Product(s)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Choose the specific product(s) to show.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<select name="wbm_product_slider_general[wbm_choose_products][]" multiple="multiple" id="wbm_choose_products" class="wbm-multiselect" data-placeholder="<?php 
    esc_attr_e( 'Select a Product', 'banner-management-for-woocommerce' );
    ?>">
										<?php 
    // get woocommerce products list
    $get_prod_args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
    $product_query = new WP_Query($get_prod_args);
    if ( $product_query->have_posts() ) {
        while ( $product_query->have_posts() ) {
            $product_query->the_post();
            ?>
												<option value="<?php 
            esc_attr_e( $product_query->post->ID, 'banner-management-for-woocommerce' );
            ?>"><?php 
            esc_html_e( '#' . $product_query->post->ID . ' ' . get_the_title(), 'banner-management-for-woocommerce' );
            ?></option>
												<?php 
        }
    }
    wp_reset_postdata();
    ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_total_prod_show"><?php 
    esc_html_e( 'Total Products to Show', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Total number of products to display.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<input type="number" id="wbm_total_prod_show" min="1" name="wbm_product_slider_general[wbm_total_prod_show]" value="15">
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Product Column(s)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    $alert_desc = __( 'Set number of column(s) in different devices for responsive view.<p><span><i class="fa fa-television"></i>LARGE DESKTOP - Screens larger than 1280px.</span><span><i class="fa fa-desktop"></i>DESKTOP - Screens smaller than 1280px.</span><span><i class="fa fa-laptop"></i>LAPTOP - Screens smaller than 980px.</span><span><i class="fa fa-tablet-screen-button"></i>TABLET - Screens smaller than 736px.</span><span><i class="fa fa-mobile-screen-button"></i>MOBILE - Screens smaller than 480px.</span></p>', 'banner-management-for-woocommerce' );
    ?>
											<?php 
    echo wp_kses( $alert_desc, $dswbm_admin_object->wcbm_allowed_html_tags() );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<div class="wbm-mo-parent">
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-television"></i>
											</span>
											<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][large_desktop]" value="4">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-desktop"></i>
											</span>
											<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][desktop]" value="3">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-laptop"></i>
											</span>
											<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][laptop]" value="2">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-tablet-screen-button"></i>
											</span>
											<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][tablet]" value="2">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-mobile-screen-button"></i>
											</span>
											<input type="number" class="wbm_prod_no_of_cols" min="1" name="wbm_product_slider_general[wbm_prod_no_of_cols][mobile]" value="1">
										</div>
									</div>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_order_by"><?php 
    esc_html_e( 'Order by', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Select an order by option.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<select name="wbm_product_slider_general[wbm_prod_order_by]" id="wbm_prod_order_by">
										<option value="ID"><?php 
    esc_html_e( 'ID', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="title"><?php 
    esc_html_e( 'Name', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="date"><?php 
    esc_html_e( 'Date', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="modified"><?php 
    esc_html_e( 'Modified', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="rand"><?php 
    esc_html_e( 'Random', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="none"><?php 
    esc_html_e( 'None', 'banner-management-for-woocommerce' );
    ?></option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_order"><?php 
    esc_html_e( 'Order', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Select an order option.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<select name="wbm_product_slider_general[wbm_prod_order]" id="wbm_prod_order">
										<option value="ASC"><?php 
    esc_html_e( 'Ascending', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="DESC"><?php 
    esc_html_e( 'Descending', 'banner-management-for-woocommerce' );
    ?></option>
									</select>
								</td>
							</tr>
							<?php 
}
?>
					</tbody>
				</table>
			</div>
			<div id="wbm-slider-section-2" class="wbm-slider-section">
				<table class="form-table table-outer genral-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_display_meta ) && !empty( $wbm_product_slider_display_meta ) ) {
    foreach ( $wbm_product_slider_display_meta as $display_settings ) {
        $wbm_prod_title = ( isset( $display_settings['wbm_prod_title'] ) ? $display_settings['wbm_prod_title'] : '' );
        $wbm_prod_title_color = ( isset( $display_settings['wbm_prod_title_color'] ) ? $display_settings['wbm_prod_title_color'] : '' );
        $sec_title_top_margin = ( isset( $display_settings['wbm_prod_title_margin']['top'] ) ? $display_settings['wbm_prod_title_margin']['top'] : '' );
        $sec_title_right_margin = ( isset( $display_settings['wbm_prod_title_margin']['right'] ) ? $display_settings['wbm_prod_title_margin']['right'] : '' );
        $sec_title_bottom_margin = ( isset( $display_settings['wbm_prod_title_margin']['bottom'] ) ? $display_settings['wbm_prod_title_margin']['bottom'] : '' );
        $sec_title_left_margin = ( isset( $display_settings['wbm_prod_title_margin']['left'] ) ? $display_settings['wbm_prod_title_margin']['left'] : '' );
        $sec_title_margin_unit = ( isset( $display_settings['wbm_prod_title_margin']['unit'] ) ? $display_settings['wbm_prod_title_margin']['unit'] : '' );
        $wbm_prod_space_between = ( isset( $display_settings['wbm_prod_space_between'] ) ? $display_settings['wbm_prod_space_between'] : '' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_title"><?php 
        esc_html_e( 'Section Title', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Show/Hide product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_title" name="wbm_product_slider_display[wbm_prod_title]" value="on" <?php 
        checked( $wbm_prod_title, 'on' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top" class="wbm-prod-sec-title-field">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_title_color"><?php 
        esc_html_e( 'Section Title Color', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set color for product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<input type="text" id="wbm_prod_title_color" class="wbm_sliders_colorpick" name="wbm_product_slider_display[wbm_prod_title_color]" value="<?php 
        esc_attr_e( $wbm_prod_title_color, 'banner-management-for-woocommerce' );
        ?>">
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field wbm-prod-sec-title-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Margin from Section Title', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set margin for product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<div class="wbm-mo-parent">
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-up"></i>
												</span>
												<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][top]" value="<?php 
        echo esc_attr( $sec_title_top_margin );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-right"></i>
												</span>
												<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][right]" value="<?php 
        echo esc_attr( $sec_title_right_margin );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-down"></i>
												</span>
												<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][bottom]" value="<?php 
        echo esc_attr( $sec_title_bottom_margin );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-left"></i>
												</span>
												<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][left]" value="<?php 
        echo esc_attr( $sec_title_left_margin );
        ?>">
											</div>
											<div class="wbm-multi-option-input">
												<select name="wbm_product_slider_display[wbm_prod_title_margin][unit]" id="pro_sec_title_margin_unit">
													<option value="px" <?php 
        echo ( esc_attr( 'px' === $sec_title_margin_unit ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'px', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="em" <?php 
        echo ( esc_attr( 'em' === $sec_title_margin_unit ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'em', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_space_between"><?php 
        esc_html_e( 'Space Between Products (px)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set space between each slide.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<input type="number" id="wbm_prod_space_between" min="0" name="wbm_product_slider_display[wbm_prod_space_between]" value="<?php 
        echo esc_attr( $wbm_prod_space_between );
        ?>">
									</td>
								</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_title"><?php 
    esc_html_e( 'Section Title', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Show/Hide product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch">
										<input type="checkbox" id="wbm_prod_title" name="wbm_product_slider_display[wbm_prod_title]" value="on">
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top" class="wbm-prod-sec-title-field">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_title_color"><?php 
    esc_html_e( 'Section Title Color', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set color for product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<input type="text" id="wbm_prod_title_color" class="wbm_sliders_colorpick" name="wbm_product_slider_display[wbm_prod_title_color]" value="">
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field wbm-prod-sec-title-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Margin from Section Title', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set margin for product slider\'s rule/section title.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<div class="wbm-mo-parent">
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-long-arrow-up"></i>
											</span>
											<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][top]" value="0">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-long-arrow-right"></i>
											</span>
											<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][right]" value="0">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-long-arrow-down"></i>
											</span>
											<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][bottom]" value="30">
										</div>
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-long-arrow-left"></i>
											</span>
											<input type="number" class="wbm_prod_title_margin" min="0" name="wbm_product_slider_display[wbm_prod_title_margin][left]" value="0">
										</div>
										<div class="wbm-multi-option-input">
											<select name="wbm_product_slider_display[wbm_prod_title_margin][unit]" id="pro_sec_title_margin_unit">
												<option value="px"><?php 
    esc_html_e( 'px', 'banner-management-for-woocommerce' );
    ?></option>
												<option value="em"><?php 
    esc_html_e( 'em', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_space_between"><?php 
    esc_html_e( 'Space Between Products (px)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set space between each slide.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<input type="number" id="wbm_prod_space_between" min="0" name="wbm_product_slider_display[wbm_prod_space_between]" value="20">
								</td>
							</tr>
							<?php 
}
?>
					</tbody>
				</table>
			</div>
			<div id="wbm-slider-section-3" class="wbm-slider-section">
				<table class="form-table table-outer sliders-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_sliders_meta ) && !empty( $wbm_product_slider_sliders_meta ) ) {
    foreach ( $wbm_product_slider_sliders_meta as $sliders_settings ) {
        $wbm_prod_autoplay = ( isset( $sliders_settings['wbm_prod_autoplay'] ) ? $sliders_settings['wbm_prod_autoplay'] : '' );
        $wbm_prod_autoplay_speed = ( isset( $sliders_settings['wbm_prod_autoplay_speed'] ) ? $sliders_settings['wbm_prod_autoplay_speed'] : '' );
        $wbm_prod_scroll_speed = ( isset( $sliders_settings['wbm_prod_scroll_speed'] ) ? $sliders_settings['wbm_prod_scroll_speed'] : '' );
        $wbm_prod_pause_on_hov = ( isset( $sliders_settings['wbm_prod_pause_on_hov'] ) ? $sliders_settings['wbm_prod_pause_on_hov'] : '' );
        $wbm_prod_infinite_loop = ( isset( $sliders_settings['wbm_prod_infinite_loop'] ) ? $sliders_settings['wbm_prod_infinite_loop'] : '' );
        $wbm_prod_auto_height = ( isset( $sliders_settings['wbm_prod_auto_height'] ) ? $sliders_settings['wbm_prod_auto_height'] : '' );
        $wbm_cat_slide_to_scroll_large_desktop = ( isset( $sliders_settings['wbm_prod_slide_to_scroll']['large_desktop'] ) ? $sliders_settings['wbm_prod_slide_to_scroll']['large_desktop'] : '' );
        $wbm_cat_slide_to_scroll_desktop = ( isset( $sliders_settings['wbm_prod_slide_to_scroll']['desktop'] ) ? $sliders_settings['wbm_prod_slide_to_scroll']['desktop'] : '' );
        $wbm_cat_slide_to_scroll_laptop = ( isset( $sliders_settings['wbm_prod_slide_to_scroll']['laptop'] ) ? $sliders_settings['wbm_prod_slide_to_scroll']['laptop'] : '' );
        $wbm_cat_slide_to_scroll_tablet = ( isset( $sliders_settings['wbm_prod_slide_to_scroll']['tablet'] ) ? $sliders_settings['wbm_prod_slide_to_scroll']['tablet'] : '' );
        $wbm_cat_slide_to_scroll_mobile = ( isset( $sliders_settings['wbm_prod_slide_to_scroll']['mobile'] ) ? $sliders_settings['wbm_prod_slide_to_scroll']['mobile'] : '' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_autoplay"><?php 
        esc_html_e( 'AutoPlay', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable auto play.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_autoplay" name="wbm_product_slider_sliders[wbm_prod_autoplay]" value="true" <?php 
        checked( $wbm_prod_autoplay, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_autoplay_speed"><?php 
        esc_html_e( 'AutoPlay Speed (ms)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set auto play speed. Default value is 2000 milliseconds.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<input type="number" id="wbm_prod_autoplay_speed" min="1" name="wbm_product_slider_sliders[wbm_prod_autoplay_speed]" value="<?php 
        echo esc_attr( $wbm_prod_autoplay_speed );
        ?>">
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_scroll_speed"><?php 
        esc_html_e( 'Scroll Speed (ms)', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set pagination/slide scroll speed. Default value is 600 milliseconds.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<input type="number" id="wbm_prod_scroll_speed" min="1" name="wbm_product_slider_sliders[wbm_prod_scroll_speed]" value="<?php 
        echo esc_attr( $wbm_prod_scroll_speed );
        ?>">
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_pause_on_hov"><?php 
        esc_html_e( 'Pause on Hover', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable slider pause on hover.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_pause_on_hov" name="wbm_product_slider_sliders[wbm_prod_pause_on_hov]" value="true" <?php 
        checked( $wbm_prod_pause_on_hov, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_infinite_loop"><?php 
        esc_html_e( 'Infinite Loop', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable infinite loop mode.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_infinite_loop" name="wbm_product_slider_sliders[wbm_prod_infinite_loop]" value="true" <?php 
        checked( $wbm_prod_infinite_loop, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_auto_height"><?php 
        esc_html_e( 'Auto Height', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable auto height.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_auto_height" name="wbm_product_slider_sliders[wbm_prod_auto_height]" value="true" <?php 
        checked( $wbm_prod_auto_height, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field">
								<th class="titledesc" scope="row">
									<label><?php 
        esc_html_e( 'Slide To Scroll', 'banner-management-for-woocommerce' );
        ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
        esc_html_e( 'Set slide to scroll in different devices.', 'banner-management-for-woocommerce' );
        ?>
										</div>
									</span>
									<p class="description" style="display:none;"></p>
								</th>
								<td class="forminp">
								<div class="wbm-mo-parent">
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-television"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][large_desktop]" value="<?php 
        echo esc_attr( $wbm_cat_slide_to_scroll_large_desktop );
        ?>">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-desktop"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][desktop]" value="<?php 
        echo esc_attr( $wbm_cat_slide_to_scroll_desktop );
        ?>">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-laptop"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][laptop]" value="<?php 
        echo esc_attr( $wbm_cat_slide_to_scroll_laptop );
        ?>">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-tablet-screen-button"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][tablet]" value="<?php 
        echo esc_attr( $wbm_cat_slide_to_scroll_tablet );
        ?>">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-mobile-screen-button"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][mobile]" value="<?php 
        echo esc_attr( $wbm_cat_slide_to_scroll_mobile );
        ?>">
									</div>
								</div>
								</td>
							</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_autoplay"><?php 
    esc_html_e( 'AutoPlay', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable auto play.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch">
										<input type="checkbox" id="wbm_prod_autoplay" name="wbm_product_slider_sliders[wbm_prod_autoplay]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_autoplay_speed"><?php 
    esc_html_e( 'AutoPlay Speed (ms)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set auto play speed. Default value is 2000 milliseconds.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<input type="number" id="wbm_prod_autoplay_speed" min="1" name="wbm_product_slider_sliders[wbm_prod_autoplay_speed]" value="2000">
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_scroll_speed"><?php 
    esc_html_e( 'Scroll Speed (ms)', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set pagination/slide scroll speed. Default value is 600 milliseconds.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<input type="number" id="wbm_prod_scroll_speed" min="1" name="wbm_product_slider_sliders[wbm_prod_scroll_speed]" value="600">
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_pause_on_hov"><?php 
    esc_html_e( 'Pause on Hover', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable slider pause on hover.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch">
										<input type="checkbox" id="wbm_prod_pause_on_hov" name="wbm_product_slider_sliders[wbm_prod_pause_on_hov]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_infinite_loop"><?php 
    esc_html_e( 'Infinite Loop', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable infinite loop mode.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch">
										<input type="checkbox" id="wbm_prod_infinite_loop" name="wbm_product_slider_sliders[wbm_prod_infinite_loop]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_auto_height"><?php 
    esc_html_e( 'Auto Height', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable auto height.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch">
										<input type="checkbox" id="wbm_prod_auto_height" name="wbm_product_slider_sliders[wbm_prod_auto_height]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Slide To Scroll', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set slide to scroll in different devices.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
									<p class="description" style="display:none;"></p>
								</th>
								<td class="forminp">
								<div class="wbm-mo-parent">
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-television"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][large_desktop]" value="1">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-desktop"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][desktop]" value="1">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-laptop"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][laptop]" value="1">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-tablet-screen-button"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][tablet]" value="1">
									</div>
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-mobile-screen-button"></i>
										</span>
										<input type="number" class="wbm_prod_slide_to_scroll" min="1" name="wbm_product_slider_sliders[wbm_prod_slide_to_scroll][mobile]" value="1">
									</div>
								</div>
								</td>
							</tr>
							<?php 
}
?>
					</tbody>
				</table>
				<div class="wbm-slider-sub-field">
					<span><?php 
esc_html_e( 'Navigation Settings', 'banner-management-for-woocommerce' );
?></span>
				</div>
				<table class="form-table table-outer sliders-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_sliders_meta ) && !empty( $wbm_product_slider_sliders_meta ) ) {
    foreach ( $wbm_product_slider_sliders_meta as $sliders_settings ) {
        $wbm_prod_nav_status = ( isset( $sliders_settings['wbm_prod_nav_status'] ) ? $sliders_settings['wbm_prod_nav_status'] : '' );
        $wbm_prod_nav_color = ( isset( $sliders_settings['wbm_prod_nav_color']['color'] ) ? $sliders_settings['wbm_prod_nav_color']['color'] : '' );
        $wbm_prod_nav_hov_color = ( isset( $sliders_settings['wbm_prod_nav_color']['hover_color'] ) ? $sliders_settings['wbm_prod_nav_color']['hover_color'] : '' );
        $wbm_prod_nav_bg_color = ( isset( $sliders_settings['wbm_prod_nav_color']['bg_color'] ) ? $sliders_settings['wbm_prod_nav_color']['bg_color'] : '' );
        $wbm_prod_nav_hov_bg_color = ( isset( $sliders_settings['wbm_prod_nav_color']['bg_hover_color'] ) ? $sliders_settings['wbm_prod_nav_color']['bg_hover_color'] : '' );
        $wbm_prod_nav_all_border = ( isset( $sliders_settings['wbm_prod_nav_border']['all'] ) ? $sliders_settings['wbm_prod_nav_border']['all'] : '' );
        $wbm_prod_nav_border_style = ( isset( $sliders_settings['wbm_prod_nav_border']['style'] ) ? $sliders_settings['wbm_prod_nav_border']['style'] : '' );
        $wbm_prod_nav_border_color = ( isset( $sliders_settings['wbm_prod_nav_border']['color'] ) ? $sliders_settings['wbm_prod_nav_border']['color'] : '' );
        $wbm_prod_nav_border_hov_color = ( isset( $sliders_settings['wbm_prod_nav_border']['hover_color'] ) ? $sliders_settings['wbm_prod_nav_border']['hover_color'] : '' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Navigation', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Show/Hide slider navigation.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<span class="wbm_radio_toggle_btn">
											<label for="wbm_prod_nav_show">
												<input type="radio" id="wbm_prod_nav_show" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="true" <?php 
        checked( $wbm_prod_nav_status, 'true' );
        ?>><?php 
        esc_html_e( 'Show', 'banner-management-for-woocommerce' );
        ?>
											</label>
											<label for="wbm_prod_nav_hide">
												<input type="radio" id="wbm_prod_nav_hide" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="false" <?php 
        checked( $wbm_prod_nav_status, 'false' );
        ?>><?php 
        esc_html_e( 'Hide', 'banner-management-for-woocommerce' );
        ?>
											</label>
											<label for="wbm_prod_nav_hide_on_mobile">
												<input type="radio" id="wbm_prod_nav_hide_on_mobile" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="false-mobile" <?php 
        checked( $wbm_prod_nav_status, 'false-mobile' );
        ?>><?php 
        esc_html_e( 'Hide on Mobile', 'banner-management-for-woocommerce' );
        ?>
											</label>
										</span>
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field wbm-prod-nav-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Navigation Color', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set color for the slider navigation.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
									<div class="wbm-mo-parent">
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][hover_color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_hov_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Background', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][bg_color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_bg_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Hover Background', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][bg_hover_color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_hov_bg_color );
        ?>">
										</div>
									</div>
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field wbm-prod-nav-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Navigation Border', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set border for the slider navigation.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
									<div class="wbm-mo-parent">
										<div class="wbm-multi-option-input">
											<span class="wbm-multi-option-icon">
												<i class="fa fa-arrows"></i>
											</span>
											<input type="number" class="wbm_prod_nav_border" min="0" name="wbm_product_slider_sliders[wbm_prod_nav_border][all]" value="<?php 
        echo esc_attr( $wbm_prod_nav_all_border );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<select name="wbm_product_slider_sliders[wbm_prod_nav_border][style]">
												<option value="solid" <?php 
        echo ( esc_attr( 'solid' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Solid', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="dashed" <?php 
        echo ( esc_attr( 'dashed' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Dashed', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="dotted" <?php 
        echo ( esc_attr( 'dotted' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Dotted', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="double" <?php 
        echo ( esc_attr( 'double' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Double', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="inset" <?php 
        echo ( esc_attr( 'inset' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="outset" <?php 
        echo ( esc_attr( 'outset' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="groove" <?php 
        echo ( esc_attr( 'groove' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Groove', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="ridge" <?php 
        echo ( esc_attr( 'ridge' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Ridge', 'banner-management-for-woocommerce' );
        ?></option>
												<option value="none" <?php 
        echo ( esc_attr( 'none' === $wbm_prod_nav_border_style ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'None', 'banner-management-for-woocommerce' );
        ?></option>
											</select>
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_border][color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_border_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_border][hover_color]" value="<?php 
        echo esc_attr( $wbm_prod_nav_border_hov_color );
        ?>">
										</div>
										</div>
									</td>
								</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Navigation', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Show/Hide slider navigation.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<span class="wbm_radio_toggle_btn">
										<label for="wbm_prod_nav_show">
											<input type="radio" id="wbm_prod_nav_show" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="true" checked><?php 
    esc_html_e( 'Show', 'banner-management-for-woocommerce' );
    ?>
										</label>
										<label for="wbm_prod_nav_hide">
											<input type="radio" id="wbm_prod_nav_hide" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="false"><?php 
    esc_html_e( 'Hide', 'banner-management-for-woocommerce' );
    ?>
										</label>
										<label for="wbm_prod_nav_hide_on_mobile">
											<input type="radio" id="wbm_prod_nav_hide_on_mobile" name="wbm_product_slider_sliders[wbm_prod_nav_status]" value="false-mobile"><?php 
    esc_html_e( 'Hide on Mobile', 'banner-management-for-woocommerce' );
    ?>
										</label>
									</span>
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field wbm-prod-nav-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Navigation Color', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set color for the slider navigation.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
								<div class="wbm-mo-parent">
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][color]" value="#aaaaaa">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][hover_color]" value="">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Background', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][bg_color]" value="transparent">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Hover Background', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_color][bg_hover_color]" value="">
									</div>
								</div>
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field wbm-prod-nav-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Navigation Border', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set border for the slider navigation.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
								<div class="wbm-mo-parent">
									<div class="wbm-multi-option-input">
										<span class="wbm-multi-option-icon">
											<i class="fa fa-arrows"></i>
										</span>
										<input type="number" class="wbm_prod_nav_border" min="0" name="wbm_product_slider_sliders[wbm_prod_nav_border][all]" value="1">
									</div>
									<div class="wbm-multi-option-input">
										<select name="wbm_product_slider_sliders[wbm_prod_nav_border][style]">
											<option value="solid"><?php 
    esc_html_e( 'Solid', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="dashed"><?php 
    esc_html_e( 'Dashed', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="dotted"><?php 
    esc_html_e( 'Dotted', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="double"><?php 
    esc_html_e( 'Double', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="inset"><?php 
    esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="outset"><?php 
    esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="groove"><?php 
    esc_html_e( 'Groove', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="ridge"><?php 
    esc_html_e( 'Ridge', 'banner-management-for-woocommerce' );
    ?></option>
											<option value="none"><?php 
    esc_html_e( 'None', 'banner-management-for-woocommerce' );
    ?></option>
										</select>
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_border][color]" value="#aaaaaa">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_nav_border][hover_color]" value="">
									</div>
									</div>
								</td>
							</tr>
							<?php 
}
?>
					</tbody>
				</table>
				<div class="wbm-slider-sub-field">
					<span><?php 
esc_html_e( 'Pagination Settings', 'banner-management-for-woocommerce' );
?></span>
				</div>
				<table class="form-table table-outer sliders-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_sliders_meta ) && !empty( $wbm_product_slider_sliders_meta ) ) {
    foreach ( $wbm_product_slider_sliders_meta as $sliders_settings ) {
        $wbm_prod_pager_status = ( isset( $sliders_settings['wbm_prod_pager_status'] ) ? $sliders_settings['wbm_prod_pager_status'] : '' );
        $wbm_prod_pager_color = ( isset( $sliders_settings['wbm_prod_pager_color']['color'] ) ? $sliders_settings['wbm_prod_pager_color']['color'] : '' );
        $wbm_prod_pager_active_color = ( isset( $sliders_settings['wbm_prod_pager_color']['active_color'] ) ? $sliders_settings['wbm_prod_pager_color']['active_color'] : '' );
        $wbm_prod_pager_hov_color = ( isset( $sliders_settings['wbm_prod_pager_color']['hover_color'] ) ? $sliders_settings['wbm_prod_pager_color']['hover_color'] : '' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Pagination', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Show/Hide slider pagination.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<span class="wbm_radio_toggle_btn">
											<label for="wbm_prod_pager_show">
												<input type="radio" id="wbm_prod_pager_show" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="true" <?php 
        checked( $wbm_prod_pager_status, 'true' );
        ?>><?php 
        esc_html_e( 'Show', 'banner-management-for-woocommerce' );
        ?>
											</label>
											<label for="wbm_prod_pager_hide">
												<input type="radio" id="wbm_prod_pager_hide" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="false" <?php 
        checked( $wbm_prod_pager_status, 'false' );
        ?>><?php 
        esc_html_e( 'Hide', 'banner-management-for-woocommerce' );
        ?>
											</label>
											<label for="wbm_prod_pager_hide_on_mobile">
												<input type="radio" id="wbm_prod_pager_hide_on_mobile" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="false-mobile" <?php 
        checked( $wbm_prod_pager_status, 'false-mobile' );
        ?>><?php 
        esc_html_e( 'Hide on Mobile', 'banner-management-for-woocommerce' );
        ?>
											</label>
										</span>
									</td>
								</tr>
								<tr valign="top" class="wbm-multi-option-field wbm-prod-pager-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Pagination Color', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set color for the slider pagination.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
									<div class="wbm-mo-parent">
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][color]" value="<?php 
        echo esc_attr( $wbm_prod_pager_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Active Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][active_color]" value="<?php 
        echo esc_attr( $wbm_prod_pager_active_color );
        ?>">
										</div>
										<div class="wbm-multi-option-input">
											<p><?php 
        esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
        ?></p>
											<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][hover_color]" value="<?php 
        echo esc_attr( $wbm_prod_pager_hov_color );
        ?>">
										</div>
									</div>
									</td>
								</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Pagination', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Show/Hide slider pagination.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<span class="wbm_radio_toggle_btn">
										<label for="wbm_prod_pager_show">
											<input type="radio" id="wbm_prod_pager_show" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="true" checked><?php 
    esc_html_e( 'Show', 'banner-management-for-woocommerce' );
    ?>
										</label>
										<label for="wbm_prod_pager_hide">
											<input type="radio" id="wbm_prod_pager_hide" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="false"><?php 
    esc_html_e( 'Hide', 'banner-management-for-woocommerce' );
    ?>
										</label>
										<label for="wbm_prod_pager_hide_on_mobile">
											<input type="radio" id="wbm_prod_pager_hide_on_mobile" name="wbm_product_slider_sliders[wbm_prod_pager_status]" value="false-mobile"><?php 
    esc_html_e( 'Hide on Mobile', 'banner-management-for-woocommerce' );
    ?>
										</label>
									</span>
								</td>
							</tr>
							<tr valign="top" class="wbm-multi-option-field wbm-prod-pager-field">
								<th class="titledesc" scope="row">
									<label><?php 
    esc_html_e( 'Pagination Color', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set color for the slider pagination.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
								<div class="wbm-mo-parent">
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][color]" value="#666">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Active Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][active_color]" value="#000">
									</div>
									<div class="wbm-multi-option-input">
										<p><?php 
    esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
    ?></p>
										<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_prod_pager_color][hover_color]" value="#000">
									</div>
									</div>
								</td>
							</tr>
							<?php 
}
?>
					</tbody>
				</table>
				<div class="wbm-slider-sub-field">
					<span><?php 
esc_html_e( 'Miscellaneous', 'banner-management-for-woocommerce' );
?></span>
				</div>
				<table class="form-table table-outer sliders-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_sliders_meta ) && !empty( $wbm_product_slider_sliders_meta ) ) {
    foreach ( $wbm_product_slider_sliders_meta as $sliders_settings ) {
        $wbm_prod_touch_swipe_status = ( isset( $sliders_settings['wbm_prod_touch_swipe_status'] ) ? $sliders_settings['wbm_prod_touch_swipe_status'] : '' );
        $wbm_prod_mousewheel_control_status = ( isset( $sliders_settings['wbm_prod_mousewheel_control_status'] ) ? $sliders_settings['wbm_prod_mousewheel_control_status'] : '' );
        $wbm_prod_mouse_draggable_status = ( isset( $sliders_settings['wbm_prod_mouse_draggable_status'] ) ? $sliders_settings['wbm_prod_mouse_draggable_status'] : '' );
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Touch Swipe', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable touch swipe.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_touch_swipe" name="wbm_product_slider_sliders[wbm_prod_touch_swipe_status]" value="true" <?php 
        checked( $wbm_prod_touch_swipe_status, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Mousewheel Control', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable mousewheel control.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_mousewheel_control" name="wbm_product_slider_sliders[wbm_prod_mousewheel_control_status]" value="true" <?php 
        checked( $wbm_prod_mousewheel_control_status, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Mouse Draggable', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable mouse draggable.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_mouse_draggable" name="wbm_product_slider_sliders[wbm_prod_mouse_draggable_status]" value="true" <?php 
        checked( $wbm_prod_mouse_draggable_status, 'true' );
        ?>>
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<?php 
    }
} else {
    ?>
							<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
    esc_html_e( 'Touch Swipe', 'banner-management-for-woocommerce' );
    ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
    esc_html_e( 'Enable/Disable touch swipe.', 'banner-management-for-woocommerce' );
    ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_touch_swipe" name="wbm_product_slider_sliders[wbm_prod_touch_swipe_status]" value="true" >
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
    esc_html_e( 'Mousewheel Control', 'banner-management-for-woocommerce' );
    ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
    esc_html_e( 'Enable/Disable mousewheel control.', 'banner-management-for-woocommerce' );
    ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_mousewheel_control" name="wbm_product_slider_sliders[wbm_prod_mousewheel_control_status]" value="true">
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label><?php 
    esc_html_e( 'Mouse Draggable', 'banner-management-for-woocommerce' );
    ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
    esc_html_e( 'Enable/Disable mouse draggable.', 'banner-management-for-woocommerce' );
    ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch">
											<input type="checkbox" id="wbm_prod_mouse_draggable" name="wbm_product_slider_sliders[wbm_prod_mouse_draggable_status]" value="true">
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
							<?php 
}
?>
					</tbody>
				</table>
			</div>
			<div id="wbm-slider-section-4" class="wbm-slider-section">
				<table class="form-table table-outer sliders-settings-tbl">
					<tbody>
						<?php 
if ( isset( $wbm_product_slider_sliders_meta ) && !empty( $wbm_product_slider_sliders_meta ) ) {
    foreach ( $wbm_product_slider_sliders_meta as $sliders_settings ) {
        $wbm_prod_thumb_zoom = ( isset( $sliders_settings['wbm_prod_thumb_zoom']['zoom'] ) ? $sliders_settings['wbm_prod_thumb_zoom']['zoom'] : '' );
        $wbm_thumb_shadow_v_offset = '';
        $wbm_thumb_shadow_h_offset = '';
        $wbm_thumb_shadow_blur = '';
        $wbm_thumb_shadow_spread = '';
        $wbm_thumb_shadow_style = '';
        $wbm_thumb_shadow_color = '';
        $wbm_thumb_shadow_hov_color = '';
        $wbm_prod_thumb_image_mode = '';
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_thumb_zoom"><?php 
        esc_html_e( 'Zoom', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set a zoom effect for thumbnail.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_sliders[wbm_prod_thumb_zoom]" id="wbm_prod_thumb_zoom">
											<option value="none" <?php 
        echo ( esc_attr( 'none' === $wbm_prod_thumb_zoom ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'None', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="zoom-in" <?php 
        echo ( esc_attr( 'zoom-in' === $wbm_prod_thumb_zoom ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Zoom In', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="zoom-out" <?php 
        echo ( esc_attr( 'zoom-out' === $wbm_prod_thumb_zoom ) ? 'selected' : '' );
        ?>><?php 
        esc_html_e( 'Zoom Out', 'banner-management-for-woocommerce' );
        ?></option>
										</select>
									</td>
								</tr>
								<?php 
        if ( wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code() ) {
            ?>
									<tr valign="top" class="wbm-multi-option-field">
										<th class="titledesc" scope="row">
											<label><?php 
            esc_html_e( 'Box-shadow', 'banner-management-for-woocommerce' );
            ?></label>
											<span class="banner-woocommerce-help-tip">
												<div class="alert-desc">
													<?php 
            esc_html_e( 'Check to enable border and box-shadow for thumbnail.', 'banner-management-for-woocommerce' );
            ?>
												</div>
											</span>
											<p class="description" style="display:none;"></p>
										</th>
										<td class="forminp">
											<div class="wbm-mo-parent">
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<i class="fa fa-long-arrow-up"></i>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="v-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][v-offset]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_v_offset );
            ?>">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<i class="fa fa-long-arrow-left"></i>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="h-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][h-offset]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_h_offset );
            ?>">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<?php 
            esc_html_e( 'px', 'banner-management-for-woocommerce' );
            ?>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="blur" name="wbm_product_slider_sliders[wbm_thumb_shadow][blur]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_blur );
            ?>">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<?php 
            esc_html_e( 'px', 'banner-management-for-woocommerce' );
            ?>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="spread" name="wbm_product_slider_sliders[wbm_thumb_shadow][spread]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_spread );
            ?>">
												</div>
												<div class="wbm-multi-option-input">
													<select name="wbm_product_slider_sliders[wbm_thumb_shadow][shadow]">
														<option value="inset" <?php 
            echo ( esc_attr( 'inset' === $wbm_thumb_shadow_style ) ? 'selected' : '' );
            ?> ><?php 
            esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
            ?></option>
														<option value="outset" <?php 
            echo ( esc_attr( 'outset' === $wbm_thumb_shadow_style ) ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
            ?></option>
													</select>
												</div>
												<div class="wbm-multi-option-input">
													<p><?php 
            esc_html_e( 'Color', 'banner-management-for-woocommerce' );
            ?></p>
													<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][color]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_color );
            ?>">
												</div>
												<div class="wbm-multi-option-input">
													<p><?php 
            esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
            ?></p>
													<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][hover-color]" value="<?php 
            echo esc_attr( $wbm_thumb_shadow_hov_color );
            ?>">
												</div>
											</div>
										</td>
									</tr>
									<tr valign="top">
										<th class="titledesc" scope="row">
											<label for="wbm_prod_thumb_image_mode"><?php 
            esc_html_e( 'Image Mode', 'banner-management-for-woocommerce' );
            ?></label>
											<span class="banner-woocommerce-help-tip">
												<div class="alert-desc">
													<?php 
            esc_html_e( 'Set a image mode effect for thumbnail.', 'banner-management-for-woocommerce' );
            ?>
												</div>
											</span>
										</th>
										<td class="forminp">
											<select name="wbm_product_slider_sliders[wbm_prod_thumb_image_mode]" id="wbm_prod_thumb_image_mode">
												<option value="none" <?php 
            echo ( esc_attr( 'Normal' === $wbm_prod_thumb_image_mode ) ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Normal', 'banner-management-for-woocommerce' );
            ?></option>
												<option value="on-hover" <?php 
            echo ( esc_attr( 'on-hover' === $wbm_prod_thumb_image_mode ) ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Grayscale on Hover', 'banner-management-for-woocommerce' );
            ?></option>
												<option value="normal-to-grayscale" <?php 
            echo ( esc_attr( 'normal-to-grayscale' === $wbm_prod_thumb_image_mode ) ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Grayscale and normal on hover', 'banner-management-for-woocommerce' );
            ?></option>
												<option value="always-grayscale" <?php 
            echo ( esc_attr( 'always-grayscale' === $wbm_prod_thumb_image_mode ) ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Always grayscale', 'banner-management-for-woocommerce' );
            ?></option>
											</select>
										</td>
									</tr>
									<?php 
        } else {
            ?>
									<tr valign="top" class="wbm-multi-option-field">
										<th class="titledesc" scope="row">
											<label><?php 
            esc_html_e( 'Box-shadow', 'banner-management-for-woocommerce' );
            ?><div class="wcbm-pro-label"></div></label>
											<span class="banner-woocommerce-help-tip">
												<div class="alert-desc">
													<?php 
            esc_html_e( 'Check to enable border and box-shadow for thumbnail.', 'banner-management-for-woocommerce' );
            ?>
												</div>
											</span>
											<p class="description" style="display:none;"></p>
										</th>
										<td class="forminp">
											<div class="wbm-mo-parent wcbm-upgrade-to-pro">
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<i class="fa fa-long-arrow-up"></i>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="v-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][v-offset]" value="">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<i class="fa fa-long-arrow-left"></i>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="h-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][h-offset]" value="">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<?php 
            esc_html_e( 'px', 'banner-management-for-woocommerce' );
            ?>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="blur" name="wbm_product_slider_sliders[wbm_thumb_shadow][blur]" value="">
												</div>
												<div class="wbm-multi-option-input">
													<span class="wbm-multi-option-icon">
														<?php 
            esc_html_e( 'px', 'banner-management-for-woocommerce' );
            ?>
													</span>
													<input type="number" class="wbm_thumb_border" min="0" placeholder="spread" name="wbm_product_slider_sliders[wbm_thumb_shadow][spread]" value="">
												</div>
												<div class="wbm-multi-option-input">
													<select name="wbm_product_slider_sliders[wbm_thumb_shadow][shadow]">
														<option value="inset"><?php 
            esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
            ?></option>
														<option value="outset"><?php 
            esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
            ?></option>
													</select>
												</div>
												<div class="wbm-multi-option-input">
													<p><?php 
            esc_html_e( 'Color', 'banner-management-for-woocommerce' );
            ?></p>
													<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][color]" value="">
												</div>
												<div class="wbm-multi-option-input">
													<p><?php 
            esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
            ?></p>
													<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][hover-color]" value="">
												</div>
											</div>
										</td>
									</tr>
									<tr valign="top">
										<th class="titledesc" scope="row">
											<label for="wbm_prod_thumb_image_mode"><?php 
            esc_html_e( 'Image Mode', 'banner-management-for-woocommerce' );
            ?><div class="wcbm-pro-label"></div></label>
											<span class="banner-woocommerce-help-tip">
												<div class="alert-desc">
													<?php 
            esc_html_e( 'Set a image mode effect for thumbnail.', 'banner-management-for-woocommerce' );
            ?>
												</div>
											</span>
										</th>
										<td class="forminp wcbm-upgrade-to-pro">
											<div>
												<select name="wbm_product_slider_sliders[wbm_prod_thumb_image_mode]" id="wbm_prod_thumb_image_mode">
													<option value="none"><?php 
            esc_html_e( 'Normal', 'banner-management-for-woocommerce' );
            ?></option>
												</select>
											</div>
										</td>
									</tr>
									<?php 
        }
    }
} else {
    ?>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_prod_thumb_zoom"><?php 
    esc_html_e( 'Zoom', 'banner-management-for-woocommerce' );
    ?></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable auto play.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<select name="wbm_product_slider_sliders[wbm_prod_thumb_zoom]" id="wbm_prod_thumb_zoom">
										<option value="none" ><?php 
    esc_html_e( 'None', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="zoom-in" ><?php 
    esc_html_e( 'Zoom In', 'banner-management-for-woocommerce' );
    ?></option>
										<option value="zoom-out" ><?php 
    esc_html_e( 'Zoom Out', 'banner-management-for-woocommerce' );
    ?></option>
									</select>
								</td>
							</tr>
							<?php 
    if ( wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code() ) {
        ?>
								<tr valign="top" class="wbm-multi-option-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Box-shadow', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Check to enable border and box-shadow for thumbnail.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<div class="wbm-mo-parent">
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-up"></i>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="v-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][v-offset]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-left"></i>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="h-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][h-offset]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<?php 
        esc_html_e( 'px', 'banner-management-for-woocommerce' );
        ?>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="blur" name="wbm_product_slider_sliders[wbm_thumb_shadow][blur]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<?php 
        esc_html_e( 'px', 'banner-management-for-woocommerce' );
        ?>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="spread" name="wbm_product_slider_sliders[wbm_thumb_shadow][spread]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<select name="wbm_product_slider_sliders[wbm_thumb_shadow][shadow]">
													<option value="inset" selected ><?php 
        esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="outset"><?php 
        esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
											<div class="wbm-multi-option-input">
												<p><?php 
        esc_html_e( 'Color', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][color]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<p><?php 
        esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][hover-color]" value="">
											</div>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_thumb_image_mode"><?php 
        esc_html_e( 'Image Mode', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set a image mode effect for thumbnail.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp">
										<select name="wbm_product_slider_sliders[wbm_prod_thumb_image_mode]" id="wbm_prod_thumb_image_mode">
											<option value="none" ><?php 
        esc_html_e( 'Normal', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="on-hover" ><?php 
        esc_html_e( 'Grayscale on Hover', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="normal-to-grayscale" ><?php 
        esc_html_e( 'Grayscale and normal on hover', 'banner-management-for-woocommerce' );
        ?></option>
											<option value="always-grayscale" ><?php 
        esc_html_e( 'Always grayscale', 'banner-management-for-woocommerce' );
        ?></option>
										</select>
									</td>
								</tr>
								<?php 
    } else {
        ?>
								<tr valign="top" class="wbm-multi-option-field">
									<th class="titledesc" scope="row">
										<label><?php 
        esc_html_e( 'Box-shadow', 'banner-management-for-woocommerce' );
        ?><div class="wcbm-pro-label"></div></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Check to enable border and box-shadow for thumbnail.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;"></p>
									</th>
									<td class="forminp">
										<div class="wbm-mo-parent wcbm-upgrade-to-pro">
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-up"></i>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="v-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][v-offset]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<i class="fa fa-long-arrow-left"></i>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="h-offset" name="wbm_product_slider_sliders[wbm_thumb_shadow][h-offset]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<?php 
        esc_html_e( 'px', 'banner-management-for-woocommerce' );
        ?>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="blur" name="wbm_product_slider_sliders[wbm_thumb_shadow][blur]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<span class="wbm-multi-option-icon">
													<?php 
        esc_html_e( 'px', 'banner-management-for-woocommerce' );
        ?>
												</span>
												<input type="number" class="wbm_thumb_border" min="0" placeholder="spread" name="wbm_product_slider_sliders[wbm_thumb_shadow][spread]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<select name="wbm_product_slider_sliders[wbm_thumb_shadow][shadow]">
													<option value="inset"><?php 
        esc_html_e( 'Inset', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="outset"><?php 
        esc_html_e( 'Outset', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
											<div class="wbm-multi-option-input">
												<p><?php 
        esc_html_e( 'Color', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][color]" value="">
											</div>
											<div class="wbm-multi-option-input">
												<p><?php 
        esc_html_e( 'Hover Color', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="text" class="wbm_sliders_colorpick" name="wbm_product_slider_sliders[wbm_thumb_shadow][hover-color]" value="">
											</div>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_prod_thumb_image_mode"><?php 
        esc_html_e( 'Image Mode', 'banner-management-for-woocommerce' );
        ?><div class="wcbm-pro-label"></div></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set a image mode effect for thumbnail.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
									</th>
									<td class="forminp wcbm-upgrade-to-pro">
										<div>
											<select name="wbm_product_slider_sliders[wbm_prod_thumb_image_mode]" id="wbm_prod_thumb_image_mode">
												<option value="none"><?php 
        esc_html_e( 'Normal', 'banner-management-for-woocommerce' );
        ?></option>
											</select>
										</div>
									</td>
								</tr>
								<?php 
    }
}
?>
					</tbody>
				</table>
			</div>
			<?php 
if ( wcbm_fs()->is__premium_only() && wcbm_fs()->can_use_premium_code() ) {
    ?>
				<div id="wbm-slider-section-5" class="wbm-slider-section">
					<table class="form-table table-outer sliders-settings-tbl">
						<tbody>
							<?php 
    $fonts = array(
        'ABeeZee',
        'Abel',
        'Abhaya Libre',
        'Aboreto',
        'Abril Fatface',
        'Abyssinica SIL',
        'Aclonica',
        'Acme',
        'Actor',
        'Adamina',
        'Advent Pro',
        'Aguafina Script',
        'Akaya Kanadaka',
        'Akaya Telivigala',
        'Akronim',
        'Akshar',
        'Aladin',
        'Alata',
        'Alatsi',
        'Albert Sans',
        'Aldrich',
        'Alef',
        'Alegreya',
        'Alegreya SC',
        'Alegreya Sans',
        'Alegreya Sans SC',
        'Aleo',
        'Alex Brush',
        'Alfa Slab One',
        'Alice',
        'Alike',
        'Alike Angular',
        'Alkalami',
        'Allan',
        'Allerta',
        'Allerta Stencil',
        'Allison',
        'Allura',
        'Almarai',
        'Almendra',
        'Almendra Display',
        'Almendra SC',
        'Alumni Sans',
        'Alumni Sans Collegiate One',
        'Alumni Sans Inline One',
        'Alumni Sans Pinstripe',
        'Amarante',
        'Amaranth',
        'Amatic SC',
        'Amethysta',
        'Amiko',
        'Amiri',
        'Amiri Quran',
        'Amita',
        'Anaheim',
        'Andada Pro',
        'Andika',
        'Anek Bangla',
        'Anek Devanagari',
        'Anek Gujarati',
        'Anek Gurmukhi',
        'Anek Kannada',
        'Anek Latin',
        'Anek Malayalam',
        'Anek Odia',
        'Anek Tamil',
        'Anek Telugu',
        'Angkor',
        'Annie Use Your Telescope',
        'Anonymous Pro',
        'Antic',
        'Antic Didone',
        'Antic Slab',
        'Anton',
        'Antonio',
        'Anybody',
        'Arapey',
        'Arbutus',
        'Arbutus Slab',
        'Architects Daughter',
        'Archivo',
        'Archivo Black',
        'Archivo Narrow',
        'Are You Serious',
        'Aref Ruqaa',
        'Aref Ruqaa Ink',
        'Arima',
        'Arima Madurai',
        'Arimo',
        'Arizonia',
        'Armata',
        'Arsenal',
        'Artifika',
        'Arvo',
        'Arya',
        'Asap',
        'Asap Condensed',
        'Asar',
        'Asset',
        'Assistant',
        'Astloch',
        'Asul',
        'Athiti',
        'Atkinson Hyperlegible',
        'Atma',
        'Atomic Age',
        'Aubrey',
        'Audiowide',
        'Autour One',
        'Average',
        'Average Sans',
        'Averia Gruesa Libre',
        'Averia Libre',
        'Averia Sans Libre',
        'Averia Serif Libre',
        'Azeret Mono',
        'B612',
        'B612 Mono',
        'BIZ UDGothic',
        'BIZ UDMincho',
        'BIZ UDPGothic',
        'BIZ UDPMincho',
        'Babylonica',
        'Bad Script',
        'Bahiana',
        'Bahianita',
        'Bai Jamjuree',
        'Bakbak One',
        'Ballet',
        'Baloo 2',
        'Baloo Bhai 2',
        'Baloo Bhaijaan 2',
        'Baloo Bhaina 2',
        'Baloo Chettan 2',
        'Baloo Da 2',
        'Baloo Paaji 2',
        'Baloo Tamma 2',
        'Baloo Tammudu 2',
        'Baloo Thambi 2',
        'Balsamiq Sans',
        'Balthazar',
        'Bangers',
        'Barlow',
        'Barlow Condensed',
        'Barlow Semi Condensed',
        'Barriecito',
        'Barrio',
        'Basic',
        'Baskervville',
        'Battambang',
        'Baumans',
        'Bayon',
        'Be Vietnam Pro',
        'Beau Rivage',
        'Bebas Neue',
        'Belgrano',
        'Bellefair',
        'Belleza',
        'Bellota',
        'Bellota Text',
        'BenchNine',
        'Benne',
        'Bentham',
        'Berkshire Swash',
        'Besley',
        'Beth Ellen',
        'Bevan',
        'BhuTuka Expanded One',
        'Big Shoulders Display',
        'Big Shoulders Inline Display',
        'Big Shoulders Inline Text',
        'Big Shoulders Stencil Display',
        'Big Shoulders Stencil Text',
        'Big Shoulders Text',
        'Bigelow Rules',
        'Bigshot One',
        'Bilbo',
        'Bilbo Swash Caps',
        'BioRhyme',
        'BioRhyme Expanded',
        'Birthstone',
        'Birthstone Bounce',
        'Biryani',
        'Bitter',
        'Black And White Picture',
        'Black Han Sans',
        'Black Ops One',
        'Blaka',
        'Blaka Hollow',
        'Blaka Ink',
        'Blinker',
        'Bodoni Moda',
        'Bokor',
        'Bona Nova',
        'Bonbon',
        'Bonheur Royale',
        'Boogaloo',
        'Bowlby One',
        'Bowlby One SC',
        'Brawler',
        'Bree Serif',
        'Brygada 1918',
        'Bubblegum Sans',
        'Bubbler One',
        'Buda',
        'Buenard',
        'Bungee',
        'Bungee Hairline',
        'Bungee Inline',
        'Bungee Outline',
        'Bungee Shade',
        'Bungee Spice',
        'Butcherman',
        'Butterfly Kids',
        'Cabin',
        'Cabin Condensed',
        'Cabin Sketch',
        'Caesar Dressing',
        'Cagliostro',
        'Cairo',
        'Cairo Play',
        'Caladea',
        'Calistoga',
        'Calligraffitti',
        'Cambay',
        'Cambo',
        'Candal',
        'Cantarell',
        'Cantata One',
        'Cantora One',
        'Capriola',
        'Caramel',
        'Carattere',
        'Cardo',
        'Carme',
        'Carrois Gothic',
        'Carrois Gothic SC',
        'Carter One',
        'Castoro',
        'Catamaran',
        'Caudex',
        'Caveat',
        'Caveat Brush',
        'Cedarville Cursive',
        'Ceviche One',
        'Chakra Petch',
        'Changa',
        'Changa One',
        'Chango',
        'Charis SIL',
        'Charm',
        'Charmonman',
        'Chathura',
        'Chau Philomene One',
        'Chela One',
        'Chelsea Market',
        'Chenla',
        'Cherish',
        'Cherry Cream Soda',
        'Cherry Swash',
        'Chewy',
        'Chicle',
        'Chilanka',
        'Chivo',
        'Chonburi',
        'Cinzel',
        'Cinzel Decorative',
        'Clicker Script',
        'Coda',
        'Coda Caption',
        'Codystar',
        'Coiny',
        'Combo',
        'Comfortaa',
        'Comforter',
        'Comforter Brush',
        'Comic Neue',
        'Coming Soon',
        'Commissioner',
        'Concert One',
        'Condiment',
        'Content',
        'Contrail One',
        'Convergence',
        'Cookie',
        'Copse',
        'Corben',
        'Corinthia',
        'Cormorant',
        'Cormorant Garamond',
        'Cormorant Infant',
        'Cormorant SC',
        'Cormorant Unicase',
        'Cormorant Upright',
        'Courgette',
        'Courier Prime',
        'Cousine',
        'Coustard',
        'Covered By Your Grace',
        'Crafty Girls',
        'Creepster',
        'Crete Round',
        'Crimson Pro',
        'Crimson Text',
        'Croissant One',
        'Crushed',
        'Cuprum',
        'Cute Font',
        'Cutive',
        'Cutive Mono',
        'DM Mono',
        'DM Sans',
        'DM Serif Display',
        'DM Serif Text',
        'Damion',
        'Dancing Script',
        'Dangrek',
        'Darker Grotesque',
        'David Libre',
        'Dawning of a New Day',
        'Days One',
        'Dekko',
        'Dela Gothic One',
        'Delius',
        'Delius Swash Caps',
        'Delius Unicase',
        'Della Respira',
        'Denk One',
        'Devonshire',
        'Dhurjati',
        'Didact Gothic',
        'Diplomata',
        'Diplomata SC',
        'Do Hyeon',
        'Dokdo',
        'Domine',
        'Donegal One',
        'Dongle',
        'Doppio One',
        'Dorsa',
        'Dosis',
        'DotGothic16',
        'Dr Sugiyama',
        'Duru Sans',
        'DynaPuff',
        'Dynalight',
        'EB Garamond',
        'Eagle Lake',
        'East Sea Dokdo',
        'Eater',
        'Economica',
        'Eczar',
        'Edu NSW ACT Foundation',
        'Edu QLD Beginner',
        'Edu SA Beginner',
        'Edu TAS Beginner',
        'Edu VIC WA NT Beginner',
        'El Messiri',
        'Electrolize',
        'Elsie',
        'Elsie Swash Caps',
        'Emblema One',
        'Emilys Candy',
        'Encode Sans',
        'Encode Sans Condensed',
        'Encode Sans Expanded',
        'Encode Sans SC',
        'Encode Sans Semi Condensed',
        'Encode Sans Semi Expanded',
        'Engagement',
        'Englebert',
        'Enriqueta',
        'Ephesis',
        'Epilogue',
        'Erica One',
        'Esteban',
        'Estonia',
        'Euphoria Script',
        'Ewert',
        'Exo',
        'Exo 2',
        'Expletus Sans',
        'Explora',
        'Fahkwang',
        'Familjen Grotesk',
        'Fanwood Text',
        'Farro',
        'Farsan',
        'Fascinate',
        'Fascinate Inline',
        'Faster One',
        'Fasthand',
        'Fauna One',
        'Faustina',
        'Federant',
        'Federo',
        'Felipa',
        'Fenix',
        'Festive',
        'Figtree',
        'Finger Paint',
        'Finlandica',
        'Fira Code',
        'Fira Mono',
        'Fira Sans',
        'Fira Sans Condensed',
        'Fira Sans Extra Condensed',
        'Fjalla One',
        'Fjord One',
        'Flamenco',
        'Flavors',
        'Fleur De Leah',
        'Flow Block',
        'Flow Circular',
        'Flow Rounded',
        'Fondamento',
        'Fontdiner Swanky',
        'Forum',
        'Fragment Mono',
        'Francois One',
        'Frank Ruhl Libre',
        'Fraunces',
        'Freckle Face',
        'Fredericka the Great',
        'Fredoka',
        'Fredoka One',
        'Freehand',
        'Fresca',
        'Frijole',
        'Fruktur',
        'Fugaz One',
        'Fuggles',
        'Fuzzy Bubbles',
        'GFS Didot',
        'GFS Neohellenic',
        'Gabriela',
        'Gaegu',
        'Gafata',
        'Galada',
        'Galdeano',
        'Galindo',
        'Gamja Flower',
        'Gantari',
        'Gayathri',
        'Gelasio',
        'Gemunu Libre',
        'Genos',
        'Gentium Book Basic',
        'Gentium Book Plus',
        'Gentium Plus',
        'Geo',
        'Georama',
        'Geostar',
        'Geostar Fill',
        'Germania One',
        'Gideon Roman',
        'Gidugu',
        'Gilda Display',
        'Girassol',
        'Give You Glory',
        'Glass Antiqua',
        'Glegoo',
        'Gloria Hallelujah',
        'Glory',
        'Gluten',
        'Goblin One',
        'Gochi Hand',
        'Goldman',
        'Gorditas',
        'Gothic A1',
        'Gotu',
        'Goudy Bookletter 1911',
        'Gowun Batang',
        'Gowun Dodum',
        'Graduate',
        'Grand Hotel',
        'Grandstander',
        'Grape Nuts',
        'Gravitas One',
        'Great Vibes',
        'Grechen Fuemen',
        'Grenze',
        'Grenze Gotisch',
        'Grey Qo',
        'Griffy',
        'Gruppo',
        'Gudea',
        'Gugi',
        'Gulzar',
        'Gupter',
        'Gurajada',
        'Gwendolyn',
        'Habibi',
        'Hachi Maru Pop',
        'Hahmlet',
        'Halant',
        'Hammersmith One',
        'Hanalei',
        'Hanalei Fill',
        'Handlee',
        'Hanuman',
        'Happy Monkey',
        'Harmattan',
        'Headland One',
        'Heebo',
        'Henny Penny',
        'Hepta Slab',
        'Herr Von Muellerhoff',
        'Hi Melody',
        'Hina Mincho',
        'Hind',
        'Hind Guntur',
        'Hind Madurai',
        'Hind Siliguri',
        'Hind Vadodara',
        'Holtwood One SC',
        'Homemade Apple',
        'Homenaje',
        'Hubballi',
        'Hurricane',
        'IBM Plex Mono',
        'IBM Plex Sans',
        'IBM Plex Sans Arabic',
        'IBM Plex Sans Condensed',
        'IBM Plex Sans Devanagari',
        'IBM Plex Sans Hebrew',
        'IBM Plex Sans JP',
        'IBM Plex Sans KR',
        'IBM Plex Sans Thai',
        'IBM Plex Sans Thai Looped',
        'IBM Plex Serif',
        'IM Fell DW Pica',
        'IM Fell DW Pica SC',
        'IM Fell Double Pica',
        'IM Fell Double Pica SC',
        'IM Fell English',
        'IM Fell English SC',
        'IM Fell French Canon',
        'IM Fell French Canon SC',
        'IM Fell Great Primer',
        'IM Fell Great Primer SC',
        'Ibarra Real Nova',
        'Iceberg',
        'Iceland',
        'Imbue',
        'Imperial Script',
        'Imprima',
        'Inconsolata',
        'Inder',
        'Indie Flower',
        'Ingrid Darling',
        'Inika',
        'Inknut Antiqua',
        'Inria Sans',
        'Inria Serif',
        'Inspiration',
        'Inter',
        'Inter Tight',
        'Irish Grover',
        'Island Moments',
        'Istok Web',
        'Italiana',
        'Italianno',
        'Itim',
        'Jacques Francois',
        'Jacques Francois Shadow',
        'Jaldi',
        'JetBrains Mono',
        'Jim Nightshade',
        'Joan',
        'Jockey One',
        'Jolly Lodger',
        'Jomhuria',
        'Jomolhari',
        'Josefin Sans',
        'Josefin Slab',
        'Jost',
        'Joti One',
        'Jua',
        'Judson',
        'Julee',
        'Julius Sans One',
        'Junge',
        'Jura',
        'Just Another Hand',
        'Just Me Again Down Here',
        'K2D',
        'Kadwa',
        'Kaisei Decol',
        'Kaisei HarunoUmi',
        'Kaisei Opti',
        'Kaisei Tokumin',
        'Kalam',
        'Kameron',
        'Kanit',
        'Kantumruy',
        'Kantumruy Pro',
        'Karantina',
        'Karla',
        'Karma',
        'Katibeh',
        'Kaushan Script',
        'Kavivanar',
        'Kavoon',
        'Kdam Thmor Pro',
        'Keania One',
        'Kelly Slab',
        'Kenia',
        'Khand',
        'Khmer',
        'Khula',
        'Kings',
        'Kirang Haerang',
        'Kite One',
        'Kiwi Maru',
        'Klee One',
        'Knewave',
        'KoHo',
        'Kodchasan',
        'Koh Santepheap',
        'Kolker Brush',
        'Kosugi',
        'Kosugi Maru',
        'Kotta One',
        'Koulen',
        'Kranky',
        'Kreon',
        'Kristi',
        'Krona One',
        'Krub',
        'Kufam',
        'Kulim Park',
        'Kumar One',
        'Kumar One Outline',
        'Kumbh Sans',
        'Kurale',
        'La Belle Aurore',
        'Lacquer',
        'Laila',
        'Lakki Reddy',
        'Lalezar',
        'Lancelot',
        'Langar',
        'Lateef',
        'Lato',
        'Lavishly Yours',
        'League Gothic',
        'League Script',
        'League Spartan',
        'Leckerli One',
        'Ledger',
        'Lekton',
        'Lemon',
        'Lemonada',
        'Lexend',
        'Lexend Deca',
        'Lexend Exa',
        'Lexend Giga',
        'Lexend Mega',
        'Lexend Peta',
        'Lexend Tera',
        'Lexend Zetta',
        'Libre Barcode 128',
        'Libre Barcode 128 Text',
        'Libre Barcode 39',
        'Libre Barcode 39 Extended',
        'Libre Barcode 39 Extended Text',
        'Libre Barcode 39 Text',
        'Libre Barcode EAN13 Text',
        'Libre Baskerville',
        'Libre Bodoni',
        'Libre Caslon Display',
        'Libre Caslon Text',
        'Libre Franklin',
        'Licorice',
        'Life Savers',
        'Lilita One',
        'Lily Script One',
        'Limelight',
        'Linden Hill',
        'Literata',
        'Liu Jian Mao Cao',
        'Livvic',
        'Lobster',
        'Lobster Two',
        'Londrina Outline',
        'Londrina Shadow',
        'Londrina Sketch',
        'Londrina Solid',
        'Long Cang',
        'Lora',
        'Love Light',
        'Love Ya Like A Sister',
        'Loved by the King',
        'Lovers Quarrel',
        'Luckiest Guy',
        'Lusitana',
        'Lustria',
        'Luxurious Roman',
        'Luxurious Script',
        'M PLUS 1',
        'M PLUS 1 Code',
        'M PLUS 1p',
        'M PLUS 2',
        'M PLUS Code Latin',
        'M PLUS Rounded 1c',
        'Ma Shan Zheng',
        'Macondo',
        'Macondo Swash Caps',
        'Mada',
        'Magra',
        'Maiden Orange',
        'Maitree',
        'Major Mono Display',
        'Mako',
        'Mali',
        'Mallanna',
        'Mandali',
        'Manjari',
        'Manrope',
        'Mansalva',
        'Manuale',
        'Marcellus',
        'Marcellus SC',
        'Marck Script',
        'Margarine',
        'Marhey',
        'Markazi Text',
        'Marko One',
        'Marmelad',
        'Martel',
        'Martel Sans',
        'Marvel',
        'Mate',
        'Mate SC',
        'Maven Pro',
        'McLaren',
        'Mea Culpa',
        'Meddon',
        'MedievalSharp',
        'Medula One',
        'Meera Inimai',
        'Megrim',
        'Meie Script',
        'Meow Script',
        'Merienda',
        'Merienda One',
        'Merriweather',
        'Merriweather Sans',
        'Metal',
        'Metal Mania',
        'Metamorphous',
        'Metrophobic',
        'Michroma',
        'Milonga',
        'Miltonian',
        'Miltonian Tattoo',
        'Mina',
        'Mingzat',
        'Miniver',
        'Miriam Libre',
        'Mirza',
        'Miss Fajardose',
        'Mitr',
        'Mochiy Pop One',
        'Mochiy Pop P One',
        'Modak',
        'Modern Antiqua',
        'Mogra',
        'Mohave',
        'Molengo',
        'Molle',
        'Monda',
        'Monofett',
        'Monoton',
        'Monsieur La Doulaise',
        'Montaga',
        'Montagu Slab',
        'MonteCarlo',
        'Montez',
        'Montserrat',
        'Montserrat Alternates',
        'Montserrat Subrayada',
        'Moo Lah Lah',
        'Moon Dance',
        'Moul',
        'Moulpali',
        'Mountains of Christmas',
        'Mouse Memoirs',
        'Mr Bedfort',
        'Mr Dafoe',
        'Mr De Haviland',
        'Mrs Saint Delafield',
        'Mrs Sheppards',
        'Ms Madi',
        'Mukta',
        'Mukta Mahee',
        'Mukta Malar',
        'Mukta Vaani',
        'Mulish',
        'Murecho',
        'MuseoModerno',
        'My Soul',
        'Mystery Quest',
        'NTR',
        'Nabla',
        'Nanum Brush Script',
        'Nanum Gothic',
        'Nanum Gothic Coding',
        'Nanum Myeongjo',
        'Nanum Pen Script',
        'Neonderthaw',
        'Nerko One',
        'Neucha',
        'Neuton',
        'New Rocker',
        'New Tegomin',
        'News Cycle',
        'Newsreader',
        'Niconne',
        'Niramit',
        'Nixie One',
        'Nobile',
        'Nokora',
        'Norican',
        'Nosifer',
        'Notable',
        'Nothing You Could Do',
        'Noticia Text',
        'Noto Color Emoji',
        'Noto Emoji',
        'Noto Kufi Arabic',
        'Noto Music',
        'Noto Naskh Arabic',
        'Noto Nastaliq Urdu',
        'Noto Rashi Hebrew',
        'Noto Sans',
        'Noto Sans Adlam',
        'Noto Sans Adlam Unjoined',
        'Noto Sans Anatolian Hieroglyphs',
        'Noto Sans Arabic',
        'Noto Sans Armenian',
        'Noto Sans Avestan',
        'Noto Sans Balinese',
        'Noto Sans Bamum',
        'Noto Sans Bassa Vah',
        'Noto Sans Batak',
        'Noto Sans Bengali',
        'Noto Sans Bhaiksuki',
        'Noto Sans Brahmi',
        'Noto Sans Buginese',
        'Noto Sans Buhid',
        'Noto Sans Canadian Aboriginal',
        'Noto Sans Carian',
        'Noto Sans Caucasian Albanian',
        'Noto Sans Chakma',
        'Noto Sans Cham',
        'Noto Sans Cherokee',
        'Noto Sans Coptic',
        'Noto Sans Cuneiform',
        'Noto Sans Cypriot',
        'Noto Sans Deseret',
        'Noto Sans Devanagari',
        'Noto Sans Display',
        'Noto Sans Duployan',
        'Noto Sans Egyptian Hieroglyphs',
        'Noto Sans Elbasan',
        'Noto Sans Elymaic',
        'Noto Sans Ethiopic',
        'Noto Sans Georgian',
        'Noto Sans Glagolitic',
        'Noto Sans Gothic',
        'Noto Sans Grantha',
        'Noto Sans Gujarati',
        'Noto Sans Gunjala Gondi',
        'Noto Sans Gurmukhi',
        'Noto Sans HK',
        'Noto Sans Hanifi Rohingya',
        'Noto Sans Hanunoo',
        'Noto Sans Hatran',
        'Noto Sans Hebrew',
        'Noto Sans Imperial Aramaic',
        'Noto Sans Indic Siyaq Numbers',
        'Noto Sans Inscriptional Pahlavi',
        'Noto Sans Inscriptional Parthian',
        'Noto Sans JP',
        'Noto Sans Javanese',
        'Noto Sans KR',
        'Noto Sans Kaithi',
        'Noto Sans Kannada',
        'Noto Sans Kayah Li',
        'Noto Sans Kharoshthi',
        'Noto Sans Khmer',
        'Noto Sans Khojki',
        'Noto Sans Khudawadi',
        'Noto Sans Lao',
        'Noto Sans Lao Looped',
        'Noto Sans Lepcha',
        'Noto Sans Limbu',
        'Noto Sans Linear A',
        'Noto Sans Linear B',
        'Noto Sans Lisu',
        'Noto Sans Lycian',
        'Noto Sans Lydian',
        'Noto Sans Mahajani',
        'Noto Sans Malayalam',
        'Noto Sans Mandaic',
        'Noto Sans Manichaean',
        'Noto Sans Marchen',
        'Noto Sans Masaram Gondi',
        'Noto Sans Math',
        'Noto Sans Mayan Numerals',
        'Noto Sans Medefaidrin',
        'Noto Sans Meetei Mayek',
        'Noto Sans Mende Kikakui',
        'Noto Sans Meroitic',
        'Noto Sans Miao',
        'Noto Sans Modi',
        'Noto Sans Mongolian',
        'Noto Sans Mono',
        'Noto Sans Mro',
        'Noto Sans Multani',
        'Noto Sans Myanmar',
        'Noto Sans N Ko',
        'Noto Sans Nabataean',
        'Noto Sans New Tai Lue',
        'Noto Sans Newa',
        'Noto Sans Nushu',
        'Noto Sans Ogham',
        'Noto Sans Ol Chiki',
        'Noto Sans Old Hungarian',
        'Noto Sans Old Italic',
        'Noto Sans Old North Arabian',
        'Noto Sans Old Permic',
        'Noto Sans Old Persian',
        'Noto Sans Old Sogdian',
        'Noto Sans Old South Arabian',
        'Noto Sans Old Turkic',
        'Noto Sans Oriya',
        'Noto Sans Osage',
        'Noto Sans Osmanya',
        'Noto Sans Pahawh Hmong',
        'Noto Sans Palmyrene',
        'Noto Sans Pau Cin Hau',
        'Noto Sans Phags Pa',
        'Noto Sans Phoenician',
        'Noto Sans Psalter Pahlavi',
        'Noto Sans Rejang',
        'Noto Sans Runic',
        'Noto Sans SC',
        'Noto Sans Samaritan',
        'Noto Sans Saurashtra',
        'Noto Sans Sharada',
        'Noto Sans Shavian',
        'Noto Sans Siddham',
        'Noto Sans Sinhala',
        'Noto Sans Sogdian',
        'Noto Sans Sora Sompeng',
        'Noto Sans Soyombo',
        'Noto Sans Sundanese',
        'Noto Sans Syloti Nagri',
        'Noto Sans Symbols',
        'Noto Sans Symbols 2',
        'Noto Sans Syriac',
        'Noto Sans TC',
        'Noto Sans Tagalog',
        'Noto Sans Tagbanwa',
        'Noto Sans Tai Le',
        'Noto Sans Tai Tham',
        'Noto Sans Tai Viet',
        'Noto Sans Takri',
        'Noto Sans Tamil',
        'Noto Sans Tamil Supplement',
        'Noto Sans Telugu',
        'Noto Sans Thaana',
        'Noto Sans Thai',
        'Noto Sans Thai Looped',
        'Noto Sans Tifinagh',
        'Noto Sans Tirhuta',
        'Noto Sans Ugaritic',
        'Noto Sans Vai',
        'Noto Sans Wancho',
        'Noto Sans Warang Citi',
        'Noto Sans Yi',
        'Noto Sans Zanabazar Square',
        'Noto Serif',
        'Noto Serif Ahom',
        'Noto Serif Armenian',
        'Noto Serif Balinese',
        'Noto Serif Bengali',
        'Noto Serif Devanagari',
        'Noto Serif Display',
        'Noto Serif Dogra',
        'Noto Serif Ethiopic',
        'Noto Serif Georgian',
        'Noto Serif Grantha',
        'Noto Serif Gujarati',
        'Noto Serif Gurmukhi',
        'Noto Serif HK',
        'Noto Serif Hebrew',
        'Noto Serif JP',
        'Noto Serif KR',
        'Noto Serif Kannada',
        'Noto Serif Khmer',
        'Noto Serif Lao',
        'Noto Serif Malayalam',
        'Noto Serif Myanmar',
        'Noto Serif Nyiakeng Puachue Hmong',
        'Noto Serif Oriya',
        'Noto Serif SC',
        'Noto Serif Sinhala',
        'Noto Serif TC',
        'Noto Serif Tamil',
        'Noto Serif Tangut',
        'Noto Serif Telugu',
        'Noto Serif Thai',
        'Noto Serif Tibetan',
        'Noto Serif Yezidi',
        'Noto Traditional Nushu',
        'Nova Cut',
        'Nova Flat',
        'Nova Mono',
        'Nova Oval',
        'Nova Round',
        'Nova Script',
        'Nova Slim',
        'Nova Square',
        'Numans',
        'Nunito',
        'Nunito Sans',
        'Nuosu SIL',
        'Odibee Sans',
        'Odor Mean Chey',
        'Offside',
        'Oi',
        'Old Standard TT',
        'Oldenburg',
        'Ole',
        'Oleo Script',
        'Oleo Script Swash Caps',
        'Oooh Baby',
        'Open Sans',
        'Oranienbaum',
        'Orbitron',
        'Oregano',
        'Orelega One',
        'Orienta',
        'Original Surfer',
        'Oswald',
        'Outfit',
        'Over the Rainbow',
        'Overlock',
        'Overlock SC',
        'Overpass',
        'Overpass Mono',
        'Ovo',
        'Oxanium',
        'Oxygen',
        'Oxygen Mono',
        'PT Mono',
        'PT Sans',
        'PT Sans Caption',
        'PT Sans Narrow',
        'PT Serif',
        'PT Serif Caption',
        'Pacifico',
        'Padauk',
        'Palanquin',
        'Palanquin Dark',
        'Pangolin',
        'Paprika',
        'Parisienne',
        'Passero One',
        'Passion One',
        'Passions Conflict',
        'Pathway Gothic One',
        'Patrick Hand',
        'Patrick Hand SC',
        'Pattaya',
        'Patua One',
        'Pavanam',
        'Paytone One',
        'Peddana',
        'Peralta',
        'Permanent Marker',
        'Petemoss',
        'Petit Formal Script',
        'Petrona',
        'Philosopher',
        'Piazzolla',
        'Piedra',
        'Pinyon Script',
        'Pirata One',
        'Plaster',
        'Play',
        'Playball',
        'Playfair Display',
        'Playfair Display SC',
        'Plus Jakarta Sans',
        'Podkova',
        'Poiret One',
        'Poller One',
        'Poly',
        'Pompiere',
        'Pontano Sans',
        'Poor Story',
        'Poppins',
        'Port Lligat Sans',
        'Port Lligat Slab',
        'Potta One',
        'Pragati Narrow',
        'Praise',
        'Prata',
        'Preahvihear',
        'Press Start 2P',
        'Pridi',
        'Princess Sofia',
        'Prociono',
        'Prompt',
        'Prosto One',
        'Proza Libre',
        'Public Sans',
        'Puppies Play',
        'Puritan',
        'Purple Purse',
        'Qahiri',
        'Quando',
        'Quantico',
        'Quattrocento',
        'Quattrocento Sans',
        'Questrial',
        'Quicksand',
        'Quintessential',
        'Qwigley',
        'Qwitcher Grypen',
        'Racing Sans One',
        'Radio Canada',
        'Radley',
        'Rajdhani',
        'Rakkas',
        'Raleway',
        'Raleway Dots',
        'Ramabhadra',
        'Ramaraja',
        'Rambla',
        'Rammetto One',
        'Rampart One',
        'Ranchers',
        'Rancho',
        'Ranga',
        'Rasa',
        'Rationale',
        'Ravi Prakash',
        'Readex Pro',
        'Recursive',
        'Red Hat Display',
        'Red Hat Mono',
        'Red Hat Text',
        'Red Rose',
        'Redacted',
        'Redacted Script',
        'Redressed',
        'Reem Kufi',
        'Reem Kufi Fun',
        'Reem Kufi Ink',
        'Reenie Beanie',
        'Reggae One',
        'Revalia',
        'Rhodium Libre',
        'Ribeye',
        'Ribeye Marrow',
        'Righteous',
        'Risque',
        'Road Rage',
        'Roboto',
        'Roboto Condensed',
        'Roboto Flex',
        'Roboto Mono',
        'Roboto Serif',
        'Roboto Slab',
        'Rochester',
        'Rock Salt',
        'RocknRoll One',
        'Rokkitt',
        'Romanesco',
        'Ropa Sans',
        'Rosario',
        'Rosarivo',
        'Rouge Script',
        'Rowdies',
        'Rozha One',
        'Rubik',
        'Rubik Beastly',
        'Rubik Bubbles',
        'Rubik Burned',
        'Rubik Dirt',
        'Rubik Distressed',
        'Rubik Glitch',
        'Rubik Iso',
        'Rubik Marker Hatch',
        'Rubik Maze',
        'Rubik Microbe',
        'Rubik Mono One',
        'Rubik Moonrocks',
        'Rubik Puddles',
        'Rubik Wet Paint',
        'Ruda',
        'Rufina',
        'Ruge Boogie',
        'Ruluko',
        'Rum Raisin',
        'Ruslan Display',
        'Russo One',
        'Ruthie',
        'Rye',
        'STIX Two Text',
        'Sacramento',
        'Sahitya',
        'Sail',
        'Saira',
        'Saira Condensed',
        'Saira Extra Condensed',
        'Saira Semi Condensed',
        'Saira Stencil One',
        'Salsa',
        'Sanchez',
        'Sancreek',
        'Sansita',
        'Sansita Swashed',
        'Sarabun',
        'Sarala',
        'Sarina',
        'Sarpanch',
        'Sassy Frass',
        'Satisfy',
        'Sawarabi Gothic',
        'Sawarabi Mincho',
        'Scada',
        'Scheherazade New',
        'Schoolbell',
        'Scope One',
        'Seaweed Script',
        'Secular One',
        'Sedgwick Ave',
        'Sedgwick Ave Display',
        'Sen',
        'Send Flowers',
        'Sevillana',
        'Seymour One',
        'Shadows Into Light',
        'Shadows Into Light Two',
        'Shalimar',
        'Shanti',
        'Share',
        'Share Tech',
        'Share Tech Mono',
        'Shippori Antique',
        'Shippori Antique B1',
        'Shippori Mincho',
        'Shippori Mincho B1',
        'Shojumaru',
        'Short Stack',
        'Shrikhand',
        'Siemreap',
        'Sigmar One',
        'Signika',
        'Signika Negative',
        'Silkscreen',
        'Simonetta',
        'Single Day',
        'Sintony',
        'Sirin Stencil',
        'Six Caps',
        'Skranji',
        'Slabo 13px',
        'Slabo 27px',
        'Slackey',
        'Smokum',
        'Smooch',
        'Smooch Sans',
        'Smythe',
        'Sniglet',
        'Snippet',
        'Snowburst One',
        'Sofadi One',
        'Sofia',
        'Solway',
        'Song Myung',
        'Sono',
        'Sonsie One',
        'Sora',
        'Sorts Mill Goudy',
        'Source Code Pro',
        'Source Sans 3',
        'Source Sans Pro',
        'Source Serif 4',
        'Source Serif Pro',
        'Space Grotesk',
        'Space Mono',
        'Special Elite',
        'Spectral',
        'Spectral SC',
        'Spicy Rice',
        'Spinnaker',
        'Spirax',
        'Splash',
        'Spline Sans',
        'Spline Sans Mono',
        'Squada One',
        'Square Peg',
        'Sree Krushnadevaraya',
        'Sriracha',
        'Srisakdi',
        'Staatliches',
        'Stalemate',
        'Stalinist One',
        'Stardos Stencil',
        'Stick',
        'Stick No Bills',
        'Stint Ultra Condensed',
        'Stint Ultra Expanded',
        'Stoke',
        'Strait',
        'Style Script',
        'Stylish',
        'Sue Ellen Francisco',
        'Suez One',
        'Sulphur Point',
        'Sumana',
        'Sunflower',
        'Sunshiney',
        'Supermercado One',
        'Sura',
        'Suranna',
        'Suravaram',
        'Suwannaphum',
        'Swanky and Moo Moo',
        'Syncopate',
        'Syne',
        'Syne Mono',
        'Syne Tactile',
        'Tai Heritage Pro',
        'Tajawal',
        'Tangerine',
        'Tapestry',
        'Taprom',
        'Tauri',
        'Taviraj',
        'Teko',
        'Telex',
        'Tenali Ramakrishna',
        'Tenor Sans',
        'Text Me One',
        'Texturina',
        'Thasadith',
        'The Girl Next Door',
        'The Nautigal',
        'Tienne',
        'Tillana',
        'Timmana',
        'Tinos',
        'Tiro Bangla',
        'Tiro Devanagari Hindi',
        'Tiro Devanagari Marathi',
        'Tiro Devanagari Sanskrit',
        'Tiro Gurmukhi',
        'Tiro Kannada',
        'Tiro Tamil',
        'Tiro Telugu',
        'Titan One',
        'Titillium Web',
        'Tomorrow',
        'Tourney',
        'Trade Winds',
        'Train One',
        'Trirong',
        'Trispace',
        'Trocchi',
        'Trochut',
        'Truculenta',
        'Trykker',
        'Tulpen One',
        'Turret Road',
        'Twinkle Star',
        'Ubuntu',
        'Ubuntu Condensed',
        'Ubuntu Mono',
        'Uchen',
        'Ultra',
        'Uncial Antiqua',
        'Underdog',
        'Unica One',
        'UnifrakturCook',
        'UnifrakturMaguntia',
        'Unkempt',
        'Unlock',
        'Unna',
        'Updock',
        'Urbanist',
        'VT323',
        'Vampiro One',
        'Varela',
        'Varela Round',
        'Varta',
        'Vast Shadow',
        'Vazirmatn',
        'Vesper Libre',
        'Viaoda Libre',
        'Vibes',
        'Vibur',
        'Vidaloka',
        'Viga',
        'Voces',
        'Volkhov',
        'Vollkorn',
        'Vollkorn SC',
        'Voltaire',
        'Vujahday Script',
        'Waiting for the Sunrise',
        'Wallpoet',
        'Walter Turncoat',
        'Warnes',
        'Water Brush',
        'Waterfall',
        'Wellfleet',
        'Wendy One',
        'Whisper',
        'WindSong',
        'Wire One',
        'Work Sans',
        'Xanh Mono',
        'Yaldevi',
        'Yanone Kaffeesatz',
        'Yantramanav',
        'Yatra One',
        'Yellowtail',
        'Yeon Sung',
        'Yeseva One',
        'Yesteryear',
        'Yomogi',
        'Yrsa',
        'Yuji Boku',
        'Yuji Mai',
        'Yuji Syuku',
        'Yusei Magic',
        'ZCOOL KuaiLe',
        'ZCOOL QingKe HuangYou',
        'ZCOOL XiaoWei',
        'Zen Antique',
        'Zen Antique Soft',
        'Zen Dots',
        'Zen Kaku Gothic Antique',
        'Zen Kaku Gothic New',
        'Zen Kurenaido',
        'Zen Loop',
        'Zen Maru Gothic',
        'Zen Old Mincho',
        'Zen Tokyo Zoo',
        'Zeyada',
        'Zhi Mang Xing',
        'Zilla Slab',
        'Zilla Slab Highlight'
    );
    ?>
							<?php 
    if ( isset( $wbm_product_slider_typo_meta ) && !empty( $wbm_product_slider_typo_meta ) ) {
        foreach ( $wbm_product_slider_typo_meta as $sliders_settings ) {
            $wbm_product_typo_on_off = ( isset( $sliders_settings['wbm_product_typo_on_off'] ) ? $sliders_settings['wbm_product_typo_on_off'] : 'off' );
            $wbm_product_title_typo_font_family = ( isset( $sliders_settings['wbm_product_title_typo_font_family'] ) ? $sliders_settings['wbm_product_title_typo_font_family'] : 'none' );
            $wbm_product_title_typo_font_style = ( isset( $sliders_settings['wbm_product_title_typo_font_style'] ) ? $sliders_settings['wbm_product_title_typo_font_style'] : 'none' );
            $wbm_product_title_typo_text_align = ( isset( $sliders_settings['wbm_product_title_typo_text_align'] ) ? $sliders_settings['wbm_product_title_typo_text_align'] : 'none' );
            $wbm_product_title_typo_text_transform = ( isset( $sliders_settings['wbm_product_title_typo_text_transform'] ) ? $sliders_settings['wbm_product_title_typo_text_transform'] : 'none' );
            $wbm_product_title_typo_text_font_size = ( isset( $sliders_settings['wbm_product_title_typo_text_font_size'] ) ? $sliders_settings['wbm_product_title_typo_text_font_size'] : 0 );
            $wbm_product_title_typo_text_line_height = ( isset( $sliders_settings['wbm_product_title_typo_text_line_height'] ) ? $sliders_settings['wbm_product_title_typo_text_line_height'] : 0 );
            $wbm_product_title_typo_text_letter_spacing = ( isset( $sliders_settings['wbm_product_title_typo_text_letter_spacing'] ) ? $sliders_settings['wbm_product_title_typo_text_letter_spacing'] : 0 );
            $wbm_product_typo_shopbtn_on_off = ( isset( $sliders_settings['wbm_product_typo_shopbtn_on_off'] ) ? $sliders_settings['wbm_product_typo_shopbtn_on_off'] : 'off' );
            $wbm_product_title_typo_shopbtn_font_family = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_font_family'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_font_family'] : 'none' );
            $wbm_product_title_typo_shopbtn_font_style = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_font_style'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_font_style'] : 'none' );
            $wbm_product_title_typo_shopbtn_text_align = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_text_align'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_text_align'] : 'none' );
            $wbm_product_title_typo_shopbtn_text_transform = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_text_transform'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_text_transform'] : 'none' );
            $wbm_product_title_typo_shopbtn_text_font_size = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_text_font_size'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_text_font_size'] : 0 );
            $wbm_product_title_typo_shopbtn_text_line_height = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_text_line_height'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_text_line_height'] : 0 );
            $wbm_product_title_typo_shopbtn_text_letter_spacing = ( isset( $sliders_settings['wbm_product_title_typo_shopbtn_text_letter_spacing'] ) ? $sliders_settings['wbm_product_title_typo_shopbtn_text_letter_spacing'] : 0 );
            $wbm_product_typo_addtocart_on_off = ( isset( $sliders_settings['wbm_product_typo_addtocart_on_off'] ) ? $sliders_settings['wbm_product_typo_addtocart_on_off'] : 'off' );
            $wbm_product_title_typo_addtocart_font_family = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_font_family'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_font_family'] : 'none' );
            $wbm_product_title_typo_addtocart_font_style = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_font_style'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_font_style'] : 'none' );
            $wbm_product_title_typo_addtocart_text_align = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_text_align'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_text_align'] : 'none' );
            $wbm_product_title_typo_addtocart_text_transform = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_text_transform'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_text_transform'] : 'none' );
            $wbm_product_title_typo_addtocart_text_font_size = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_text_font_size'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_text_font_size'] : 0 );
            $wbm_product_title_typo_addtocart_text_line_height = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_text_line_height'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_text_line_height'] : 0 );
            $wbm_product_title_typo_addtocart_text_letter_spacing = ( isset( $sliders_settings['wbm_product_title_typo_addtocart_text_letter_spacing'] ) ? $sliders_settings['wbm_product_title_typo_addtocart_text_letter_spacing'] : 0 );
            ?>
										<tr valign="top">
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay"><?php 
            esc_html_e( 'Load Product Title Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Enable/Disable Product Title Font.', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
													<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_on_off]" value="true" <?php 
            checked( $wbm_product_typo_on_off, 'true' );
            ?>>
													<span class="dswbm_toggle_btn"></span>
												</label>
											</td>
										</tr>
										<tr valign="top" <?php 
            echo ( 'off' === $wbm_product_typo_on_off ? 'style="display:none"' : '' );
            ?>>
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay_speed"><?php 
            esc_html_e( 'Product Title Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Set Product Title Fonts', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<div class="form-first-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_font_family]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_font_family ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
            foreach ( $fonts as $fnt ) {
                ?>
																		<option value="<?php 
                echo esc_attr( $fnt );
                ?>" <?php 
                echo ( $fnt === $wbm_product_title_typo_font_family ? 'selected' : '' );
                ?>><?php 
                esc_html_e( $fnt, 'banner-management-for-woocommerce' );
                ?></option>
																	<?php 
            }
            ?>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_font_style]">
															<option value="none"><?php 
            esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="100" <?php 
            echo ( '100' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '100', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="200" <?php 
            echo ( '200' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '200', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="300" <?php 
            echo ( '300' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '300', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="400" <?php 
            echo ( '400' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '400', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="500" <?php 
            echo ( '500' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '500', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="600" <?php 
            echo ( '600' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '600', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="700" <?php 
            echo ( '700' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '700', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="800" <?php 
            echo ( '800' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '800', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="900" <?php 
            echo ( '900' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '900', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lighter" <?php 
            echo ( 'lighter' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bold" <?php 
            echo ( 'bold' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bold', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bolder" <?php 
            echo ( 'bolder' === $wbm_product_title_typo_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-second-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_text_align]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="left" <?php 
            echo ( 'left' === $wbm_product_title_typo_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Left', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="center" <?php 
            echo ( 'center' === $wbm_product_title_typo_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Center', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="right" <?php 
            echo ( 'right' === $wbm_product_title_typo_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Right', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_text_transform]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="capitalize" <?php 
            echo ( 'capitalize' === $wbm_product_title_typo_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lowercase" <?php 
            echo ( 'lowercase' === $wbm_product_title_typo_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="uppercase" <?php 
            echo ( 'uppercase' === $wbm_product_title_typo_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-third-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_font_size]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_text_font_size );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_line_height]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_text_line_height );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_letter_spacing]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_text_letter_spacing );
            ?>">
													</div>
												</div>
											</td>
										</tr>

										<tr valign="top">
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay"><?php 
            esc_html_e( 'Load Product Price Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Enable/Disable Product Price Font.', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
													<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_shopbtn_on_off]" value="true" <?php 
            checked( $wbm_product_typo_shopbtn_on_off, 'true' );
            ?>>
													<span class="dswbm_toggle_btn"></span>
												</label>
											</td>
										</tr>
										<tr valign="top" <?php 
            echo ( 'off' === $wbm_product_typo_shopbtn_on_off ? 'style="display:none"' : '' );
            ?>>
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay_speed"><?php 
            esc_html_e( 'Product Price Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Set Product Price Fonts', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<div class="form-first-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_family]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_shopbtn_font_family ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
            foreach ( $fonts as $fnt ) {
                ?>
																		<option value="<?php 
                echo esc_attr( $fnt );
                ?>" <?php 
                echo ( $fnt === $wbm_product_title_typo_shopbtn_font_family ? 'selected' : '' );
                ?>><?php 
                esc_html_e( $fnt, 'banner-management-for-woocommerce' );
                ?></option>
																	<?php 
            }
            ?>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_style]">
															<option value="none"><?php 
            esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="100" <?php 
            echo ( '100' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '100', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="200" <?php 
            echo ( '200' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '200', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="300" <?php 
            echo ( '300' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '300', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="400" <?php 
            echo ( '400' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '400', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="500" <?php 
            echo ( '500' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '500', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="600" <?php 
            echo ( '600' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '600', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="700" <?php 
            echo ( '700' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '700', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="800" <?php 
            echo ( '800' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '800', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="900" <?php 
            echo ( '900' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '900', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lighter" <?php 
            echo ( 'lighter' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bold" <?php 
            echo ( 'bold' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bold', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bolder" <?php 
            echo ( 'bolder' === $wbm_product_title_typo_shopbtn_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-second-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_align]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_shopbtn_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="left" <?php 
            echo ( 'left' === $wbm_product_title_typo_shopbtn_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Left', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="center" <?php 
            echo ( 'center' === $wbm_product_title_typo_shopbtn_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Center', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="right" <?php 
            echo ( 'right' === $wbm_product_title_typo_shopbtn_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Right', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_transform]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_shopbtn_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="capitalize" <?php 
            echo ( 'capitalize' === $wbm_product_title_typo_shopbtn_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lowercase" <?php 
            echo ( 'lowercase' === $wbm_product_title_typo_shopbtn_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="uppercase" <?php 
            echo ( 'uppercase' === $wbm_product_title_typo_shopbtn_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-third-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_font_size]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_shopbtn_text_font_size );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_line_height]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_shopbtn_text_line_height );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_letter_spacing]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_shopbtn_text_letter_spacing );
            ?>">
													</div>
												</div>
											</td>
										</tr>

										<tr valign="top">
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay"><?php 
            esc_html_e( 'Load Add To Cart Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Enable/Disable Add To Cart Font.', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
													<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_addtocart_on_off]" value="true" <?php 
            checked( $wbm_product_typo_addtocart_on_off, 'true' );
            ?>>
													<span class="dswbm_toggle_btn"></span>
												</label>
											</td>
										</tr>
										<tr valign="top" <?php 
            echo ( 'off' === $wbm_product_typo_addtocart_on_off ? 'style="display:none"' : '' );
            ?>>
											<th class="titledesc" scope="row">
												<label for="wbm_cat_autoplay_speed"><?php 
            esc_html_e( 'Add To Cart Font', 'banner-management-for-woocommerce' );
            ?></label>
												<span class="banner-woocommerce-help-tip">
													<div class="alert-desc">
														<?php 
            esc_html_e( 'Set Add To Cart Fonts', 'banner-management-for-woocommerce' );
            ?>
													</div>
												</span>
												<p class="description" style="display:none;">
													
												</p>
											</th>
											<td class="forminp">
												<div class="form-first-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_family]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_addtocart_font_family ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
            foreach ( $fonts as $fnt ) {
                ?>
																		<option value="<?php 
                echo esc_attr( $fnt );
                ?>" <?php 
                echo ( $fnt === $wbm_product_title_typo_addtocart_font_family ? 'selected' : '' );
                ?>><?php 
                esc_html_e( $fnt, 'banner-management-for-woocommerce' );
                ?></option>
																	<?php 
            }
            ?>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_style]">
															<option value="none"><?php 
            esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="100" <?php 
            echo ( '100' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '100', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="200" <?php 
            echo ( '200' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '200', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="300" <?php 
            echo ( '300' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '300', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="400" <?php 
            echo ( '400' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '400', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="500" <?php 
            echo ( '500' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '500', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="600" <?php 
            echo ( '600' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '600', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="700" <?php 
            echo ( '700' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '700', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="800" <?php 
            echo ( '800' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '800', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="900" <?php 
            echo ( '900' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( '900', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lighter" <?php 
            echo ( 'lighter' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bold" <?php 
            echo ( 'bold' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bold', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="bolder" <?php 
            echo ( 'bolder' === $wbm_product_title_typo_addtocart_font_style ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-second-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_align]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_addtocart_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="left" <?php 
            echo ( 'left' === $wbm_product_title_typo_addtocart_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Left', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="center" <?php 
            echo ( 'center' === $wbm_product_title_typo_addtocart_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Center', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="right" <?php 
            echo ( 'right' === $wbm_product_title_typo_addtocart_text_align ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Right', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
            ?></p>
														<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_transform]">
															<option value="none" <?php 
            echo ( 'none' === $wbm_product_title_typo_addtocart_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="capitalize" <?php 
            echo ( 'capitalize' === $wbm_product_title_typo_addtocart_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="lowercase" <?php 
            echo ( 'lowercase' === $wbm_product_title_typo_addtocart_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
            ?></option>
															<option value="uppercase" <?php 
            echo ( 'uppercase' === $wbm_product_title_typo_addtocart_text_transform ? 'selected' : '' );
            ?>><?php 
            esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
            ?></option>
														</select>
													</div>
												</div>
												<div class="form-third-elmn typo-items">
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_font_size]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_addtocart_text_font_size );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_line_height]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_addtocart_text_line_height );
            ?>">
													</div>
													<div class="form-inp-single">
														<p><?php 
            esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
            ?></p>
														<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_letter_spacing]" value="<?php 
            echo esc_attr( $wbm_product_title_typo_addtocart_text_letter_spacing );
            ?>">
													</div>
												</div>
											</td>
										</tr>
									<?php 
        }
    } else {
        ?>
								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay"><?php 
        esc_html_e( 'Load Product Title Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable Product Title Font.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
											<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_on_off]" value="true">
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top" style="display:none">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay_speed"><?php 
        esc_html_e( 'Product Title Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set Product Title Fonts', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<div class="form-first-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_font_family]">
													<option value="none" ><?php 
        esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
        ?></option>
													<?php 
        foreach ( $fonts as $fnt ) {
            ?>
																<option value="<?php 
            echo esc_attr( $fnt );
            ?>"><?php 
            esc_html_e( $fnt, 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
        }
        ?>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_font_style]">
													<option value="none"><?php 
        esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="100"><?php 
        esc_html_e( '100', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="200"><?php 
        esc_html_e( '200', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="300"><?php 
        esc_html_e( '300', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="400"><?php 
        esc_html_e( '400', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="500"><?php 
        esc_html_e( '500', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="600"><?php 
        esc_html_e( '600', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="700"><?php 
        esc_html_e( '700', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="800"><?php 
        esc_html_e( '800', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="900"><?php 
        esc_html_e( '900', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lighter"><?php 
        esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bold"><?php 
        esc_html_e( 'bold', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bolder"><?php 
        esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-second-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_text_align]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="left"><?php 
        esc_html_e( 'Left', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="center"><?php 
        esc_html_e( 'Center', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="right"><?php 
        esc_html_e( 'Right', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_text_transform]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="capitalize"><?php 
        esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lowercase"><?php 
        esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="uppercase"><?php 
        esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-third-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_font_size]" value="">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_line_height]" value="">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_letter_spacing]" value="">
											</div>
										</div>
									</td>
								</tr>

								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay"><?php 
        esc_html_e( 'Load Product Price Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable Product Price Font.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
											<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_shopbtn_on_off]" value="true">
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top" style="display:none">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay_speed"><?php 
        esc_html_e( 'Product Price Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set Product Price Fonts', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<div class="form-first-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_family]">
													<option value="none"><?php 
        esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
        ?></option>
													<?php 
        foreach ( $fonts as $fnt ) {
            ?>
																<option value="<?php 
            echo esc_attr( $fnt );
            ?>"><?php 
            esc_html_e( $fnt, 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
        }
        ?>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_style]">
													<option value="none"><?php 
        esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="100"><?php 
        esc_html_e( '100', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="200"><?php 
        esc_html_e( '200', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="300"><?php 
        esc_html_e( '300', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="400"><?php 
        esc_html_e( '400', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="500"><?php 
        esc_html_e( '500', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="600"><?php 
        esc_html_e( '600', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="700"><?php 
        esc_html_e( '700', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="800"><?php 
        esc_html_e( '800', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="900"><?php 
        esc_html_e( '900', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lighter"><?php 
        esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bold"><?php 
        esc_html_e( 'bold', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bolder"><?php 
        esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-second-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_align]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="left"><?php 
        esc_html_e( 'Left', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="center"><?php 
        esc_html_e( 'Center', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="right"><?php 
        esc_html_e( 'Right', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_transform]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="capitalize"><?php 
        esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lowercase"><?php 
        esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="uppercase"><?php 
        esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-third-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_font_size]" value="">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_line_height]" value="">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_letter_spacing]" value="">
											</div>
										</div>
									</td>
								</tr>

								<tr valign="top">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay"><?php 
        esc_html_e( 'Load Add To Cart Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Enable/Disable Add To Cart Font.', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
											<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_addtocart_on_off]" value="true">
											<span class="dswbm_toggle_btn"></span>
										</label>
									</td>
								</tr>
								<tr valign="top" style="display:none">
									<th class="titledesc" scope="row">
										<label for="wbm_cat_autoplay_speed"><?php 
        esc_html_e( 'Add To Cart Font', 'banner-management-for-woocommerce' );
        ?></label>
										<span class="banner-woocommerce-help-tip">
											<div class="alert-desc">
												<?php 
        esc_html_e( 'Set Add To Cart Fonts', 'banner-management-for-woocommerce' );
        ?>
											</div>
										</span>
										<p class="description" style="display:none;">
											
										</p>
									</th>
									<td class="forminp">
										<div class="form-first-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_family]">
													<option value="none" ><?php 
        esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
        ?></option>
													<?php 
        foreach ( $fonts as $fnt ) {
            ?>
																<option value="<?php 
            echo esc_attr( $fnt );
            ?>"><?php 
            esc_html_e( $fnt, 'banner-management-for-woocommerce' );
            ?></option>
															<?php 
        }
        ?>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_style]">
													<option value="none"><?php 
        esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="100"><?php 
        esc_html_e( '100', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="200"><?php 
        esc_html_e( '200', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="300"><?php 
        esc_html_e( '300', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="400"><?php 
        esc_html_e( '400', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="500"><?php 
        esc_html_e( '500', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="600"><?php 
        esc_html_e( '600', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="700"><?php 
        esc_html_e( '700', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="800"><?php 
        esc_html_e( '800', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="900"><?php 
        esc_html_e( '900', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lighter"><?php 
        esc_html_e( 'lighter', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bold"><?php 
        esc_html_e( 'bold', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="bolder"><?php 
        esc_html_e( 'bolder', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-second-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_align]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="left"><?php 
        esc_html_e( 'Left', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="center"><?php 
        esc_html_e( 'Center', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="right"><?php 
        esc_html_e( 'Right', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
        ?></p>
												<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_transform]">
													<option value="none"><?php 
        esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="capitalize"><?php 
        esc_html_e( 'Capitalize', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="lowercase"><?php 
        esc_html_e( 'Lowercase', 'banner-management-for-woocommerce' );
        ?></option>
													<option value="uppercase"><?php 
        esc_html_e( 'Uppercase', 'banner-management-for-woocommerce' );
        ?></option>
												</select>
											</div>
										</div>
										<div class="form-third-elmn typo-items">
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_font_size]" value="0">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_line_height]" value="0">
											</div>
											<div class="form-inp-single">
												<p><?php 
        esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
        ?></p>
												<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_letter_spacing]" value="0">
											</div>
										</div>
									</td>
								</tr>
								<?php 
    }
    ?>
						</tbody>
					</table>
				</div>
				<?php 
} else {
    ?>
				<div id="wbm-slider-section-5" class="wbm-slider-section">
					<table class="form-table table-outer sliders-settings-tbl">
						<tbody>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay"><?php 
    esc_html_e( 'Load Product Title Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable Product Title Font.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
										<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_on_off]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay_speed"><?php 
    esc_html_e( 'Product Title Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set Product Title Fonts', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp wcbm-upgrade-to-pro">
									<div class="form-first-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_font_family]">
												<option value="none" ><?php 
    esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_font_style]">
												<option value="none"><?php 
    esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-second-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_text_align]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_text_transform]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-third-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_font_size]" value="">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_line_height]" value="">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_text_letter_spacing]" value="">
										</div>
									</div>
								</td>
							</tr>

							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay"><?php 
    esc_html_e( 'Load Product Price Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable Product Price Font.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
										<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_shopbtn_on_off]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay_speed"><?php 
    esc_html_e( 'Product Price Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set Product Price Fonts', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp wcbm-upgrade-to-pro">
									<div class="form-first-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_family]">
												<option value="none"><?php 
    esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_font_style]">
												<option value="none"><?php 
    esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-second-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_align]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_transform]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-third-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_font_size]" value="">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_line_height]" value="">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_shopbtn_text_letter_spacing]" value="">
										</div>
									</div>
								</td>
							</tr>

							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay"><?php 
    esc_html_e( 'Load Add To Cart Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Enable/Disable Add To Cart Font.', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
								</th>
								<td class="forminp">
									<label class="dswbm_toggle_switch dswbm_toggle_switch_to_next">
										<input type="checkbox" id="wbm_cat_autoplay" name="wbm_product_slider_typo[wbm_product_typo_addtocart_on_off]" value="true" checked>
										<span class="dswbm_toggle_btn"></span>
									</label>
								</td>
							</tr>
							<tr valign="top">
								<th class="titledesc" scope="row">
									<label for="wbm_cat_autoplay_speed"><?php 
    esc_html_e( 'Add To Cart Font', 'banner-management-for-woocommerce' );
    ?><div class="wcbm-pro-label"></div></label>
									<span class="banner-woocommerce-help-tip">
										<div class="alert-desc">
											<?php 
    esc_html_e( 'Set Add To Cart Fonts', 'banner-management-for-woocommerce' );
    ?>
										</div>
									</span>
									<p class="description" style="display:none;">
										
									</p>
								</th>
								<td class="forminp wcbm-upgrade-to-pro">
									<div class="form-first-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Family', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_family]">
												<option value="none" ><?php 
    esc_html_e( 'Select Font Family', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Weight', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_font_style]">
												<option value="none"><?php 
    esc_html_e( 'Select Font Weight', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-second-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Align', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_align]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Align', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Text Transform', 'banner-management-for-woocommerce' );
    ?></p>
											<select name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_transform]">
												<option value="none"><?php 
    esc_html_e( 'Select Text Transform', 'banner-management-for-woocommerce' );
    ?></option>
											</select>
										</div>
									</div>
									<div class="form-third-elmn typo-items">
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Font Size', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_font_size]" value="0">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Line Height', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_line_height]" value="0">
										</div>
										<div class="form-inp-single">
											<p><?php 
    esc_html_e( 'Letter Spacing', 'banner-management-for-woocommerce' );
    ?></p>
											<input type="number" class="wbm_cat_nav_border" min="0" name="wbm_product_slider_typo[wbm_product_title_typo_addtocart_text_letter_spacing]" value="0">
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php 
}
?>
		</div>
		<div class="sliders-save-preview-btn">
			<p>
				<input type="submit" class="button button-primary" name="wbm_product_sliders_save"
			       value="<?php 
esc_attr_e( 'Save Slider', 'banner-management-for-woocommerce' );
?>">
			</p>
			<p>
				<button id="wbm-product-slider-preview-btn" class="button dots-btn-with-brand-color"><?php 
esc_html_e( 'Show Preview', 'banner-management-for-woocommerce' );
?></button>
			</p>
		</div>
		<?php 
wp_nonce_field( 'woocommerce_save_method', 'wbm_product_sliders_save_method_nonce' );
?>
		<div class="wbm_slider_live_preview">
			<div class="slider-preview-header">
				<h3><?php 
esc_html_e( 'Live Preview', 'banner-management-for-woocommerce' );
?></h3>
				<p><?php 
esc_html_e( 'Save the slider and apply the same settings to your slider.', 'banner-management-for-woocommerce' );
?></p>
			</div>
			<div class="slider-preview-body">
				
			</div>
		</div>
	</div>
	<div class="wbm-slider-shortcode-box">
		<div class="shortcode-box-head">
			<h2><?php 
echo esc_html__( 'Copy Shortcode', 'banner-management-for-woocommerce' );
?></h2>
		</div>
		<div class="shortcode-box-body">
			<div class="wbm-scode-content">
				<h3 class="wbm-scode-title"><?php 
echo esc_html__( 'Page or Post Include', 'banner-management-for-woocommerce' );
?></h3>
				<p><?php 
echo esc_html__( 'Copy and paste this shortcode into your posts or pages:', 'banner-management-for-woocommerce' );
?></p>
				<?php 
$copy_page_shortcode = '<div class="wbm-after-copy-text"><span class="dashicons dashicons-yes-alt"></span> Shortcode  Copied to Clipboard! </div><div class="wbm-code wbm-copy-shortcode">[wcbm_product id=&quot;' . $get_post_id . '&quot;]</div>';
echo wp_kses( $copy_page_shortcode, $dswbm_admin_object->wcbm_allowed_html_tags() );
?>
			</div>
			<div class="wbm-scode-content">
				<h3 class="wbm-scode-title"><?php 
echo esc_html__( 'Template Include', 'banner-management-for-woocommerce' );
?></h3>
				<p><?php 
echo esc_html__( 'Paste the PHP code into your template file:', 'banner-management-for-woocommerce' );
?></p>
				<?php 
$copy_template_shortcode = '<div class="wbm-after-copy-text"><span class="dashicons dashicons-yes-alt"></span> Shortcode  Copied to Clipboard! </div><div class="wbm-code wbm-copy-shortcode">&lt;?php echo do_shortcode(\'[wcbm_product id=&quot;' . $get_post_id . '&quot;]\'); ?&gt;</div>';
echo wp_kses( $copy_template_shortcode, $dswbm_admin_object->wcbm_allowed_html_tags() );
?>
			</div>
		</div>
	</div>
</div>
