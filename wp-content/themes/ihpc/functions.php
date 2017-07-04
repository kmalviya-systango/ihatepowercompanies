<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */
define('GOOGLE_KEY','AIzaSyCvwfRQ3ULTudFFo49MzXyC4xgFmsxpW4U'); 
function my_acf_google_map_api( $api ){
	$api['key'] = GOOGLE_KEY;	
	return $api;	
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
 
 function my_nav_wrap() {
  // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'  
  // open the <ul>, set 'menu_class' and 'menu_id' values
  $wrap  = '<ul id="%1$s" class="%2$s">';
  // get nav items as configured in /wp-admin/
  $wrap .= '%3$s';
  // the static link
  if( !is_user_logged_in() ){
  	$wrap .= '<li class="active top_submit_review"><a href="'.site_url('submit-review').'">submit review</a></li>
  			<li class="top_login"><a href="'.site_url('login').'">Log in</a></li>
  			<li><a href="'.site_url('sign-up').'">Sign up</a></li>
  			<li class="for-mobile"><a href="#"><img src="'.site_url("wp-content/themes/ihpc/assets/images/bars_icon.png").'"></a></li>';
  }
  else{
  	$wrap .= '<li class="active top_submit_review"><a href="'.site_url('submit-review').'">submit review</a></li>
  			<li><a href="'.wp_logout_url( ).'">Log out</a></li>
  			<li><a href="#"><img src="'.site_url("wp-content/themes/ihpc/assets/images/bars_icon.png").'"></a></li>';
  }  
  // close the <ul>
  $wrap .= '</ul>';
  // return the result
  return $wrap;
}
 
function ihpc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/ihpc
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'ihpc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ihpc' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'ihpc-featured-image', 2000, 1200, true );

	add_image_size( 'ihpc-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'ihpc' ),
		'social' => __( 'Social Links Menu', 'ihpc' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', ihpc_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'ihpc' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'ihpc' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'ihpc_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

	//Adding three roles for company type
	add_role('starter_plan', __( 'Free Plan' ),
		array(
			'read'         => true,  // true allows this capability
			'edit_posts'   => true,
			'delete_posts' => false, // Use false to explicitly deny
		)
	);
	add_role('plus_plan', __( 'Plus Plan' ),
		array(
			'read'         => true,  // true allows this capability
			'edit_posts'   => true,
			'delete_posts' => false, // Use false to explicitly deny
		)
	);
	add_role('enterprise_plan', __( 'Enterprise Plan' ),
		array(
			'read'         => true,  // true allows this capability
			'edit_posts'   => true,
			'delete_posts' => false, // Use false to explicitly deny
		)
	);
}
add_action( 'after_setup_theme', 'ihpc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ihpc_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( ihpc_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'ihpc_content_width', $content_width );
}
add_action( 'template_redirect', 'ihpc_content_width', 0 );

/**
 * Register custom fonts.
 */
function ihpc_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'ihpc' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ihpc_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ihpc-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ihpc_resource_hints', 10, 2 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ihpc_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Front Page Sidebar: Top', 'ihpc' ),
		'id'            => 'frontpage-sidebar-1',
		'description'   => __( 'Add widgets here to appear in your frontpage.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title"><span class="icon"></span>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Front Page Sidebar: Bottom', 'ihpc' ),
		'id'            => 'frontpage-sidebar-2',
		'description'   => __( 'Add widgets here to appear in your frontpage.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ihpc' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title"><span class="icon"></span>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ihpc' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget col-lg-3 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ihpc' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget col-lg-3 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	register_sidebar( array(
			'name'          => __( 'Footer 4', 'ihpc' ),
			'id'            => 'footer-4',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' 
		) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 5', 'ihpc' ),
		'id'            => 'footer-5',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' 
	) );

	register_sidebar( array(
		'name'          => __( 'All Right Reserved', 'ihpc' ),
		'id'            => 'footer-policy',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget policy-text %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/*register_sidebar( array(
		'name'          => __( 'Sidebar Banners', 'ihpc' ),
		'id'            => 'images-banner',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="google_adds %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' 
	) );*/

}
add_action( 'widgets_init', 'ihpc_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function ihpc_excerpt_more( ) {

	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'ihpc_excerpt_more' );

//Limit Excerpt length
function ihpc_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'ihpc_excerpt_length', 999 );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function ihpc_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ihpc_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ihpc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'ihpc_pingback_header' );

/**
 * Display custom color CSS.
 */
function ihpc_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo ihpc_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'ihpc_colors_css_wrap' ); 

/** 
 * Enqueue scripts and styles.
 */
