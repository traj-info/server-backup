<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos extends CI_Controller {

	public function index()
	{
		$gr = new Group();
		$gr->get();
		$data['total'] = $gr->result_count();
		if($data['total'] > 0) // há grupo(s) cadastrado(s)
		{
			foreach($gr as $grupo)
			{
				$grupo->supervisor->get();
				$grupo->coordenador->get();
				$grupo->user->order_by('nome', 'asc')->get();
				$grupo->avaliacao->get();
			}

			$data['grupos'] = $gr;
		}
		else	// nenhum grupo cadastrado
		{
			$data['grupos'] = "";
			$data['msg'] = '<strong>Nenhum grupo encontrado.</strong><br />Não foi encontrado nenhum grupo cadastrado no sistema. <a href="' . base_url('grupos/add') . '">Clique aqui</a> para adicionar o primeiro.';
			$data['msg_type'] = 'note';
		}
	
	
		if(($this->input->get('msg') && $this->input->get('msg_type')))
		{
			$data['msg'] = urldecode(html_entity_decode($this->input->get('msg', TRUE)));
			$data['msg_type'] = urldecode(html_entity_decode($this->input->get('msg_type', TRUE)));
		}
		
		$data['title'] = 'Ver grupos';
		$this->load->view('view_groups', $data);
	}
	
	public function add()
	{
		if($this->input->post('submit'))	// form submitted
		{
			$flag_erro = '';
			$post = $this->input->post(NULL, TRUE);

			$g = new Group();
			$g->name = $post['txtName'];
			$g->obs = $post['txtObs'];
			
			// Get Supervisor
			$sup = new User();
			$sup->where('id', $post['supervisor'])->get();
			
			// Get Coordenador
			$coo = new User();
			$coo->where('id', $post['coordenador'])->get();
			
			// Get Assistentes
			$post['hidden_selecionador_assistentes'] = substr($post['hidden_selecionador_assistentes'], 0, strlen($post['hidden_selecionador_assistentes']) - 1);
			$lista_assistentes = explode(',', $post['hidden_selecionador_assistentes']);
			$assist = new User();
			$assist->where_in('id', $lista_assistentes)->get();
			
			// Get Avaliacoes
			$post['hidden_selecionador_avaliacoes'] = substr($post['hidden_selecionador_avaliacoes'], 0, strlen($post['hidden_selecionador_avaliacoes']) - 1);
			$lista_avaliacoes = explode(',', $post['hidden_selecionador_avaliacoes']);
			$aval = new Avaliacao();
			$aval->where_in('id', $lista_avaliacoes)->get();
			
			// Save all
			if(! $g->save(array(
				'supervisor' => $sup,
				'coordenador' => $coo,
				'user' => $assist->all,
				'avaliacao' => $aval->all
			))) // error on save
			{
				if ( $g->valid ) // validation ok; database error on insert or update
				{
					$flag_erro = 'db_error';
				} 
				else // validation error
				{
					$flag_erro = 'validation_error'; 
				}
			}
			
			if($flag_erro == '') // success
			{
				$msg = urlencode(htmlentities("<strong>Grupo cadastrado com sucesso!</strong>"));
				$msg_type = urlencode('success');
				redirect("/grupos/?msg=$msg&msg_type=$msg_type");
				return;
			}
			else if($flag_erro == 'db_error')
			{
				$data['msg'] = '<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
				$data['msg_type'] = 'error';
			}
			else if($flag_erro == 'validation_error')
			{
				$data['msg'] = '<strong>Erro de validação de dados.</strong><br />' . $g->error->string;
				$data['msg_type'] = 'error';
			}
		}

		// get users to display in form fields
		$roles = array(ROLE_ASSISTENTE, ROLE_COORDENADOR_GRUPO, ROLE_SUPERVISOR_GRUPO, ROLE_ADMIN_ANESTESIA);
	
		$u = new User();
		$u->where('status_id', STATUS_ACTIVE)->where_in('role_id', $roles)->order_by('wp_username', 'asc')->get();
		if($u->result_count() > 0)
		{
			foreach($u as $user)
			{
				$data['users'][] = array(
					'id' => $user->id,
					'wp_user_id' => $user->wp_user_id,
					'username' => $user->wp_username,
					'nome' => $user->nome,
					'selected' => FALSE,
					'option' => $user->nome . " (" . $user->wp_username . ")",
					'value' => $user->id
				);
			}
			$data['users'] = arrayToObject($data['users']);
			
			// Get avaliações
			$a = new Avaliacao();
			$a->get();
			if($a->result_count() > 0)
			{
				foreach($a as $aval)
				{
					$data['aval'][] = array(
						'selected' => FALSE,
						'value' => $aval->id,
						'option' => $aval->name
					);
				}
				
				$data['aval'] = arrayToObject($data['aval']);
			}
			else
			{
				$data['aval'] = NULL;
			}
			
		}
		else	// nenhum usuário encontrado
		{
			$data['users'] = NULL;
			$data['msg'] = "<strong>Nenhum usuário encontrado!</strong><br />Antes de cadastrar um grupo, precisam estar cadastrados no sistema pelo menos os usuários que terão credenciais de Coordenador e Supervisor de grupo, e seus status precisam estar como ATIVO.<br /><a href='" . base_url('usuarios/add') .  "'>Clique aqui</a> para adicionar um usuário.";
			$data['msg_type'] = 'error';
		}
	
		$data['title'] = 'Adicionar grupo';
		$this->load->view('add_group', $data);	
	}
	
	public function delete()
	{
		// TODO: checar se é usuário administrativo logado
		$id = $this->uri->segment(3);
		if($id)
		{
			$u = new Group();
			$u->where('id', $id)->limit(1)->get();
			if( $u->delete() )
			{
				$msg = urlencode(htmlentities("<strong>Grupo excluído com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a exclusão do grupo (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/grupos/?msg=$msg&msg_type=$msg_type");
			return;			
		}
		else
		{
			redirect('grupoos');
		}
	}
	
	public function edit()
	{
		$post = $this->input->post(NULL, TRUE);
		$data['g_nome'] = '';
		$data['users'] = '';
		if($post['submit'])	// form submitted
		{
			$flag_erro = '';

			$g = new Group();
			$g->get_by_id($post['hidden_group_id']);
			if($g->result_count() > 0)	//grupo encontrado
			{
				$g->name = $post['txtName'];
				$g->obs = $post['txtObs'];
				
				// Get Supervisor
				$sup = new User();
				$sup->where('id', $post['supervisor'])->get();
				
				// Get Coordenador
				$coo = new User();
				$coo->where('id', $post['coordenador'])->get();
				
				// Get Assistentes
				$post['hidden_selecionador_assistentes'] = substr($post['hidden_selecionador_assistentes'], 0, strlen($post['hidden_selecionador_assistentes']) - 1);
				$lista_assistentes = explode(',', $post['hidden_selecionador_assistentes']);
				$assist = new User();
				$assist->where_in('id', $lista_assistentes)->get();
				
				// Delete current assistants
				$g->delete($g->user->get()->all);
				
				// Get Avaliações
				$post['hidden_selecionador_avaliacoes'] = substr($post['hidden_selecionador_avaliacoes'], 0, strlen($post['hidden_selecionador_avaliacoes']) - 1);
				$lista_avaliacoes = explode(',', $post['hidden_selecionador_avaliacoes']);
				$aval = new Avaliacao();
				$aval->where_in('id', $lista_avaliacoes)->get();
				
				// Delete current avaliacoes
				$g->delete($g->avaliacao->get()->all);
				
				// Save all
				if(! $g->save(array(
					'supervisor' => $sup,
					'coordenador' => $coo,
					'user' => $assist->all,
					'avaliacao' => $aval->all
				))) // error on save
				{
					if ( $g->valid ) // validation ok; database error on insert or update
					{
						$flag_erro = 'db_error';
					} 
					else // validation error
					{
						$flag_erro = 'validation_error'; 
					}
				}
				
				if($flag_erro == '') // success
				{
					$msg = urlencode(htmlentities("<strong>Grupo editado com sucesso!</strong>"));
					$msg_type = urlencode('success');
					redirect("/grupos/?msg=$msg&msg_type=$msg_type");
					return;
				}
				else if($flag_erro == 'db_error')
				{
					$data['msg'] = '<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
					$data['msg_type'] = 'error';
				}
				else if($flag_erro == 'validation_error')
				{
					$data['msg'] = '<strong>Erro de validação de dados.</strong><br />' . $g->error->string;
					$data['msg_type'] = 'error';
				}
				
			}
			else	// grupo não encontrado
			{
				$data['msg'] = '<strong>Grupo não encontrado.</strong>';
				$data['msg_type'] = 'error';
			}

		}

		// get current group about to be editted
		$id = ($post['hidden_group_id']) ? $post['hidden_group_id'] : $this->uri->segment(3);
		$data['id'] = $id;
		
		$g = new Group();
		$g->get_by_id($id);
		if($g->result_count() > 0) // grupo encontrado
		{
			// get group name
			$data['g_nome'] = $g->name;
			$data['g_obs'] = $g->obs;
			
			// get group supervisor
			$g->supervisor->get();
			$data['g_supervisor'] = $g->supervisor->id;
			
			// get group coordinator
			$g->coordenador->get();
			$data['g_coordenador'] = $g->coordenador->id;
		
			// get group assistants
			$g->user->get();
			$data['g_assist'] = array();
			if($g->user->result_count() > 0)
			{
				foreach($g->user as $assist)
				{
					$data['g_assist'][] = $assist->id;
				}
			}
			
			// get group avaliacoes
			$g->avaliacao->get();
			$data['g_aval'] = array();
			if($g->avaliacao->result_count() > 0)
			{
				foreach($g->avaliacao as $aval)
				{
					$data['g_aval'][] = $aval->id;
				}
			}
		
			// get users to display in form fields
			$roles = array(ROLE_ASSISTENTE, ROLE_COORDENADOR_GRUPO, ROLE_SUPERVISOR_GRUPO, ROLE_ADMIN_ANESTESIA);
		
			$u = new User();
			$u->where('status_id', STATUS_ACTIVE)->where_in('role_id', $roles)->order_by('wp_username', 'asc')->get();
			if($u->result_count() > 0)
			{
				foreach($u as $user)
				{
					$data['users'][] = array(
						'id' => $user->id,
						'wp_user_id' => $user->wp_user_id,
						'username' => $user->wp_username,
						'nome' => $user->nome,
						'selected_supervisor' => ($user->id == $data['g_supervisor']),
						'selected_coordenador' => ($user->id == $data['g_coordenador']),
						'selected_assistentes' => in_array($user->id, $data['g_assist']),
						'option' => $user->nome . " (" . $user->wp_username . ")",
						'value' => $user->id
					);
				}
				$data['users'] = arrayToObject($data['users']);
				
				// Get avaliações
				$a = new Avaliacao();
				$a->get();
				if($a->result_count() > 0)
				{
					foreach($a as $aval)
					{
						$data['aval'][] = array(
							'selected' => in_array($aval->id, $data['g_aval']),
							'value' => $aval->id,
							'option' => $aval->name
						);
					}
					
					$data['aval'] = arrayToObject($data['aval']);
				}
				else
				{
					$data['aval'] = NULL;
				}
			}
			else	// nenhum usuário encontrado
			{
				$data['users'] = NULL;
				$data['msg'] = "<strong>Nenhum usuário encontrado!</strong><br />Antes de cadastrar um grupo, precisam estar cadastrados no sistema pelo menos os usuários que terão credenciais de Coordenador e Supervisor de grupo, e seus status precisam estar como ATIVO.<br /><a href='" . base_url('usuarios/add') .  "'>Clique aqui</a> para adicionar um usuário.";
				$data['msg_type'] = 'error';
			}
		}
		else	// grupo não encontrado
		{
			$data['msg'] = '<strong>Grupo não encontrado.</strong>';
			$data['msg_type'] = 'error';
		}
	
		$data['title'] = 'Editar grupo';
		$this->load->view('edit_group', $data);	
		
	}

}

