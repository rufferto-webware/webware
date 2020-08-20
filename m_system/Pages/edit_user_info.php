<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

//if(empty($_GET['r_euID']))		$_GET['r_euID']=1;
$DB= new ww_db;

echo "<!DOCTYPE html>\n";
echo "<HEAD>";

echo "</HEAD>";
echo "<h2> Edit User Info </h2>";

if(!empty($_POST['c_user']))
{// check if only one name
	$sql="SELECT * FROM  (SELECT uID,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` 
					ORDER BY `fname`,`lname` asc) A 
						WHERE `name` LIKE '%".$_POST['c_user']."%'";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{
		echo "Search failed !! {".$_POST['c_user']."}";
	}
	elseif($num==1)
	{
		$var=$DB->fetch_array($res);
		$_GET['r_euID']=$var['uID'];
	}
	else
	{
		echo "more than one";

		$table_data=$DB->fetch_all($res);
		if(is_array($table_data))
		{
			echo "<table>";
			foreach($table_data as $row_data)
			{
				echo "<form method=GET>";
				echo"<input type='hidden' name='r_euID' value='".$row_data['uID']."'>";
				echo"<TR><TD><input type='submit' name'submit' value='Select'></TD><TD>".$row_data['name']."</TD></TR>";
				echo "</form>";
			}
			echo "</table>";
		}
		exit();


	}

}
if(!empty($_POST['h_enter']))
{
	$_POST=check_input($_POST);
	if(!empty($_POST['f_p_reset']))
	{ /// if resetting password
		
		$sql="UPDATE `system_user` SET `password`='".password_hash('word',PASSWORD_DEFAULT)."'  WHERE `uID` = '".$_POST['f_u']."' ";
		$res=$DB->query($sql);
		echo "<br>password Reset (word)<br>";
		
	}
	else
	{ /// updating info

		$sql="UPDATE `system_user` SET 
					`fname`='".$_POST['f_fname']."',  
					`lname`='".$_POST['f_lname']."',  
					`dept`='".$_POST['f_dept']."',  
					`hiredate`='".$_POST['f_datehire']."',  
					`comment`='".$_POST['f_comment']."',  
					`email`='".$_POST['f_email']."',  
					`phone`='".$_POST['f_cell_num']."',  
					`carrier`='".$_POST['f_cell_carrier']."'  
				WHERE `uID` = '".$_POST['f_u']."' ";
		$res=$DB->query($sql);
		echo "<br>Updated User Info <br>";

	}
	/// setting var to show updated information	
		$_GET['r_euID']=$_POST['f_u'];
}





if(!empty($_SESSION['g_userID']))
{
	$m_uID=$_SESSION['g_userID']; //// ToDO: check input
	$sql="SELECT * FROM `system_user` WHERE `uID` = '$m_uID' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		echo "<br>Need To add User Added ";	
// goto edit page
	}
	else
	{ /// user already exists
// list other users info

echo "<br>User exists";
		$var=$DB->fetch_array($res);
		//$var=check_input($var);
		 $m_uID=$var['uID'];
		 $m_fname=$var['fname'];
		 $m_lname=$var['lname'];
		 $m_loginname=$var['loginname'];
		 $m_dept=$var['dept'];
		 $m_hire=$var['hiredate'];
		 $m_lastlogin=$var['lastlogin'];
		 $m_comment=$var['comment'];
		 $m_status=$var['status'];
		 $m_mil=$var['mil_rights'];
		 $m_email=$var['email'];
		 $m_phone=$var['phone'];
		 $m_carrier=$var['carrier'];
		 $m_pass=$var['password'];
	}
	


	if(password_verify( 'word',$m_pass ) )
		echo "<br>Default Password";
	else
		echo "<br>Not Default Password";

	echo "<table><TR><TD width=25%> ";

		echo "<form method=POST><table> ";
		echo "<TR><TD> Last Login </TD><TD> $m_lastlogin </TD></TR>";
		echo "<TR><TD>  </TD><TD> ".time_elapsed_string($m_lastlogin)." </TD></TR>";
		echo "<TR><TD> First Name</TD><TD><input type='text' name='f_fname' value='$m_fname'></TD></TR>";
		echo "<TR><TD> Last Name</TD><TD><input type='text' name='f_lname' value='$m_lname'></TD></TR>";
		echo "<TR><TD> Login Name</TD><TD><input  disabled='1' type='text' name='f_loginname' value='$m_loginname'></TD></TR>";

		echo "<TR><TD> Department</TD><TD><input type='text' name='f_dept' value='$m_dept'></TD></TR>";
		echo "<TR><TD> Comment </TD><TD><input type='text' name='f_comment' value=\"{$m_comment}\"></TD></TR>";
		echo "<TR><TD> Hire Date</TD><TD><input type='text' name='f_datehire' value='$m_hire'></TD></TR>";
		echo "<TR><TD> Email </TD><TD><input type='text' name='f_email' value='$m_email'></TD></TR>";
		echo "<TR><TD> Cell Phone Number</TD><TD><input type='text' name='f_cell_num' value='$m_phone'></TD></TR>";
		echo "<TR><TD> Cell Carrier</TD><TD><input type='text' name='f_cell_carrier' value='$m_carrier'></TD></TR>";
		echo "<TR><TD> ------------------------------- </TD><TD> ----------------------------- </TD></TR>";
		echo "<TR><TD> Update user info</TD><TD><input type='submit' name='f_submit' value='update_user'></TD></TR>";
		echo "<input type='hidden' name='h_enter' value='enter'> ";
		echo "<input type='hidden' name='f_u' value='$m_uID'> ";
		echo "</table></form>";
		echo "</TD><TD width=75%><CENTER> Rights </CENTER></TD></TR>";
	echo "</table> ";
}
else
{ /// need to select user
select_drop('select_ajax_f','userID','drop1')	;
ajax_dropdown_css();
ajax_common('user_drop','userID',$_SESSION['url_root'].'/AJAX/user_AJAX.php','q');

echo "
<form method=POST>
	User Name: 
<input type='hidden' name'input' value='yEp'>
<input type='submit' name'submit' value='Find'>
<br>
<div class='select-editable'>
     <select id=userID onchange='this.nextElementSibling.value=this.value' onfocus='select_ajax_f(this.value)' >
        <option value=''></option>
    </select>
    <input type='text' id=drop1 name='c_user' value='' onkeyup='user_drop(this.value)'/>
</div>

</form>

";
}
echo "\n</html>";


?>

