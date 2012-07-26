<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller 
{

	
    public function __construct()
    {
	 	parent::__construct();
	}

	public function index() // ver opções e lista de usuários já cadastrados
	{
		$u = new User();
		$u->get();

		if($u->result_count() > 0)
		{
			$wp_db_config = array(
			'hostname' => WP_DBHOST,
			'username' => WP_DBUSER,
			'password' => WP_DBPASSWORD,
			'database' => WP_DBNAME,
			'dbdriver' => 'mysql',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci'
			);
			
			$wp_db = $this->load->database($wp_db_config, TRUE);
			
			$lista_de_ids = "";
			$users = "";
			foreach($u as $row)
			{
				$lista_de_ids[] = $row->wp_user_id;
				$users[$row->wp_user_id]['id'] = $row->id;
				$users[$row->wp_user_id]['display_name'] = '';
				$users[$row->wp_user_id]['username'] = '';
				$users[$row->wp_user_id]['firstname'] = '';
				$users[$row->wp_user_id]['lastname'] = '';
				$users[$row->wp_user_id]['nome'] = '';
				$users[$row->wp_user_id]['crm'] = '';
				$users[$row->wp_user_id]['matricula_hc'] = '';
				$users[$row->wp_user_id]['cargo'] = '';
				$users[$row->wp_user_id]['instituto'] = '';
				$users[$row->wp_user_id]['funcao'] = '';
				$users[$row->wp_user_id]['status'] = $row->status_id;
				$users[$row->wp_user_id]['role'] = $row->role_id;
			}
			$lista_de_ids = implode(',', $lista_de_ids);
			
			$query = $wp_db->query("SELECT wp_users.*, wp_usermeta.*  
									FROM " . WP_DBNAME . ".wp_users 
									LEFT JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id 
									WHERE wp_users.ID IN ($lista_de_ids) AND 
									wp_usermeta.meta_key IN ('first_name','last_name','crm','cargo','instituto_onde_atua','matricula_hc')
									ORDER BY wp_users.ID ASC
									");
									
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					switch($row->meta_key)
					{
						case 'first_name':
							$firstname = $row->meta_value;
							$lastname = "";
							$cargo = "";
							$crm = "";
							$instituto = "";
							$matricula_hc = "";
							break;
						case 'last_name':
							$firstname = "";
							$lastname = $row->meta_value;
							$cargo = "";
							$crm = "";
							$instituto = "";
							$matricula_hc = "";
							break;
						case 'cargo':
							$firstname = "";
							$lastname = "";
							$cargo = $row->meta_value;
							$crm = "";
							$instituto = "";
							$matricula_hc = "";
							break;	
						case 'crm':
							$firstname = "";
							$lastname = "";
							$cargo = "";
							$crm = $row->meta_value;
							$instituto = "";
							$matricula_hc = "";
							break;		
						case 'instituto_onde_atua':
							$firstname = "";
							$lastname = "";
							$cargo = "";
							$crm = "";
							$instituto = $row->meta_value;
							$matricula_hc = "";
							break;	
						case 'matricula_hc':
							$firstname = "";
							$lastname = "";
							$cargo = "";
							$crm = "";
							$instituto = "";
							$matricula_hc = $row->meta_value;
							break;	
					}
					
					$users[$row->ID]['display_name'] = $row->display_name;
					$users[$row->ID]['firstname'] = ($firstname == "") ? $users[$row->ID]['firstname'] : $firstname;
					$users[$row->ID]['lastname'] = ($lastname == "") ? $users[$row->ID]['lastname'] : $lastname;
					$users[$row->ID]['username'] = $row->user_nicename;
					$users[$row->ID]['cargo'] = ($cargo == "") ? $users[$row->ID]['cargo'] : $cargo;
					$users[$row->ID]['crm'] = ($crm == "") ? $users[$row->ID]['crm'] : $crm;
					$users[$row->ID]['instituto'] = ($instituto == "") ? $users[$row->ID]['instituto'] : $instituto;
					$users[$row->ID]['matricula_hc'] = ($matricula_hc == "") ? $users[$row->ID]['matricula_hc'] : $matricula_hc;
					$users[$row->ID]['nome'] = ($users[$row->ID]['firstname'] != "" && $users[$row->ID]['lastname'] != "") ? $users[$row->ID]['firstname'] . " " . $users[$row->ID]['lastname'] : $users[$row->ID]['display_name'];
				}
			}
			
			$users = arrayToObject($users);
		}
		
		if(($this->input->get('msg') && $this->input->get('msg_type')))
		{
			$data['msg'] = urldecode(html_entity_decode($this->input->get('msg', TRUE)));
			$data['msg_type'] = urldecode(html_entity_decode($this->input->get('msg_type', TRUE)));
		}

		$data['title'] = "Usuários";
		$data['users'] = isset($users) ? $users : NULL;
		$data['total'] = $u->result_count();
		$this->load->view('view_users', $data);
	}
	
	public function add()
	{
		if($this->input->post('submit')) // form submitted
		{
			$post = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 

			if(!isset($post['addusercheck'])) // nenhum usuário selecionado
			{
				$data['msg'] = '<strong>Nenhum usuário foi selecionado!</strong><br />Selecione pelo menos um usuário da lista abaixo, clicando na caixa de seleção à esquerda de seu username.';
				$data['msg_type'] = 'error';
			}
			else // algum usuário foi selecionado
			{
				$flag_erro = '';
				foreach($post['addusercheck'] as $indice => $new_user)
				{
					$u = new User();
					
					$u->select('COUNT(id) AS total');
					$u->where('wp_user_id', $new_user);
					$u->limit(1);
					$u->get();
				
					if($u->total > 0) continue; // não adiciona usuários que já existem no cadastro do sistema
					
					$u->wp_user_id = $new_user;
					$u->role_id = $post['selRole'];
					$u->status_id = STATUS_ACTIVE;
					$u->wp_username = $post['hidUsername'][$new_user];
					$u->wp_firstname = $post['hidFirstName'][$new_user];
					$u->wp_lastname = $post['hidLastName'][$new_user];
					$u->email = $post['hidEmail'][$new_user];
					$u->nome = $post['hidNome'][$new_user];
					
					//$u->modified_author_id = //TODO: completar este campo
					
					if(! $u->save() ) // error on save
					{
						if ( $u->valid ) // validation ok; database error on insert or update
						{
							$flag_erro = 'db_error';
						} 
						else // validation error
						{
							$flag_erro = 'validation_error'; 
						}
					}
					
				}
			
				if($flag_erro == '') // success
				{
					$msg = urlencode(htmlentities("<strong>Usuário(s) adicionado(s) com sucesso!</strong>"));
					$msg_type = urlencode('success');
					redirect("/usuarios/?msg=$msg&msg_type=$msg_type");
					return;
				}
				else if($flag_erro == 'db_error')
				{
					$data['msg'] = '<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
					$data['msg_type'] = 'error';
				}
				else if($flag_erro == 'validation_error')
				{
					$data['msg'] = '<strong>Erro de validação de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
					$data['msg_type'] = 'error';
				}
				
				
				
			}
		} // end form submitted

		$wp_db_config = array(
			'hostname' => WP_DBHOST,
			'username' => WP_DBUSER,
			'password' => WP_DBPASSWORD,
			'database' => WP_DBNAME,
			'dbdriver' => 'mysql',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci'
		);
		
		$wp_db = $this->load->database($wp_db_config, TRUE);
	
		$query = $wp_db->query("SELECT wp_users.*, wp_usermeta.*  
								FROM " . WP_DBNAME . ".wp_users 
								LEFT JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id 
								WHERE wp_users.user_status = 0 AND wp_users.user_login NOT LIKE 'unverified_%' AND
								wp_usermeta.meta_key IN ('first_name','last_name','crm','cargo','instituto_onde_atua','matricula_hc')
								ORDER BY wp_users.user_nicename ASC
								");
								
		if($query->num_rows() > 0)
		{
			$atuais = "";
			
			foreach($query->result() as $row)
			{
				$u = new User();
				$u->where('wp_user_id', $row->ID);
				$u->limit(1);
				
				if($u->count() > 0) continue; // se usuário do WP já foi adicionado ao sistema, não o exibe na lista de usuários

				switch($row->meta_key)
				{
					case 'first_name':
						$firstname = $row->meta_value;
						$lastname = "";
						$cargo = "";
						$crm = "";
						$instituto = "";
						$matricula_hc = "";
						break;
					case 'last_name':
						$firstname = "";
						$lastname = $row->meta_value;
						$cargo = "";
						$crm = "";
						$instituto = "";
						$matricula_hc = "";
						break;
					case 'cargo':
						$firstname = "";
						$lastname = "";
						$cargo = $row->meta_value;
						$crm = "";
						$instituto = "";
						$matricula_hc = "";
						break;	
					case 'crm':
						$firstname = "";
						$lastname = "";
						$cargo = "";
						$crm = $row->meta_value;
						$instituto = "";
						$matricula_hc = "";
						break;		
					case 'instituto_onde_atua':
						$firstname = "";
						$lastname = "";
						$cargo = "";
						$crm = "";
						$instituto = $row->meta_value;
						$matricula_hc = "";
						break;	
					case 'matricula_hc':
						$firstname = "";
						$lastname = "";
						$cargo = "";
						$crm = "";
						$instituto = "";
						$matricula_hc = $row->meta_value;
						break;	
				}
				
				
				$atuais[$row->ID] = array(
					'id' => $row->ID,
					'display_name' => $row->display_name,
					'firstname' => $firstname == "" && isset($atuais[$row->ID]['firstname']) ? $atuais[$row->ID]['firstname'] : $firstname,
					'lastname' => $lastname == "" && isset($atuais[$row->ID]['lastname']) ? $atuais[$row->ID]['lastname'] : $lastname,
					'username' => $row->user_nicename,
					'email' => $row->user_email,
					'registered' => $row->user_registered,
					'cargo' => $cargo == "" && isset($atuais[$row->ID]['cargo']) ? $atuais[$row->ID]['cargo'] : $cargo,
					'crm' => $crm == "" && isset($atuais[$row->ID]['crm']) ? $atuais[$row->ID]['crm'] : $crm,
					'instituto' => $instituto == "" && isset($atuais[$row->ID]['instituto']) ? $atuais[$row->ID]['instituto'] : $instituto,
					'matricula_hc' => $matricula_hc == "" && isset($atuais[$row->ID]['matricula_hc']) ? $atuais[$row->ID]['matricula_hc'] : $matricula_hc,
				);
			}
		}
		
		$data['title'] = 'Adicionar usuário';
		$data['atuais'] = $atuais;
		
		
		$this->load->view('add_user', $data);
	}
	
	public function delete()
	{
		// TODO: checar se é usuário administrativo logado
		$id = $this->uri->segment(3);
		if($id)
		{
			$u = new User();
			$u->where('id', $id)->limit(1)->get();
			
			
			
			if( $u->delete() ) // delete user
			{
				$msg = urlencode(htmlentities("<strong>Usuário excluído com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a exclusão do usuário (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/usuarios/?msg=$msg&msg_type=$msg_type");
			return;			
		}
		else
		{
			redirect('usuarios');
		}
	}
	
	public function credencial()
	{
		// TODO: checar se é usuário administrativo logado
		
		if($this->input->post('submit')) // form submitted
		{
			$id = $this->input->post('hidUserId');
			$credential = $this->input->post('selRole');
			
			$u = new User();
			$u->where('id', $id)->get();
			$u->role_id = $credential;

			if( $u->save() )
			{
				$msg = urlencode(htmlentities("<strong>Credencial alterada com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a alteração de credencial do usuário (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/usuarios/?msg=$msg&msg_type=$msg_type");
			return;	
		}
		else // form wasn't submitted
		{
			$id = $this->uri->segment(3);
			
			$u = new User();
			$u->where('id', $id)->get();

			if( $u->result_count() > 0) // registro encontrado
			{
				$data['title'] = 'Alterar credencial de acesso';
				$data['user_id'] = $id;
				$data['nome'] = $u->nome;
		
				$this->load->view('change_credential', $data);
			}
			else // id fornecido não encontrado no banco de dados do sistema
			{
				redirect("usuarios");
				return;
			}
		}
		
	}
	
	public function ativar()
	{
		// TODO: checar se é usuário administrativo logado
		$id = $this->uri->segment(3);
		if($id)
		{
			$u = new User();
			$u->where('id', $id)->get();
			$u->status_id = STATUS_ACTIVE;

			if( $u->save() )
			{
				$msg = urlencode(htmlentities("<strong>Usuário ativado com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a ativação do usuário (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/usuarios/?msg=$msg&msg_type=$msg_type");
			return;			
		}
		else
		{
			redirect('usuarios');
		}
	}
	
	public function inativar()
	{
		// TODO: checar se é usuário administrativo logado
		$id = $this->uri->segment(3);
		if($id)
		{
			$u = new User();
			$u->where('id', $id)->get();
			$u->status_id = STATUS_INACTIVE;

			if( $u->save() )
			{
				$msg = urlencode(htmlentities("<strong>Usuário inativado com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a inativação do usuário (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/usuarios/?msg=$msg&msg_type=$msg_type");
			return;			
		}
		else
		{
			redirect('usuarios');
		}
	}
}

