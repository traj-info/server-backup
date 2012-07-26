<?php $this->load->view('header'); ?>
<?php $this->load->view('respostas_opcoes'); ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type'))? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>

<?php
if($cont_preencher > 0)
{
	echo "<table id='view_respostas' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Título</th>";
	echo "<th>Referente a</th>";
	echo "<th>Mês de referência</th>";
	echo "<th>Status</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($resp as $i => $u)
	{
		if($u->status_id == RESP_FINALIZADO) continue;
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td>" . $u->titulo . "</td>";
		echo "<td>" . $u->referente . "</td>";
		echo "<td>" . $u->mes . "</td>";
		echo "<td>" . $u->status . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_preencheravaliacao'><a title='Preencher avaliação' href='" . base_url('respostas/answer/' . $u->id) . "'>Preencher avaliacao</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhuma avaliação pendente encontrada.</p>";
}
?>
<h2>Avaliações finalizadas</h2>
<?php
if($cont_finalizado > 0)
{
	echo "<table id='view_respostas' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Título</th>";
	echo "<th>Referente a</th>";
	echo "<th>Mês de referência</th>";
	echo "<th>Status</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($resp as $i => $u)
	{
		if($u->status_id != RESP_FINALIZADO) continue;
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td>" . $u->titulo . "</td>";
		echo "<td>" . $u->referente . "</td>";
		echo "<td>" . $u->mes . "</td>";
		echo "<td>" . $u->status . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_veravaliacao'><a title='Ver avaliação' href='" . base_url('respostas/answer/' . $u->id) . "'>Ver avaliacao</a></li>";
		//echo "<li class='op_reabriravaliacao'><a title='Reabrir avaliação' href='" . base_url('respostas/reopen/' . $u->id) . "'>Reabrir avaliacao</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhuma avaliação finalizada encontrada.</p>";
}
?>

<?php $this->load->view('footer'); ?>