<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

/// TODO page security



echo "<!DOCTYPE html>\n";

echo "<h2> Remove Rights To User </h2>";
/// TODO onload set focus



if(!empty($_POST['f_submit']))
{
var_dump($_POST);
		$DB= new ww_db;
		$sql="DELETE FROM `system_rights` WHERE `access`='".$_POST['f_access']."' AND 
											`group`='".$_POST['f_giD']."' AND 
											`level`='".$_POST['f_level']."' AND 
											`ww_id`='".$_POST['f_mod_id']."' AND 
											`dept`='".$_POST['f_dept']."' AND 
											`user_id`='0'
							 ";
	//	echo "<br>$sql<br>" ; exit();					 
		$res=$DB->query($sql);



	echo "<br><br>DONE";
	echo "<script type=\"text/javascript\">
			window.opener.location.href = 'edit_group.php?r_egID=".$_POST['f_giD']."';
			window.close();
	</script>
	";

exit();
}




if($_GET['v_vaR'])
{
//	var_dump($_SESSION['v_var']);
	$v_pass_info=$_SESSION['v_var'][$_GET['v_vaR']][$_GET['v_off']];
	$uVar=sec_db_get_user_info($v_pass_info['gID']);
/// Form 
	echo"<form method='POST'>";
	echo "<input type='hidden' name='f_giD' value='".$v_pass_info['gID']."'>";
	echo "<input type='hidden' name='f_mod_id' value='".$v_pass_info['ww_id']."'>";
	echo "<input type='hidden' name='f_v_vars' value='".$_GET['v_vaR']."'>";
	echo "<table> ";
	echo "<TR><TD> Group </TD><TD>".get_group_name($v_pass_info['gID'])."</TD></TR>";
	echo "<TR><TD> Module </TD><TD><input type='text' name='f_mod' value='".$v_pass_info['mod']."' readonly></TD></TR>";
	echo "<TR><TD> Level </TD><TD><input type='text' name='f_level' value='".$v_pass_info['level']."' readonly></TD></TR>";
	echo "<TR><TD> Department </TD><TD><input type='text' name='f_dept' value='".$v_pass_info['dept']."' readonly></TD></TR>";
	echo "<TR><TD> Access </TD><TD><input type='text' name='f_access' value='".$v_pass_info['access']."' readonly></TD></TR>";
	echo "<TR><TD><br> </TD><TD> </TD></TR>";
	echo "<TR><TD> <input type='submit' name='f_submit' value='Remove'> </TD><TD> </TD></TR>";
	echo "</table> ";
	echo"</form>";
}
echo "\n</html>";
?>

