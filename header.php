<?php
	/**
	 * The header for our theme.
	 *
	 * Displays all of the <head> section and everything up till <div id="content">
	 *
	 * @package storefront
	 */
	?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php storefront_html_tag_schema(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( $class ); ?>>
		<div class="u-none">
			<svg xmlns="http://www.w3.org/2000/svg">
				<symbol viewBox="5.1 -5 14.7 25" id="icon-arrow-left">
					<title>arrow-left</title>
					<path d="M5.1 7.4v.1l12.6 12.5 1.2-1.2-11.5-11.3 11.5-11.4-1.2-1.1z"/>
				</symbol>
				<symbol viewBox="5.1 -5 14.7 25" id="icon-arrow-right">
					<title>arrow-right</title>
					<path d="M18.9 7.6v-.1l-12.6-12.5-1.2 1.2 11.5 11.3-11.5 11.4 1.2 1.1z"/>
				</symbol>
				<symbol viewBox="0.6 -0.7 8.9 9.5" id="icon-close">
					<title>close</title>
					<path d="M9.4 8.1l-3.7-4.1 3.7-4-.7-.7-3.7 4-3.7-4-.7.7 3.7 4-3.7 4.1.7.7 3.7-4 3.7 4z"/>
				</symbol>
				<symbol viewBox="0 0 8 7" id="icon-qty-down">
					<title>qty-down</title>
					<path d="M0 0h8l-4 7z"/>
				</symbol>
				<symbol viewBox="0 0 8 7" id="icon-qty-up">
					<title>qty-up</title>
					<path d="M8 7h-8l4-7z"/>
				</symbol>
				<symbol viewBox="0 4.1 70 46.5" id="icon-scroll-down-arrow">
					<title>scroll-down-arrow</title>
					<path d="M60 15.4l-1.5-1.3-23.5 23.8-23.7-23.8-1.3 1.3 24.8 25.2z"/>
				</symbol>
				<symbol viewBox="50.2 105.1 411.7 301.8" id="icon-shopping-cart">
					<title>shopping-cart</title>
					<path d="M346.9 143.6h-296.7l53.6 121.2h205.1l38-121.2zm114.9-38.5l-12.7 40h-30l-59.2 188.2h-227l-17.6-40h215.4l59.2-188.2h71.9zm-145 274.9c0 14.9-12 26.9-26.9 26.9s-26.9-12-26.9-26.9 12-26.9 26.9-26.9 26.9 12 26.9 26.9zm-88.9 0c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9s12-26.9 26.9-26.9c14.9 0 26.9 12 26.9 26.9z"/>
				</symbol>
			</svg>
		</div>
		<div class="loader page-loader">
			<div class="loader-dot"></div>
		</div>
		<div class="menu-toggle fade-on-load"> <span class="hamburger-bar"></span> <span class="hamburger-bar"></span> <span class="hamburger-bar"></span> </div>
		<aside class="sidebar sidebar-menu">
			<div class="sidebar-inner">
				<nav class="nav-primary">
					<ul class="nav-menu">
						<?php
							$args = array(
							        'theme_location'	=>	'primary',
							        'container'	=>	false,
							        'items_wrap'      => '%3$s',
							    );
							    wp_nav_menu($args);
							?>
					</ul>
				</nav>
				<div class="sidebar-bottom">
					<div class="contact-details">
						<a href="tel:+16465279732" class="phone">+1 (646) 527 9732 </a><br/>
						<a href="mailto:info@m-material.com">info@m-material.com</a>
						<div class="social"> <a href="http://www.facebook.com/APPARATUSSTUDIO" target="_blank">Facebook</a> <a href="http://instagram.com/APPARATUSSTUDIO" target="_blank">Instagram</a> </div>
					</div>
					<div class="subscribe">
						<form class="subscribe-form" action="https://collapsible.createsend.com/t/r/s/jhttdji/" method="post" id="subForm">
							<label for="cm-jhttdji-jhttdji">Subscribe</label>
							<div class="field-wrap">
								<input type="email" placeholder="EMAIL ADDRESS" required name="cm-jhttdji-jhttdji" id="jhttdji-jhttdji">
								<button type="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</aside>
		<aside class="sidebar sidebar-secondary sidebar-contact">
			<div class="sidebar-scroller">
				<div class="sidebar-inner">
					<h2>Contact</h2>
					<a class="button-solid" href="/studio/">Visit the studio</a>
					<h3>M Materials</h3>
					<p>46-55 Metropolitan Avenue<br/>
						Suite 102<br/>
						Flushing NY 11385<br/>
						(By Appointment Only)
					</p>
					<h3>General Enquiries</h3>
					<p>
					<p><a href="mailto:info@m-material.comm">info@m-material.com</a></p>
					</p>
				</div>
			</div>
		</aside>
		<div class="overlay"></div>
		<div class="l-page-wrap">
		<?php
			if ( is_home() || is_front_page() || is_page_template('front-page.php') ) {
					$slide_items = get_field('main_images');
			
			
					$slide_images = array();
					if ( is_array($slide_items) && count($slide_items) > 0 ){
						foreach($slide_items as $image){
							$slide_images[] = $image['url'];
						}
					}
			?>
		<div class="hero hero-home hero-static" data-img-src="<?php echo implode(',',$slide_images); ?>">
			<div class="inner">
				<div class="site-title"><img src="<?php echo get_stylesheet_directory_uri() .'/images/logo-home-new.svg'; ?>" alt="<?php bloginfo( 'name' );?>" data-src="<?php echo get_stylesheet_directory_uri() .'/images/logo.svg'; ?>"></div>
			</div>
		</div>
		<div class="l-content-wrap fade-on-load">
		<?php }
			else if (is_page_template('archive-press.php') )  
			
				{ ?>
		<div class="logo fade-in" style="display:none;"> <a href="<?php bloginfo('url'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo get_stylesheet_directory_uri() .'/images/logo.png'; ?>"></a> </div>
		<div class="fade-wrapper fade-in">
		<?php }
			else if (is_tax())  
			
				{ ?>
		<div class="logo fade-in" style="display:none;"> <a href="<?php bloginfo('url'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo get_stylesheet_directory_uri() .'/images/logo.png'; ?>"></a> </div>
		<div class="fade-on-load">
		<?php }
			else if (is_single())  
			
				{
				
		?>
		<div class="hero hero-static" data-img-src="<?php the_field('hero_image'); ?>">
			<div class="inner">
				<div class="hero-title">
					<h1>
						<?php the_title(); ?>
					</h1>
				</div>
			</div>
		</div>
		<div class="logo logo-overlay fade-on-load" style="display:none;"> <a href="<?php bloginfo('url'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo get_stylesheet_directory_uri() .'/images/logo.png'; ?>"></a> </div>
		<div class="l-content-wrap fade-on-load">
		<?php }
			else  
			
				{ ?>
		<div class="logo fade-in" style="display:none;"> <a href="<?php bloginfo('url'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo get_stylesheet_directory_uri() .'/images/logo.png'; ?>"></a> </div>
		<div class="l-content-wrap fade-on-load">
		<?php } ?>