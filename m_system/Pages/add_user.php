<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Class_db.php');
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

echo "<!DOCTYPE html>\n";

echo "<h2> Add New User To System </h2>";

$m_fname="";
$m_lname="";
$m_loginname="";

if(!empty($_POST['f_submit']))
{
	$_POST=check_input($_POST); /// checks and trims input
	$m_fname=$_POST['f_fname'];
	$m_lname=$_POST['f_lname'];
	$m_loginname=$_POST['f_loginname'];
	/// check if already exists
	$DB= new ww_db;

	$sql="SELECT *,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` WHERE `loginname` = '$m_loginname' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		$sql="INSERT INTO `system_user` (`fname`,`lname`,`loginname`,`status`,`mil_rights`,`email`,`password`)
				value ('$m_fname','$m_lname','$m_loginname','1','1','".$m_loginname."@macktech.com','".password_hash('word',PASSWORD_DEFAULT)."')";
		$res=$DB->insert($sql);
		echo "User Added (id=$res)";		
// goto edit page
 echo " <head>
    <meta http-equiv=\"refresh\" content=\"0; url='./edit_user.php?r_euID=$res'\" />
  </head>		";
	}
	else
	{ /// user already exists
// list other users info
		$var=$DB->fetch_array($res);
		echo "User exists [".$var['name']."]";
		
	}
	
}





/// Form to Add User
echo"<form method='POST'>";
echo "<input type='hidden' name='f_submit' value='Add'>";
echo "<table> ";
echo "<TR><TD> First Name</TD><TD><input type='text' name='f_fname' value='$m_fname'></TD></TR>";
echo "<TR><TD> Last Name</TD><TD><input type='text' name='f_lname' value='$m_lname'></TD></TR>";
echo "<TR><TD> Login Name</TD><TD><input type='text' name='f_loginname' value='$m_loginname'></TD></TR>";
/*
echo "<TR><TD> Department</TD><TD><input type='text' name='f_dept' value=''></TD></TR>";
echo "<TR><TD> Comment </TD><TD><input type='text' name='f_comment' value=''></TD></TR>";
echo "<TR><TD> Hire Date</TD><TD><input type='text' name='f_datehire' value=''></TD></TR>";
echo "<TR><TD> Military Rights</TD><TD><input type='checkbox'checked name='f_mrights' value='1'></TD></TR>";
echo "<TR><TD> Email </TD><TD><input type='text' name='f_email' value=''></TD></TR>";
echo "<TR><TD> Cell Phone Number</TD><TD><input type='text' name='f_cell_num' value=''></TD></TR>";
echo "<TR><TD> Cell Carrier</TD><TD><input type='text' name='f_cell_carrier' value=''></TD></TR>";
//*/
echo "<TR><TD> <input type='submit' name='submit' value='Add'> </TD><TD> </TD></TR>";
echo "</table> ";
echo"</form>";

echo "\n</html>";
?>