function ihpc_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ihpc-fonts', ihpc_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'ihpc-style', get_stylesheet_uri() );
	//Font-Awesome Min
	wp_enqueue_style( 'ihpc-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'ihpc-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto' );
	wp_enqueue_style( 'ihpc-font-roboto-slab', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' );


	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'ihpc-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'ihpc-style' ), '1.0' );
		wp_style_add_data( 'ihpc-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'ihpc-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'ihpc-style' ), '1.0' );
	wp_style_add_data( 'ihpc-ie8', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'bootstrap-min', get_theme_file_uri( '/assets/css/bootstrap.min.css' ), array( 'ihpc-style' ), '1.0' );
	//theme CSS
	wp_enqueue_style( 'theme-css', get_theme_file_uri( '/assets/css/theme.css' ), array( 'ihpc-style' ), '1.0' );
	wp_enqueue_style( 'checkbox-css', get_theme_file_uri( '/assets/skins/all.css' ), array( 'ihpc-style' ), '1.0' );	
	wp_enqueue_style( 'Star', get_theme_file_uri( '/assets/themes/fontawesome-stars-o.css' ), array( 'ihpc-style' ), '1.0' );		
	wp_enqueue_style( 'tags', get_theme_file_uri( '/assets/css/bootstrap-tagsinput.css' ), array( 'ihpc-style' ), '1.0' );		
	wp_enqueue_style( 'theme-responsive-css', get_theme_file_uri( '/assets/css/responsive_theme.css' ), array( 'ihpc-style' ), '1.0' );
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	$ihpc_l10n = array(
		'quote'  => ihpc_get_svg( array( 'icon' => 'quote-right' ) ),
	);
	
	wp_enqueue_script( 'google_map', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_KEY.'&libraries=places', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'bootstrap-min', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'icheck.min', get_theme_file_uri( '/assets/js/icheck.min.js' ), array( 'jquery' ), '2.1.2', true );		
	wp_enqueue_script( 'Star', get_theme_file_uri( '/assets/js/jquery.barrating.js' ), array( 'jquery' ), '1.0', true );	
	wp_enqueue_script( 'Tags', get_theme_file_uri( '/assets/js/bootstrap-tagsinput.js' ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-validations', get_theme_file_uri( '/assets/js/jquery.validate.min.js' ), array( 'jquery' ), '1.0', true );	
	wp_enqueue_script( 'ihpcscripts', get_theme_file_uri( '/assets/js/ihpcscripts.js' ), array( 'jquery' ), '1.0', true );

	wp_localize_script('ihpcscripts','ihcpvars',array('ihcp_nonce' => wp_create_nonce('ihcp_nonce'), 'ihcp_ajax_url' => admin_url( 'admin-ajax.php' )));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ihpc_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function ihpc_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'ihpc_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function ihpc_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'ihpc_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function ihpc_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ihpc_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function ihpc_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'ihpc_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

//Including ReduxFramework in theme
//Author: DharmendraSingh
/*if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/options-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/options-config.php' );
}*/

//Require registered post type posts
require_once(dirname( __FILE__ ).'/post-types/postregister.php');


add_action( 'wp_ajax_home_search_title', 'home_search_title' );
add_action( 'wp_ajax_nopriv_home_search_title', 'home_search_title' );
function home_search_title(){
	print_r($_POST);

	wp_die();
}

//Pre Get posts filter via Ajax
add_action( 'wp_ajax_archive_company_filter', 'archive_company_filter' );
add_action( 'wp_ajax_nopriv_archive_company_filter', 'archive_company_filter' );
function archive_company_filter(){

	echo $_POST;
	add_filter( 'pre_get_posts', 'my_get_posts' );
	function my_get_posts( $query ) {
		if ( is_home() ) {
			$query->set( 'post_type', 'event' );
			$query->set( 'meta_key', '_start_date' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_query', array(
				array(
					'key' => '_start_date'
				),
				array(
					'key' => '_end_date',
					'value' => time(),
					'compare' => '>=',
					'type' => 'numeric'
				)
			));
		}
		return $query;
	}
}

//Social Login FB,Google,Twitter
add_action( 'wp_ajax_ihpc_social_login', 'ihpc_social_login' );
add_action( 'wp_ajax_nopriv_ihpc_social_login', 'ihpc_social_login' );
function ihpc_social_login(){
	print_r($_POST);
	wp_die();
}

/***
* Register home page sidebar
* Refer function ihpc_widgets_init();
****/

/***
* Including IHPC required widgets
****/
include_once 'ihpc-widgets/most-active-users.php';
include_once 'ihpc-widgets/most-active-companies.php';

/***
* After logout redirect user to home page.
****/
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
	wp_redirect( home_url() );
	exit();
}

/****
* Getting most hatted power companies
****/
function get_companies_by_date($posts_per_page,$index){
	//Posts from current week
	if($index == 1){
		$dateQ = array( 'year' => date( 'Y' ), 'week' => date( 'W' ) );
	}
	//Posts 1 week ago
	if($index == 2){
		$dateQ = array( 'year' => date( 'Y' ), 'week' => date( 'W', strtotime('-1 Week') ) );
	}
	//Posts 1 month ago
	if($index == 3){
		$dateQ = array( 'year' => date( 'Y' ), 'month' => date( 'm', strtotime('-1 Month') ) );
	}
	$args = array(	'posts_per_page' => $posts_per_page,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ),
					'date_query' => array($dateQ)
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$ratting = get_post_meta(get_the_ID(), 'ratings_average', true);
			$nu_user_ratted = get_post_meta(get_the_ID(), 'ratings_users', true);			
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			$array[$i]['date'] 			= get_the_date();
			$array[$i]['ihpc_ratings'] 	= $ratting;
			$array[$i]['nu_user_ratted'] 	= $nu_user_ratted;
			$i++;	
		}
	}
	return $array;
}


