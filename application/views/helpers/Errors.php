<?php
class Zend_View_Helper_Errors extends Zend_View_Helper_Abstract {
	public function Errors($errors) {
		if(isset($errors)) {
			if (! is_array ( $errors )) {
				echo '<ul class="errors">';
				echo '<li>' . $errors . '</li>';
				echo '</ul>';
			} else {
				echo '<ul class="errors">';
				foreach ( $errors as $error ) {
					echo '<li>' . $error . '</li>';
				}
				echo '</ul>';
			}
		}
	}
}
?>
