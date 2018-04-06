<?php


get_header(); ?>

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">


      <h3><?php the_title() ?></h3>
      <h5><?php the_field(case_number) ?></h5>
      <h5><?php the_field(date_filed) ?></h5>
        <?php

          $opinions = get_field(opinion);
          ?>
          <?php if( $opinions ): ?>
            <?php foreach( $opinions as $opinion ): ?>
          <h5>
                <a href="<?php echo get_permalink( $opinion->ID ); ?>">
                  <?php echo get_the_title( $opinion->ID ); ?>
                </a>
          </h5>
          <?php endforeach; ?>
          <?php endif; ?>

        <h4>Posts about this case:</h4>
        <?php
          // Related posts query
          $post = $wp_query->post;
          $args = array(
            'post_type'						=> 'post',
            'meta_query'          => array(
              array(
									'key' => 'related_cases', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
            ),
            'posts_per_page'			=> '-1',
            'ignore_sticky_posts' => '1'
          );

          $related_posts = new WP_Query( $args );

          //Start loop
          if ( $related_posts->have_posts() ) :

            while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <!-- article block -->
                <article class="post article-post">
                  <header class="entry-header">
                    <a href="<?php the_permalink() ?>"><h3 class="entry-title"><?php the_title() ?></h3></a>
                  </header>
                  <div class="entry-content">
                    <p><?php the_excerpt() ?></p>
                  </div>
                </article>

            <?php endwhile;

            wp_reset_postdata();
            ?>

          <?php else : ?>
            <p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
          <?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
