<?
class Budowanie{
	
	//ważne pola
	var $Wodor;
	var $Metal;
	var $Energia;
	var $Uran;
	var $Czas;
	var $Typ;
	var $Poziom;
	var $Przyrosty;
	var $Przyrosty_lvl_up;
	var $Nazwa;
	var $Opis;
	
	function __construct($V_typ,$V_poz){
		
		$this->dane($V_typ,$V_poz);
	}
	
	function sprawdz($V_pol,$V_ID_G){
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		$this->Poziom = $wiersz[$this->Typ];
		$this->dane($this->Typ,$this->Poziom); 
	}
	
	function dane($V_typ,$V_poz){
		
		switch ($V_typ) {
			case 'Stacja_Elektrolizy':
				$this->Wodor = intval(2+1.2*1.2*($V_poz));
				$this->Metal = intval(4+1.2*1.2*($V_poz));
				$this->Energia = intval(8+1.2*1.2*($V_poz));
				$this->Uran = intval(2+1.2*1.2*($V_poz));
				$this->Czas = 100 + 150*($V_poz);
				$this->Typ = $V_typ;
				$this->Poziom = $V_poz;
				$this->Przyrosty = 10 + 15*($V_poz);
				$this->Przyrosty_lvl_up = 10 + 15*($V_poz+1);
				$this->Nazwa = "Stacja Elektrolizy";
				$this->Opis = "Wybudowana na wodzie, stacja ta z pomocą energii rozbija cząsteczki wody na jej składowe czyli wodór i tlen, 
				które następnie sprężone pod dużym ciśnieniem, przesyłane jest do miejsca zapotrzebowania.";
				break;
			case 'Kopalnia':
				$this->Wodor = intval(6+1.2*1.2*($V_poz));
				$this->Metal = intval(3+1.2*1.2*($V_poz));
				$this->Energia = intval(8+1.2*1.2*($V_poz));
				$this->Uran = intval(8+1.2*1.2*($V_poz));
				$this->Czas = 100 + 100*($V_poz);
				$this->Typ = $V_typ;
				$this->Poziom = $V_poz;
				$this->Przyrosty = 10 + 25*($V_poz);
				$this->Przyrosty_lvl_up = 10 + 25*($V_poz+1);
				$this->Nazwa = "Kopalnia";
				$this->Opis = "Od tysiącleci wydobywamy metale w kopalni, jednak czy to znaczy, że nic się nie zmieniło? W żadnym wypadku! 
				Od kilofa i łopaty doszliśmy do poziomu maszyn i egzoszkieletów, usprawniając i przyspieszając wydobycie.";
				break;
			case 'Elektrownia':
				$this->Wodor = intval(6+1.2*1.2*($V_poz));
				$this->Metal = intval(5+1.2*1.2*($V_poz));
				$this->Energia = intval(2+1.2*1.2*($V_poz));
				$this->Uran = intval(7+1.2*1.2*($V_poz));
				$this->Czas = 100 + 100*($V_poz);
				$this->Typ = $V_typ;
				$this->Poziom = $V_poz;
				$this->Przyrosty = 10 + 20*($V_poz);
				$this->Przyrosty_lvl_up = 10 + 20*($V_poz+1);
				$this->Nazwa = "Elektrownia";
				$this->Opis = "Słoneczna, wodna, wiatrowa, geotermalna lub jądrowa. Wszystko zależne od możliwości jakie oferuje dane miejsce. 
				Niezależnie jednak od rodzaju ma jeden cel. Zapewnić potrzebną energię dla kolonii i produkcji. 
				Możliwie najefektywniej oraz możliwie najmniejszym kosztem.";
				break;
			case 'Zaklad_Konwersji_Uranu':
				$this->Wodor = intval(12+1.2*1.2*($V_poz));
				$this->Metal = intval(8+1.2*1.2*($V_poz));
				$this->Energia = intval(4+1.2*1.2*($V_poz));
				$this->Uran = intval(2+1.2*1.2*($V_poz));
				$this->Czas = 100 + 200*($V_poz);
				$this->Typ = $V_typ;
				$this->Poziom = $V_poz;
				$this->Przyrosty = 10 + 25*($V_poz);
				$this->Przyrosty_lvl_up = 10 + 25*($V_poz+1);
				$this->Nazwa = "Zakład konwersji uranu";
				$this->Opis = "Naturalnie występujący uran nadaje się do zasilania tylko niektórych reaktorów oraz ma znikome znaczenie militarne. 
				Dlatego też w zakładach przetwarza się ten pierwiastek wzbogacając go, tak by nadawał się jako paliwo do reaktorów lub jako materiał 
				rozszczepialny w głowicach.";
				break;
			case 'Gwiezdna_Stocznia':
				$this->Wodor = intval(8+1.2*1.3*($V_poz));
				$this->Metal = intval(8+1.2*1.3*($V_poz));
				$this->Energia = intval(8+1.2*1.3*($V_poz));
				$this->Uran = intval(8+1.2*1.3*($V_poz)); 
				$this->Czas = 100 + 300*($V_poz);
				$this->Typ = $V_typ;
				$this->Poziom = $V_poz; 
				$this->Przyrosty = 1 + 1*($V_poz); 
				$this->Przyrosty_lvl_up = 1 + 1*($V_poz+1);
				$this->Nazwa = "Gwiezdna Stocznia";
				$this->Opis = "Nie różni się wiele od stoczni budowanych wokół akwenów wodnych. Najważniejszą różnicą jest fakt, 
				że ta stocznia zawieszona jest wysoko nad planetą na orbicie geostacjonarnej. Jest to spowodowane tym, że większe jednostki 
				nie byłyby w stanie samodzielnie opuścić atmosfery większości planet. Stąd praktycznie wszystkie okręty poza myśliwcami muszą być 
				budowane bezpośrednio w przestrzeni kosmicznej.";
				break;
		}
	}
	
