<?php 
  $conn=mysqli_connect("localhost","root","","marna_hatan");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}