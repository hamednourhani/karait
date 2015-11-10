<?php get_header(); ?>
	
	<main class="site-main">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()) { the_post(); ?>

				<div class="banner-wrapper">
					
							<?php get_template_part('library/banner','maker'); ?>
						
				</div><!-- banner-wrapper -->
				
				<div class="site-content without-sidebar">
					<section class="layout">
						
						<div class="primary">
							
								<article class="hentry">
									<?php if( get_post_meta(get_the_ID(),'_karait_title',1 ) !== 'no'){ ?>	
								
										<header class="article-title">
											<a href="<?php the_permalink(); ?>">
												<h3><?php the_title(); ?></h3>
											</a>
											<?php if( get_post_meta(get_the_ID(),'_karait_title_button',1 ) == 'no'){ 
														$button_name = get_post_meta(get_the_ID(),'_karait_button_name',1 );
														$button_url = get_post_meta(get_the_ID(),'_karait_button_url',1 );	
														echo '<a class="title-button" href="'.$button_url.'">'.$button_name.'</a>';
													}
												?>
										</header>
									<?php } ?>
									<main class="article-body">
										<?php the_content(); ?>
										
									</main>
								</article>
							
											
						</div><!-- primary -->

					</section>
				</div>
			<?php } ?>

		<?php } else { ?>	
			
			<div class="site-content">
				<section class="layout">
					<div class="secondary">
						<?php get_sidebar(); ?>
					</div><!-- secondary -->
				</section>
			</div>

		<?php } ?>
		
	</main>

<?php get_footer(); ?>