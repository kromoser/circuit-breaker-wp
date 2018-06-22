<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			?><p class="dek"><?php echo get_the_excerpt() ?></p>

			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php wp_bootstrap_starter_child_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="post-thumbnail">
				<?php $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" ); ?>
				<?php $image_width = $image_data[1]; ?>
				<div class="" style="width: auto; display: inline-block;">
					<?php the_post_thumbnail(); ?>
					<p class="caption" style="max-width: <?php echo $image_width ?>px"><?php the_post_thumbnail_caption() ?></p>
				</div>
			</div>
			<?php
			endif;
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		?>





	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
        if ( is_single() ) :


					the_content();



					$posts = get_field('related_cases');

					if( $posts ):
							echo '<div class="footer-block-title">Related cases:</div>';
					    echo '<ul class="relevant-cases">';
					     foreach( $posts as $post): // variable must be called $post (IMPORTANT)
								  setup_postdata($post);
					        echo '<li><a href="';
									the_permalink();
									echo '">';
					        the_title();
					        echo '</a></li>';
					    	endforeach;
					    echo '</ul>';
					     wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
					 endif;
        else :
						echo '<span class="post-date">Posted on: '. get_the_date() .'</span>';
            the_excerpt();
        endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>

		<?php

?>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_bootstrap_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
