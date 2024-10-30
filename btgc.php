<?php
/*
Plugin Name: Blog Tech Check
Plugin URI: http://www.blogtechguy.com/plugins
Description: Checks if certain conditions are met by the Wordpress install.
Version: 1.0
Author: Blog Tech Guy
Author URI: http://www.blogtechguy.com
*/
?>
<?php
$plugin = plugin_basename(__FILE__);

function btgc_link($links) {  
	$checklist_link = '<a href="options-general.php?page=btgc">Checklist</a>';
	array_unshift($links, $checklist_link);
	return $links;
}

function btgc_add_options_page() {
	if (function_exists('add_options_page')) {
		add_options_page("Blog Tech Check", "Blog Tech Check", 5, 'btgc', 'btgc_init_page');
	}
}

function btgc_init_page() {
	require("btgc-checklist.php");
}

function btgc_remove_version() {
	if (!is_admin()) {
		global $wp_version;
		$wp_version = '';
	}
}

add_filter("plugin_action_links_$plugin", 'btgc_link');
add_action("init", btgc_remove_version, 1);
add_action('admin_menu', 'btgc_add_options_page');
remove_action('wp_head', 'wp_generator');
?>