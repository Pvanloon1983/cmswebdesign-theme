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

      <?php if ( is_active_sidebar( 'footer-widget-one' ) ) : ?>
        <div class="box"><?php dynamic_sidebar( 'footer-widget-one' ); ?></div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-widget-two' ) ) : ?>
        <div class="box"><?php dynamic_sidebar( 'footer-widget-two' ); ?></div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-widget-three' ) ) : ?>
        <div class="box"><?php dynamic_sidebar( 'footer-widget-three' ); ?></div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-widget-four' ) ) : ?>
        <div class="box"><?php dynamic_sidebar( 'footer-widget-four' ); ?></div>
      <?php endif; ?>

  </div>
</footer>
<div class="copyright">
    <p>&copy; <?php echo date('Y'); ?> by CMS Webdesign</p>
</div>

<?php wp_footer(); ?>
</body>
</html>