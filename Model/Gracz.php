<?
class Gracz{
	
	//ważne pola
	var $ID_G;
	var $Email;
	var $Nazwa_Gracza;
	var $WspX;
	var $WspY;
	var $Galaktyka;
	var $Punkty_Rankingu;
	
	function __construct($V_pol,$V_Naz){
		
		$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Nazwa_Gracza='".$V_Naz."'" );
		
		$wiersz = mysql_fetch_assoc($zap);
		$this->ID_G = $wiersz['ID_G'];
		$this->Email = $wiersz['Email'];
		$this->Nazwa_Gracza = $wiersz['Nazwa_Gracza'];
		$this->WspX = $wiersz['WspX'];
		$this->WspY = $wiersz['WspY'];
		$this->Galaktyka = $wiersz['Galaktyka'];
		$this->Punkty_Rankingu = $wiersz['Punkty_Rankingu'];
				
	}
	
	function zaloguj($V_pol,$V_Naz,$V_Has){
		
		$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Nazwa_Gracza='".$V_Naz."' AND Haslo='".$V_Has."'" );
		
		$wiersz = mysql_fetch_assoc($zap);
		$this->ID_G = $wiersz['ID_G'];
		$this->Email = $wiersz['Email'];
		$this->Nazwa_Gracza = $wiersz['Nazwa_Gracza'];
		$this->WspX = $wiersz['WspX'];
		$this->WspY = $wiersz['WspY'];
		$this->Galaktyka = $wiersz['Galaktyka'];
		
		$tmp_t = date("Y-m-d H:i:s",time());
		//aktualizacja godziny odwiedzin
		$V_pol->zapytanie("UPDATE GRACZ SET Ostatnia_Wizyta='".$tmp_t."' WHERE ID_G='".$this->ID_G."'");	
		
	
		//przypisanie gracza
		$_SESSION['gracz'] = $wiersz['Nazwa_Gracza'];
		
	}
	
	function aktualizuj_rankig($V_pol){
		
		$tmp_rank = 0;
		
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$this->ID_G."'" );		
		$wiersz = mysql_fetch_assoc($zap);
		$tmp_rank += $wiersz['Stacja_Elektrolizy']*2;
		$tmp_rank += $wiersz['Kopalnia']*2;
		$tmp_rank += $wiersz['Elektrownia']*2;
		$tmp_rank += $wiersz['Zaklad_Konwersji_Uranu']*2;
		$tmp_rank += $wiersz['Gwiezdna_Stocznia']*4;
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$this->ID_G."' ORDER BY ID_F DESC " );
		while($wiersz = mysql_fetch_assoc($zap))
		{
			$tmp_rank += $wiersz['Mysliwiec']*1;
			$tmp_rank += $wiersz['Niszczyciel_Barakuda']*2;
			$tmp_rank += $wiersz['Niszczyciel_Manta']*2;
			$tmp_rank += $wiersz['Krazownik_Orka']*3;
			$tmp_rank += $wiersz['Krazownik_Merlin']*5;
			$tmp_rank += $wiersz['Krazownik_Krab']*6;
			$tmp_rank += $wiersz['Pancernik']*11;
		}
		$this->Punkty_Rankingu = $tmp_rank;
		//echo $this->Punkty_Rankingu;
		//aktualizacja rankingu
		$zap = $V_pol->zapytanie("UPDATE GRACZ SET Punkty_Rankingu='".$tmp_rank."' WHERE ID_G='".$this->ID_G."'");	
	}
	
	function wyloguj($V_pol){
		
		//wypisanie gracza
		$_SESSION['gracz'] = null;
		
	}
}
?>