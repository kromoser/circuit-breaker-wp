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

    let casesTable = $('table#case-list').DataTable( {
      "searching": true,
      "ordering": true
    } );

    $('table#case-list').show();

    let filterParam = [];

    function casesFilter() {
      casesTable.columns(3).search( filterParam.join(' ') ).draw();
    }

    $('.filter-button').click(function() {
      filterParam.push($(this).attr('id'));
      casesFilter();
    });


    $('#clear').click(function() {
      filterParam = [];
      casesFilter();
    });




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

  $all_cases = new WP_Query( $args );

  ?>
        <button type="button" id="active" class="btn-main filter-button">Active</button>
        <button type="button" id="closed" class="btn-main filter-button">Inactive</button>
        <button type="button" id="opinion" class="btn-main filter-button">Opinions</button>
        <button type="button" id="arguments" class="btn-main filter-button">Arguments</button>
        <button type="button" id="clear" name="button" class="btn-main filter-button">Clear filter</button>

        <table id="case-list" style="display: none;" data-page-length='50'>
          <thead>
            <th>Case Name</th>
            <th>Case Number</th>
            <th>Last Docket Entry</th>
            <th>Status</th>
          </thead>
          <tbody>
            <?php
            //Start loop and put into datatables table
            if ( $all_cases->have_posts() ) :

              while ( $all_cases->have_posts() ) : $all_cases->the_post(); ?>
            <tr>
              <td><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
              <td><?php the_field(case_number) ?></td>
              <td><?php strtotime(the_field(last_docket_entry)) ?></td>
              <td><?php the_field(status) ?></td>
            </tr>
              <?php endwhile;

              wp_reset_postdata();
              ?>

            <?php else : ?>
              <p><?php esc_html_e( 'Sorry, there are no cases.' ); ?></p>
            <?php endif; ?>
          </tbody>
        </table>



		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
