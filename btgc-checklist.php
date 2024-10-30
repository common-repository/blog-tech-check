<?php
include("btgc.class.php");
include("btgc-checkperms.php");
function check_perms($name, $path, $perm)
	{
		clearstatcache();
		$configmod = substr(sprintf("%o", fileperms($path)), -4);
		$permstat = ($configmod != $perm) ? "fail" : "pass";
		return $permstat;
	}
?>
<head>
<link rel="stylesheet" href="<?php echo $plugindir; ?>style.css.php" type="text/css" />
<script type="text/javascript" src="<?php echo $plugindir; ?>btgc.js"></script>
</head>
<div class="wrap">
<h2 class="heading">Blog Tech Check</h2>
<table class="form-table" id="btgc">
<?php
$admincheck = new UserCheck('admin', 'admin-help');
$rewrite = new RewriteCheck('permalinks-help');
$wpdb = new FunctionCheck('wpdbBackup_init', 'wpdb-help');
$google = new MethodCheck('GoogleSitemapGeneratorLoader', 'LoadPlugin', 'google-help');
$aioseo = new MethodCheck('All_in_One_SEO_Pack', 'All_in_One_SEO_Pack', 'aioseo-help');
$subtocomms = new FunctionCheck('sg_subscribe_start', 'subtocomms-help');
$akismet = new FunctionCheck('akismet_init', 'akismet-help');
print $admincheck;
print $rewrite;
print $checkperms;
$pass_count++;
echo '<tr><td class="pass"><strong>Pass:</strong> Your Wordpress version number is hidden by this plugin.</td></tr>';
print $wpdb;
print $google;
print $aioseo;
print $subtocomms;
print $akismet;
?>
</table>
<?php
if ($fail_count > 0) {
?>
<p class="recheck">Unfortunately your blog did not pass all the items on the list.<br />
Would you like to <a href="options-general.php?page=btgc">recheck</a>?</p>
<?php
}
?>
<p class="summary"><strong>Pass:</strong> <?php echo $pass_count; ?> | <strong>Fail:</strong> <?php echo $fail_count; ?></p>
<p align="center"><a href="http://www.blogtechguy.com/" target="_blank">Powered By Blog Tech Guy</a></p>
</div>