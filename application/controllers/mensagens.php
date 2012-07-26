<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensagens extends CI_Controller {

	public function inbox()
	{
		$to = '65'; // TODO: get id of logged in user

		// TODO: implement "sort by"
		
		$m = new Message();
		$total = $m->record_count_to($to);
		$data['total'] = $total;
		$data['comeco'] = '';
		$data['final'] = '';
		
		if($total > 0) // at least 1 got message
		{
			$this->load->library('pagination');
			
			$config = array();
			$config["base_url"] = base_url('mensagens/inbox');
			$config["total_rows"] = $total;
			$config["per_page"] = MAX_MESSAGES_PER_PAGE;
			$config["uri_segment"] = 3;

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["results"] = $m->get_to($to, $config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			
			$data['comeco'] = $page + 1;
			$data['final'] = ($data['comeco'] + $config["per_page"] - 1) < $total ? ($data['comeco'] + $config["per_page"] - 1) : $total;
		
			}
		else // No message
		{
			$data['msg'] = '<strong>Nenhuma mensagem encontrada.</strong>';
			$data['msg_type'] = 'note';
			$data["links"] = '';
		}

		$data['title'] = "Mensagens recebidas";
		$this->load->view('view_got_messages', $data);
	}

	public function index()
	{	
		$this->inbox();
	}
	
	public function read()
	{
		// TODO: check if user can read this message
	
		$id = $this->uri->segment(3);
		$data['msg'] = NULL;
		if($id)
		{
			$m = new Message();
			$m->get_by_id($id);
			if($m->result_count() > 0)
			{
				$m->from->get();
				$data['msg'] = $m;
				
				$this->mark_read($id);
			}
			else
			{
				$data['msg'] = '<strong>Nenhuma mensagem encontrada.</strong>';
				$data['msg_type'] = 'error';
			}
		}
		else
		{
			$data['msg'] = '<strong>Nenhuma mensagem encontrada.</strong>';
			$data['msg_type'] = 'error';
		}
		$data['title'] = "Ler mensagem";
		$this->load->view('read_message', $data);
	}
	
	public function sent()
	{
		$from = '65'; // TODO: get id of logged in user

		// TODO: implement "sort by"
		
		$m = new Message();
		$total = $m->record_count_from($from);
		$data['total'] = $total;
		$data['comeco'] = '';
		$data['final'] = '';
		
		if($total > 0) // at least 1 sent message
		{
			$this->load->library('pagination');
			
			$config = array();
			$config["base_url"] = base_url('mensagens/sent');
			$config["total_rows"] = $total;
			$config["per_page"] = MAX_MESSAGES_PER_PAGE;
			$config["uri_segment"] = 3;

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["results"] = $m->get_from($from, $config["per_page"], $page);
			
			
			
			//echo "TOTAL: $total<br>";
			foreach($data['results'] as $i => $u)
			{
				//echo '<br>[' . ($i + 1) . '] ID: ' . $u->id . ' | total: ' . $u->total .' | ref: ' . $u->reference . ' | to: ' . $m->get_csv_tos($u->reference);
				
				$data["csv_tos"][$i] = $m->get_csv_tos($u->reference);
			}
			//return;
			
			
			$data["links"] = $this->pagination->create_links();
			
			$data['comeco'] = $page + 1;
			$data['final'] = ($data['comeco'] + $config["per_page"] - 1) < $total ? ($data['comeco'] + $config["per_page"] - 1) : $total;
		
			}
		else // No message
		{
			$data['msg'] = '<strong>Nenhuma mensagem encontrada.</strong>';
			$data['msg_type'] = 'note';
			$data["links"] = '';
		}	
	
		$data['title'] = "Mensagens enviadas";
		$this->load->view('view_sent_messages', $data);
	}
	
	public function write()
	{
		$u = new User();
		$u->get_active();
		if($u->result_count() > 0)
		{
			// this message is a reply to another...
			if($this->uri->segment(3))
			{
				$m = new Message();
				$m->get_by_id($this->uri->segment(3));
				if($m->result_count() > 0)
				{
					// get the original sender
					$data['reply_to'] = 'Re: ' . $m->subject;
					$m->from->get();
					$from_id = $m->from->id;
				}
				else
				{
					$data['reply_to'] = '';
				}
			}
			else
			{
				$data['reply_to'] = '';
				$from_id = '';
			}
		
			// prepare array of tos
			foreach($u as $user)
			{
				$data['users'][] = array(
					'selected' => ($user->id == $from_id), // this message is a reply to another
					'option' => $user->nome . " (" . $user->wp_username . ")",
					'value' => $user->id
				);
			}
			$data['users'] = arrayToObject($data['users']);
		}
		else	// nenhum usuário encontrado
		{
			$data['users'] = NULL;
			$data['msg'] = "<strong>Nenhum usuário encontrado!</strong><br /><a href='" . base_url('usuarios/add') .  "'>Clique aqui</a> para adicionar um usuário.";
			$data['msg_type'] = 'error';
		}

		$data['title'] = "Escrever nova mensagem";
		$this->load->view('new_message', $data);
	}
	
	public function send()
	{
		$post = $this->input->post(NULL, TRUE);
		if($post['submit']) // form submitted
		{
			$flag_erro = '';

			// Get From
			$from = new User();
			$from->get_by_id($post['hidden_from_id']);
			if($from->result_count() > 0)	// remetente encontrado
			{
				// get unique reference
				$ref = create_guid();
			
				// Get TOs
				$post['hidden_selecionador_tos'] = substr($post['hidden_selecionador_tos'], 0, strlen($post['hidden_selecionador_tos']) - 1);
				$lista_tos = explode(',', $post['hidden_selecionador_tos']);
				$to = new User();
				$to->where_in('id', $lista_tos)->get();
				
				if($to->result_count() > 0) // at least one to
				{
					unset($tos_array);
					
					foreach($to as $dest) // save 1 message for each to
					{
						$tos_array[] = $dest->email;
						unset($message);
					
						$message = new Message();
						$message->body = $post['txtMessage'];
						$message->subject = $post['txtAssunto'];
						$message->reference = $ref; // correlate every identical message
						$message->read_count = 0;
						$message->last_read_count = NULL;
						
						// Save message
						if(! $message->save(array(
							'from' => $from,
							'to' => $dest
						))) // error on save
						{
						
							if ( $message->valid ) // validation ok; database error on insert or update
							{
								$flag_erro = 'db_error';
							} 
							else // validation error
							{
								$flag_erro = 'validation_error'; 
							}
						}
						
						if($flag_erro == 'db_error')
						{
							$msg = urlencode(htmlentities('<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.'));
							$msg_type = urlencode('error');
							redirect("/mensagens/write/?msg=$msg&msg_type=$msg_type");
							return;
						}
						else if($flag_erro == 'validation_error')
						{
							$msg = urlencode(htmlentities('<strong>Erro de validação de dados.</strong><br />' . $message->error->string));
							$msg_type = urlencode('error');
							redirect("/mensagens/write/?msg=$msg&msg_type=$msg_type");
							return;
						}
						
					} // end foreach to
					$tos_array[] = EMAIL_BACKUP;
					
					// prepare message footer
					$msgFooter = '<br /><hr><p>NOTA: Esta é uma mensagem enviada automaticamente pelo sistema. NÃO responda ao e-mail anestesiologia.usp@gmail.com, usado para enviá-la, pois esta conta não é monitorada.</p><p>Copyright (C) <strong>Disciplina de Anestesiologia FMUSP.</strong> Todos os direitos reservados.';
					
					// send batch email
					$this->load->library('email');
					$s = new Setting();
					$set = $s->get_email_settings();
					
					$config['protocol'] = 'smtp';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['smtp_host'] = $set->host;
					$config['smtp_user'] = $set->username;
					$config['smtp_pass'] = $set->password;
					$config['smtp_port'] = $set->port;
					$config['bcc_batch_mode'] = TRUE;
					$config['bcc_batch_size'] = 50;
					$config['newline'] = '\r\n';
					$config['crlf'] = '\r\n';
					$config['smtp_crypto'] = 'tls';
					
					$this->email->initialize($config);
					
					$this->email->from($set->username, $from->nome);
					$this->email->reply_to($from->email, $from->nome);
					$this->email->to($set->username, $from->nome); 
					$this->email->cc($from->email); 
					$this->email->bcc($tos_array); 

					$this->email->subject('[Anestesia USP] ' . $post['txtAssunto']);
					$this->email->message($post['txtMessage'] . $msgFooter);	

					//$result = $this->email->send(); // TODO: uncomment and delete next line
					$result = true;
					
					if($flag_erro == '' && $result) // success
					{
						$msg = urlencode(htmlentities("<strong>Mensagem enviada com sucesso!</strong>"));
						$msg_type = urlencode('success');
						redirect("/mensagens/?msg=$msg&msg_type=$msg_type");
						return;
					}
					
				}
				else // nenhum destinatário
				{
					$data['msg'] = urlencode(htmlentities('<strong>Selecione pelo menos um destinatário.</strong>'));
					$data['msg_type'] = 'error';
					redirect('mensagens/write/?msg=' . $data['msg'] . '&msg_type=' . $data['msg_type']);
					return;
				}
			}
			else	// remetente não encontrado
			{
				$data['msg'] = urlencode(htmlentities('<strong>Remetente n&atilde;o encontrado.</strong>'));
				$data['msg_type'] = 'error';
				redirect('mensagens/write/?msg=' . $data['msg'] . '&msg_type=' . $data['msg_type']);
				return;
			}

		}
		else // form wasn't submitted
		{
		
		}
	}
	
	public function mark_read($id=NULL) //called via ajax (view_got_messages.php)
	{
		$id = isset($id) ? $id : $this->uri->segment(3);
		if($id)
		{
			$m = new Message();
			$m->get_by_id($id);
			if($m->result_count() > 0)
			{
				$m->read_count++;
				$m->last_read_datetime = nowDatetime();
				return $m->save();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		$continue = $this->input->get('continue');
		if($id)
		{
			$m = new Message();
			$m->get_by_id($id);
			if($m->result_count() > 0)
			{
				$m->obs = 'deleted';
				if($m->save())
				{
					$msg = urlencode(htmlentities("<strong>Mensagem excluída com sucesso!</strong>"));
					$msg_type = urlencode('success');
				}
				else
				{
					$msg = urlencode(htmlentities("<strong>Erro ao excluir mensagem.</strong>"));
					$msg_type = urlencode('error');
				}
				redirect($continue . "/?msg=$msg&msg_type=$msg_type");
				return;
			}
			else
			{
				exit('Erro.');
			}
		}
		else
		{
			exit('Erro.');
		}
	}
	
}

