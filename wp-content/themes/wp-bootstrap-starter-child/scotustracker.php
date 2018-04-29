<?php
/**
* Template Name: SCOTUSTracker Case
 */

?>


			<?php
			while ( have_posts() ) : the_post();
			?>

			<article class="col-sm-12 block-list-single case">
				<a href="<?php the_permalink() ?>"><h3><?php the_title() ?> <span class="case-number"><?php the_field('case_number') ?></span>	</h3></a>

				<?php the_content() ?>
			</article>

			<?php
			endwhile; // End of the loop.
			?>
