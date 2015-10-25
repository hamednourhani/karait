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
/*--------------------Product Features-------------------------------*/
/******************************************************************/
 add_action( 'cmb2_init', 'karait_register_product_features_metabox' );
function karait_register_product_features_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'product_features',
		'title'        => __( 'Product Features', 'karait' ),
		'object_types' => array( 'product', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix.'feature',
		'type'        => 'group',
		'description' => __( 'Add Product features', 'karait' ),
		'options'     => array(
			'group_title'   => __( 'feature {#}', 'karait' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another feature', 'karait' ),
			'remove_button' => __( 'Remove feature', 'karait' ),
			'sortable'      => true, // beta
		),
	) );

		
 	
 	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Feature Name', 'karait' ),
		'desc'    => __( 'write the feature name ', 'karait' ),
		'id'      => 'feature_name',
		'type'    => 'text',
		
			
	) );
	
	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Feature Description ', 'karait' ),
		'desc'    => __( 'write the feature Description if needed', 'karait' ),
		'id'      => 'feature_desc',
		'type'    => 'textarea',
		
			
	) );

	$cmb_group->add_group_field($group_field_id , array(
		'name'         => __( 'Images', 'karait' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'karait' ),
		'id'           => $prefix . 'image_list',
		'type'         => 'file_list',
		'preview_size' => array( 54	, 54 ), // Default: array( 50, 50 )
	) );
	
	
}

/******************************************************************/
/*--------------------Project Images-------------------------------*/
/******************************************************************/
add_action( 'cmb2_init', 'karait_register_project_date_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function karait_register_project_date_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'project_date',
		'title'         => __( 'Project Date', 'karait' ),
		'object_types'  => array( 'project' ), // Post type
		// 'show_on_cb' => 'karait_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	
	$cmb_demo->add_field( array(
		'name'         => __( 'Date', 'karait' ),
		'desc'         => __( 'Enter Project Date', 'karait' ),
		'id'           => $prefix . 'project_date',
		'type'         => 'text',
		 // Default: array( 50, 50 )
	) );

	

}

/******************************************************************/
/*--------------------Project Features-------------------------------*/
/******************************************************************/
 add_action( 'cmb2_init', 'karait_register_project_features_metabox' );
function karait_register_project_features_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'project_features',
		'title'        => __( 'Project Features', 'karait' ),
		'object_types' => array( 'project', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix.'feature',
		'type'        => 'group',
		'description' => __( 'Add Project features', 'karait' ),
		'options'     => array(
			'group_title'   => __( 'feature {#}', 'karait' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another feature', 'karait' ),
			'remove_button' => __( 'Remove feature', 'karait' ),
			'sortable'      => true, // beta
		),
	) );

		
 	
 	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Feature Name', 'karait' ),
		'desc'    => __( 'write the feature name ', 'karait' ),
		'id'      => 'feature_name',
		'type'    => 'text',
		
			
	) );

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Feature Value', 'karait' ),
		'desc'    => __( 'write the feature Value ', 'karait' ),
		'id'      => 'feature_value',
		'type'    => 'text',
		
			
	) );

}
/******************************************************************/
/*--------------------Project Images-------------------------------*/
/******************************************************************/
add_action( 'cmb2_init', 'karait_register_project_images_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function karait_register_project_images_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_karait_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'project_images',
		'title'         => __( 'Project Images', 'karait' ),
		'object_types'  => array( 'project' ), // Post type
		// 'show_on_cb' => 'karait_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	
	$cmb_demo->add_field( array(
		'name'         => __( 'Images', 'karait' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'karait' ),
		'id'           => $prefix . 'image_list',
		'type'         => 'file_list',
		'preview_size' => array( 130, 130 ), // Default: array( 50, 50 )
	) );

	

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
		'object_types'  => array( 'post','page','product','project' ), // Post type
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

	
	
}

