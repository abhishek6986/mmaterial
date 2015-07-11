<?php
/*
Template Name: Default ( Child Theme Template ) 
*/
get_header(); ?>



<div class="l-content full-w">
<?php while ( have_posts() ) : the_post(); ?>

            <div class="content-module">
            <h2><?php the_title(); ?></h2> <div class="page-intro u-justify"><?php the_content(); ?></div>
            </div>

			<div class="item full-w slide-in">
                
                	<?php if ( has_post_thumbnail() ) {	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); } ?>
                    <img alt="" src="<?php echo $image_url[0]; ?>">
                    
               
			</div>        

<?php endwhile; ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>