/*function most_hatted_power_companies(){
	$args = array(	'posts_per_page' => 20,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ),
				);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		$html1= $html2 = $html3 = '';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();			
			$nu_user_ratted = get_post_meta(get_the_ID(), 'ratings_users', true);			

			$curr_time 		= current_time( 'timestamp' );
			$last_month1 	= strtotime("-1 month",$curr_time);
			$last_month2 	= strtotime("-2 month",$curr_time);
			$last_week1 	= strtotime("-1 week",$curr_time);
			$last_week2 	= strtotime("-2 week",$curr_time);
			$post_date 		= strtotime(get_the_date());

			//This week posts
			if( ($post_date>$last_week1) ){
				$html1 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>							
						</li>';
			}			
			//Getting last week posts
			if( ($post_date<=$last_week1) && ($post_date > $last_week2) ){
				$html2 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>
								
						</li>';
			}
			//Getting last month posts
			if( ($post_date < $last_month1) && ($post_date > $last_month2) ){
				$html3 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>
						  </li>';
			}			
		}
		wp_reset_postdata();
		$rtn = '';
		$rtn .= "<div class='col-md-4 user-list'><h4>Now</h4><ul>".$html1."</ul></div>";
		$rtn .= "<div class='col-md-4 user-list'><h4>Last Week</h4><ul>".$html2."</ul></div>";
		$rtn .= "<div class='col-md-4 user-list'><h4>Last Month</h4><ul>".$html3."</ul></div>";

		return $rtn;
	} else {
		return 'No data';
	}	
}*/

/****
* Getting meta values from db
****/
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ));
    foreach ( $r as $my_r )
        $metas[$my_r->ID] = $my_r->meta_value;
    return $metas;
}

/****
* Getting top locations
****/
function top_locations(){
	$locations = get_meta_values('company_location','companies'); 
	$locations = array_values($locations);
	$locations = array_unique($locations);
	sort($locations);
	foreach ($locations as $key => $location) {
		if( $key<5 ){
			$div1 .= "<li>$location</li>";
		}
		elseif( $key<9 ){
			$div2 .= "<li>$location</li>";	
		}
		elseif(  $key<14  ){
			$div3 .= "<li>$location</li>";
		}
	}
	return "<div>
				<ul>$div1</ul>
				<ul>$div2</ul>
				<ul>$div3</ul>
			</div>";
}

/****
* Getting categories
****/
function get_ihpc_categories($ihpc_taxonomy,$number=24,$parent=0){
	$args = array(	'taxonomy' => $ihpc_taxonomy,
					'hide_empty' => false,
					'orderby'=>'name',
					'number' => $number,
					'parent' => $parent
				);

	$terms = get_terms( $args );	
	$cates = array();
	$i = 0;
	foreach ($terms as $key => $term) {
		if( ($term->slug != 'all_users') && ($term->slug != 'all_categories') ){
			$acf_term_format = $ihpc_taxonomy."_".$term->term_id;
			$term_url = get_field('category_icon', $acf_term_format);
			$cates[$i]['term_taxonomy_id'] = $term->term_id;
			$cates[$i]['permalink'] 	= get_term_link($term->term_id);
			$cates[$i]['img_url'] 		= $term_url;
			$cates[$i]['term_id'] 		= $term->term_id;
			$cates[$i]['name'] 			= $term->name;
			$cates[$i]['slug'] 			= $term->slug;
			$cates[$i]['term_group'] 	= $term->term_group;		
			$cates[$i]['taxonomy'] 		= $term->taxonomy;
			$cates[$i]['description'] 	= $term->description;
			$cates[$i]['parent'] 		= $term->parent;
			$cates[$i]['count'] 		= $term->count;
			$cates[$i]['filter'] 		= $term->filter;
			$i++;
		}		
	}
	return $cates;
}

/*
* Getting companies by ratings
*/
function get_companies_by_ratings($number_of_companies,$orderBy){
	$args = array(	'posts_per_page' => $number_of_companies,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => $orderBy, 'title' => 'ASC' ),
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$ratting = get_post_meta(get_the_ID(), 'ratings_average', true);			
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			//$array[$i]['date'] 			= get_the_date();
			$array[$i]['date'] 			= human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
			$array[$i]['ihpc_ratings'] 	= $ratting;			
			$i++;	
		}
	}
	return $array;
}

function get_companies($number_of_companies){
	$args = array(	'posts_per_page' => $number_of_companies,
					'post_type'	=> 'companies'
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			$array[$i]['date'] 			= get_the_date();
			$i++;	
		}
	}
	return $array;
}


/****
* Getting reviews
****/
function get_reviews( $number_of_reviews, $orderby = 'date', $order = 'DESC' ){
	$args = array(	'posts_per_page' => $number_of_reviews,
					'post_type'	=> 'review',
					'orderby' 	=> $orderby,
	    			'order' 	=> $order
				);
	$array 	= array();
	$i 		= 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();			
			$array[$i]['title'] 	= get_the_title();
			$array[$i]['excerpt'] 	= get_the_excerpt();
			$array[$i]['content'] 	= get_the_content();
			$array[$i]['permalink'] = get_permalink();
			//$array[$i]['date'] 		= get_the_date();
			$array[$i]['date'] 		= human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
			$i++;
		}		
		wp_reset_postdata();
		return $array;
	}
	else {
		return $array;
	}
}

