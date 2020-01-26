<?
class Widok{
	 
	//domyślne pola do połączenia z bazą
	var $id_widoku;
	
	function __construct(){
		$this->id_widoku = rand(0,1000);
	}
	
	function head(){
		echo '
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
			<title>The Super Kingdom of Univers</title>
		
			<meta name="description" content="Gra przeglądarkowa, utrzymana w klimacie roku 2121. Rywalizacja o status najpotężniejszego władcy wszechświata. Rozwijaj swoje królestwo poprzez wydobywanie surowców, rozbudowę budynków, oraz powiększanie armii. Pamiętaj, że posiadanie kosmicznej floty jest konieczne do niszczenia armii przeciwnika oraz rabowania surowców innych graczy!" />
			<meta name="keywords" content="kosmos, gra, wszechświat, flota, okręt, statek, surowce, armia" />
			<link rel="stylesheet" href="Zasoby/podstrona.css" type="text/css" />
			<link href="https://fonts.googleapis.com/css?family=Noticia+Text:400,700&amp;subset=latin-ext" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
		</head>
		';
	}
	
	function menu($V_pos){
		
		
		echo '
		<div class="nav">';
		
		$ar_l = array("","K", "N", "S", "R", "W");
		$ar_o = array("","Kokpit", "N-I-B", "Stocznia", "Ranking", "Wyloguj");
		for ($i = 1; $i <=5 ; $i++)
		{			
			$l=$ar_l[$i];
			if ($V_pos==$i)
			{
				$w1=3;
				$w2=3;
			}
			else
			{
				$w1=1;
				$w2=2;
			}			
			echo '
			<div class="square">
				<a href="control.php?id='.$i.'" 
				onMouseOver="grafika'.$i.'.src=\'Zasoby/img/Przycisk'.$l.$w1.'.png\'" 
				onMouseOut="grafika'.$i.'.src=\'Zasoby/img/Przycisk'.$l.$w2.'.png\'" 
				Onclick="grafika'.$i.'.src=\'Zasoby/img/Przycisk'.$l.'3.png\'"  
				>
			<img src="Zasoby/img/Przycisk'.$l.$w2.'.png" name="grafika'.$i.'" alt="'.$ar_o[$i].'" style="width:250px;height:56px;"></a>
			</div>			
			';
		}
		echo'
		</div>
		';
	}
	
	function stocznia($ar_s){
		echo'
		<main>
			<article>
				<div id="chapter">
				<form name="rekrutacja" action="control.php?id=3" method="POST">
		';
		
		for($i=1;$i<=7;$i++)
		{
			//stworzenie statku do pobrania parametrów
			$s = new Statek($ar_s[$i],1);
			$this->statek($s);			
		}
		
		$this->kalkulator_surowców($s);
		
		echo'
					<div id="then">
						<input type="submit" value="" name="dalej" id="dalej">
					</div>
				</form>
				
				</div>
			</article>
		</main>
		';
	}
	
	function statek($V_Statek){
		
		echo'
		<section>	
			<div class="unit">
				<div class="ships">
					<div class="shipimg">
						<img src="Zasoby/img/'.$V_Statek->Nazwa.'.png" alt="'.$V_Statek->Nazwa.'" style="width:135px;height:126px;border: 5px double  #0f0f0a;">
						<div class="nameship" style="clear:both;">
						'.$V_Statek->Nazwa.'
						</div>	
					</div>
				</div> 
			
				<div class="specification">
					<span>'.$V_Statek->Opis.'</span>
						<br /> <br />
					<span class="price">Koszt:<br>Wodór='.$V_Statek->Wodor.', Metal='.$V_Statek->Metal.', Energia='.$V_Statek->Energia.', Uran='.$V_Statek->Uran.'<br>Czas budowy='.$V_Statek->Czas.'s</span>
					<br /><br />
					<span class="price">Statystyki:<br>Atak='.$V_Statek->Atak.', Pancerz='.$V_Statek->Pancerz.'</span>
				</div>
			
				<div class="summary">
					<div class="stocznia_number">
						<label for="'.$V_Statek->Nazwa.'"></label>
						<input type="text" name="'.$V_Statek->Typ.'" id="'.$V_Statek->Typ.'" value="0" autocomplete="off"
						onchange="Licz_koszt_rekrutacji(this.value,this.name,'.$V_Statek->Wodor.','.$V_Statek->Metal.','.$V_Statek->Energia.','.$V_Statek->Uran.')"> 
					</div>
				</div>
			</div>
		</section>
		';
	}
	
