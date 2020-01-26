<?
class Czas{
	
	//ważne pola
	var $Calosc;
	var $Godziny;
	var $Minuty;
	var $Sekundy;
	
	function __construct($V_wart_s){
		
		$this->czas_przlicz($V_wart_s);
		
	}
	
	function czas_przlicz($V_wart_s){
		
		$h=floor($V_wart_s/3600);
		$m=floor(($V_wart_s-$h*3600)/60);
		$s=floor(($V_wart_s-$h*3600-$m*60));			
		
		$this->Calosc = $V_wart_s;
		$this->Godziny = $h;
		$this->Minuty = $m;
		$this->Sekundy = $s;
	}
	
	function czas_rekrutacji($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' AND Status='Rekrutacja'");
		$wiersz = mysql_fetch_assoc($zap);
		if(isset($wiersz['Tim_stamp_Stop']))
		{
			$t=strtotime($wiersz['Tim_stamp_Stop'])-strtotime(date("Y-m-d H:i:s",time()));
			$this->czas_przlicz($t);
			
		}
		else
		{
			$this->czas_przlicz(0);
		}
	}
	
	function czas_budowy($V_pol,$V_ID_G){
		
		$zap = $V_pol->zapytanie("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		if(isset($wiersz['Tim_stamp_Ost_Bud']))
		{
			$t=strtotime($wiersz['Tim_stamp_Ost_Bud'])-strtotime(date("Y-m-d H:i:s",time()));
			$this->czas_przlicz($t);
		}
		else
		{
			$this->czas_przlicz(0);
		}		
	}
}
?>