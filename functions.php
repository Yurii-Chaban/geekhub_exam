<?php
/**
 * Geekhub-exam functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Geekhub-exam
 */

if ( ! function_exists( 'gh_exam_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gh_exam_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Geekhub-exam, use a find and replace
	 * to change 'gh_exam' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gh_exam', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'gh_exam' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gh_exam_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'gh_exam_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gh_exam_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gh_exam_content_width', 640 );
}
add_action( 'after_setup_theme', 'gh_exam_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gh_exam_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gh_exam' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gh_exam' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gh_exam_widgets_init' );

//__________________________________________________________________
//Theme setup
function my_theme_setup()
{
	//Navigation Menus

	register_nav_menus(array(
		'primary' => __('Primary Menu'),
	));
	// Add feature image support
	add_theme_support('post-thumbnails');
}
/**
 * Enqueue scripts and styles.
 */
function gh_exam_scripts() {

	/*-----------------------*/
	/*styles*/
	/*-----------------------*/

	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	wp_enqueue_style('rex_style', get_template_directory_uri() . '/stylesheets/screen.css');


	/*-----------------------*/
	/*scripts*/
	/*-----------------------*/

	wp_enqueue_style( 'gh_exam-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gh_exam-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_register_script('isotope', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js", array(), false, true);

	wp_enqueue_script( 'gh_exam-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_enqueue_script('jquery');

	wp_deregister_script( 'isotope' );
	wp_register_script( 'isotope', "http" . ( $_SERVER['SERVER_PORT'] == 443 ? "s" : "" ) . "://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js",  array(), false, true );
	wp_enqueue_script( 'isotope' );
	//general
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js',  array(), false, true );
	wp_enqueue_script( 'main' );
}
add_action( 'wp_enqueue_scripts', 'gh_exam_scripts' );
/*----------------------------------------------------*/
/*Register gallery post type*/
add_action('init', 'gh_exam_gallery');
function gh_exam_gallery()
{
	register_post_type('gallery', array(
		'public' => true,
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'custom-fields'
		),
		'labels' => array(
			'name' => __('Gallery', 'gh_exam'),
			'add_new' => __('Add new gallery', 'gh_exam'),
			'all_items' => __('All gallery', 'gh_exam')
		)
	));
}
add_action('init', 'gallery_taxonomies', 0);
/*register Gallery taxonomies*/
function gallery_taxonomies()
{
	register_taxonomy(
		'gallery_cats',
		'gallery',
		array(
			'labels' => array(
				'name' => 'Gallery categories',
				'add_new_item' => 'Add New Category',
				'new_item_name' => "New Category"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
/*____________________________________________________________________________________*/
//Add social icons
function my_customizer_social_media_array()
{
	$social_sites = array('facebook', 'twitter' , 'google-plus', 'youtube', 'linkedin', 'pinterest', 'dribbble', 'flickr', 'tumblr', 'rss', 'instagram', 'email');
	return $social_sites;
}

add_action('customize_register', 'my_add_social_sites_customizer');

function my_add_social_sites_customizer($wp_customize)
{

	$wp_customize->add_section('my_social_settings', array(
		'title' => __('Social Media Icons', 'gh_exam'),
		'priority' => 35,
	));

	$social_sites = my_customizer_social_media_array();
	$priority = 5;

	foreach ($social_sites as $social_site) {

		$wp_customize->add_setting("$social_site", array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($social_site, array(
			'label' => __("$social_site url:", 'gh_exam'),
			'section' => 'my_social_settings',
			'type' => 'text',
			'priority' => $priority,
		));

		$priority = $priority + 5;
	}
}

function my_social_media_icons()
{
	$social_sites = my_customizer_social_media_array();
	foreach ($social_sites as $social_site) {
		if (strlen(get_theme_mod($social_site)) > 0) {
			$active_sites[] = $social_site;
		}
	}
	if (!empty($active_sites)) {
		echo "<ul class='social-icons'>";
		foreach ($active_sites as $active_site) {
			$class = 'fa fa-' . $active_site;
			if ($active_site == 'email') {
				?>
				<li>
					<a class="email" target="_blank"
					   href="mailto:<?php echo antispambot(is_email(get_theme_mod($active_site))); ?>">
						<span class="fa fa-envelope" title="<?php _e('email icon', 'gh_exam'); ?>"></span>
					</a>
				</li>
			<?php } else { ?>
				<li>
					<a class="<?php echo $active_site; ?>" target="_blank"
					   href="<?php echo esc_url(get_theme_mod($active_site)); ?>">
                        <span class="<?php echo esc_attr($class); ?>"
							  title="<?php printf(__('%s icon', 'gh_exam'), $active_site); ?>"></span>
					</a>
				</li>
				<?php
			}
		}
		echo "</ul>";
	}
}
/*--------------------------------------------------------------------*/
/*Copyright*/
add_action('customize_register', function ($customizer) {
	$customizer->add_section(
		'edits-copyright',
		array(
			'title' => 'Copyright',
			'description' => 'Edit',
			'priority' => 35,
		)
	);
	$customizer->add_setting(
		'copyright_name',
		array('default' => 'geekhub-exam.esy.es')
	);
	$customizer->add_control(
		'copyright_name',
		array(
			'label' => 'GeekHub exam',
			'section' => 'edits-copyright',
			'type' => 'text',
		)
	);
	$customizer->add_setting(
		'copyright_year',
		array('default' => '2016')
	);
	$customizer->add_control(
		'copyright_year',
		array(
			'label' => 'Year',
			'section' => 'edits-copyright',
			'type' => 'text',
		)
	);
	$customizer->add_control(
		'hide_copyright',
		array(
			'type' => 'checkbox',
			'label' => 'Hide text copyright',
			'section' => 'edit-copyright',
		)
	);
});
/*__________________________________________________________*/
/*create logo in theme customize*/
/*_____________________________________*/
function geekhub_theme_customizer($wp_customize)
{

	$wp_customize->add_section('geekhub_logo_section', array(
		'title' => __('Site logo', 'geekhub'),
		'priority' => 30,
		'description' => 'Upload a logo for this theme',
	));

	$wp_customize->add_setting('geekhub_logo', array(
		'default' => get_bloginfo('template_directory') . '/images/default-logo.png',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'geekhub_logo', array(

		'label' => __('Current logo', 'geekhub'),
		'section' => 'geekhub_logo_section',
		'settings' => 'geekhub_logo',
	)));

}

add_action('customize_register', 'geekhub_theme_customizer');

/*------------------------------------------------*/
/* data customizer */
function gh_exam_lields_customize_register( $wp_customize ){

$wp_customize->add_section('contact_data'
	, array(
		'title' => __('Contact data', 'gh_exam'),
		'priority' => 120
	));
$wp_customize->add_setting('mail', array(
	'default' => 'mail@host.com',
	'transport' => 'refresh'
));
$wp_customize->add_setting('address', array(
	'default' => 'Street City 123',
	'transport' => 'refresh'
));
$wp_customize->add_setting('name', array(
	'default' => 'LExa Lexa',
	'transport' => 'refresh'
));
$wp_customize->add_setting('address-iframe', array(
	'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m8!1m3!1d6303.67022361714!2d144.955652!3d-37.817331!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m0!4m3!3m2!1d-37.8173306!2d144.9556518!5e0!3m2!1sen!2sbd!4v1442411159706" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>',
	'transport' => 'refresh'
));
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mail-input', array(
	'label' => __('Email', 'gh_exam'),
	'section' => 'contact_data',
	'settings' => 'mail',
	'priority' => 1
)));
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'name-input', array(
	'label' => __('Name', 'gh_exam'),
	'section' => 'contact_data',
	'settings' => 'name',
	'priority' => 1
)));
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address-input', array(
	'label' => __('Address', 'gh_exam'),
	'section' => 'contact_data',
	'settings' => 'address',
	'priority' => 1
)));
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address-iframe', array(
	'label' => __('Google maps iframe', 'gh_exam'),
	'section' => 'contact_data',
	'settings' => 'address-iframe',
	'priority' => 1
)));
/*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_lields_customize_register' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
