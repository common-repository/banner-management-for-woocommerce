<?php
/**
 * Handles free plugin user dashboard
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once( plugin_dir_path( __FILE__ ) . 'header/plugin-header.php' );

// Get product details from Freemius via API
$annual_plugin_price = '';
$monthly_plugin_price = '';
$plugin_details = array(
    'product_id' => 45291,
);

$api_url = add_query_arg(wp_rand(), '', WCBM_STORE_URL . 'wp-json/dotstore-product-fs-data/v2/dotstore-product-fs-data');
$final_api_url = add_query_arg($plugin_details, $api_url);

if ( function_exists( 'vip_safe_wp_remote_get' ) ) {
    $api_response = vip_safe_wp_remote_get( $final_api_url, 3, 1, 20 );
} else {
    $api_response = wp_remote_get( $final_api_url ); // phpcs:ignore
}

if ( ( !is_wp_error($api_response)) && (200 === wp_remote_retrieve_response_code( $api_response ) ) ) {
	$api_response_body = wp_remote_retrieve_body($api_response);
	$plugin_pricing = json_decode( $api_response_body, true );

	if ( isset( $plugin_pricing ) && ! empty( $plugin_pricing ) ) {
		$first_element = reset( $plugin_pricing );
        if ( ! empty( $first_element['price_data'] ) ) {
            $first_price = reset( $first_element['price_data'] )['annual_price'];
        } else {
            $first_price = "0";
        }

        if( "0" !== $first_price ){
        	$annual_plugin_price = $first_price;
        	$monthly_plugin_price = round( intval( $first_price  ) / 12 );
        }
	}
}

// Set plugin key features content
$plugin_key_features = array(
    array(
        'title' => esc_html__( 'Banner Slider for Any Page', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Easily add a banner or slider to any page in your WooCommerce store, including the landing page, about, contact, and more.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-one-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Easily add eye-catching banners to any website page, from the shop to the thank you page, product pages, and more.', 'banner-management-for-woocommerce' )
        ),
        'popup_examples' => array(
            esc_html__( 'Increase engagement and conversions by strategically placing visually appealing banners that deliver targeted messages.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Effortlessly resize, position, and align banners with a few clicks for the perfect placement and impactful promotion of special offers, new products, and announcements.', 'banner-management-for-woocommerce' ),
        )
    ),
    array(
        'title' => esc_html__( 'Auto-Schedule Banner Slider', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Automatically activate and deactivate your banner slider based on offer durations by setting an end date.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-two-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Simplify your banner management process with the Auto-Schedule Slider feature.', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Automatically schedule and display banners at predefined times, ensuring timely promotions without manual intervention.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Save time and effort by setting up your banner campaigns in advance and letting the Auto-Schedule Slider handle the display.', 'banner-management-for-woocommerce' )
        )
    ),
    array(
        'title' => esc_html__( 'Add Call to Action on Banner', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Encourage shoppers to take action with a powerful and customizable call-to-action button on your banner, complete with a custom link for easy navigation.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-three-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Drive action and conversions with our powerful Call to Action (CTA) feature.', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Engage your website visitors and guide them towards desired actions, such as making a purchase, signing up for a newsletter, or contacting your business.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Add a call-to-action button with a link to your shop page to encourage customer purchases with exclusive discounts.', 'banner-management-for-woocommerce' )
        )
    ),
    array(
        'title' => esc_html__( 'Customize Banner Positioning', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Easily adjust your banner\'s placement on your webpage to make it more eye-catching and effective in grabbing shoppers\' attention.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-four-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Achieve precise and strategic banner placement on your website with our Banner Positioning feature.', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Seamlessly control where banners appear, ensuring maximum visibility and impact for your promotional messages.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Customize the position of your banners on different pages, such as the top header or after title.', 'banner-management-for-woocommerce' ),
        )
    ),
    array(
        'title' => esc_html__( 'Add a Random Banner Slider', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Display one or multiple banners anywhere you choose, with randomized rotation. Maximize engagement and deliver diverse messages, capturing attention effectively.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-five-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Maximize the effectiveness of your promotional efforts by leveraging the power of random banners.', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Enjoy the flexibility of random banner rotation, ensuring that each visit to your website presents visitors with a fresh and unique banner.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Engage your audience with a variety of messages, promotions, and visuals, keeping them interested and enticing them to explore further.', 'banner-management-for-woocommerce' )
        )
    ),
    array(
        'title' => esc_html__( 'Multi-Platform Compatibility', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Display your banner or carousel slider flawlessly on all devices, including desktops, tablets, and mobile devices, with automatic responsiveness.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-six-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Ensure seamless functionality across various platforms with our Multi-Platform Compatibility feature.', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Our plugin is designed to work effortlessly on different operating systems, browsers, and devices, providing a consistent experience for all users.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Reach a wider audience by supporting popular platforms such as Windows, macOS, iOS, Android, and major web browsers including Chrome, Firefox, Safari, and Edge.', 'banner-management-for-woocommerce' )
        )
    ),
    array(
        'title' => esc_html__( 'Set The Layout Preset', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'It allows you to align the product/category listing layout with your website layout, such as slider, grid, or block.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-seven-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Customize the visual presentation of your banners effortlessly with our Layout Preset feature. ', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Choose from a variety of layout options, including slider, grid, and block, to showcase your slider in a visually appealing and organized manner.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Opt for a slider layout to create an engaging slideshow of banners that catch the attention of your website visitors.', 'banner-management-for-woocommerce' ),
        )
    ),
    array(
        'title' => esc_html__( 'Quick Preview Before Live', 'banner-management-for-woocommerce' ),
        'description' => esc_html__( 'Save time and effort with instant previewing of custom changes, allowing you to make adjustments without the need to save repeatedly confidently.', 'banner-management-for-woocommerce' ),
        'popup_image' => esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/pro-features-img/feature-box-eight-img.png' ),
        'popup_content' => array(
        	esc_html__( 'Quickly preview banners or sliders before making them live on the website. ', 'banner-management-for-woocommerce' ),
        ),
        'popup_examples' => array(
            esc_html__( 'This feature provides a convenient way to review and ensure the visual appearance, content, and functionality of banners or sliders without extensive testing or publishing them publicly.', 'banner-management-for-woocommerce' ),
            esc_html__( 'Preview your category or product slider settings before making them live and save valuable time and effort.', 'banner-management-for-woocommerce' ),
        )
    )
);
?>
	<div class="dotstore-upgrade-dashboard">
		<div class="premium-benefits-section">
			<h2><?php esc_html_e( 'Upgrade to Unlock Premium Features', 'banner-management-for-woocommerce' ); ?></h2>
			<p><?php esc_html_e( 'Upgrade to the premium version to access advanced features and spotlight products, advertise sales, and boost revenues!', 'banner-management-for-woocommerce' ); ?></p>
		</div>
		<div class="premium-plugin-details">
			<div class="premium-key-fetures">
				<h3><?php esc_html_e( 'Discover Our Top Key Features', 'banner-management-for-woocommerce' ); ?></h3>
				<ul>
					<?php 
					if ( isset( $plugin_key_features ) && ! empty( $plugin_key_features ) ) {
						foreach( $plugin_key_features as $key_feature ) {
							?>
							<li>
								<h4><?php echo esc_html( $key_feature['title'] ); ?><span class="premium-feature-popup"></span></h4>
								<p><?php echo esc_html( $key_feature['description'] ); ?></p>
								<div class="feature-explanation-popup-main">
									<div class="feature-explanation-popup-outer">
										<div class="feature-explanation-popup-inner">
											<div class="feature-explanation-popup">
												<span class="dashicons dashicons-no-alt popup-close-btn" title="<?php esc_attr_e('Close', 'banner-management-for-woocommerce'); ?>"></span>
												<div class="popup-body-content">
													<div class="feature-content">
														<h4><?php echo esc_html( $key_feature['title'] ); ?></h4>
														<?php 
														if ( isset( $key_feature['popup_content'] ) && ! empty( $key_feature['popup_content'] ) ) {
															foreach( $key_feature['popup_content'] as $feature_content ) {
																?>
																<p><?php echo esc_html( $feature_content ); ?></p>
																<?php
															}
														}
														?>
														<ul>
															<?php 
															if ( isset( $key_feature['popup_examples'] ) && ! empty( $key_feature['popup_examples'] ) ) {
																foreach( $key_feature['popup_examples'] as $feature_example ) {
																	?>
																	<li><?php echo esc_html( $feature_example ); ?></li>
																	<?php
																}
															}
															?>
														</ul>
													</div>
													<div class="feature-image">
														<img src="<?php echo esc_url( $key_feature['popup_image'] ); ?>" alt="<?php echo esc_attr( $key_feature['title'] ); ?>">
													</div>
												</div>
											</div>		
										</div>
									</div>
								</div>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
			<div class="premium-plugin-buy">
				<div class="premium-buy-price-box">
					<div class="price-box-top">
						<div class="pricing-icon">
							<img src="<?php echo esc_url( WCBM_PRO_PLUGIN_URL . 'admin/images/premium-upgrade-img/pricing-1.svg' ); ?>" alt="<?php esc_attr_e( 'Personal Plan', 'banner-management-for-woocommerce' ); ?>">
						</div>
						<h4><?php esc_html_e( 'Personal', 'banner-management-for-woocommerce' ); ?></h4>
					</div>
					<div class="price-box-middle">
						<?php
						if ( ! empty( $annual_plugin_price ) ) {
							?>
							<div class="monthly-price-wrap"><?php echo esc_html( '$' . $monthly_plugin_price ); ?><span class="seprater">/</span><span><?php esc_html_e( 'month', 'banner-management-for-woocommerce' ); ?></span></div>
							<div class="yearly-price-wrap"><?php echo sprintf( esc_html__( 'Pay $%s today. Renews in 12 months.', 'banner-management-for-woocommerce' ), esc_html( $annual_plugin_price ) ); ?></div>
							<?php	
						}
						?>
						<span class="for-site"><?php esc_html_e( '1 site', 'banner-management-for-woocommerce' ); ?></span>
						<p class="price-desc"><?php esc_html_e( 'Great for website owners with a single WooCommerce Store', 'banner-management-for-woocommerce' ); ?></p>
					</div>
					<div class="price-box-bottom">
						<a href="javascript:void(0);" class="upgrade-now"><?php esc_html_e( 'Get The Premium Version', 'banner-management-for-woocommerce' ); ?></a>
						<p class="trusted-by"><?php esc_html_e( 'Trusted by 100,000+ store owners and WP experts!', 'banner-management-for-woocommerce' ); ?></p>
					</div>
				</div>
				<div class="premium-satisfaction-guarantee premium-satisfaction-guarantee-2">
					<div class="money-back-img">
						<img src="<?php echo esc_url(WCBM_PRO_PLUGIN_URL . 'admin/images/premium-upgrade-img/14-Days-Money-Back-Guarantee.png'); ?>" alt="<?php esc_attr_e('14-Day money-back guarantee', 'banner-management-for-woocommerce'); ?>">
					</div>
					<div class="money-back-content">
						<h2><?php esc_html_e( '14-Day Satisfaction Guarantee', 'banner-management-for-woocommerce' ); ?></h2>
						<p><?php esc_html_e( 'You are fully protected by our 100% Satisfaction Guarantee. If over the next 14 days you are unhappy with our plugin or have an issue that we are unable to resolve, we\'ll happily consider offering a 100% refund of your money.', 'banner-management-for-woocommerce' ); ?></p>
					</div>
				</div>
				<div class="plugin-customer-review">
					<h3><?php esc_html_e( 'So Many Options-Love It', 'banner-management-for-woocommerce' ); ?></h3>
					<p>
						<?php echo wp_kses( __( '<strong>Simple to install and use</strong>. I love the option to use different banners/headers for different pages in the store to promote product discounts. <strong>Exactly what I was looking for</strong>!', 'banner-management-for-woocommerce' ), array(
				                'strong' => array(),
				            ) ); 
			            ?>
		            </p>
					<div class="review-customer">
						<div class="customer-img">
							<img src="<?php echo esc_url(WCBM_PRO_PLUGIN_URL . 'admin/images/premium-upgrade-img/customer-profile-img.png'); ?>" alt="<?php esc_attr_e('Customer Profile Image', 'banner-management-for-woocommerce'); ?>">
						</div>
						<div class="customer-name">
							<span><?php esc_html_e( 'Eliana Lockhart', 'banner-management-for-woocommerce' ); ?></span>
							<div class="customer-rating-bottom">
								<div class="customer-ratings">
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
								</div>
								<div class="verified-customer">
									<span class="dashicons dashicons-yes-alt"></span>
									<?php esc_html_e( 'Verified Customer', 'banner-management-for-woocommerce' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="upgrade-to-pro-faqs">
			<h2><?php esc_html_e( 'FAQs', 'banner-management-for-woocommerce' ); ?></h2>
			<div class="upgrade-faqs-main">
				<div class="upgrade-faqs-list">
					<div class="upgrade-faqs-header">
						<h3><?php esc_html_e( 'Do you offer support for the plugin? What’s it like?', 'banner-management-for-woocommerce' ); ?></h3>
					</div>
					<div class="upgrade-faqs-body">
						<p>
						<?php 
							echo sprintf(
							    esc_html__('Yes! You can read our %s or submit a %s. We are very responsive and strive to do our best to help you.', 'banner-management-for-woocommerce'),
							    '<a href="' . esc_url('https://docs.thedotstore.com/collection/252-banner-management') . '" target="_blank">' . esc_html__('knowledge base', 'banner-management-for-woocommerce') . '</a>',
							    '<a href="' . esc_url('https://www.thedotstore.com/support-ticket/') . '" target="_blank">' . esc_html__('support ticket', 'banner-management-for-woocommerce') . '</a>',
							);

						?>
						</p>
					</div>
				</div>
				<div class="upgrade-faqs-list">
					<div class="upgrade-faqs-header">
						<h3><?php esc_html_e( 'What payment methods do you accept?', 'banner-management-for-woocommerce' ); ?></h3>
					</div>
					<div class="upgrade-faqs-body">
						<p><?php esc_html_e( 'You can pay with your credit card using Stripe checkout. Or your PayPal account.', 'banner-management-for-woocommerce' ); ?></p>
					</div>
				</div>
				<div class="upgrade-faqs-list">
					<div class="upgrade-faqs-header">
						<h3><?php esc_html_e( 'What’s your refund policy?', 'banner-management-for-woocommerce' ); ?></h3>
					</div>
					<div class="upgrade-faqs-body">
						<p><?php esc_html_e( 'We have a 14-day money-back guarantee.', 'banner-management-for-woocommerce' ); ?></p>
					</div>
				</div>
				<div class="upgrade-faqs-list">
					<div class="upgrade-faqs-header">
						<h3><?php esc_html_e( 'I have more questions…', 'banner-management-for-woocommerce' ); ?></h3>
					</div>
					<div class="upgrade-faqs-body">
						<p>
						<?php 
							echo sprintf(
							    esc_html__('No problem, we’re happy to help! Please reach out at %s.', 'banner-management-for-woocommerce'),
							    '<a href="' . esc_url('mailto:hello@thedotstore.com') . '" target="_blank">' . esc_html('hello@thedotstore.com') . '</a>',
							);

						?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="upgrade-to-premium-btn">
			<a href="javascript:void(0);" target="_blank" class="upgrade-now"><?php esc_html_e( 'Get The Premium Version', 'banner-management-for-woocommerce' ); ?><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-crown fa-w-20 fa-3x" width="22" height="20"><path fill="#000" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z" class=""></path></svg></a>
		</div>
	</div>
</div>
</div>
</div>
</div>
<?php 
