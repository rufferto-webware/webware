<?PHP
session_start();
include_once ($_SESSION['file_root'].'/lib/Function_ajax.php');
include_once($_SESSION['file_root'].'/lib/Common.inc.php');

$DB= new ww_db;

echo "<!DOCTYPE html>\n";
echo "<HEAD>";
echo"
<script>
function test(str)
{
	document.getElementById(str).innerHTML = 'More Rights <br> your rights';
	
}

function text_close()
{
	document.getElementsByClassName('System').innerHTML = '';
	
}

</script>
";


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

	$update_flag=1;
	if($_POST['f_loginname']!=$_POST['h_ulog'])
		{ /// check if login name changed
			if(sec_db_get_userID($_POST['f_name']) > 0)
			{
				echo "<br> Login Name Name already exists (".$_POST['f_name'].") ";
				$update_flag=0;
			}
		}
	 if($update_flag==1)
	  {

		$sql="UPDATE `system_user` SET 
					`fname`='".$_POST['f_fname']."',  
					`lname`='".$_POST['f_lname']."',  
					`loginname`='".$_POST['f_loginname']."',  
					`dept`='".$_POST['f_dept']."',  
					`hiredate`='".$_POST['f_datehire']."',  
					`comment`='".$_POST['f_comment']."',  
					`status`='".$_POST['f_active']."',  
					`mil_rights`='".$_POST['f_mrights']."',  
					`email`='".$_POST['f_email']."',  
					`phone`='".$_POST['f_cell_num']."',  
					`carrier`='".$_POST['f_cell_carrier']."'  
				WHERE `uID` = '".$_POST['f_u']."' ";
		$res=$DB->query($sql);
		echo "<br>Updated User Info <br>";
	  }

	}
	/// setting var to show updated information	
		$_GET['r_euID']=$_POST['f_u'];
}





