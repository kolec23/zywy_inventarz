<?php
function przycisk_usun($id, $obsługa)
{
	$kod="
		<form action=".$obsługa." method='post'>
			<input type='hidden' name='usun' value=".$id.">
			<input class='przyciskUsun'  value='usuń' type='submit' />
		</form>
	";
	return $kod;
}

function informacja_o_bledzie()
{
	if(isset($_SESSION['blad_usuniecia']) )
	{
		echo "<script src='js/powiadomienieZBazydanych.js'></script>";
		unset($_SESSION['blad_usuniecia']);
	}	
}

function przycisk_aktualizuj($id, $obsługa)
{
	
	$kod="
		<form action=".$obsługa." method='post'>
			<input type='hidden' name='aktualizuj' value=".$id.">
			<input class='przyciskAktualizuj'  value='aktualizuj' type='submit' />
		</form>
	";
	return $kod;
}




?>