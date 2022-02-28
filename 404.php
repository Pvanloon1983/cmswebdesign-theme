<?php get_header(); 
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package CMS Webdesign starter
 */
?>

<div class="main-content">
  <div class="container">
    <h1 class="page-title"><?php echo __('Oeps! Die pagina kan niet worden gevonden.', 'cmswebdesignstarter') ?></h1>
    <p class="p-not-found-page-message"><?php echo __('Het lijkt erop dat er op deze locatie niets is gevonden. Misschien proberen te zoeken?', 'cmswebdesignstarter'); ?></p>
    <p class="terug-naar-homepage-search-results"><a href="<?php bloginfo( 'url' ); ?>"><i class="fa-solid fa-circle-chevron-left"></i> <?php echo __('Home pagina', 'cmswebdesignstarter'); ?></a></p>
  </div>
</div>

<?php get_footer(); ?>