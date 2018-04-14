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

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">


      <h3><?php the_title() ?></h3>
			<?php
	    // TO SHOW THE PAGE CONTENTS
	    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
	        <div class="entry-content-page">
	            <?php the_content(); ?> <!-- Page Content -->
	        </div><!-- .entry-content-page -->

	    <?php
	    endwhile; //resetting the page loop
	    wp_reset_query(); //resetting the page query
	    ?>


<?php
  // Get all current judges
  $args = array(
    'post_type'						=> 'judge',
    'meta_key'						=> 'current',
    'orderby'							=> 'title',
    'order'								=> 'DESC',
    'posts_per_page'			=> '-1'
  );

  $current_judges = new WP_Query( $args );


  ?>
  <?php
      //Start loop and put into datatables table
      if ( $current_judges->have_posts() ) :?>

      <div class="block-title">
        Current judges
      </div>
      <?php
        while ( $current_judges->have_posts() ) : $current_judges->the_post();
      ?>

      <!-- article block -->
      <article class="post article-post">
        <header class="entry-header">
          <img src="<?php the_post_thumbnail_url() ?>" alt=""> 
          <a href="<?php the_permalink() ?>"><h3 class="entry-title"><?php the_title() ?></h3></a>
        </header>
        <div class="entry-content">
          <?php the_content() ?>
        </div>

        <div class="opinion-list">
          <ul>
            Opinion list TK
          </ul>

        </div>
      </article>
        <?php endwhile;
        wp_reset_postdata();
        ?>

      <?php else : ?>
        <p><?php esc_html_e( 'Sorry, there are no current judges.' ); ?></p>
      <?php endif; ?>




		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
