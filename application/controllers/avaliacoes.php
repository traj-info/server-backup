<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaliacoes extends CI_Controller {

	public function index()
	{
		$a = new Avaliacao();
		$a->get();
		$data['total'] = $a->result_count();
		if($data['total'] > 0) // há avaliacão(ôes) cadastrada(s)
		{
			$data['aval'] = $a;
		}
		else	// nenhuma avaliação cadastrada
		{
			$data['aval'] = "";
			$data['msg'] = '<strong>Nenhum modelo de avaliação encontrado.</strong><br />Não foi encontrado nenhum modelo de avaliação cadastrado no sistema. <a href="' . base_url('avaliacao/add') . '">Clique aqui</a> para adicionar o primeiro.';
			$data['msg_type'] = 'note';
		}
	
	
		if(($this->input->get('msg') && $this->input->get('msg_type')))
		{
			$data['msg'] = urldecode(html_entity_decode($this->input->get('msg', TRUE)));
			$data['msg_type'] = urldecode(html_entity_decode($this->input->get('msg_type', TRUE)));
		}
		
		$data['title'] = 'Lista de modelos de avaliação';
		$this->load->view('view_avaliacoes', $data	);

	}
	

	public function delete()
	{
		// TODO: checar se é usuário administrativo logado
		$id = $this->uri->segment(3);
		if($id)
		{
			$a = new Avaliacao();
			$a->where('id', $id)->limit(1)->get();
			if( $a->delete() )
			{
				$msg = urlencode(htmlentities("<strong>Modelo de avaliação excluído com sucesso! (ID: $id)</strong>"));
				$msg_type = urlencode('success');
			}
			else
			{
				$msg = urlencode(htmlentities("<strong>Ocorreu um erro durante a exclusão do modelo de avaliação (ID: $id)</strong><br />Por favor, tente novamente. Se o problema persistir, contate o administrador do sistema."));
				$msg_type = urlencode('error');
			}
			redirect("/avaliacoes/?msg=$msg&msg_type=$msg_type");
			return;			
		}
		else
		{
			redirect('avaliacoes');
		}
	}
	
	public function edit()
	{
		$post = $this->input->post(NULL, TRUE);
		if($post['submit'])	// form submitted
		{
			$flag_erro = '';

			$a = new Avaliacao();
			$a->get_by_id($post['hidden_avaliacao_id']);
			if($a->result_count() > 0)	// avaliação encontrada
			{
				$a->name = $post['txtName'];
				$a->filename = $post['txtFilename'];
				$a->description = $post['txtDesc'];
				$a->obs = $post['txtObs'];
				$a->target = $post['selTarget'];
				
				// Save
				if(! $a->save() ) // error on save
				{
					if ( $a->valid ) // validation ok; database error on insert or update
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
					$msg = urlencode(htmlentities("<strong>Modelo de avaliação editado com sucesso!</strong>"));
					$msg_type = urlencode('success');
					redirect("/avaliacoes/?msg=$msg&msg_type=$msg_type");
					return;
				}
				else if($flag_erro == 'db_error')
				{
					$data['msg'] = '<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
					$data['msg_type'] = 'error';
				}
				else if($flag_erro == 'validation_error')
				{
					$data['msg'] = '<strong>Erro de validação de dados.</strong><br />' . $a->error->string;
					$data['msg_type'] = 'error';
				}
				
			}
			else	// grupo não encontrado
			{
				$data['msg'] = '<strong>Modelo de avaliação não encontrado.</strong>';
				$data['msg_type'] = 'error';
			}

		}

		// get current aval about to be editted
		$id = ($post['hidden_avaliacao_id']) ? $post['hidden_avaliacao_id'] : $this->uri->segment(3);
		$data['id'] = $id;
		
		$a = new Avaliacao();
		$a->get_by_id($id);
		if($a->result_count() > 0) // avaliação encontrada
		{
			// get data
			$data['a_nome'] = $a->name;
			$data['a_filename'] = $a->filename;
			$data['a_descricao'] = $a->description;
			$data['a_obs'] = $a->obs;
			$data['a_target'] = $a->target;
		}
		else	// avaliação não encontrada
		{
			$data['msg'] = '<strong>Modelo de avaliação não encontrado.</strong>';
			$data['msg_type'] = 'error';
		}
	
		$data['title'] = 'Editar modelo de avaliação';
		$this->load->view('edit_avaliacao', $data);	
	}
	
	public function add()
	{
		if($this->input->post('submit'))	// form submitted
		{
			$flag_erro = '';
			$post = $this->input->post(NULL, TRUE);

			$a = new Avaliacao();
			$a->name = $post['txtName'];
			$a->filename = $post['txtFilename'];
			$a->description = $post['txtDesc'];
			$a->obs = $post['txtObs'];
			$a->target = $post['selTarget'];
			
			// Save
			if(! $a->save() ) // error on save
			{
				if ( $a->valid ) // validation ok; database error on insert or update
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
				$msg = urlencode(htmlentities("<strong>Modelo de avaliação cadastrado com sucesso!</strong>"));
				$msg_type = urlencode('success');
				redirect("/avaliacoes/?msg=$msg&msg_type=$msg_type");
				return;
			}
			else if($flag_erro == 'db_error')
			{
				$data['msg'] = '<strong>Erro na gravação no banco de dados.</strong><br />Tente novamente e, se o problema persistir, notifique o administrador do sistema.';
				$data['msg_type'] = 'error';
			}
			else if($flag_erro == 'validation_error')
			{
				$data['msg'] = '<strong>Erro de validação de dados.</strong><br />' . $a->error->string;
				$data['msg_type'] = 'error';
			}
		}

		$data['title'] = 'Adicionar modelo de avaliação';
		$this->load->view('add_avaliacao', $data);
	}
}

