<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_mensagens'); ?>
<?php echo (isset($msg) && isset($msg_type)) ? msg($msg, $msg_type) : ''; ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type')) ? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>


<script type="text/javascript">
$(document).ready(function() {
	$('.detalhes_mensagem').hide();
	$('.td_assunto, .td_identification, .td_from, .td_date').click(function(){
		mostrar_mensagem($(this).parent().attr('id'));
	});
});

function confirmar_delete(url, id, data, assunto)
{
	$msg = "Tem certeza de que deseja excluir a mensagem '" + assunto + "' enviada em " + data + " (ID: " + id + ")?";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}

function mostrar_mensagem(id)
{
	if($('#msg_' + id).is(':visible'))
	{
		$('#msg_' + id).toggle();
	}
	else
	{
		$.ajax({
			url: "<?php echo base_url('mensagens/mark_read'); ?>/" + id,
			success: function(){
				$('#msg_' + id).toggle();
				$('#status_' + id).html('lida');
				$('td#assunto_' + id).removeClass('unread');
				$('td#identification_' + id).removeClass('unread');
				$('td#status_' + id).removeClass('unread');
				$('td#from_' + id).removeClass('unread');
				$('td#date_' + id).removeClass('unread');
			}
		});
	}
}
</script>

<?php echo $links; ?>
<div class='pag_indice' id='pag_got_messages'>Total de mensagens: <strong><?php echo $total; ?></strong>

<?php if ($total > 1) : ?>| Vendo mensagem <?php echo $comeco; ?> a <?php echo $final; ?></div><?php endif; ?>
<?php
if($total > 0)
{
	echo "<table id='view_got_messages' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>#</th>";
	echo "<th>Lida</th>";
	echo "<th>De</th>";
	echo "<th>Assunto</th>";
	echo "<th>Data</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($results as $i => $u)
	{
		$status = ($u->read_count > 0) ? 'lida' : 'não lida';
		$status_class = ($u->read_count > 0) ? '' : 'unread';
		$from = $u->from->nome;
		$data = FormatDate($u->created);
		$continue = urlencode(htmlentities(base_url('mensagens/inbox')));
	
		echo "<tr id='" . $u->id . "' class='tr_message'>";
		echo "<td id='identification_" . $u->id . "' class='td_identification $status_class'>" . ($i + $comeco) . "</td>";
		echo "<td id='status_" . $u->id . "' class='td_status $status_class'>" . $status . "</td>";
		echo "<td id='from_" . $u->id . "' class='td_from $status_class'>" . $from . "</td>";
		echo "<td id='assunto_" . $u->id . "' class='td_assunto $status_class'>" . $u->subject . "</td>";
		echo "<td id='date_" . $u->id . "' class='td_date $status_class'>" . $data . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_excluir'><a title='Excluir mensagem' onclick=\"confirmar_delete('" . base_url('mensagens/delete/' . $u->id) . '/?continue=' . $continue . "', '" . $u->id . "', '" . $data . "', '" . $u->subject . "')\" href='#'>Excluir</a></li>";
		echo "<li class='op_responder'><a title='Responder' href='" . base_url('mensagens/write/' . $u->id) . "'>Responder</a></li>";
		echo "<li class='op_ler'><a title='Ler mensagem' onclick=\"mostrar_mensagem('" . $u->id . "')\" href='#'>Mostrar mensagem</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
		
		echo "<tr class='detalhes_mensagem' id='msg_" . $u->id . "'>";
		echo "<td colspan='6'><ul>";
		
		echo nl2br($u->body);
		
		echo "</ul></td>";
		echo "</tr>";
	}
	echo "</table>";
}

?>

<?php $this->load->view('footer'); ?>