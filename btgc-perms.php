<style>
body {font-size:10px !important;}
</style>
<?php
function check_perms($name,$path,$perm)
{
    clearstatcache();
    $configmod = substr(sprintf("%o", fileperms($path)), -4);
    $tdcss = (($configmod != $perm) ? "background-color:#FFBABA !important; border:0px; color:#D8000C;" : "background-color:#DFF2BF !important; border:0px; color:#4F8A10;");
    $permstat = ($configmod != $perm) ? "fail" : "pass";
    echo "<tr>";
	if($configmod=="0") {
		$configmod = "File does not exist.";
	}
    echo '<td style="' .$tdcss . '">' . $name . "</td>";
    echo '<td style="' .$tdcss . '">'. $path ."</td>";
    echo '<td style="' .$tdcss . '">' . $perm . '</td>';
    echo '<td style="' .$tdcss . '">' . $configmod . '</td>';
    echo "</tr>";
    return $permstat;
}
?>
Use your web host control panel or an FTP program like <a href="http://filezilla-project.org/">Filezilla</a> to change the directory permissions. If not sure, ask your web host as changing things could cause issues.
A .htaccess file does not always HAVE to exist. Again, if unsure please ask your web host.

<table width="100%"  border="0" cellspacing="0" style="text-align:center;">
         <tr>
        <th style="border:0px; text-align: center;"><b>Name</b></th>
        <th style="border:0px; text-align: center;"><b>File/Dir</b></th>
        <th style="border:0px; text-align: center;"><b>Needed Chmod</b></th>
        <th style="border:0px; text-align: center;"><b>Current Chmod</b></th>
    </tr>
<?php
$res = array();
$res[] = check_perms("Root Directory", "../../../", "0755");
$res[] = check_perms("wp-includes/", "../../../wp-includes", "0755");
$res[] = @check_perms(".htaccess", "../../../.htaccess", "0644");
$res[] = check_perms("wp-admin/index.php", "../../../wp-admin/index.php", "0644");
$res[] = check_perms("wp-admin/js/", "../../../wp-admin/js/", "0755");
$res[] = check_perms("wp-content/themes/", "../../themes", "0755");
$res[] = check_perms("wp-content/plugins/", "../../plugins", "0755");
$res[] = check_perms("wp-admin/", "../../../wp-admin", "0755");
$res[] = check_perms("wp-content/", "../../", "0755");
?>
</table>
<br />