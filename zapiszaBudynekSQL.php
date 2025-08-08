<?php
	$nazwa=$_POST['nazwa'];
	$szerokosc=$_POST['szerokosc'];
	$dlugosc=$_POST['dlugosc'];
	$opis=$_POST['opis'];
	
	$nazwa=htmlentities($nazwa, ENT_QUOTES,"UTF-8");
	$szerokosc=htmlentities($szerokosc, ENT_QUOTES,"UTF-8");
	$dlugosc=htmlentities($dlugosc, ENT_QUOTES,"UTF-8");
	$opis=htmlentities($opis, ENT_QUOTES,"UTF-8");
	
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
		$querry="insert into dbo.Budynek(\"Nazwa\", \"SzerokoscGeograficzna\", \"DlugoscGeograficzna\", \"Opis\") values('".$nazwa."',".$szerokosc.",".$dlugosc.",'".$opis."')";
		$result=sqlsrv_query($conn, $querry);
		echo $result;
		if($result==true)
		{
			
			
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
		}
	}
	header('Location: index.php');
	
?>