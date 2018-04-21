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

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">


      <h3><?php the_title() ?></h3>
			<?php
	    // TO SHOW THE PAGE CONTENTS
	    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
	        <div class="entry-content-page">
	            <?php the_content(); ?> <!-- Page Content -->
	        </div><!-- .entry-content-page -->

	    <?php
	    endwhile; //resetting the page loop
	    wp_reset_query(); //resetting the page query
	    ?>


<?php
  // Get all current judges
  $args = array(
    'post_type'						=> 'judge',
    'meta_key'						=> 'current',
    'orderby'							=> 'title',
    'order'								=> 'DESC',
    'posts_per_page'			=> '-1'
  );

  $current_judges = new WP_Query( $args );


  ?>
  <?php
      //Start loop and put into datatables table
      if ( $current_judges->have_posts() ) :?>

      <div class="block-title">
        Current judges
      </div>

      <div class="card-columns">

        <?php
          while ( $current_judges->have_posts() ) : $current_judges->the_post();
        ?>

        <!-- article block -->
        <article class="card col-sm-12 single-judge">

						<div class="card-header">
							<div class="row">
								<div class="col-sm-12 col-md-4 headshot">
									<img src="<?php the_post_thumbnail_url() ?>" alt="" class="headshot">
								</div>

								<div class="col-sm-12 col-md-8">
									<h3 class="entry-title col-sm-12"><?php the_title() ?></h3>

									<div class="block-title">
										Assumed office: <span><?php echo get_post_meta(get_the_ID(), 'assumed_office', true) ?></span>
									</div>

									<div class="block-title">
										Appointed by: <span><?php echo get_post_meta(get_the_ID(), 'appointed_by', true) ?></span>
									</div>
								</div>
							</div>
						</div>

						<div class="card-body row">
							<div class="block-title col-sm-12 col-lg-6">
								Clerkship: <span><?php echo get_post_meta(get_the_ID(), 'clerkship', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Hometown: <span><?php echo get_post_meta(get_the_ID(), 'hometown', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Attended: <span><?php echo get_post_meta(get_the_ID(), 'undergrad', true) ?>, <?php echo get_post_meta(get_the_ID(), 'law_school', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Trivia: <span><?php echo get_post_meta(get_the_ID(), 'trivia', true) ?></span>
							</div>

							<div class="block-title col-sm-12">
								Career: <span><?php the_content() ?></span>

							</div>

							<?php $opinions = get_field('opinion_name_for_judges'); ?>
							<?php if ( $opinions ) {
								?>
								<a href="#" class="btn btn-main">View opinions</a>
								<div class="opinion-list col-sm-12">
									<ul>
										<?php foreach ($opinions as $o ) {
											?>
											<li><a href="#"><?php echo get_the_title($o->ID) ?></a></li>
											<?php
										};
										?>
									</ul>
								</div>
								<?php

							};?>

						</div>





        </article>
          <?php endwhile;
          wp_reset_postdata();
          ?>

        <?php else : ?>
          <p><?php esc_html_e( 'Sorry, there are no current judges.' ); ?></p>
        <?php endif; ?>


      </div>





		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
