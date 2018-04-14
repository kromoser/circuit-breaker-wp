<?php


get_header(); ?>

	<section id="primary" class="content-area col-sm-12 single-case">
		<main id="main" class="site-main" role="main">


      <h1 class="entry-title"><?php the_title() ?> <span class="<?php echo get_field('status') ?>"><?php the_field('status') ?></span></h1> 

			<div class="row">

				<div class="col-sm-12 col-lg-8 details-block">
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
						<?php
							$opinions = get_field('opinion');
							$one_week_ago = date('m/d/Y', strtotime('-7 days'));
							$date_scheduled = get_field('argument_date', false, false);
							$date_scheduled = date('m/d/Y', strtotime($date_scheduled) );
							?>

							<div class="col-sm-12 col-lg-6">
							<?php if( $opinions ) { ?>

									<div class="block-title">
										Opinion:

										<?php foreach( $opinions as $o ): ?>
											<a href="<?php echo get_field('opinion_file', $o->ID);?>" class="opinion-badge">PDF <i class="material-icons">file_download</i></a>

									</div>

										<?php $judge = get_field('judge', $o->ID); ?>

									<?php foreach( $judge as $j) : ?>
										<?php  ?>
      							<h5>Issued by <a href="<?php echo get_the_permalink($j->ID); ?>"><?php echo get_the_title($j->ID); ?></a> <br>
											on <?php echo date('m-d-Y', strtotime( get_field('date_issued', $o->ID) ) ); ?></h5>
    							<?php endforeach; ?>
								<?php endforeach; ?>

							<?php

							}


								elseif ($date_scheduled >= $one_week_ago) {



								?> <div class="block-title">oral argument on:</div>
								<h5><?php echo $date_scheduled ?></h5>	<?php
							} else {?>
								<div class="block-title">Status: </div>
								<h5><?php echo ucfirst(get_field('status')); ?></h5>
							<?php } ?>


						</div>
					</div>



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
								<div class="col-sm-12 col-lg-4 inline-sidebar">
									<div class="block-title">
										Posts about this case
									</div>
								<?php

					      while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
					          <!-- article block -->
					          <article class="post article-post">
					            <header class="entry-header">
					              <a href="<?php the_permalink() ?>"><h5 class="entry-title related-post-title"><?php the_title() ?></h5></a>
					            </header>
					            <div class="entry-content post-list">
					             <?php the_excerpt() ?>
					            </div>
					          </article>

					      <?php endwhile;

					      wp_reset_postdata();
					      ?>
								</div>


					    <?php else : ?>
					      <!--<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>-->
					    <?php endif; ?>

			</div>


		</main><!-- #main -->
	</section><!-- #primary -->



<?php
//get_sidebar();
get_footer();
