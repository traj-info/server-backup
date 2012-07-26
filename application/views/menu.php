<h2>Bem-vindo ao sistema interno da Anestesiologia USP!</h2>
<div class='box1' id='box_messages'>
	<?php if($unread_total > 0) : ?>
	<p class='title_box'>Você tem <strong><?php echo $unread_total; ?></strong> mensagen(s) não lida(s).</p>
	<table>
		<thead>
			<tr>
				<th>De:</th>
				<th>Assunto:</th>
				<th>Data:</th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach($unread as $i => $m) : ?>
			<tr>
				<td><?php echo $m->from->nome; ?></td>
				<td><a href='<?php echo base_url('mensagens/read') . '/' . $m->id ;?>' title='Ler'><?php echo $m->subject; ?></a></td>
				<td><?php echo FormatDate($m->created); ?></td>
			</tr>
			<?php endforeach; ?>
			
		</tbody>
	
	</table>	
	<?php else : ?>
	<p class='title_box'>Nenhuma mensagem não lida.</p>
	<?php endif; ?>
</div>

<div class='box1' id='box_pendencias'>
	<p class='title_box'>Nenhuma pendência.</p>
</div>

<div class='box1' id='box_menu'>
<p class='title_box'>Menu</p>
	<ul>
		<li>Avaliações
			<ul>
				<li><a href='<?php echo base_url('respostas/pending'); ?>'>Avaliações para preencher</a></li>
				<li><a href='<?php echo base_url('respostas/about_me'); ?>'>Avaliações sobre mim</a></li>
			</ul>
		</li>
		<li>Minha pasta
			<ul>
				<li>Consultar relatório atual</li>
				<li>Preencher auto-avaliação atual</li>
				<li>Consultar relatórios anteriores</li>
			</ul>
		</li>
		<li>Usuários
			<ul>
				<li><a href='<?php echo base_url('usuarios'); ?>'>Lista de usuários</a></li>
				<li><a href='<?php echo base_url('usuarios/add'); ?>'>Adicionar usuário</a></li>
			</ul>
		</li>
		<li>Grupos
			<ul>
				<li><a href='<?php echo base_url('grupos'); ?>'>Lista de grupos</a></li>
				<li><a href='<?php echo base_url('grupos/add'); ?>'>Adicionar grupo</a></li>
			</ul>
		</li>
		<li>Mensagens
			<ul>
				<li><a href='<?php echo base_url('mensagens'); ?>'>Mensagens recebidas</a></li>
				<li><a href='<?php echo base_url('mensagens/sent'); ?>'>Mensagens enviadas</a></li>
				<li><a href='<?php echo base_url('mensagens/write'); ?>'>Nova mensagem</a></li>
			</ul>
		</li>
		<li>Configurações
			<ul>
				<li>Configurações de e-mail</li>
				<li>Tabela de salários</li>
				<li>Configurações de notificação</li>
			</ul>
		</li>
		<li>Modelos de avaliações
			<ul>
				<li><a href='<?php echo base_url('avaliacoes'); ?>'>Modelos cadastrados</a></li>
				<li><a href='<?php echo base_url('avaliacoes/add'); ?>'>Adicionar modelo</a></li>
			</ul>
		</li>


		<li>Produção - Administrador
			<ul>
				<li><a href='<?php echo base_url('/sent'); ?>'>Atuais</a></li>
				<li><a href='<?php echo base_url('/sent'); ?>'>Anteriores</a></li>
			</ul>
		</li>
		<li>Logs
			<ul>
				<li>Logs de acesso ao sistema</li>
			</ul>
		</li>
	</ul>
</div>

