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






	<section id="primary" class="content-area col-12">
		<main id="main" class="site-main" role="main">

			<!--<h3><?php the_title() ?></h3>-->
			<?php
			$url_id = get_query_var('judge_id');
			$judge_name = get_the_title($url_id);
			$rel_opinions = array_merge(get_field('opinion_name_for_judges', $url_id, false), get_field('dissenting_judge_opinion', $url_id, false), get_field('concurring_judge_opinion', $url_id, false) );
			// TO SHOW THE PAGE CONTENTS
			while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page mb-5">
							<!--<?php the_content(); ?> --><!-- Page Content -->
							<h3>The <?php echo count( $rel_opinions ); ?> opinions written by Judge <?php echo $judge_name ?> </h3>
							<?php the_content(); ?>
					</div><!-- .entry-content-page -->

			<?php
			endwhile; //resetting the page loop
			wp_reset_query(); //resetting the page query
			?>

			<?php




				if ( $rel_opinions ) {

					//echo 'HELLO';

					$args = array(
						'post_type' 			=> 'opinion',
						'posts_per_page'	=> -1,
						'post__in'				=> $rel_opinions,
						'meta_key'				=> 'date_issued',
						'order'						=> 'DESC',
						'orderby'					=> 'meta_value'

					);

					$rel_opinion_posts = new WP_Query($args);

					if ( $rel_opinion_posts->have_posts() ) {
						?><div class="row two-column"><?php

						while ( $rel_opinion_posts->have_posts() ) {

							$rel_opinion_posts->the_post(); ?>

										<article class="col-sm-12 block-list-single news">
											<?php $case_ID = get_field('case_number_for_opinion', false, false)[0]; ?>
											<h3><a href="<?php echo get_the_permalink($case_ID); ?>"><?php echo the_title().' - '.get_the_title( $case_ID ) ?></a>

												<?php if ( get_field('dissenting_judge_opinion') ) {
													echo '<span class="opinion-badge__dissenting">Dissenting</span>';
												} elseif ( get_field('concurring_judge_opinion')) {
													echo '<span class="opinion-badge__concurring">Concurring</span>';
												}; ?>

												<a href="<?php echo get_field('opinion_file');?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a>
											</h3>
											<!--<p><?php // print_r(get_field('case_number_for_opinion'))?></p>-->
											<span class="post-date">Issued on <?php echo date('F d, Y', strtotime( get_field('date_issued') )); ?></span>

										</article><?php
						}

					wp_reset_postdata();
					}

				}

			 ?>




			</div>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar('features');
get_footer();
