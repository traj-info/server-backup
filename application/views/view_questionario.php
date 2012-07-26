<?php $this->load->view('header'); ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type'))? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>

<?php if ($erros) echo msg($erros, 'error'); ?>

<h2>Avaliação: <?php echo $avaliacao->name; ?></h2>

<script type="text/javascript">
$(document).ready(function(){
<?php
if($open_as == OPENAS_AUTO)
{
?>
	$('.question').hide();
	$('.q_auto').show();
<?php
}
else if ($open_as == OPENAS_SUPERVISOR_ASSISTENTE)
{
?>
	$('.question').show();
	$('.q_auto').hide();
<?php
}
else if($open_as == OPENAS_SUPERVISOR_COORDENADOR)
{
?>
	$('.question').show();
	$('.q_chefe_coordenador').hide();
	$('.q_auto').hide();
<?php
}
else if($open_as == OPENAS_CHEFE_COORDENADOR)
{
?>
	$('.question').hide();
	$('.q_chefe_coordenador').show();
<?php
}
else if($open_as == OPENAS_CHEFE_SUPERVISOR)
{
?>
	$('.question').hide();
	$('.q_auto').show();
<?php
}
else
{
?>
	$('.question').hide();
<?php
}
?>	
});
</script>

<div class='aval_dados'>
<p><strong>Referente a: </strong><?php echo $ref_user->nome; ?></p>
<p><strong>Mês: </strong><?php echo traduz_mes($controle->ref_mes) . '/' . obter_ano($controle->ref_mes) ?></p>
<p><strong>Questões que se aplicam: </strong><?php echo traduz_open_as($open_as) ?></p>
<p><strong>Responsável pelo preenchimento: </strong><?php echo $author->nome ?></p>
<p><strong>Status desta avaliação: </strong><?php echo traduz_status_resposta($r->status_id) ?></p>
</div>

<?php
echo validation_errors();

$attributes = array('class' => 'traj_form', 'id' => 'frmAnswerAvaliacao', 'name' => 'frmAnswerAvaliacao');
echo form_open('respostas/processa_respostas', $attributes);

//$avaliacao->filename = 'superv_coord'; // TODO: tirar
//$avaliacao->filename = 'assistente'; // TODO: tirar
//$avaliacao->filename = 'assistente'; // TODO: tirar

if($status_id == RESP_FINALIZADO) echo msg('Você está apenas visualizando os dados preenchidos. A avaliação encontra-se finalizada.', 'note');

include('avaliacoes/' . $avaliacao->filename . '.php');

echo "<div class='bt_holder'>";
echo div_clear();
echo form_hidden('hidden_author_id', $author->id);
echo form_hidden('hidden_resposta_id', $id);
if($status_id != RESP_FINALIZADO)
{
	echo form_submit('submitSalvar', 'Salvar alterações (poderá ser editado posteriormente)');
	echo form_submit('submitFinalizar', 'Finalizar avaliação');
}
echo "</div>"; // bt_holder

?>
</form>
<?php $this->load->view('footer'); ?>