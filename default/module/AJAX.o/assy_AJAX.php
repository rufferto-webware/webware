<?php
include ('../lib/Class_db.php');

// get the q parameter from URL
$q = $_REQUEST["q"];

$ajax_Return = "";

// lookup all assemblies if $q is different from ""
if ($q !== "") 
{
	$DB= new ww_db;

	$sql="SELECT DISTINCT `name` 
		FROM `assy_assy` 
		WHERE `name` LIKE '%$q%' ORDER BY `name` asc ";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	for($x=0;$x<$num;$x++)
	{
		$var=$DB->fetch_array($res);
			if ($ajax_Return === "") 
			{
					$ajax_Return = $var['name'];
			}
			else 
			{
					$ajax_Return .= ", ".$var['name'];
			}
	}
}
echo $ajax_Return ;
?>