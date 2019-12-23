<?php

//$con = mysqli_connect("localhost","hashone122718",'+R8s1mBQIU38',"profilehashone");

error_reporting(0);



$host = "localhost";



$user = "root";



$pass = "123456";



$db = "nccaadb";





define( SQL_DRIVER, "mysqli" );

define( SQL_HOST, "localhost" );

define( SQL_DB, "nccaadb" );

define( SQL_USER, "root" );

define( SQL_PASS, "123456" );



$host = SQL_HOST;

$user = SQL_USER;

$pass = SQL_PASS;

$db = SQL_DB;



$con = mysqli_connect(SQL_HOST,SQL_USER,SQL_PASS,SQL_DB);



// Check connection

if (mysqli_connect_errno())

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }

else{

}