	function buduj($V_pol,$V_ID_G){
		
		
		
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		//echo " Wbaza".$wiersz['Wodor']." Wthis".$this->Wodor." ";
		$tmp_wodor = $wiersz['Wodor'] - $this->Wodor;
		$tmp_metal = $wiersz['Metal'] - $this->Metal;
		$tmp_energia = $wiersz['Energia']- $this->Energia;
		$tmp_uran = $wiersz['Uran'] - $this->Uran;
		$tmp_t = date("Y-m-d H:i:s",time() + $this->Czas);
		
		//echo 'z bazy:'.$wiersz['Tim_stamp_Ost_Bud'].' testowy:'.date("Y-m-d H:i:s",time() + 100);
		
		if($wiersz['Tim_stamp_Ost_Bud']>date("Y-m-d H:i:s",time()))
		{
			$t=strtotime($wiersz['Tim_stamp_Ost_Bud'])-strtotime(date("Y-m-d H:i:s",time()));
			$h=floor($t/3600);
			$m=floor(($t-$h*3600)/60);
			$s=floor(($t-$h*3600-$m*60));			
			//echo 'czekaj jeszcze'.$h.'h'.$m.'m'.$s.'s';
			//błąd - jeszcze nie można budować
			return 3;
		}
		
		//jeśli jest wystarczająco surowców
		if($tmp_wodor > 0			
		AND $tmp_metal > 0
		AND $tmp_energia > 0
		AND $tmp_uran > 0)
		{
			$this->Poziom += 1;
			
			//aktualizacja do bazy
			if($V_pol->zapytanie("UPDATE PLANETA SET ".$this->Typ."='".$this->Poziom."', Wodor='".$tmp_wodor."',Metal='".$tmp_metal."',Energia='".$tmp_energia."',Uran='".$tmp_uran."',Tim_stamp_Ost_Bud='".$tmp_t."' WHERE ID_Gracza='".$V_ID_G."'")=== TRUE)		
			{
				//wpis ok
				return 0;//return 0;
			}
			else
			{
				//aktualizacja surowców po budowie wpis błedny
				return 1;
			}
			
		}
		else
		{
			//błąd zbyt mało surowców
			return 2;
		}

	}
}
?>