<?php
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
global $plugindir;
global $pass_count;
global $fail_count;
$plugindir = WP_PLUGIN_URL . "/blog-tech-check/";
$pass_count = 0;
$fail_count = 0;

class Check {
	var $p_msg;
	var $f_msg;
	var $h_msg;
	var $passed;
	var $help_div;

	function outputHtml() {
		// (Function Check ||    Rewrite Check     )
		if (!$this->passed || !isset($this->passed)) {
			global $fail_count;
			global $plugindir;
			$fail_count++;
			$ret = '<tr><td class="fail"><strong>Fail: </strong>'. $this->f_msg . '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript: toggleRow(\'' . $this->help_div . '\');"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';
			$ret .= '<tr id="' . $this->help_div . '" style="display:none;"><td class="helpmsg">' . $this->h_msg . '</td></tr>';
			return $ret;
		} else {
			global $pass_count;
			$pass_count++;
			$ret = '<tr><td class="pass"><strong>Pass: </strong>'. $this->p_msg . '</td></tr>';
			return $ret;
		}
	}
}

class UserCheck {
	# Usage:
	# $var = new UserCheck($userName, $helpDivName);
	# print $var;
	
	var $name;

	function __construct($n, $h) {
		$this->name = $n;
		$this->help_div = $h;
		$this->passed = !username_exists($this->name);
		$this->set_messages();
	}
		
	function __toString() {
		return $this->outputHtml();
	}
	
	function outputHtml() {
		// (Function Check ||    Rewrite Check     )
		if (!$this->passed || !isset($this->passed)) {
			global $fail_count;
			global $plugindir;
			$fail_count++;
			$ret = '<tr><td class="fail"><strong>Fail: </strong>'. $this->f_msg . '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript: toggleRow(\'' . $this->help_div . '\');"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';
			$ret .= '<tr id="' . $this->help_div . '" style="display:none;"><td class="helpmsg">' . $this->h_msg . '</td></tr>';
			return $ret;
		} else {
			global $pass_count;
			$pass_count++;
			$ret = '<tr><td class="pass"><strong>Pass: </strong>'. $this->p_msg . '</td></tr>';
			return $ret;
		}
	}
		
	function set_messages() {
		$this->p_msg = "User 'admin' does not exist.";
		$this->f_msg = "User 'admin' exists.";
		$this->h_msg = "It is advisable to remove the default username of admin. To do this, create a new user with Administrator rights. Then log out, and log back in as the new user. Check you have access to everything, and then backup your database using the WP DB Backup plugin. Then delete the admin user, making sure you assign all posts and pages to the new user when prompted.";
	}
}

class RewriteCheck {
	# Usage:
	# $var = new RewriteCheck($helpDivName);
	# print $var;

	function __construct($h) {
		global $wp_rewrite;
		$this->help_div = $h;
		$this->passed = $wp_rewrite->get_page_permastruct();
		$this->set_messages();
	}
		
	function __toString() {
		return $this->outputHtml();
	}
	
		function outputHtml() {
		// (Function Check ||    Rewrite Check     )
		if (!$this->passed || !isset($this->passed)) {
			global $fail_count;
			global $plugindir;
			$fail_count++;
			$ret = '<tr><td class="fail"><strong>Fail: </strong>'. $this->f_msg . '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript: toggleRow(\'' . $this->help_div . '\');"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';
			$ret .= '<tr id="' . $this->help_div . '" style="display:none;"><td class="helpmsg">' . $this->h_msg . '</td></tr>';
			return $ret;
		} else {
			global $pass_count;
			$pass_count++;
			$ret = '<tr><td class="pass"><strong>Pass: </strong>'. $this->p_msg . '</td></tr>';
			return $ret;
		}
	}
		
	function set_messages() {
		switch ($this->passed) {
		default:
			$this->p_msg = "Custom permalinks are in use.";
			$this->f_msg = "Permalinks are default.";
			$this->h_msg = "Custom Permalinks are NOT necessary but often desired for SEO and aesthetic reasons. Change them under Settings > Permalinks.";
			break;
		}
	}
}

class FunctionCheck {
	# Usage:
	# $var = new FunctionCheck($varName, $helpDivName);
	# print $var;
	
	var $func;

	function __construct($f, $h) {
		$this->help_div = $h;
		$this->func = $f;
		$this->set_messages();
		$this->passed = function_exists($f);
	}
		
	function __toString() {
		return $this->outputHtml();
	}
	
