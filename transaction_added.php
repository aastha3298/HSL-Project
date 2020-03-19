<html>
<head>
<title>
transaction_added.php
</title>
</head>
<body>

<?php

$id = $_POST["id"];
$itemsid = $_POST["itemsid"];
$price = $_POST["price"];


require("C:/xampp/htdocs/dbguest.php");

$link = mysqli_connect($host, $user, $pass,$db);
if (!$link) die("Couldn't connect to MySQL");
print "Successfully connected to server<p>";

//mysqli_select_db($link, $db)
	//or die("Couldn't open $db: ".mysqli_error($link));
//print "Successfully selected database \"$db\"<p>";
$res = explode(',',$price);
$answer = array_sum($res);
$res1 = explode(',',$itemsid);


$result1= mysqli_insert_id($link);
echo $result1;
$sql = "insert into transaction(date_of_transaction,total_price,customer_id) values"."(CURDATE(),$answer,$id)";
$result = mysqli_query($link,$sql);
$result1= mysqli_insert_id($link);
foreach($res1 as $item) {
$result = mysqli_query($link, "insert into transaction_item(transaction_id,item_id,quantity) values($result1,$item,1)");
}
echo $result1;

echo "Successfully inserted the transaction";
mysqli_close($link);

print "<p><p>Connection closed. Bye..."
?>

<p>
<a href="add_transaction.php"> back </a><br>
<a href="main.php"> back to MAIN menu</a>

</body>
</html>


