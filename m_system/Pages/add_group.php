<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Class_db.php');
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

echo "<!DOCTYPE html>\n";

echo "<h2> Add New Group To System </h2>";

$m_gname="";
$m_desc="";
$m_home="";

if(!empty($_POST['f_submit']))
{
	$_POST=check_input($_POST); /// checks and trims input

	$m_gname=$_POST['f_gname'];
	$m_desc=$_POST['f_desc'];
	$m_home=$_POST['f_home'];
	/// check if already exists
	$DB= new ww_db;

	$sql="SELECT * FROM `system_groups` WHERE `name` = '$m_gname' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		$sql="INSERT INTO `system_groups` (`name`,`desc`,`home`,`active`)
				value ('$m_gname','$m_desc','$m_home','1')";
		$res=$DB->insert($sql);
		echo "Group Added (id=$res)";		
/// goto edit page
 echo " <head>
    <meta http-equiv=\"refresh\" content=\"0; url='./edit_group.php?r_egID=$res'\" />
  </head>		";
	}
	else
	{ /// user already exists
// list other users info
		$var=$DB->fetch_array($res);
		echo "Group exists [".$var['name']."]";
		
	}
	
}





/// Form to Add User
echo"<form method='POST'>";
echo "<input type='hidden' name='f_submit' value='Add'>";
echo "<table> ";
echo "<TR><TD> Group Name</TD><TD><input type='text' name='f_gname' value='$m_gname'></TD></TR>";
echo "<TR><TD> Descrtiption</TD><TD><input type='text' name='f_desc' value='$m_desc'></TD></TR>";
echo "<TR><TD> Home </TD><TD><input type='text' name='f_home' value='$m_home'></TD></TR>";

echo "<TR><TD> <input type='submit' name='submit' value='Add'> </TD><TD> </TD></TR>";
echo "</table> ";
echo"</form>";

echo "\n</html>";
?>

