<?php
class Application_Form_AngebotBearbeiten extends App_Form {
	public function __construct($options = null) {
		parent::__construct ( $options );
		
		$offer = $_SESSION ['otc'];
		$articles = $offer->getAngebot ();
		$art_mapper = new Application_Model_ArtikelMapper ();
		
		foreach ( $articles as $index => $artikel ) {
			$art_nr = $art_mapper->getArtikelByArtikelnummer ( $artikel->getArtikelnummer () );
			$art = $art_nr->getModel ();
			
			$art_name = new Zend_Form_Element_Text ( "artname$index" );
			$art_name->setLabel ( 'Artikelname: ' )->setValue ( $art )->setAttrib ( 'disabled', 'disabled' );
			$this->addElement ( $art_name );
			
			$art_text = new Zend_Form_Element_Textarea ( "arttext$index" );
			$art_text->setLabel ( 'Bemerkung des Nutzers: ' )->setValue ( $artikel->getBemerkung () )->setAttrib ( 'disabled', 'disabled' );
			$this->addElement ( $art_text );
			
			$art_state = new Zend_Form_Element_Text ( "artstate$index" );
			$art_state->setLabel ( 'Aktueller Status: ' )->setValue ( $artikel->getStatus () )->setAttrib ( 'disabled', 'disabled' );
			$this->addElement ( $art_state );
			
			$this->addElement ( 'select', 'newState' . ($index), array (
					'required' => true,
					'label' => 'Neuen Status zuweisen:',
					'value' => 'NULL',
					'multiOptions' => array (
							'NULL' => 'Bitte Status wählen',
							'In Bearbeitung' => 'In Bearbeitung',
							'Abgeschlossen' => 'Abgeschlossen',
							'Beendet' => 'Beendet' 
					) 
			) );
			
			
			
		}
		
		$submit = new Zend_Form_Element_Submit ( 'submit' );
		$submit->setLabel ( 'Angebot speichern' );
		
		$this->addElement ( $submit );
	}
}