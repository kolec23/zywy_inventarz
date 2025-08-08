<?PHP

	$idBudynku=$_POST['idBudynku'];
	$nazwa=$_POST['nazwa'];
	$szerokosc=$_POST['szerokosc'];
	$dlugosc=$_POST['dlugosc'];
	$opis=$_POST['opis'];
	
	$nazwa=htmlentities($nazwa, ENT_QUOTES,"UTF-8");
	$szerokosc=htmlentities($szerokosc, ENT_QUOTES,"UTF-8");
	$dlugosc=htmlentities($dlugosc,ENT_QUOTES, "UTF-8");
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
		$querry="update dbo.Budynek set dbo.Budynek.Nazwa='".$nazwa."', dbo.Budynek.Opis='".$opis."', dbo.Budynek.DlugoscGeograficzna=".$dlugosc.", dbo.Budynek.SzerokoscGeograficzna=".$szerokosc." where dbo.Budynek.IdBudynku=".$idBudynku;
		$result=sqlsrv_query($conn, $querry);
		
			
		sqlsrv_free_stmt($result);
		sqlsrv_close($conn);
			
		
	}
	header('Location: index.php');
?>