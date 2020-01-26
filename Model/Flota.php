<?
class Flota{
	
	//ważne pola
	var $ID_F;
	var $ID_Gracza;
	var $Status; //'Rekrutacja' / 'Atak' / 'Obrona'
	var $ID_Lokalizacja_Start;// aktualnie operuje się na id gracza a nie planet
	var $ID_Lokalizacja_Stop;// aktualnie operuje się na id gracza a nie planet
	var $Mysliwiec;
	var $Niszczyciel_Barakuda;
	var $Niszczyciel_Manta;
	var $Krazownik_Orka;
	var $Krazownik_Merlin;
	var $Krazownik_Krab;
	var $Pancernik;
	var $Tim_stamp_Start;
	var $Tim_stamp_Stop;
	var $Rabunek_Wodor;
	var $Rabunek_Metal;
	var $Rabunek_Uran;
	var $Nazwa_Ofiary;
	
	
	function __construct($V_Mys,$V_N_B,$V_N_M,$V_K_O,$V_K_M,$V_K_K,$V_Pan){
		
		$this->Mysliwiec = 0 + $V_Mys;
		$this->Niszczyciel_Barakuda = 0 + $V_N_B;
		$this->Niszczyciel_Manta = 0 + $V_N_M;
		$this->Krazownik_Orka = 0 + $V_K_O;
		$this->Krazownik_Merlin = 0 + $V_K_M;
		$this->Krazownik_Krab = 0 + $V_K_K;
		$this->Pancernik = 0 + $V_Pan;
		
	}
	
	function stan_obrona($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Obrona'");
		$wiersz = mysql_fetch_assoc($zap);
		$this->Mysliwiec = $wiersz['Mysliwiec'];
		$this->Niszczyciel_Barakuda = $wiersz['Niszczyciel_Barakuda'];
		$this->Niszczyciel_Manta = $wiersz['Niszczyciel_Manta'];
		$this->Krazownik_Orka = $wiersz['Krazownik_Orka'];
		$this->Krazownik_Merlin = $wiersz['Krazownik_Merlin'];
		$this->Krazownik_Krab = $wiersz['Krazownik_Krab'];
		$this->Pancernik = $wiersz['Pancernik'];
		
	}
	
	function stan_rekrutacja($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Rekrutacja'");
		$wiersz = mysql_fetch_assoc($zap);
		$this->Mysliwiec = 0 + $wiersz['Mysliwiec'];
		$this->Niszczyciel_Barakuda = 0 + $wiersz['Niszczyciel_Barakuda'];
		$this->Niszczyciel_Manta = 0 + $wiersz['Niszczyciel_Manta'];
		$this->Krazownik_Orka = 0 + $wiersz['Krazownik_Orka'];
		$this->Krazownik_Merlin = 0 + $wiersz['Krazownik_Merlin'];
		$this->Krazownik_Krab = 0 + $wiersz['Krazownik_Krab'];
		$this->Pancernik = 0 + $wiersz['Pancernik'];
		
	}
	
	function stan_atak($V_pol,$V_ID_G){
		
		$this->Mysliwiec = 0;
		$this->Niszczyciel_Barakuda = 0;
		$this->Niszczyciel_Manta = 0;
		$this->Krazownik_Orka = 0;
		$this->Krazownik_Merlin = 0;
		$this->Krazownik_Krab = 0;
		$this->Pancernik = 0;
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Atak'");
		while($wiersz = mysql_fetch_assoc($zap))
		{
			$this->Mysliwiec += $wiersz['Mysliwiec'];
			$this->Niszczyciel_Barakuda += $wiersz['Niszczyciel_Barakuda'];
			$this->Niszczyciel_Manta += $wiersz['Niszczyciel_Manta'];
			$this->Krazownik_Orka += $wiersz['Krazownik_Orka'];
			$this->Krazownik_Merlin += $wiersz['Krazownik_Merlin'];
			$this->Krazownik_Krab += $wiersz['Krazownik_Krab'];
			$this->Pancernik += $wiersz['Pancernik'];
		}
		
	}
	
