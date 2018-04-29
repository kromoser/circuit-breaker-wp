<?php


get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-9 single-case">
		<main id="main" class="site-main" role="main">


      <h1 class="entry-title"><?php the_title() ?> <span class="<?php echo get_field('status') ?>"><?php the_field('status') ?></span></h1>

			<div class="row">

				<?php
					// Get opinions relationship field and argument date
					$opinions = get_field('case_number_for_opinion');
					$one_week_ago = date('m/d/Y', strtotime('-7 days'));
					$date_scheduled = get_field('argument_date', false, false);
					$date = new DateTime($date_scheduled);
					$date_scheduled = date('m/d/Y', strtotime($date_scheduled) );

				?>

				<div class="col-sm-8 details-block">
					<div class="row">
						<div class="col-sm-12 col-lg-6">
							<div class="block-title">Case number: </div>
							<h5><?php the_field('case_number') ?></h5>
						</div>


							<div class="col-sm-12 col-lg-6">
								<div class="block-title">Date filed: </div>
								<h5><?php the_field('date_filed') ?></h5>
							</div>

					</div>
					<div class="row">

						<div class="col-sm-12 col-lg-6">
							<div class="block-title">Last docket entry: </div>
							<h5><?php the_field('last_docket_entry') ?></h5>
						</div>

						<div class="col-sm-12 col-lg-6">
							<?php if ( $date_scheduled >= $one_week_ago ) {	?>
									<div class="block-title">
										Oral argument on:
									</div>
									<h5><?php echo $date->format('j M Y'); ?></h5>
								<?php
							} ?>
						</div>


				</div>

			</div>
			<div class="col-sm-12 col-lg-4 details-block">

					<?php if( $opinions ) { ?>
						<div class="block-title">
							Opinion:
					<?php foreach( $opinions as $o ): ?>
						<a href="<?php echo get_field('opinion_file', $o->ID);?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a>

					<?php endforeach; ?>
						</div>
					<?php foreach( $opinions as $o ): ?>
					<?php $judge = get_field('opinion_name_for_judges', $o->ID); ?>

				<?php foreach( $judge as $j) : ?>
					<h5>Issued by <a href="<?php echo get_the_permalink($j->ID); ?>"><?php echo get_the_title($j->ID); ?></a> <br>
						on <?php echo date('m-d-Y', strtotime( get_field('date_issued', $o->ID) ) ); ?></h5>
			<?php endforeach; ?>
			<?php endforeach; ?>

		<?php
		}	else {
		?>
		<div class="block-title">
			Opinion:
		</div>
			<h5>No opinion</h5>
		<?php
		}
		?>

		</div>




					  <?php
					    // Related posts query
					    $post = $wp_query->post;
					    $args = array(
					      'post_type'						=> 'post',
					      'meta_query'          => array(
					        array(
					            'key' => 'related_cases', // name of custom field
					            'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					            'compare' => 'LIKE'
					          )
					      ),
					      'posts_per_page'			=> '6',
					      'ignore_sticky_posts' => '1'
					    );

					    $related_posts = new WP_Query( $args );

					    //Start loop
					    if ( $related_posts->have_posts() ) :

								?>
								<div class="post-grid col-sm-12">

									<div class="block-title">
										Posts about this case
									</div>


									<div class="row">


									<?php

						      while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
						          <!-- article block -->
											<div class="col-sm-12 col-lg-6">
						          <article class="post article-post">
						            <header class="entry-header">
						              <a href="<?php the_permalink() ?>"><h5 class="entry-title related-post-title"><?php the_title() ?></h5></a>
						            </header>
						            <div class="entry-content post-list">
						             <?php the_excerpt() ?>
						            </div>
						          </article>
										</div>

						      <?php endwhile;

						      wp_reset_postdata();
						      ?>
									</div>

							</div>

					    <?php else : ?>
					      <!--<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>-->
					    <?php endif; ?>
			</div>


		</main><!-- #main -->
	</section><!-- #primary -->

		<?php
		// TO SHOW THE PAGE CONTENTS
		while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
			<?php
			$the_content = get_the_content();
			if ( !empty($the_content) ) { ?>
				<aside id="secondary" class="widget-area col-sm-12 col-lg-3" role="complementary">
				<div class="block-title">
					Case Summary
				</div>
				<div class="case-summary">
						<?php echo the_content(); ?> <!-- Post Content -->
				</div>
				</aside><!-- #secondary -->
				<?php
				}; //endif
				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
				?>

<?php
//get_sidebar('cases');
get_footer();
