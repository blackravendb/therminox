
<div id="view-content">
		
	<?php
	// TODO Ausnahmen abfangen! ->schlumpfhandling -.-
	$data_object = $this->dbdata;
	if($this->dbdata === null){
		if ( isset($this->message))
			echo $this->message;
		else 
		echo 'Artikel konnte nicht gefunden werden';
		if (isset ( $_SERVER ['HTTP_REFERER'] )) {
			$this->view->link = $_SERVER ['HTTP_REFERER'];
		} else {
			$this->view->link = '/wassererwaermer';
		}
	}
	/* Auf Fehler Überprüfen
	if($data_object->getModel () == null ||
	$data_object->getBetriebsDruck () == null ||
	$data_object->getTemperatur () === null ||
	$data_object->getHoehe () == null ||
	$data_object->getBreite () == null ||
	$data_object->getStutzenmaterial () == null ||
	$data_object->getWaermetauscherEinsatzgebiet () == null ||
	$data_object->getWaermetauscherAnschluss () == null ||
	$data_object->getWaermetauscherUnterkategorie ()  == null ) {
		echo 'Artikel konnte nicht gefunden werden';
		if (isset ( $_SERVER ['HTTP_REFERER'] )) {
			$this->view->link = $_SERVER ['HTTP_REFERER'];
		} else {
			$this->view->link = '/wassererwaermer';
		}
		
	}
	*/
	// Artikeldaten anordnen und anzeigen
	
	$art_model = $data_object->getModel ();
	$art_dim = $data_object->getSpeicherinhalt ();
	$art_weight = $data_object->getleergewicht ();
	$art_pressure = $data_object->getBetriebsDruck ();
	$art_temp = $data_object->getTemperaturMax ();
	$art_loc = $data_object->getEinsatzgebiet ();
	
	echo '<br>';
	echo '<h1>Pufferspeicher ' . $art_model . '</h1>';
	
	echo '<br>';
	// TODO funzt noch ned
	echo '<div class="bild"><img src="/_files/images/pufferspeicher/vvx/'.$art_model.'.png" alt="'.$art_model.'" id ="bilder">';
	echo '<br>Konstruktionszeichnung</div>';
	echo '<div class="daten">';
		echo '<div class="grunddaten">';
			echo '<h2>Grunddaten:</h2>';
			echo '<br>';
			echo '<h3>Brenntemperatur:</h3>';
			echo $art_temp . '°C';
			echo '<h3>Betriebsdruck:</h3>';
			echo $art_pressure . ' bar';
			echo '<br>';
			echo '<h3>Fassungsverm&ouml;gen:</h3>';
			echo $art_dim . ' Liter';
			echo '<br>';
			echo '<h3>Leergewicht:</h3>';
			echo $art_weight . 'Kg';
			echo '<br>';
		echo '</div>';
		echo '<div class="grunddaten">';
			echo '<br><br>';
			if (!is_array ( $art_loc )) {
				echo '<h3>Einsatzgebiet:</h3>';
				echo $art_loc;
			} else {
				echo '<h3>Einsatzgebiete:</h3>';
				foreach ( $art_loc as $each )
					echo $each->getEinsatzgebiet();
			}
			echo '<br>';
		echo '</div>';
		echo '<br><br>';
	echo '</div>';

	echo  '<a href="/Angebot/erstellen/artikel/'.$art_model.'">Angebot über diesen Artikel einholen</a><div>';
	
	?>
	
</div>