<?php
/*
Template Name: Default ( Child Theme Template ) 
*/
get_header(); ?>



<div class="l-content med-full-w med-stretch home-flexible-content">
<?php while ( have_posts() ) : the_post(); ?>

			<div class="item full-w slide-in">
                
                	<?php if ( has_post_thumbnail() ) {	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); } ?>
                    <img alt="" src="<?php echo $image_url[0]; ?>">
                    
                    <div>
                        <h2><?php the_title(); ?></h2>
                        <div class="clear"></div>
                        <p><?php the_content(); ?></p>
                    </div>
               
			</div>        

<?php endwhile; ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>

