<?php get_header(); ?>

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