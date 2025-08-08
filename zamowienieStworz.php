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
      <li ><a href="uslugi.php">Strona Główna</a></li>
	  <li><a href="statystyki.php">statystyki sprzedaży</a></li>

    </ul>
  </div>
</nav>
</nav>




<div id="conteiner">
	<div class="Dane">
		<form action="zapiszZamowienieSQL.php" method="post">
			<hr/>
			imie: <br/><input type="text" name="imie"/><br/>
			nazwisko: <br/><input type="text" name="nazwisko"/><br/>
			telefon: <br/><input type="text" name="telefon" id='telefon'/><br/>
			
			<hr/>
			data:<br/> <input type='date' name='data'/><br/>
			<hr/>
			<select name='towar'>
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
							echo '<option>';
							echo $row['nazwa'];
							echo '</option>';
						}
						pg_free_result($result);
						pg_close($conn);
					}
				}
			
			?>
			</select>
			<br/>
			<input type="submit" text="StworzZamowienie"/>
		</form>
	</div>
	<div id="czysc"></div>
</div>

</body>
</html>