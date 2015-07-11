<?php
get_header(); ?>



<div class="l-content med-full-w med-stretch home-flexible-content">
    <ul class="masonry-grid press-grid infinite-grid">
        <li class="grid-sizer"></li>
<?php 
    query_posts(array( 
        'post_type' => 'press',
        'post_per_page' => -1 
    ) );  
?>
<?php while ( have_posts() ) : the_post(); ?>

			<li class="item slide-in">
            <div class="press-item">

				<?php if ( get_field('press_link_to_article') ) { ?>
                    <a href="<?php the_field('press_link_to_article'); ?>" target="_blank" title="<?php the_title(); ?>">
                <?php } ?>
                    <h2><?php the_title(); ?></h2>
                    <div class="copy">
                        <div class="date"><?php the_field('press_published_on'); ?></div>
                        <p><?php the_field('press_excerpt'); ?></p>
                    </div>
                    <div class="img" style="padding-bottom: 100%">
                        <img src="<?php the_field('press_image'); ?>" alt="">
                        <div class="img-overlay"></div>
                    </div>
                <?php if ( get_field('press_link_to_article') ) { ?>
                    </a>
                <?php } ?>

            </div>
			</li>        

<?php endwhile; ?>
	</ul>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
