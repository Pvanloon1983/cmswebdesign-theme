<?php get_header(); 
/**
 * The template for displaying the front page
 *
 * @package CMS Webdesign starter
 */
?>

<div class="main-content">
  <div class="container">
    <!-- <h1>Front page</h1> -->

    <?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 
            the_content();
        endwhile; 
    endif; 
    ?>
  </div>
</div>

<?php get_footer(); ?>