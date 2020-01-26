<?
class Statek{
	
	//ważne pola
	var $Nazwa;
	var $Wodor;
	var $Metal;
	var $Energia;
	var $Uran;
	var $Czas;//produkcji
	var $Typ;//nazwa
	var $Ilosc;
	var $Szybkosc;//poruszania sie
	var $Atak;
	var $Pancerz;
	var $Opis;
	
	function __construct($V_typ,$V_ilo){
		
		switch ($V_typ) {
			case 'Mysliwiec':
				$this->Nazwa = 'Mysliwiec';
				$this->Wodor = 10*$V_ilo;
				$this->Metal = 12*$V_ilo;
				$this->Energia = 6*$V_ilo;
				$this->Uran = 3*$V_ilo;
				$this->Czas =  100*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 3*$V_ilo;
				$this->Pancerz = 5*$V_ilo;
				$this->Opis = "Jedyny typ okrętu mogący swobodnie startować i lądować na powierzchni większości planet. 
				Główną jego zaletą jest niska cena, łatwość produkcji i duża szybkość. 
				Ma wystarczającą siłę ognia, by w jakiś sposób zaszkodzić każdemu typowi jednostek. 
				Niestety jest przy tym bardzo wrażliwy na ostrzał i niezdolny do lotu FTL.";
				break;
			case 'Niszczyciel_Barakuda':
				$this->Nazwa = 'Barakuda';
				$this->Wodor = 45*$V_ilo;
				$this->Metal = 30*$V_ilo;
				$this->Energia = 14*$V_ilo;
				$this->Uran = 10*$V_ilo;
				$this->Czas =  230*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 7*$V_ilo;
				$this->Pancerz = 12*$V_ilo;
				$this->Opis = "Okręt ten, tak jak Manta jest niszczycielem, jednak w związku, że posiada całkiem przyzwoitą siłę ognia, 
				niemal dorównuje niektórym krążownikom. Dysponuje wielowarstwowym pancerzem oraz generatorem lustra. 
				Posiada 6 wyrzutni pocisków stanowiących jego główną broń. Może przenosić w swoim wnętrzu 5 Myśliwców";
				break;
			case 'Niszczyciel_Manta':
				$this->Nazwa = 'Manta';
				$this->Wodor = 40*$V_ilo;
				$this->Metal = 25*$V_ilo;
				$this->Energia = 12*$V_ilo;
				$this->Uran = 14*$V_ilo;
				$this->Czas =  280*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 5*$V_ilo;
				$this->Pancerz = 12*$V_ilo;
				$this->Opis = "Rodzaj niszczyciela, czyli najmiejszej jednostki zdolnej do lotu z prędkością nadświetlną (FTL). 
				Dysponuje wielowarstwowym pancerzem oraz generatorem lustra, co znacznie zwiększa jego żywotność na polu walki. 
				Posiada 4 wyrzutne pocisków stanowiących jego główną broń. Może przenosić w swoim wnętrzu 10 Myśliwców.";
				break;
			case 'Krazownik_Orka':
				$this->Nazwa = 'Orka';
				$this->Wodor = 40*$V_ilo;
				$this->Metal = 60*$V_ilo;
				$this->Energia = 50*$V_ilo;
				$this->Uran = 20*$V_ilo;
				$this->Czas =  320*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 12*$V_ilo;
				$this->Pancerz = 20*$V_ilo;
				$this->Opis = "Krążownik, posiadający mocny pancerz na przodzie oraz jak wszystkie większe statki generator lustra, 
				pozwalający odbić wiązki lasera. Dodatkowo aż 12 wyrzutni pocisków, które można załadować zarówno potężnymi głowicami 
				z utwardzonym rdzeniem, jak i przeciwpociskami. Największą jego siłą jest laser dalekiego zasięgu. Może przenosić do 20 Myśliwców.";
				break;
			case 'Krazownik_Merlin':
				$this->Nazwa = 'Merlin';
				$this->Wodor = 50*$V_ilo;
				$this->Metal = 40*$V_ilo;
				$this->Energia = 15*$V_ilo;
				$this->Uran = 30*$V_ilo;
				$this->Czas =  500*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 20*$V_ilo;
				$this->Pancerz = 20*$V_ilo;
				$this->Opis = "Okręt ten zaprojektowano z myślą o walce w drugiej linii. Dysponuje zaledwie 8 wyrzutniami pocisków. 
				Jego główną siłą są cztery działa Gaussa dużego kalibru. Jednak, aby nimi wycelować, trzeba wykonać manewr całym okrętem. 
				Jest zatem mało użyteczny przeciwko lekkim i zwinnym celom. Może przenosić do 20 Myśliwców.";
				break;
			case 'Krazownik_Krab':
				$this->Nazwa = 'Krab';
				$this->Wodor = 50*$V_ilo;
				$this->Metal = 50*$V_ilo;
				$this->Energia = 30*$V_ilo;
				$this->Uran = 45*$V_ilo;
				$this->Czas =  400*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 16*$V_ilo;
				$this->Pancerz = 20*$V_ilo;
				$this->Opis = "Niebagatelnie wytrzymały okręt. Aż 16 wyrzutni pocisków sprawia, że każda salwa to realne zagrożenie 
				dla każdego przeciwnika. Istny ruchomy mur przeciwpocisków. Nawet jeśli, któraś z rakiet zdoła się prześlizgnąć przez 
				tę ochronę musi jeszcze pokonać stanowiska SRL, czyli laserów krótkiego zasięgu. Może przenosić do 20 Myśliwców.";
				break;
			case 'Pancernik':
				$this->Nazwa = 'Pancernik';
				$this->Wodor = 150*$V_ilo;
				$this->Metal = 200*$V_ilo;
				$this->Energia = 100*$V_ilo;
				$this->Uran = 150*$V_ilo;
				$this->Czas =  1000*$V_ilo;
				$this->Typ = $V_typ;
				$this->Ilosc = $V_ilo;
				$this->Szybkosc = 20;
				$this->Atak = 30*$V_ilo;
				$this->Pancerz = 100*$V_ilo;
				$this->Opis = "Rzadko widywane okręty z uwagi na ogromne koszta i czas potrzebny na ich stworzenie. 
				Są straszakiem na wrogów i gwarantem bezpieczeństwa, a utrata lub zniszczenie choćby jednego może 
				przechylić szalę zwycięstwa. Te potężne lewiatany nie są tak wolne, jak możnaby się spodziewać po czymś tego rozmiaru.";
				break;
		}
	}
}
?>