<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package material
 */
?>

	</div>
	
	<footer class="l-footer footer fade-in">
<?php

if( get_field('footer_links', 'option') )
{
	while( has_sub_field("footer_links", 'option') )
	{
		if( get_row_layout() == "new_footer_link" ) // layout: Paragraph
		{
			$label = get_sub_field('footer_label', 'option');
			$link = get_sub_field('footer_link', 'option');
			$hide_on_phone = get_sub_field('footer_hide_on_phone', 'option');
			
			if (($hide_on_phone) == "No" ) {
				echo '<a href="'.$link.'" target="_blank">'.$label.'</a>';
			}
			else
			{
				echo '<a href="'.$link.'" target="_blank" class="hidden-phone">'.$label.'</a>';
			}
		}
	}
}
		
?>
<a href="#" class="back-to-top">Back to top</a>

	</footer><!-- #colophon -->
</div>
<?php wp_footer(); ?>

</body>
</html>



