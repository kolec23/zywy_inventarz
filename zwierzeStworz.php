<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>Zywy inventarz</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="style.css" rel="stylesheet"/>

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




<div id="conteiner">
	<div class="Dane">
		<form action="zapiszaZwierzeSQL.php" method="post">
			Gatunek: <br/><input type="textbox" name="gatunek" /><br/>
			Opis: <br/><input type="textarea" name="opis"/><br/>
			Rasa: <br/><input type="textbox" name="rasa"/><br/>
			Płeć: <br/>
			<select name="plec">
				<option>m</option>
				<option>k</option>
			</select>
			<br/>
			Budynek: <br/>
			<select name="budynek">
				<option><option>
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
		$querry="select * from dbo.Budynek";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
			{
				echo '<option>';
				echo $row['Nazwa'];
				echo '</option>';
			}
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
		}
	}
				
				
				?>
			</select>
			<br/>
			Opiekun: <br/>
			<select name="opiekun">
				
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
		$querry="select dbo.Opiekun.Imie, dbo.Opiekun.Nazwisko from dbo.Opiekun;";
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
			{
				echo '<option>';
				echo $row['Imie']." ".$row['Nazwisko'];
				echo '</option>';
			}
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
		}
	}
				
				
				?>
			</select>
			</br>
			<input type="submit" text="StworzZwierza"/>
		</form>
	</div>
	<div id="czysc"></div>
</div>

</body>
</html>