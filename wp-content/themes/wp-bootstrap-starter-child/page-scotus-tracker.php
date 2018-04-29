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






	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">

			<h3><?php the_title() ?></h3>

			<?php
			// TO SHOW THE PAGE CONTENTS
			while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page mb-5">
							<?php the_content(); ?> <!-- Page Content -->
					</div><!-- .entry-content-page -->

			<?php
			endwhile; //resetting the page loop
			wp_reset_query(); //resetting the page query
			?>

			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<?php $pending_cases_field = get_field_object('pending_cases') ?>
					<div class="block-title"><?php echo $pending_cases_field['label'] ?></div>
					<?php the_field('pending_cases') ?>
				</div>

				<div class="col-sm-12 col-lg-6">
					<?php $cert_grants_field = get_field_object('cert_grants') ?>
					<div class="block-title"><?php echo $cert_grants_field['label'] ?></div>
					<?php the_field('cert_grants') ?>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar('features');
get_footer();