		function outputHtml() {
		// (Function Check ||    Rewrite Check     )
		if (!$this->passed || !isset($this->passed)) {
			global $fail_count;
			global $plugindir;
			$fail_count++;
			$ret = '<tr><td class="fail"><strong>Fail: </strong>'. $this->f_msg . '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript: toggleRow(\'' . $this->help_div . '\');"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';
			$ret .= '<tr id="' . $this->help_div . '" style="display:none;"><td class="helpmsg">' . $this->h_msg . '</td></tr>';
			return $ret;
		} else {
			global $pass_count;
			$pass_count++;
			$ret = '<tr><td class="pass"><strong>Pass: </strong>'. $this->p_msg . '</td></tr>';
			return $ret;
		}
	}
		
	function set_messages() {
		switch ($this->func) {
		case "wpdbBackup_init":
			$this->p_msg = "WP-DB-Backup plugin is installed and activated.";
			$this->f_msg = "WP-DB-Backup plugin is not installed and/or activated.";
			$this->h_msg = "Download the <a href='http://wordpress.org/extend/plugins/wp-db-backup/'>WP-DB-Backup plugin here</a>. You can also set it to email you a backup automatically using the options under Tools > Backup.";
			break;
		case "sg_subscribe_start":
			$this->p_msg = "Subscribe to Comments plugin is installed and activated.";
			$this->f_msg = "Subscribe to Comments plugin is not installed and/or activated.";
			$this->h_msg = "<a href='http://wordpress.org/extend/plugins/subscribe-to-comments/'>Subscribe to Comments</a> is NOT necessary but aids those who leave comments by emailing them when someone else has also left a comment. <a href='http://wordpress.org/extend/plugins/subscribe-to-comments/'>Download here</a>.";
			break;
		case "akismet_init":
			$this->p_msg = "Akismet plugin is installed and activated.";
			$this->f_msg = "Akismet plugin is not installed and/or activated.";
			$this->h_msg = "Akismet should come automatically with WordPress and helps filter out comment spam. <a href='http://wordpress.org/extend/plugins/akismet/'>Download here</a>.";
			break;
		}
	}
}

class MethodCheck {
	# Usage:
	# $var = new FunctionCheck($className, $methodDef, $helpDivName);
	# print $var;
	
	var $func;

	function __construct($c, $m, $h) {
		$this->help_div = $h;
		$this->classname = $c;
		$this->method = $m;
		$this->set_messages();
		$this->passed = method_exists($c, $m);
	}
		
	function __toString() {
		return $this->outputHtml();
	}
	
		function outputHtml() {
		// (Function Check ||    Rewrite Check     )
		if (!$this->passed || !isset($this->passed)) {
			global $fail_count;
			global $plugindir;
			$fail_count++;
			$ret = '<tr><td class="fail"><strong>Fail: </strong>'. $this->f_msg . '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript: toggleRow(\'' . $this->help_div . '\');"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';
			$ret .= '<tr id="' . $this->help_div . '" style="display:none;"><td class="helpmsg">' . $this->h_msg . '</td></tr>';
			return $ret;
		} else {
			global $pass_count;
			$pass_count++;
			$ret = '<tr><td class="pass"><strong>Pass: </strong>'. $this->p_msg . '</td></tr>';
			return $ret;
		}
	}
		
	function set_messages() {
		switch ($this->classname) {
		case "GoogleSitemapGeneratorLoader":
			$this->p_msg = "Google XML Sitemaps plugin is installed and activated.";
			$this->f_msg = "Google XML Sitemaps plugin is not installed and/or activated.";
			$this->h_msg = "<a href='http://wordpress.org/extend/plugins/google-sitemap-generator/'>Google XML Sitemaps</a> creates a Google sitemaps compliant XML-Sitemap of your blog. Everytime you edit or create a post, your sitemap is updated and all major search engines that support the sitemap protocol, like ASK.com, Google, MSN Search and YAHOO, are notified about the update.";
			break;
		case "All_in_One_SEO_Pack":
			$this->p_msg = "All in One SEO Pack plugin is installed and activated.";
			$this->f_msg = "All in One SEO Pack plugin is not installed and/or activated.";
			$this->h_msg = "<a href='http://wordpress.org/extend/plugins/all-in-one-seo-pack/'>All in One SEO Pack</a> optimizes your Wordpress blog for Search Engines (Search Engine Optimization). It is NOT necessary, just very useful.";
			break;
		}
	}
}
?>