if(!empty($_GET['r_euID']))
{
	$m_uID=$_GET['r_euID']; //// ToDO: check input
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

echo "<br>User exists ($m_uID) ";
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

$user_rights=sec_db_get_user_rights($m_uID);
$user_groups=sec_db_get_user_groups($m_uID);
	echo "<table  width=100%><TR><TD width=25%> ";

		echo "<form method=POST><table width=100% style='border: 2px solid green;'> ";
		echo "<TR><TD> Last Login </TD><TD> $m_lastlogin </TD></TR>";
		echo "<TR><TD>  </TD><TD> ".time_elapsed_string($m_lastlogin)." </TD></TR>";
		echo "<TR><TD> First Name</TD><TD><input type='text' name='f_fname' value='$m_fname'></TD></TR>";
		echo "<TR><TD> Last Name</TD><TD><input type='text' name='f_lname' value='$m_lname'></TD></TR>";
		echo "<TR><TD> Login Name</TD><TD><input type='text' name='f_loginname' value='$m_loginname'></TD></TR>";

		echo "<TR><TD> Department</TD><TD><input type='text' name='f_dept' value='$m_dept'></TD></TR>";
		echo "<TR><TD> Comment </TD><TD><input type='text' name='f_comment' value=\"{$m_comment}\"></TD></TR>";
		echo "<TR><TD> Hire Date</TD><TD><input type='text' name='f_datehire' value='$m_hire'></TD></TR>";
		echo "<TR><TD> Military Rights</TD><TD><input type='checkbox'";
		if($m_mil==1)
			echo " checked ";
		echo " name='f_mrights' value='1'></TD></TR>";
		echo "<TR><TD> Active </TD><TD><input type='checkbox' ";
		if($m_status==1)
			echo " checked ";
		echo" name='f_active' value='1'></TD></TR>";
		echo "<TR><TD> Email </TD><TD><input type='text' name='f_email' value='$m_email'></TD></TR>";
		echo "<TR><TD> Cell Phone Number</TD><TD><input type='text' name='f_cell_num' value='$m_phone'></TD></TR>";
		echo "<TR><TD> Cell Carrier</TD><TD><input type='text' name='f_cell_carrier' value='$m_carrier'></TD></TR>";
		echo "<TR><TD> ------------------------------- </TD><TD> ----------------------------- </TD></TR>";
		echo "<TR><TD> Update user info</TD><TD><input type='submit' name='f_submit' value='update_user'></TD></TR>";
		echo "<TR><TD> ------------------------------- </TD><TD> ----------------------------- </TD></TR>";
		echo "<TR><TD> <input type='submit' name='f_p_reset' value='Reset'> Password Reset</TD><TD>(word)</TD></TR>";
		echo "<input type='hidden' name='h_ulog' value='$m_loginname'> ";
		echo "<input type='hidden' name='h_enter' value='enter'> ";
		echo "<input type='hidden' name='f_u' value='$m_uID'> ";
		echo "</table></form>";
		echo "</TD><TD width=75%>";
	echo "<table width=100% > ";
		echo "<TR><TD width=50% style='border: 2px solid Blue;'>";
		echo "User Rights";
echo "<table  width=100% >";		
echo "<TR><TH width='11'> </TH><TH>Module</TH><TH>Level</TH><TH>Dept</TH><TH>Access</TH></TR>";
$v_Offset=0;
$v_Var='u_rightS';
$_SESSION['v_var'][$v_Var]='';
if(is_array($user_rights))
	foreach($user_rights as $row)
	{
		$_SESSION['v_var'][$v_Var][$v_Offset]=array('uID' => $m_uID,
														'mod' => $row['name'],
														'level' => $row['level'],
														'dept' => $row['dept'],
														'ww_id' => $row['ww_id'],
														'access' => $row['access']);
		
		echo "<TR>
		<td width='11'>
		<input type=\"button\" value=\"del\" onClick=\"window.open(
			'del_user_rights.php?v_vaR=".$v_Var."&v_off=".$v_Offset."','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Remove Right';return true;\"></td>
		<Td    style='text-align:center; border-width: 1px;    padding: 1px;    border-style: inset;    border-color: gray;    background-color: #80ffff;    -moz-border-radius: ;'>
			".$row['name']."</Td>
		<Td style='text-align:center;    border-width: 1px;    padding: 1px;    border-style: inset;    border-color: gray;    background-color: #80ffff;    -moz-border-radius: ;'>
			".$row['level']."</Td>
		<Td style='text-align:center;    border-width: 1px;    padding: 1px;    border-style: inset;    border-color: gray;    background-color: #80ffff;    -moz-border-radius: ;'>
			".$row['dept']."</Td>
		<Td style='text-align:center;    border-width: 1px;    padding: 1px;    border-style: inset;    border-color: gray;    background-color: #80ffff;    -moz-border-radius: ;'>
			".$row['access']."</Td></TR>";
		$v_Offset++;
	}
echo "</table>";		
		
		
		echo "\n\n\n\n\n <br><center><input type=\"button\" value=\"Add Rights\" onClick=\"window.open('add_user_rights.php?uSerID=$m_uID','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Add Rights to User.';return true;\">";
		echo "</center></TD><TD width=50% style='border: 2px solid orange;'>";
		
		echo "Group Rights";
echo "<CENTER><table  width=50% >";		
echo "<TR><TH> </TH><TH>Groups</TH></TR>";
$v_Offset=0;
$v_Var='u_groupS';
$_SESSION['v_var'][$v_Var]='';
if(is_array($user_groups))
	foreach($user_groups as $row)
	{
		$_SESSION['v_var'][$v_Var][$v_Offset]=array('uID' => $m_uID,
														'group' => $row['name'],
														'group_id' => $row['id']
														);
		echo "<TR>
		<td width='11'>
		<input type=\"button\" value=\"del\" onClick=\"window.open(
			'del_user_group.php?v_vaR=".$v_Var."&v_off=".$v_Offset."','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Remove Right';return true;\"></td>
		<Td title='some rights\n another right' style='text-align:center ;   border-width: 1px;    padding: 1px;    border-style: inset;    border-color: gray;    background-color: #ffdb4d;    -moz-border-radius: ;'>
		<a  onclick=\"test('".$row['name']."')\" >	".$row['name']." </a></Td></TR>
		<TR><TD></TD><TD><div class='".$row['name']."' id='".$row['name']."'><div></Td></TR>";
		$v_Offset++;
	}
echo "</table></CENTER>";		
		echo "\n\n\n\n\n <br><center><input type=\"button\" value=\"Add Group\" onClick=\"window.open('add_user_group.php?uSerID=$m_uID','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Add User To Groups.';return true;\">";
		
//		echo "\n\n\n\n\n <br><center><input type=\"button\" value=\"test\" onClick=\"text_close()\">";
	echo "</center></TD></TR></table> ";
		echo"</TD></TR>";
	echo "</table>";
/// TODO div for listing group rights



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

