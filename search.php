<?php get_header(); 
/**
 * The template for displaying search results
 *
 * @package cmswebdesignstarter
 */

?>

<div class="main-content index-content">
  <div class="container"> 
    
    <div class="page-title-container">
      <h1 class="page-title page-title-search-result-page"><?php echo __('Zoekresultaten voor ', 'cmswebdesignstarter') ?><q><?php echo get_search_query(); ?></q></h1>    
      
        <?php if ($total_results == 0) : ?>
          <p class="posts-results-counter">Er zijn geen resultaten gevonden.</p> <br>
          <p class="terug-naar-homepage-search-results"><a href="<?php bloginfo( 'url' ); ?>"><i class="fa-solid fa-circle-chevron-left"></i> <?php echo __('Home pagina', 'cmswebdesignstarter'); ?></a></p>
        <?php elseif ($total_results == 1) : ?>
          <p class="posts-results-counter">Er is <?php echo $total_results; ?> resultaat gevonden.</p>
          <p class="terug-naar-homepage-search-results"><a href="<?php bloginfo( 'url' ); ?>"><i class="fa-solid fa-circle-chevron-left"></i> <?php echo __('Home pagina', 'cmswebdesignstarter'); ?></a></p>
        <?php elseif ($total_results > 1) : ?>
          <p class="posts-results-counter">Er zijn <?php echo $total_results; ?> resultaat gevonden.</p>
          <p class="terug-naar-homepage-search-results"><a href="<?php bloginfo( 'url' ); ?>"><i class="fa-solid fa-circle-chevron-left"></i> <?php echo __('Home pagina', 'cmswebdesignstarter'); ?></a></p>
        <?php endif; ?>

    </div>    

    <?php if ($wp_query->is_search) : ?>
    
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
        <p><?php __( 'Sorry, er kwamen geen berichten overeen met je criteria.', 'cmswebdesignstarter' ); ?></p>
        <?php endif; ?> 
        
      </div>

      <!-- <div class="blog-sidebar-container">
        <?php // get_sidebar( 'blog-page' ); ?>
      </div> -->

    </div>
    
    <?php endif; ?>

  </div>
</div>

<?php get_footer(); ?>