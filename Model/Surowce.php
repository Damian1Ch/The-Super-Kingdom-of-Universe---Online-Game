<?
class Surowce{
	
	//ważne pola
	var $Wodor;
	var $Metal;
	var $Energia;
	var $Uran;
	
	function __construct($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'" );
		$wiersz = mysql_fetch_assoc($zap);
		$this->Wodor = $wiersz['Wodor'];
		$this->Metal = $wiersz['Metal'];
		$this->Energia = $wiersz['Energia'];
		$this->Uran = $wiersz['Uran'];
		
	}
	
	function aktualizuj($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'" );
		$wiersz = mysql_fetch_assoc($zap);
		$this->Wodor = $wiersz['Wodor'];		
		$this->Metal = $wiersz['Metal'];
		$this->Energia = $wiersz['Energia'];
		$this->Uran = $wiersz['Uran'];
		
		$t=strtotime(date("Y-m-d H:i:s",time()))-strtotime($wiersz['Tim_stamp_Akt_Sur']);
		if($t>3600)
		{
			$bud = new Budowanie('Stacja_Elektrolizy', $wiersz['Stacja_Elektrolizy']);
			$this->Wodor += (floor (($bud->Przyrosty*$t)/3600));
					
			$bud = new Budowanie('Kopalnia', $wiersz['Kopalnia']);
			$this->Metal += (floor (($bud->Przyrosty*$t)/3600));
					
			$bud = new Budowanie('Elektrownia', $wiersz['Elektrownia']);
			$this->Energia += (floor (($bud->Przyrosty*$t)/3600));
				
			$bud = new Budowanie('Zaklad_Konwersji_Uranu', $wiersz['Zaklad_Konwersji_Uranu']);
			$this->Uran += (floor (($bud->Przyrosty*$t)/3600));
			
			$tmp_t = date("Y-m-d H:i:s",time());
			
			$V_pol->zapytanie("UPDATE PLANETA SET Wodor='".$this->Wodor."', Metal='".$this->Metal."', Energia='".$this->Energia."', Uran='".$this->Uran."', Tim_stamp_Akt_Sur='".$tmp_t."' WHERE ID_Gracza='".$V_ID_G."' "); 
			
		}
	}
}
?>