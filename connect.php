<?php

$conn = new mysqli('localhost','root','9474615878','data');
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

?>