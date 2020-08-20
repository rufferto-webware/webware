<?PHP
session_start();

echo "path: ";
var_dump($_SESSION['nav_path']);

$R="\n\n\n\n<br><br><br>Mew\n\n\n\n\n";

echo "<br><br><br>$R";
echo date("m-d-Y H:i:s");

?>

