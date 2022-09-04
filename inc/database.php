<?php

$myhost = "sql213.epizy.com";
$myuser = "icei_32517729";
$mypass = "opkinshuk09999";
$mydb = "icei_32517729_idk";

$con = mysqli_connect($myhost, $myuser, $mypass, $mydb);

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>