<?php
/**
 * Functions.php file for GV Microgrants Child Theme
 *
 * Assumes parent is gv-project-theme.
 * This code will run before the functions.php in that theme.
 */

if (isset($gv) AND is_object($gv)) :

	/**
	 * Define GV_LINGUA as false to override the TRUE definition in the projects theme 
	 */
	if (!defined('GV_LINGUA'))
		define('GV_LINGUA',  FALSE);
	
	/**
	 * Define excerpt length
	 */
	if (!defined('GV_EXCERPT_LENGTH'))
		define('GV_EXCERPT_LENGTH', 999);
	
	/**
	 * Define an image to show in the header.
	 * Project theme generic has none, so it will use site title
	 */
	$gv->settings['header_img'] = get_stylesheet_directory_uri() . '/RisingVoices-microgrants2013-600.png';	
	
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
		 * Proposal Community
		 */
		x_add_metadata_field( 'proposal-community', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe the specific community with whom you will be working',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Convent Vision
		 */
		x_add_metadata_field( 'proposal-content-vision', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'What kinds of news, stories and other content will be created?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Tools
		 */
		x_add_metadata_field( 'proposal-tools', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe the technologies and digital tools that the project participants will use to produce the content?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Connections
		 */
		x_add_metadata_field( 'proposal-connections', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe the connections that you or your organization have already established that will contribute to the success of the project',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Participants
		 */
		x_add_metadata_field( 'proposal-participants', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'How many participants do you think will be involved in your project?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal City
		 */
		x_add_metadata_field( 'proposal-city', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'What locality or neighborhood will your project focus on?',
			'field_type' => 'text',
		));
		/**
		 * Proposal Contact
		 */
		x_add_metadata_field( 'proposal-contact', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Contact name',
			'field_type' => 'text',
		));
		/**
		 * Proposal Email
		 */
		x_add_metadata_field( 'proposal-email', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Your email address',
			'field_type' => 'text',
		));
		/**
		 * Proposal Organization
		 */
		x_add_metadata_field( 'proposal-organization', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Organization',
			'field_type' => 'text',
		));
		/**
		 * Proposal URL
		 */
		x_add_metadata_field( 'proposal-url', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Project website URL',
			'field_type' => 'text',
		));
		/**
		 * Proposal Twitter
		 */
		x_add_metadata_field( 'proposal-twitter', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Twitter URL',
			'field_type' => 'text',
		));
		/**
		 * Proposal Facebook
		 */
		x_add_metadata_field( 'proposal-facebook', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Facebook URL',
			'field_type' => 'text',
		));
		/**
		 * Proposal Private
		 */
		x_add_metadata_field( 'proposal-private', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Don\'t publish this proposal',
			'field_type' => 'checkbox',
		));
		/**
		 * Proposal Privacy Reason
		 */
		x_add_metadata_field( 'proposal-privacy-reason', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Why don\'t you want us to publish your proposal?',
			'field_type' => 'textarea',
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
			'taxonomy' => 'gv_topics',
			'label' => 'Topical focus:',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'taxonomy' => 'gv_geo',
			'label' => 'Country:',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-city',
			'label' => 'What locality or neighborhood will your project focus on?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-community',
			'label' => 'Describe the specific community with whom you will be working.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-content-vision',
			'label' => 'What kinds of news, stories and other content will be created?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-tools',
			'label' => 'Describe the technologies and digital tools that the project participants will use to produce the content?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'taxonomy' => 'gv_tools',
			'label' => 'Tools:',
			'position' => 'bottom',
		));		
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-connections',
			'label' => 'Describe the connections that you or your organization have already established that will contribute to the success of the project.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-participants',
			'label' => 'How many participants do you think will be involved in your project?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-contact',
			'label' => 'Contact name',
			'position' => 'bottom',
		));
		
