<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$current_id = '65'; // TODO: get id of current logged in user
		
		// get new messages sent to current user
		$m = new Message();
		$m->get_to($current_id, NULL, NULL, MSG_UNREAD);
		if($m->result_count() > 0)
		{
			$data['unread'] = $m;
			$data['unread_total'] = $m->result_count();
		}
		else
		{
			$data['unread'] = NULL;
			$data['unread_total'] = 0;
		}
		
		// 
		
		$data['title'] = 'Página inicial';
		$this->load->view('header', $data);
		$this->load->view('menu', $data);
		$this->load->view('footer', $data);

	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */