<?PHP


echo "<h1>
Page 3 :)
</h1>";
		echo "<input type=\"button\" value=\"View Doc iframe\" onClick=\"window.open('doc_view.php','','toolbar=no,menubar=no,status=no,resizable=yes,copyhistory=no')\" onMouseOver=\"this.style.cursor='hand';window.status='View Document';return true;\"> ";
		echo "<input type=\"button\" value=\"View Doc frame\" onClick=\"window.open('doc_viewFrame.php','','toolbar=no,menubar=no,status=no,resizable=yes,copyhistory=no')\" onMouseOver=\"this.style.cursor='hand';window.status='View Document';return true;\"> ";

?>
<script type="text/javascript" >
 parent.document.getElementById('loader').style.display='none';
</script> 