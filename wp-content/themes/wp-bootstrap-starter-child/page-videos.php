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

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>



	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">
			<h3><?php the_title() ?></h3>

			<div class="row">
				<?php
					//Get most recent video post
					$args = array(
						'post_type' 				=> 'post',
						'category_name'			=> 'video',
						'posts_per_page'		=> 1
					);

					$newest_video = new WP_Query( $args );

					if ( $newest_video->have_posts() ) :
						while ( $newest_video->have_posts() ) : $newest_video->the_post();
				?>

					<article class="col-12 single-video col-md-8 offset-md-2 featured-video">
						<a href="<?php the_permalink(); ?>"><h3> <?php the_title();	?></h3></a>
						<p class="dek"><?php echo get_the_excerpt() ?></p>
						<div class="video-wrap">
							<?php the_field('video_embed') ?>
						</div>

						<?php the_content(); ?>

					</article>

					<?php endwhile;
					wp_reset_postdata();
					?>

					<?php else : ?>
						<p><?php esc_html_e( 'Sorry, there are no videos.' ); ?></p>
					<?php endif; ?>

			</div>
			<div class="row">
				<?php
				  // Get all posts with video cat, except the first
				  $args = array(
				    'post_type'						=> 'post',
						'category_name'				=> 'video',
						'offset'							=> 1,
						'orderby'							=> 'date',
						'order'								=> 'DESC'

				  );

				  $videos = new WP_Query( $args );


				  ?>
				  <?php
				      if ( $videos->have_posts() ) :

				          while ( $videos->have_posts() ) : $videos->the_post();
				        ?>

				        <!-- article block -->
				        <article class="col-sm-12 col-md-6 single-video">

									<a href="<?php the_permalink(); ?>"><h3> <?php the_title();	?></h3></a>

									<p class="dek"><?php echo get_the_excerpt() ?></p>
									<div class="video-wrap">
										<?php the_field('video_embed') ?>
									</div>
									<?php the_content(); ?>

				        </article>
				          <?php endwhile;
				          wp_reset_postdata();
				          ?>

				        <?php else : ?>
				          <p><?php esc_html_e( 'Sorry, there are no more videos.' ); ?></p>
				        <?php endif; ?>
			</div>








		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
