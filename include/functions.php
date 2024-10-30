<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add sub menu page to the woocommerce menu
add_action( 'admin_menu', 'wcatct_add_to_cart_text_settings_page_func' );
function wcatct_add_to_cart_text_settings_page_func() {
    add_submenu_page( 'woocommerce', esc_html__( 'Change Add to Cart Text', 'change-add-to-cart-all-text' ), esc_html__( 'Add to Cart Text Change', 'change-add-to-cart-all-text' ), 'manage_options', 'change-add-to-cart-all-text', 'wcatct_add_to_cart_text_settings_page_callback' );
}

add_action('admin_enqueue_scripts', 'wcatct_admin_enqueue_scripts');
function wcatct_admin_enqueue_scripts(){
  if ( isset( $_GET["page"] ) &&  $_GET["page"] == "change-add-to-cart-all-text" ){
    wp_enqueue_style('wcatct_admin_style', plugins_url('admin/css/style.css', dirname(__FILE__) ) );
	wp_enqueue_script( "woocatct-admin-script", plugins_url('admin/js/main.js', dirname(__FILE__) ), array("jquery"), '1.0.0', true );
  }
}

// Add settings page HTML
function wcatct_add_to_cart_text_settings_page_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
			<?php wp_nonce_field( 'update-options' ); ?>
			<div class="wcatct_dashboardWrapper">
				<div class="wcatct_form_group">
					<div class="wcatct_global_txt_outer_wrap">
						<div class="wcatct_field">
							<label for="wcatct_global_txt"><?php esc_html_e( 'Global' ); ?></label>
							<input type="text" id="wcatct_global_txt" name="wcatct_global_txt" value="<?php print esc_html(get_option( 'wcatct_global_txt' )); ?>" placeholder="<?php echo esc_html__( 'Add to Cart' ); ?>">
							<small>Archive and Single both places are replace from here.</small>
						</div>
					</div>
					<div class="wcatct_field">
						<label for="wcatct_global_txt_diff">
							<input type="checkbox" name="wcatct_global_txt_diff" id="wcatct_global_txt_diff" value="1" <?php checked( get_option( 'wcatct_global_txt_diff' ), 1 ); ?>>
							<span>Different text for Archive and Single page</span>
						</label>
					</div>
				</div>
				<div class="wcatct_diff_txt_archive_single">
					<div class="wcatct_row">
						<div class="wcatct_col-6">
							<div class="wcatct_archive_options">
								<div class="wcatct_archive_option_main">
									<div class="wcatct_field">
										<label for="wcatct_archive_txt"><?php esc_html_e( 'Archive' ); ?></label>
										<input type="text" id="wcatct_archive_txt" name="wcatct_archive_txt" value="<?php print esc_html(get_option( 'wcatct_archive_txt' )); ?>" placeholder="<?php esc_html_e( 'Add to Cart' ); ?>">
										<small>All Archive products</small>
									</div>
								</div>
								<div class="wcatct_field">
									<label for="wcatct_product_type_txt_diff_archive">
										<input type="checkbox" name="wcatct_product_type_txt_diff_archive" id="wcatct_product_type_txt_diff_archive" value="1" <?php checked( get_option( 'wcatct_product_type_txt_diff_archive' ), 1 ); ?>>
										<span>Different Text for Different product types Archive</span>
									</label>
								</div>
								<?php 
								$product_types = wc_get_product_types();
								$page_options = '';
								if($product_types){?>
								<div class="wcatct_product_type_items_archive">
									<div class="wcatct_row">
										<?php 
										foreach( $product_types as $key => $value ){
											$keyOption = 'wcatct_archive_'.$key.'_txt';
											$page_options .= $keyOption.', ';
											if($key == 'external'){ ?>
												<div class="wcatct_col-6">
													<div class="wcatct_field">
														<label for="<?php echo esc_attr($keyOption); ?>"><?php print esc_html( $value ); ?></label>
														<input type="text" id="<?php echo esc_attr($keyOption); ?>" name="<?php echo esc_attr($keyOption); ?>" value="<?php print esc_html(get_option( $keyOption )); ?>">
														<small>if keep Empty, Text come form "Button text" Field</small>
													</div>
												</div>
												<?php 
												}else{?>
												<div class="wcatct_col-6">
													<div class="wcatct_field">
														<label for="<?php echo esc_attr($keyOption); ?>"><?php print esc_html( $value ); ?></label>
														<input type="text" id="<?php echo esc_attr($keyOption); ?>" name="<?php echo esc_attr($keyOption); ?>" value="<?php print esc_html(get_option( $keyOption )); ?>" placeholder="<?php echo esc_html__( 'Add to Cart' ); ?>">
													</div>
												</div>
											<?php
											}
										}?>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="wcatct_col-6">
							<div class="wcatct_single_options">
								<div class="wcatct_single_options_main">
									<div class="wcatct_field">
										<label for="wcatct_single_txt"><?php echo esc_html__( 'Single' ); ?></label>
										<input type="hidden" name="page_options" value="wcatct_single_txt">
										<input type="text" id="wcatct_single_txt" name="wcatct_single_txt" value="<?php print esc_html(get_option( 'wcatct_single_txt' )); ?>" placeholder="<?php echo esc_html__( 'Add to Cart' ); ?>">
										<small>All Single products</small>
									</div>
								</div>								
								<div class="wcatct_field">
									<label for="wcatct_product_type_txt_diff_single">
										<input type="checkbox" name="wcatct_product_type_txt_diff_single" id="wcatct_product_type_txt_diff_single" value="1" <?php checked( get_option( 'wcatct_product_type_txt_diff_single' ), 1 ); ?>>
										<span>Different Text for Different product types Single Page</span>
									</label>
								</div>
								<?php
								if($product_types){?>
								<div class="wcatct_product_type_items_single">
									<div class="wcatct_row">
										<?php foreach( $product_types as $key => $value ){
											$keyOption = 'wcatct_single_'.$key.'_txt';
											$page_options .= $keyOption.', ';
											if($key == 'external'){ ?>
											<div class="wcatct_col-6">
												<div class="wcatct_field">
													<label for="<?php echo esc_attr($keyOption); ?>"><?php print esc_html( $value ); ?></label>
													<input type="hidden" name="page_options" value="<?php echo esc_html($keyOption); ?>">
													<input type="text" id="<?php echo esc_attr($keyOption); ?>" name="<?php echo esc_attr($keyOption); ?>" value="<?php print esc_html(get_option( $keyOption )); ?>">
													<small>if keep Empty, Text come form "Button text" Field</small>
												</div>
											</div>
											<?php
											}else{?>
											<div class="wcatct_col-6">
												<div class="wcatct_field">
													<label for="<?php echo esc_attr($keyOption); ?>"><?php print esc_html( $value ); ?></label>
													<input type="hidden" name="page_options" value="<?php echo esc_attr($keyOption); ?>">
													<input type="text" id="<?php echo esc_attr($keyOption); ?>" name="<?php echo esc_attr($keyOption); ?>" value="<?php print esc_html(get_option( $keyOption )); ?>" placeholder="<?php echo esc_html__( 'Add to Cart' ); ?>">
												</div>
											</div>
											<?php
											}
										}?>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="wcatct_submit_btn">
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="page_options" value="<?php echo esc_attr($page_options); ?> wcatct_global_txt, wcatct_archive_txt, wcatct_single_txt, wcatct_global_txt_diff, wcatct_product_type_txt_diff_archive, wcatct_product_type_txt_diff_single">
					<input type="submit" value="Save Settings">
				</div>
			</div>
        </form>
    </div>
    <?php
}

 
function wcatct_add_to_cart_button_text_archives_func( $add_to_cart_text, $product ) {
	if( get_option( 'wcatct_global_txt_diff' ) ){
		if( get_option( 'wcatct_product_type_txt_diff_archive' ) ){
			$product_type = $product->get_type();
			if( 1 || $product_type != 'external' ){
				$keyOption = 'wcatct_archive_'.$product_type.'_txt';
				$cartText = get_option( $keyOption );
				if ( !$cartText ){
					$cartText = $add_to_cart_text;
				}
				return esc_html( $cartText, 'change-add-to-cart-all-text' );
			}
		}else{
			$cartText = get_option( 'wcatct_archive_txt' );
			if( !$cartText ){
				$cartText = $add_to_cart_text;
			}
			return esc_html( $cartText, 'change-add-to-cart-all-text' );
		}
	}else{
		$cartText = get_option( 'wcatct_global_txt' );
		if( !$cartText ){
			$cartText = $add_to_cart_text;
		}
		return esc_html( $cartText, 'change-add-to-cart-all-text' );
	}
}
add_filter( 'woocommerce_product_add_to_cart_text', 'wcatct_add_to_cart_button_text_archives_func', 10, 2); 


function wcatct_add_to_cart_button_text_single_func( $add_to_cart_text, $product ) {
	if( get_option( 'wcatct_global_txt_diff' ) ){
		if( get_option( 'wcatct_product_type_txt_diff_single' ) ){
			$product_type = $product->get_type();
			if( 1 || $product_type != 'external' ){
				$keyOption = 'wcatct_single_'.$product_type.'_txt';
				$cartText = get_option( $keyOption );
				if ( !$cartText ){
					$cartText = $add_to_cart_text;
				}
				return esc_html( $cartText, 'change-add-to-cart-all-text' );
			}
		}else{
			$cartText = get_option( 'wcatct_single_txt' );
			if( !$cartText ){
				$cartText = $add_to_cart_text;
			}
			return esc_html( $cartText, 'change-add-to-cart-all-text' );
		}
	}else{
		$cartText = get_option( 'wcatct_global_txt' );
		if( !$cartText ){
			$cartText = $add_to_cart_text;
		}
		return esc_html( $cartText, 'change-add-to-cart-all-text' );
	}
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'wcatct_add_to_cart_button_text_single_func', 10, 2);