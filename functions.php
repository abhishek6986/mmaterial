<?php
/**
 * Material
 *
 * @package storefront
 */

/**
 * Initialize all the things.
 */
 

add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );
 
function remove_parent_theme_features() {
	
//require get_stylesheet_directory() . '/inc/init.php';




remove_filter( 'body_class', 								'storefront_woocommerce_body_class', 10 );
remove_filter( 'woocommerce_product_thumbnails_columns', 	'storefront_thumbnail_columns', 10  );
remove_filter( 'woocommerce_output_related_products_args', 'storefront_related_products_args', 10 );
remove_filter( 'loop_shop_per_page', 						'storefront_products_per_page' , 10);
remove_filter( 'loop_shop_columns', 						'storefront_loop_columns', 10 );


remove_action( 'woocommerce_before_main_content', 		'storefront_before_content', 				10 );
remove_action( 'woocommerce_after_main_content', 		'storefront_after_content', 				10 );
remove_action( 'storefront_content_top', 				'storefront_shop_messages', 				1 );
remove_action( 'storefront_content_top', 				'woocommerce_breadcrumb', 					10 );

remove_action( 'woocommerce_after_shop_loop',			'storefront_sorting_wrapper',				9 );
remove_action( 'woocommerce_after_shop_loop', 			'woocommerce_catalog_ordering', 			10 );
remove_action( 'woocommerce_after_shop_loop', 			'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_after_shop_loop', 			'woocommerce_pagination', 					30 );
remove_action( 'woocommerce_after_shop_loop',			'storefront_sorting_wrapper_close',			31 );

remove_action( 'woocommerce_before_shop_loop',			'storefront_sorting_wrapper',				9 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			10 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop', 		'storefront_woocommerce_pagination', 		30 );
remove_action( 'woocommerce_before_shop_loop',			'storefront_sorting_wrapper_close',			31 );

remove_action( 'woocommerce_after_single_product_summary',			'woocommerce_output_product_data_tabs',			10 );
remove_action( 'woocommerce_after_single_product_summary',			'woocommerce_upsell_display',			15 );


add_action( 'wp_enqueue_scripts', 'mmaterial_scripts_and_styles', 999 );


}

function mmaterial_scripts_and_styles() {
	

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {
  		wp_dequeue_style('storefront-style');
		// register
		wp_register_style( 'mmaterial-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );

		wp_register_script( 'mmaterial-modernizr', get_stylesheet_directory_uri() . '/lib/js/modernizr.js', array(), '', false );
		wp_register_script( 'mmaterial-site', get_stylesheet_directory_uri() . '/lib/js/site.js', array( 'jquery' ), '', true );
		wp_register_script( 'mmaterial-plugin', get_stylesheet_directory_uri() . '/lib/js/plugin.js', array( 'jquery' ), '', true );
		
		// enqueue
		wp_enqueue_style( 'mmaterial-stylesheet' );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'mmaterial-modernizr' );
		wp_enqueue_script( 'mmaterial-plugin' );
		wp_enqueue_script( 'mmaterial-site' );

	}
}




function woocommerce_subcategory_thumbnail( $category ) {
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds
		// Ref: http://core.trac.wordpress.org/ticket/23605
		$image = str_replace( ' ', '%20', $image );

		echo '<img alt="' . esc_attr( $category->name ) . '" src="' . esc_url( $image ) . '" />';
	}
}


function remove_meta_box_gallery() {
	remove_meta_box( 'woocommerce-product-images', 'product', 'side' );
}
add_action('do_meta_boxes', 'remove_meta_box_gallery' );


 
function acf_set_featured_image( $value, $post_id, $field  ){
    
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=hero_image', 'acf_set_featured_image', 10, 3);
 

	
// add product category name to post class
function custom_class( $classes ) {
    global $post;
	$args = array( 'post_type'=> 'product' );
	$products = get_posts( $args );
	
    $i=1;
    if( $products ) foreach ( $products as $product ) {
       
		$classes[] = ' item';
    }
    return $classes;
}
add_filter( 'post_class', 'custom_class' );


// Adding Option Page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'MMaterial General Settings',
		'menu_title'	=> 'MMaterial',
		'menu_slug' 	=> 'm-material-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'MMaterial Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'm-material-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'MMaterial Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'm-material-general-settings',
	));
	
}