<?
class Baza{
	 
	//domyślne pola do połączenia z bazą
	var $db_user;
	var $db_name;
	var $db_password;
	var $db_code;
	var $db_connection;
	//var $db_connection;
	
	function __construct(){
		session_start();
		$this->db_user = "localhost";
		$this->db_name = "22988596_0000001";
		$this->db_password = "1102643_KcC";
		$this->db_code = "utf8";
		
	}
	
	function polacz(){
		//połaczenie
		$db_connection = mysql_connect($this->db_user,$this->db_name,$this->db_password);
		//przypisanie połączenia do pola
		$this->db_connection=$db_connection;
		//diagnostyka
		if (!$db_connection) {
			;//die('Could not connect: ' . mysql_error());
		}
		else 
		;//echo (" Connected successfully ");
		//kodowanie
		mysql_set_charset($this->db_code,$db_connection);
		//wybór bazy
		mysql_select_db($this->db_name) or die(" "/*mysql_error()."Nie mozna wybrac bazy danych."*/);
		//przypisanie polaczenia
		$_SESSION['baza']='ON';
	}
	
	function zapytanie($tresc_zapytania){
		
		return /*$result =*/ mysql_query($tresc_zapytania);//ORDER BY id DESC
		
		/*while ($row = mysql_fetch_assoc($result)) 
		{
			echo '<div class="well"><div class="row"><div class="col-md-8"><h3>';
			echo $row['ID_G'];
			echo '</h3></div><div class="col-md-4"><h5 class="text-center">'.$row['Email'].'</h5></div></div>';
			echo '<hr></hr><div class="row"><div class="col-md-10 col-md-offset-1">'.$row['Email'].'</div></div></div><br/>';
			
		}*/
	}
	
	function lista_graczy(){
		
		$t="";
		$zap = mysql_query("SELECT * FROM GRACZ ORDER BY Punkty_Rankingu DESC");
		while ($wiersz = mysql_fetch_assoc($zap)) 
		{
			//echo "a:".$wiersz['Nazwa_Gracza'];
			$t=$t.'_'.$wiersz['Nazwa_Gracza'];
		}
		return $t;		
	}
	
	
	function widok_budynki($V_ID_G){
		
		$zap = mysql_query("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		echo "Stacja elektrolizy: ".$wiersz['Stacja_Elektrolizy']."LVL<br>".
		"Kopalnia: ".$wiersz['Kopalnia']."LVL<br>".
		"Elektrownia: ".$wiersz['Elektrownia']."LVL<br>".
		"Zakład konwersji uranu: ".$wiersz['Zaklad_Konwersji_Uranu']."LVL<br>".
		"Gwiezdna stocznia: ".$wiersz['Gwiezdna_Stocznia']."LVL<br>";
		
	}
	
	function widok_flota($V_ID_G){
		
		$zap = mysql_query("SELECT * FROM FLOTA WHERE ID_Gracza='".$V_ID_G."' ORDER BY Status ASC");
		while ($wiersz = mysql_fetch_assoc($zap)) 
		{
			echo "<br>";
			echo "===".$wiersz['Status']."===<br>".
			" => Mysliwiec:".$wiersz['Mysliwiec']."<br>".
			" => Niszczyciel_Barakuda:".$wiersz['Niszczyciel_Barakuda']."<br>".
			" => Niszczyciel_Manta:".$wiersz['Niszczyciel_Manta']."<br>".
			" => Krazownik_Orka:".$wiersz['Krazownik_Orka']."<br>".
			" => Krazownik_Merlin:".$wiersz['Krazownik_Merlin']."<br>".
			" => Krazownik_Krab:".$wiersz['Krazownik_Krab']."<br>".
			" => Pancernik:".$wiersz['Pancernik']."<br>";
			
		}	
		
	}
	
	function widok_surowce($V_ID_G){
		
		$zap = mysql_query("SELECT * FROM PLANETA WHERE ID_Gracza='".$V_ID_G."'");
		$wiersz = mysql_fetch_assoc($zap);
		echo "Wodór: ".$wiersz['Wodor']."<br>".
		"Metal: ".$wiersz['Metal']."<br>".
		"Energia: ".$wiersz['Energia']."<br>".
		"Uran: ".$wiersz['Uran']."<br>";
		
	}
		
	function widok_ranking(){
		
		$i=1;
		$zap = mysql_query("SELECT * FROM GRACZ ORDER BY Punkty_Rankingu DESC");
		while ($wiersz = mysql_fetch_assoc($zap)) 
		{
			echo $i.". ".$wiersz['Nazwa_Gracza']." => ".$wiersz['Punkty_Rankingu']."PKT.<br>";
			$i++;
		}
		
	}
	
	function rozlacz(){
		//rozłączenie z bazą
		mysql_close($this->db_connection);
		$_SESSION['baza']='OFF';
	}
	
}

?>