<?php $this->load->view('header'); ?>
<?php $this->load->view('avaliacoes_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Utilize este formulário para adicionar um novo modelo de avaliação ao Sistema Administrativo Anestesiologia USP</h3>
<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmAddAvaliacao', 'name' => 'frmAddAvaliacao');

echo validation_errors();

if(true)
{
	echo form_open('avaliacoes/add', $attributes);
	echo "<div class='fields_holder'>";

	echo "<div class='field_holder'>";
	echo form_label('Nome do modelo de avaliação', 'txtName');
	echo form_input('txtName', '');
	echo "</div>";

	
	echo "<div class='field_holder'>";
	echo form_label('Nome do arquivo com as questões', 'txtFilename');
	echo form_input('txtFilename', '');
	echo "</div>";	
	
	echo "<div class='field_holder'>";
	echo form_label('Descrição', 'txtDesc');
	$data = array(
              'name'        => 'txtDesc',
              'id'          => 'txtDesc',
              'value'       => '',
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
              'value'       => '',
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
	echo form_dropdown('selTarget', $options);
	echo "</div>";
	
	echo "<div class='bt_holder'>";
	echo div_clear();
	echo form_submit('submit', 'Adicionar avaliação');
	echo "</div>"; // bt_holder
	echo "</div>"; // fields_holder
	echo "</form>";
} // end if users

?>
<?php $this->load->view('footer'); ?>