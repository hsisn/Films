<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdfilms";

// Create connection
$connexion = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
} 
?>