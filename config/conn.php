<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "vstack";

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
	echo "Eroare de conexiune";
}