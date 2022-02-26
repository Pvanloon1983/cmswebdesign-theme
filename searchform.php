<?php 

/*
* #.# This is the standard wordpress search form which
*  will output search results on the search.php page
*
*/

?>

<form class="search-form" action="/" method="get">
  <input autocomplete="off" class="search-bar main-header-search-bar" type="search" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Zoeken...">
  <button class="search-submit-button" type="submit"><i class="fas fa-search"></i></button>
</form> 

<!-- https://www.wpbeginner.com/wp-tutorials/how-to-use-multiple-search-forms-in-wordpress/ -->