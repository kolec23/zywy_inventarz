<!DOCTYPE html>
<?php require_once 'funkcje.php';
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Zywy inventarz</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="style.css" rel="stylesheet"/>

<?php
	informacja_o_bledzie();
?>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Żywy inventarz</a>
    </div>
    <ul class="nav navbar-nav ">
      <li ><a href="zywyinwentarz.php">Strona Główna</a></li>
      <li><a href="zywyinwentarz.php">Budynki</a></li>
      <li><a href="opiekunowie.php">Opiekunowie</a></li>
      <li><a href="pasza.php">Pasze</a></li>
      <li><a href="zwierze.php">Zwięrzenta</a></li>
	  <li><a href="zwierzePasza.php">Co_jedzą?</a></li>
    </ul>
  </div>
</nav>
</nav>

<a href="zwierzePaszaStworz.php"><div class="stworz">Nowa dieta</div></a>
<div id='filtr'>
	<form action='zwierzePasza.php' metod='get'>
		<label>Gatunek</label>
		<input  type='text' value='' name='szukane'/>
		<input  type='submit' value='szukaj'/>
	</form>
</div>
<?php

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
		$querry="select * from Zwierze";
		if(isset($_GET['szukane']))
		{
			$szukane=htmlentities($_GET['szukane'], ENT_QUOTES,"UTF-8");
			if($szukane!="")
			{
				$querry="select * from dbo.Zwierze where dbo.Zwierze.Gatunek like '%".$szukane."%'";
			}
		}
		
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
			{
				echo '<div class="dane">';
				echo "<h3>";
				echo $row["IdZwierzencia"]." ".$row["Gatunek"]." ".$row["Rasa"]." ".$row["Plec"];
				echo "</h3>";
				//obsługa drugiego zapytania do wygenerowania danych
				$querry="select dbo.Pasza.NazwaPaszy from dbo.Pasza inner join dbo.ZwierzePasza on (dbo.Pasza.IdPasza=dbo.ZwierzePasza.IdPaszy) where dbo.ZwierzePasza.IdZwierza=".$row['IdZwierzencia'];
				$result2=sqlsrv_query($conn,$querry);
				if($result2==true)
				{
					while($row2=sqlsrv_fetch_array($result2,SQLSRV_FETCH_ASSOC))
					{
						echo "<ul>";
						echo "<li>".$row2['NazwaPaszy']."</li>";
						echo "</ul>";
					}
					sqlsrv_free_stmt($result2);
				}
				echo przycisk_usun($row['IdZwierzencia'], 'usunDiete.php');
				echo "</div>";
			}
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
			
		}
		
		
	}
	
?>
<div id="conteiner">

	<div id="czysc"></div>
</div>

</body>
</html>