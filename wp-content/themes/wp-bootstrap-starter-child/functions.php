<?php
function my_theme_enqueue_styles() {

    $parent_style = 'wp-bootstrap-starter-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


//Add the columns for the "page" post type
add_filter('manage_edit-case_columns', 'add_columns');
/**
 * Add columns to management page
 *
 * @param array $columns
 *
 * @return array
 */
function add_columns( $columns )
{
	$columns['status'] = 'Status';
	return $columns;
}

add_action( 'manage_case_posts_custom_column', 'columns_content', 10, 2 );

/**
 * Set content for columns in management page
 *
 * @param string $column_name
 * @param int $post_id
 *
 * @return void
 */
function columns_content( $column_name, $post_id )
{
	if ( 'status' != $column_name )
	{
		return;
	}
	$status = get_post_meta( $post_id, 'status', true );
	echo empty( $status ) ? 'No': 'Yes';
}

add_action( 'quick_edit_custom_box', 'quick_edit_add', 10, 2 );

/**
 * Add Headline news checkbox to quick edit screen
 *
 * @param string $column_name Custom column name, used to check
 * @param string $post_type
 *
 * @return void
 */
function quick_edit_add( $column_name, $post_type )
{
	if ( 'status' != $column_name )
	{
		return;
	}

	printf( '
		<input type="text" name="status" class="status"> %s',
		'Custom status'
	);
}

add_action( 'save_post', 'save_quick_edit_data' );

/**
 * Save quick edit data
 *
 * @param int $post_id
 *
 * @return void|int
 */
function save_quick_edit_data( $post_id )
{
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	{
		return $post_id;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) || 'post' != $_POST['post_type'] )
	{
		return $post_id;
	}

	$data = empty( $_POST['status'] ) ? 0 : 1;
	update_post_meta( $post_id, 'status', $data );
}

?>
