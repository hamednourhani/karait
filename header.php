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
					<div class="header-right-area ">
						
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

						<a class="logo-link" href="<?php echo get_bloginfo('url'); ?>">
							<img class="desktop-logo"src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>"/>
							<img class="mobile-logo"src="<?php echo get_template_directory_uri();?>/images/logomob.png" alt="<?php echo get_bloginfo('name'); ?>"/>
						</a>
					</div>
					<div class="header-left-area">
						<div class="contact-info-links"><span><?php echo '23087'.' 21 '.'(98+)';?></span><a href="http://www.karait.com/wp/?page_id=44" class="contact-button"><?php echo __('Contact Us','karait');?></a></div>
						<div class="livezilla-links">
							 <!-- LiveZilla Chat Button Link Code (ALWAYS PLACE IN BODY ELEMENT) -->
							 	<div class="livee" style="text-align:center;width:120px;">
							 		<a href="javascript:void(window.open('http://www.karait.com/livezilla/chat.php','','width=590,height=610,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))"><img src="http://www.karait.com/livezilla/image.php?id=04&amp;type=inlay" width="120" height="30" border="0" alt="LiveZilla Live Help"></a>
							 	</div><!-- http://www.LiveZilla.net Chat Button Link Code -->
							 	<!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) -->
							 	<div id="livezilla_tracking" style="display:none"></div>
							 	<script type="text/javascript">
									var script = document.createElement("script");script.type="text/javascript";var src = "http://www.karait.com/livezilla/server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)",1);
								</script>
								<noscript>
									<img src="http://www.karait.com/livezilla/server.php?request=track&amp;output=nojcrpt" width="0" height="0" style="visibility:hidden;" alt="">
								</noscript>
								<!-- http://www.LiveZilla.net Tracking Code -->
						</div>
					</div>
					
				</section>
			

				<nav role="navigation" id="main-menu" class="main-menu" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
					<section class="layout">
																	
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
											
					</section>
		
				</nav>
			</div>
		</header>	

<!-- ********************************************************************* -->
<!--****************** Site Main ******************************************-->
<!-- ********************************************************************* -->

