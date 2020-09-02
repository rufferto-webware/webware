<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
include_once($_SESSION['file_root'].'/lib/Function_system.inc.php');
include_once($_SESSION['file_root'].'/lib/security.inc.php');
$DB= new ww_db;

echo "<!DOCTYPE html>\n";

echo "<h2> Edit Module Tab </h2>";

?>
<script>
var sec_var=[  ];

<?PHP
$t_index=0;
foreach( $_SESSION['tabs_var'][$_GET['tab_index']]['security'] as $input_sec)
{
	echo "	sec_var.push([\"".$input_sec['app']."\",\"".$input_sec['level']."\"]);\n";
}

?>


display_sec();

function remove_sec(indx) 
{
	if (confirm("Are you sure you want to Remove \n\n "+sec_var[indx][0] + " : " + sec_var[indx][1]))
	 {
		sec_var.splice(indx, 1);
		document.getElementById('sec_out').value=sec_var;
		display_sec();
	}
}

function add_sec() 
{
		for (i=0 ; i < sec_var.length ; i++) {
			if(sec_var[i][0]==document.getElementById('mod').value && sec_var[i][1]==document.getElementById('level').value )
						return;
		}
	sec_var.push([document.getElementById('mod').value,document.getElementById('level').value ]);
	document.getElementById('sec_out').value=sec_var;
	display_sec();
}

function display_sec()
{
	var ind=0;
	var str_out="";
	for (i=0 ; i < sec_var.length ; i++) {
		if(sec_var[i][0]!='' && sec_var[i][1]!='')
		str_out += "<a href=# onClick=remove_sec('"+i+"') >"+sec_var[i][0] + " : " + sec_var[i][1] + "</a><br>";   
	}
		document.getElementById('sec_disp').innerHTML = str_out;	
}


</script>


<?PHP

echo "<body onload='display_sec();'>";
if(isset($_POST['org_index']) && isset($_POST['act']) && !empty($_SESSION['tabs_var']) )
{
	
	echo "Delete tab";
	
	
	unset($_SESSION['tabs_var'][$_POST['org_index']]);
	$_SESSION['tabs_var'] = array_values($_SESSION['tabs_var']); 

	system_write_tabs($_POST['org_mod'],$_SESSION['tabs_var']);
	
echo "<script type=\"text/javascript\">
        window.opener.location.href = 'module.php?ref=".$_POST['org_mod']."';
        window.close(); 
</script>
";//*/
	
	exit();
}



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
//	else	echo "<br>No CHange ";	

/// change tab nav/text
	$_SESSION['tabs_var'][$_POST['new_order']-1]['nav']=$_POST['nav_v'];
	$_SESSION['tabs_var'][$_POST['new_order']-1]['text']=$_POST['text_v'];

// security_array
	$security_array=array();
	$post_sec_array = explode(',', $_POST['sec']);
	for($p=0;$p<count($post_sec_array);$p+=2)
	{
		if($post_sec_array[$p]!='' && $post_sec_array[$p+1]!='')
			$security_array[]=array('app' => $post_sec_array[$p], 'level'=> $post_sec_array[$p+1]);
	}
	if( 2 > count($post_sec_array) )
		$security_array[]=array('app' => '', 'level'=> '');
	
	$_SESSION['tabs_var'][$_POST['new_order']-1]['security']=$security_array;
//	echo "<br> Write File ::: <br>";
	/// write data to file
//	var_dump($security_array);	
	system_write_tabs($_POST['org_mod'],$_SESSION['tabs_var']);
	
 echo "<script type=\"text/javascript\">
        window.opener.location.href = 'module.php?ref=".$_POST['org_mod']."';
        window.close(); 
</script>
";//*/
	
	exit();
}







if(isset($_GET['tab_index']) && !empty($_GET['mod']) && !empty($_SESSION['tabs_var']) )
{
$mods=sec_db_get_mod_info();	
$levels=sec_db_get_sec_level();	
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
	echo "<input type='hidden' id=sec_out name='sec' Value='' />";

	echo "<input type='submit' name='sub' Value='Submit' />";
	echo "</form>";

echo "Security:<div id='sec_disp'></div>";


echo "<br><br><br><br>";
echo "<select name=mod id=mod > ";
	foreach($mods as $mod)
	if($mod['name']!='___MAIN')
	echo "<option>".$mod['name']."</option> ";
echo "</select> ";

echo "<select name=level id=level > ";
	foreach($levels as $level)
	echo "<option>".$level['value']."</option> ";
echo "</select> ";
echo "<input type='button' value='Add' onclick='add_sec()' > ";
}
echo "<BR><BR><BR><BR><BR>";
	echo "<form method='POST'  onSubmit=\"if(!confirm('Do you really want to Delete Tab ')){return false;}\">";
	echo "<input type='hidden' name='org_index' Value='".$_GET['tab_index']."' />";
	echo "<input type='hidden' name='org_mod' Value='".$_GET['mod']."' />";
	echo "<input type='hidden' id=sec_out name='sec' Value='' />";

	echo "<input type='submit' name='act' Value='Remove' />";
	echo "</form>";



?>

</body>