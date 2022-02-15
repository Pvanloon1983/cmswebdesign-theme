<?php 
/**
 * The template for displaying the footer
 * 
 * Contains everything after the <div class="index-content"> closing section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CMS Webdesign starter
 */
?>
<footer class="footer">
  <div class="container">
    <div class="footer-widgets">
      <div class="widget-column-1">
        <?php
        if ( is_active_sidebar( 'footer-widget-one' ) ) {
          dynamic_sidebar( 'footer-widget-one' );
        }
        if ( is_active_sidebar( 'footer-widget-two' ) ) {
          dynamic_sidebar( 'footer-widget-two' );
        }
        ?>
      </div>

      <div class="widget-column-2">
      <?php
        if ( is_active_sidebar( 'footer-widget-three' ) ) {
          dynamic_sidebar( 'footer-widget-three' );
        }
        if ( is_active_sidebar( 'footer-widget-four' ) ) {
          dynamic_sidebar( 'footer-widget-four' );
        }
      ?>
      </div>
  </div>
</footer>
<div class="copyright">
    <p>&copy; <?php echo date('Y'); ?> by CMS Webdesign</p>
</div>

<?php wp_footer(); ?>
</body>
</html>