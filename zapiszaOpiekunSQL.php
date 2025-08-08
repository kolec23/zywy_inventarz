<?php

	$imie=$_POST['imie'];
	$nazwisko=$_POST['nazwisko'];

	
	$imie=htmlentities($imie, ENT_QUOTES,"UTF-8");
	$nazwisko=htmlentities($nazwisko, ENT_QUOTES,"UTF-8");

	
	$serverName="LAPTOP-BTPQATU5\SQLEXPRESS";
 $database="zywy_inventarz";
 $uid="";
 $pass="";

	$connection=[
		"Database" => $database,
		"Uid" => $uid,
		"PWD"=> $pass
	];
	$conn=sqlsrv_connect($serverName, $connection);
	if($conn)
	{
		$querry="insert into dbo.Opiekun(\"Imie\", \"Nazwisko\") values('".$imie."','".$nazwisko."')";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
		}
	}
	header('Location: opiekunowie.php');
	
?>