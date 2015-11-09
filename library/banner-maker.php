



<?php if(is_category() || is_tag() || is_tax()){ ?>
		
		<div class="single-cat-title">
			<section class="layout">
				<h1><?php single_cat_title('',true); ?></h1>
			</section>
		</div>
				
<?php } elseif(is_search()) { ?>
		<div class="single-cat-title">
			<section class="layout">
				<h1><?php printf( __( 'Search Results for: %s', 'karait' ), get_search_query() ); ?></h1>
			</section>
		</div>
<?php } elseif(is_singular()) {
		$banner_mod = get_post_meta(get_the_ID(),'_karait_banner_mod');
		
		switch ($banner_mod[0]) {
			case 'slider':
				$slider_shortcode = get_post_meta(get_the_ID(),'_karait_slider_shortcode');
				echo do_shortcode($slider_shortcode[0] );
				break;
			case 'image':
				$image = get_post_meta( get_the_ID(), '_karait_image' );
				echo '<div class="banner-inner"><img class="page-banner" src="'.$image[0].'"/></div>';
				break;
			default: 
				echo '<div class="banner-space"></div>';
				break;
		} ?>

		
<?php } else{ ?>
		<div class="banner-space">
		</div>
<?php  } ?>