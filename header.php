<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<?php 
  if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
  } else {
    do_action( 'wp_body_open' );
  }
?>
<header class="header-section">
    <div class="container">
      <div class="logo-container">
        <?php 
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
          
          if ( has_custom_logo() ) {
              echo '<a href="' . get_bloginfo( 'url' ) . '"><img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
          } else {
              echo '<p>' . 'Logo' . '</p>';
          }
        ?>
      </div>

      <div class="flex-container-navbar">
        <div class="navbar-all-items-container">
          <nav class="navbar-main">
            <?php wp_nav_menu( array( 
              'theme_location' => 'main-menu',
              'depth'          => 3,
              'fallback_cb' => false
            ) ); ?>
          </nav>
        </div>

        <div class="flex-container-cart-buttons-search">
          <div class="button-container">
            <!-- <button class="btn btn-1">CTA button one</button>
            <button class="btn btn-2">CTA button two</button> -->

            <div class="cart-heading">
            <a href="<?php echo wc_get_cart_url(); ?>"><i class="fas fa-shopping-cart"></i>
            <!-- <span class="items"><?php // echo WC()->cart->get_cart_contents_count(); ?></span></a> -->
            <span class="items"><?php echo WC()->cart->get_cart_total(); ?></span></a>
            </div>

            <button class="btn btn-3 btn-search"><i class="fas fa-search"></i></button>
          </div>       


          <div class="search-bar-container">
            <form class="search-form-header" action="/" method="get">
              <input autocomplete="off" class="search-bar main-header-search-bar" type="search" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Zoeken...">
              <!-- <button class="search-submit-button" type="submit"><i class="fas fa-search"></i></button> -->
            </form> 

            <div class="live-search-results-container">
              <div class="live-search-results">
              </div>
            </div>
          </div>
          
          <div class="menu-toggle-container">
            <i class="fas fa-bars"></i>    
          </div>
        </div>
      </div>

   </div>
</header>

<div class="mobile-menu-side-menu">

<div class="mobile-menu-close-button">
    <i class="fas fa-times"></i>
  </div>   

  <div class="mobile-menu-container">
  <nav class="navbar-mobile">
    <?php wp_nav_menu( array( 
      'theme_location' => 'main-menu',
      'depth'          => 3,
      'fallback_cb' => false
    ) ); ?>
  </nav>
  </div>
</div>

