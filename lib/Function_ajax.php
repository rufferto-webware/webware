<?PHP
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// FFF Ajax Functions FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF

function ajax_dropdown_css()
{
echo"	
<style type='text/css'>

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
";
}


///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
function select_drop($_func,$f_dropdown,$f_dest)
{
echo"
	<script>
	function ".$_func."(str) 
	{

			var len = document.getElementById('".$f_dropdown."').length;
			if(len == 1)
			{
				document.getElementById('".$f_dest."').value=str;
				document.getElementById('".$f_dropdown."').style.visibility = 'hidden';
			}
	}
	</script>
 ";
}
///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
///LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
function ajax_common($f_funct_name,$f_id_dest,$f_ajax_file,$f_var_to_pass='q')
{
	echo"
	<script>
		function ".$f_funct_name."(str) 
		{
			if (str.length == 0) 
			{
				document.getElementById(\"".$f_id_dest."\").innerHTML = \"\";
				return;
			} 
			else 
			{
					var ajaxRequest;  // The variable that makes Ajax possible!
					   
					   try 
					   {
						  // Opera 8.0+, Firefox, Safari
						  ajaxRequest = new XMLHttpRequest();
					   }
					   catch (e) 
					   {
						  // Internet Explorer Browsers
						  try 
						  {
							 ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
						  }
						  catch (e) 
						  {
							 try
							 {
								ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
							 }
							 catch (e)
							 {
								// Something went wrong
								alert(\"Your browser broke!\");
								return false;
							 }
						  }
					   }

				ajaxRequest.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
						document.getElementById('".$f_id_dest."').innerHTML = this.responseText;
						var len = document.getElementById('".$f_id_dest."').length;
						if(len > 0)
						{
							document.getElementById('".$f_id_dest."').style.visibility = 'visible';
						}
						
					}
				};
				ajaxRequest.open('GET', '".$f_ajax_file."?".$f_var_to_pass."=' + str + '&d=' + + new Date().getTime(), true);
				ajaxRequest.send();
			}
		}
	</script>
	";
}














?>