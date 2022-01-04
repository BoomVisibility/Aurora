<?php

/**
 * Aurora functions and definitions.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Aurora supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Aurora 1.0
 */

function aurora_setup() {
	/*
	 * Makes Aurora available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Aurora, use a find and replace
	 * to change 'aurora' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aurora', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	register_nav_menu( 'primary', __( 'Primary Menu', 'aurora' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'aurora' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */

	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}

add_action( 'after_setup_theme', 'aurora_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Aurora 1.0
 */

function aurora_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'aurora-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'aurora-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'aurora-ie', get_template_directory_uri() . '/css/ie.css', array( 'aurora-style' ), '20121010' );
	$wp_styles->add_data( 'aurora-ie', 'conditional', 'lt IE 9' );
}

add_action( 'wp_enqueue_scripts', 'aurora_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Aurora 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */

function aurora_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'aurora' ), max( $paged, $page ) );
	return $title;
}

add_filter( 'wp_title', 'aurora_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Aurora 1.0
 */

function aurora_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}

add_filter( 'wp_page_menu_args', 'aurora_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Aurora 1.0
 */

function aurora_widgets_init() {
	register_sidebar( array(
	  'name' => __( 'Alert', 'aurora' ),
	  'id' => 'alert',
	  'description' => __( 'Appears on the top of all pages', 'aurora' ),
	  'before_widget' => '<section id="alert" class="alert"><div class="container">',
	  'after_widget' => '</div></section>',
	  'before_title' => '<h2 class="textalign-center">',
	  'after_title' => '</h3>',
	) );

	register_sidebar( array(
	  'name' => __( 'Main Sidebar', 'aurora' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'aurora' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Call to Action Widget Area', 'aurora' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears in the bottom of the website', 'aurora' ),
		'before_widget' => '<div id="call-to-action"><div class="container"><div class="blue-box">',
		'after_widget' => '</div></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Schedule Widget Area', 'aurora' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears at the bottom of the website', 'aurora' ),
		'before_widget' => '<section id="schedule"><div class="container textalign-center">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'aurora_widgets_init' );

/* Security Headers */
function tg_enable_strict_transport_security_hsts_header_wordpress() {
    header( 'Strict-Transport-Security: max-age=10886400; includeSubDomains; preload' );
		header( 'X-XSS-Protection: 1; mode=block' );
		header( 'X-Frame-Options: sameorigin' );
		header( 'X-Content-Type-Options: nosniff' );
		header( 'Content-Security-Policy: upgrade-insecure-requests' );
}
add_action( 'send_headers', 'tg_enable_strict_transport_security_hsts_header_wordpress' );

if ( ! function_exists( 'aurora_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Aurora 1.0
 */

function aurora_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'aurora' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'aurora' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'aurora' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'aurora_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own Aurora_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Aurora 1.0
 */

function aurora_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'aurora' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'aurora' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'aurora' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'aurora' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aurora' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'aurora' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'aurora' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'aurora_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own Aurora_entry_meta() to override in a child theme.
 *
 * @since Aurora 1.0
 */

function aurora_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'aurora' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'aurora' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'aurora' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'aurora' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'aurora' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'aurora' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Aurora 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */

function aurora_body_class( $classes ) {
	$background_color = get_background_color();
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
	if ( has_post_thumbnail() )
		$classes[] = 'has-post-thumbnail';
	if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
		$classes[] = 'two-sidebars';
	}
	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'aurora-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	return $classes;
}

add_filter( 'body_class', 'aurora_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Aurora 1.0
 */

function aurora_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}

add_action( 'template_redirect', 'aurora_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Aurora 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */

function aurora_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}

add_action( 'customize_register', 'aurora_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Aurora 1.0
 */

function aurora_customize_preview_js() {
	wp_enqueue_script( 'aurora-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}

add_action( 'customize_preview_init', 'aurora_customize_preview_js' );

/**add scripts to header*/
function my_scripts_method() {
	wp_enqueue_script(
		'easing',
		'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
		array( 'jquery' ),
		1.1,
		true
	);

	wp_enqueue_script(
		'custom-slider',
		get_template_directory_uri() . '/js/jquery.bxslider.min.js',
		array( 'jquery' )
	);

	wp_enqueue_script(
		'image-lightbox',
		get_template_directory_uri() . '/js/imagelightbox.js',
		array( 'jquery' ),
		1.1,
		true
	);

	wp_enqueue_script(
		'nav-menu',
		get_template_directory_uri() . '/js/jquery.slicknav.js',
		array( 'jquery' ),
		1.1,
		true
	);

	wp_enqueue_script(
		'modernizer',
		get_template_directory_uri() . '/js/modernizr.min.js',
		array( 'jquery' ),
		1.1,
		true
	);

	wp_enqueue_script(
		'custom',
		get_template_directory_uri() . '/js/custom.js',
		array( 'jquery' ),
		1.1,
		true
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css' ); //our stylesheet

/**custom post type for slider*/
register_post_type('slides', array(
'label' => __('Slides'),
'singular_label' => __('Slides'),
'public' => true,
'show_ui' => true,
'capability_type' => 'post',
'hierarchical' => false,
'rewrite' => false,	'query_var' => true,
'menu_icon' => 'dashicons-images-alt2',
'exclude_from_search' => true,
'supports' => array('title', 'editor', 'thumbnail'),
'taxonomies' => array( 'post_tag')
));

register_post_type('faq', array(
'label' => __('FAQs'),
'singular_label' => __('FAQ'),
'public' => true,
'show_ui' => true,
'has_archive' => true,
'capability_type' => 'post',
'hierarchical' => false,
'rewrite' => true,
'query_var' => true,
'menu_icon' => 'dashicons-admin-comments',
'supports' => array('title', 'editor', 'thumbnail'),
'taxonomies' => array( 'post_tag')
));


/**add slider thumbnail size*/
if ( function_exists( 'add_image_size' ) ) {
	//add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'homepage-slider', 1600, 915, true ); //(cropped)
	add_image_size( 'service-image', 450, 300, true ); //(cropped)
	add_image_size( 'blog-thumb', 360, 360, true ); //(cropped)
	add_image_size( 'bio', 300, 400, true ); //(cropped)
}

add_filter('image_size_names_choose', 'my_image_sizes');
	function my_image_sizes($sizes) {
		$addsizes = array(
		"blog-thumb" => __( "Medium Square")
		);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function iljs_mod_tags ($content) {
   global $post;
   $type="f"; // the type of imagelightbox, f: combined
   $pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
   $replacement = '<a$1href=$2$3.$4$5$6 data-imagelightbox="'.$type.'">';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}

// adds the filter for image galleries
add_filter('wp_get_attachment_link','iljs_mod_tags');

// adds the filter for single content images
add_filter('the_content', 'iljs_mod_tags');

function custom_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//add columns shortcodes

function webtreats_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');

function webtreats_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');

function webtreats_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');

function webtreats_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');

function webtreats_one_half( $atts, $content = null ) {
   return '<div class="half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');

function webtreats_one_half_last( $atts, $content = null ) {
   return '<div class="half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');

function webtreats_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');

function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');

function webtreats_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');

function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

function webtreats_blue_box( $atts, $content = null ) {
   return '<div class="gloss-box">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('blue_box', 'webtreats_blue_box');

function webtreats_block( $atts, $content = null ) {
   return '<div class="block">' . do_shortcode($content) . '</div>';
}
add_shortcode('block', 'webtreats_block');

function webtreats_box( $atts, $content = null ) {
   return '<div class="box">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('box', 'webtreats_box');

function webtreats_accordion( $atts, $content = null ) {
   return '<div class="accordion">' . do_shortcode($content) . '</div>';
}
add_shortcode('accordion', 'webtreats_accordion');


function webtreats_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

header('Set-Cookie: cross-site-cookie=bar; SameSite=None; Secure');

// pagination on archive pages
function wpbeginner_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}

//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
wp_enqueue_style( 'dashicons' );
}
