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
		$querry="select * from dbo.Opiekun where dbo.Opiekun.IdOpiekun=".$id;
		
		$result=sqlsrv_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			$row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
			echo "<form action='aktualizujOpiekunSQL.php' method='post'>";
			echo "<label> Opiekun o id ".$id."</label><br/>";
			echo "Imie: <br/><input type='textbox' name='imie' value='".$row["Imie"]."'></br>";
			echo "Nazwisko: <br/><input type='textbox' name='nazwisko' value='".$row["Nazwisko"]."'/><br/>";
			echo "<input type='hidden' name='idOpiekun' value=".$id.">";
			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);
		}
			echo "</br>";
			echo "<input type='submit' text='AktualizujPasze' /></br>";
			echo "<button formaction='opiekunowie.php'>anuluj</button>";
			echo "</form>";
	}
				
				
	?>
	</div>
	<div id="czysc"></div>
</div>

</body>
</html>