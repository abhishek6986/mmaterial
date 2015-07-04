<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>



		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>


		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>








<ul class="category-thumbs">

<?php

    $taxonomyName = "product_cat";
    $prod_categories = get_terms($taxonomyName, array(
            'orderby'=> 'name',
            'order' => 'ASC',
            'hide_empty' => 1

    ));  

    foreach( $prod_categories as $prod_cat ) :
    if ( $prod_cat->parent == 0 )
    continue;
            $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            $cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
            $term_link = get_term_link( $prod_cat, 'product_cat' );
    ?>

                <li>    

                    <a href="<?php echo $term_link; ?>" title="<?php echo $prod_cat->name; ?>">


                        <div style="max-height:540px;display:block; background-image:url(<?php echo $cat_thumb_url; ?>); background-repeat:no-repeat; background-size:100% auto; background-position:center center;"><img alt="" src="<?php bloginfo('stylesheet_directory'); ?>/images/transparent-resizer.png" /> </div>
                        <div class="img-tint"></div>
                        <div class="text-overlay u-centered">

                        <h2><?php echo $prod_cat->name; ?></h2>

						</div>
                    </a>


                </li>

      <?php endforeach; wp_reset_query(); ?>
</ul>



<?php get_footer( 'shop' ); ?>
