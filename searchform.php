<?php 

/*
* #.# This is the standard wordpress search form which
*  will output search results on the search.php page
*
*/

global $wp_query;   
$post_type = get_query_var('post_type');

?>

<form class="search-form" action="/" method="get">
  <input autocomplete="off" class="search-bar main-header-search-bar" type="search" name="s" id="search" placeholder="Zoek berichten..." 
  <?php if ($wp_query->is_search && $post_type != 'product') :  ?>
	value="<?php echo get_search_query(); ?>" name="s" />
	<?php else : ?>
	value="" name="s" />
	<?php endif; ?>
  <!-- The hidden input type makes sure it will only search in posts, not pages -->
  <input type="hidden" name="post_type" value="post" />
  <button class="search-submit-button" type="submit"><i class="fas fa-search"></i></button>
</form> 

<!-- https://www.wpbeginner.com/wp-tutorials/how-to-use-multiple-search-forms-in-wordpress/ -->