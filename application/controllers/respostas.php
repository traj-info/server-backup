<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Respostas extends CI_Controller {

	public function pending()
	{
		// TODO: get current logged in user
		$id = '69';
	
		$a = new Resposta();
		$a->where('author_id', $id)->get();
		$data['total'] = $a->result_count();
		
		if($data['total'] > 0)
		{
			$cont_preencher = 0;
			$cont_finalizado = 0;
			foreach($a as $r)
			{
				$r->avaliacao->get();
				$r->ref_user->get();
				$r->controle->get();
				
				$data['resp'][] = array(
					'id' => $r->id,
					'titulo' => $r->avaliacao->name,
					'referente' => $r->ref_user->nome,
					'referente_id' => $r->ref_user->id,
					'status' => traduz_status_resposta($r->status_id),
					'status_id' => $r->status_id,
					'mes' => traduz_mes($r->controle->ref_mes) . '/' . obter_ano($r->controle->ref_mes)
				);
				
				if($r->status_id == RESP_FINALIZADO) $cont_finalizado++;
				else $cont_preencher++;
			}
			$data['resp'] = arrayToObject($data['resp']);
		}
		else
		{
			$data['resp'] = NULL;
		}
	
		$data['cont_preencher'] = $cont_preencher;
		$data['cont_finalizado'] = $cont_finalizado;
		$data['title'] = 'Avaliações para preencher';
		$this->load->view('view_respostas', $data);
	}
	
	public function about_me()
	{
	
	}

	public function index()
	{
		$this->pending();
	}

	public function answer($id = NULL, $erros = NULL, $dados = NULL)
	{
		// TODO: checar se usuário logado pode preencher esta avaliação
	
		$id = ($id) ? $id : $this->uri->segment(3);
		$r = new Resposta($id);
		if($r->result_count() < 1)
		{
			redirect(base_url('respostas/pending'));
			return;
		}
		
		$r->avaliacao->get();
		$r->ref_user->get();
		$r->author->get();
		$r->controle->get();
		
		$data['id'] = $id;
		$data['open_as'] = $r->open_as;

		$data['r'] = $r;
		$data['avaliacao'] = $r->avaliacao;
		$data['ref_user'] = $r->ref_user;
		$data['author'] = $r->author;
		$data['controle'] = $r->controle;
		$data['status_id'] = $r->status_id;
		$data['resp'] = unserialize($r->answers);
		
		$data['erros'] = $erros;
		$data['dados'] = $dados;
		
		$data['title'] = 'Preencher avaliação: [' . $r->avaliacao->name . ']';
		
		$this->load->view('view_questionario', $data);
	}
	
	public function processa_respostas()
	{
		$post = $this->input->post(NULL, TRUE);
		if(isset($post['submitSalvar']) || isset($post['submitFinalizar'])) // form was submitted
		{
			$resp_id = $post['hidden_resposta_id'];
			$resp = new Resposta($resp_id);
			if($resp->result_count() > 0)
			{
				$resp->avaliacao->get();
				if($resp->avaliacao->result_count() > 0)
				{
					// validação
					if($erros = $this->__validar($resp_id, $post)) // encontrou erros de validação
					{
						$this->answer($resp_id, $erros, $post);
						return;
					}
					
					// salvar dados
					$resp->answers = serialize($post);
					$resp->status_id = isset($post['submitSalvar']) ? RESP_INICIADO : RESP_FINALIZADO;
					if($resp->save())	// salvou ok
					{
						$msg = urlencode(htmlentities("<strong>Respostas salvas com sucesso!</strong>"));
						$msg_type = urlencode('success');
						redirect("/respostas/pending/?msg=$msg&msg_type=$msg_type");
						return;
					}
					else	// erro ao salvar respostas
					{
						exit('Erro ao salvar respostas');
					}
				}
				else	// modelo de avaliação não encontrado
				{
					exit('Modelo de avaliação não encontrado.');
				}
			}
			else	// incorrect id
			{
				exit('ID da folha de respostas incorreto.');
			}
		}
		else	// form not submitted
		{
			exit('Direct access denied.');
		}
	}

	public function reabrir()
	{
		echo "reabrir";
	}
	
	private function __validar($resp_id, $post)
	{
		$r = new Resposta($resp_id);
		if($r->result_count() < 1) return "ERRO: Folha de respostas não encontrada";
		$r->avaliacao->get();
		if($r->avaliacao->result_count() < 1) return "ERRO: Modelo de avaliação não encontrado";
		
		include('validacoes_avaliacoes/' . $r->avaliacao->filename . '.php');
	}
	
}

