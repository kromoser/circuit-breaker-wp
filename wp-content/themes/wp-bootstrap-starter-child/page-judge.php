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

get_header('judge'); ?>






	<section id="primary" class="content-area col-12">
		<main id="main" class="site-main" role="main">

			<!--<h3><?php the_title() ?></h3>-->
			<?php
			$url_id = get_query_var('judge_id');
			$judge_name = get_the_title($url_id);
			if (get_field('opinion_name_for_judges', $url_id, false)) { $written_opinions = get_field('opinion_name_for_judges', $url_id, false); } else { $written_opinions = []; }
			if (get_field('concurring_judge_opinion', $url_id, false)) { $concurring_opinions = get_field('concurring_judge_opinion', $url_id, false); } else { $concurring_opinions = []; }
			if (get_field('dissenting_judge_opinion', $url_id, false)) { $dissenting_opinions = get_field('dissenting_judge_opinion', $url_id, false); } else { $dissenting_opinions = []; }

			?>



			<?php

			// TO SHOW THE PAGE CONTENTS
			while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page mb-5">
							<!--<?php the_content(); ?> --><!-- Page Content -->
							<h3 class="feature">
								Judge <?php echo properize($judge_name) ?> <br>
								<?php echo count($written_opinions); ?> majority opinions<?php if ( get_field('concurring_judge_opinion', $url_id, false) ) { echo ', '.count( $concurring_opinions ).' concurrences, and '.count( $dissenting_opinions ).' dissents'; }?>
							</h3>
							<?php the_content(); ?>
							<?php if ( $judge_name === 'Brett Kavanaugh' || $judge_name === 'Merrick B. Garland') { ?>
							<p class="tag-list">
								<script type="text/javascript">
									const $ = jQuery;
									$(document).ready(function() {

										const tagLinks = $('span.case-tag a, a.tag-cloud-link');
										const topTagLinks = $('a.tag-cloud-link');
										const articles = $('article');

										tagLinks.on('click', function(e) {
											e.preventDefault();
											//$(this).hide();
											//articles.hide();
											//console.log($(this).text())
											const tagLinkName = $(this).text();

											topTagLinks.each(function() {
												//topTagLinks.removeClass("active");
												if ( $(this).text() === tagLinkName ) {
													topTagLinks.not($(this)).removeClass('active');
													$(this).toggleClass('active').trigger('classChange');
													console.log(tagLinkName);
												}
											});

											const tagName = $(this).text().split(' ').join('-');
											//console.log($(this).text())
											//articles.hide();
											if ( $('a.tag-cloud-link').is($('.active')) ) {
												articles.hide();
												$('article.' + tagName).fadeIn('fast');
											} else {
												articles.fadeIn('fast');
											}

											//tagLinks.each(function() {
												//if ( $(this).text() === tagName ) {
													//$(this).closest('article').show();
													//return false;
												//} else {
													//$(this).closest('article').hide();



											});


									});
								</script>
								<?php

							$args = array(
								'smallest'                  => 0.8,
								'largest'                   => 0.8,
								'unit'                      => 'rem',
								'number'                    => 45,
								'format'                    => 'flat',
								'separator'                 => " ",
								'orderby'                   => 'name',
								'order'                     => 'ASC',
								'exclude'                   => null,
								'include'                   => null,
								'topic_count_text_callback' => default_topic_count_text,
								'link'                      => 'view',
								'taxonomy'                  => 'post_tag',
								'echo'                      => true,
								'child_of'                  => null, // see Note!
							);

							wp_tag_cloud($args);

							?>
						</p>
					<?php }; ?>
					</div><!-- .entry-content-page -->

					<script type="text/javascript">
					function animateValue(id, start, end, duration) {
					// assumes integer values for start and end

					var obj = document.getElementById(id);
					var range = end - start;
					// no timer shorter than 50ms (not really visible any way)
					var minTimer = 50;
					// calc step time to show all interediate values
					var stepTime = Math.abs(Math.floor(duration / range));

					// never go below minTimer
					stepTime = Math.max(stepTime, minTimer);

					// get current time and calculate desired end time
					var startTime = new Date().getTime();
					var endTime = startTime + duration;
					var timer;

					function run() {
							var now = new Date().getTime();
							var remaining = Math.max((endTime - now) / duration, 0);
							var value = Math.round(end - (remaining * range));
							obj.innerHTML = value;
							if (value == end) {
									clearInterval(timer);
							}
					}

					timer = setInterval(run, stepTime);
					run();
				}

				//animateValue("maj-opinion-count", 0, <?php //echo count($written_opinions) ?>, 200)

					</script>

			<?php
			endwhile; //resetting the page loop
			wp_reset_query(); //resetting the page query
			?>


			<?php

			//SET GENERAL ARGS
			$args = array(
				'post_type' 			=> 'opinion',
				'posts_per_page'	=> -1,
				//'post__in'				=> $written_opinions,
				'meta_key'				=> 'date_issued',
				'order'						=> 'DESC',
				'orderby'					=> 'meta_value'

			);

			?>

			<div class="row">


			<?php

			// START MAJ OPINION COLUMN

				if ( $written_opinions ) {

					$args['post__in']=$written_opinions;

					$written_opinions_posts = new WP_Query($args);

					?>

					<?php if ( get_field('concurring_judge_opinion', $url_id, false))  {

						?><div class="col-sm-12 col-md-4"><?php

					} else {

						?><div class="col-sm-12"><?php
					}?>




						<div class="block-title col-12">
							Majority Opinions
						</div>

						<?php

						if ( $written_opinions_posts->have_posts() ) {
							?><?php

							while ( $written_opinions_posts->have_posts() ) {

								$written_opinions_posts->the_post(); ?>
<?php $case_ID = get_field('case_number_for_opinion', false, false)[0]; ?>
											<article class="col-sm-12 block-list-single news feature-opinion-list <?php $post_tags = get_the_tags($case_ID);

if ( $post_tags ) {
    foreach( $post_tags as $tag ) {
			$tag_name = str_replace(" ", "-", $tag->name);
    echo $tag_name . ' ';
    }
} ?>">

												<h3><a href="<?php echo get_the_permalink($case_ID); ?>"><?php echo '<span class="case-number">'.get_the_title().'</span> '.get_the_title( $case_ID ) ?></a>

													<?php //if ( get_field('dissenting_judge_opinion') ) {
														//echo '<span class="opinion-badge__dissenting">Dissenting</span>';
													//} elseif ( get_field('concurring_judge_opinion')) {
													//	echo '<span class="opinion-badge__concurring">Concurring</span>';
													//}; ?>

												</h3>
												<!--<p><?php // print_r(get_field('case_number_for_opinion'))?></p>-->
												<span class="post-date">Issued on <?php echo date('F d, Y', strtotime( get_field('date_issued') )); ?> <a href="<?php echo get_field('opinion_file');?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a></span>
												<?php if ( $judge_name === 'Brett Kavanaugh' || $judge_name === 'Merrick B. Garland') {
													echo get_the_tag_list('<span class="case-tag">','</span> <span class="case-tag">','</span>',$case_ID); }; ?>
											</article><?php
							}

						wp_reset_postdata();
						}

					?>
					</div>
					<?php
					} else {
						echo 'There are no written opinions.';
					}

					// END MAJ OPINION COLUMN
				 ?>

				 <?php

	 			// START CONCURRING OPINION COLUMN

	 				if ( $concurring_opinions ) {

	 					$args['post__in']=$concurring_opinions;

	 					$written_opinions_posts = new WP_Query($args);

	 					?>


	 					<div class="col-sm-12 col-md-4">

							<div class="block-title col-12">
		 						Concurrences
		 					</div>

	 						<?php

	 						if ( $written_opinions_posts->have_posts() ) {
	 							?><?php

	 							while ( $written_opinions_posts->have_posts() ) {

	 								$written_opinions_posts->the_post(); ?>

	 											<article class="col-sm-12 block-list-single news feature-opinion-list">
	 												<?php $case_ID = get_field('case_number_for_opinion', false, false)[0]; ?>
													<h3><a href="<?php echo get_the_permalink($case_ID); ?>"><?php echo '<span class="case-number">'.get_the_title().'</span> '.get_the_title( $case_ID ) ?></a>

	 													<?php //if ( get_field('dissenting_judge_opinion') ) {
	 														//echo '<span class="opinion-badge__dissenting">Dissenting</span>';
	 													//} elseif ( get_field('concurring_judge_opinion')) {
	 													//	echo '<span class="opinion-badge__concurring">Concurring</span>';
	 													//}; ?>


	 												</h3>
	 												<!--<p><?php // print_r(get_field('case_number_for_opinion'))?></p>-->
	 												<span class="post-date">Issued on <?php echo date('F d, Y', strtotime( get_field('date_issued') )); ?> <a href="<?php echo get_field('opinion_file');?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a></span>

	 											</article><?php
	 							}

	 						wp_reset_postdata();
	 						}

	 					?>
	 					</div>
	 					<?php
	 					} else {
	 						//echo 'There are no concurrences.';
	 					}

	 					// END CON OPINION COLUMN
	 				 ?>

					 <?php

		 			// START DISSENTING OPINION COLUMN

		 				if ( $concurring_opinions ) {

		 					$args['post__in']=$dissenting_opinions;

		 					$written_opinions_posts = new WP_Query($args);

		 					?>


		 					<div class="col-sm-12 col-md-4">

								<div class="block-title col-12">
			 						Dissents
			 					</div>

		 						<?php

		 						if ( $written_opinions_posts->have_posts() ) {
		 							?><?php

		 							while ( $written_opinions_posts->have_posts() ) {

		 								$written_opinions_posts->the_post(); ?>

		 											<article class="col-sm-12 block-list-single news feature-opinion-list">
		 												<?php $case_ID = get_field('case_number_for_opinion', false, false)[0]; ?>
														<h3><a href="<?php echo get_the_permalink($case_ID); ?>"><?php echo '<span class="case-number">'.get_the_title().'</span> '.get_the_title( $case_ID ) ?></a>

		 													<?php //if ( get_field('dissenting_judge_opinion') ) {
		 														//echo '<span class="opinion-badge__dissenting">Dissenting</span>';
		 													//} elseif ( get_field('concurring_judge_opinion')) {
		 													//	echo '<span class="opinion-badge__concurring">Concurring</span>';
		 													//}; ?>

		 												</h3>
		 												<!--<p><?php // print_r(get_field('case_number_for_opinion'))?></p>-->
		 												<span class="post-date">Issued on <?php echo date('F d, Y', strtotime( get_field('date_issued') )); ?> <a href="<?php echo get_field('opinion_file');?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a></span>

		 											</article><?php
		 							}

		 						wp_reset_postdata();
		 						}

		 					?>
		 					</div>
		 					<?php
		 					} else {
		 						//echo 'There are no written opinions.';
		 					}

		 					// END DISS OPINION COLUMN
		 				 ?>








			</div>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar('features');
get_footer();
