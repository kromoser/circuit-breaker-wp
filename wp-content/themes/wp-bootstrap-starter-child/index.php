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

get_header('narrow'); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

								<?php

								$args = array(
									'post_type'						=> 'post',
									'meta_query' 					=> array(
										array(
											'key'							=> 'featured',
											'compare'					=> '=',
											'value'						=> 1
										)
									),
									'meta_key'						=> 'feature_order',
									'orderby'							=> 'meta_value date',
									'order'								=> 'DESC',
									'posts_per_page'			=> '5',
									'ignore_sticky_posts' => 1
								);
								global $post;
								$featured_posts = new WP_Query( $args );

								if ( $featured_posts->have_posts() ) {
									$postCount = 0;
									while ( $featured_posts->have_posts() ) {
										$postCount++;
										$featured_posts->the_post();
										$exclude_posts[] = $post->ID;

										if ( $postCount == 1 ) {
											// Get post featured image

											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
											<!-- FEATURED POST/IMG HERO -->
											<div class="container-fluid hero-posts align-items-center" style="background-image: url('<?php echo $image[0] ?>'); ">
												<div class="row align-items-center h-100 text-white gradient-overlay">
													<div class="col-lg-6 offset-lg-1 col-12 primary-feature-post">
														<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
														<p><?php the_excerpt() ?></p>
													</div>
											<div class="col-lg-4 offset-lg-1 col-12 secondary-feature-posts">
										<?php
										}
										else { ?>
											<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
											<?php
										}
										}
										wp_reset_postdata();
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
								'posts_per_page'			=> '6',
								'post__not_in' 				=> $exclude_posts
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
											'posts_per_page'			=> '5'
										);
										$latest_posts = new WP_Query( $args );

										//Start loop
										if ( $latest_posts->have_posts() ) :

											while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
											<?php
												$opinion = get_post_meta($post->ID, 'opinion', true);
												$argument = get_post_meta($post->ID, 'argument_date', true);
											?>
												<a href="<?php the_permalink() ?>"><li class="<?php if ($opinion) {?>opinion-issued<?php }?><?php if ($argument) {?>arguments<?php }?>"><?php the_title() ?></li></a>
											<?php endwhile;

											wp_reset_postdata();
											?>

										<?php else : ?>
											<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
										<?php endif; ?>
									</ul>
									<a href="cases" class="btn btn-main">View all cases</a>

								<div class="block-title">Upcoming arguments</div>
		                <div class="calendar">
											<ul>
												<?php
												// Upcoming arguments case list

												//Today's date
												$today = date('Ymd', strtotime("now"));


												$args = array(
													'post_type'						=> 'case',
													'meta_key'						=> 'argument_date',
													'order'								=> 'ASC',
													'posts_per_page'			=> '10',
													'meta_compare' 				=> '>=',
													'meta_type' 					=> 'numeric',
													'meta_value' 					=> $today,
													'orderby' 						=> 'meta_value_num',
												);
												$latest_posts = new WP_Query( $args );

												//Start loop
												if ( $latest_posts->have_posts() ) :

													while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
														$date = get_field('argument_date', false, false);
														$date = new DateTime($date);
													?>
														<li><span class="small-header"><?php echo $date->format('j M Y'); ?></span><br>
															<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
														</li>
													<?php endwhile;

													wp_reset_postdata();
													?>

												<?php else : ?>
													<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
												<?php endif; ?>
											</ul>

											<a href="calendar" class="btn btn-main">View all upcoming arguments</a>

		                </div>
					</div>

					<!-- right column / sidebar -->
					<div class="col-sm-12 col-lg-12 col-xl-3">

						<div class="row">

							<!-- e-mail signup -->
							<div class="col-sm-12 col-md-4 col-xl-12">
							<div class="block-title">Sign up for our list</div>
							<form action="https://dccircuitbreaker.us18.list-manage.com/subscribe/post" method="POST" class="email-form">

								<input type="hidden" name="u" value="dc86b249040dc18466c405e49">
						    <input type="hidden" name="id" value="f9c6edc91d">


						    <!-- people should not fill these in and expect good things -->
						    <div class="field-shift" aria-label="Please leave the following three fields empty">
						        <label for="b_name">Name: </label>
						        <input type="text" name="b_name" tabindex="-1" value="" placeholder="Freddie" id="b_name">

						        <label for="b_email">Email: </label>
						        <input type="email" name="b_email" tabindex="-1" value="" placeholder="youremail@gmail.com" id="b_email">

						        <label for="b_comment">Comment: </label>
						        <textarea name="b_comment" tabindex="-1" placeholder="Please comment" id="b_comment"></textarea>
						    </div>

								<div class="email-form-group w-50">
									<input type="text" id="MERGE1" name="MERGE1" class="w-100" placeholder="First name">
								</div>
								<div class="email-form-group w-50">
									<input type="text" id="MERGE2" name="MERGE2" class="w-100" placeholder="Last name">
								</div>
								<div class="email-form-group w-100">
									<input type="email" id="MERGE0" name="MERGE0" class="w-100" placeholder="E-mail address">
								</div>
								<div class="w-100">
								<button type="submit" class="w-100">Sign up</button>
								</div>
							</form>
							</div>

							<!-- Twitter widget -->
							<div class="col-sm-12 col-md-4  col-xl-12">
							<div class="block-title">Recent tweets</div>
							<div class="tweet-block">
								<a class="twitter-timeline" data-height="455" data-dnt="true" data-link-color="#2B7BB9" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
							</div>

							<div class="col-sm-12 col-md-4 col-xl-12">
							<div class="block-title">Search or something else?</div>
							<div class="search-block">

							</div>
							</div>

					</div>

					</div>

				</div> <!-- end row -->

				<div class="row">

					<div class="col-sm-12">
						<div class="block-title">Video roundups</div>
						<div class="video-block">

						<!--	<?php get_search_form(); ?> -->

						</div>
					</div>

				</div> <!-- end row -->
			</div>
			<!-- END MAIN CONTENT -->

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
