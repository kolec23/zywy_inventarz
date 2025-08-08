<?php
	$pasza=$_POST['pasza'];
	$zwierze=$_POST['zwierze'];

	
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
		$querry="select dbo.Pasza.IdPasza from dbo.Pasza where dbo.Pasza.NazwaPaszy='".$pasza."'";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			
			$paszaId=$row['IdPasza'];
			
			sqlsrv_free_stmt($result);
		
			$querry="select * from [LAPTOP-BTPQATU5\codziene].pom_skrocone_zwierze where [LAPTOP-BTPQATU5\codziene].pom_skrocone_zwierze.zwierze like '".$zwierze."'";
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			
				$zwierzeId=$row['IdZwierzencia'];
				
				sqlsrv_free_stmt($result);
				
			}
			
		
			$querry="insert into dbo.ZwierzePasza(\"IdPaszy\",\"IdZwierza\") values(".$paszaId.",".$zwierzeId.")";
		
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);
			}
		}
	}
	header('Location: zwierzePasza.php');
	
?>