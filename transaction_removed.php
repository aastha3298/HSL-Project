<html>
<head>
<title>
transaction_removed.php
</title>
</head>
<body>

<?php

$id = $_POST["id"];


require("C:/xampp/htdocs/dbguest.php");

$link = mysqli_connect($host, $user, $pass);
$con = mysqli_connect($host, $user, $pass,$db);
if (!$link) die("Couldn't connect to MySQL");
print "Successfully connected to server<p>";

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));
print "Successfully selected database \"$db\"<p>";
$result1=mysqli_query($link,"delete from transaction_item where transaction_id=$id ");
$result = mysqli_query($link, "delete from transaction where _id=$id and date_of_transaction between DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()");

if (!$result) print("There is no such transaction with transactionid : $id" );
else 
{
	echo "Successfully delete transactionid with transactionid : $id";    
}

mysqli_close($link);

print "<p><p>Connection closed. Bye..."
?>

<p>
<a href="remove_transaction.php"> back </a><br>
<a href="main.php"> back to MAIN menu</a>

</body>
</html>