/****
* Getting comments
****/
function get_ihpc_comments( $number_of_comments, $post_type ){
	$args = array(
	    'parent'	=> 0,
	    'post_type' => $post_type,
	    'number' 	=> $number_of_comments,
	    'orderby' 	=> 'date',
	    'order' 	=> 'DESC'
	  );
	$array 		= array();
	$comments 	= get_comments($args);
	$i = 0;
	foreach($comments as $comment) :
		$array[$i]['comment'] 	= $comment->comment_content;
		$array[$i]['date'] 		= get_comment_date('',$comment->comment_ID);
		$array[$i]['excerpt'] 	= get_comment_excerpt( $comment->comment_ID );
		$i++;
	endforeach;
	return $array;
}

function get_company_reviews($company_id){
	$args = array(	'posts_per_page' => -1,
					'post_type'	=> 'review',
					'meta_key'     => 'REVIEW_COMPANYID',
					'meta_value'   => $company_id,
					'meta_compare' => '='
				);
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();		
			$i++;	
		}
	}
	return $i;
}


/***
* Register company
***/
add_action('admin_post_nopriv_register_company','register_company_callback');
//add_action( 'admin_post_register_company', 'register_company_callback' );
function register_company_callback(){
	if( !empty($_REQUEST) ){
		if( wp_verify_nonce($_POST['security-code'],'register_company') ){
			//Checking if company exists or not: Start
			$cmp_args1 = array(	'posts_per_page' => -1,
								'post_type' 	 => 'companies',
								'title' 		 => $_REQUEST['reg_company_name']
							);
			$companies = get_posts( $cmp_args1 );
			if( !empty($companies) ){
				$company 	= $companies[0];
				$company_id = $company->ID;
			}
			else{
				$company_arg2 = array();
				$company_arg2['post_title'] 	= $_REQUEST['reg_company_name'];
				$company_arg2['post_status'] 	= 'pending';
			    $company_arg2['post_type'] 		= 'companies';
				$company_id = wp_insert_post($company_arg2);			
			}
			//END:
			$user_arg = array();
			$user_arg['user_pass'] 		= '123456789';
			$user_arg['user_login'] 	= $_REQUEST['reg_company_name'];
			$user_arg['user_email'] 	= $_REQUEST['reg_company_email'];
			$user_arg['display_name'] 	= $_REQUEST['reg_company_title'];
		    $user_arg['role'] 			= $_REQUEST['contract_type'];
			$fullName = explode(" ", $_REQUEST['reg_company_fullname']);
			if( count($fullName) == 1 ){
				$firstName = $fullName[0];
				$user_arg['first_name'] = $firstName;
			}
			else{
				$firstName = $fullName[0];
				unset($fullName[0]);
				$lastName = implode(" ", $fullName);
				$user_arg['first_name'] = $firstName;
				$user_arg['last_name'] 	= $lastName;
			}			
		    $user_id = wp_insert_user( $user_arg );		    
		    if ( !is_wp_error( $user_id ) ) {
		    	//Updating the user phone
		    	update_user_meta( $user_id, 'user_phone	', $user_arg['reg_company_phone'] );
		    	//Relating the user with company
		    	update_user_meta( $user_id, 'associated_company', array($company_id) );
				wp_send_new_user_notifications( $user_id, 'both' );
				$redirect_to = site_url('company-signup?msg=successfull registered a free plan, please login to comment');
				wp_safe_redirect( $redirect_to );
			}
			else{
				$errors = $user_id->errors;
				foreach ($errors as $key => $error) {
					$msg 			= $error[0];
					$redirect_to 	= site_url('login?msg='.$msg);
					wp_safe_redirect( $redirect_to );					
				}
			}
			exit();
		}
	}
}

function get_post_by_category($post_type,$offset,$post_per_page,$category_name){
	$args = array(	'post_type' => $post_type,
					'posts_per_page' => $post_per_page,
					'category_name' => $category_name,
					'offset' => $offset
				);
	$the_query 	= new WP_Query( $args );
	$array 		= array();
	$i = 0;
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$array[$i]['id'] 		= get_the_ID();
			$array[$i]['title'] 	= get_the_title();
			$array[$i]['excerpt'] 	= get_the_excerpt();
			$array[$i]['content'] 	= get_the_content();
			$array[$i]['permalink'] = get_permalink();
			$array[$i]['date'] 		= get_the_date();
			$array[$i]['img'] = get_the_post_thumbnail_url(get_the_ID(),'medium');
			$i++;
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		return $array;
	} 
	else {
		return $array;
	}
}



