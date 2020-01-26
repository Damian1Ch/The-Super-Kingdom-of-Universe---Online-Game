<?
class Rejestracja{
	
	//ważne pola
	var $Email;
	var $Nazwa_Gracza;
	var $Haslo;
	
	function __construct($V_Email, $V_Nazwa_Gracza, $V_Haslo){
		//$wiersz = mysql_fetch_assoc($rezultat_zapytania);
		
		$this->Email = $V_Email;
		$this->Nazwa_Gracza = $V_Nazwa_Gracza;
		$this->Haslo = $V_Haslo;
	}
	
	function walidacja($V_pol){
		
		//email
		if(!filter_var($this->Email, FILTER_VALIDATE_EMAIL))
		{
			//nie ma takiego maila
			return 1;
		}	
				
		//nick
		if(strlen($this->Nazwa_Gracza)>=20 OR strlen($this->Nazwa_Gracza)<=4 )
		{
			//nieodpowiendia długość nicka
			return 2;
		}
		
		//hasło
		if(strlen($this->Haslo)>=20 OR strlen($this->Haslo)<=4 )
		{
			//nieodpowiendia długość hasła
			return 3;
		}
		
		//sprawdzenie powtarzalności danych w bazie
		if($_SESSION['baza']=='OFF')
		{
			//błąd wyłączonej bazy
			return 4;
		}
		//jeśli ok
		else
		{
			// Email [?]
			/*$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Email='".$this->Email."'");
			$wiersz = mysql_fetch_assoc($zap);
			if($this->Email == $wiersz['Email'])
			{
				//błąd powtórzonego E-maila
				return 5;
			}*/
			
			//Nazwa
			$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Nazwa_Gracza='".$this->Nazwa_Gracza."'");
			$wiersz = mysql_fetch_assoc($zap);
			if($this->Nazwa_Gracza == $wiersz['Nazwa_Gracza'])
			{
				//błąd powtórzonej nazwy gracza
				return 6;
			}
		}		
		
		//wszystko ok
		return 0;
		
	}
	
	function rejestracja($V_pol){
		
		//losowanie galaktyki
		$rand_Gal=1;
		
		//losowanie x i y
		do
		{
			$flaga_X_Y_OK = true;
			$min_odl = 15;
			$rand_X = rand(0,1000);
			$rand_Y = rand(0,1000);
			
			$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Galaktyka='".$rand_Gal."'");
			while ($wiersz = mysql_fetch_assoc($zap)) 
			{
				//warunek za bliskości planet
				if(($rand_X-$min_odl) < $wiersz['WspX'] AND ($rand_X+$min_odl) > $wiersz['WspX']
				AND ($rand_Y-$min_odl) < $wiersz['WspY'] AND ($rand_Y+$min_odl) > $wiersz['WspY'])
				{
					$flaga_X_Y_OK = false;
				}
			}
			
		//losuj ponownie jeśli jest ktoś zbyt blisko
		}while(!$flaga_X_Y_OK);
		
		$tmp_h = md5($this->Haslo);
		$tmp_t = date("Y-m-d H:i:s");
		$tmp_r = 0;
				
		//wpisanie do bazy
		if($V_pol->zapytanie("INSERT INTO GRACZ (Email, Nazwa_Gracza, Haslo, WspX, WspY, Galaktyka, Ostatnia_Wizyta, Punkty_Rankingu) 
			VALUES ('".$this->Email."','".$this->Nazwa_Gracza."','".$tmp_h."','".$rand_X."','".$rand_Y."','".$rand_Gal."','".$tmp_t."','".$tmp_r."')")=== TRUE)		
		{
			//wpis ok
			;//return 0;
		}
		else
		{
			//gracz wpis błedny
			return 1;
		}
		
		//wyciągnięcie ID_Gracza
		$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE Nazwa_Gracza='".$this->Nazwa_Gracza."'");
		$wiersz = mysql_fetch_assoc($zap);
		$tmp_ID_G = $wiersz['ID_G'];
		$tmp_t = date("Y-m-d H:i:s",time());
		
		if($V_pol->zapytanie("INSERT INTO PLANETA (ID_Gracza, Stacja_Elektrolizy, Kopalnia, Elektrownia, Zaklad_Konwersji_Uranu, Gwiezdna_Stocznia, Wodor, Metal, Energia, Uran, Wsp_X_Planety, Wsp_Y_Planety, Galaktyka_Planety, Tim_stamp_Ost_Bud, Tim_stamp_Akt_Sur) 
			VALUES ('".$tmp_ID_G."','1','1','1','1','1','500','500','500','500','".$rand_X."','".$rand_Y."','".$rand_Gal."','".$tmp_t."','".$tmp_t."')")=== TRUE)
		{
			//wpis ok
			;//return 0;
		}
		else
		{
			//planeta wpis błedny
			return 2;
		}
		if($V_pol->zapytanie("INSERT INTO FLOTA (ID_Gracza, Status, ID_Lokalizacja_Start, ID_Lokalizacja_Stop, Mysliwiec, Niszczyciel_Barakuda, Niszczyciel_Manta, Krazownik_Orka, Krazownik_Merlin, Krazownik_Krab, Pancernik, Tim_stamp_Start, Tim_stamp_Stop) 
					VALUES ('".$tmp_ID_G."','Obrona','".$tmp_ID_G."','".$tmp_ID_G."','0','0','0','0','0','0','0','".$tmp_t."','".$tmp_t."')")=== TRUE)
		{
			//wpis ok
			return 0;
		}
		else
		{
			//flota - błędny wpis
			return 3;
		}
		
	}
}
?>