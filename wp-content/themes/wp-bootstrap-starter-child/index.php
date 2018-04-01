<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

								<?php

								$args = array(
									'post_type'						=> 'post',
									'meta_key'						=> 'feature_order',
									'orderby'							=> 'meta_value',
									'order'								=> 'ASC',
									'posts_per_page'			=> '4',
									'ignore_sticky_posts' => '1'
								);
								global $post;
								$featured_posts = new WP_Query( $args );

								if ( $featured_posts->have_posts() ) {
									$postCount = 0;
									while ( $featured_posts->have_posts() ) {
										$postCount++;
										$featured_posts->the_post();

										if ( $postCount == 1 ) {
											// Get post featured image

											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
											<!-- FEATURED POST/IMG HERO -->
											<div class="container-fluid hero-posts align-items-center" style="background-image: url('<?php echo $image[0] ?>'); ">
												<div class="row align-items-center h-100 text-white gradient-overlay">
													<div class="col-lg-6 offset-lg-1 col-xs-12 primary-feature-post">
														<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
														<p><?php the_excerpt() ?></p>
													</div>
											<div class="col-lg-4 col-xs-12 secondary-feature-posts">
										<?php
										}
										else { ?>
											<h4><a href="<?php the_permalink ?>"><?php the_title() ?></a></h4>
											<?php
										}

									}

								} ?>
								</div> <!-- End secondary featured posts -->
							</div>
			</div>
			<!-- END POST/IMG HERO -->

			<!-- START MAIN CONTENT -->
        <div class="container">
          <div class="row">
            <!-- left column / latest posts -->
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-6" >
                <div class="block-title">Latest posts</div>
						<?php
							// Latest posts query
							$args = array(
								'post_type'						=> 'post',
								'orderby'							=> 'date',
								'order'								=> 'DESC',
								'posts_per_page'			=> '5',
								'post__not_in' 				=> get_option("sticky_posts")
							);

							$latest_posts = new WP_Query( $args );

							//Start loop
							if ( $latest_posts->have_posts() ) :

								while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
										<!-- article block -->
										<article class="post article-post">
											<header class="entry-header">
												<a href="<?php the_permalink() ?>"><h3 class="entry-title"><?php the_title() ?></h3></a>
											</header>
											<div class="entry-content">
												<?php the_excerpt() ?>
											</div>
										</article>

								<?php endwhile;

								wp_reset_postdata();
								?>

							<?php else : ?>
								<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
							<?php endif; ?>

					</div>

					<!-- middle column / cases -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 col-border-left col-border-right">
                <!-- case list -->
                <div class="block-title">Cases we’re watching</div>

									<ul class="case-list">
										<?php
										// Featured cases list
										$args = array(
											'post_type'						=> 'case',
											'meta_key'						=> 'featured',
											'meta_value'					=> '1',
											'posts_per_page'			=> '10'
										);
										$latest_posts = new WP_Query( $args );

										//Start loop
										if ( $latest_posts->have_posts() ) :

											while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
											<?php $opinion = get_post_meta($post->ID, 'opinion', true);?>
												<a href="<?php the_permalink() ?>"><li class="<?php if ($opinion) {?>opinion-issued<?php }?>"><?php the_title() ?></li></a>
											<?php endwhile;

											wp_reset_postdata();
											?>

										<?php else : ?>
											<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
										<?php endif; ?>





					</div>

					<div class="col-sm-6 col-md-3">
						<h3>Right col: E-mail</h3>
						<p>First name:</p>
						<p>Last name:</p>
						<p>E-mail address:</p>
						<h4>Past issues of the newsletter:</h4>
						<?php

						 ?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
