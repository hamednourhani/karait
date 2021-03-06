<?php
/*
Author: Eddie Machado
URL: http://themble.com/karait/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD karait CORE (if you remove this, the theme will break)
require_once( 'library/karait.php' );
// require_once( 'library/notifications.php' );

//Include and setup custom metaboxes and fields.
if( !class_exists("CMB2") ){
    require_once( dirname(__FILE__)."/library/cmb/init.php" );
}
require_once( 'library/cmb-functions.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
 //require_once( 'library/admin.php' );

/*********************
LAUNCH karait
Let's get everything up and running.
*********************/

function karait_ahoy() {

  //Allow editor style.
  //add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'karait', get_template_directory() . '/languages' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'karait_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'karait_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'karait_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'karait_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'karait_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'karait_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  karait_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'karait_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'karait_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'karait_excerpt_more' );

} /* end karait ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'karait_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

// if ( ! isset( $content_width ) ) {
//  $content_width = 640;
// }

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'banner', 1000, 250, array( 'center', 'center' ) );


add_filter( 'image_size_names_choose', 'karait_custom_image_sizes' );

function karait_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __('1200px by 500px'),
        
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/


function karait_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'karait_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function karait_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar',
    'name' => __( 'Sidebar', 'karait' ),
    'description' => __( 'The first (primary) sidebar.', 'karait' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-col1',
    'name' => __( 'Footer first col', 'karait' ),
    'description' => __( 'The first footer widget area', 'karait' ),
    'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-col2',
    'name' => __( 'Footer 2d col', 'karait' ),
    'description' => __( 'The first footer widget area', 'karait' ),
    'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-col3',
    'name' => __( 'Footer 3rd col', 'karait' ),
    'description' => __( 'The first footer widget area', 'karait' ),
    'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-col4',
    'name' => __( 'Footer 4th Col', 'karait' ),
    'description' => __( 'The first footer widget area', 'karait' ),
    'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  

  
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function karait_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'karait' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'karait' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'karait' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'karait' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


function karait_pagination(){
  global $wp_query;

    if($wp_query->max_num_pages > 1){
        $big = 999999999; 
        echo /*__('Page : ','karait').*/paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $wp_query->max_num_pages,
          'prev_text'    => __('<i class="fa fa-angle-double-left"></i>','karait'),
          'next_text'    => __('<i class="fa fa-angle-double-right"></i>','karait')
        ) );
      }
}


function karait_SearchFilter($query) {
    if ($query->is_search) {
      $query->set('post_type', array('page','post'));
    }
    return $query;
    }

add_filter('pre_get_posts','karait_SearchFilter');

// Enable support for HTML5 markup.
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form'
  ) );



/*---------------Widgets----------------------*/

function karait_get_image_src($src="" , $size=""){
    $path_info = pathinfo($src);
    return $path_info['dirname'].'/'.$path_info['filename'].'-'.$size.'.'.$path_info['extension'];
}

//-----------Menu Walker------------------------




function karait_search_form( $form ) {
  global $post,$wp_query,$wpdb;
   

  if(ICL_LANGUAGE_CODE == 'en' || ICL_LANGUAGE_CODE == 'it'){
      $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
      <div><label class="screen-reader-text" for="s">' . __( 'Search for:','karait' ) . '</label>
      <input type="text" value="' . get_search_query() . '" name="s" id="s" />
      <input type="hidden" name="lang" value="'.ICL_LANGUAGE_CODE.'"/>
      </div>
      </form>';
  } else {
      $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
      <div><label class="screen-reader-text" for="s">' . __( 'Search for:','karait'  ) . '</label>
      <input type="text" value="' . get_search_query() . '" name="s" id="s" />
      </div>
      </form>';
  }

  return $form;
}

add_filter( 'get_search_form', 'karait_search_form' );

// if ( ICL_LANGUAGE_CODE=='en'){ 
  
//         remove_filter('the_title', 'ztjalali_persian_num');
//         remove_filter('the_content', 'ztjalali_persian_num');
//         remove_filter('the_excerpt', 'ztjalali_persian_num');
//         remove_filter('comment_text', 'ztjalali_persian_num');
//     // change arabic characters
//         remove_filter('the_content', 'ztjalali_ch_arabic_to_persian');
//         remove_filter('the_title', 'ztjalali_ch_arabic_to_persian');
//         remove_filter('the_excerpt', 'ztjalali_ch_arabic_to_persian');
//         remove_filter('comment_text', 'ztjalali_ch_arabic_to_persian');
    


// }



?>