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


// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 50;' ), 20 );



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
add_filter('acf/update_value/name=catalog_image', 'acf_set_featured_image', 10, 3);
 

	
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



if ( ! function_exists('register_material_posttype') ) {

// registration code for material post type
	function register_material_posttype() {
		$labels = array(
			'name' 				=> _x( 'Materials', 'post type general name' ),
			'singular_name'		=> _x( 'Material', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Material' ),
			'edit_item' 		=> __( 'Edit Material' ),
			'new_item' 			=> __( 'New Material' ),
			'view_item' 		=> __( 'View Material' ),
			'search_items' 		=> __( 'Search Materials' ),
			'not_found' 		=> __( 'No Materials found' ),
			'not_found_in_trash'=> __( 'No Materials found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Materials' )
		);
		
		$taxonomies = array();

		$supports = array('title','thumbnail','excerpt','page-attributes');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Material'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> true,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> true,
			'rewrite' 			=> array('slug' => 'materials', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-tagcloud',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('material',$post_type_args);
	}
	add_action('init', 'register_material_posttype');
	
}



// registration code for press post type
if ( ! function_exists( 'register_press_posttype' ) ) {
	
	function register_press_posttype() {
		$labels = array(
			'name' 				=> _x( 'Press', 'post type general name' ),
			'singular_name'		=> _x( 'Press', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Press' ),
			'edit_item' 		=> __( 'Edit Press' ),
			'new_item' 			=> __( 'New Press' ),
			'view_item' 		=> __( 'View Press' ),
			'search_items' 		=> __( 'Search Press' ),
			'not_found' 		=> __( 'No Press found' ),
			'not_found_in_trash'=> __( 'No Press found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Press' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Press'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'press', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-images-alt2',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('press',$post_type_args);
	}
	add_action('init', 'register_press_posttype');

}
	

// registration code for material_category taxonomy
if ( ! function_exists( 'register_material_category_tax' ) ) {
	
		function register_material_category_tax() {
			$labels = array(
				'name' 					=> _x( 'Material Categories', 'taxonomy general name' ),
				'singular_name' 		=> _x( 'Material Category', 'taxonomy singular name' ),
				'add_new' 				=> _x( 'Add New Material Category', 'Material Category'),
				'add_new_item' 			=> __( 'Add New Material Category' ),
				'edit_item' 			=> __( 'Edit Material Category' ),
				'new_item' 				=> __( 'New Material Category' ),
				'view_item' 			=> __( 'View Material Category' ),
				'search_items' 			=> __( 'Search Material Categories' ),
				'not_found' 			=> __( 'No Material Category found' ),
				'not_found_in_trash' 	=> __( 'No Material Category found in Trash' ),
			);
			
			$pages = array('material');
			
			$args = array(
				'labels' 			=> $labels,
				'singular_label' 	=> __('Material Category'),
				'public' 			=> true,
				'show_ui' 			=> true,
				'hierarchical' 		=> false,
				'show_tagcloud' 	=> false,
				'show_in_nav_menus' => true,
				'rewrite' 			=> array('slug' => 'material_category', 'with_front' => false ),
			 );
			register_taxonomy('material_category', $pages, $args);
		}
		add_action('init', 'register_material_category_tax');

}


// ui scripts for ecpt
if ( ! function_exists( 'ecpt_export_ui_scripts' ) ) {
	
function ecpt_export_ui_scripts() {

	global $ecpt_options, $post;
	?>
	<script type="text/javascript">
			jQuery(document).ready(function($)
			{

				if($('.form-table .ecpt_upload_field').length > 0 ) {
					// Media Uploader
					window.formfield = '';

					$('body').on('click', '.ecpt_upload_image_button', function() {
					window.formfield = $('.ecpt_upload_field',$(this).parent());
						tb_show('', 'media-upload.php?type=file&post_id=<?php echo $post->ID; ?>&TB_iframe=true');
										return false;
						});

						window.original_send_to_editor = window.send_to_editor;
						window.send_to_editor = function(html) {
							if (window.formfield) {
								imgurl = $('a','<div>'+html+'</div>').attr('href');
								window.formfield.val(imgurl);
								tb_remove();
							}
							else {
								window.original_send_to_editor(html);
							}
							window.formfield = '';
							window.imagefield = false;
						}
				}
				if($('.form-table .ecpt-slider').length > 0 ) {
					$('.ecpt-slider').each(function(){
						var $this = $(this);
						var id = $this.attr('rel');
						var val = $('#' + id).val();
						var max = $('#' + id).attr('rel');
						max = parseInt(max);
						//var step = $('#' + id).closest('input').attr('rel');
						$this.slider({
							value: val,
							max: max,
							step: 1,
							slide: function(event, ui) {
								$('#' + id).val(ui.value);
							}
						});
					});
				}

				if($('.form-table .ecpt_datepicker').length > 0 ) {
					var dateFormat = 'mm/dd/yy';
					$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
				}

				// add new repeatable field
				$(".ecpt_add_new_field").on('click', function() {
					var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
					// set the new field val to blank
					$('input', field).val("");
					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// add new repeatable upload field
				$(".ecpt_add_new_upload_field").on('click', function() {
					var container = $(this).closest('tr');
					var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
					// set the new field val to blank
					$('input[type="text"]', field).val("");

					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// remove repeatable field
				$('.ecpt_remove_repeatable').on('click', function(e) {
					e.preventDefault();
					var field = $(this).parent();
					$('input', field).val("");
					field.remove();
					return false;
				});

			});
	  </script>
	<?php
}

function ecpt_export_datepicker_ui_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}
function ecpt_export_datepicker_ui_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
{
	add_action('admin_head', 'ecpt_export_ui_scripts');
}

// converts a time stamp to date string for meta fields
if(!function_exists('ecpt_timestamp_to_date')) {
	function ecpt_timestamp_to_date($date) {

		return date('m/d/Y', $date);
	}
}
if(!function_exists('ecpt_format_date')) {
	function ecpt_format_date($date) {

		$date = strtotime($date);

		return $date;
	}
}
}

// generating tearsheet

add_action( 'woocommerce_before_single_product', 'woocommerce_generate_pdf', 5 );

function woocommerce_generate_pdf() {
	if( is_product() ) {
		include("tearsheet.php");	
	}
}
