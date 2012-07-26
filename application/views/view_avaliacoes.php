<?php $this->load->view('header'); ?>
<?php $this->load->view('avaliacoes_opcoes'); ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type'))? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Abaixo segue a lista de modelos de avaliação cadastrados</h3>

<script type="text/javascript">
function confirmar_delete(url, id, nome)
{
	$msg = "Tem certeza de que deseja excluir o modelo de avaliação " + nome + " (ID: " + id + ")? Todos os registros vinculados a ele, dados de produção, avaliações, etc. também serão excluídos.";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}

</script>

<?php
if($total > 0)
{
	echo "<table id='view_avaliacoes' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Nome</th>";
	echo "<th>Arquivo</th>";
	echo "<th>Descrição</th>";
	echo "<th>Observações</th>";
	echo "<th>Aplica-se a</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($aval as $i => $u)
	{
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td>" . $u->name . "</td>";
		echo "<td>" . $u->filename . "</td>";
		echo "<td>" . $u->description . "</td>";
		echo "<td>" . $u->obs . "</td>";
		echo "<td>" . traduz_role($u->target) . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_excluir'><a title='Excluir avaliação' onclick=\"confirmar_delete('" . base_url('avaliacoes/delete/' . $u->id) . "', '" . $u->id . "', '" . $u->name . "')\" href='#'>Excluir</a></li>";
		echo "<li class='op_editaravaliacao'><a title='Editar avaliação' href='" . base_url('avaliacoes/edit/' . $u->id) . "'>Editar avaliacao</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhum modelo de avaliação encontrado.</p>";
}

?>
<?php $this->load->view('footer'); ?>