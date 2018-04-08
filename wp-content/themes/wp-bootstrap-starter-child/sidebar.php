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

<aside id="secondary" class="widget-area col-sm-12 col-lg-3" role="complementary">


	<div class="block-title">
		Recent Posts
	</div>
	<?php

	$args = array(
		'post_type'						=> 'post',
		'orderby'							=> 'date',
		'order'								=> 'DESC',
		'posts_per_page'			=> '10'
	);

	$latest_posts = new WP_Query( $args );

	//Start loop
	if ( $latest_posts->have_posts() ) :

		while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
				<!-- article block -->
				<ul class="sidebar-list">
					<li>
						<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
						<span class="post-date"><?php echo get_the_date() ?></span>
					</li>
				</ul>

		<?php endwhile;

		wp_reset_postdata();
		?>

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
	<?php endif; ?>

</aside><!-- #secondary -->
