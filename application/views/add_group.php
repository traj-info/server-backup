<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Utilize este formulário para adicionar um novo grupo ao Sistema Administrativo Anestesiologia USP</h3>
<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmAddGroup', 'name' => 'frmAddGroup');

echo validation_errors();

if($users)
{
	echo form_open('grupos/add', $attributes);
	echo "<div class='fields_holder'>";

	echo "<div class='field_holder'>";
	echo form_label('Nome do grupo', 'txtName');
	echo form_input('txtName', '');
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

	$options = "";
	$optionsAssistentes = "";
	foreach($users as $u)
	{
		$options[$u->value] = $u->option;
		$optionsAssistentes[] = array(
			'selected' => $u->selected,
			'value' => $u->value,
			'option' => $u->option
		);
	}
	
	$optionsAvaliacoes = "";
	if($aval)
	{
		foreach($aval as $u)
		{
			$optionsAvaliacoes[] = array(
				'selected' => $u->selected,
				'value' => $u->value,
				'option' => $u->option
			);
		}		
	}
	
	echo "<div class='field_holder'>";
	echo form_label('Supervisor', 'supervisor');
	echo form_dropdown('supervisor', $options);
	echo "</div>";

	echo "<div class='field_holder'>";
	echo form_label('Coordenador', 'coordenador');
	echo form_dropdown('coordenador', $options);
	echo "</div>";
	
	echo "<div class='field_holder'>";
	$sAssistentes = new TSelecionador('assistentes', 'frmAddGroup');
	$optionsAssistentes = arrayToObject($optionsAssistentes);
	$sAssistentes->SetDados($optionsAssistentes);
	$instrucoes = "Selecione os médicos assistentes que fazem parte deste grupo. Atente para NÃO adicionar médicos já listados como Coordenador ou Supervisor deste grupo.";
	echo $sAssistentes->GerarHTML('Assistentes', $instrucoes, 'M&eacute;dicos n&atilde;o selecionados','M&eacute;dicos selecionados');
	echo "</div>";

	if($optionsAvaliacoes != '')
	{
		echo "<div class='field_holder'>";
		$sAvaliacoes = new TSelecionador('avaliacoes', 'frmAddGroup');
		$optionsAvaliacoes = arrayToObject($optionsAvaliacoes);
		$sAvaliacoes->SetDados($optionsAvaliacoes);
		$instrucoes = "Selecione os modelos de avaliação que se aplicam a este grupo.";
		echo $sAvaliacoes->GerarHTML('Avaliações', $instrucoes, 'Modelos n&atilde;o selecionados','Modelos selecionados');
		echo "</div>";
	}
	else
	{
		echo "<div class='field_holder obs_avaliacao'>";
		echo "Nenhum modelo de avaliação cadastrado ainda";
		echo "</div>";
	}

	
	echo "<div class='bt_holder'>";
	echo div_clear();
	echo form_submit('submit', 'Adicionar grupo', "onclick='BeforeSubmit()'");
	echo "</div>"; // bt_holder
	echo "</div>"; // fields_holder
	echo "</form>";
	echo "<script type='text/javascript'>\r\n<!--\r\n";
	echo "function BeforeSubmit()\r\n{\r\n";
	echo $sAssistentes->GerarBeforeSubmit();
	echo $sAvaliacoes->GerarBeforeSubmit();
	echo "\r\n}\r\n-->\r\n</script>\r\n";	
} // end if users

?>
<?php $this->load->view('footer'); ?>