<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['alerts'][] = array('type' => 'error',
								  'text' => 'some_error');
		$data['alerts'][] = array('type' => 'warning',
								  'text' => 'Hey, this is a hardcoded warning!');

		/**
		 * Session flashdata usage:
		 *
		 * $this->session->set_flashdata('msg1', array('type' => 'success',
		 *											   'text' => 'some_success_message'));
		 *
		 * $this->session->set_flashdata('msg2', array('type' => 'warning',
		 *											   'text' => 'Hey, this is a hardcoded warning!'));
		 *
		 */
		$this->twig->display('welcome_message.html.twig', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */