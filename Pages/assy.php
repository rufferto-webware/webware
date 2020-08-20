<?PHP
include ('../lib/Function_ajax.php');
?>

<!DOCTYPE html>
<head>
<?PHP
ajax_dropdown_css();
/// creates javascript code for ajax calls
/// ajax_common($f_funct_name,$f_id_dest,$f_ajax_file,$f_var_to_pass='q')

 ajax_common('showHint','txtHint','../AJAX/assy_AJAX.php','q');
 ajax_common('assy_drop','sel_assy','../AJAX/assy_AJAX_opt.php','q');
 ajax_common('assy_drop2','selectID','../AJAX/assy_AJAX_opt.php','q');
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
    <input type="text" id=name name="c_assy" value="" onkeyup="assy_drop2(this.value)"  />
</div>
</form>
</body>
</html> 

<?PHP




?>