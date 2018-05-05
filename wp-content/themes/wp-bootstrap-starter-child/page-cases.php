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

get_header('full-width'); ?>

<div class="col-sm-12 col-lg-8 offset-lg-1">
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
</div>


	<section id="primary" class="content-area col-sm-12 col-lg-8 offset-lg-1">
		<main id="main" class="site-main" role="main">





      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css">
      <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js">

</script>
<script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

<script>
$(document).ready(function() {


    //let casesTable = $('table#case-list').DataTable( {
		//	'searching': true,
		//	'fixedHeader' : true,
    //  'ordering': true,
		//	'order': [[ 2, 'desc' ]]

    //} );

		//$('table#case-list').show();

		//casesTable.draw();


		//	var ajaxurl = '<?php echo admin_url( 'script-test/ajax-test.php' ); ?>';
	  //  $('table#case-list').DataTable( {
	  //      "processing": true,
	  //      "serverSide": true,
	  //      "ajax": ajaxurl
	  //  } );




    let filterParam = [];

    function casesFilter() {
      casesTable.columns(4).search( filterParam.join(' ') ).draw();
    }

    $('.filter-button').click(function() {
      $(this).toggleClass('active-filter');
      filterParam = [];
      $('.filter-button.active-filter').each(function(){
        filterParam.push( $(this).attr('id').split('-').join(' ') )
      });
      casesFilter();
    });


    $('#clear').click(function() {
      $('.filter-button').removeClass('active-filter');
      filterParam = [];
      casesFilter();
    });




});





</script>

<?php
  // Get all cases
  $args = array(
		'no_found_rows'				=> true,
    'post_type'						=> 'case',
    'meta_key'						=> 'status',
    'meta_value'							=> 'active',
    //'order'								=> 'DESC',
    'posts_per_page'			=> '0'
  );

  $all_cases = new WP_Query( $args );
  $now_date = new DateTime();
  $today = $now_date->getTimestamp();

  ?>

	<div class="filtering">
		<span id="filter-label">Filter cases: </span>
		<span id="active" class="filter-button h-100">Active cases</span>
		<span id="closed" class="filter-button h-100">Closed cases</span>
		<span id="opinion" class="filter-button h-100">Opinion issued</span>
		<span id="pending-argument" class="filter-button h-100">Pending arguments</span>
		<span id="clear" class="filter-button h-100">Clear filters</span>
	</div>
<?php echo do_shortcode("[case_datatables]"); ?>
				<!--
			  <button type="button" id="active" class="btn-main filter-button">Active</button>
        <button type="button" id="closed" class="btn-main filter-button">Inactive</button>
        <button type="button" id="opinion" class="btn-main filter-button">Opinions</button>
        <button type="button" id="arguments" class="btn-main filter-button">Arguments</button>
        <button type="button" id="clear" name="button" class="btn-main filter-button">Clear filter</button>
				-->

  <!--      <table id="case-list" style="display: none;" data-page-length='25' class="case-table table">
          <thead>
            <th>Case Name</th>
            <th>Case Number</th>
						<th>Date Filed</th>
            <th>Last Docket Entry</th>
            <th>Status</th>
          </thead>
          <tbody>
            <?php

            //Start loop and put into datatables table
            if ( $all_cases->have_posts() ) :

              while ( $all_cases->have_posts() ) : $all_cases->the_post();
              $arg_date = strtotime( get_post_meta($post->ID, 'argument_date', true) );

            ?>

            <tr>
              <td><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
              <td><?php the_field('case_number') ?></td>
							<td><?php strtotime(the_field('date_filed')) ?></td>
              <td><?php strtotime(the_field('last_docket_entry')) ?></td>
              <td><span class="<?php echo the_field('status') ?>"><?php the_field('status') ?></span>
                  <?php if ( $arg_date >= $today) {
                    ?><span class="arguments-badge">pending&nbsp;argument</span> <?php
                  } ?>
                  <?php if (get_post_meta( $post->ID, 'opinion', true )) {
                    ?><span class="opinion-badge">opinion</span> <?php
                  }?>
              </td>
            </tr>
              <?php endwhile;

              wp_reset_postdata();
              ?>

            <?php else : ?>
              <p><?php esc_html_e( 'Sorry, there are no cases.' ); ?></p>
            <?php endif; ?>
          </tbody>
        </table>
-->


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar('features');
get_footer();
