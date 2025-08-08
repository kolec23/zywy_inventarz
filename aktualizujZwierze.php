<!DOCTYPE html>
<?php?>
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
		$id=$_POST['aktualizuj'];
		$querry="select * from dbo.Zwierze where dbo.Zwierze.IdZwierzencia=".$id;
		
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			echo "<form action='aktualizujZwierzeSQL.php' method='post'>";
			echo "<label> Zwierze o id ".$id."</label><br/>";
			echo "Gatunek: <br/><input type='textbox' name='gatunek' value='".$row["Gatunek"]."'></br>";
			echo "Opis: <br/><textarea  name='opis' >".$row["Opis"]."</textarea><br/>";
			echo "Rasa: <br/><input type='textbox' name='rasa' value='".$row["Rasa"]."'/></br>";
			echo "Płeć: <br/>";
			echo "<select name='plec'>";
			echo "<option>k</option>";
			echo "<option>m</option>";
			echo "</select>";
			echo "<br/>";
			echo "<input type='hidden' name='idZwierza' value=".$id.">";
			$idBudynku=$row["IdBudynku"];
			$idOpiekuna=$row["IdOpiekuna"];
			echo "Budynek:";
			echo "<br/>";
			echo "<select name='budynki'>";	
			echo "<option></option>";
			
			
			sqlsrv_free_stmt($result);
			$querry="select dbo.Budynek.Nazwa, dbo.Budynek.IdBudynku from dbo.Budynek";
			$result=sqlsrv_query($conn, $querry);
			
			if($result==true)
			{
				while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
				{
					if($row['IdBudynku']==$idBudynku)
					{
						echo "<option selected >".$row['Nazwa']."</option>";
					}
					else
					{
						echo "<option>".$row['Nazwa']."</option>";
					}
				}
				
				echo "</select>";
				echo "<br/>";
				echo "Opiekunowie:<br/>";
				echo "<select name='opiekunowie'>";
				sqlsrv_free_stmt($result);
				$querry="select * from [LAPTOP-BTPQATU5\codziene].pom_opiekun";
				$result=sqlsrv_query($conn, $querry);
				if($result==true)
				{
					while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
					{
						if($row['IdOpiekun']==$idOpiekuna)
						{
							echo "<option selected >".$row['kom']."</option>";
						}
						else
						{
							echo "<option>".$row['kom']."</option>";
						}
					}
					
				}
				echo "</select><br/>";
				echo "<input type='submit' text='AktualizujZwierze' /></br>";
				echo "<button formaction='zwierze.php'>anuluj</button>";
				echo "</form>";
				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);
			}
		
		}
	}
				
				
	?>
	</div>
	<div id="czysc"></div>
</div>

</body>
</html>