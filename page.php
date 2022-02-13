<?php 

get_header(); ?>

<div class="main-content">
  <!-- Background will automatically be generated is there is no thumbnail -->
  <div class="container">
    
    <h1 class="page-title"><?php the_title(); ?></h1>

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