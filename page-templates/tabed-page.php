<?php 
/**
 * Template Name: Tabed Page
 *
 * 
 */
get_header(); 


	

	$current_page_id = $post->ID;
	$sub_pages = get_post_meta($current_page_id,'_karait_group_sub_pages');
	
	
			
?>
	
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
										<?php if( get_post_meta(get_the_ID(),'_karait_title_button',1 ) !== 'no'){ 
												$button_name = get_post_meta(get_the_ID(),'_karait_button_name',1 );
												$button_url = get_post_meta(get_the_ID(),'_karait_button_url',1 );	
												echo '<a class="title-button" href="'.$button_url.'">'.$button_name.'</a>';
											}
										?>
									</header>
								<?php } ?>
								<main class="article-body">
									<?php the_content(); ?>
									<div id="subpage-tabs" class="subpage-tabs">
										<ul>
											<?php foreach($sub_pages[0] as $sub_page){ 
												echo'<li><a class="subpage-link" href="#sub-'.$sub_page['sub_id'].'"><div><span class="subpage-icon-wrapper"><img class="subpage-icon" src="'.$sub_page['image'].'" /></span><span class="subpage-name">'.$sub_page['list_name'].'</span></div></a></li>';
											} ?>
										</ul>
										<?php 
											
											foreach($sub_pages[0] as $sub_page){
												if($sub_page['sub_id']){
													$content_post = get_post($sub_page['sub_id']);
													$content = $content_post->post_content;
													$content = apply_filters('the_content', $content);
													$content = str_replace(']]>', ']]&gt;', $content);
													echo '<div id="sub-'.$sub_page['sub_id'].'" class="subpage-content">'.$content.'</div>';
												} 
											} 

										?>
									</div>
								</main>
							</article>
							
											
						</div><!-- primary -->

					</section>
				</div>
			<?php } ?>
		<?php } ?>
				
	</main>

	

<?php get_footer(); ?>