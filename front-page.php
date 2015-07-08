<?php
/**
 * Customises the stock Storefront homepage template to include the sidebar and the material_before_homepage_content hook.
 *
 * Template Name: Homepage ( Child Theme Template )
 *
 * @package storefront
 */

get_header(); ?>


<a class="svg scroll-down-arrow">
    <svg>
        <use xlink:href="#icon-scroll-down-arrow"></use>
    </svg>
</a>
<div class="l-content med-full-w med-stretch home-flexible-content">
    <ul class="masonry-grid">
        <li class="grid-sizer"></li>

<?php
if( get_field('homepage_block_content') )
{
	while( has_sub_field("homepage_block_content") )
	{
		if( get_row_layout() == "category_block" ) // layout: Paragraph
		{
			$cat_ID = get_sub_field('product_category_block');
			
			$thumbnail_id = get_woocommerce_term_meta( $cat_ID, 'thumbnail_id', true ); 
			$image = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' ); 
			
			$get_category_object = get_term($cat_ID, 'product_cat');
			$name=$get_category_object->name;
			$term_link = get_term_link( $cat_ID, 'product_cat' );

			$description=$get_category_object->description;
			?>
			<li class="item half-w slide-in">
                <a href="<?php echo $term_link; ?>" class="grid-module">
                    <img alt="" src="<?php echo $image[0]; ?>">
                    <div class="img-tint hover-tint"></div>
                    <div class="text-overlay u-centered">
                        <h2><?php echo $name; ?></h2> <p><?php echo $description; ?></p>
                    </div>
                </a>
			</li>        
            <?php

		}
		elseif( get_row_layout() == "page_block" ) // layout: File
		{
			$page_object = get_sub_field('home_page_block');
			$post_thumbnail_id = get_post_thumbnail_id( $page_object->ID );
			$image = wp_get_attachment_image_src( $post_thumbnail_id );
			
			$block_background = get_sub_field('block_background');
			?>
			<li class="item half-w slide-in">
                <a href="<?php echo get_permalink( $page_object->ID ); ?>" class="grid-module <?php if (empty($image)) {  echo "solid"; } ?>" <?php if (!empty($block_background)) { echo 'style="background-color:'.$block_background.'"'; } ?>>
                    <?php if (!empty($image)) {  ?><img alt="" src="<?php echo $image[0]; ?>"> <?php } ?>
                    <div class="img-tint hover-tint"></div>
                    <div class="text-overlay u-centered">
                        <h2><?php echo $page_object->post_title; ?></h2> <p><?php echo ''; ?></p>
                    </div>
                </a>
			</li>        
			<?php
		}
	}
}
	
?>
	</ul>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
