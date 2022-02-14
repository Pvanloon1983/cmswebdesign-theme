<?php 
/**
 * The main template file which is used for all the blog posts
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CMS Webdesign starter
 */

get_header(); ?>

<div class="main-content index-content">
  <div class="container">  

    <!-- <div class="page-title-container">
      <h1 class="page-title">Blog</h1>    
    </div> -->

    <div class="breadcrumb"><?php the_breadcrumb(); ?></div>  
     
    <div class="blogs-sidebar-container">
    
     <div class="blog-articles-container">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="blog-article">

            <div>
              <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanente Link naar <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

              <small class="posted-time"><?php the_time('j F, Y'); ?> | door <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author_meta( 'first_name' ); ?> <?php // the_author_meta( 'last_name' ); ?></a></small><br>
            </div>

            <div class="image-excerpt-meta">
              <div>
                <?php if ( has_post_thumbnail() ) : ?>
                  <a href="<?php the_permalink(); ?>"><img class="blog-page-post-image" width="100%" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" title="<?php the_title_attribute(); ?>"></a>
                <?php else : ?>
                  <a href="<?php the_permalink(); ?>"><img class="blog-page-post-image" width="100%" src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="" title="<?php the_title_attribute(); ?>"></a>
                <?php endif; ?>
              </div>
              <div>
                <div class="excerpt"><?php the_excerpt(); ?></div>
                <!-- <a href="<?php // the_permalink(); ?>"><button class="btn-lees-meer">Lees meer</button></a><br> -->
                <small class="postmetadata"><?php _e( 'Categorie:' ); ?> <?php the_category( ', ' ); ?></small>
              </div>
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

      <!-- <div class="blog-sidebar-container">
        <?php // get_sidebar( 'blog-page' ); ?>
      </div> -->

    </div>

  </div>
</div>

<?php get_footer(); ?>