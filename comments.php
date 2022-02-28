<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package CMS Webdesign starter
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<div id="comments" class="comments-area">
    
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _nx( 'Een gedachte over "%2$s"', '%1$s gedachten over "%2$s"', get_comments_number(), 'comments title', 'cmswebdesignstarter' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                ) );
            ?>
        </ol><!-- .comment-list -->

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Reactienavigatie', 'cmswebdesignstarter' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Oudere Reacties', 'cmswebdesignstarter' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Nieuwere Reacties &rarr;', 'cmswebdesignstarter' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Reacties zijn gesloten.' , 'cmswebdesignstarter' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php comment_form(); ?>

    </div><!-- #comments -->
