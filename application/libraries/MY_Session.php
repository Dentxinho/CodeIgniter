<?php

class MY_Session extends CI_Session {

	/**
	 * Fetch all flashdata
	 *
	 * @return	array
	 */
	public function all_flashdata()
	{
		$out = array();

		// loop through all userdata
		foreach ($this->all_userdata() as $key => $val)
		{
			// if it contains flashdata, add it
			if (strpos($key, 'flash:old:') !== FALSE)
			{
				$key = str_replace('flash:old:', '', $key);
				$out[$key] = $val;
			}
		}
		return $out;
	}
}
?>