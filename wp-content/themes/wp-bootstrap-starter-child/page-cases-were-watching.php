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

			<?php
			$args = array(
				'post_type'						=> 'case',
				'posts_per_page'			=> '-1',
				'meta_query'					=> array(
					array(
						'key'							=> 'featured',
						'compare'					=> '=',
						'value'						=> '1'
					)
				),
				'meta_key'						=> 'last_docket_entry',
				'orderby'							=> 'meta_value_num',
				'order'								=> 'DESC'
			);

			$featured_cases = new WP_Query( $args );

			//Start loop
			if ( $featured_cases->have_posts() ) :
				?><div class="row"><?php
				while ( $featured_cases->have_posts() ) : $featured_cases->the_post(); ?>
							<article class="col-sm-12 col-lg-6 block-list-single case">
								<a href="<?php the_permalink() ?>"><h3><?php the_title() ?> <span class="case-number"><?php the_field('case_number') ?></span>	</h3></a>
								<span class="post-date">Last Docket Entry: <?php the_field('last_docket_entry') ?></span>
								<?php the_content() ?>
							</article>
				<?php endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php else : ?>
				<p><?php esc_html_e( 'Sorry, there are no featured cases.' ); ?></p>
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar('features');
get_footer();
