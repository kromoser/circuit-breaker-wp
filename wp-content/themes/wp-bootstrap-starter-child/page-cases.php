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

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
      <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

<script>
$(document).ready(function() {

$('table#case-list').DataTable( {
  "searching": true,
  "ordering": true
} );
$('table#case-list').show()
});


</script>

<?php
  // Get all cases
  $args = array(
    'post_type'						=> 'case',
    'meta_key'						=> 'case_number',
    'orderby'							=> 'meta_value',
    'order'								=> 'DESC',
    'posts_per_page'			=> '-1'
  );

  $latest_posts = new WP_Query( $args );

  ?>


        <table id="case-list" style="display: none;">
          <thead>
            <th>Case Name</th>
            <th>Case Number</th>
            <th>Last Docket Entry</th>
            <th>Status</th>
          </thead>
          <tbody>
            <?php
            //Start loop and put into datatables table
            if ( $latest_posts->have_posts() ) :

              while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
            <tr>
              <td><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
              <td><?php the_field(case_number) ?></td>
              <td><?php strtotime(the_field(last_docket_entry)) ?></td>
              <td>Status</td>
            </tr>
              <?php endwhile;

              wp_reset_postdata();
              ?>

            <?php else : ?>
              <p><?php esc_html_e( 'Sorry, there are no recent posts.' ); ?></p>
            <?php endif; ?>
          </tbody>
        </table>



		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