	function stopka(){
		echo'		
			<a id="gototop" title="Do góry" href="#" style="display: block;"></a>
			<script src="Zasoby/jquery-1.11.3.min.js"></script>
			<script>
				$(document).ready(function()
				{
					$("#gototop").hide();
					$(window).scroll(function()
					{
						if ($(this).scrollTop() > 100) 
						{
					$("#gototop").fadeIn(500);
						}
						else 
						{
					$("#gototop").fadeOut(500);
						}
					});
					$("#gototop").click(function()
					{
					$("html, body").animate({ scrollTop: 0 }, 1000);
					return false;
					});
				});
			</script>
			<script>
			
		$(document).ready(function() {
			var NavY = $(\'#materialy\').offset().top;
			 
			var stickyNav = function(){
			var ScrollY = $(window).scrollTop();
				  
			if (ScrollY > NavY) { 
				$(\'#materialy\').addClass(\'sticky\');
			} else {
				$(\'#materialy\').removeClass(\'sticky\'); 
			}
			};
			 
			stickyNav();
			 
			$(window).scroll(function() {
				stickyNav();
			});
			});
			</script>
	
			<footer>
				<div id="footer" style="clear:both;">Wszelkie prawa zastrzeżone &copy; by Damian Chlebica 2018</div>
			</footer>
		';			
	}
	
	function surowce($V_sur,$V_Naz_Gra){
		
		echo'
		<div id="materialy">
			<div id="materia">
			<div id="uzytkownik">'.$V_Naz_Gra.'</div>
				<div id="surowce">
					<div class="surowiec1">
						<div class="surowce1"><img src="Zasoby/img/Wodor.png" alt="Wodór" style="width:29px;height:33px;"></div>
						<div class="surowce2">Wodór:</div>
						<div class="surowce3">'.$V_sur->Wodor.'</div>
					</div>
					
					<div class="surowiec">
						<div class="surowce1"><img src="Zasoby/img/Metal.png" alt="Metale" style="width:29px;height:33px;"></div>
						<div class="surowce2">Metal:</div>
						<div class="surowce3">'.$V_sur->Metal.'</div>
					</div>
					
					<div class="surowiec">
						<div class="surowce1"><img src="Zasoby/img/Energia.png" alt="Energia" style="width:29px;height:33px;"></div>
						<div class="surowce2">Energia:</div>
						<div class="surowce3">'.$V_sur->Energia.'</div>
					</div>
					
					<div class="surowiec">
						<div class="surowce1"><img src="Zasoby/img/Uran.png" alt="Uran" style="width:29px;height:33px;"></div>
						<div class="surowce2">Uran:</div>
						<div class="surowce3">'.$V_sur->Uran.'</div>
					</div>
				</div>	
			</div>
		</div>
		<div id="posiadane_surowce" style="visibility: hidden;">
		Wodor='.$V_sur->Wodor.' Metal='.$V_sur->Metal.' Energia='.$V_sur->Energia.' Uran='.$V_sur->Uran.'
		</div>
		';
	}
	function zegar($V_Czas){		
		//
		echo '		
		<script>
		var t = setTimeout("zegar()", 10);
		var c = '.$V_Czas->Calosc.';
		function zegar() {
			var h = Math.floor(c / 3600);
			var m = Math.floor((c - h * 3600) / 60);
			var s = Math.floor((c - h * 3600 - m * 60));
			if(c>=0)
			{
				document.getElementById(\'timer1\').innerHTML = h+":"+m+":"+s;
				c -= 1;
				t = setTimeout("zegar()", 1000);
			}
			
		}		
		</script>
		
		<section>	
			<div id="timer">
				<div id="czar">
					<img src="Zasoby/img/Czar1.png" alt="Zegar" style="width:29px;height:33px;">
				</div>
				<div id=\'timer1\'>0:0:0</div>
				
			</div>
			
		</section>';/*<div id=\'ten\'></div><div style="clear:both;"></div><div style="clear:both;"></div>*/
		
	}
	function kalkulator_surowców($V_Statek){
		
		echo'
		<script>			
			var tablica_kosztow = 
			[[0,"Mysliwiec",0,0,0,0],
			[0,"Niszczyciel_Barakuda",0,0,0,0] ,
			[0,"Niszczyciel_Manta",0,0,0,0] ,
			[0,"Krazownik_Orka",0,0,0,0] ,
			[0,"Krazownik_Merlin",0,0,0,0] ,
			[0,"Krazownik_Krab",0,0,0,0] ,
			[0,"Pancernik",0,0,0,0],
			[0,"suma",0,0,0,0]];
			var podpunktu = 0;
			
			function Licz_koszt_rekrutacji(ilosc,nazwa,w,m,e,u){
				switch(nazwa){
					case tablica_kosztow[0][1]:
						podpunktu = 0;
						break;						
					case tablica_kosztow[1][1]:
						podpunktu = 1;
						break;
					case tablica_kosztow[2][1]:
						podpunktu = 2;
						break;
					case tablica_kosztow[3][1]:
						podpunktu = 3;
						break;
					case tablica_kosztow[4][1]:
						podpunktu = 4;
						break;
					case tablica_kosztow[5][1]:
						podpunktu = 5;
						break;
					case tablica_kosztow[6][1]:
						podpunktu = 6;
						break;
				}				
				tablica_kosztow[podpunktu][0] = ilosc;
				tablica_kosztow[podpunktu][2] = ilosc*w;
				tablica_kosztow[podpunktu][3] = ilosc*m; 
				tablica_kosztow[podpunktu][4] = ilosc*e;
				tablica_kosztow[podpunktu][5] = ilosc*u;
				
				var i;
				tablica_kosztow[7][2] = 0;
				tablica_kosztow[7][3] = 0;
				tablica_kosztow[7][4] = 0;
				tablica_kosztow[7][5] = 0
				for(i=0;i<7;i++)
				{
					tablica_kosztow[7][2] += tablica_kosztow[i][2];
					tablica_kosztow[7][3] += tablica_kosztow[i][3];
					tablica_kosztow[7][4] += tablica_kosztow[i][4];
					tablica_kosztow[7][5] += tablica_kosztow[i][5];
				}
				
				alert("KALKULATOR KOSZTÓW REKRUTACJI\n\nkoszt rekrutacji to: \n"
				+ "Wodór=" + tablica_kosztow[7][2] + ", "
				+ "Metal=" + tablica_kosztow[7][3] + ", "
				+ "Energia=" + tablica_kosztow[7][4] + ", "
				+ "Uran=" + tablica_kosztow[7][5] + ", "
				+ "\na posiadasz:" + document.getElementById(\'posiadane_surowce\').innerHTML
				+ "\nPRZYCISK REKRUTACJI JEST NA KOŃCU FORMULARZA")
				;
				
			}
		</script>
		';
	}
	function ranking($V_G_Zal){
		
		echo'
		<main>
			<article>
				<div id="chapter">
					<div id="rankig_chapter">
						<table id="t01">
							<caption id="ranking">RANKING</caption>
								<tr>
									<th>Miejsce</th>
									<th>Gracz</th> 
									<th>Punkty</th>
									<th>Dystans</th>
								</tr>
		';
		
		$i=1;
		$zap = mysql_query("SELECT * FROM GRACZ ORDER BY Punkty_Rankingu DESC");
		while ($wiersz = mysql_fetch_assoc($zap)) 
		{
			echo "
				<tr>
					<td>".$i."</td>".
					"<td>".$wiersz['Nazwa_Gracza']."</td>".
					"<td>".$wiersz['Punkty_Rankingu']."</td>
			";
			
			$tmp_X = $V_G_Zal->WspX;
			$tmp_Y = $V_G_Zal->WspY;		
			$tmp_X -= $wiersz['WspX'];
			$tmp_Y -= $wiersz['WspY'];
		
			$tmp_wyp = floor(sqrt(pow($tmp_X,2)+pow($tmp_Y,2)));
			
			echo "
					<td>".$tmp_wyp."</td>
				</tr>
			";			
			$i++;
		}
		
		echo'
						</table>
					</div>
				</div>		
			</article>
		</main>				
		';
	}
	
	function n_i_b($V_ar_b_n,$V_ar_b_p){
		echo'
		<main>
			<article>
			<h1> Najwyższa Izba Budowy </h1>
				<div id="chapter">
					<form action="control.php?id=2" method="POST">
		';
		
		//tablica budynków
		for($i=1;$i<=5;$i++)
		{
			//stworzenie budynku do pobrania parametrów
			$b = new Budowanie($V_ar_b_n[$i],$V_ar_b_p[$i]);
			$this->budynek($b);
		}
		
		
		echo'
					</form>
				</div>
			</article>
		</main>				
		';
		
		
	}
	
	function budynek($V_Budynek){
		
		echo'
		<section>	
			<div class="unit">
				<div class="ships">
					<div class="shipimg">
						<img src="Zasoby/img/'.$V_Budynek->Typ.'.png" alt="'.$V_Budynek->Nazwa.'" style="width:135px;height:126px;border: 5px double  #0f0f0a;">
						<div class="nib_nameship1" style="clear:both;">'.$V_Budynek->Nazwa.'<br> LVL: '.$V_Budynek->Poziom.' </div>
					</div>
				</div> 
			
				<div class="specification">
					<span>'.$V_Budynek->Opis.'</span>
						<br /> <br />
					<span class="price">Koszt:<br/>Wodór='.$V_Budynek->Wodor.', Metal='.$V_Budynek->Metal.', Energia='.$V_Budynek->Energia.', Uran='.$V_Budynek->Uran.'<br/>Czas budowy='.$V_Budynek->Czas.'s</span>
					<br /><br />
					<span class="price">Statystyki:<br/>aktualnie='.$V_Budynek->Przyrosty.'jedn./h<br/>ulepszony='.$V_Budynek->Przyrosty_lvl_up.'jedn./h</span>	
				</div>
			
				<div class="summary">
					<div class="nib_number">
						<input value="'.$V_Budynek->Poziom.'" name="'.$V_Budynek->Typ.'" type="submit" id="buduj">
					</div>
				</div>
			</div>
		</section>
		';
	}
	
	function kokpit_atak($V_tab_s,$V_Flo_o,$V_Flo_r,$V_Flo_a,$V_Tab_Gra){
		echo'
		<main>
			<article>
				<div id="chapter">
					<form action="control.php?id=1" method="POST">
		';
		
		for($i=1;$i<=7;$i++)
		{
			$s = new Statek($V_tab_s[$i],1);
			$this->kokpit_raport_statkow($s->Nazwa,$V_tab_s[$i],$V_Flo_o->$V_tab_s[$i],$V_Flo_r->$V_tab_s[$i],$V_Flo_a->$V_tab_s[$i]);
		}
		
		echo'
						<div id="atakuj">
							<div id="atak">
								<input type="submit" value="" name="atak" id="atak">
							</div>
							<div id="gracz">
								<label for="gracz"></label>
								<input type="text" id="gracz" name="Przeciwnik" placeholder="NAZWA GRACZA" onfocus="this.placeholder=\'\'" 
								onblur="this.placeholder=\'NAZWA GRACZA\'"  list="podpowiedz_li"
								maxlength="20";> 
							</div>
							<datalist id="podpowiedz_li">
		';
		
		$tab=explode('_',$V_Tab_Gra);
		foreach($tab as $k)
		{
			echo '<option value="'.$k.'" id="gracz">';
		}
		
		echo'
							</datalist>
						</div>
					</form>
				</div>
			</article>
		</main>';
		
	}
	function kokpit_raport_statkow($V_Naz,$V_Typ,$V_Obr,$V_Rek,$V_Ata){
		echo'
		<section>						
			<div class="kokpit_unit">
				<div class="kokpit_ships">
					<div class="shipimg">
						<img src="Zasoby/img/'.$V_Naz.'.png" alt="'.$V_Naz.'" style="width:135px;height:126px;border: 5px double  #0f0f0a;">
						<div class="nameship" style="clear:both;">'.$V_Naz.'</div>
					</div>
				</div> 
			
				<div class="kokpit_specification">
					<div id="kokpit_chapter1" style="clear:both;">
						<table id="t02">
							<tr>
								<th colspan="3">Ilość okrętów</th>
							</tr>
							<tr>
								<td>w budowie</td>
								<td>na planecie</td>
								<td>w ataku</td> 								
							</tr>
							<tr>								
								<td>'.$V_Rek.'</td>
								<td>'.$V_Obr.'</td>
								<td>'.$V_Ata.'</td>
							</tr>
						</table>
					</div>
				</div>
			
				<div class="kokpit_summary">
					<div class="stocznia_number">
						<label for="'.$V_Naz.'"></label>
						<input type="text" name="'.$V_Typ.'" id="'.$V_Typ.'" value="0" autocomplete="off"> 
					</div>
				</div>
			</div>
		</section>';
	}	

	function kokpit_log(){
		
		echo'
		<div id="kokpit_chapter" style="clear:both;">
			<table id="t03">
				<tr>
					<th rowspan="2">Nazwa Atakowanego</th>
					<th colspan="7">Okręt</th>
					<th rowspan="2">Czas rozstrzygnięcia bitwy</th>
				</tr>
				<tr>
					<th><img src="Zasoby/img/Mysliwiec.png" alt="Mysliwiec" title="Myśliwiec" style="width:68px;height:63px"></th> 					
					<th><img src="Zasoby/img/Barakuda.png" alt="Barakuda" title="Barakuda" style="width:68px;height:63px"></th>
					<th><img src="Zasoby/img/Manta.png" alt="Manta" title="Manta" style="width:68px;height:63px"></th>
					<th><img src="Zasoby/img/Orka.png" alt="Orka" title="Orka" style="width:68px;height:63px"></th>
					<th><img src="Zasoby/img/Merlin.png" alt="Merlin" title="Merlin" style="width:68px;height:63px"></th>
					<th><img src="Zasoby/img/Krab.png" alt="Krab" title="Krab" style="width:68px;height:63px"></th>
					<th><img src="Zasoby/img/Pancernik.png" alt="Pancernik" title="Pancernik" style="width:68px;height:63px"></th>
				</tr>
		';
		
	}
	function kokpit_log_krotka($V_Flota,$V_id){
		echo'
		<tr>
			<td>'.$V_Flota->Nazwa_Ofiary.'</td>
			<td>'.$V_Flota->Mysliwiec.'</td>
			<td>'.$V_Flota->Niszczyciel_Barakuda.'</td>
			<td>'.$V_Flota->Niszczyciel_Manta.'</td>
			<td>'.$V_Flota->Krazownik_Orka.'</td>
			<td>'.$V_Flota->Krazownik_Merlin.'</td>
			<td>'.$V_Flota->Krazownik_Krab.'</td>
			<td>'.$V_Flota->Pancernik.'</td>
			<td><div id="'.$V_id.'">'.$V_Flota->Tim_stamp_Stop.'</div></td>
		</tr>
		';
		$cza_1 = new Czas(strtotime($V_Flota->Tim_stamp_Stop)-strtotime(date("Y-m-d H:i:s",time())));
		$this->odliczanie_atak($cza_1,$V_id);
		
	}
	
	function kokpit_log_stop(){
		echo'
			</table>
		</div>
		';		
	}
	
	function odliczanie_atak($V_Czas,$V_ID){		
		
		echo '
		<script>
		var t'.$V_ID.' = setTimeout("zegar'.$V_ID.'()", 10);
		var c'.$V_ID.' = '.$V_Czas->Calosc.';
		function zegar'.$V_ID.'() {
			var h'.$V_ID.' = Math.floor(c'.$V_ID.' / 3600);
			var m'.$V_ID.' = Math.floor((c'.$V_ID.' - h'.$V_ID.' * 3600) / 60);
			var s'.$V_ID.' = Math.floor((c'.$V_ID.' - h'.$V_ID.' * 3600 - m'.$V_ID.' * 60));
			if(c'.$V_ID.'>=0)
			{
				document.getElementById(\''.$V_ID.'\').innerHTML = h'.$V_ID.'+":"+m'.$V_ID.'+":"+s'.$V_ID.';
				c'.$V_ID.' -= 1;
				t'.$V_ID.' = setTimeout("zegar'.$V_ID.'()", 1000);
			}
			
		}		
		</script>
		';
		
	}
	
	
}
