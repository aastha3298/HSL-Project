<html>
<head>
<title>
Customer_added.php
</title>
</head>
<body>

<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$phoneno = $_POST["phoneno"];
$address = $_POST["address"];

require("C:/xampp/htdocs/dbguest.php");

$link = mysqli_connect($host, $user, $pass);
$con = mysqli_connect($host, $user, $pass,$db);
if (!$link) die("Couldn't connect to MySQL");
print "Successfully connected to server<p>";

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));
print "Successfully selected database \"$db\"<p>";

$result = mysqli_query($link, "select fname,lname from customer where fname=$fname and lname=$lname");

if ($result) print("There is already a customer with Firstname: $fname and LastName: $lname" );
else {
   
  $result1=  mysqli_query($link, "insert into customer(phone_no,fname,lname,address,discount_code) values($phoneno,'$fname','$lname','$address',5)");
	echo "Successfully inserted into customer database with firstname : $fname and LastName: $lname";
    
}

mysqli_close($link);

print "<p><p>Connection closed. Bye..."
?>

<p>
<a href="add_customer.php"> back </a><br>
<a href="main.php"> back to MAIN menu</a>

</body>
</html>


