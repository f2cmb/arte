<?php

$connection = mysql_connect("localhost","vds86-uploadsoph","ZCID0Ud0"); //The Blank string is the password
mysql_select_db('vds86-uploadsoph');

$query = "SELECT * FROM fichiers order by id asc LIMIT 10"; //You don't need a ; like you do in SQL
$result = mysql_query($query);

echo "<h2 class='titre-page' style='color:#4098f1'>ATELIERS À VENIR : </h2><table class='events'><tr><td><b>ATELIERS (inscription obligatoire)</b></td><td><b>DATES</b></td></tr>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){ 
	
	if (!empty($row['string'])){
	
	
	  //Creates a loop to loop through results
echo "<tr><td><a target='_blank' href='http://www.sophrologieparis7.fr/upload/upload/"  . $row['string'] . "'>" . stripcslashes($row['titre']) . "</a></td><td>" . stripcslashes($row['date']) . "</td></tr>";  //$row['index'] the index here is a field name

}else{
	echo "<tr><td>" . $row['titre'] . "</a></td><td>" . $row['date'] . "</td></tr>";  //$row['index'] the index here is a field name
	
}


}

echo "</table>"; //Close the table in HTML

mysql_close(); //Make sure to close out the database connection

?>