/*****
* Functions for 'Write A Review' page
******/
//Function for step 1
add_action('wp_ajax_submit_reivew_form', 'submit_reivew_form');
add_action('wp_ajax_nopriv_submit_reivew_form', 'submit_reivew_form');
function submit_reivew_form(){	
	parse_str($_REQUEST['form_json'], $data);
	$insertArray 	= array();
	$insertArray['post_title'] 				= $data['review_title'];
	$insertArray['post_content'] 			= $data['review_text'];
	$insertArray['company'] 				= $data['company'];
    $insertArray['product_or_service'] 		= !empty($data['product_or_service']) ? $data['product_or_service']:'';
    $insertArray['readed_term_of_services'] = !empty($data['readed_term_of_services']) ? 1:0;    
    $insertArray['post_status'] 			= 'pending';
    $insertArray['post_type'] 				= 'review';
		
	$review_inserted_id = wp_insert_post($insertArray);
	if( !empty($review_inserted_id) ){		
		/****
		* Checking if company exists or not, 
		* if company exists then getting its company id 
		* else creating a new company.
		****/
		$cmp_args1 = array(	'posts_per_page' => -1,
							'post_type' 	 => 'companies',
							'title' 		 => $insertArray['company']
						);
		$companies = get_posts( $cmp_args1 );
		if( !empty($companies) ){
			$company 	= $companies[0];
			$company_id = $company->ID;
		}
		else{
			$company_arg2 = array();
			$company_arg2['post_title'] 	= $insertArray['company'];
			$company_arg2['post_status'] 	= 'pending';
		    $company_arg2['post_type'] 		= 'companies';
		    $company_arg2['post_category'] 	= array( $data['company_category'] );
			$company_id = wp_insert_post($company_arg2);			
		}
		if(!empty($company_id)){
			update_post_meta( $review_inserted_id, 'REVIEW_COMPANYID', $company_id);
		}
		//END:
		$photos = $videos = '';
		//If files are uploaded and post have been created
		if( !empty($_FILES) && !empty($review_inserted_id) ){
			foreach ($_FILES as $key => $file) {
				$file_nonce = $key."_nonce";				
				$attach_id  = upload_media_to_review_post( $file_nonce, $key, $review_inserted_id );
				if( !empty($attach_id) ){
					if( substr($key, 0,9) == 'add_photo' ){
						$photos .= wp_get_attachment_url( $attach_id )."\n";
					}
					if( substr($key, 0,9) == 'add_video' ){
						$videos .= wp_get_attachment_url( $attach_id )."\n";
					}	
				}
			}
		}
		//saving the form fields in post meta
		update_post_meta( $review_inserted_id, 'review_accepted_terms_conditions', $insertArray['readed_term_of_services'] );
		update_post_meta( $review_inserted_id, 'review_product_or_service', $insertArray['product_or_service'] );
		update_post_meta( $review_inserted_id, 'uploaded_photos', $photos );
		update_post_meta( $review_inserted_id, 'uploaded_videos', $videos );
		//echo $review_inserted_id;
		echo $url = site_url()."/submit-review?screen_no=2&reviewId=$review_inserted_id";
	}
	else{
		echo "Review is not created";
	}
	exit();
}
//Function for step 2
add_action('wp_ajax_review_additional_form', 'review_additional_form_callback');
add_action('wp_ajax_nopriv_review_additional_form', 'review_additional_form_callback');
function review_additional_form_callback(){
	parse_str($_REQUEST['form_json'],$data);
	$reviewId = $_REQUEST['reviewId'];	
	if( !empty($data['ComplaintForm']['full_name']) ){
		$full_name = $data['ComplaintForm']['full_name'];
		update_post_meta($reviewId,'_reviewer_full_name',$full_name);
	}
	if( !empty($data['ComplaintForm']['personal_email']) ){
		$personal_email = $data['ComplaintForm']['personal_email'];
		update_post_meta($reviewId,'_reviewer_email',$personal_email);
	}	
	if( !empty($data['ComplaintForm']['personal_phone']) ){
		$personal_phone = $data['ComplaintForm']['personal_phone'];
		update_post_meta($reviewId,'_reviewer_phone',$personal_phone);
	}
	if( !empty($data['ComplaintForm']['pissedReasonTemp']) ){
		$pissedReasonTemp = $data['ComplaintForm']['pissedReasonTemp'];
		update_post_meta($reviewId,'_unhappy_because',$pissedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['otherPissedReasonTemp']) ){
		$otherPissedReasonTemp = $data['ComplaintForm']['otherPissedReasonTemp'];
		update_post_meta($reviewId,'_unhappy_because_other_reason',$otherPissedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['pleasedReasonTemp']) ){
		$pleasedReasonTemp = $data['ComplaintForm']['pleasedReasonTemp'];
		update_post_meta($reviewId,'_happy_because',$pleasedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['otherPleasedReasonTemp']) ){
		$otherPleasedReasonTemp = $data['ComplaintForm']['otherPleasedReasonTemp'];
		update_post_meta($reviewId,'_happy_because_of_other_reason',$otherPleasedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['monetary_value']) ){
		$monetary_value = $data['ComplaintForm']['monetary_value'];
		update_post_meta($reviewId,'_value_of_loss',$monetary_value);
	}
	if( !empty($data['ComplaintForm']['wanted_solution']) ){
		$wanted_solution = $data['ComplaintForm']['wanted_solution'];
		update_post_meta($reviewId,'_want',$wanted_solution);
	}
	if( !empty($data['ComplaintForm']['other_wanted_solution']) ){
		$other_wanted_solution 	= $data['ComplaintForm']['other_wanted_solution'];
		update_post_meta($reviewId,'_want_other_solution',$other_wanted_solution);
	}
	if( !empty($data['ComplaintForm']['online_business_location']) ){
		$online_business_location 	= $data['ComplaintForm']['online_business_location'];
		update_post_meta($reviewId,'_company_website',$online_business_location);
	}	
	echo $url = site_url()."/submit-review?screen_no=3&reviewId=$reviewId";
	exit();
}

