<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_mensagens'); ?>
<?php echo (isset($msg) && isset($msg_type)) ? msg($msg, $msg_type) : ''; ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type')) ? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>


<script type="text/javascript">
$(document).ready(function() {
	$('.detalhes_mensagem').hide();
	$('.td_assunto, .td_identification, .td_to, .td_date').click(function(){
		mostrar_mensagem($(this).parent().attr('id'));
	});
});

function mostrar_mensagem(id)
{
	$('#msg_' + id).toggle();
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
	echo "<th>Para</th>";
	echo "<th>Assunto</th>";
	echo "<th>Data</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($results as $i => $u)
	{
		$status_class = '';
		$to = ($u->total > 1) ? $u->to->nome . " e mais " . ($u->total - 1) . " destinatário(s)" : $u->to->nome;
		$data = FormatDate($u->created);
	
		echo "<tr id='" . $u->id . "' class='tr_message'>";
		echo "<td id='identification_" . $u->id . "' class='td_identification $status_class'>" . ($i + $comeco) . "</td>";
		echo "<td id='to_" . $u->id . "' class='td_to $status_class'>" . $to . "</td>";
		echo "<td id='assunto_" . $u->id . "' class='td_assunto $status_class'>" . $u->subject . "</td>";
		echo "<td id='date_" . $u->id . "' class='td_date $status_class'>" . $data . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_ler'><a title='Ler mensagem' onclick=\"mostrar_mensagem('" . $u->id . "')\" href='#'>Mostrar mensagem</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
		
		echo "<tr class='detalhes_mensagem' id='msg_" . $u->id . "'>";
		echo "<td colspan='6'><ul>";
		echo "Para: " . $csv_tos[$i] . "<hr>";
		echo $u->body;
		
		echo "</ul></td>";
		echo "</tr>";
	}
	echo "</table>";
}

?>

<?php $this->load->view('footer'); ?>