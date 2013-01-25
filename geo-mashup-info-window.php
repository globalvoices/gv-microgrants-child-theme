<?php
/**
 * Geo Mashup plugin's 'info-window.php' templage
 * 
 * Copied from the /default-templates/ folder in the plugin. 
 * 
 * For styling of the info window, see map-style-default.css.
 *
 * @package GeoMashup
 */

// A potentially heavy-handed way to remove shortcode-like content
add_filter( 'the_excerpt', array( 'GeoMashupQuery', 'strip_brackets' ) );

?>
<div class="locationinfo post-location-info">
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post();
	
		 gv_display_post_summary('', array(
			 'hide_meta' => 1,
		 ));
	
	endwhile; ?>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div>
