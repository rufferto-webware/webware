<?php
session_start();
include ($_SESSION['file_root'].'/lib/Class_db.php');
file_put_contents($_SESSION['file_root']."/sql.txt", "\n\n HERE".var_dump($_REQUEST),  LOCK_EX);

// get the q parameter from URL
$q = $_REQUEST["q"];

$ajax_Return = "";
if ($q !== "") 
{
	$DB= new ww_db;

	$sql="SELECT DISTINCT name  FROM `system_groups` 
						WHERE `name` LIKE '%$q%'
					ORDER BY `name` asc ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	file_put_contents($_SESSION['file_root']."/sql.txt", "\n\n".$sql,  LOCK_EX);
	for($x=0;$x<$num;$x++)
	{
		$var=$DB->fetch_array($res);
			$ajax_Return .= "\n<option>".$var['name']."</option>";
	}
}
echo $ajax_Return ;
?>