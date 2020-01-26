<?php
	
	//załączniki
	include 'Model/BazaDanych.php';
	include 'Model/Gracz.php';
	include 'Model/Rejestracja.php';
	//reszta załączników
	include 'Model/Budowanie.php';
	include 'Model/Statek.php';
	include 'Model/Flota.php';
	include 'Model/Surowce.php';
	include 'Model/Czas.php';
	include 'Widok/Widoki.php';
	
	//połączenie z bazą danych
	$pol1=new Baza();
	$pol1->polacz();
	//**********************************************************************************************************************************
	//*************************************************************procedura rejestracji************************************************
	//**********************************************************************************************************************************
	if ($_POST['email'] AND $_POST['login1'] AND $_POST['haslo1'])
	{
		// Obsługa				
		$rej1 = new Rejestracja($_POST['email'],$_POST['login1'],$_POST['haslo1']);
		//sprawdzenie rezultatu rejestracji
		$res_rej = $rej1->walidacja($pol1);
		
		//echo '<br>rezultat walidacji:'.$res_rej.' ';
				
		//jeśli dane poprawne 
		if ($res_rej == 0)
		{
			// to zarejestruj
			//echo 'rezultat rejestracji:'.$rej1->rejestracja($pol1).' <br>';
			
			$res_rej = $rej1->rejestracja($pol1);
			$tekst_bledu="";
			//obsługa błędu walidacji
			switch ($res_rej)
			{
				//
				case 0:
						$tekst_bledu = "Rejestracja przebiegła pomyślnie, Zaloguj się";
						break;
				case 1:
						$tekst_bledu = "Błąd dodania Gracza do bazy";
						break;
				case 2:
						$tekst_bledu = "Błąd dodania Planety do bazy";
						break;
				case 3:
						$tekst_bledu = "Błąd dodania Floty Obrony do bazy";
						break;
				default:
						$tekst_bledu = "Błąd wpisu numer: ".$res_rej;
						break;
			}
		}
		else
		{
			$tekst_bledu="";
			//obsługa błędu walidacji
			switch ($res_rej)
			{
				//
				case 1:
						$tekst_bledu = "Nie ma takiego maila";
						break;
				case 2:
						$tekst_bledu = "Nieodpowiendia długość nicka";
						break;
				case 3:
						$tekst_bledu = "Nieodpowiendia długość hasła";
						break;
				case 4:
						$tekst_bledu = "Błąd wyłączonej bazy";
						break;
				/*case 5:
						$tekst_bledu = "";
						break;*/
				case 6:
						$tekst_bledu = "Błąd powtórzonej nazwy gracza";
						break;
				default:
						$tekst_bledu = "Błąd walidacji numer: ".$res_rej;
						break;
			}
		} 
	}
	//jeśli się nie rejestruje to może się zalogować
	else
	{
	//**********************************************************************************************************************************
	//****************************************************************************procedura logowania***********************************
	//**********************************************************************************************************************************
		if ($_POST['login'] AND $_POST['haslo'])
		{
			//obsługa zalogowania
			$Gracz_Zalogowany = new Gracz($pol1, $_POST['login']);
			$Gracz_Zalogowany->zaloguj($pol1, $_POST['login'],MD5($_POST['haslo']));
			$Gracz_Zalogowany->aktualizuj_rankig($pol1);
			
			$Sur = new Surowce($pol1,$Gracz_Zalogowany->ID_G);
			$Sur->aktualizuj($pol1,$Gracz_Zalogowany->ID_G);
			
			//echo "<br> zalogowany gracz:".$Gracz_Zalogowany->Email." <br>";
			$id_widoku = 1;
			
			//jeśli nie udało się zalogować
			if ($Gracz_Zalogowany->Email == null)
			{
				//bład zalogowania
				$tekst_bledu= "Niepoprawny login / hasło";
			}
		}
	}//koniec nie-rejestracji
	
	//wysłąnie komunikatu w razie problemów i cofka do głównej
	if($tekst_bledu)
	{
		$tekst_bledu='Location: index.php?info='.$tekst_bledu;
		header($tekst_bledu);
	}	
	
	//**********************************************************************************************************************************
	//*****************************************************************kontroler - obsługa zalowanego***********************************
	//**********************************************************************************************************************************
	
	//raportowanie błęów
	/*error_reporting(E_ALL); // poziom raportowania, http://pl.php.net/manual/pl/function.error-reporting.php
	ini_set('display_errors', 1);*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	if ($_SESSION['gracz'])
	{
		
		//->wyloguj($pol1);
		
		$Gracz_Zalogowany = new Gracz($pol1, $_SESSION['gracz']);
		
		$Sur = new Surowce($pol1,$Gracz_Zalogowany->ID_G);
		$Sur->aktualizuj($pol1,$Gracz_Zalogowany->ID_G);
	
		//tablica statków
		$tablica_statkow = array('','Mysliwiec','Niszczyciel_Barakuda', 'Niszczyciel_Manta', 'Krazownik_Orka', 'Krazownik_Merlin','Krazownik_Krab','Pancernik');
		
		$Flo = new Flota(0,0,0,0,0,0,0);
		$Flo->aktualizuj_rekrutacja($pol1,$Gracz_Zalogowany->ID_G);
		$res_bitwy="";
		/*switch(*/$test=$Flo->bitwa($pol1,$Gracz_Zalogowany->ID_G,$tablica_statkow);/*)
		{ 
			case 10: //
					$res_bitwy = "Porażka1";
					break;
			case 3: //
					$res_bitwy = "Remis1";
					break;
			case 6: //
					$res_bitwy = "Zwycięstwo1";
					break;
		}*/
		//echo $test[0].$test[1].$test[2].$test[3].$test[4].$test[5].$test[6].$test[7];
		
		if(isset($test[0]))
		{
			echo '
			<script>
				alert("'.$test[0].'Podczas ataku na gracza:'.$test[2].'\nWysłana flota atakująca:\n'.$test[3].'\nPowróciło floty atakującej:\n'.$test[1].'\nFlota obrońcy przed bitwą:\n'.$test[7].'\nFlota obrobńcy po bitwie:\n'.$test[5].'");
			</script>';
		}
		
		$Widok = new Widok();
		if( isset($_GET['id']))
		{
			$id_widoku = $_GET['id'];
		}
		else
		{
			$id_widoku = 1;
		}
		
	echo'
