<?php
$permres = array();
$permres[] = check_perms("Root Directory", "../", "0755");
$permres[] = check_perms("wp-includes/", "../wp-includes", "0755");
$permres[] = @check_perms(".htaccess", "../.htaccess", "0644");
$permres[] = check_perms("wp-admin/index.php", "../wp-admin/index.php", "0644");
$permres[] = check_perms("wp-admin/js/", "../wp-admin/js/", "0755");
$permres[] = check_perms("wp-content/themes/", "../wp-content/themes", "0755");
$permres[] = check_perms("wp-content/plugins/", "../wp-content/plugins", "0755");
$permres[] = check_perms("wp-admin/", "../wp-admin", "0755");
$permres[] = check_perms("wp-content/", "../wp-content", "0755");
if (in_array("fail", $permres)) {
	$fail_count++;
	$permfile = file_get_contents($plugindir . "btgc-perms.php");
	$checkperms = '<tr><td class="fail"><strong>Fail:</strong> File/Folder permissions are incorrect and most likely a security issue.&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript:toggleRow(\'perm-help\');" title="Get help with this error"><img src="' . $plugindir . 'images/help.png" class="help" /></a></td></tr>';		
	$checkperms .= '<tr id="perm-help" style="display:none;"><td class="helpmsg">' . $permfile . '</td></tr>';
} else {
	$pass_count++;
	$checkperms = '<tr><td class="pass"><strong>Pass:</strong> File/Folder permissions are correct.</td></tr>';
}
?>