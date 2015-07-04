<?php
/*
Template Name: Default ( Child Theme Template ) 
*/
get_header(); ?>
<div class="l-content">
<div class="simple-page-content">
<?php while ( have_posts() ) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php endwhile; ?>
</div>
</div> 
<?php get_footer(); ?>
