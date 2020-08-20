<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

/// TODO page security



echo "<!DOCTYPE html>\n";

echo "<h2> Remove  User From Group </h2>";
echo "<body style='background-color:  #ff4d4d'>";
/// TODO onload set focus



if(!empty($_POST['f_submit']))
{
//var_dump($_POST);
		$DB= new ww_db;
		$sql="DELETE FROM `system_user_group` WHERE  
											`user_id`='".$_POST['f_uiD']."' AND 
											`group_id`='".$_POST['f_g_id']."'
							 ";
		//echo "<br>$sql<br>" ; exit();					 
		$res=$DB->query($sql);



	echo "<br><br>DONE";
	echo "<script type=\"text/javascript\">
			window.opener.location.href = 'edit_user.php?r_euID=".$_POST['f_uiD']."';
			window.close();
	</script>
	";

exit();
}




if($_GET['v_vaR'])
{
//	var_dump($_SESSION['v_var']);
	$v_pass_info=$_SESSION['v_var'][$_GET['v_vaR']][$_GET['v_off']];
	//var_dump($v_pass_info);
	$uVar=sec_db_get_user_info($v_pass_info['uID']);
/// Form 
	echo"<form method='POST'>";
	echo "<input type='hidden' name='f_uiD' value='".$v_pass_info['uID']."'>";
	echo "<input type='hidden' name='f_v_vars' value='".$_GET['v_vaR']."'>";
	echo "<input type='hidden' name='f_g_id' value='".$v_pass_info['group_id']."'>";
	echo "<table> ";
	echo "<TR><TD> User </TD><TD>".get_user_name($v_pass_info['uID'])."</TD></TR>";
	echo "<TR><TD> Group </TD><TD><input type='text' name='f_grp' value='".$v_pass_info['group']."' readonly></TD></TR>";
	echo "<TR><TD><br> </TD><TD> </TD></TR>";
	echo "<TR><TD> <input type='submit' name='f_submit' value='Remove'> </TD><TD> </TD></TR>";
	echo "</table> ";
	echo"</form>";
}
echo "\n</body>";
echo "\n</html>";
?>

