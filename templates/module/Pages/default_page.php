<?PHP
session_start();
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
<body>
<center><h1>Welcome To webware 3.0 System  Build  Module</h1></center>

<?PHP

//echo "<br>";var_dump($_SESSION['g_prev_loc']);
//echo "<br><br>";var_dump($_SESSION['g_loc']);


?>
</body>
</html> 

