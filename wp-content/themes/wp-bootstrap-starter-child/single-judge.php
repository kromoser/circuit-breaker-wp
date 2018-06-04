<?php


get_header('narrow'); ?>
<h1 class="entry-title col-12">
	<img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title() ?>" class="headshot">
	<p class="judge-name"><?php the_title() ?> <span class="status-badge"><?php echo get_field('judge_status') ?></span></p>
</h1>
	<section id="primary" class="content-area col-sm-12 col-lg-8 single-case">
		<main id="main" class="site-main" role="main">




			<div class="row">

				<?php
					// Get opinions relationship field and argument date
					$opinions = get_field('case_number_for_opinion');
					$one_week_ago = date('m/d/Y', strtotime('-7 days'));
					$date_scheduled = get_field('argument_date', false, false);
					$date = new DateTime($date_scheduled);
					$date_scheduled = date('m/d/Y', strtotime($date_scheduled) );

				?>



						<div class="col-sm-12 col-lg-6 details-block">
							<div class="block-title">Assumed office: </div>
							<h5><?php echo get_post_meta(get_the_ID(), 'assumed_office', true) ?></h5>
						</div>


							<div class="col-sm-12 col-lg-6 details-block">
								<div class="block-title">Appointed by: </div>
								<h5><?php echo get_post_meta(get_the_ID(), 'appointed_by', true) ?></h5>
							</div>



						<div class="col-sm-12 col-lg-6 details-block">
							<div class="block-title">Hometown: </div>
							<h5><?php echo get_post_meta(get_the_ID(), 'hometown', true) ?></h5>
						</div>

						<div class="col-sm-12 col-lg-6 details-block">

									<div class="block-title">
										Attended:
									</div>
									<h5><?php echo get_post_meta(get_the_ID(), 'undergrad', true) ?>, <?php echo get_post_meta(get_the_ID(), 'law_school', true) ?></h5>

						</div>





			<div class="col-sm-12 col-lg-6 details-block">
				<div class="block-title">
					Clerkship:
				</div>
				<h5><?php echo get_post_meta(get_the_ID(), 'clerkship', true) ?></h5>
			</div>

			<div class="col-sm-12 col-lg-6 details-block">
				<div class="block-title">
					Before the Bench:
				</div>
				<h5>
					<?php
					// TO SHOW THE PAGE CONTENTS
					while ( have_posts() ) : the_post();
					echo the_content();
				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
					?>
					</h5>
			</div>

			<div class="col-sm-12 col-lg-6 details-block">
				<div class="block-title">
					Trivia:
				</div>
				<h5><?php echo get_post_meta(get_the_ID(), 'trivia', true) ?></h5>
			</div>





			</div>


		</main><!-- #main -->
	</section><!-- #primary -->

		<?php
		// TO SHOW THE PAGE CONTENTS
		while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
			<?php
			$opinions = get_field('opinion_name_for_judges');
			if ( $opinions ) { ?>
				<aside id="secondary" class="widget-area col-sm-12 col-lg-4" role="complementary">
				<div class="block-title">
					Opinions
				</div>
				<div class="case-summary">
					<ul>
						<?php foreach ($opinions as $o ) {

							$case = get_posts(array(
								'posts_per_page' => 1,
								'post_type'		=> 'case',
								'meta_key' 		=> 'case_number',
								'meta_value'	=> get_the_title($o->ID)
							));

							foreach ($case as $c) {


							?>
							<li><a href="<?php echo get_the_permalink($c->ID) ?>"><?php echo get_the_title($c->ID) ?></a></li>
							<?php
							}
						};	?>
					</ul>
				</div>
				</aside><!-- #secondary -->
				<?php

			};?>
				<?php

				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
				?>

<?php
//get_sidebar('cases');
get_footer();
