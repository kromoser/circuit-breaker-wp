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


	<h4 class="sidebar-header">
		Cases We're Watching
	</h4>

	<?php
	$args = array(
		'post_type'						=> 'case',
		'meta_query' 					=> array(
			array(
				'key'							=> 'featured',
				'compare'					=> '=',
				'value'						=> 1
			)
		),
		'meta_key'						=> 'featured_case_order',
		'orderby'							=> 'meta_value date',
		'order'								=> 'DESC',
		'posts_per_page'			=> '-1'
	);

	$featured_cases = new WP_Query( $args );

	//Start loop
	if ( $featured_cases->have_posts() ) :
		?>
		<ul class="sidebar-list">
		<?php
		while ( $featured_cases->have_posts() ) : $featured_cases->the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
						<?php the_content() ?>
					</li>
		<?php endwhile;
		?>
		</ul>
		<?php
		wp_reset_postdata();
		?>

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, there are no featured cases.' ); ?></p>
	<?php endif; ?>
</aside><!-- #secondary -->
