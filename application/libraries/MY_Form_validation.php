<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	/**
	 * Get Array of Error Messages
	 * Returns the error messages as an array
	 * @return  array
	 */
	function error_array() {
		return $this->_error_array;
	}

}
?>