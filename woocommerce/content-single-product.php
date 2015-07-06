<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="l-content full-w">
	<div class="row content-module sm-full-w">
		<div class="col-6">
			<h2><?php the_title(); ?></h2>
			<p class="page-intro u-justify"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></p>
		</div>
	</div>
	<div class="row content-module sm-full-w product-nav">
		<div class="col-3 sm-full-w">
			<a href="#product-info" class="button-solid u-full-w"><span>Product </span>Information</a>
		</div>
		<div class="col-3 sm-full-w">
			<a href="<?php get_field('tear_sheet'); ?>" class="button-solid u-full-w">Tearsheets</a>
		</div>
	</div>
	<div class="content-module med-full-w med-stretch">
		<ul class="masonry-grid">
			<li class="grid-sizer"></li>
			<?php
	            $counting = count(get_field('product_variation_image'));
				if ( ($counting % 2 )== 0 ) { $define_width = "half-w"; } else { $define_width = "full-w"; }
	            
			if (get_field('product_variation_image')) {
				while( has_sub_field("product_variation_image") ) {
					$variation_img = get_sub_field('variation_image'); 
					$variation_info = get_sub_field('variation_short_info');  ?>
			<li class="item slide-in <?php echo $define_width; ?> expander">
				<div class="grid-module">
					<!--<img src="<?php echo $variation_img; ?>" width="870" alt="">-->
                    <?php echo wp_get_attachment_image( $variation_img, 'thumbnail' ); ?>
					<div class="img-tint hover-tint"></div>
					<div class="more"></div>
					<div class="more"></div>
					<div class="text-overlay">
						<h2><?php echo $variation_info; ?></h2>
					</div>
				</div>
			</li>
            <?php }
			
			} ?>
		</ul>
	</div>
	<div class="parallax-strip" style="background-image:url('<?php the_field('parallex_background_image'); ?>');"></div>
	<div class="row content-module med-full-w med-stretch product-info-wrap">
		<div class="col-6">
			<div class="product-info">
				<div class="product-info-module">
					<h2><?php the_title(); ?></h2>
					<h3>Dimensions</h3>
					<p><?php echo $product->get_dimensions(); ?></p>
					<h3>Price</h3>
					<p>$<?php echo $product->get_price(); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="content-module med-full-w">
		<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
