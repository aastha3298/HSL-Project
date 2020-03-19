<html>
<head>
<title>
article_added.php
</title>
</head>
<body>

<?php

$title = $_POST["title"];
$magazine = $_POST["magazineid"];
$volume = $_POST["volume"];
$pageno = $_POST["pageno"];
$author = $_POST["author"];

require("C:/xampp/htdocs/dbguest.php");

$link = mysqli_connect($host, $user, $pass,$db);
if (!$link) die("Couldn't connect to MySQL");
print "Successfully connected to server<p>";

//$result = mysqli_query($link, "select * from magazine where _id=$magazine");

//if (!$result) print("ERROR: ".mysqli_error($link));

//if (!$result) print("ERROR: ".mysqli_error($link));
$sql = "insert into volume(magazine_id,volume_no) values($magazine,$volume)";
$result3 = mysqli_query($link, $sql);
$id = mysqli_insert_id($link);
//$result3 = mysqli_query($link, "insert into volume(magazine_id,volume_no) values"."($magazine,$volume)");
//$result2 = mysqli_insert_id($link);

$result1 = mysqli_query($link, "insert into article(title,page_no,volume_id) values('$title',$pageno,$id)");
$result2 = mysqli_insert_id($link);
$result1 = mysqli_query($link, "insert into volume_attr(volume_id,year) values('$id',2019)");
$res1 = explode(',',$author);
foreach($res1 as $item) {
$result = mysqli_query($link, "select _id from author where fname='$item'");
if($result)
{
	

//$result4 = mysqli_query($link, "select _id from article where title='$title' and volume_id=$volume and page_no=$pageno");
while ($row = $result->fetch_assoc()) {

$result4 = mysqli_query($link, "insert into author_article(author_id,article_id) values"."($row[_id],$result2)");
}
}
else
{
	echo "There is no such author as :$item";	
}
}
if (!$result || !$result1 || !$result2 || !$result3 ) print("ERROR: ".mysqli_error($link));
else {
   
    print "New record created succesfully";
    
}

mysqli_close($link);

print "<p><p>Connection closed. Bye..."
?>

<p>
<a href="add_article.php"> back </a><br>
<a href="main.php"> back to MAIN menu</a>

</body>
</html>