	function tablica_floty_atak($V_pol,$V_ID_G){
		
		;
		$s = new Flota(0,0,0,0,0,0,0);
		$i = 1;
		$t_tab[$i] = $s;
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Atak'");
		while($wiersz = mysql_fetch_assoc($zap))
		{
			$s = new Flota(0,0,0,0,0,0,0);
			$s->Mysliwiec = $wiersz['Mysliwiec'];
			$s->Niszczyciel_Barakuda = $wiersz['Niszczyciel_Barakuda'];
			$s->Niszczyciel_Manta = $wiersz['Niszczyciel_Manta'];
			$s->Krazownik_Orka = $wiersz['Krazownik_Orka'];
			$s->Krazownik_Merlin = $wiersz['Krazownik_Merlin'];
			$s->Krazownik_Krab = $wiersz['Krazownik_Krab'];
			$s->Pancernik = $wiersz['Pancernik'];
			$s->Tim_stamp_Stop = $wiersz['Tim_stamp_Stop'];
			$s->ID_Lokalizacja_Stop = $wiersz['ID_Lokalizacja_Stop'];
			
			$zap1 = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE ID_G='".$s->ID_Lokalizacja_Stop."'");
			$wiersz1 = mysql_fetch_assoc($zap1);
			$s->Nazwa_Ofiary = $wiersz1['Nazwa_Gracza'];
			$t_tab[$i] = $s;
			$i++;			
		}
		
		return $t_tab;
	}
	
	
	function rekrutuj($V_pol,$V_ID_G){
		
		//dostępność surowców
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		//echo " Wbaza".$wiersz['Wodor']." Wthis".$this->Wodor." ";
		$tmp_ID_P = $wiersz['ID_P'];
		$tmp_wodor = $wiersz['Wodor'];
		$tmp_metal = $wiersz['Metal'];
		$tmp_energia = $wiersz['Energia'];
		$tmp_uran = $wiersz['Uran'];
		
		
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Rekrutacja'");
		$wiersz = mysql_fetch_assoc($zap);
		if($wiersz['ID_F'] != null)
		{
			// błąd aktualnie rekrutowanej floty
			return 1;
		}
		
		$tmp_potrz_wodor = 0;
		$tmp_potrz_metal = 0;
		$tmp_potrz_energia = 0;
		$tmp_potrz_uran = 0;
		$tmp_potrz_czas = 0;
		
		if($this->Mysliwiec>0)
		{
			//
			$tmp_Sta = new Statek('Mysliwiec',$this->Mysliwiec);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Niszczyciel_Barakuda>0)
		{
			//
			$tmp_Sta = new Statek('Niszczyciel_Barakuda',$this->Niszczyciel_Barakuda);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Niszczyciel_Manta>0)
		{
			//
			$tmp_Sta = new Statek('Niszczyciel_Manta',$this->Niszczyciel_Manta);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Krazownik_Orka>0)
		{
			//
			$tmp_Sta = new Statek('Krazownik_Orka',$this->Krazownik_Orka);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Krazownik_Merlin>0)
		{
			//
			$tmp_Sta = new Statek('Krazownik_Merlin',$this->Krazownik_Merlin);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Krazownik_Krab>0)
		{
			//
			$tmp_Sta = new Statek('Krazownik_Krab',$this->Krazownik_Krab);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		if($this->Pancernik>0)
		{
			//
			$tmp_Sta = new Statek('Pancernik',$this->Pancernik);
			$tmp_potrz_wodor += $tmp_Sta->Wodor;
			$tmp_potrz_metal += $tmp_Sta->Metal;
			$tmp_potrz_energia += $tmp_Sta->Energia;
			$tmp_potrz_uran += $tmp_Sta->Uran;
			$tmp_potrz_czas += $tmp_Sta->Czas;
		}
		
		//obliczenie kosztów rekrutacji ewentualnie błąd
		$tmp_wodor -=$tmp_potrz_wodor;
		$tmp_metal -= $tmp_potrz_metal;
		$tmp_energia -= $tmp_potrz_energia;
		$tmp_uran -= $tmp_potrz_uran;
		
		if($tmp_wodor<0)
		{
			//niedobór wodoru
			return 2;
		}
		if($tmp_metal<0)
		{
			//niedobór metalu
			return 3;
		}
		if($tmp_energia<0)
		{
			//niedobór energi
			return 4;
		}
		if($tmp_uran<0)
		{
			//niedobór uranu
			return 5;
		}
		
		// jeśli stać to odpowiednie zmiany w rejestrach floty
		if($V_pol->zapytanie("UPDATE PLANETA SET Wodor='".$tmp_wodor."',Metal='".$tmp_metal."',Energia='".$tmp_energia."',Uran='".$tmp_uran."' WHERE ID_Gracza='".$V_ID_G."'")=== TRUE)		
		{
			$tmp_potrz_czas = date("Y-m-d H:i:s",time() + $tmp_potrz_czas);
			$tmp_t = date("Y-m-d H:i:s",time());
			//"INSERT INTO FLOTA (ID_Gracza, Status, ID_Lokalizacja_Start, ID_Lokalizacja_Stop, Mysliwiec, Niszczyciel_Barakuda, Niszczyciel_Manta, Krazownik_Orka, Krazownik_Merlin, Krazownik_Krab, Pancernik, Tim_stamp_Start, Tim_stamp_Stop) VALUES ('5','Rekrutacja','1','1','1','1','1','1','1','1','1','1','1')"
			
			// jeśli stać to odpowiednie zmiany w rejestrach surowców
			if($V_pol->zapytanie("INSERT INTO FLOTA (ID_Gracza, Status, ID_Lokalizacja_Start, ID_Lokalizacja_Stop, Mysliwiec, Niszczyciel_Barakuda, Niszczyciel_Manta, Krazownik_Orka, Krazownik_Merlin, Krazownik_Krab, Pancernik, Tim_stamp_Start, Tim_stamp_Stop) 
				VALUES ('".$V_ID_G."','Rekrutacja','".$V_ID_G."','".$V_ID_G."','".$this->Mysliwiec."','".$this->Niszczyciel_Barakuda."','".$this->Niszczyciel_Manta."','".$this->Krazownik_Orka."','".$this->Krazownik_Merlin."','".$this->Krazownik_Krab."','".$this->Pancernik."','".$tmp_t."','".$tmp_potrz_czas."')")=== TRUE)		
			{
				//wpis ok
				;return 0;
			}
			else
			{
				//flota - błedny wpis
				return 7;
			}
		}
		else
		{
			//surowce - błedny wpis
			return 6;
		}		
	}
	
	function aktualizuj_rekrutacja($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Rekrutacja'");
		$wiersz = mysql_fetch_assoc($zap);
		
		if ($wiersz['Tim_stamp_Stop'] != null)
		{
			//$t=strtotime(date("Y-m-d H:i:s",time()))-strtotime($wiersz['Tim_stamp_Stop']);
			if((strtotime(date("Y-m-d H:i:s",time()))-strtotime($wiersz['Tim_stamp_Stop'])) > 0)
			{
				$tmp_t = date("Y-m-d H:i:s",time());
				$t_id_floty = $wiersz['ID_F'];
				
				$this->Mysliwiec = $wiersz['Mysliwiec'];
				$this->Niszczyciel_Barakuda = $wiersz['Niszczyciel_Barakuda'];
				$this->Niszczyciel_Manta = $wiersz['Niszczyciel_Manta'];
				$this->Krazownik_Orka = $wiersz['Krazownik_Orka'];
				$this->Krazownik_Merlin = $wiersz['Krazownik_Merlin'];
				$this->Krazownik_Krab = $wiersz['Krazownik_Krab'];
				$this->Pancernik = $wiersz['Pancernik'];
				
				$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Obrona'");
				$wiersz = mysql_fetch_assoc($zap);
				
				$this->Mysliwiec += $wiersz['Mysliwiec'];
				$this->Niszczyciel_Barakuda += $wiersz['Niszczyciel_Barakuda'];
				$this->Niszczyciel_Manta += $wiersz['Niszczyciel_Manta'];
				$this->Krazownik_Orka += $wiersz['Krazownik_Orka'];
				$this->Krazownik_Merlin += $wiersz['Krazownik_Merlin'];
				$this->Krazownik_Krab += $wiersz['Krazownik_Krab'];
				$this->Pancernik += $wiersz['Pancernik'];
				
				
				// aktualizacja ilości floty na miejscu
				if($V_pol->zapytanie("UPDATE FLOTA SET ID_Lokalizacja_Start='".$V_ID_G."', ID_Lokalizacja_Stop='".$V_ID_G."', Mysliwiec='".$this->Mysliwiec."', Niszczyciel_Barakuda=".$this->Niszczyciel_Barakuda.", Niszczyciel_Manta='".$this->Niszczyciel_Manta."', Krazownik_Orka='".$this->Krazownik_Orka."', Krazownik_Merlin='".$this->Krazownik_Merlin."', Krazownik_Krab='".$this->Krazownik_Krab."', Pancernik='".$this->Pancernik."', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_Gracza='".$V_ID_G."' AND Status = 'Obrona'")=== TRUE) 
				{
					//odpowiednie zmiany w rejestrach
					if($V_pol->zapytanie("DELETE FROM FLOTA WHERE ID_F='".$t_id_floty."'")=== TRUE)
					{
						//wpis ok
						return 0;
					}
					else
					{
						//usunięcie floty rekrutacji błedny wpis
						return 2;
					}
					
				}
				else
				{
					//błąd Aktualizacji floty obrony 
					return 1;
				}
			}
		}
	}
	
	
	function atak($V_pol,$V_ID_G,$V_ID_Of){
		
		//dostępność floty
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Obrona'");
		$wiersz = mysql_fetch_assoc($zap);
		if($wiersz['ID_F'] == null)
		{
			// błąd - brak floty na planecie
			return 1;
		}
		
		//walidacja ilości dostępnej floty
		$tmp_Mysliwiec = $wiersz['Mysliwiec'] - $this->Mysliwiec;
		if($tmp_Mysliwiec<0)
		{
			//błąd - nie masz tyle myśliwców
			return 2;
		}
		$tmp_Niszczyciel_Barakuda = $wiersz['Niszczyciel_Barakuda'] - $this->Niszczyciel_Barakuda;
		if($tmp_Niszczyciel_Barakuda<0)
		{
			//błąd - nie masz tyle Niszczyciel_Barakuda
			return 3;
		}
		$tmp_Niszczyciel_Manta = $wiersz['Niszczyciel_Manta'] - $this->Niszczyciel_Manta;
		if($tmp_Niszczyciel_Manta<0)
		{
			//błąd - nie masz tyle Niszczyciel_Manta
			return 4;
		}
		$tmp_Krazownik_Orka = $wiersz['Krazownik_Orka'] - $this->Krazownik_Orka;
		if($tmp_Krazownik_Orka<0)
		{
			//błąd - nie masz tyle Krazownik_Orka
			return 5;
		}
		$tmp_Krazownik_Merlin = $wiersz['Krazownik_Merlin'] - $this->Krazownik_Merlin;
 		if($tmp_Krazownik_Merlin<0)
		{
			//błąd - nie masz tyle Krazownik_Orka
			return 6;
		}
		$tmp_Krazownik_Krab = $wiersz['Krazownik_Krab'] - $this->Krazownik_Krab;
		if($tmp_Krazownik_Krab<0)
		{
			//błąd - nie masz tyle Krazownik_Krab
			return 7;
		}
		$tmp_Pancernik = $wiersz['Pancernik'] - $this->Pancernik;
		if($tmp_Pancernik<0)
		{
			//błąd - nie masz tyle Pancernik
			return 8;
		}
		
		//stała prędkość floty
		$tmp_predkosc = 1;
		
		//atakujacy
		$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE ID_G='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		$tmp_X = $wiersz['WspX'];
		$tmp_Y = $wiersz['WspY'];
		
		//ofiara
		$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE ID_G='".$V_ID_Of."'");
		$wiersz = mysql_fetch_assoc($zap);
		$tmp_X -= $wiersz['WspX'];
		$tmp_Y -= $wiersz['WspY'];
		
		$tmp_wyp = floor(sqrt(pow($tmp_X,2)+pow($tmp_Y,2)))*$tmp_predkosc;
		
		$tmp_potrz_czas = date("Y-m-d H:i:s",time() + $tmp_wyp);
		$tmp_t = date("Y-m-d H:i:s",time());
		
		// aktualizacja ilości floty na miejscu
		if($V_pol->zapytanie("UPDATE FLOTA SET ID_Lokalizacja_Start='".$V_ID_G."', ID_Lokalizacja_Stop='".$V_ID_G."', Mysliwiec='".$tmp_Mysliwiec."', Niszczyciel_Barakuda=".$tmp_Niszczyciel_Barakuda.", Niszczyciel_Manta='".$tmp_Niszczyciel_Manta."', Krazownik_Orka='".$tmp_Krazownik_Orka."', Krazownik_Merlin='".$tmp_Krazownik_Merlin."', Krazownik_Krab='".$tmp_Krazownik_Krab."', Pancernik='".$tmp_Pancernik."', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_Gracza='".$V_ID_G."' AND Status = 'Obrona'")=== TRUE) 
		{
			//wpis ok
			;//return 0;
			// jeśli stać to odpowiednie zmiany w rejestrach surowców
			if($V_pol->zapytanie("INSERT INTO FLOTA (ID_Gracza, Status, ID_Lokalizacja_Start, ID_Lokalizacja_Stop, Mysliwiec, Niszczyciel_Barakuda, Niszczyciel_Manta, Krazownik_Orka, Krazownik_Merlin, Krazownik_Krab, Pancernik, Tim_stamp_Start, Tim_stamp_Stop) 
				VALUES ('".$V_ID_G."','Atak','".$V_ID_G."','".$V_ID_Of."','".$this->Mysliwiec."','".$this->Niszczyciel_Barakuda."','".$this->Niszczyciel_Manta."','".$this->Krazownik_Orka."','".$this->Krazownik_Merlin."','".$this->Krazownik_Krab."','".$this->Pancernik."','".$tmp_t."','".$tmp_potrz_czas."')")=== TRUE)
			{
				//wpis ok
				return 0;
			}
			else
			{
				//flota w ataku - błedny wpis
				return 10;
			}
			
		}
		else
		{
			//błąd Aktualizacji floty obrony 
			return 9;
		}
		
	}
	
	
	
	function bitwa($V_pol,$V_ID_G,$V_Tab_Sta){
		
		//dostępność floty
		$zap1 = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Atak'");
		while($wiersz1 = mysql_fetch_assoc($zap1))
		{
			if ($wiersz1['Tim_stamp_Stop'] != null)
			{
				if((strtotime(date("Y-m-d H:i:s",time()))-strtotime($wiersz1['Tim_stamp_Stop'])) > 0)
				{
					
					$tmp_id_ofiary = $wiersz1['ID_Lokalizacja_Stop'];
					$tmp_id_floty_atakujacej = $wiersz1['ID_F'];
					$tmp_t = date("Y-m-d H:i:s",time());
					//inicjalizacja floty atakującego
					$t_A_Sum_Ata = 0;
					$t_A_Sum_Pan = 0;
					
					$F_Atak = new Flota($wiersz1['Mysliwiec'],$wiersz1['Niszczyciel_Barakuda'],$wiersz1['Niszczyciel_Manta'],$wiersz1['Krazownik_Orka'],
								$wiersz1['Krazownik_Merlin'],$wiersz1['Krazownik_Krab'],$wiersz1['Pancernik']);
					$F_Atak_Stary = new Flota($wiersz1['Mysliwiec'],$wiersz1['Niszczyciel_Barakuda'],$wiersz1['Niszczyciel_Manta'],$wiersz1['Krazownik_Orka'],
								$wiersz1['Krazownik_Merlin'],$wiersz1['Krazownik_Krab'],$wiersz1['Pancernik']);
					
					for($i=1;$i<7;$i++)
					{
						$s = new Statek($V_Tab_Sta[$i],$F_Atak->$V_Tab_Sta[$i]);
						$t_A_Sum_Ata += $s->Atak;
						$t_A_Sum_Pan += $s->Pancerz;
					}
					
					$zap = $V_pol->zapytanie("SELECT * FROM GRACZ WHERE ID_G='".$tmp_id_ofiary."'");
					$wiersz = mysql_fetch_assoc($zap);
					$nazwa_ofiary = $wiersz['Nazwa_Gracza'];
					
					$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$tmp_id_ofiary."' AND Status='Obrona'");
					$wiersz = mysql_fetch_assoc($zap);
					//inicjalizacja floty obrońcy
					$tmp_id_floty_obroncy = $wiersz['ID_F'];
					$t_O_Sum_Ata = 0;
					$t_O_Sum_Pan = 0;
					
					$F_Obrona = new Flota($wiersz['Mysliwiec'],$wiersz['Niszczyciel_Barakuda'],$wiersz['Niszczyciel_Manta'],$wiersz['Krazownik_Orka'],
								$wiersz['Krazownik_Merlin'],$wiersz['Krazownik_Krab'],$wiersz['Pancernik']);
					$F_Obrona_Stary = new Flota($wiersz['Mysliwiec'],$wiersz['Niszczyciel_Barakuda'],$wiersz['Niszczyciel_Manta'],$wiersz['Krazownik_Orka'],
								$wiersz['Krazownik_Merlin'],$wiersz['Krazownik_Krab'],$wiersz['Pancernik']);
					
					for($i=1;$i<7;$i++)
					{
						$s = new Statek($V_Tab_Sta[$i],$F_Obrona->$V_Tab_Sta[$i]);
						$t_O_Sum_Ata += $s->Atak;
						$t_O_Sum_Pan += $s->Pancerz;
					}
					//bitwa
					$t_A_wsp=0;
					$t_O_wsp=0;
					if($t_A_Sum_Pan>0)
					{
						$t_A_wsp = $t_A_Sum_Ata/$t_A_Sum_Pan;
					}
					if($t_O_Sum_Pan>0)
					{
						$t_O_wsp = $t_O_Sum_Ata/$t_O_Sum_Pan;
					}
					$t_A_P=$t_A_Sum_Pan;
					$t_O_P=$t_O_Sum_Pan;
					//echo'Atakujacy: pancerz'.$t_A_Sum_Pan.'Atak'.$t_A_wsp.'Obrońca: pancerz'.$t_O_Sum_Pan.'Atak'.$t_O_wsp;
					while($t_O_Sum_Pan>0 AND $t_A_Sum_Pan>0)
					{
						$t_O = $t_O_Sum_Pan - $t_A_wsp*$t_A_Sum_Pan;
						$t_A_Sum_Pan = $t_A_Sum_Pan - $t_O_wsp*$t_O_Sum_Pan;
						$t_O_Sum_Pan = $t_O;
					}
					//echo' ===Po bitwie=== Atakujacy: pancerz'.$t_A_Sum_Pan.'Obrońca: pancerz'.$t_O_Sum_Pan;
					
					//wygrał obrońca
					if($t_O_Sum_Pan>0 AND $t_A_Sum_Pan<=0)
					{
						for($i=1;$i<=7;$i++)
						{
							if($t_O_P>0)
							{
								$F_Obrona->$V_Tab_Sta[$i]=ceil(($F_Obrona->$V_Tab_Sta[$i]*$t_O_Sum_Pan)/$t_O_P);
							}
							else
							{
								$F_Obrona->$V_Tab_Sta[$i] = 0;
							}
						}
						// aktualizacja ilości floty obroncy
						if($V_pol->zapytanie("UPDATE FLOTA SET Mysliwiec='".$F_Obrona->Mysliwiec."', Niszczyciel_Barakuda='".$F_Obrona->Niszczyciel_Barakuda."', Niszczyciel_Manta='".$F_Obrona->Niszczyciel_Manta."', Krazownik_Orka='".$F_Obrona->Krazownik_Orka."', Krazownik_Merlin='".$F_Obrona->Krazownik_Merlin."', Krazownik_Krab='".$F_Obrona->Krazownik_Krab."', Pancernik='".$F_Obrona->Pancernik."', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_F='".$tmp_id_floty_obroncy."'")=== TRUE) 
						{
							//usunięcie floty atakujacej
							if($V_pol->zapytanie("DELETE FROM FLOTA WHERE ID_F='".$tmp_id_floty_atakujacej."'")=== TRUE)
							{
								$t_F_A="";
								$t_F_A_S="";
								$t_F_O="";
								$t_F_O_S="";
								for($i=1;$i<=7;$i++)
								{
									$t_F_A = $t_F_A.' '.$V_Tab_Sta[$i].':0';
									$t_F_A_S = $t_F_A_S.' '.$V_Tab_Sta[$i].':'.$F_Atak_Stary->$V_Tab_Sta[$i];
									$t_F_O = $t_F_O.' '.$V_Tab_Sta[$i].':'.$F_Obrona->$V_Tab_Sta[$i];
									$t_F_O_S = $t_F_O_S.' '.$V_Tab_Sta[$i].':'.$F_Obrona_Stary->$V_Tab_Sta[$i];
								}
								
								//wpis ok
								$test[0] = "====Porażka====";
								$test[1] = $t_F_A;
								$test[2] = $nazwa_ofiary;
								$test[3] = $t_F_A_S;
								$test[4] = " ";
								$test[5] = $t_F_O;
								$test[6] = " ";
								$test[7] = $t_F_O_S;
								
								$Gracz_Obr = new Gracz($V_pol,$nazwa_ofiary);
								$Gracz_Obr->aktualizuj_rankig($V_pol);
								
								return $test;
							}
							else
							{
								//usunięcie floty atakujacej
								return 2;
							}
							
						}
						else
						{
							//błąd Aktualizacji floty obrony 
							return 1;
						}
					}
					
					//remis
					if($t_O_Sum_Pan<=0 AND $t_A_Sum_Pan<=0)
					{
						// aktualizacja ilości floty obroncy
						if($V_pol->zapytanie("UPDATE FLOTA SET Mysliwiec='0', Niszczyciel_Barakuda='0', Niszczyciel_Manta='0', Krazownik_Orka='0', Krazownik_Merlin='0', Krazownik_Krab='0', Pancernik='0', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_F='".$tmp_id_floty_obroncy."'")=== TRUE) 
						{
							//usunięcie floty atakujacej
							if($V_pol->zapytanie("DELETE FROM FLOTA WHERE ID_F='".$tmp_id_floty_atakujacej."'")=== TRUE)
							{
								$t_F_A="";
								$t_F_A_S="";
								$t_F_O="";
								$t_F_O_S="";
								for($i=1;$i<=7;$i++)
								{
									$t_F_A = $t_F_A.' '.$V_Tab_Sta[$i].':0';
									$t_F_A_S = $t_F_A_S.' '.$V_Tab_Sta[$i].':'.$F_Atak_Stary->$V_Tab_Sta[$i];
									$t_F_O = $t_F_O.' '.$V_Tab_Sta[$i].':0';
									$t_F_O_S = $t_F_O_S.' '.$V_Tab_Sta[$i].':'.$F_Obrona_Stary->$V_Tab_Sta[$i];
								}
								
								//wpis ok
								$test[0] = "====Remis====";
								$test[1] = $t_F_A;
								$test[2] = $nazwa_ofiary;
								$test[3] = $t_F_A_S;
								$test[4] = " ";
								$test[5] = $t_F_O;
								$test[6] = " ";
								$test[7] = $t_F_O_S;
								
								$Gracz_Obr = new Gracz($V_pol,$nazwa_ofiary);
								$Gracz_Obr->aktualizuj_rankig($V_pol);
								//wpis ok
								return $test;
							}
							else
							{
								//błąd usunięcia floty atakujacej
								return 5;
							}
							
						}
						else
						{
							//błąd zerowania floty obrony 
							return 4;
						}
					}
					//wygrał atakujący
					if($t_O_Sum_Pan<=0 AND $t_A_Sum_Pan>0)
					{
						$F_Atak_Pow = new Flota(0,0,0,0,0,0,0);
						
						$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Obrona'");
						$wiersz = mysql_fetch_assoc($zap);
			
						for($i=1;$i<=7;$i++)
						{
							if($t_A_P!=0)
							{
								$F_Atak_Pow->$V_Tab_Sta[$i] = ceil(($F_Atak->$V_Tab_Sta[$i]*$t_A_Sum_Pan)/$t_A_P);
								$F_Atak->$V_Tab_Sta[$i] = ceil(($F_Atak->$V_Tab_Sta[$i]*$t_A_Sum_Pan)/$t_A_P) + $wiersz[$V_Tab_Sta[$i]];
							}
							else
							{
								$F_Atak->$V_Tab_Sta[$i] = $wiersz[$V_Tab_Sta[$i]];
							}
						}
						
						// teleport floty atakujacego
						if($V_pol->zapytanie("UPDATE FLOTA SET Mysliwiec='".$F_Atak->Mysliwiec."', Niszczyciel_Barakuda='".$F_Atak->Niszczyciel_Barakuda."', Niszczyciel_Manta='".$F_Atak->Niszczyciel_Manta."', Krazownik_Orka='".$F_Atak->Krazownik_Orka."', Krazownik_Merlin='".$F_Atak->Krazownik_Merlin."', Krazownik_Krab='".$F_Atak->Krazownik_Krab."', Pancernik='".$F_Atak->Pancernik."', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_Gracza='".$V_ID_G."' AND Status='Obrona'")=== TRUE) 
						{
							//usunięcie floty atakujacej
							if($V_pol->zapytanie("DELETE FROM FLOTA WHERE ID_F='".$tmp_id_floty_atakujacej."'")=== TRUE)
							{
								// aktualizacja ilości floty obroncy
								if($V_pol->zapytanie("UPDATE FLOTA SET Mysliwiec='0', Niszczyciel_Barakuda='0', Niszczyciel_Manta='0', Krazownik_Orka='0', Krazownik_Merlin='0', Krazownik_Krab='0', Pancernik='0', Tim_stamp_Start='".$tmp_t."', Tim_stamp_Stop='".$tmp_t."' WHERE ID_F='".$tmp_id_floty_obroncy."'")=== TRUE) 
								{
									$t_F_A="";
									$t_F_A_S="";
									$t_F_O="";
									$t_F_O_S="";
									for($i=1;$i<=7;$i++)
									{
										$t_F_A = $t_F_A.' '.$V_Tab_Sta[$i].':'.$F_Atak_Pow->$V_Tab_Sta[$i];
										$t_F_A_S = $t_F_A_S.' '.$V_Tab_Sta[$i].':'.$F_Atak_Stary->$V_Tab_Sta[$i];
										$t_F_O = $t_F_O.' '.$V_Tab_Sta[$i].':0';
										$t_F_O_S = $t_F_O_S.' '.$V_Tab_Sta[$i].':'.$F_Obrona_Stary->$V_Tab_Sta[$i];
									}
									
									//wpis ok
									$test[0] = "====Zwycięstwo====";
									$test[1] = $t_F_A;
									$test[2] = $nazwa_ofiary;
									$test[3] = $t_F_A_S;
									$test[4] = " ";
									$test[5] = $t_F_O;
									$test[6] = " ";
									$test[7] = $t_F_O_S;
									
									$Gracz_Obr = new Gracz($V_pol,$nazwa_ofiary);
									$Gracz_Obr->aktualizuj_rankig($V_pol);
									//wpis ok
									return $test;
								}
								else
								{
									//bład zerowanie floty obrońcy
									return 9;
								}
								
							}
							else
							{
								//błąd - usunięcie floty atakujacej
								return 8;
							}
							
						}
						else
						{
							//błąd Aktualizacji floty obrony 
							return 7;
						}
					}
					
				}				
			}
		}	
		$test[0]="";
	}
		
	function wyczysc($V_pol,$V_ID_G,$V_ID_Of){
		;
	}
	
}
?>