<?php
	$gatunek=$_POST['gatunek'];
	$rasa=$_POST['rasa'];
	$plec=$_POST['plec'];
	$opis=$_POST['opis'];
	$opiekunNazwa=$_POST['opiekun'];
	$budynekNazwa=$_POST['budynek'];
	
	$gatunek=htmlentities($gatunek, ENT_QUOTES,"UTF-8");
	$rasa=htmlentities($rasa, ENT_QUOTES,"UTF-8");
	$opis=htmlentities($opis, ENT_QUOTES, "UTF-8");
	
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
		
			$querry="select * from [LAPTOP-BTPQATU5\codziene].pom_opiekun where kom like '".$opiekunNazwa."'";
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			
				$opiekunId=$row['IdOpiekun'];
				
				sqlsrv_free_stmt($result);
				
			}
			
		
			$querry="insert into dbo.Zwierze(\"Gatunek\", \"Rasa\",\"Plec\",\"Opis\",\"IdBudynku\",\"IdOpiekuna\") values('".$gatunek."', '".$rasa."','".$plec."','".$opis."',".$budynekId.",".$opiekunId.")";
		
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);
			}
		}
	}
	header('Location: zwierze.php');
	
?>