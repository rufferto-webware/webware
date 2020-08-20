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
echo "<h2> Edit Group Info </h2>";
if(!empty($_POST['c_group']))
{// check if only one name
	$sql="SELECT * FROM  `system_groups` 
						WHERE `name` LIKE '%".$_POST['c_group']."%'
						ORDER BY `name` asc";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{
		echo "Search failed !! {".$_POST['c_group']."}";
	}
	elseif($num==1)
	{
		$var=$DB->fetch_array($res);
		$_GET['r_egID']=$var['gID'];
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
				echo"<input type='hidden' name='r_egID' value='".$row_data['id']."'>";
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
	 /// updating info

/// check if name change and no dup
$update_flag=1;
		if($_POST['f_name']!=$_POST['old_name'])
		{ /// check if group name changed
			if(sec_db_get_groupID($_POST['f_name']) > 0)
			{
				echo "<br> Group Name already exists (".$_POST['f_name'].") ";
				$update_flag=0;
			}
		}
		if($update_flag==1)
		{
			if(empty($_POST['f_active']))		$_POST['f_active']=0;
			
			$sql="UPDATE `system_groups` SET 
						`name`='".$_POST['f_name']."',  
						`desc`='".$_POST['f_desc']."',  
						`home`='".$_POST['f_home']."',  
						`active`='".$_POST['f_active']."'  
					WHERE `id` = '".$_POST['f_u']."' ";
			$res=$DB->query($sql);
			echo "<br>Updated group Info <br>";
		}
	
	/// setting var to show updated information	
		$_GET['r_egID']=$_POST['f_u'];
}





if(!empty($_GET['r_egID']))
{
	$m_gID=$_GET['r_egID']; //// ToDO: check input
	$sql="SELECT * FROM `system_groups` WHERE `id` = '$m_gID' ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	if($num==0)
	{ /// add new user
		echo "<br>Need To add Group ";	
// goto edit page
	}
	else
	{ /// group already exists
// list other users info

echo "<br>Group exists";
		$var=$DB->fetch_array($res);
		//$var=check_input($var);
		 $m_gID=$var['id'];
		 $m_name=$var['name'];
		 $m_desc=$var['desc'];
		 $m_home=$var['home'];
		 $m_active=$var['active'];
	}
	


$group_rights=sec_db_get_group_rights($m_gID);

	echo "<table  width=100%><TR><TD width=25%> ";

		echo "<form method=POST><table width=100% style='border: 2px solid green;'> ";
		echo "<input type='hidden' name='old_name' value='".$m_name."'>";
		echo "<input type='hidden' name='h_enter' value='enter'> ";
		echo "<input type='hidden' name='f_u' value='$m_gID'> ";
		echo "<TR><TD> Group Name</TD><TD><input type='text' name='f_name' value='$m_name'></TD></TR>";
		echo "<TR><TD> Description </TD><TD><input type='text' name='f_desc' value='$m_desc'></TD></TR>";
		echo "<TR><TD> Home </TD><TD><input type='text' name='f_home' value='$m_home'></TD></TR>";
		echo "<TR><TD> Active </TD><TD><input type='checkbox' ";
		if($m_active==1)
			echo " checked ";
		echo" name='f_active' value='1'></TD></TR>";
		echo "<TR><TD> ------------------------------- </TD><TD> ----------------------------- </TD></TR>";
		echo "<TR><TD> Update Group info</TD><TD><input type='submit' name='f_submit' value='Update Group'></TD></TR>";
		echo "</table></form>";
		echo "</TD><TD width=75%>";
	echo "<table width=100% > ";
		echo "<TR><TD width=50% style='border: 2px solid Blue;'>";
		echo "Group Rights";
echo "<table  width=100% >";		
echo "<TR><TH width='11'> </TH><TH>Module</TH><TH>Level</TH><TH>Dept</TH><TH>Access</TH></TR>";
$v_Offset=0;

$v_Var='u_rightS';
$_SESSION['v_var'][$v_Var]='';
if(is_array($group_rights))
	foreach($group_rights as $row)
	{
		$_SESSION['v_var'][$v_Var][$v_Offset]=array('gID' => $m_gID,
														'mod' => $row['name'],
														'level' => $row['level'],
														'dept' => $row['dept'],
														'ww_id' => $row['ww_id'],
														'access' => $row['access']);
		
		echo "<TR>
		<td width='11'>
		<input type=\"button\" value=\"del\" onClick=\"window.open(
			'del_group_rights.php?v_vaR=".$v_Var."&v_off=".$v_Offset."','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Remove Right';return true;\"></td>
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
		
		
		echo "\n\n\n\n\n <br><center><input type=\"button\" value=\"Add Rights\" onClick=\"window.open('add_group_rights.php?gRoupID=$m_gID','mywindow','scrollbars=1,width=400,height=300')\" onMouseOver=\"this.style.cursor='hand';window.status='Add Rights to User.';return true;\">";
		echo"</TD></TR>";
	echo "</table>";
/// TODO div for listing group rights



}
else
{ /// need to select group
select_drop('select_ajax_f','groupID','drop1')	;
ajax_dropdown_css();
ajax_common('group_drop','groupID',$_SESSION['url_root'].'/AJAX/group_AJAX.php','q');

echo "
<form method=POST>
	Group Name: 
<input type='hidden' name'input' value='yEp'>
<input type='submit' name'submit' value='Find'>
<br>
<div class='select-editable'>
     <select id=groupID onchange='this.nextElementSibling.value=this.value' onfocus='select_ajax_f(this.value)' >
        <option value=''></option>
    </select>
    <input type='text' id=drop1 name='c_group' value='' onkeyup='group_drop(this.value)'/>
</div>

</form>

";
}
echo "\n</html>";


?>

