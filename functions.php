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


/*
* #.# Breadcrumbs
*
*/
// echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
// if (is_category() || is_single()) {
//     echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
//     the_category(' &bull; ');
//         if (is_single()) {
//             echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
//             the_title();
//         }
// } elseif (is_page()) {
//     echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
//     echo the_title();
// } elseif (is_search()) {
//     echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
//     echo '"<em>';
//     echo the_search_query();
//     echo '</em>"';
// }

function the_breadcrumb() {

  $sep = ' » ';

  if (!is_front_page()) {

      echo '<div class="breadcrumbs">';
      echo '<a href="';
      echo get_option('home');
      echo '">';
      // bloginfo('name');
      echo 'Home';
      echo '</a>' . $sep;

      if (is_category() || is_single() ){
          the_category(' &bull; ');
      } elseif (is_archive() || is_single()){
          if ( is_day() ) {
              printf( __( '%s', 'text_domain' ), get_the_date() );
          } elseif ( is_month() ) {
              printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
          } elseif ( is_year() ) {
              printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
          } else {
              _e( 'Blog Archives', 'text_domain' );
          }
      }

      if (is_single()) {
          echo $sep;
          the_title();
      }

      if (is_page()) {
          echo the_title();
      }

      if (is_home()){
          global $post;
          $page_for_posts_id = get_option('page_for_posts');
          if ( $page_for_posts_id ) { 
              $post = get_page($page_for_posts_id);
              setup_postdata($post);
              the_title();
              rewind_posts();
          }
      }

      echo '</div>';
  }
}

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
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'cmswebdesign_add_woocommerce_support' );

/*
* #.# Customer Woocommerce styling
*
*/

// Remove default breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove woocommerce default page title through filter
function cmswebdesign_remove_woocommerce_default_title($value) {
  $value = false;
  return $value;
}
add_filter('woocommerce_show_page_title', 'cmswebdesign_remove_woocommerce_default_title');

// Add custom title, custom main-content, breadcrumb, sidebar and container box shop page
function cmswebdesign_add_custom_containers_shop_before() {
  ?>

  <div class="shop-page-filter-drawer">
    <div class="woocommerce-drawer-menu-close-button">
      <i class="fas fa-times"></i>
    </div>  
    <div id="shop-page-sidebar" class="sidebar">
      <?php dynamic_sidebar( 'shop-page-sidebar' ); ?>
    </div>
  </div>

  <div class="main-content">
  <div class="page-title-bread-crumb-container">
		<?php woocommerce_breadcrumb(); ?>
		<!-- <h1 class="page-title container"><?php // woocommerce_page_title(); ?></h1> -->
	</div>
	<div class="container">

  <?php 
}
add_action('woocommerce_before_main_content', 'cmswebdesign_add_custom_containers_shop_before', 1 );


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &#187; ';
	return $defaults;
}


function cmswebdesign_add_custom_containers_shop_after() {
  ?>

  </div>
  </div>

  <?php 
}
add_action('woocommerce_after_main_content', 'cmswebdesign_add_custom_containers_shop_after', 11 );


/*
* #.# Output customer order details on thank you page
*
*/
function cmswebdesign_adding_customers_details_to_thankyou( $order_id ) {
    // Only for non logged in users
    if ( ! $order_id || is_user_logged_in() ) return;

    $order = wc_get_order($order_id); // Get an instance of the WC_Order object

    wc_get_template( 'order/order-details-customer.php', array('order' => $order ));
}
add_action( 'woocommerce_thankyou', 'cmswebdesign_adding_customers_details_to_thankyou', 10, 1 );

/**
 * #.# Show cart contents / total Ajax
 * 
 */
function cmswebdesign_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?> - <?php echo WC()->cart->get_cart_total(); ?></span>
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
 * #.# Woocommerce sidebar shop pages
 * 
 */

// Remove default woocommerce sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar'); 

// Adding custom sidebar
function cmswebdesign_add_sidebar_before_main_content() { 

  echo '<div id="shop-page-sidebar" class="sidebar">';
  dynamic_sidebar( 'shop-page-sidebar' );
  echo '</div>';

}
add_action('woocommerce_before_main_content', 'cmswebdesign_add_sidebar_before_main_content', 2);


/*
* #.# Sidebar drawer button
*
*/

function cmswebdesign_add_sidebar_button() {

  echo '<button class="sidebar-drawer-button"><i class="fa-solid fa-sliders"></i> Filter</button>';

}
add_action('woocommerce_before_shop_loop', 'cmswebdesign_add_sidebar_button', 1);

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

/*
* #.# Single product page
*
*/
function cmswebdesign_add_breadcrumb_above_title() {

  woocommerce_breadcrumb();

}
add_action('woocommerce_single_product_summary', 'cmswebdesign_add_breadcrumb_above_title', 1);

/*
* #.# Checkout styling
*
*/

/* Change position heading order review */
function cmswebdesign_add_heading_above_order() {
  ?>

  <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

  <?php
}
add_action('woocommerce_checkout_order_review', 'cmswebdesign_add_heading_above_order', 1 );

/*
* #.# Cart page styling
*
*/
function cmswebdesign_add_breadcrumb() {

  woocommerce_breadcrumb();

}
add_action('woocommerce_before_cart', 'cmswebdesign_add_breadcrumb');

/*
* #.# Checkout page
*
*/
function cmswebdesign_woocommerce_before_checkout_form() {

  woocommerce_breadcrumb();

}
add_action('woocommerce_before_checkout_form', 'cmswebdesign_woocommerce_before_checkout_form', 1);

/*
* #.# Thank you page
*
*/
function cmswebdesign_woocommerce_before_thankyou() {

  // woocommerce_breadcrumb();

}
add_action('woocommerce_before_thankyou', 'cmswebdesign_woocommerce_before_thankyou', 1 );

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