//Function for step 3
add_action('wp_ajax_review_location_form', 'review_location_form_callback');
add_action('wp_ajax_nopriv_review_location_form', 'review_location_form_callback');
function review_location_form_callback(){
	parse_str($_REQUEST['form_json'],$data);	
	$reviewId = $_REQUEST['reviewId'];	
	if( !empty($data['business-type']) ){
		$business_type 	= $data['business-type'];
		update_post_meta($reviewId,'_bussiness_type',$business_type);
	}
	if( !empty($data['bussiness-type-url']) ){
		$business_type_url 	= $data['bussiness-type-url'];
		update_post_meta($reviewId,'_company_website',$business_type_url);
	}
	if( !empty($data['location']) ){
		$value = $data['location'];
		$loc = serialize($value);
		update_field('_review_location', $value, $reviewId);
		//$location 	= json_encode($data['location']);
		update_post_meta($reviewId,'_review_location',$loc);
	}
	echo $url = site_url()."/submit-review?screen_no=4&reviewId=$reviewId";
	exit();
}

//Function for step 4
add_action('wp_ajax_review_ratting_form', 'review_ratting_form_callback');
add_action('wp_ajax_nopriv_review_ratting_form', 'review_ratting_form_callback');
function review_ratting_form_callback(){
	parse_str($_REQUEST['form_json'],$data);
	$reviewId = $_REQUEST['reviewId'];
	if( !empty($data['rating']['location']) ){
		$location = $data['rating']['location'];
		update_post_meta($reviewId,'_location',$location);
	}
	if( !empty($data['rating']['diversity_of_products']) ){
		$diversity_of_products = $data['rating']['diversity_of_products'];
		update_post_meta($reviewId,'_diversity_of_products_or_services',$diversity_of_products);
	}
	if( !empty($data['rating']['product_service']) ){
		$product_service = $data['rating']['product_service'];
		update_post_meta($reviewId,'_product_or_service_quality',$product_service);
	}
	if( !empty($data['rating']['advertised_vs_delivered']) ){
		$advertised_vs_delivered = $data['rating']['advertised_vs_delivered'];
		update_post_meta($reviewId,'_advertised_vs_delivered',$advertised_vs_delivered);
	}
	if( !empty($data['rating']['website']) ){
		$website = $data['rating']['website'];
		update_post_meta($reviewId,'_website',$website);
	}
	if( !empty($data['rating']['staff']) ){
		$staff = $data['rating']['staff'];
		update_post_meta($reviewId,'_staff',$staff);
	}
	if( !empty($data['rating']['price_affordability']) ){
		$price_affordability = $data['rating']['price_affordability'];
		update_post_meta($reviewId,'_price_affordability',$price_affordability);
	}
	if( !empty($data['rating']['value_of_money']) ){
		$value_of_money = $data['rating']['value_of_money'];
		update_post_meta($reviewId,'_value_for_money',$value_of_money);
	}
	if( !empty($data['rating']['customer_service']) ){
		$customer_service = $data['rating']['customer_service'];
		update_post_meta($reviewId,'_customer_service',$customer_service);
	}
	if( !empty($data['rating']['exchange_policy']) ){
		$exchange_policy = $data['rating']['exchange_policy'];
		update_post_meta($reviewId,'_exchange_refund_and_cancellation_policy',$exchange_policy);
	}
	if( !empty($data['experience']['likes']) ){
		$likes = $data['experience']['likes'];
		update_post_meta($reviewId,'_i_liked',$likes);
	}
	if( !empty($data['experience']['unlikes']) ){
		$unlikes = $data['experience']['unlikes'];
		update_post_meta($reviewId,'_i_did_not_liked',$unlikes);
	}
	if( !empty($data['tags']) ){
		$tags = $data['tags'];
		update_post_meta($reviewId,'_tags',$tags);
	}
	if( !empty($data['companies_consider']) ){
		$companies_consider = $data['companies_consider'];
		update_post_meta($reviewId,'_what_were_other_companies_you_considered',$companies_consider);
	}
	//If user is logged in then assigning this review to that user and redirect to thank you page.
	if( is_user_logged_in() ){
		$user_id = get_current_user_id();
		$arg = array(
			'ID' => $reviewId,
			'post_author' => $user_id,
		);
		wp_update_post( $arg );
		echo $url = site_url('success?msg_id=1');
	}
	else{
		echo $url = site_url("sign-up?msg_id=2&reviewId=$reviewId");
	}	
	exit();
}


//$_POST['add_photo_nonce']
function upload_media_to_review_post( $nonce, $file_name, $post_id ) {
	//if ( isset( $nonce ) && wp_verify_nonce( $nonce, $file_name ) ) {
		require_once( ABSPATH.'wp-admin/includes/image.php' );
		require_once( ABSPATH.'wp-admin/includes/file.php' );
		require_once( ABSPATH.'wp-admin/includes/media.php' );		
		$attachment_id = media_handle_upload( $file_name, $post_id );		
		if ( is_wp_error( $attachment_id ) ) {
			return 0;
		} 
		else {
			//return wp_get_attachment_url( $attachment_id );
			return $attachment_id;
		}
	/*} else {
		return "The security check failed, maybe show the user an error.";
	}*/
}

