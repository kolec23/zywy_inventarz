<?PHP

	$idOpiekun=$_POST['idOpiekun'];
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
		$querry="update dbo.Opiekun set dbo.Opiekun.Imie='".$imie."', dbo.Opiekun.Nazwisko='".$nazwisko."'
where dbo.Opiekun.IdOpiekun=".$idOpiekun;
		$result=sqlsrv_query($conn, $querry);
		
			
		sqlsrv_free_stmt($result);
		sqlsrv_close($conn);
			
		
	}
	header('Location: opiekunowie.php');
?>