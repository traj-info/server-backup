<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador extends CI_Controller {

	public function index()
	{
			
	}
	
	public function setup()
	{
		// TODO: restringir acesso somente via cli (command-line interface) to prevent remote access attempt
		
		

		// get all users
		$u = new User();
		$u->where('status_id', STATUS_ACTIVE)->get();
		
		if($u->result_count() < 1) exit();
		foreach($u as $user)
		{
			// se já foi criado o registro de controle para o mês anterior E para este usuário, continue a execução.
			$user->controle->get_previous();
			if($user->controle->result_count() > 0) continue;
			
			// cria registro de controle
			$c = new Controle();
			$c->ref_mes = date("Y-m", strtotime("-1 month")) . '-01'; // YYYY-MM-DD (dd sempre 01)
			$c->obs = '';
			$c->status = STATUS_ACTIVE;
			
			// cria producao
			$prod = new Producao();
			$prod->save();

			// salva controle (por enquanto sem as respostas)
			if(! $c->save(array(
				'user' => $user,
				'producao' => $prod
			))) // error on save
			{
				exit('erro ao salvar controle');
			}
			
			// cria respostas de avaliações
			$user->group->get();
			$autopreenchimento = 0;
			
			if($user->group->result_count() > 0)	// usuário faz parte COMO ASSISTENTE de pelo menos 1 grupo
			{
				foreach($user->group as $g) // para cada grupo do qual este usuário É ASSISTENTE
				{
					$g->avaliacao->get();
					$g->supervisor->get();
					
					if($g->avaliacao->result_count() > 0)	// grupo possui avaliações associadas
					{
						foreach($g->avaliacao as $a)
						{
							if($a->target == ROLE_ASSISTENTE) // este modelo de avaliação aplica-se a assistentes
							{
								// auto-preenchimento (1 POR ASSISTENTE)
								if($autopreenchimento == 0)
								{
									$autopreenchimento++;
									$resp_auto = new Resposta();
									$resp_auto->status_id = RESP_NAOINICIADO;
									$resp_auto->open_as = OPENAS_AUTO;
									
									// Save all
									if(! $resp_auto->save(array(
										'ref_user' => $user,
										'avaliacao' => $a,
										'author' => $user,
										'controle' => $c
									))) // error on save
									{
										exit('erro auto assistente');
									}
								}

								// preenchimento pelo supervisor
								$resp_superv = new Resposta();
								$resp_superv->status_id = RESP_NAOINICIADO;
								$resp_superv->open_as = OPENAS_SUPERVISOR_ASSISTENTE;
								
								// Save all
								if(! $resp_superv->save(array(
									'ref_user' => $user,
									'avaliacao' => $a,
									'author' => $g->supervisor,
									'controle' => $c
								))) // error on save
								{
									exit('erro supervisor');
								}
							}
						}
					}
					else // grupo ainda não possui avaliações associadas
					{
					}
				}
			}
			
			// é coordenador de algum grupo?
			$autopreenchimento = 0;
			$user->group_coord->get();
			if($user->group_coord->result_count() > 0)
			{
				foreach($user->group_coord as $g) // para cada grupo do qual este usuário É COORDENADOR
				{
					$g->avaliacao->get();
					$g->supervisor->get();
					
					if($g->avaliacao->result_count() > 0)	// grupo possui avaliações associadas
					{
						foreach($g->avaliacao as $a)
						{
							if($a->target == ROLE_COORDENADOR_GRUPO) // este modelo de avaliação aplica-se a coordenadores
							{
								// auto-preenchimento (1 POR COORDENADOR)
								if($autopreenchimento == 0)
								{
									$autopreenchimento++;
									$resp_auto = new Resposta();
									$resp_auto->status_id = RESP_NAOINICIADO;
									$resp_auto->open_as = OPENAS_AUTO;
									
									// Save all
									if(! $resp_auto->save(array(
										'ref_user' => $user,
										'avaliacao' => $a,
										'author' => $user,
										'controle' => $c
									))) // error on save
									{
										exit('erro auto coordenador');
									}
								}

								// preenchimento pelo supervisor
								$resp_superv = new Resposta();
								$resp_superv->status_id = RESP_NAOINICIADO;
								$resp_superv->open_as = OPENAS_SUPERVISOR_COORDENADOR;
								
								// Save all
								if(! $resp_superv->save(array(
									'ref_user' => $user,
									'avaliacao' => $a,
									'author' => $g->supervisor,
									'controle' => $c
								))) // error on save
								{
									exit('erro supervisor do coordenador');
								}
								
								// preenchimento pelo chefe da disciplina
								$resp_chefe = new Resposta();
								$resp_chefe->status_id = RESP_NAOINICIADO;
								$resp_chefe->open_as = OPENAS_CHEFE_COORDENADOR;
								
								$settings = new Setting();
								// Save all
								if(! $resp_chefe->save(array(
									'ref_user' => $user,
									'avaliacao' => $a,
									'author' => $settings->get_chefe_disciplina(),
									'controle' => $c
								))) // error on save
								{
									exit('erro chefe da disciplina, coordenador');
								}
							}
						}
					}
					else // grupo ainda não possui avaliações associadas
					{
					}
				}
			}
			
			// é supervisor de algum grupo?
			$autopreenchimento = 0;
			$user->group_superv->get();
			if($user->group_superv->result_count() > 0)
			{
				foreach($user->group_superv as $g) // para cada grupo do qual este usuário É SUPERVISOR
				{
					$g->avaliacao->get();
					
					if($g->avaliacao->result_count() > 0)	// grupo possui avaliações associadas
					{
						foreach($g->avaliacao as $a)
						{
							if($a->target == ROLE_SUPERVISOR_GRUPO) // este modelo de avaliação aplica-se a supervisores
							{
								// auto-preenchimento (1 POR SUPERVISOR)
								if($autopreenchimento == 0)
								{
									$autopreenchimento++;
									$resp_auto = new Resposta();
									$resp_auto->status_id = RESP_NAOINICIADO;
									$resp_auto->open_as = OPENAS_AUTO;
									
									// Save all
									if(! $resp_auto->save(array(
										'ref_user' => $user,
										'avaliacao' => $a,
										'author' => $user,
										'controle' => $c
									))) // error on save
									{
										exit('erro auto supervisor');
									}
								}

								// preenchimento pelo chefe da disciplina
								$resp_chefe = new Resposta();
								$resp_chefe->status_id = RESP_NAOINICIADO;
								$resp_chefe->open_as = OPENAS_CHEFE_SUPERVISOR;
								
								$settings = new Setting();
								// Save all
								if(! $resp_chefe->save(array(
									'ref_user' => $user,
									'avaliacao' => $a,
									'author' => $settings->get_chefe_disciplina(),
									'controle' => $c
								))) // error on save
								{
									exit('erro chefe da disciplina, supervisor');
								}
							}
						}
					}
					else // grupo ainda não possui avaliações associadas
					{
					}
				}
			}

			// Notificação
			$m = new Message();
			$admin = new User();
			$admin->get_by_id(ADMIN_ID);
			$subject = "[Anestesiologia USP] Formulários disponíveis";
			$body = 'Já estão disponíveis os formulários de avaliação de desempenho da Disciplina de Anestesiologia!';
			$body .= '<br/>Acesse o sistema para preenchê-los: <a href="' . base_url() . '">' . base_url() . '</a>';

			$m->new_message($admin, $user, $subject, $body);
			
			
		} // fim loop usuários
	} // fim funcao setup
//---------------------------------------------------------------------------------------------------------------------------
		
	public function daily()
	{
		// TODO: restringir acesso somente via cli (command-line interface) to prevent remote access attempt
		
		
		$cont = new Controle();
		$cont->get_previous();
		
		if($cont->result_count() > 0)
		{
			foreach($cont as $i => $c)
			{
				$c->user->get();
				$c->producao->get();
				$c->aprovacao->get();
				$c->resposta->get();
				
				
				// verifica produção
				if($c->producao->modified = NULL) // produção ainda não editada
				{
					$producao_finalizada = FALSE;
				}
				else
				{
					$producao_finalizada = TRUE;
				}
				
				// verifica avaliações (respostas)
				if($c->resposta->result_count() > 0)
				{
					$avaliacoes_finalizadas = TRUE;
					foreach($c->resposta as $r)
					{
						if($r->status_id != RESP_FINALIZADO) // questionário ainda não finalizado
						{
							$avaliacoes_finalizadas = FALSE;
							
							$r->avaliacao->get();
							$r->ref_user->get();
							$r->author->get();
						
							// lembrete
							$m = new Message();
							$admin = new User();
							$admin->get_by_id(ADMIN_ID);
							$user = $r->author;
							$subject = "[Anestesiologia USP] Lembrete do sistema: avaliação não finalizada";
							$body = 'A avaliação "' . $r->avaliacao->name . '", referente a ' . $r->ref_user->nome . ' (mês: ' . traduz_mes($c->ref_mes) . '/' . obter_ano($c->ref_mes) . ') encontra-se disponível no sistema.';
							$body .= '<br/>Acesse o sistema para preenchê-la: <a href="' . base_url() . '">' . base_url() . '</a>';

							$m->new_message($admin, $user, $subject, $body);
						}
					}
					
					if($avaliacoes_finalizadas && $producao_finalizada) // todas as avaliações e a produção foram finalizadas
					{
						
						if(!$c->pontuacao || !$c->valor_total) // ainda não foi calculada a pontuação ou o valor total
						{
							// cálculo dos valores e pontuações
							// ASSISTENTE --> pontuacao = auto-avaliacao[1] + media(soma(supervisores[9]))
							// COORDENADOE DE GRUPO --> pontuacao = auto_avaliacao[1] + chefe[3] + supervisor[6]
							// CHEFE --> não tem pontuacao
							
							$score = 0;
							$c->avaliacao->get_auto_avaliacao();
							echo $c->avaliacao->id . "<<ID";
							return;
						}
					
						if($c->aprovacao->result_count() < 1)	// ainda não foram adicionadas as aprovações necessárias
						{
							// todos os supervisores dos grupos a que o assistente pertence devem aprovar seu controle
							
							// se se tratar do controle de um supervisor, o chefe da disciplina deverá aprovar seu controle
							
							
						
						}
						
					}else
					{
						echo "aval nao finalizada";
						echo $c->user_id;
						return;
					}
				}
				
				
				
			}
		}
	} // fim funcao daily

//---------------------------------------------------------------------------------------------------------------------------	

	public function finish()
	{
		
		
	} // fim funcao finish
//---------------------------------------------------------------------------------------------------------------------------		
} // fim classe

