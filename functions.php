<?php

function add_theme_scripts() {
 
  wp_enqueue_style( 'cmswebdesign-font-awesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), '', 'all');
  wp_enqueue_style( 'cmswebdesign-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '', 'all');
  wp_enqueue_style( 'cmswebdesign-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), '', 'all');
  wp_enqueue_style( 'cmswebdesign-tablet-style', get_template_directory_uri() . '/assets/css/smaller-screens.css', array(), '', 'all');
  wp_enqueue_style( 'cmswebdesign-spinner-style', get_template_directory_uri() . '/assets/css/spinner.css', array(), '', 'all');
  
  wp_enqueue_script( 'cmswebdesign-main-script', get_template_directory_uri() . '/assets/js/main-script.js', array ( 'jquery', 'jquery-effects-slide' ), '', true);

  // This will output a script data in the html which can be used in other javascript scripts
  wp_localize_script('cmswebdesign-main-script', 'cmsstarterData', array(
    'root_url' => get_site_url(),
  ));   
  
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * #.# Theme supports
 * 
 */

add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo');
add_theme_support( 'post-thumbnails');
add_theme_support( 'widgets');
add_theme_support( 'html5');

/**
 * #.# Register nav menu's
 * 
 */

function cmswebdesign_register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' )
    )
  );
}
add_action( 'init', 'cmswebdesign_register_menus' );

/**
 * #.# Declare woocommerce support
 * 
 */

function cmswebdesign_add_woocommerce_support() {
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'cmswebdesign_add_woocommerce_support' );

// Remove breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/**
 * #.# Show cart contents / total Ajax
 * 
 */
function cmswebdesign_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<!-- <span class="items"><?php // echo WC()->cart->get_cart_contents_count(); ?></span> -->
	<span class="items"><?php echo WC()->cart->get_cart_total(); ?></span>
	<?php
	$fragments['span.items'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'cmswebdesign_woocommerce_header_add_to_cart_fragment' );

/**
 * #.# Show product category above product title
 * 
 */

function cmswebdesign_category_single_product(){

  $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );

  if ( $product_cats && ! is_wp_error ( $product_cats ) ){

      $single_cat = array_shift( $product_cats ); ?>

      <p itemprop="name" class="product_category_title"><span><?php echo $single_cat->name; ?></span></p>

<?php }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'cmswebdesign_category_single_product', 25 );


/**
 * #.# Show sidebar on woocommerce shop pages
 * 
 */
// define the woocommerce_sidebar callback 
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar'); 

function cmswebdesign_custom_shop_page_siderbar() {
  echo '<div id="shop-page-sidebar" class="sidebar">';
  dynamic_sidebar( 'shop-page-sidebar' );
  echo '</div>';
}
add_action( 'woocommerce_sidebar', 'cmswebdesign_custom_shop_page_siderbar');


/*
* #.# Sidebar drawer
*
*/

function cmswebdesign_add_sidebar_button() {

  echo '<button class="sidebar-drawer-button"><i class="fa-solid fa-sliders"></i> Filter</button>';

}
add_action('woocommerce_before_shop_loop', 'cmswebdesign_add_sidebar_button', 9);

function cmswebdesign_add_sidebar() {

  echo '<button class="sidebar-drawer-button"><i class="fa-solid fa-sliders"></i> Filter</button>';

}
add_action('woocommerce_before_shop_loop', 'cmswebdesign_add_sidebar_button', 9);


/*
* #.# Woocommerce facetwp modifications shop page
*
*/
function fwp_wrapper_open() {
  if ( ! is_singular() ) : echo '<div class="facetwp-template">'; endif;
}
function fwp_wrapper_close() {
  if ( ! is_singular() ) : echo '</div><!-- end facetwp-template -->'; endif;
}
add_action( 'woocommerce_before_shop_loop', 'fwp_wrapper_open', 5 );
add_action( 'woocommerce_after_shop_loop', 'fwp_wrapper_close', 15 );
add_action( 'woocommerce_no_products_found', 'fwp_wrapper_open', 5 );
add_action( 'woocommerce_no_products_found', 'fwp_wrapper_close', 15 );


// function cmswebdesign_before_main_content_shop_page() {

//   echo '<div class="main-content">';
//   echo '<div class="container">';
// }
// add_action( 'woocommerce_before_main_content', 'cmswebdesign_before_main_content_shop_page' );

// function cmswebdesign_after_main_content_shop_page() {

//   echo '</div>';
//   echo '</div>';

// }
// add_action( 'woocommerce_after_main_content', 'cmswebdesign_after_main_content_shop_page' );

/**
 * #.# Filter the except length to 20 words.
 *  
 */

function cmswebdesign_custom_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'cmswebdesign_custom_excerpt_length', 999 );

/**
 * #.# Filter the excerpt "read more" string.
 *
 */

function cmswebdesign_excerpt_more( $more ) {
  return sprintf( '... <a href="%1$s" class="more-link">%2$s</a>',
  esc_url( get_permalink( get_the_ID() ) ),
  sprintf( __( 'verder lezen &#187; %s', 'cmswebdesign' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
  );
}
add_filter( 'excerpt_more', 'cmswebdesign_excerpt_more' );

/**
 * #.# Registering sidebars.
 *
 */

function cmswebdesign_widgets_init() {
  register_sidebar(
    array(
      'name'          => 'Blog page sidebar',
      'id'            => 'blog-page-sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Shop page sidebar',
      'id'            => 'shop-page-sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );
}
add_action( 'widgets_init', 'cmswebdesign_widgets_init' );