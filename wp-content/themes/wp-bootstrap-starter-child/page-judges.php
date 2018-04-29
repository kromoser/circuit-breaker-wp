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

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

<script type="text/javascript">

	jQuery(document).ready(function() {

		jQuery('div.opinion-list').hide();


		jQuery('.grid').masonry({
		  // options
		  itemSelector: '.card',
		  columnWidth: '.col-lg-6',
			percentPosition: true
		});


		jQuery('.opinion-button').on('click', function(event) {
			event.preventDefault();

			//jQuery(this).html('Hide opinions')
			jQuery(this).next().toggle(0, function() {
				jQuery('.grid').masonry({itemSelector: '.card', containerStyle: null});
			});
			jQuery(this).children().toggleClass('expand');
		})


	})

</script>

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">





<?php
  // Get all current judges
  $args = array(
    'post_type'						=> 'judge',
    //'meta_key'						=> 'current',
    //'orderby'							=> 'title',
    //'order'								=> 'ASC',
    'posts_per_page'			=> '-1',
		'meta_query'					=> array(
			array(
				'key'							=> 'current',
				'compare'					=> '=',
				'value'						=> true
			)
		),
		'meta_key'						=> 'force_order',
		'orderby'							=> 'meta_value_num',
		'order'								=> 'ASC'

  );

  $current_judges = new WP_Query( $args );


  ?>
  <?php
      //Start loop and put into datatables table
      if ( $current_judges->have_posts() ) :?>

      <div class="block-title">
        Current judges
      </div>

      <!--<div class="card-columns">-->
			<div class="grid">


        <?php
          while ( $current_judges->have_posts() ) : $current_judges->the_post();
        ?>

        <!-- article block -->
        <article class="card col-sm-12 col-lg-6 single-judge">

						<div class="card-header">
							<div class="row">
								<div class="col-4   headshot">
									<img src="<?php the_post_thumbnail_url() ?>" alt="" class="headshot">
								</div>

								<div class="col-8 ">
									<h3 class="entry-title col-sm-12"><?php the_title() ?></h3>
									<div class="status-badge">
										<?php echo get_field('judge_status')?>
									</div>
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
								Hometown: <span><?php echo get_post_meta(get_the_ID(), 'hometown', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Attended: <span><?php echo get_post_meta(get_the_ID(), 'undergrad', true) ?>, <?php echo get_post_meta(get_the_ID(), 'law_school', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Clerkship: <span><?php echo get_post_meta(get_the_ID(), 'clerkship', true) ?></span>
							</div>

							<div class="block-title col-sm-12 col-lg-6">
								Trivia: <span><?php echo get_post_meta(get_the_ID(), 'trivia', true) ?></span>
							</div>

							<div class="block-title col-sm-12">
								Career: <span><?php the_content() ?></span>

							</div>

						</div>
						<?php $opinions = get_field('opinion_name_for_judges'); ?>
						<?php if ( $opinions ) {
							?>
							<div class="card-footer">
								<div class="opinion-button"><i class="material-icons">keyboard_arrow_right</i> See opinions</div>
								<div class="opinion-list col-sm-12">
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
										};
										?>
									</ul>
								</div>
							</div>

							<?php

						};?>





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
