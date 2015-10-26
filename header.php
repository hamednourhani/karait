<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8">

	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title(' : '); ?></title>

	<?php // mobile meta (hooray!) ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
        <meta name="theme-color" content="#121212">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>

	<?php // drop Google Analytics Here ?>
	<?php // end analytics ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	
	<div class="body-wrapper">
	<!-- ********************************************************************* -->
	<!--****************** Site header ***************************************-->
	<!-- ********************************************************************* -->

		<header class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			
			<div class="hero">
				<section class="layout">
					<div class="header-right-area">
						
						<div class="user-links">
							<?php echo '<a href="http://market.karait.com/clientarea.php "class="user-account-link">'.__('My Account','karait').'</a>'.__('OR','karait').'<a href="http://market.karait.com/register.php" class="user-register-link">'.__('Create Acount','karait').'</a>'; ?>
						</div>
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'Top Menu', 'karait' ),  // nav name
    					         'menu_class' => 'nav top-nav cf', 
    					         // 'walker' => $walker,             // adding custom nav class
    					         'theme_location' => 'top-menu',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 3,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</div>
					<div class="logo-wrapper">
						<!-- menu-toggler -->
						<a id="menu-toggler" class="menu-toggler" >
							<i class="fa fa-navicon"></i>
						</a>

						<a href="<?php echo get_bloginfo('url'); ?>">
							<img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>"/>
						</a>
					</div>
					<div class="header-left-area">
						<div class="contact-info-links"><span>(+98)23087</span><a class="contact-button"><?php echo __('Contact Us','karait');?></a></div>
						<span class="livezilla-links"><a href=""><img src="<?php echo get_template_directory_uri().'/images/image.png';?>" /></a></span>
					</div>
					
				</section>
			

				<nav role="navigation" class="main-menu" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
					<section class="layout">
						
						<div id="responsive-menu" class="responsive-menu">
							<a id="close-responsive" class="close-responsive">
								<i class="fa fa-close"></i>
							</a>

							
							<?php wp_nav_menu(array(
				    					         'container' => false,                           // remove nav container
				    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				    					         'menu' => __( 'The Main Menu', 'karait' ),  // nav name
				    					         'menu_class' => 'nav responsive-nav cf',               // adding custom nav class
				    					         'theme_location' => 'responsive-nav',                 // where it's located in the theme
				    					         'before' => '',                                 // before the menu
				        			               'after' => '',                                  // after the menu
				        			               'link_before' => '',                            // before each link
				        			               'link_after' => '',                             // after each link
				        			               'depth' => 3,                                   // limit the depth of the nav
				    					         'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>
						</div>

						
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'Main Menu', 'karait' ),  // nav name
    					         'menu_class' => 'nav main-nav cf', 
    					         // 'walker' => $walker,             // adding custom nav class
    					         'theme_location' => 'main-menu',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 3,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
						
						<div class="search-area">
							<?php get_search_form( true ); ?>
						</div>


					</section>
					
				</nav>
			</div>
		</header>	

<!-- ********************************************************************* -->
<!--****************** Site Main ******************************************-->
<!-- ********************************************************************* -->

