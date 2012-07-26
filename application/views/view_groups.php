<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_opcoes'); ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type'))? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Abaixo segue a lista de grupos cadastrados</h3>

<script type="text/javascript">
$(document).ready(function() {
	$('.detalhes_assistentes').hide();
	$('.detalhes_avaliacoes').hide();
});

function confirmar_delete(url, id, nome)
{
	$msg = "Tem certeza de que deseja excluir o grupo " + nome + " (ID: " + id + ")? Todos os registros vinculados a ele, dados de produção, avaliações, etc. também serão excluídos.";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}
function mostrar_assistentes(id)
{
	$('#assist_' + id).toggle();
}

function mostrar_avaliacoes(id)
{
	$('#aval_' + id).toggle();
}
</script>

<?php
if($total > 0)
{
	echo "<table id='view_users' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Nome</th>";
	echo "<th>Supervisor</th>";
	echo "<th>Coordenador</th>";
	echo "<th>Assistentes</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($grupos as $i => $u)
	{
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td>" . $u->name . "</td>";
		echo "<td>" . $u->supervisor->nome . "</td>";
		echo "<td>" . $u->coordenador->nome . "</td>";
		echo "<td>" . $u->user->count() . " assistente(s)</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_excluir'><a title='Excluir grupo' onclick=\"confirmar_delete('" . base_url('grupos/delete/' . $u->id) . "', '" . $u->id . "', '" . strtoupper($u->name) . "')\" href='#'>Excluir</a></li>";
		echo "<li class='op_editargrupo'><a title='Editar grupo' href='" . base_url('grupos/edit/' . $u->id) . "'>Editar grupo</a></li>";
		echo "<li class='op_assistentes'><a title='Mostrar assistentes' onclick=\"mostrar_assistentes('" . $u->id . "')\" href='#'>Mostrar assistentes</a></li>";
		echo "<li class='op_veravaliacoes'><a title='Mostrar avaliações aplicáveis' onclick=\"mostrar_avaliacoes('" . $u->id . "')\" href='#'>Mostrar avaliações aplicáveis</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
		
		echo "<tr class='detalhes_assistentes' id='assist_" . $u->id . "'>";
		echo "<td colspan='6'><ul>Médicos assistentes:<br/>";
		foreach($u->user as $assist)
		{
			echo "<li>" . $assist->nome . "</li>";
		}
		echo "</ul></td>";
		echo "</tr>";
		
		echo "<tr class='detalhes_avaliacoes' id='aval_" . $u->id . "'>";
		echo "<td colspan='6'><ul>Modelos de avaliação aplicáveis:";
		foreach($u->avaliacao as $aval)
		{
			echo "<li>" . $aval->name . "</li>";
		}
		echo "</ul></td>";
		echo "</tr>";		
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhum grupo encontrado.</p>";
}

?>
<?php $this->load->view('footer'); ?>