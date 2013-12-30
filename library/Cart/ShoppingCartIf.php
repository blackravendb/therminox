<?php 
interface ShoppingCartIf {
    
    /**
     * Artikel dem Warenkorb hinzufuegen
     * 
     * @param $key  Artikel-Identifier
     * @param $amount   int     Optionaler Parameter. Wird eine Menge angegeben, so wird der
     *      Artikel n-fach in den Warenkorb gelegt
     * @return void
     */
    public function addItem($key, $amount = 1);
    
    /**
     * Artikel aus dem Warenkorb entfernen.
     * 
     * Es soll keinen Artikel mit Menge 0 oder kleiner im Warenkorb geben. In solch einem
     * Fall ist der Artikel aus dem Warenkorb zu nehmen.
     * 
     * @param $key  Artikel-Identifier
     * @param $amount   int     Optionaler Parameter. Wird eine Menge angegeben, so wird der
     *      Artikel n-fach aus dem Warenkorb entfernt
     * @return void
     */
    public function removeItem($key, $amount = 1);
    
    /**
     * Warenkorb komplett leeren
     * 
     * @return void
     */
    public function clear();
    
    /**
     * Pruefung, ob der Warenkorb leer ist oder Artikel enthaelt.
     * 
     * @return boolean <code>true</code> wenn leer, sonst <code>false</code>
     */
    public function isEmpty();
    
    /**
     * Pruefung, ob item mit angegebenem Schluessel im Warenkorb liegt
     * 
     * @param $key  Schluessel
     * @return mixed  <code>false</code>, wenn nicht enthalten, sonst die enthaltene Menge als Ganzzahl (integer)
     */
    public function containsItem($key);
    
    /**
     * Liefert Inhalte des Warenkorbs als Array mit Schluessel-Wert Paaren.
     * 
     * @return array    Inhalte des Warenkorbs
     */
    public function getCartContents();
}