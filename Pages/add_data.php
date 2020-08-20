<?PHP
session_start();



if(!empty($_POST['f_data']))
{
	$_SESSION['test_data']=$_POST['f_data'];
	echo "
	<script> 
		parent.document.getElementById('bar_data').innerHTML = '".$_POST['f_data']."';
	</script>
	";
}



echo "Add/change Center data";
echo "<Form method='POST'>";
echo "<input type='text' name='f_data' value='".$_SESSION['test_data']."'>";
echo "<input type='submit' name='submit' value='Enter'>";
echo "</Form>";






?>

