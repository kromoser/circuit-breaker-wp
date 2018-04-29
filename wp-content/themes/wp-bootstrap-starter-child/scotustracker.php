<?php
/**
* Template Name: SCOTUSTracker Case
 */

?>


			<?php
			while ( have_posts() ) : the_post();
			?>

			<article class="block-list-single case scotus-case">
				<a href="<?php the_permalink() ?>"><h3><?php the_title() ?></h3></a>
				<span class="post-date">Case Number: <?php the_field('case_number') ?></span>
				<?php the_content() ?>
			</article>

			<?php
			endwhile; // End of the loop.
			?>