function ihpc_get_users( $role = array('Subscriber') ){
	$args 		= array( 'role__in' => $role );	
	$user_query = new WP_User_Query( $args );
	$array 		= array();
	$i = 0;
	if ( ! empty( $user_query->results ) ) {
		foreach ( $user_query->results as $user ) :
			$user_id = $user->data->ID;
			$pro_pic = get_field('user_profile_pic','user_'.$user_id);
			if( empty($pro_pic) ){
				$pro_pic = get_stylesheet_directory_uri()."/assets/images/avatar_standart_light.png";
			}
			$associated_company = get_field('associated_company','user_'.$user_id);
			if( !empty($associated_company) ){				
				$company_title = get_the_title( $associated_company[0] );
			}
			else{
				$company_title = ''	;
			}
			$array[$i]['user_id'] 				= $user_id;
			$array[$i]['roles'] 				= $user->roles;
			$array[$i]['pro_pic'] 				= $pro_pic;
			$array[$i]['user_full_name'] 		= $user->data->display_name;
			$array[$i]['user_review_count'] 	= count_user_posts( $user_id , 'review' );
			$array[$i]['user_comment_count'] 	= 0;
			$array[$i]['author_url'] 			= get_author_posts_url( $user_id );
			$array[$i]['COMPANY_ID'] 			= $associated_company;
			$array[$i]['associated_companies'] 	= $company_title;
			$i++;
		endforeach;
		return $array;
	}
	else{
		return $array;
	}
}

require_once('wp_bootstrap_pagination.php');
function customize_wp_bootstrap_pagination($args) {
    $args['previous_string'] = 'previous';
    $args['next_string'] = 'next';
    return $args;
}
add_filter('wp_bootstrap_pagination_defaults', 'customize_wp_bootstrap_pagination');

/****
* This function will return all the information related to the company
****/
function get_company_review($company_id){
	$args = array(	'posts_per_page' => -1,
					'post_type'	=> 'review',
					'meta_key'     => 'REVIEW_COMPANYID',
					'meta_value'   => $company_id,
					'meta_compare' => '='
				);
	$i = 0;
	$returnArray 	= array( 'i_like' => array(), 'i_didnot_like' => array() );
	$ratingLocation = $ratingDP = $ratingA = $ratingW = $ratingS = $ratingPA = $ratingVM = $ratingER = $loss = array();
	$the_query 		= new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$review_id 	= get_the_ID();
			//An array of liked elements
			$iLiked 	= get_post_meta($review_id,'_i_liked',true);
			if( !empty($iLiked) ){
				$iLiked = explode(",", $iLiked);
				foreach ($iLiked as $key => $like) {
					if( !array_key_exists($like, $returnArray['i_like']) ){
						$returnArray['i_like'][$like] = 1;
					}
					else{
						$returnArray['i_like'][$like] = $returnArray['i_like'][$like] + 1;	
					}
				}
			}
			//An array of unliked elements
			$iUnLiked 	= get_post_meta($review_id,'_i_did_not_liked',true);
			if( !empty($iUnLiked) ){
				$iUnLiked = explode(",", $iUnLiked);
				foreach ($iUnLiked as $key => $unLike) {
					if( !array_key_exists($unLike, $returnArray['i_didnot_like']) ){
						$returnArray['i_didnot_like'][$unLike] = 1;
					}
					else{
						$returnArray['i_didnot_like'][$unLike] = $returnArray['i_didnot_like'][$unLike] + 1;	
					}
				}
			}				

			$returnArray['reviews'][$review_id]['review_title'] = get_the_title($review_id);
			$returnArray['reviews'][$review_id]['review_permalink'] = get_the_permalink($review_id);
			$returnArray['reviews'][$review_id]['rating_location'] = $ratingLocation[] = get_post_meta($review_id,'_location',true);
			$returnArray['reviews'][$review_id]['rating_diversity_product'] = $ratingDP[] = get_post_meta($review_id,'_diversity_of_products_or_services',true);
			$returnArray['reviews'][$review_id]['rating_advertised'] = $ratingA[] 	= get_post_meta($review_id,'_advertised_vs_delivered',true);
			$returnArray['reviews'][$review_id]['rating_website'] = $ratingW[] = get_post_meta($review_id,'_website',true);
			$returnArray['reviews'][$review_id]['rating_staff'] = $ratingS[] = get_post_meta($review_id,'_staff',true);
			$returnArray['reviews'][$review_id]['rating_price_affordability'] = $ratingPA[] = get_post_meta($review_id,'_price_affordability',true);
			$returnArray['reviews'][$review_id]['rating_value_for_money'] = $ratingVM[] = get_post_meta($review_id,'_value_for_money',true);
			$returnArray['reviews'][$review_id]['rating_exchange_refund'] = $ratingER[] = get_post_meta($review_id,'_exchange_refund_and_cancellation_policy',true);
			$returnArray['reviews'][$review_id]['i_liked'] = $iLiked;
			$returnArray['reviews'][$review_id]['i_did_not_liked'] = $iUnLiked;
			$returnArray['reviews'][$review_id]['tags'] = get_post_meta($review_id,'_tags',true);
			$returnArray['reviews'][$review_id]['other_companies'] = get_post_meta($review_id,'_what_were_other_companies_you_considered',true);
			$returnArray['reviews'][$review_id]['_value_of_loss'] = $loss[] = get_post_meta($review_id,'_value_of_loss',true);
			$returnArray['reviews'][$review_id]['ihpc_post_views'] = get_post_meta($review_id,'ihpc_post_views',true);
			$i++;	
		}
		//Calculations
		$returnArray['calculations']['average_location_ratting'] 	= array_sum($ratingLocation)/count($ratingLocation);
		$returnArray['calculations']['average_diversity_product_ratting'] = array_sum($ratingDP)/count($ratingDP);
		$returnArray['calculations']['average_advertised_ratting'] 	= array_sum($ratingA)/count($ratingA);
		$returnArray['calculations']['average_website_ratting'] 	= array_sum($ratingW)/count($ratingW);
		$returnArray['calculations']['average_staff_ratting'] 		= array_sum($ratingS)/count($ratingS);
		$returnArray['calculations']['average_price_affordability_ratting'] = array_sum($ratingPA)/count($ratingPA);
		$returnArray['calculations']['average_value_for_money_ratting'] = array_sum($ratingVM)/count($ratingVM);
		$returnArray['calculations']['average_exchange_refund_ratting'] = array_sum($ratingER)/count($ratingER);
		$sumOfAllRattings = array_merge($ratingLocation,$ratingDP,$ratingA,$ratingW,$ratingS,$ratingPA,$ratingVM,$ratingER);
		$returnArray['calculations']['star_ratting'] = array_sum($sumOfAllRattings)/count($sumOfAllRattings);
		$total_loss 	= array_sum($loss);
		$average_loss 	= array_sum($loss)/count($loss);
		$returnArray['calculations']['total_loss'] 	 = empty($total_loss) ? 0 : $total_loss;
		$returnArray['calculations']['average_loss'] = empty($average_loss) ? 0 : $average_loss;
		$returnArray['calculations']['total_loss_metric'] 	 = ihpc_human_number($total_loss,0,'metric');
		$returnArray['calculations']['average_loss_metric']  = ihpc_human_number($average_loss,0,'metric');
		wp_reset_postdata();
	}
	return $returnArray;
}

