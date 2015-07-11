<?php
get_header(); ?>



<div class="l-content med-full-w med-stretch home-flexible-content">
    <ul class="masonry-grid">
        <li class="grid-sizer"></li>
<?php 
    query_posts(array( 
        'post_type' => 'material',
        'post_per_page' => -1 
    ) );  
?>
<?php while ( have_posts() ) : the_post(); ?>

			<li class="item half-w slide-in">
                <a href="<?php the_permalink(); ?>" class="grid-module">
                	<?php if ( has_post_thumbnail() ) {	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); } ?>
                    <img alt="" src="<?php echo $image_url[0]; ?>">
                    <div class="img-tint hover-tint-inverse"></div>
                    <div class="text-overlay u-centered">
                        <h2><?php the_title(); ?></h2> <p><?php the_excerpt(); ?></p>
                    </div>
                </a>
			</li>        

<?php endwhile; ?>
	</ul>
</div>
<div class="clear"></div>
<?php get_footer(); ?>

