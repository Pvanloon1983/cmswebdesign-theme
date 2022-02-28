<?php get_header(); 
/**
 * The template for displaying all single posts.
 *
 * @package CMS Webdesign starter
 */
?>

<div class="main-content index-content">
  <div class="container">  

  <div class="blogs-sidebar-container"> 

    <div class="blog-articles-container">

     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <div class="blog-article">

      <div class="breadcrumb"><?php the_breadcrumb(); ?></div>  

          <div class="blog-title-meta">
    

            <h1><?php the_title(); ?></h3>

            <small class="posted-time"><?php the_time('j F, Y'); ?> | door <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author_meta( 'first_name' ); ?> <?php // the_author_meta( 'last_name' ); ?></a></small><br>   
          </div>

          <div class="image-excerpt-meta">
            <div>
              <?php if ( has_post_thumbnail() ) : ?>
                <img class="blog-page-post-image" width="100%" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" title="<?php the_title_attribute(); ?>">
              <?php else : ?>
                <img class="blog-page-post-image" width="100%" src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="" title="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>
            <div>
              <div class="excerpt"><?php the_content(); ?></div>
              <!-- <a href="<?php // the_permalink(); ?>"><button class="btn-lees-meer">Lees meer</button></a><br> -->
            </div>

            <small class="postmetadata"><?php _e( 'Categorie:' ); ?> <?php the_category( ', ' ); ?></small>
          </div>

          <?php comments_template('/comments.php'); ?>

          <!-- <hr class="related-blog-posts-hr"> -->

          <h2 class="related-blog-posts-main-heading">Bekijk ook</h2>
          
          <div class="related-blog-posts-container">    
            <?php  
            $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
            if( $related ) foreach( $related as $post ) {
            setup_postdata($post); ?>
            <div class="realated-single-blog-post">
              <h3 class="related-blog-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
              <small class="posted-time"><?php the_time('j F, Y'); ?> | door <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author_meta( 'first_name' ); ?> <?php // the_author_meta( 'last_name' ); ?></a></small>
              <?php
                if (has_post_thumbnail()) {
                ?>
                  <a class="related-post-thumbnail" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                  </a>
                <?php
                } else {
                ?>
                  <a class="related-post-thumbnail" href="<?php the_permalink(); ?>">
                    <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">
                  </a>
                <?php
                }
              ?>
              <?php the_excerpt(); ?>
              <!-- <a href="<?php // the_permalink(); ?>"><button class="btn-lees-meer">Lees meer</button></a><br> -->
              <small class="postmetadata"><?php _e( 'Categorie:' ); ?> <?php the_category( ', ' ); ?></small>
            </div>
            <?php }
            wp_reset_postdata(); ?>
          </div>  

        </div>

      <!-- https://www.sktthemes.org/wordpress-plugins/wordpress-post-pagination-without-plugin/ -->

      <?php endwhile; ?>

      <?php // the_posts_pagination( array( 'mid_size' => 2 ) ); ?>    
      
      <?php
      the_posts_pagination( array(
        'mid_size' => 2,
        'prev_text' => __( 'Vorige pagina', 'cmswebdesignstarter' ),
        'next_text' => __( 'Volgende pagina', 'cmswebdesignstarter' ),
        ) );    
      
      ?>  

      <?php else : ?>
      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>      
       
    </div>

    <div class="blog-sidebar-container">
      <?php get_sidebar( 'blog-page' ); ?>
    </div>

  </div>

  

  </div>
</div>

<?php get_footer(); ?>