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

<div class='dane'>
	<table class='tabela1'>
		<thead class='tabelaNaglowek'>
			<tr >
				<td>nazwa</td>
				<td>ilosc</td>
			</tr>
		</thead>
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
		$querry="select uslugi.nazwa , count(zamowienia.id) from uslugi inner join zamowienia on uslugi.id=zamowienia.usluga group by uslugi.nazwa";

		$result=pg_query($conn, $querry);
		if($result==true)
		{
			
			//pobieranie Danych z bazy
			while($row=pg_fetch_array($result,NULL,PGSQL_ASSOC))
			{
			
				echo "<tr class=\"tabelaDane\">";
				
				echo "<td>";
				echo $row['nazwa'];
				echo "</td>";
				
				echo "<td>";
				echo $row['count'];
				echo "</td>";
				echo "</tr>";
				
			}
			pg_free_result($result);
			pg_close($conn);
		}
	}
	
?>
	</table>
</div>
<div id="conteiner">

	<div id="czysc"></div>
</div>

</body>
</html>