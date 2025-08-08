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
      <a class="navbar-brand" href="#">Zamówienia</a>
    </div>
    <ul class="nav navbar-nav ">
      <li ><a href="uslugi.php">Strona Główna</a></li>
	   <li><a href="statystyki.php">statystyki sprzedaży</a></li>
    </ul>
  </div>
</nav>
</nav>
<a href="zamowienieStworz.php"><div class="stworz">Nowy zamowienie</div></a>
<div id='filtr'>
	<form action='uslugi.php' metod='get'>
		<label>Podaj produkt</label>
		<input  type='text' value='' name='szukane'/>
		<input  type='submit' value='szukaj'/>
	</form>
</div>
<?php
 $serverName="localhost";
 $database="zywyinwentarzuslugi";
 $port='5432';
 $user="postgres";
 $password='student';

	$connection="host=".$serverName." port=".$port." dbname=".$database." user=".$user." password=".$password;
	$conn=pg_connect($connection);
	if($conn)
	{
		$querry="select * from uslugi";
		if(isset($_GET['szukane']))
		{
			$szukane=htmlentities($_GET['szukane'], ENT_QUOTES, "UTF-8");
			if($szukane!="")
			{
				$querry="select * from uslugi where nazwa like '%".$szukane."%'";
			}
		}
		$result=pg_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=pg_fetch_array($result,NULL,PGSQL_ASSOC))
			{
				echo '<div class="dane">';
				echo '<h3>Id uslugi</h3>';
				echo $row['id'];
				echo '<h3>Nazwa</h3>';
				echo $row['nazwa'];
				echo '</div>';
			}
			pg_free_result($result);
			pg_close($conn);
		}
	}
	
?>
<div id="conteiner">

	<div id="czysc"></div>
</div>

</body>
</html>