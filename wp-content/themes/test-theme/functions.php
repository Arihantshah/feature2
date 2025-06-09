<?php
/**
 * Test Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Test_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Test Theme, use a find and replace
		* to change 'test-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'test-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'test_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'test_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function test_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'test_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'test_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function test_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'test-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'test-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'test_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function test_theme_scripts() {
	wp_enqueue_style( 'test-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'test-theme-style', 'rtl', 'replace' );
	wp_enqueue_style( 'test-theme-bootstrap', get_template_directory_uri().'/css/bootstrap/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-bootstrap-icon', get_template_directory_uri().'/css/bootstrap-icons/bootstrap-icons.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-font', get_template_directory_uri().'/css/fontawesome-free/css/all.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-glight', get_template_directory_uri().'/css/glightbox/css/glightbox.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-swiper', get_template_directory_uri().'/css/swiper/swiper-bundle.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-aos', get_template_directory_uri().'/css/aos/aos.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-custom', get_template_directory_uri().'/css/custom.css', array(), _S_VERSION );

	wp_enqueue_script( 'test-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-bootstap-min', get_template_directory_uri() . '/css/bootstrap/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-pure', get_template_directory_uri() . '/css/purecounter/purecounter_vanilla.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-glightbox', get_template_directory_uri() . '/css/glightbox/js/glightbox.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-swipe', get_template_directory_uri() . '/css/swiper/swiper-bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-aos', get_template_directory_uri() . '/css/aos/aos.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-validate', get_template_directory_uri() . '/css/php-email-form/validate.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'test-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'test_theme_scripts' );

function test_theme_admin_scripts() {
	// wp_enqueue_style( 'test-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'test-theme-style', 'rtl', 'replace' );
	// wp_enqueue_style( 'test-theme-bootstrap', get_template_directory_uri().'/css/bootstrap/css/bootstrap.min.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-custom', get_template_directory_uri().'/css/custom.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-bootstrap-icon', get_template_directory_uri().'/css/bootstrap-icons/bootstrap-icons.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-font', get_template_directory_uri().'/css/fontawesome-free/css/all.min.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-glight', get_template_directory_uri().'/css/glightbox/css/glightbox.min.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-swiper', get_template_directory_uri().'/css/swiper/swiper-bundle.min.css', array(), _S_VERSION );
	// wp_enqueue_style( 'test-theme-aos', get_template_directory_uri().'/css/aos/aos.css', array(), _S_VERSION );
	wp_enqueue_style( 'test-theme-tab-css', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css', array(), _S_VERSION );


	// wp_enqueue_script( 'test-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-bootstap-min', get_template_directory_uri() . '/css/bootstrap/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-pure', get_template_directory_uri() . '/css/purecounter/purecounter_vanilla.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-glightbox', get_template_directory_uri() . '/css/glightbox/js/glightbox.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-swipe', get_template_directory_uri() . '/css/swiper/swiper-bundle.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-aos', get_template_directory_uri() . '/css/aos/aos.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-validate', get_template_directory_uri() . '/css/php-email-form/validate.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'test-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery'), _S_VERSION, true );
	// wp_enqueue_script( 'test-theme-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'test-theme-tab', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'admin_enqueue_scripts', 'test_theme_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_action('admin_menu', 'my_menu_pages');
function my_menu_pages(){
    add_menu_page('Theme Option', 'Theme Setting', 'manage_options', 'theme-option', 'theme_setting' );
   
}


function theme_setting()
{ 
		if(isset($_POST['save_form']))
		{
			$filename = $_FILES["logo_custom"]["name"];
    		$tempname = $_FILES["logo_custom"]["tmp_name"];  
        	$folder = get_template_directory_uri().'/img/'.$filename;
        	move_uploaded_file($filename, $folder);
        	$phone_number = $_POST['phoneno'];
        	$email = $_POST['email'];
        	$fax_no = $_POST['fax_number'];
        	$address = $_POST['address'];
        	update_option('cusotm_logo',$filename);
        	update_option('cusotm_phone_no',$phone_number);
        	update_option('cusotm_email',$email);
        	update_option('cusotm_fax_no',$fax_no);
        	update_option('cusotm_address',$address);

		}

		$image = get_option('cusotm_logo');
		$phoneno = get_option('cusotm_phone_no');
		$custom_email = get_option('cusotm_email');
		$custom_fax_no = get_option('cusotm_fax_no');
		$custom_address = get_option('cusotm_address');

	?>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Header</a></li>
			<li><a href="#tabs-2">Footer</a></li>
		</ul>
  		<div id="tabs-1">
	    	<h1>Header</h1>
	    	<form method="post" enctype= multipart/form-data>
			  <div class="form-row">
			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Logo</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="logo_custom" value="<?php echo get_template_directory_uri().'/img/'.$image;?>">
			  </div>
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Phone</label>
			      <input type="number" class="form-control" id="inputPhone4" placeholder="Enter Phone Number" name="phoneno" value="<?php echo $phoneno;?>">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputEmail4">Email</label>
			      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="<?php echo $custom_email;?>">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputEmail4">Fax Number</label>
			      <input type="number" class="form-control" id="inputEmail4" placeholder="Fax Number" name="fax_number" value="<?php echo $custom_fax_no;?>">
			    </div>
			    <div class="form-group">
			      <label for="inputEmail4">Adress</label>
			      <input type="text" class="form-control" id="inputAdress" placeholder="Adress" name="address" value="<?php echo $custom_address;?>">
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary" name="save_form">Save</button>
			</form>	
  		</div>
  		<div id="tabs-2">
    
  		</div>
	</div>

<?php }
