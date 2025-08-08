<?php
	$nazwa=$_POST['nazwa'];
	$ilosc=$_POST['ilosc'];
	$budynekNazwa=$_POST['budynek'];
	
	$nazwa=htmlentities($nazwa, ENT_QUOTES,"UTF-8");
	$ilosc=htmlentities($ilosc, ENT_QUOTES,"UTF-8");
	
	
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
		$querry="select dbo.Budynek.IdBudynku from dbo.Budynek where dbo.Budynek.Nazwa='".$budynekNazwa."'";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			
			$budynekId=$row['IdBudynku'];
			
			sqlsrv_free_stmt($result);
		
			$querry="insert into dbo.Pasza(\"NazwaPaszy\",\"Ilosc\",\"IdBudynku\") values('".$nazwa."',".$ilosc.",".$budynekId.")";
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);
			}
		}
	}
	header('Location: pasza.php');
	
?>