<?php
	session_start();
	$serverName="LAPTOP-BTPQATU5\SQLEXPRESS";
 $database="zywy_inventarz";
 $uid="";
 $pass="";
	$idPaszy=$_POST['usun'];

	$connection=[
		"Database" => $database,
		"Uid" => $uid,
		"PWD"=> $pass
	];
	$conn=sqlsrv_connect($serverName, $connection);
	if($conn)
	{
		$querry="delete from dbo.Pasza where dbo.Pasza.IdPasza=".$idPaszy;
		$result=sqlsrv_query($conn, $querry);
		echo $querry;
		if($result==true)
		{
			
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
		}
		else
		{
			$_SESSION['blad_usuniecia']=true;
		}
	}
	header('Location: pasza.php');
?>