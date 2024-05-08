<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>CS 451 Assignment 4</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$manufacturer = $_POST['manufacturer'];

$manufacturer = mysqli_real_escape_string($conn, $manufacturer);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT DISTINCT c.fname, c.lname, s.description 
          FROM customer c 
          JOIN orders o ON c.customer_num = o.customer_num
          JOIN items i ON o.order_num = i.order_num
          JOIN stock s ON i.stock_num = s.stock_num
          JOIN manufact m ON s.manu_code = m.manu_code 
          WHERE m.manu_name = ";
          $query = $query."'".$manufacturer."';";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[fname]  $row[lname]  $row[description]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findCustState.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  