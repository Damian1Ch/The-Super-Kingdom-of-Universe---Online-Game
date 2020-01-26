<?
echo '
<!DOCTYPE HTML>
<html lang="pl">
	<head>
	
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>The Super Kingdom of Univers</title>
	
		<meta name="description" content="Gra przeglądarkowa, utrzymana w klimacie roku 2121. Rywalizacja o status najpotężniejszego władcy wszechświata. Rozwijaj swoje królestwo poprzez wydobywanie surowców, rozbudowę budynków, oraz powiększanie armii. Pamiętaj, że posiadanie kosmicznej floty jest konieczne do niszczenia armii przeciwnika oraz rabowania surowców innych graczy!" />
		<meta name="keywords" content="kosmos, gra, wszechświat, flota, okręt, statek, surowce, armia" />
	
		<link rel="stylesheet" href="Zasoby/index.css" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Noticia+Text:400,700&amp;subset=latin-ext" rel="stylesheet">
	
	</head> 

	<body>';
		//raportowanie błęów
		/*error_reporting(E_ALL); // poziom raportowania, http://pl.php.net/manual/pl/function.error-reporting.php
		ini_set('display_errors', 1);*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		?>
		<?
		////////obsługa aletów////////
		//zarejestrowany
		if ($_GET['info'] != null )
		{
			//alert 
			echo '<script>alert("'.$_GET['info'].'");
			</script>';
		}
		
		echo '
		<div id="container">
			<div id="form">
				<form action="control.php" method="POST">
			
					<div id="loginform">
						<div>
							<label for="login"></label>
							<input type="text" name="login" id="login" placeholder="LOGIN" onfocus="this.placeholder=\'\'" onblur="this.placeholder=\'LOGIN\'" autocomplete="off"> 
						</div>
			
						<div>
							<label for="haslo"></label>
							<input type="password" name="haslo" id="haslo" placeholder="HASŁO" onfocus="this.placeholder=\'\'" onblur="this.placeholder=\'HASŁO\'" autocomplete="off">
						</div>
				</div>
				
				<div id="logsab" style="clear:both;">
					<input type="submit" value="" name="log" id="log">
				</div>
				 
				</form>
			</div>
		
			<h1>The Super Kingdom of Universe</h1>
		
			<div id="registration">
				<div id="registry"><img src="Zasoby/img/rejestracja.png" alt="Rejestracja" style="width:351px;height:45px"></div>

					<form action="control.php" method="POST">
					<div id="registryform">
						<div class="information"><img src="Zasoby/img/login.png" alt="Podaj login" autocomplete="off" style="float:left;width:203px;height:28px">
							<label for="login1"></label>
							<input type="text" name="login1" id="login1" maxlength="20">
						</div>
					
						<div class="information"><img src="Zasoby/img/haslo.png" alt="Podaj hasło" autocomplete="off" style="float:left;width:203px;height:28px">
							<label for="haslo1"></label>
							<input type="password" name="haslo1" id="haslo1" maxlength="20">
						</div>
						
						<div class="information"><img src="Zasoby/img/email.png" alt="Podaj e-mail" autocomplete="off" style="float:left;width:203px;height:28px">
							<label for="email"></label>
							<input type="text" name="email" id="email">
						</div>
					</div>
					
						<div id="then">
							<input type="submit" value="" name="dalej" id="dalej">
						</div>
					</form>
			</div>
		</div>
		
		<footer>
			<div id="footer">Wszelkie prawa zastrzeżone &copy; 2018</div>
		</footer>
	<div id="prv-billboard"></div>	
	</body>
</html>';
?>