<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header('narrow'); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<main id="main" class="site-main" role="main">

		<?php

			$related_opinions = get_field('opinion_name_for_judges','1650');

			$args = array(

				'post_type' 			=> 'opinion',
				'meta_query'			=> array(
					array(
						'key'					=> 'opinion_name_for_judges',
						'value'				=> '"' . 1650 . '"',
						'compare'			=> 'LIKE'
					)
				)
			);

			$opinions = new WP_Query( $args );

			//print_r($opinions);
		 ?>


		 <?php if ( $opinions->have_posts() ) {
			 while ( $opinions->have_posts() ) {

				 ?> <p>test</p> <?php
				 echo the_title();

			 }
			 wp_reset_postdata();
		 }?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
