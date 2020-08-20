<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

//if(empty($_GET['r_euID']))		$_GET['r_euID']=1;
$DB= new ww_db;

echo "<!DOCTYPE html>\n";
echo "<HEAD>";

echo "</HEAD>";
echo "<h2> Change User Password </h2>";


if(!empty($_POST['f_uID']))
{
	if($_POST['f_uID'] != $_SESSION['g_userID'])
	{
		echo "<h1> Invalid </h1>";
		exit();
	}
		
	
	
	$_POST=check_input($_POST);
	$m_uID=$_SESSION['g_userID']; //// ToDO: check input
	$sql="SELECT *,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` WHERE `uID` = '$m_uID' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		echo "<br>User Error ";	
	}
	else
	{ /// user  exists

		$var=$DB->fetch_array($res);
		//$var=check_input($var);
		 $m_uID=$var['uID'];
		 $m_name=$var['name'];
		 $m_loginname=$var['loginname'];
		 $m_pass=$var['password'];
		 $m_lastlogin=$var['lastlogin'];
	}
	if(!password_verify( $_POST['f_c_pass'],$m_pass ) )
	{
		echo "Password Fail";
		exit();
	}
		
		$sql="UPDATE `system_user` SET 
					`password`='".password_hash($_POST['f_n_pass'],PASSWORD_DEFAULT)."'  
				WHERE `uID` = '".$_POST['f_uID']."' ";
				
		$res=$DB->query($sql);
		echo "<br>Updated User Password  <br>";
	exit();
	
}





if(!empty($_SESSION['g_userID']))
{
	$m_uID=$_SESSION['g_userID']; //// ToDO: check input
	$sql="SELECT *,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` WHERE `uID` = '$m_uID' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		echo "<br>User Error ";	
	}
	else
	{ /// user  exists

		$var=$DB->fetch_array($res);
		//$var=check_input($var);
		 $m_uID=$var['uID'];
		 $m_name=$var['name'];
		 $m_loginname=$var['loginname'];
		 $m_pass=$var['password'];
		 $m_lastlogin=$var['lastlogin'];
	}
	


?>
<script>
var check = function() 
{
	if(document.getElementById('c_pass').value != '')
	{
	  if (document.getElementById('n_pass').value == document.getElementById('r_pass').value && document.getElementById('n_pass').value != '' )
		  {
			document.getElementById('message').style.color = 'green';
			document.getElementById('message').innerHTML = 'matching';
			document.getElementById("submit").disabled = false;
		  } 
		 else 
		  {
			document.getElementById('message').style.color = 'red';
			if(document.getElementById('n_pass').value == '')
			{
				document.getElementById('message').innerHTML = 'New Password Is blank';
			}
			else
			{
				document.getElementById('message').innerHTML = 'not matching';
			}
			document.getElementById("submit").disabled = true;
		  }
	}
	else
	{
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = ' Current Password Needs to filed out';
		document.getElementById("submit").disabled = true;
	}
}
</script>
<?PHP



	if(password_verify( 'word',$m_pass ) )
		echo "<br>Default Password";
	else
		echo "<br>Not Default Password";


	echo "<table><TR><TD width=25%> ";

		echo "<form method=POST> ";
		echo "<TR><TD> Last Login </TD><TD> $m_lastlogin </TD></TR>";
		echo "<TR><TD> User </TD><TD>$m_name</TD></TR>";
		echo "<TR><TD> Login Name</TD><TD>$m_loginname</TD></TR>";

		echo "<input type='hidden' name='f_uID' value='$m_uID'>";
		echo "<TR><TD> Current Password</TD><TD><input type='password' id='c_pass' name='f_c_pass' value=''  onkeyup='check();'></TD></TR>";
		echo "<TR><TD> New Password</TD><TD><input type='password' id='n_pass' name='f_n_pass' value=''  onkeyup='check();'></TD></TR>";
		echo "<TR><TD> Enter Again</TD><TD><input type='password' id='r_pass' name='f_r_pass' value='' onkeyup='check();'></TD></TR>";
		echo "<TR><TD> Change Password</TD><TD><input type='submit' disabled='true' id='submit' name='f_submit' value='UPDATE'></TD></TR>";
		echo "</form> ";
	echo "</table> ";
	echo " <span id='message'></span>";
}

echo "\n</html>";



?>

