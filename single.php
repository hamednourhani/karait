<?php get_header(); ?>
	
	<main class="site-main">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()) { the_post(); ?>

				<div class="banner-wrapper">
					
							<?php get_template_part('library/banner','maker'); ?>
						
				</div><!-- banner-wrapper -->
				
				<div class="site-content">
					<section class="layout">
						
						<div class="primary">
							
								
							<article class="hentry">
								<header class="article-title blog">
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
									</a>
									<div class="post-date">
										<span><?php echo __(' Posted On ','karait');?></span><span class="orang-meta"><?php the_time(__('d M Y', 'karait')).' - '; ?></span>
										<span><?php echo __(' Updated On ','karait');?></span><span class="orang-meta"><?php the_modified_time('d M Y', 'karait').' - ';?></span>
										<span><?php echo __(' By ','karait');?></span><span class="orang-meta"><?php the_author() ?></span>
									</div>
									
								</header>
								<main class="article-body">
									<div class="featured-image single-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>

									<?php the_content(); ?>
									<?php get_template_part('library/post','meta'); ?>
									
									<ul>
										<li><?php previous_post_link('%link')?></li>
										<li><?php next_post_link('%link') ?></li>
									</ul>
									
									<!-- comments template -->
									
										<div class="comment-area">
											<?php comments_template(); ?>	
										</div>
									
								</main>
							</article>
											
						</div><!-- primary -->

						<div class="secondary">
							<?php get_sidebar(); ?>
						</div><!-- secondary -->
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