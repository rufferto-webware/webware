<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

/// TODO page security



echo "<!DOCTYPE html>\n";

echo "<h2> Add Rights To User </h2>";
/// TODO onload set focus



$m_group_name="";

if(!empty($_POST['f_submit']))
{
/// check if dup
 $dup=sec_db_check_access($_POST['f_giD'],$_POST['f_mod'],$_POST['f_level'],$_POST['f_dept'])	;
 echo " dup: $dup ";
 if($dup==-1)
 {
	sec_db_add_access_group($_POST['f_giD'],$_POST['f_mod'],$_POST['f_level'],$_POST['f_active'],$_POST['f_dept']);
	echo "<br><br> Added";
 }
 else
 {
	echo "<br><br><br> NOT added";
 }

echo "<br><br>DONE";
echo "<script type=\"text/javascript\">
        window.opener.location.href = 'edit_group.php?r_egID=".$_POST['f_giD']."';
        window.close(); 
</script>
";

exit();
}




if($_GET['gRoupID'])
{
	$mods=sec_db_get_mod_info();
/// Form 
	echo"<form method='POST'>";
	echo "<input type='hidden' name='f_giD' value='".$_GET['gRoupID']."'>";
	echo "<table> ";
	echo "<TR><TD> Group </TD><TD>".get_group_name($_GET['gRoupID'])."</TD></TR>";
	echo "<TR><TD> Module </TD><TD><select name='f_mod'> ";
			display_options_array($mods,'id','name');
		echo"</select> </TD></TR>";
	echo "<TR><TD> Level </TD><TD><select name='f_level'> ";
		display_other_options('system_other','level');
	echo"</select> </TD></TR>";
	echo "<TR><TD> Department </TD><TD><input type='text'  checked name='f_dept' value=''></TD></TR>";
	echo "<TR><TD> Access </TD><TD><input type='checkbox'  checked name='f_active' value='1'></TD></TR>";
	echo "<TR><TD><br> </TD><TD> </TD></TR>";
	echo "<TR><TD> <input type='submit' name='f_submit' value='Add'> </TD><TD> </TD></TR>";
	echo "</table> ";
	echo"</form>";
}
echo "\n</html>";
?>

