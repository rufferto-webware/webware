<html>
<?PHP


include ('../lib/Class_table.php');
$table_header=array("Name","Position","Office","Age","Start date","Salary");
//$table_header="Name";


$table_data=array();
$table_data[]=array("Airi Satou","Accountant","Tokyo","33","11/28/2008","$162,700" );
$table_data[]=array("Angelica"," Ramos	Chief Executive Officer (CEO)","London","47","10/9/2009","$1,200,000" );
$table_data[]=array("Ashton Cox","Junior Technical Author","San Francisco","66","1/12/2009","$86,000" );
$table_data[]=array("Bradley Greer","Software Engineer","London","41","10/13/2012","$132,000" );
$table_data[]=array("Brenden Wagner","Software Engineer","San Francisco","28","6/7/2011","$206,850" );
$table_data[]=array("Brielle Williamson","Integration Specialist","New York","61","12/2/2012","$372,000" );
$table_data[]=array("Bruno Nash","Software Engineer","London","38","5/3/2011","$163,500" );
$table_data[]=array("Caesar Vance","Pre-Sales Support","New York","21","12/12/2011","$106,450" );
$table_data[]=array("Cara Stevens","Sales Assistant","New York","46","12/6/2011","$145,600" );
$table_data[]=array("Cedric Kelly","Senior Javascript Developer","Edinburgh","22","3/29/2012","$433,060" );
$table_data[]=array("Charde Marshall","Regional Director","San Francisco","36","10/16/2008","$470,600" );
$table_data[]=array("Colleen Hurst","Javascript Developer","San Francisco","39","9/15/2009","$205,500"); 
$table_data[]=array("Dai Rios","Personnel Lead",	"Edinburgh","35","9/26/2012","$217,500" );
$table_data[]=array("Donna Snider","Customer Support","New York","27","1/25/2011","$112,000" );
$table_data[]=array("Doris Wilder","Sales Assistant","Sydney","23","9/20/2010","$85,600" );
$table_data[]=array("Finn Camacho","Support Engineer","San Francisco","47","7/7/2009","$87,500" );
$table_data[]=array("Fiona Green","Chief Operating Officer (COO)","San Francisco","48","3/11/2010","$850,000" );
$table_data[]=array("Garrett Winters","Accountant","Tokyo","63","7/25/2011","$170,750" );
$table_data[]=array("Gavin Cortez","Team Leader","San Francisco","22","10/26/2008","$235,500" );
$table_data[]=array("Gavin Joyce","Developer","Edinburgh","42","12/22/2010","$92,575" );
$table_data[]=array("Gloria Little","Systems Administrator","New York","59","4/10/2009","$237,500" );
$table_data[]=array("Haley Kennedy","Senior Marketing Designer","London","43","12/18/2012","$313,500" );
$table_data[]=array("Hermione Butler","Regional Director","London","47","3/21/2011","$356,250" );
$table_data[]=array("Herrod Chandler","Sales Assistant","San Francisco","59","8/6/2012","$137,500" );
$table_data[]=array("Hope Fuentes","Secretary","San Francisco","41","2/12/2010","$109,850" );
$table_data[]=array("Howard Hatfield","Office Manager","San Francisco","51","12/16/2008","$164,500" );
$table_data[]=array("Jackson Bradshaw","Director","New York","65","9/26/2008","$645,750" );
$table_data[]=array("Jena Gaines","Office Manager","London","30","12/19/2008","$90,560" );
$table_data[]=array("Jenette Caldwell","Development Lead","New York","30","9/3/2011","$345,000" );
$table_data[]=array("Jennifer Acosta","Junior Javascript Developer","Edinburgh","43","2/1/2013","$75,650" );
$table_data[]=array("Jennifer Chang",	"Regional Director","Singapore","28","11/14/2010","$357,650" );
$table_data[]=array("Jonas Alexander","Developer","San Francisco","30","7/14/2010","$86,500" );
$table_data[]=array("Lael Greer","Systems Administrator","London","21","2/27/2009","$103,500" );
$table_data[]=array("Martena Mccray","Post-Sales support","Edinburgh","46","3/9/2011","$324,050" );
$table_data[]=array("Michael Bruce","Javascript Developer","Singapore","29","6/27/2011","$183,000" );
$table_data[]=array("Michael Silva","Marketing Designer","London","66","11/27/2012","$198,500" );
$table_data[]=array("Michelle House","Integration Specialist","Sydney","37","6/2/2011","$95,400" );
$table_data[]=array("Olivia Liang","Support Engineer","Singapore","64","2/3/2011","$234,500" );
$table_data[]=array("Paul Byrd","Chief Financial Officer (CFO)","New York","64","6/9/2010","$725,000" );
$table_data[]=array("Prescott Bartlett","Technical Author","London","27","5/7/2011","$145,000" );
$table_data[]=array("Quinn Flynn","Support Lead","Edinburgh","22","3/3/2013","$342,000" );
$table_data[]=array("Rhona Davidson","Integration Specialist","Tokyo","55","10/14/2010","$327,900" );
$table_data[]=array("Sakura Yamamoto","Support Engineer","Tokyo","37","8/19/2009","$139,575" );
$table_data[]=array("Serge Baldwin","Data Coordinator","Singapore","64","4/9/2012","$138,575" );
$table_data[]=array("Shad Decker","Regional Director","Edinburgh","51","11/13/2008","$183,000" );
$table_data[]=array("Shou Itou","Regional Marketing","Tokyo","20","8/14/2011","$163,000" );
$table_data[]=array("Sonya Frost","Software Engineer","Edinburgh","23","12/13/2008","$103,600" );
$table_data[]=array("Suki Burks","Developer","London","53","10/22/2009","$114,500" );
$table_data[]=array("Tatyana Fitzpatrick","Regional Director","London",	"19",	"3/17/2010","$385,750" );
$table_data[]=array("Thor Walton","Developer","New York","61","8/11/2013","$98,540" );
$table_data[]=array("Tiger Nixon","System Architect","Edinburgh","61","4/25/2011","$320,800" );
$table_data[]=array("Timothy Mooney","Office Manager","London","37","12/11/2008","$136,200" );
$table_data[]=array("Unity Butler","Marketing Designer","San Francisco","47","12/9/2009","$85,675" );
$table_data[]=array("Vivian Harrell","Financial Controller","San Francisco","62","2/14/2009","$452,500" );
$table_data[]=array("Yuri Berry","Chief Marketing Officer (CMO)","New York","40","6/25/2009","$675,000" );
$table_data[]=array("Zenaida Frank","Software Engineer","New York","63","1/4/2010","$125,250" );
$table_data[]=array("Zorita Serrano","Software Engineer","San Francisco","56","6/1/2012","$115,000" );


$disp_table = new cTable();

$disp_table->head($table_header);
$disp_table->data($table_data);


/// ini  and display
//echo"<head>";
$disp_table->ini();
//echo "\n </head> \n <body class=\"wide comments example\">";
//echo "\n<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
$disp_table->display();
//echo "</body>";
?>
</html>
