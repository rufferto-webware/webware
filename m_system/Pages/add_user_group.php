<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

/// TODO page security



echo "<!DOCTYPE html>\n";

echo "<h2> Add User to Group </h2>";
/// TODO onload set focus



if(!empty($_POST['f_submit']))
{
/// check if dup
 	sec_db_add_user_group($_POST['f_uiD'],$_POST['f_grp']);

echo "<br><br>DONE";
//exit();
echo "<script type=\"text/javascript\">
        window.opener.location.href = 'edit_user.php?r_euID=".$_POST['f_uiD']."';
        window.close();
</script>
";
exit();
}




if($_GET['uSerID'])
{
	$groups=sec_db_get_group_info('active');
/// Form 
	echo"<form method='POST'>";
	echo "<input type='hidden' name='f_uiD' value='".$_GET['uSerID']."'>";
	echo "<table> ";
	echo "<TR><TD> User </TD><TD>".get_user_name($_GET['uSerID'])."</TD></TR>";
	echo "<TR><TD> Group </TD><TD><select name='f_grp'> ";
			display_options_array($groups,'id','name');
	echo"</select> </TD></TR>";
	echo "<TR><TD><br> </TD><TD> </TD></TR>";
	echo "<TR><TD> <input type='submit' name='f_submit' value='Add'> </TD><TD> </TD></TR>";
	echo "</table> ";
	echo"</form>";
}
echo "\n</html>";
?>

