<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the karait directory)
 *
 * Be sure to replace all instances of 'karait_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_karait
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/karait
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


function ed_metabox_include_front_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'front-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return !$display;
    }

    // Get ID of page set as front page, 0 if there isn't one
    $front_page = get_option( 'page_on_front' );

    // there is a front page set and we're on it!
    return $post_id == $front_page;
}
//add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' karait_box parameter
 *
 * @param  karait object $cmb karait object
 *
 * @return bool             True if metabox should show
 */
function karait_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  karait_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function karait_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  karait_Field object $field      Field object
 */
function karait_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}







/******************************************************************/
/*--------------------Page Banner -------------------------------*/
/******************************************************************/

add_action('cmb2_init','karait_register_page_banner_metabox');
// add_action('cmb2_init','karait_register_tour_information_metabox');
function karait_register_page_banner_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'page_banner',
		'title'         => __( 'Page Banner', 'karait' ),
		'object_types'  => array( 'post','page'), // Post type
		// 'show_on_cb' => 'karait_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	

	$cmb_demo->add_field( array(
		'name'       => __( 'Banner', 'karait' ),
		'desc'       => __( 'Choose Banner Mod, SlideShow , Image Banner or Nothing', 'karait' ),
		'id'         => $prefix . 'banner_mod',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'slider' => __( 'Slider', 'karait' ),
			'image' => __( 'Image', 'karait' ),
			
		),	
		
		//'show_on_cb' => 'karait_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	
	$cmb_demo->add_field( array(
		'name'       => __( 'Slider Shortcode', 'karait' ),
		'desc'       => __( 'write this page Revolotion Slider shortcode with alis name here', 'karait' ),
		'id'         => $prefix . 'slider_shortcode',
		'type'       => 'text',
	
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Banner Image', 'karait' ),
		'desc'       => __( 'Upload an image to show as the banner', 'karait' ),
		'id'         => $prefix . 'image',
		'type'       => 'file',
	
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Page Title', 'karait' ),
		'desc'       => __( 'show Page Title or Not?', 'karait' ),
		'id'         => $prefix . 'title',
		'type'       => 'radio_inline',
		'options'          => array(
			'yes' => __( 'Yes', 'karait' ),
			'no' => __( 'No', 'karait' ),
			
		),
		'default' => 'yes',
	
	) );
	
	

	$cmb_demo->add_field( array(
		'name'       => __( 'English Name', 'karait' ),
		'desc'       => __( 'Enter English name', 'karait' ),
		'id'         => $prefix . 'en_name',
		'type'       => 'text',
	
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Title Button', 'karait' ),
		'desc'       => __( 'show Title Button or Not?', 'karait' ),
		'id'         => $prefix . 'title_button',
		'type'       => 'radio_inline',
		'options'          => array(
			'yes' => __( 'Yes', 'karait' ),
			'no' => __( 'No', 'karait' ),
			
		),
		'default' => 'no',
	
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Button Name', 'karait' ),
		'desc'       => __( 'Enter Button name', 'karait' ),
		'id'         => $prefix . 'button_name',
		'type'       => 'text',
	
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Button Url', 'karait' ),
		'desc'       => __( 'Enter Button Url', 'karait' ),
		'id'         => $prefix . 'button_url',
		'type'       => 'text_url',
	
	) );
	
	
}
add_action( 'cmb2_init', 'karait_select_subpage_metabox' );
function karait_select_subpage_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'sub',
		'title'        => __( 'Sub Pages Layout', 'karait' ),
		'object_types' => array( 'page'),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'sub_pages',
		'type'        => 'group',
		'description' => __( 'Layout sub pages', 'karait' ),
		'options'     => array(
			'group_title'   => __( 'sub page {#}', 'karait' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add sub page', 'karait' ),
			'remove_button' => __( 'Remove sub page', 'karait' ),
			'sortable'      => true, // beta
		),
	) );

	
	
	
 	

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'List Name', 'karait' ),
		'desc'    => __( 'The name of sub page in List ', 'karait' ),
		'id'      => 'list_name',
		'type'    => 'text',
		
			
	) );

	
	
	
		$post_id = ($_GET['post'])?($_GET['post']):"";
	
	$args = array(
	    'child_of'     => $post_id,
	    'sort_order'   => 'ASC',
	    'sort_column'  => 'post_title',
	    'post_type' => 'page',
		'post_status' => 'publish',
		'hierarchical' => 1,
		'parent' => $post_id,
	);

	 $sub_pages_list = get_pages($args);

	 $sub_array = array();
	 $sub_array['none'] = '--';
	foreach ( $sub_pages_list as $page ) : setup_postdata( $page );
			$sub_array[$page->ID] = $page->post_title;
 	endforeach; 




	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Sub Page', 'karait' ),
		'desc'    => __( 'Select The sub page', 'karait' ),
		'id'      => 'sub_id',
		'type'    => 'select',
		'options' =>  $sub_array,
		'default' => 'none',
			
	) );

	$cmb_group->add_group_field($group_field_id, array(
		'name'       => __( 'Sub Page Icon', 'karait' ),
		'desc'       => __( 'Upload an the SUb page icon', 'karait' ),
		'id'         => 'image',
		'type'       => 'file',
	
	) );

	
}