function ihpc_human_number($num, $places = 1, $type = 'human') {
	if ($type == 'metric') {
    	$k = 'K'; $m = 'M';
    } else {
    	$k = ' thousand'; $m = ' million';
    }
    if ($num < 1000) {
        $num_format = number_format($num);
    } else if ($num < 1000000) {
        $num_format = number_format($num / 1000, $places) . $k;
    } else {
        $num_format = number_format($num / 1000000, $places) . $m;
    }

    return $num_format;
}


function get_locations($postType){
	$args = array(	'posts_per_page' => -1,
					'post_type'	=> $postType,
					'meta_key' => 'company_location'
				);	
	$the_query 	= new WP_Query( $args );
	$array 		= array();
	$i = 0;
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$array[$i]['id'] 	   = get_the_ID();
			$array[$i]['location'] = get_post_meta(get_the_ID(),'company_location',true);
			$i++;
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		return $array;
	} 
}

function get_review_meta($review_id){
	$returnArray = array();	
	//Ratting fields
	$returnArray['rattings']['Location'] =  get_post_meta($review_id,'_location',true);
	$returnArray['rattings']['Diversity of Products or Services'] = get_post_meta($review_id,'_diversity_of_products_or_services',true);
	$returnArray['rattings']['Product or Service Quality'] = get_post_meta($review_id,'_product_or_service_quality',true);
	$returnArray['rattings']['Advertised vs Delivered'] = get_post_meta($review_id,'_advertised_vs_delivered',true);
	$returnArray['rattings']['Website'] = get_post_meta($review_id,'_website',true);
	$returnArray['rattings']['Staff'] = get_post_meta($review_id,'_staff',true);
	$returnArray['rattings']['Price Affordability'] = get_post_meta($review_id,'_price_affordability',true);
	$returnArray['rattings']['Value for money'] = get_post_meta($review_id,'_value_for_money',true);
	$returnArray['rattings']['Customer service'] = get_post_meta($review_id,'_customer_service',true);
	$returnArray['rattings']['Exchange, Refund and Cancellation Policy'] = get_post_meta($review_id,'_exchange_refund_and_cancellation_policy',true);
	//Liked fields
	$returnArray['fields']['I liked'] = get_post_meta($review_id,'_i_liked',true);
	$returnArray['fields']['I did not like'] = get_post_meta($review_id,'_i_did_not_liked',true);
	//Reviewer fields
	$returnArray['fields']['I am unhappy because of '] = get_post_meta($review_id,'_unhappy_because',true);
	$returnArray['fields']['I am happy because of'] = get_post_meta($review_id,'_happy_because',true);
	$returnArray['losses']['Value of your loss, $'] = get_post_meta($review_id,'_value_of_loss',true);
	$returnArray['losses']['So I want'] = get_post_meta($review_id,'_want',true);	
	return $returnArray;
}

/***
* Getting comment in ihpc format
****/
function ihpc_comment($comment, $args, $depth){
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); 
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
    </div>
    <div class="comment-author vcard">
        <div class="comment_author_image">
        	<?php
        	$authorID = get_comment_author( $comment->comment_ID );
        	$pro_pic  = get_field('user_profile_pic','user_'.$authorID);
			if( !empty($pro_pic) ){				
				echo "<img src='$pro_pic' class='avatar avatar-128 photo avatar-default' height='128' width='128' />";
			}
			else if( $args['avatar_size'] != 0 ){
				echo get_avatar( $comment, $args['avatar_size'] );
			}
    		?>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
	        <div><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em></div>
	    <?php endif; ?>  
	    <div class="comment_body"><?php comment_text(); ?></div>
    </div>    
    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}