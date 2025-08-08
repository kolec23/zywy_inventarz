<?php
	$imie=$_POST['imie'];
	$nazwisko=$_POST['nazwisko'];
	$telefon=$_POST['telefon'];
	$data=$_POST['data'];
	$towar=$_POST['towar'];
	
	$imie=htmlentities($imie, ENT_QUOTES,"UTF-8");
	$nazwisko=htmlentities($nazwisko, ENT_QUOTES,"UTF-8");
	$telefon=htmlentities($telefon, ENT_QUOTES,"UTF-8");
	$data=htmlentities($data, ENT_QUOTES,"UTF-8");
	$towar=htmlentities($towar, ENT_QUOTES,"UTF-8");
	
	
	$serverName="localhost";
	$database="zywyinwentarzuslugi";
	$port='5432';
	$user="postgres";
	$password='student';

	$connection="host=".$serverName." port=".$port." dbname=".$database." user=".$user." password=".$password;
	$conn=pg_connect($connection);
	if($conn)
	{
		$querry="select * from klienci where imie=$1 and nazwisko=$2 and telefon=$3";
		$result=pg_query_params($conn, $querry, array($imie, $nazwisko, $telefon));
		
		if($result==true)
		{
			
			if(pg_num_rows($result)>0)
			{
			$row=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			$id_klienta=$row['id'];
			pg_free_result($result);
			}
			else
			{
		
			pg_free_result($result);
			$querry="insert into klienci(\"imie\", \"nazwisko\", \"telefon\") values ($1, $2, $3)";
			$result=pg_query_params($conn, $querry, array($imie, $nazwisko, $telefon));
			pg_free_result($result);
			$querry="select * from klienci where imie=$1 and nazwisko=$2 and telefon=$3";
			$result=pg_query_params($conn, $querry, array($imie, $nazwisko, $telefon));
			$row=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			$id_klienta=$row['id'];
			pg_free_result($result);
			}
		}
		
		$querry="select * from uslugi where nazwa=$1";
		$result=pg_query_params($conn, $querry, array($towar));
		if($result==true)
		{
			$row=pg_fetch_array($result, NULL, PGSQL_ASSOC);
			$id_uslugi=$row['id'];
			pg_free_result($result);
		}
		
		$querry="insert into zamowienia(\"klient\", \"usluga\", \"datazamowienia\") values ($1, $2, $3)";
		$result=pg_query_params($conn, $querry, array($id_klienta, $id_uslugi, $data));
		if($result==true)
	{
		 pg_free_result($result);
		}
		pg_close($conn);
	}
	header('Location: uslugi.php');
?>