<?PHP
session_start();
include ($_SESSION['file_root'].'/lib/Function_ajax.php');
?>

<!DOCTYPE html>
<head>

<style type="text/css">

 .select-editable {
     position:relative;
     background-color:white;
     border:solid grey 1px;
     width:120px;
     height:18px;
 }
 .select-editable select {
     position:absolute;
     top:20px;
     left:0px;
     font-size:14px;
     border:none;
     width:120px;
     margin:0;
 }
 .select-editable input {
     position:absolute;
     top:0px;
     left:0px;
     width:100px;
     padding:1px;
     font-size:12px;
     border:none;
 }
 .select-editable select:focus, .select-editable input:focus {
     outline:none;
 }
</style>


<?PHP
/// creates javascript code for ajax calls
/// ajax_common($f_funct_name,$f_id_dest,$f_ajax_file,$f_var_to_pass='q')

 ajax_common('showHint','txtHint',$_SESSION['url_root'].'/AJAX/assy_AJAX.php','q');
 ajax_common('assy_drop','sel_assy',$_SESSION['url_root'].'/AJAX/assy_AJAX_opt.php','q');
 ajax_common('assy_drop2','selectID',$_SESSION['url_root'].'/AJAX/assy_AJAX_opt.php','q');
?>


<script>
function select_assy(str) 
{
		var len = document.getElementById("selectID").length;
		if(len == 1)
		{
			document.getElementById('name').value=str;
			document.getElementById('selectID').style.visibility = 'hidden';
		}
}
</script>
</head>
<body>

<p><b>Start typing an Assembly in the input field below:</b></p>
<form>
	Assy1: <input type="text" onkeyup="showHint(this.value)">
</form>
	<p>Suggestions: <span id="txtHint"></span></p>


<form>
	Assy2: 
<div class="select-editable">
     <select id=selectID onchange="this.nextElementSibling.value=this.value" onfocus="select_assy(this.value)" >
        <option value=""></option>
    </select>
    <input type="text" id=name name="c_assy" value="" onkeyup="assy_drop2(this.value)"/>
</div>
</form>
</body>
</html> 

<?PHP




?>