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

get_header('narrow'); ?>

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">


      <h3>Upcoming Arguments</h3>

			<?php
			// Upcoming arguments case list

			//Today's date
			$today = date('Ymd', strtotime("now"));

			$args = array(
				'post_type'						=> 'case',
				'meta_key'						=> 'argument_date',
				'order'								=> 'ASC',
				'posts_per_page'			=> '10',
				'meta_compare' 				=> '>=',
				'meta_type' 					=> 'numeric',
				'meta_value' 					=> $today,
				'orderby' 						=> 'meta_value_num',
			);



			$future_arguments = new WP_Query( $args );
			foreach($future_arguments->posts as $post) {
			  $events[] = array(
			    'title'   => $post->post_title,
					'start'   => get_field('argument_date'),
			    'end'     => get_field('argument_date'),
					'url'			=> get_permalink($post),
			    'allDay'  => true,
			   );
			 };


			?>


			<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" integrity="sha256-IGidWbiBOL+/w1glLnZWR5dCXpBrtQbY3XOUt2TTQOM=" crossorigin="anonymous" />
			<script
        src="//code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>

				<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/locale/af.js" integrity="sha256-I5ZXO8KcMnqNkrXU7baGig70nATYjNDnxxA2d40PcR8=" crossorigin="anonymous"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js" integrity="sha256-uKe4jCg18Q60qLNG8dIei2y3ZVhcHADuEQFlpQ/hBRY=" crossorigin="anonymous"></script>

			<script type="text/javascript">
				$(document).ready(function() {

					<?php
						$js_array = json_encode($events);
						echo "var javascript_array = ". $js_array . ";\n";
					?>

					$('#calendar').fullCalendar({

						events: javascript_array
					});

				})
			</script>


			<div id="calendar">


			</div>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