//		gv_register_postmeta_insert(array(
//			'postmeta_field_name' => 'proposal-email',
//			'label' => 'Your email address',
//			'position' => 'bottom',
//		));

		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-organization',
			'label' => 'Organization',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-url',
			'label' => 'Link to Existing Project',
			'position' => 'bottom',
			'display' => 'url',
		));
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-twitter',
			'label' => 'Twitter URL',
			'position' => 'bottom',
			'display' => 'url',
		));
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-facebook',
			'label' => 'Facebook URL',
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
//	add_filter('the_content', 'gv_microgrants_add_long_description_top_of_content');
	
	/**
	 * Register taxonomies for this site
	 */
	function gv_microgrants_register_taxonomies() {
		/**
		 * Register geo taxonomy for posts
		 */
		register_taxonomy('gv_geo', 'gv_geo', array(
			'labels' => array(
				    'name' => _x( 'Region Categories', 'taxonomy general name' ),
				    'singular_name' => _x( 'Region Category', 'taxonomy singular name' ),
				    'search_items' =>  __( 'Search Region Categories' ),
				    'all_items' => __( 'All Region Categories' ),
				    'parent_item' => __( 'Parent Region Category' ),
				    'parent_item_colon' => __( 'Parent Region Category:' ),
				    'edit_item' => __( 'Edit Region Category' ), 
				    'update_item' => __( 'Update Region Category' ),
				    'add_new_item' => __( 'Add New Region Category' ),
				    'new_item_name' => __( 'New Region Category name' ),
				    'menu_name' => __( 'Region Categories' ),
				  ),			
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'query_var' => 'geo',
			'rewrite' => array(
				'slug' => 'geo'
			),		));
		register_taxonomy_for_object_type('gv_geo', 'post');
		
		/**
		 * Register Topics taxonomy
		 */
		register_taxonomy('gv_topics', 'gv_topics', array(
			'labels' => array(
				    'name' => _x( 'Topic Categories', 'taxonomy general name' ),
				    'singular_name' => _x( 'Topic Category', 'taxonomy singular name' ),
				    'search_items' =>  __( 'Search Topic Categories' ),
				    'all_items' => __( 'All Topic Categories' ),
				    'parent_item' => __( 'Parent Topic Category' ),
				    'parent_item_colon' => __( 'Parent Topic Category:' ),
				    'edit_item' => __( 'Edit Topic Category' ), 
				    'update_item' => __( 'Update Topic Category' ),
				    'add_new_item' => __( 'Add New Topic Category' ),
				    'new_item_name' => __( 'New Topic Category name' ),
				    'menu_name' => __( 'Topic Categories' ),
				  ),			
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'query_var' => 'topic',
			'rewrite' => array(
				'slug' => 'topic'
			),
		));
		register_taxonomy_for_object_type('gv_topics', 'post');

		/**
		 * Register tool categories
		 */
		register_taxonomy('gv_tools', 'gv_tools', array(
			'labels' => array(
				    'name' => _x( 'Tool Categories', 'taxonomy general name' ),
				    'singular_name' => _x( 'Tool Category', 'taxonomy singular name' ),
				    'search_items' =>  __( 'Search Tool Categories' ),
				    'all_items' => __( 'All Tool Categories' ),
				    'parent_item' => __( 'Parent Tool Category' ),
				    'parent_item_colon' => __( 'Parent Tool Category:' ),
				    'edit_item' => __( 'Edit Tool Category' ), 
				    'update_item' => __( 'Update Tool Category' ),
				    'add_new_item' => __( 'Add New Tool Category' ),
				    'new_item_name' => __( 'New Tool Category name' ),
				    'menu_name' => __( 'Tool Categories' ),
				  ),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'query_var' => 'tools',
			'rewrite' => array(
				'slug' => 'tools'
			),		
		));
		register_taxonomy_for_object_type('gv_tools', 'post');

		/**
		 * Register "public taxonomies" for gv_taxonomies system to display automatically on posts
		 */
		// Unregister defaults as they aren't useful for this site
		gv_unregister_public_taxonomy('category');
		gv_unregister_public_taxonomy('post_tag');	
		
		/**
		 * "Regions" taxonomy based on parentless members of gv_geo
		 */
		gv_register_public_taxonomy('gv_geo', array(
			'subtaxonomy_slug' => 'region',
			'parent' => 'none',
			'labels' => array(
				'name' => _lingua('regions'), 
				'singular_name' => 'Region',
			),
		));
		
		/**
		 * "Countries" taxonomy based on parentless members of gv_geo
		 */
		gv_register_public_taxonomy('gv_geo', array(
			'subtaxonomy_slug' => 'country',
			'grandparent' => 'none',
			'labels' => array(
				'name' => _lingua('countries'), 
				'singular_name' => 'country',
			),			
		));
		
		/**
		 * register our topics and tools taxonomies as public
		 */
		gv_register_public_taxonomy('gv_topics');
		gv_register_public_taxonomy('gv_tools');
	
		/**
		 * Filter gv_display_post_terms $before arg to remove middot 
		 * 
		 * Needed because we hide the author with CSS so there's nothing before it
		 * 
		 * @see gv_taxonomies::display_post_terms() where this filter is called
		 * @param string $before HTML string passed to display_post_terms for us to filter
		 * @param aray $args Args passed to display_post_terms for context checking
		 * @return string Filtered before text
		 */
		function gv_news_filter_display_post_terms_before($before, $args) {
			
			// Only set limit if we're on inline format
			if ('inline' == $args['format'])
				$before = str_replace ('&middot;', 'Categories: ', $before);
			
			return $before;
		}
		add_filter('gv_display_post_terms_before', 'gv_news_filter_display_post_terms_before', 10, 2);
		
	}
	add_filter('init', 'gv_microgrants_register_taxonomies');
	
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