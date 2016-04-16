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

    register_nav_menus(array(
        'footer' => __('Footer Menu'),
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

	wp_enqueue_style('flexslider', get_template_directory_uri() . '/stylesheets/flexslider.css');

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
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", array(), false, true);
	wp_enqueue_script('jquery');

	wp_register_script('jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), false, true);

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
/*Register services post type*/
add_action('init', 'gh_exam_services');
function gh_exam_services()
{
    register_post_type('services', array(
        'public' => true,
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields'
        ),
        'labels' => array(
            'name' => __('Services', 'gh_exam'),
            'add_new' => __('Add new services', 'gh_exam'),
            'all_items' => __('All services', 'gh_exam')
        )
    ));
}
add_action('init', 'services_taxonomies', 0);
/*register services taxonomies*/
function services_taxonomies()
{
    register_taxonomy(
        'services_cats',
        'services',
        array(
            'labels' => array(
                'name' => 'Services categories',
                'add_new_item' => 'Add New services',
                'new_item_name' => "New services"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
/*Register clients post type*/
add_action('init', 'gh_exam_clients');
function gh_exam_clients()
{
    register_post_type('clients', array(
        'public' => true,
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields'
        ),
        'labels' => array(
            'name' => __('Clients', 'gh_exam'),
            'add_new' => __('Add new clients', 'gh_exam'),
            'all_items' => __('All clients', 'gh_exam')
        )
    ));
}
add_action('init', 'clients_taxonomies', 0);
/*register clients taxonomies*/
function clients_taxonomies()
{
    register_taxonomy(
        'clients_cats',
        'clients',
        array(
            'labels' => array(
                'name' => 'Clients categories',
                'add_new_item' => 'Add New clients',
                'new_item_name' => "New clients"
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
	$social_sites = array('facebook', 'google-plus', 'twitter' , 'youtube', 'linkedin', 'pinterest', 'dribbble', 'flickr', 'tumblr', 'rss', 'instagram', 'email');
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
		'default' => get_bloginfo('template_directory') . '/images/businessplus_logo.png',
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
function gh_exam_fields_customize_register( $wp_customize ){

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
add_action( 'customize_register', 'gh_exam_fields_customize_register' );


function gh_exam_header_fields_customize_register( $wp_customize )
{

        $wp_customize->add_section('phone_data'
            , array(
                'title' => __('Phone data', 'gh_exam'),
                'priority' => 119
            ));
        $wp_customize->add_setting('phone', array(
            'default' => '+9978 8856 999',
            'transport' => 'refresh'
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mail-input', array(
            'label' => __('Phone', 'gh_exam'),
            'section' => 'phone_data',
            'settings' => 'phone',
            'priority' => 1
        )));
        /*------------------------------------------------*/
    }
    add_action( 'customize_register', 'gh_exam_header_fields_customize_register' );

/*-------------------*/
//About us
add_action( 'customize_register', 'gh_exam_fields_customize_register' );


function gh_exam_about_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('about_data'
        , array(
            'title' => __('About data', 'gh_exam'),
            'priority' => 200
        ));
    $wp_customize->add_setting('title', array(
        'default' => 'About title',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('title_sign', array(
        'default' => 'About title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('about_content', array(
        'default' => 'About content',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'title-input', array(
        'label' => __('About title', 'gh_exam'),
        'section' => 'about_data',
        'settings' => 'title',
        'priority' => 1
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'title-sign-input', array(
        'label' => __('About title sign', 'gh_exam'),
        'section' => 'about_data',
        'settings' => 'title_sign',
        'priority' => 2
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'about-contant-input', array(
        'label' => __('About contant', 'gh_exam'),
        'section' => 'about_data',
        'settings' => 'about_content',
        'priority' => 3
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_about_fields_customize_register' );

/*--------------------------*/
//Services
function gh_exam_services_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('services_data'
        , array(
            'title' => __('Services data', 'gh_exam'),
            'priority' => 210
        ));
    $wp_customize->add_setting('services_title', array(
        'default' => 'services title',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('services_title_sign', array(
        'default' => 'Servces title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'services-title-input', array(
        'label' => __('Services title', 'gh_exam'),
        'section' => 'services_data',
        'settings' => 'services_title',
        'priority' => 1
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'services-title-sign-input', array(
        'label' => __('Aboservices title sign', 'gh_exam'),
        'section' => 'services_data',
        'settings' => 'services_title_sign',
        'priority' => 2
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_services_fields_customize_register' );
/*--------------------------*/
//Klients
function gh_exam_clients_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('clients_data'
        , array(
            'title' => __('Clients data', 'gh_exam'),
            'priority' => 211
        ));
    $wp_customize->add_setting('clients_title', array(
        'default' => 'clients title',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('clients_title_sign', array(
        'default' => 'Clients title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'clients-title-input', array(
        'label' => __('Clients title', 'gh_exam'),
        'section' => 'clients_data',
        'settings' => 'clients_title',
        'priority' => 1
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'clients-title-sign-input', array(
        'label' => __('Clients title sign', 'gh_exam'),
        'section' => 'clients_data',
        'settings' => 'clients_title_sign',
        'priority' => 2
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_clients_fields_customize_register' );
/*--------------------------*/
//Klients
function gh_exam_news_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('news_data'
        , array(
            'title' => __('News data', 'gh_exam'),
            'priority' => 211
        ));
    $wp_customize->add_setting('news_title', array(
        'default' => 'news title',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('news_title_sign', array(
        'default' => 'News title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'news-title-input', array(
        'label' => __('News title', 'gh_exam'),
        'section' => 'news_data',
        'settings' => 'news_title',
        'priority' => 1
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'news-title-sign-input', array(
        'label' => __('News title sign', 'gh_exam'),
        'section' => 'news_data',
        'settings' => 'news_title_sign',
        'priority' => 2
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_news_fields_customize_register' );
/*--------------------------*/
//Partners
function gh_exam_partners_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('partners_data'
        , array(
            'title' => __('Partners data', 'gh_exam'),
            'priority' => 212
        ));
    $wp_customize->add_setting('partners_title', array(
        'default' => 'partners title',
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('partners_title_sign', array(
        'default' => 'Partners title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'partners-title-input', array(
        'label' => __('Partners title', 'gh_exam'),
        'section' => 'partners_data',
        'settings' => 'partners_title',
        'priority' => 1
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'partners-title-sign-input', array(
        'label' => __('Partners title sign', 'gh_exam'),
        'section' => 'partners_data',
        'settings' => 'partners_title_sign',
        'priority' => 2
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_partners_fields_customize_register' );
//Footernav
function gh_exam_footer_nav_fields_customize_register( $wp_customize )
{

	$wp_customize->add_section('footer_data'
		, array(
			'title' => __('Footer data', 'gh_exam'),
			'priority' => 214		));
	$wp_customize->add_setting('footer_title', array(
		'default' => 'Footer title',
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer-nav-title-input', array(
		'label' => __('Footer nav title', 'gh_exam'),
		'section' => 'footer_data',
		'settings' => 'footer_title',
		'priority' => 1
	)));
	/*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_footer_nav_fields_customize_register' );
//Contact-title
function gh_exam_contact_form_fields_customize_register( $wp_customize )
{

	$wp_customize->add_section('contact_form_data'
		, array(
			'title' => __('Contact form data', 'gh_exam'),
			'priority' => 214		));
	$wp_customize->add_setting('contact_form_title', array(
		'default' => 'Contact form title',
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'contact-form-title-input', array(
		'label' => __('Contact form title', 'gh_exam'),
		'section' => 'contact_form_data',
		'settings' => 'contact_form_title',
		'priority' => 1
	)));
	/*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_contact_form_fields_customize_register' );
//Blog
function gh_exam_blog_fields_customize_register( $wp_customize )
{

    $wp_customize->add_section('blog_data'
        , array(
            'title' => __('Blog data', 'gh_exam'),
            'priority' => 231
        ));
    $wp_customize->add_setting('blog_title_sign', array(
        'default' => 'blog title sign',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog-title-sign-input', array(
        'label' => __('Blog title sign', 'gh_exam'),
        'section' => 'blog_data',
        'settings' => 'blog_title_sign',
        'priority' => 1
    )));
    /*------------------------------------------------*/
}
add_action( 'customize_register', 'gh_exam_blog_fields_customize_register' );
/*__________________________________________________*/
/*create slider post type*/
add_action('init', 'create_slider_post_type');

function create_slider_post_type()
{
	register_post_type('slider',
		array(
			'labels' => array(
				'name' => __('Header Slider'),
				'singular_name' => __('Header Slider')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider'),
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
}

/*__________________________________________________*/
/*create slider taxonomy*/
add_action('init', 'create_my_slider_tax');

function create_my_slider_tax()
{
	register_taxonomy(
		'slider_type',
		'slider',
		array(
			'label' => __('Slider type'),
			'rewrite' => array('slug' => 'slider_type'),
			'hierarchical' => true,
		)
	);
}

/*create partners post type*/
add_action('init', 'create_partners_post_type');

function create_partners_post_type()
{
    register_post_type('partners',
        array(
            'labels' => array(
                'name' => __('Partners'),
                'singular_name' => __('partners')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'partners'),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}

/*__________________________________________________*/
/*create partners taxonomy*/
add_action('init', 'create_my_partners_tax');

function create_my_partners_tax()
{
    register_taxonomy(
        'news_type',
        'news',
        array(
            'label' => __('Partners type'),
            'rewrite' => array('slug' => 'partners_type'),
            'hierarchical' => true,
        )
    );
}
/*---------------------------------*/
/*------Feedback form------*/
/*---------------------------------*/
function custom_form_action_callback() {
    global $wpdb;
    global $mail;
    $nonce=$_POST['nonce'];
    $rtr='';
    if (!wp_verify_nonce( $nonce, 'custom_form_action-nonce'))wp_die('{"error":"Error. Spam"}');
    $message="";
    $to="shuterrush@gmail.com";
    $headers = "Content-type: text/html; charset=utf-8 \r\n";
    $headers.= "From: ".$_SERVER['SERVER_NAME']." \r\n";
    $subject="Message from site ".$_SERVER['SERVER_NAME'];
    do_action('plugins_loaded');
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mess']) ){
        $message.="Name: ".$_POST['name'];
        $message.="<br/>E-mail: ".$_POST['email'];
        $message.="<br/>Message:<br/>".nl2br($_POST['mess']);
        if(mail($to, $subject, $message, $headers)){
            $rtr='{"work":"Message send!","error":""}';
        }else{
            $rtr='{"error":"Server error."}';
        }
    }else{
        $rtr='{"error":"All fields are required!"}';
    }
    echo $rtr;
    exit;
}
add_action('wp_ajax_nopriv_custom_form_send_action', 'custom_form_action_callback');
add_action('wp_ajax_custom_form_send_action', 'custom_form_action_callback');
function custom_form_stylesheet(){
    wp_enqueue_style("custom_form_style_templ",get_bloginfo('stylesheet_directory')."/style.css","0.1.2",true);
    wp_enqueue_script("custom_form_script_temp",get_bloginfo('stylesheet_directory')."/js//scriptform.js");
    wp_localize_script("custom_form_script_temp", "custom_form_Ajax", array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce('custom_form_action-nonce') ) );
}
add_action( 'wp_enqueue_scripts', 'custom_form_stylesheet' );
function formCustom() {
    $rty.='<div class="contact">';
    $rty.='<form class="contact-form">';
    $rty.='<h2>Send a message</h2>';
    $rty.='<div class="form-group"><input id="name" class="form-control" type="text" placeholder="Name"/></div>';
    $rty.='<div class="form-group"><input id="email" type="text" class="form-control" placeholder="Email"/></div>';
    $rty.='<div class="form-group"><textarea id="mess" class="form-control"></textarea></div>';
    $rty.='<button type="submit"  data-text="SUBMIT" class="button button-default" onclick="custom_form_ajax_send(\'#name\',\'#email\',\'#mess\'); return false;"><span>SUBMIT NOV</span></button>';
    $rty.='</form>';
    $rty.='<div id="response"></div>';
    $rty.='</div>';
    return $rty;
}
add_shortcode( 'formCustom', 'formCustom' );

/*__________________________________________________________*/
/*create Blog images in theme customize*/
/*_____________________________________*/

function gootheme_blog_theme_customizer($wp_customize)
{

    $wp_customize->add_section('gootheme_blog_section', array(
        'title' => __('Blog background images', 'gootheme_blog'),
        'priority' => 30,
        'description' => 'Upload a images for this theme',
    ));

    $wp_customize->add_setting('gootheme_blog', array(
        'default' => get_bloginfo('template_directory') . '/images/2-layers.png',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gootheme_blog_bg', array(

        'label' => __('Currentblog background images', 'gootheme_blog'),
        'section' => 'gootheme_blog_section',
        'settings' => 'gootheme_blog',
    )));

}

add_action('customize_register', 'gootheme_blog_theme_customizer');
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
