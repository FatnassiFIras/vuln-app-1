<?php

$file = $_GET['filename'];
$type = $_GET['type'];
header("content-type: ".$type);
$path = "uploads/".$file;
echo file_get_contents($path);


?>