<?php 
require_once('../config.php');

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if ( !$conn ) { die ('Could not connect: ' . mysqli_error($conn)); }

$user_id = $_SERVER['persistent-id'];
$jsondata = mysqli_escape_string($conn, $_POST[$appname . '-data']);

$sql = <<<sqlstring
INSERT INTO paths ( id, kml_string, json_string, time_submitted, user_id ) VALUES ( DEFAULT, "", "$jsondata", NOW(), "$user_id" )
sqlstring;

mysqli_select_db($conn, $dbname);

$retval = mysqli_query($conn, $sql);

        if ( !$retval ) { die('Could not enter data: ' . mysqli_error($conn)); }
        
mysqli_close($conn);
?>