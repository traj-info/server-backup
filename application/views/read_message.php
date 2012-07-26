<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_mensagens'); ?>
<?php echo (isset($msg) && isset($msg_type)) ? msg($msg, $msg_type) : ''; ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type')) ? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>


<script type="text/javascript">
function confirmar_delete(url, id, data, assunto)
{
	$msg = "Tem certeza de que deseja excluir a mensagem '" + assunto + "' enviada em " + data + " (ID: " + id + ")?";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}
</script>

<?php
if($msg)
{
	echo "<table id='read_message' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>De</th>";
	echo "<th>Assunto</th>";
	echo "<th>Data</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	$from = $msg->from->nome;
	$data = FormatDate($msg->created);
	$continue = urlencode(htmlentities(base_url('mensagens/inbox')));

	echo "<tr id='" . $msg->id . "' class='tr_message'>";
	echo "<td id='from_" . $msg->id . "' class='td_from'>" . $from . "</td>";
	echo "<td id='assunto_" . $msg->id . "' class='td_assunto'>" . $msg->subject . "</td>";
	echo "<td id='date_" . $msg->id . "' class='td_date'>" . $data . "</td>";
	echo "<td><ul class='view_opcoes'>";
	echo "<li class='op_excluir'><a title='Excluir mensagem' onclick=\"confirmar_delete('" . base_url('mensagens/delete/' . $msg->id) . '/?continue=' . $continue . "', '" . $msg->id . "', '" . $data . "', '" . $msg->subject . "')\" href='#'>Excluir</a></li>";
	echo "<li class='op_responder'><a title='Responder' href='" . base_url('mensagens/write/' . $msg->id) . "'>Responder</a></li>";
	echo "</ul></td>";
	
	echo "</tr>";
	
	echo "<tr class='detalhes_mensagem_reading' id='msg_" . $msg->id . "'>";
	echo "<td colspan='6'><ul>";
	
	echo nl2br($msg->body);
	
	echo "</ul></td>";
	echo "</tr>";

	echo "</table>";
}

?>

<?php $this->load->view('footer'); ?>