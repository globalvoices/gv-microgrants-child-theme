<?php
/**
 * Functions.php file for GV Microgrants Child Theme
 *
 * Assumes parent is gv-project-theme.
 * This code will run before the functions.php in that theme.
 */

if (isset($gv) AND is_object($gv)) :

	/**
	 * Disable automatic plugin activation from parent theme. We need this theme to work in MU
	 */
	define('GV_NO_DEFAULT_PLUGINS', TRUE);

	/**
	 * Define GV_LINGUA as false to override the TRUE definition in the projects theme 
	 */
	if (!defined('GV_LINGUA'))
		define('GV_LINGUA',  FALSE);
	
	/**
	 * For geo mashup plugin show excerpts instead of thumbnails
	 */
	add_filter('gv_geo_mashup_show_thumbnail', '__return_false');
	add_filter('gv_geo_mashup_show_excerpt', '__return_true');

	/**
	 * OPTIONAL: Geo Mashup filter to show map in postmeta sidebar
	 */
	add_filter('gv_geo_mashup_show_map', '__return_true');
	
	/**
	 * Define excerpt length
	 */
	if (!defined('GV_EXCERPT_LENGTH'))
		define('GV_EXCERPT_LENGTH', 999);
	
	/**
	 * Define an image to show in the header.
	 * Project theme generic has none, so it will use site title
	 */
	$gv->settings['header_img'] = get_stylesheet_directory_uri() . '/RisingVoices-microgrants-amazonia-600.png';	
	
	/**
	 * Register custom postmeta fields with the Custom Medatata Manager plugin
	 *
	 * Convert to some other format if this ever stops working
	 */
	function gv_microgrants_custom_metadata_manager_admin_init() {
		
		/**
		 * Exit if GV_MICROGRANTS_METADATA_DEFINED constant is true, it means the questions
		 * were already defined in a plugin.
		 * 
		 * Expected for old sites using this theme so they can keep their questions
		 */
		if (defined('GV_MICROGRANTS_METADATA_DEFINED'))
			return;
		
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
			'label' => 'Describe the specific population with whom you will be working',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Team
		 */
		x_add_metadata_field( 'proposal-team', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Who else will be on your team to help implement the project?',
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
		 * Proposal Connections
		 */
		x_add_metadata_field( 'proposal-connections', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe the connections that you or your organization have already established or plan to establish that will contribute to the success of the project.',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Participants
		 */
		x_add_metadata_field( 'proposal-participants', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'How many participants do you think will be trained in your project?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Technical
		 */
		x_add_metadata_field( 'proposal-technical', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe which technologies, tools, and media you will focus on when training participants.',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Facilities
		 */
		x_add_metadata_field( 'proposal-facilities', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Describe the facilities where you will hold the workshops.',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Relationship
		 */
		x_add_metadata_field( 'proposal-relationship', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'What is your current relationship with the community with whom you plan to work? What makes you the most appropriate individual or organization to implement this project?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Challenges
		 */
		x_add_metadata_field( 'proposal-challenges', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'What specific challenges do you expect to face when planning and implementing your project?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Impact
		 */
		x_add_metadata_field( 'proposal-impact', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'How will you measure and evaluate the project’s impact, specifically: your primary participants, the wider regional community, or the global digital community?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Timeline
		 */
		x_add_metadata_field( 'proposal-timeline', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => ' If your project were to be selected as a Rising Voices grantee, what would be the general timeline of project activities in 2014?',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Budget
		 */
		x_add_metadata_field( 'proposal-budget', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Detail a specific budget of up to $2,500 USD for operating costs.',
			'field_type' => 'textarea',
		));
		/**
		 * Proposal Total money requested
		 */
		x_add_metadata_field( 'proposal-total', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Total amount you are requesting (in US dollars)',
			'field_type' => 'text',
		));
		/**
		 * Proposal Other Resources
		 */
		x_add_metadata_field( 'proposal-otherresources', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Besides the microgrant funding, what other support can Rising Voices provide for your project to ensure its success?',
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
		 * Proposal Mailing address
		 */
		x_add_metadata_field( 'proposal-address', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Mailing Address',
			'field_type' => 'text',
		));
		/**
		 * Proposal Telephone number
		 */
		x_add_metadata_field( 'proposal-number', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Telephone Number',
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
		 * Proposal First Time
		 */
		x_add_metadata_field( 'proposal-firsttime', array('post'), array(
			'group' => 'gv_custom_metadata_posts',
			'label' => 'Is this the first time that you have applied for a Rising Voices microgrant?',
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
	add_action( 'admin_init', 'gv_microgrants_custom_metadata_manager_admin_init', 15);

	/**
	 * Register postmeta inserts
	 * 
	 * These will be auto-inserted into post content
	 */
	function gv_microgrants_register_postmeta_inserts() {

		if (!function_exists('gv_register_postmeta_insert'))
			return;

		/**
		 * Exit if GV_MICROGRANTS_POSTMETA_INSERTS_DEFINED constant is true, it means the questions
		 * were already defined in a plugin.
		 * 
		 * Expected for old sites using this theme so they can keep their questions
		 */
		if (defined('GV_MICROGRANTS_POSTMETA_INSERTS_DEFINED'))
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
			'label' => 'Describe the specific population with whom you will be working.',
			'position' => 'bottom',
		));

		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-team',
			'label' => 'Who else will be on your team to help implement the project?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-content-vision',
			'label' => 'What kinds of news, stories and other content will be created?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'taxonomy' => 'gv_tools',
			'label' => 'What technologies and digital tools do you plan to use in the trainings?',
			'position' => 'bottom',
		));		
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-tools',
			'label' => 'Other tools',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-connections',
			'label' => 'Describe the connections that you or your organization have already established or plan to establish that will contribute to the success of the project.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-participants',
			'label' => 'How many participants do you think will be trained in your project?',
			'position' => 'bottom',
		));

		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-technical',
			'label' => 'Describe which technologies, tools, and media you will focus on when training participants.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-facilities',
			'label' => 'Describe the facilities where you will hold the workshops.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-relationship',
			'label' => 'What is your current relationship with the community with whom you plan to work? What makes you the most appropriate individual or organization to implement this project?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-challenges',
			'label' => 'What specific challenges do you expect to face when planning and implementing your project?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-impact',
			'label' => 'How will you measure and evaluate the project’s impact, specifically: your primary participants, the wider regional community, or the global digital community?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-timeline',
			'label' => ' If your project were to be selected as a Rising Voices grantee, what would be the general timeline of project activities in 2014?',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-budget',
			'label' => 'Detail a specific budget of up to $2,500 USD for operating costs.',
			'position' => 'bottom',
		));
		
		gv_register_postmeta_insert(array(
			'postmeta_field_name' => 'proposal-otherresources',
			'label' => 'Besides the microgrant funding, what other support can Rising Voices provide for your project to ensure its success?',
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
	add_action('init', 'gv_microgrants_register_postmeta_inserts', 15);

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
			    'name' => _lingua('region_categories'),
			    'singular_name' => _lingua('region_category'),
			    'search_items' => _lingua('search_region_categories'),
			    'all_items' => _lingua('all_region_categories'),
			    'parent_item' => _lingua('parent_region_category'),
			    'parent_item_colon' => _lingua('parent_region_category') . ":",
			    'edit_item' => _lingua('edit_region_category'),
			    'update_item' => _lingua('edit_region_category'),
			    'add_new_item' => _lingua('add_region_category'),
			    'new_item_name' => _lingua('new_region_category_name'),
			    'menu_name' => _lingua('region_categories'),
			  ),			
			'public' => true,
			'show_ui' => true,
			// fixes http://core.trac.wordpress.org/ticket/14084
			'update_count_callback' => '_update_post_term_count',
			'show_admin_column' => true,
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
			    'name' => _lingua('topic_categories'),
			    'singular_name' => _lingua('topic_category'),
			    'search_items' => _lingua('search_topic_categories'),
			    'all_items' => _lingua('all_topic_categories'),
			    'parent_item' => _lingua('parent_topic_category'),
			    'parent_item_colon' => _lingua('parent_topic_category') . ":",
			    'edit_item' => _lingua('edit_topic_category'),
			    'update_item' => _lingua('edit_topic_category'),
			    'add_new_item' => _lingua('add_topic_category'),
			    'new_item_name' => _lingua('new_topic_category_name'),
			    'menu_name' => _lingua('topic_categories'),
			),			
			'public' => true,
			'show_ui' => true,
			// fixes http://core.trac.wordpress.org/ticket/14084
			'update_count_callback' => '_update_post_term_count',
			'show_admin_column' => true,
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
			    'name' => _lingua('tool_categories'),
			    'singular_name' => _lingua('tool_category'),
			    'search_items' => _lingua('search_tool_categories'),
			    'all_items' => _lingua('all_tool_categories'),
			    'parent_item' => _lingua('parent_tool_category'),
			    'parent_item_colon' => _lingua('parent_tool_category') . ":",
			    'edit_item' => _lingua('edit_tool_category'),
			    'update_item' => _lingua('edit_tool_category'),
			    'add_new_item' => _lingua('add_tool_category'),
			    'new_item_name' => _lingua('new_tool_category_name'),
			    'menu_name' => _lingua('tool_categories'),
			  ),
			'public' => true,
			'show_ui' => true,
			// fixes http://core.trac.wordpress.org/ticket/14084
			'update_count_callback' => '_update_post_term_count',
			'show_admin_column' => true,			
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
		
		/**
		 * Filter tag cloud widget arguments to remove limit on number to show
		 * 
		 * 
		 * @see WP_Widget_Tag_Cloud Widget class for the tag cloud widget
		 * @param array $args All default arguments
		 * @return array Modified arguments
		 */
		function gv_microgrants_filter_widget_tag_cloud_args($args) {
			$args['number'] = 0;
			
			return $args;
		}
		add_filter('widget_tag_cloud_args', 'gv_microgrants_filter_widget_tag_cloud_args');
		
	}
	add_filter('init', 'gv_microgrants_register_taxonomies');
	
	/**
	 * Register strings specific to this site for Theme Translator
	 */
	function gv_news_register_theme_strings() {	
		
		/**
		 * Region categories
		 */
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'region_categories', 
			'default_text' => 'Region Categories',
			'note' => 'Labels for the custom taxonomies used by the Microgrants child theme. These are separate from the usual "topics" and "regions" of the main GV site.',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'region_category', 
			'default_text' => 'Region Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'search_region_categories', 
			'default_text' => 'Search Region Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'all_region_categories', 
			'default_text' => 'All Region Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'parent_region_category', 
			'default_text' => 'Parent Region Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'edit_region_category', 
			'default_text' => 'Edit Region Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'add_region_category', 
			'default_text' => 'Add New Region Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'new_region_category_name', 
			'default_text' => 'New Region Category Name',
			'note' => '',
			)
		);
		/**
		 * Topic categories
		 */
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'topic_categories', 
			'default_text' => 'Topic Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'topic_category', 
			'default_text' => 'Topic Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'search_topic_categories', 
			'default_text' => 'Search Topic Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'all_topic_categories', 
			'default_text' => 'All Topic Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'parent_topic_category', 
			'default_text' => 'Parent Topic Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'edit_topic_category', 
			'default_text' => 'Edit Topic Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'add_topic_category', 
			'default_text' => 'Add New Topic Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'new_topic_category_name', 
			'default_text' => 'New Topic Category Name',
			'note' => '',
			)
		);
		/**
		 * Tool categories
		 */
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'tool_categories', 
			'default_text' => 'Tool Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'tool_category', 
			'default_text' => 'Tool Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'search_tool_categories', 
			'default_text' => 'Search Tool Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'all_tool_categories', 
			'default_text' => 'All Tool Categories',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'parent_tool_category', 
			'default_text' => 'Parent Tool Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'edit_tool_category', 
			'default_text' => 'Edit Tool Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'add_tool_category', 
			'default_text' => 'Add New Tool Category',
			'note' => '',
			)
		);
		gv_register_theme_string(array(
			'section' => 'Microgrants Taxonomy Labels', 
			'string_slug' => 'new_tool_category_name', 
			'default_text' => 'New Tool Category Name',
			'note' => '',
			)
		);
	}
	add_filter('after_setup_theme', 'gv_news_register_theme_strings');
	
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
	 * Filter the og:image (facebook/g+) default icon to be an RV logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
	function gvadvocacy_theme_gv_og_image_default($icon) {
		return gv_get_dir('theme_images') ."rv-logo-facebook-og-1200x631.png";
	}
	add_filter('gv_og_image_default', 'gvadvocacy_theme_gv_og_image_default');
	
	/**
	 * Filter ALL CASES OF og:image (facebook/g+) icon to be an RV logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
	function gvadvocacy_theme_gv_og_image($icon) {
		return gv_get_dir('theme_images') ."rv-logo-square-600.png";
	}
//	add_filter('gv_og_image', 'gvadvocacy_theme_gv_og_image');
	
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
		'avina' => array(
			"name" => "Avina",
			"slug" => "avina",
			'description' => 'Avina is a Latin American foundation that identifies opportunities to achieve systemic change relevant for sustainable development, by connecting and empowering people and institutions in shared agendas for action.',
			"url" => "http://www.avina.net/eng/",
			'status' => 'featured',
			),
		'avina-americas' => array(
			"name" => "Avina Americas",
			"slug" => "avina-americas",
			'description' => 'Avina Americas\' mission is to impact sustainable development in Latin America and beyond by engaging U.S. actors in shared strategies for action which contribute to the common good. ',
			"url" => "http://http://www.avinaamericas.org/",
			'status' => 'featured',
			),
		'skoll' => array(
			"name" => "Skoll Foundation",
			"slug" => "skoll",
			'description' => 'The Skoll Foundation invests in, connects, and celebrates social entrepreneurs and the innovators who help them solve the world’s most pressing problems.',
			"url" => "http://www.skollfoundation.org/",
			'status' => 'featured',
			),
//		'hivos' => array(
//			"name" => "Hivos",
//			"slug" => "hivos",
//			"description" => 'Hivos, the Humanist Institute for Development Cooperation',
//			"url" => "http://www.hivos.org/",
//			"status" => 'featured',
//			),		
//		'knight' => array(
//			"name" => "Knight Foundation",
//			"slug" => "knight",
//			"description" => 'John S. and James L. Knight Foundation',
//			"url" => "http://www.knightfdn.org/",
//			"status" => 'featured',
//			),
//		'fpu' => array(
//			"name" => "Free Press Unlimited",
//			"slug" => "fpu",
//			"description" => 'Free Press Unlimited - People Deserve to Know',
//			"url" => "http://www.freepressunlimited.org/",
//			"status" => 'featured',
//			),
//		'osi' => array(
//			"name" => "Open Society Institute",
//			"slug" => "osi",
//			"description" => 'Open Society Institute - Building vibrant and tolerant democracies.',
//			"url" => "http://www.soros.org/",
//			"status" => 'featured',
//			),
//		'heinrichboll' => array(
//			"name" => "Heinrich Böll Stiftung",
//			"slug" => "heinrichboll",
//			"description" => 'Heinrich Böll Stiftung - Striving to promote democracy, civil society, equality and a healthy environment internationally.',
//			"url" => "http://www.boell.org/",
//			"status" => 'featured',
//			),
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