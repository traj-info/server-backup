<?php $this->load->view('header'); ?>
<?php $this->load->view('avaliacoes_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Edite as informações abaixo para o modelo de avaliação: <em><?php echo $a_nome; ?></em> (ID: <?php echo $id; ?>)</h3>

<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmEditAvaliacao', 'name' => 'frmEditAvaliacao');

echo validation_errors();

if($id)
{
	echo form_open('avaliacoes/edit', $attributes);
	echo "<div class='fields_holder'>";

	echo "<div class='field_holder'>";
	echo form_label('Nome do modelo de avaliação', 'txtName');
	echo form_input('txtName', $a_nome);
	echo "</div>";

	echo "<div class='field_holder'>";
	echo form_label('Nome do arquivo com as questões', 'txtFilename');
	echo form_input('txtFilename', $a_filename);
	echo "</div>";
	
	echo "<div class='field_holder'>";
	echo form_label('Descrição', 'txtDesc');
	$data = array(
              'name'        => 'txtDesc',
              'id'          => 'txtDesc',
              'value'       => $a_descricao,
              'rows'	    => '5',
              'cols'        => '70',
              'style'       => '',
            );
	echo form_textarea($data);
	echo "</div>";
	
	echo "<div class='field_holder'>";
	echo form_label('Observações gerais', 'txtObs');
	$data = array(
              'name'        => 'txtObs',
              'id'          => 'txtObs',
              'value'       => $a_obs,
              'rows'	    => '5',
              'cols'        => '70',
              'style'       => '',
            );
	echo form_textarea($data);
	echo "</div>";	

	$options = array(
		ROLE_ASSISTENTE => 'Assistentes',
		ROLE_COORDENADOR_GRUPO => 'Coordenadores de grupo',
		ROLE_SUPERVISOR_GRUPO => 'Supervisores de grupo'
	);
	
	echo "<div class='field_holder'>";
	echo form_label('Aplica-se a', 'selTarget');
	echo form_dropdown('selTarget', $options, $a_target);
	echo "</div>";	
	
	echo "<div class='bt_holder'>";
	echo div_clear();
	echo form_hidden('hidden_avaliacao_id', $id);
	echo form_submit('submit', 'Salvar alterações');
	echo "</div>"; // bt_holder
	echo "</div>"; // fields_holder
	echo "</form>";

} // end if id
?>
<?php $this->load->view('footer'); ?>