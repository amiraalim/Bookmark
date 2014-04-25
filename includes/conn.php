<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
//$username = 'root';
$username ='mysqluser';

/*** mysql password ***/
$password = 'password';

//AWS db variables
$dbname = 'bookmark';
$dbhost ='aa1bqvobjxv66a7.cudlsl6p6qkx.us-east-1.rds.amazonaws.com';
$dbport='3306';




/*** connect to the database ***/
//$link = @mysql_connect('161.76.79.2:3306', $username, $password);

/***GAE connection***/
//$sql = new mysqli($hostname,$username,$password,$dbname);

/***AWS connection***/
$sql = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);	

/*** select the database ***/
//$db=mysql_select_db('bookmark');



/*
if (isset($_SERVER['SERVER_SOFTWARE']) &&
  strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
    // Connect from App Engine.
    try{
       $sql = new mysqli(null, $username, $password, $dbname,  null, '/cloudsql/mybookmarkapps1:bookmark');
    }catch(mysqli_sql_exception $ex){ 
      throw $e; 
   } 
  } else {
    // Connect from a development environment.
    try{
       $sql = new mysqli('173.194.81.211:3306',$username,$password,$dbname);
    }catch(mysqli_sql_exception $ex){ 
      throw $e; 
   } 
  }
*/



?>

