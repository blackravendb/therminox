<?php

class Zend_View_Helper_Address extends Zend_View_Helper_Abstract
{
	public function Address ()
	{
		return $this;
	}
	
	public function type ($type) {
		if($type === 'shipping') {
			return 'Lieferadresse';
		} elseif($type === 'billing') {
			return 'Rechnungsadresse';
		}
		return;
	}
	
	public function shipping ($addresses) {
		if(empty($addresses)) {
			print <<< EMPTY
<div>
<h4>Sie haben derzeit keine eingetragenen Lieferadressen.</h4>
</div>
<br>
EMPTY;
		} else {
				$count = 0;
				foreach($addresses as $key => $address ){
					$count++;
					if($address instanceof Application_Model_Lieferadresse) {
						print <<< HTML
<div>
<h4>{$count}.</h4>
<ul class="address">
	<li> {$address->getFirma()}</li>
	<li> {$address->getAnrede()} {$address->getVorname()} {$address->getNachname()} </li>
	<li> {$address->getStrasse()} </li>
	<li> {$address->getPlz()}  {$address->getOrt()} </li>
	<li> {$address->getLand()} </li>
</ul>
<a href="/account/update/shipping/{$key}">Ändern</a> <a href="/account/address/actionid/delete/shipping/{$key}">Löschen</a>
</div>
<br>
HTML;
					}
				}
			}
		}
	
	public function billing ($addresses) {
		if(empty($addresses)) {
			print <<< EMPTY
<div >
<h4>Sie haben derzeit keine eingetragenen Rechnungsadressen.</h4>
</div>
<br>
EMPTY;
		} else {
		
			$count = 0;
			foreach($addresses as $key => $address ){
				$count++;
				if($address instanceof Application_Model_Rechnungsadresse) {
					print <<< HTML
<div>
<h4>{$count}.</h4>
<ul class="address">
	<li> {$address->getFirma()}</li>
	<li> {$address->getAnrede()} {$address->getVorname()} {$address->getNachname()} </li>
	<li> {$address->getStrasse()} </li>
	<li> {$address->getPlz()}  {$address->getOrt()} </li>
	<li> {$address->getLand()} </li>
</ul>
<a href="/account/update/billing/{$key}">Ändern</a> <a href="/account/address/actionid/delete/billing/{$key}">Löschen</a>
</div>
<br>
HTML;
		
				}
			}
		}
	}	
}