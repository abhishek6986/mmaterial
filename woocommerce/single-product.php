<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>


<?php

ob_start();
?>
<div id="mmaterial_pdf" class="<?php the_title(); ?>">
<div id="page1">
<table width="595px" height="842px">
<tbody>
<tr>
<td style="height:100%; vertical-align:central; text-align:center;"><img width="500px" alt="MMATERIAL" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg"></td>
</tr>
</tbody>
</table>
</div>

<div id="page2">
<?php
$counting = count(get_field('product_variation_image'));
if ( ($counting % 2 )== 0 ) {  

		$image_size = "thumbnail"; 
		if (get_field('product_variation_image')) {
			$x=1;
			while( has_sub_field("product_variation_image") ) {
				$variation_img = get_sub_field('variation_image'); 
				$variation_info = get_sub_field('variation_short_info');  
				$image[$x] = wp_get_attachment_image( $variation_img,  array(150,150) );
				$x=$x+1;
			}
			
		} ?>
    
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td rowspan="2" scope="col" width="400px"><img width="400" src="<?php the_field('hero_image'); ?>" alt="" /></td>
              <td scope="col" width="150px"><?php echo $image[1]; ?></td>
            </tr>
            <tr>
              <td width="150px"><?php echo $image[2]; ?></td>
            </tr>
          </tbody>
        </table>
<?php
} 
else { 
		$image_size = "shop_catalog"; 
		$variation_img = get_sub_field('variation_image'); 
		$variation_info = get_sub_field('variation_short_info');		
		$image = wp_get_attachment_image( $variation_img_2,  array(150,150) );		
		?>
        
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td width="550px"><img width="550" src="<?php the_field('hero_image'); ?>" alt="" /></td>
            </tr>
            <tr>
              <td width="550px"><?php echo $image; ?></td>
            </tr>
          </tbody>
        </table>
<?php		
} ?>
	

</div>

<div id="page3">
<table width="595px" height="842px">
<tbody>
<tr>
<td style="height:100%; vertical-align:bottom; text-align:center;">
<h2>M Materials</h2>
<p>46-55 Metropolitan Avenue<br/>
Suite 102<br/>
Flushing NY 11385<br/>
(By Appointment Only)</p>
<br/>
<p>General Enquiries<br/><br/></p>
<a hre="mailto:info@m-material.com" >info@m-material.com</a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<?php

$content_new_all =  ob_get_contents();

ob_end_clean();

$build_html = get_stylesheet_directory().'/tearsheets/'.get_the_ID().'.html';


file_put_contents( $build_html , $content_new_all );

tearsheet($build_html);

?>


<?php get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>


		<?php while ( have_posts() ) : the_post(); ?>




			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
