<?php
$servername = "fdb1030.awardspace.net";
$username = "4542046";
$password = "fcUj6i3hMHuHnk@";
$database = "4542046_phpblog";
try {
  $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>