<!DOCTYPE HTML>
	<html lang="pl">
		';
		
		$Widok->head();
		
		echo'
		
		<body>
		';
		$Aktualne_Surowce = new Surowce($pol1,$Gracz_Zalogowany->ID_G);
		$Widok->surowce($Aktualne_Surowce,$Gracz_Zalogowany->Nazwa_Gracza);
		echo'
			<div id="container">
		';
			
		$Widok->menu($id_widoku);		
	
		switch($id_widoku)
		{
			case 1: //widok kokpitu
					;
					//jeśli poszedł formularz ataku
					if (isset($_POST['Mysliwiec']) OR isset($_POST['Niszczyciel_Barakuda']) OR isset($_POST['Niszczyciel_Manta']) OR isset($_POST['Krazownik_Orka'])
					OR isset($_POST['Krazownik_Merlin']) OR isset($_POST['Krazownik_Krab']) OR isset($_POST['Pancernik']) OR isset($_POST['Przeciwnik']) )
					{	
						$kom = null;
						if(isset($_POST['Przeciwnik']))
						{
							$Gracz_Ofiara = new Gracz($pol1,$_POST['Przeciwnik']);
							if (isset($Gracz_Ofiara->ID_G))
							{							
								$Flo1 = new Flota($_POST['Mysliwiec'], $_POST['Niszczyciel_Barakuda'], $_POST['Niszczyciel_Manta'], $_POST['Krazownik_Orka'],
											$_POST['Krazownik_Merlin'], $_POST['Krazownik_Krab'], $_POST['Pancernik']);
						
								switch($Flo1->atak($pol1,$Gracz_Zalogowany->ID_G,$Gracz_Ofiara->ID_G))
								{
									case 0: //
											$kom = "Atak rozpoczęty";
											break;
									case 1: //
											$kom = "Brak floty na planecie";
											break;
									case 2: //
											$kom = "Nie masz tyle jednostek: Myśliwiec";
											break;
									case 3: //
											$kom = "Nie masz tyle jednostek: Niszczyciel Barakuda";
											break;
									case 4: //
											$kom = "Nie masz tyle jednostek: Niszczyciel Manta";
											break;
									case 5: //
											$kom = "Nie masz tyle jednostek: Krążownik Orka";
											break;
									case 6: //
											$kom = "Nie masz tyle jednostek: Krążownik Merlin";
											break;
									case 7: //
											$kom = "Nie masz tyle jednostek: Krążownik Krab";
											break;
									case 8: //
											$kom = "Nie masz tyle jednostek: Pancernik";
											break;
									case 9: //
											$kom = "Błąd wpis obrona";
											break;
									case 10: //
											$kom = "Błąd wpis atak";
											break;
								}
								
							}
							else
							{
								$kom = "Nie ma takiego gracza";
							}
						}
						else
						{
							$kom = "Nie wybrałeś przeciwnika";
						}
						echo'
						<script>
							alert("'.$kom.'");
						</script>';
					}
			
			
			
					$Flo_o = new Flota(0,0,0,0,0,0,0);
					$Flo_o->stan_obrona($pol1,$Gracz_Zalogowany->ID_G);
					$Flo_r = new Flota(0,0,0,0,0,0,0);
					$Flo_r->stan_rekrutacja($pol1,$Gracz_Zalogowany->ID_G);
					$Flo_a = new Flota(0,0,0,0,0,0,0);
					$Flo_a->stan_atak($pol1,$Gracz_Zalogowany->ID_G);
					$Tab_Graczy = $pol1->lista_graczy();
					$Widok->kokpit_atak($tablica_statkow,$Flo_o,$Flo_r,$Flo_a,$Tab_Graczy);
										
					$Widok->kokpit_log();
					$Tablica_Ataku = $Flo_o->tablica_floty_atak($pol1,$Gracz_Zalogowany->ID_G);
					for($i=1;isset($Tablica_Ataku[$i]);$i++)
					{						
						$Widok->kokpit_log_krotka($Tablica_Ataku[$i],"lg_k_".$i);
					}
					$Widok->kokpit_log_stop();
					
					break;
					
			case 2: //widok NIB
					$flaga_budowa = 0;
					$f_nazwa = "";
					$f_poziom = 0;
					//jeśli poszedł formularz rekrutacji
					if (isset($_POST['Stacja_Elektrolizy']))
					{
						$flaga_budowa = 1;
						$f_nazwa = "Stacja_Elektrolizy";
						$f_poziom = $_POST['Stacja_Elektrolizy'];
					}
					if (isset($_POST['Kopalnia']))
					{
						$flaga_budowa = 1;
						$f_nazwa = "Kopalnia";
						$f_poziom = $_POST['Kopalnia'];
					}					
					if (isset($_POST['Elektrownia']))
					{
						$flaga_budowa = 1;
						$f_nazwa = "Elektrownia";
						$f_poziom = $_POST['Elektrownia'];
					}					
					if (isset($_POST['Zaklad_Konwersji_Uranu']))
					{
						$flaga_budowa = 1;
						$f_nazwa = "Zaklad_Konwersji_Uranu";
						$f_poziom = $_POST['Zaklad_Konwersji_Uranu'];
					}					
					if (isset($_POST['Gwiezdna_Stocznia']))
					{
						$flaga_budowa = 1;
						$f_nazwa = "Gwiezdna_Stocznia";
						$f_poziom = $_POST['Gwiezdna_Stocznia'];
					}
					
					if ( $flaga_budowa == 1 ) 
					{
						$Bud1 = new Budowanie($f_nazwa,$f_poziom);
						$kom = null;
						switch($Bud1->buduj($pol1,$Gracz_Zalogowany->ID_G))
						{
							case 0: // 
									$kom = "Budowa rozpoczęta";
									break;
							case 1: // 
									$kom = "Błąd - Błędny wpis do bazy";
									break;
							case 2: // 
									$kom = "Błąd - zbyt mało surowców ";
									break;
							case 3: // 
									$kom = "Błąd - jeszcze nie można budować";
									break;
						}
						echo'
						<script>
							alert("'.$kom.'");
						</script>';
					}
			
			
					$Czas_1 = new Czas(100);
					$Czas_1->czas_budowy($pol1,$Gracz_Zalogowany->ID_G);
					$Widok->zegar($Czas_1);
					
					//tablica budynków
					$ar_b_n = array('','Stacja_Elektrolizy','Kopalnia', 'Elektrownia', 'Zaklad_Konwersji_Uranu', 'Gwiezdna_Stocznia');
					$ar_b_p = array(0,0,0,0,0,0);
					for($i=1;$i<=5;$i++)
					{
						$b = new Budowanie($ar_b_n[$i],1);
						$b->sprawdz($pol1,$Gracz_Zalogowany->ID_G);
						$ar_b_p[$i]=$b->Poziom;
					}
					$Widok->n_i_b($ar_b_n,$ar_b_p);
					break;
					
			case 3: //widok stoczni
					
					
					//jeśli poszedł formularz rekrutacji
					if (isset($_POST['Mysliwiec']) OR isset($_POST['Niszczyciel_Barakuda']) OR isset($_POST['Niszczyciel_Manta']) OR isset($_POST['Krazownik_Orka'])
					OR isset($_POST['Krazownik_Merlin']) OR isset($_POST['Krazownik_Krab']) OR isset($_POST['Pancernik']))
					{
						$Flo1 = new Flota($_POST['Mysliwiec'], $_POST['Niszczyciel_Barakuda'], $_POST['Niszczyciel_Manta'], $_POST['Krazownik_Orka'],
											$_POST['Krazownik_Merlin'], $_POST['Krazownik_Krab'], $_POST['Pancernik']);
						$kom = null;
						switch($Flo1->rekrutuj($pol1,$Gracz_Zalogowany->ID_G))
						{
							case 0: // 
									$kom = "Rekrutacja rozpoczęta";
									break;
							case 1: // 
									$kom = "Błąd - Już rekrutujesz flotę";
									break;
							case 2: // 
									$kom = "Błąd - Za mało Wodoru";
									break;
							case 3: // 
									$kom = "Błąd - Za mało Metalu";
									break;
							case 4: // 
									$kom = "Błąd - Za mało Energii";
									break;
							case 5: // 
									$kom = "Błąd - Za mało Uranu";
									break;
							case 6: // 
									$kom = "Błędny wpis do bazy - surowce";
									break;
							case 7: // 
									$kom = "Błędny wpis do bazy - flota";
									break;
						}
						echo'
						<script>
							alert("'.$kom.'");
						</script>';
							
					}				
					
					$Czas_1 = new Czas(100);
					$Czas_1->czas_rekrutacji($pol1,$Gracz_Zalogowany->ID_G);
					$Widok->zegar($Czas_1);
					$Widok->stocznia($tablica_statkow);
					
					break;
					
			case 4: //widok rankingu
					$Gracz_Zalogowany->aktualizuj_rankig($pol1);
					$Widok->ranking($Gracz_Zalogowany);
					break;
					
			case 5: // logout					
					$Gracz_Zalogowany->wyloguj($pol1);
					echo '<script> window.location.replace("http://thesuperkingdomofuniverse.damianchlebica.pl"); </script>';
					break;
		}	
		
			//echo $_SESSION['gracz'];
			
			
			
		echo'
			</div>
		';
			
			$Widok->stopka();
			
		echo'<div id="prv-billboard"></div>	
		</body>
	</html>
		';
	
		
		
		
		
		
		
		
		
	}
	else
	{
		if($tekst_bledu == null)
		{
			header('Location: index.php');
		}
	}
	
	
	
	
	
	
	//
	$pol1->rozlacz();
?>






