<?PHP
	$gatunek=$_POST['gatunek'];
	$opis=$_POST['opis'];
	$rasa=$_POST['rasa'];
	$plec=$_POST['plec'];
	$idZwierza=$_POST['idZwierza'];
	$budynek=$_POST['budynki'];
	$opiekun=$_POST['opiekunowie'];
	
	$gatunek=htmlentities($gatunek, ENT_QUOTES,"UTF-8");
	$opis=htmlentities($opis, ENT_QUOTES,"UTF-8");
	$rasa=htmlentities($rasa,ENT_QUOTES, "UTF-8");
	$plec=htmlentities($plec, ENT_QUOTES,"UTF-8");
	$budynek=htmlentities($budynek, ENT_QUOTES,"UTF-8");
	$opiekun=htmlentities($opiekun, ENT_QUOTES, "UTF-8");
	
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
		$querry="select dbo.Budynek.IdBudynku from dbo.Budynek where dbo.Budynek.Nazwa='".$budynek."'";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			
			$budynekId=$row['IdBudynku'];
			
			sqlsrv_free_stmt($result);
		
			$querry="select [LAPTOP-BTPQATU5\codziene].pom_opiekun.IdOpiekun from [LAPTOP-BTPQATU5\codziene].pom_opiekun where [LAPTOP-BTPQATU5\codziene].pom_opiekun.kom = '".$opiekun."'";
			
			$result=sqlsrv_query($conn,$querry);
			if($result==true)
			{
				$row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
				$opiekunId=$row['IdOpiekun'];
				sqlsrv_free_stmt($result);
				
				$querry="update dbo.Zwierze set dbo.Zwierze.Gatunek='".$gatunek."', dbo.Zwierze.Rasa='".$rasa."', dbo.Zwierze.Plec='".$plec."', dbo.Zwierze.Opis='".$opis."',dbo.Zwierze.IdBudynku=".$budynekId.", dbo.Zwierze.IdOpiekuna=".$opiekunId." where dbo.Zwierze.IdZwierzencia=".$idZwierza;
				
				$result=sqlsrv_query($conn,$querry);
				if($result==true)
				{
					sqlsrv_free_stmt($result);
					sqlsrv_close($conn);
				}
				
			}
		}
	}
	header('Location: zwierze.php');
?>