<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
include_once($_SESSION['file_root'].'/lib/Function_system.inc.php');
$DB= new ww_db;

echo "<!DOCTYPE html>\n";

echo "<h2> Edit Module Tab </h2>";


if(isset($_POST['org_index']) && isset($_POST['sub']) && !empty($_SESSION['tabs_var']) )
{
//	echo "<pre>";var_dump($_POST);
//	echo "org: ".$_POST['org_index']." new: ".$_POST['new_order']."<pre><br>Before: <br>";var_dump($_SESSION['tabs_var']);

	$index_offset=$_POST['new_order']-($_POST['org_index']+1);
	// copy old tab info to a temp var
	$tab_temp=$_SESSION['tabs_var'][$_POST['org_index']];
	// remove old var

 
	if($index_offset>0)
	{
	unset($_SESSION['tabs_var'][$_POST['org_index']]);
		for($p=$_POST['org_index']+1; $p <= $_POST['new_order']-1; $p++)
		{
			$_SESSION['tabs_var']=array_change_key($_SESSION['tabs_var'],$p,$p-1);
		}
	$_SESSION['tabs_var'][$_POST['new_order']-1]=$tab_temp;
	}
	elseif($index_offset<0)
	{
	unset($_SESSION['tabs_var'][$_POST['org_index']]);
		for($p=$_POST['org_index']-1; $p >= $_POST['new_order']-1; $p--)
		{
			$_SESSION['tabs_var']=array_change_key($_SESSION['tabs_var'],$p,$p+1);
		}
	$_SESSION['tabs_var'][$_POST['new_order']-1]=$tab_temp;
	}
	else
//	echo "<br>No CHange ";	

/// change tab nav/text
	$_SESSION['tabs_var'][$_POST['new_order']-1]['nav']=$_POST['nav_v'];
	$_SESSION['tabs_var'][$_POST['new_order']-1]['text']=$_POST['text_v'];

//	echo "<br> Write File ::: <br>";
	/// write data to file	
	system_write_tabs($_POST['org_mod'],$_SESSION['tabs_var']);
	
 echo "<script type=\"text/javascript\">
        window.opener.location.href = 'module.php?ref=".$_POST['org_mod']."';
        window.close(); 
</script>
";
	
	exit();
}







if(isset($_GET['tab_index']) && !empty($_GET['mod']) && !empty($_SESSION['tabs_var']) )
{
	
	//echo "<pre>";var_dump($_SESSION['tabs_var'][$_GET['tab_index']]);
	echo "<form method='POST'><Table>";
	echo "<TR><TH> Order </TH><td><select name='new_order' > "; 
			for($p=1; $p <= count($_SESSION['tabs_var']) ; $p++)
			{
						echo "<option ";
					if($p==$_GET['tab_index']+1) 
							echo "SELECTED ";
				echo ">".$p."</option>";
			}
	echo "			</select>   </td></TR>";
	echo "<TR><TH> Tab Name </TH><td><input type='text' name='text_v' Value='".$_SESSION['tabs_var'][$_GET['tab_index']]['text']."' /></td></TR>";
	echo "<TR><TH> Tab Nav </TH><td><input type='text' name='nav_v' Value='".$_SESSION['tabs_var'][$_GET['tab_index']]['nav']."' /></td></TR>";
	echo "</Table>";
	echo "<input type='hidden' name='org_index' Value='".$_GET['tab_index']."' />";
	echo "<input type='hidden' name='org_mod' Value='".$_GET['mod']."' />";

	echo "<input type='submit' name='sub' Value='Submit' />";
	echo "</form>";

}



?>