<?php
/**
 * Functions.php file for GV Microgrants Child Theme
 *
 * Assumes parent is gv-project-theme.
 * This code will run before the functions.php in that theme.
 */

if (is_object($gv)) :

	/**
	 * Define GV_LINGUA as false to override the TRUE definition in the projects theme 
	 */
	if (!defined('GV_LINGUA'))
		define('GV_LINGUA',  FALSE);

	/**
	 * Register custom postmeta fields with the Custom Medatata Manager plugin
	 *
	 * Convert to some other format if this ever stops working
	 */
	function gv_microgrants_custom_metadata_manager_admin_init() {
		/**
		 * Exit if the plugin isn't present
		 */
		if(!function_exists( 'x_add_metadata_field' ) OR !function_exists( 'x_add_metadata_group' ) )
			return;
		/**
		 * Register a group for pages and posts
		 */
		x_add_metadata_group('gv_custom_metadata_posts', array('post'), array(
			'label' => 'GV Custom Metadata',
			'priority' => 'high',
		));
		/**
		 * Leader skills
		 */
		x_add_metadata_field( 'leader-skills', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Leadership Skills',
			'field_type' => 'text',
		));
		/**
		 * Project website URL
		 */
		x_add_metadata_field( 'proposal-url', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Proposal URL',
			'field_type' => 'text',
		));

	//	/**
	//	 * Hide creation/update dates, pages only
	//	 */
	//	x_add_metadata_field('gv-hide-dates', array( 'page'), array(
	//		'group' => 'gv_custom_metadata_posts',
	//		'label' => 'Hide dates on post (creation and last updated)',
	//		'field_type' => 'checkbox',
	//	));	
	}
	add_action( 'admin_init', 'gv_microgrants_custom_metadata_manager_admin_init' );

	/**
	 * Register postmeta inserts
	 * 
	 * These will be auto-inserted into post content
	 */
	function gv_microgrants_register_postmeta_inserts() {

		if (!function_exists('gv_register_postmeta_insert'))
			return;

		gv_register_postmeta_insert(array(
			'field_name' => 'excerpt',
			'label' => 'Short Description',
			'position' => 'top',
		));
		gv_register_postmeta_insert(array(
			'field_name' => 'leader-skills',
			'label' => 'Leadership Skills Available',
			'position' => 'bottom',
		));
		gv_register_postmeta_insert(array(
			'field_name' => 'proposal-url',
			'label' => 'Link to Existing Project',
			'position' => 'bottom',
			'display' => 'url',
		));
	}
	add_action('init', 'gv_microgrants_register_postmeta_inserts');

	/**
	 * Insert "Long Description" h3 above post content
	 * 
	 * Used to make post body match style of fields inserted above it 
	 * by gv_register_postmeta_field
	 * 
	 * @global object $post Post object who's content is being filtered
	 * @param string $content Post content to filter
	 * @return string Filtered content
	 */
	function gv_microgrants_add_long_description_top_of_content($content) {
		global $post;
		if (is_admin() OR ('post' != $post->post_type))
			return $content;
		
		$content = "<h3>Long Description</h3>" . $content;
		
		return $content;
	}
	add_filter('the_content', 'gv_microgrants_add_long_description_top_of_content');
	
	/**
	 * Define an image to show in the header.
	 * Project theme generic has none, so it will use site title
	 */
//	$gv->settings['header_img'] = get_bloginfo('template_url') . '/images/advocacy-temptitle2.png';

	/**
	 * Filter the apple touch icon to be a customized logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
//	function gvadvocacy_theme_gv_apple_touch_icon($icon) {
//		return gv_get_dir('theme_images') ."gv-advocacy-apple-touch-icon-precomposed-300.png";
//	}
//	add_filter('gv_apple_touch_icon', 'gvadvocacy_theme_gv_apple_touch_icon');
		
	/**
	 * Define the hierarchical structure of the taxonomy by its parents
	 */
//	$gv->taxonomy_outline = array(
//		'countries' => 1,
//		'topics' => 1,
//		'special' => 1,
//		'type' => 1,
//	);

	/**
	 * Define Categories to be inserted into post data before returning content for translation during fetch
	 * @see gv_lingua::reply_to_ping()
	 */
//	$gv->lingua_site_categories[] = 'gv-advocacy';

	/**
	 * Set a custom site description using a lingua string. To be used in social media sharing etc.
	 */
//	$gv->site_description = "A project of Global Voices Online, we seek to build a global anti-censorship network of bloggers and online activists dedicated to protecting freedom of expression and free access to information online.";
	
	/**
	 * Sponsors definition to be used by gv_get_sponsors()
	 */
	$gv->sponsors = array(
		'hivos' => array(
			"name" => "Hivos",
			"slug" => "hivos",
			"description" => 'Hivos, the Humanist Institute for Development Cooperation',
			"url" => "http://www.hivos.org/",
			"status" => 'featured',
			),
	);

	/**
	 * Define badgeset arrays for use with [gvbadges id="$slug"] shortcode
	 */

	/**
	 * General GV Badges - Based on lingua site slug
	 */
//	$gv->badgesets['advocacy_general'] = array(
//		'label' => "Global Voices Advocacy - Defending free speech online",
//		'url' => "http://advocacy.globalvoicesonline.org/",
//		'css' => "margin:3px 0;",
//		'files' => array(
//			'http://img.globalvoicesonline.org/Badges/advocacy/gv-advocacy-badge-125.gif',
//			'http://img.globalvoicesonline.org/Badges/advocacy/gv-advocacy-badge-150.gif',
//			'http://img.globalvoicesonline.org/Badges/advocacy/gv-advocacy-badge-200.gif',
//			'http://img.globalvoicesonline.org/Badges/advocacy/gv-advocacy-badge-400.gif'
//		),
//	);


endif; // is_object($gv)

?>