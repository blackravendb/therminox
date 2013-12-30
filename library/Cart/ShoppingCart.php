<?php
require_once 'ShoppingCartIf.php';

/**
 * Warenkorb Klasse fuer den WT Shop
 */
class ShoppingCart implements ShoppingCartIf
{
	/**
	 * Artikel des Warenkorbs
	 *
	 * @var array
	 */
	private $articles;


	/**
	 * Konstruktor
	 *
	 * Initialisiert Objekt mit leerem Warenkorbarray.
	 */
	function __construct() {
		$this->articles = array();
	}

	/**
	 * Artikel dem Warenkorb hinzufügen
	 *
	 * @param $key  Artikel-Identifier
	 * @param $amount   int     Optionaler Parameter. Wird eine Menge angegeben, so wird der
	 *      Artikel n-fach in den Warenkorb gelegt
	 * @return void
	 */
	public function addItem($key, $amount = 1) {
		if ($amount < 1 || ! ShoppingCart::isValidKey($key)) {
			return;
		}

		if (! array_key_exists($key, $this->articles)) {
			$this->articles[$key] = 0;
		}

		$this->articles[$key] += $amount;
	}

	/**
	 * Artikel aus dem Warenkorb entfernen.
	 *
	 * Es soll keinen Artikel mit Menge 0 oder kleiner im Warenkorb geben.
	 * In solch einem Fall ist der Artikel aus dem Warenkorb zu nehmen.
	 *
	 * @param $key  Artikel-Identifier
	 * @param $amount   int     Optionaler Parameter. Wird eine Menge angegeben, so wird der
	 *      Artikel n-fach aus dem Warenkorb entfernt
	 * @return void
	 */
	public function removeItem($key, $amount = 1) {
		if ($amount < 1 || ! ShoppingCart::isValidKey($key)) {
			return;
		}

		if (! array_key_exists($key, $this->articles)) {
			return;
		}

		if (0 >= $this->articles[$key] - $amount) {
			unset($this->articles[$key]);
		} else {
			$this->articles[$key] -= $amount;
		}
	}

	/**
	 * Warenkorb komplett leeren
	 *
	 * @return void
	 */
	public function clear() {
		$this->articles = array();
	}

	/**
	 * Pruefung, ob der Warenkorb leer ist oder Artikel enthaelt.
	 *
	 * @return boolean <code>true</code> wenn leer, sonst <code>false</code>
	 */
	public function isEmpty() {
		return empty($this->articles);
	}


	/**
	 * Pruefung, ob item mit angegebenem Schluessel im Warenkorb liegt
	 *
	 * @param $key  Schluessel
	 * @return boolean  <code>true</code>, wenn enthalten, sonst <code>false</code>
	 */
	public function containsItem($key) {
		if (! ShoppingCart::isValidKey($key)) {
			return false;
		}

		if (! array_key_exists($key, $this->articles)) {
			return false;
		};

		return $this->articles[$key];
	}

	/**
	 * Liefert Inhalte des Warenkorbs als Array mit Schluessel-Wert Paaren.
	 *
	 * @return array    Inhalte des Warenkorbs
	 */
	public function getCartContents() {
		return $this->articles;
	}

	private function isValidKey($key) {
		if (is_array($key) || is_object($key)) {
			return false;
		}

		return true;
	}

}
