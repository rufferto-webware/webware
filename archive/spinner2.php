
<!DOCTYPE html>
<html>
<head>
<script>
#page-loader {
  position: absolute;
  top: 0;
  bottom: 0%;
  left: 0;
  right: 0%;
  background-color: white;
  z-index: 99;
  display: none;
  text-align: center;
  width: 100%;
  padding-top: 25px;
}


div#page_loader {
  position: absolute;
  top: 0;
  bottom: 0%;
  left: 0;
  right: 0%;
  background-color: white;
  z-index: 99;
}


</script>

<body style="margin:0;">


<div id="loader"></div>
<script type="text/javascript" >

document.getElementById('loader').style.display='block';
document.getElementById('page-loader').style.display='block';

</script>  

<?PHP
 sleep(3);

?>




<script type="text/javascript" >
</script>

<br>
<a href="#" onclick="javascript:document.getElementById('loader').style.display='block';">Click here enable</a>

<br> 

<a href="#" onclick="javascript:document.getElementById('loader').style.display='none';">Click here disable</a> 
<script type="text/javascript" >
 parent.document.getElementById('loader').style.display='none';
</script> 

</body>
</html>



