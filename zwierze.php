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

<a href="zwierzeStworz.php"><div class="stworz">Nowe Zwierzę</div></a>
<div id='filtr'>
	<form action='zwierze.php' metod='get'>
		<label>Podaj gatunek</label>
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
		$querry="Select dbo.Zwierze.IdZwierzencia, dbo.Zwierze.Gatunek, dbo.Zwierze.Rasa, dbo.Zwierze.Plec, dbo.Zwierze.Opis, 			dbo.Zwierze.IdBudynku, dbo.Budynek.Nazwa, dbo.Zwierze.IdOpiekuna, dbo.Opiekun.Imie, dbo.Opiekun.Nazwisko from dbo.Zwierze inner join dbo.Budynek on (dbo.Budynek.IdBudynku=dbo.Zwierze.IdBudynku)
					inner join dbo.Opiekun on (dbo.Opiekun.IdOpiekun=dbo.Zwierze.IdOpiekuna)";
		if(isset($_GET['szukane']))
		{
			$szukane=htmlentities($_GET['szukane'], ENT_QUOTES,"UTF-8");
			
			if($szukane!="")
			{
				$querry="Select dbo.Zwierze.IdZwierzencia, dbo.Zwierze.Gatunek, dbo.Zwierze.Rasa, dbo.Zwierze.Plec, dbo.Zwierze.Opis, dbo.Zwierze.IdBudynku, dbo.Budynek.Nazwa, dbo.Zwierze.IdOpiekuna, dbo.Opiekun.Imie, dbo.Opiekun.Nazwisko from dbo.Zwierze inner join dbo.Budynek on (dbo.Budynek.IdBudynku=dbo.Zwierze.IdBudynku) inner join dbo.Opiekun on (dbo.Opiekun.IdOpiekun=dbo.Zwierze.IdOpiekuna) where dbo.Zwierze.Gatunek like '%".$szukane."%'";
			}
			
		}
		
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
			{
				echo '<div class="dane">';
				echo '<h3>Id Zwierza</h3>';
				echo $row['IdZwierzencia'];
				echo '<h3>Gatunek</h3>';
				echo $row['Gatunek'];
				echo '<h3>Rasa</h3>';
				echo $row['Rasa'];
				echo '<h3>Płeć</h3>';
				echo $row['Plec'];
				if($row['Opis']!=null)
				{
					echo'<h3>Opis</h3>';
					echo $row['Opis'];
				}
				echo '<h3>Budynek</h3>';
				echo $row['Nazwa'];
				echo '<h3>Opiekun</h3>';
				echo $row['Imie'];
				echo ' ';
				echo $row['Nazwisko'];
				echo przycisk_usun($row['IdZwierzencia'], 'usunZwierze.php');
				echo przycisk_aktualizuj($row['IdZwierzencia'], 'aktualizujZwierze.php');
				echo '</div>';
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