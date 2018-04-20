<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


	<?php
// TO SHOW THE PAGE CONTENTS
while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->

	<?php if ( the_content() ) { ?>
<aside id="secondary" class="widget-area col-sm-12 col-lg-3" role="complementary">


	<div class="block-title">
		Case Summary
	</div>
	<div class="case-summary">
			<?php the_content(); ?> <!-- Page Content -->
	</div><!-- .entry-content-page -->
</aside><!-- #secondary -->

<?php
}; //endif
endwhile; //resetting the page loop
wp_reset_query(); //resetting the page query
?>
