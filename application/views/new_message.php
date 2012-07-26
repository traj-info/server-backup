<?php $this->load->view('header'); ?>
<?php $this->load->view('grupos_mensagens'); ?>

<?php echo (isset($msg) && isset($msg_type)) ? msg($msg, $msg_type) : ''; ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type')) ? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>

<h2><?php echo $title; ?></h2>
<h3>Utilize este formulário para enviar uma nova mensagem!</h3>
<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmNewMessage', 'name' => 'frmNewMessage');

$txt = "<script type='text/javascript' src='" . base_url('js/tiny_mce/tiny_mce.js') . "'></script>";
$txt .= "<script type='text/javascript'>";
$txt .= "tinyMCE.init({";
$txt .= "language : 'pt',";
$txt .= "theme : 'advanced',";
$txt .= "skin : 'o2k7',";
$txt .= "skin_variant : 'silver',";
$txt .= "mode : 'textareas',";
$txt .= "plugins : '',";
$txt .= "theme_advanced_buttons1 : 'undo,redo,|,bullist,numlist,|,sub,sup,|,bold,italic,underline,|,cut,copy,paste,|,link,anlink',";
$txt .= "theme_advanced_buttons2 : '',";
$txt .= "theme_advanced_buttons3 : '',";
$txt .= "theme_advanced_statusbar : 'off',";
$txt .= "theme_advanced_toolbar_location : 'top',";
$txt .= "theme_advanced_toolbar_align : 'left'";
$txt .= "});";
$txt .= "</script>";
echo $txt;

echo validation_errors();

if(isset($users) && $users)
{

	echo form_open('mensagens/send', $attributes);
	echo "<div class='fields_holder'>";

	echo "<div class='field_holder'>";
	echo form_label('Assunto', 'txtAssunto');
	echo form_input('txtAssunto', $reply_to);
	echo "</div>";	// field holder

	$optionsTos = "";
	foreach($users as $u)
	{
		$optionsTos[] = array(
			'selected' => $u->selected,
			'value' => $u->value,
			'option' => $u->option
		);
	}
	
		echo "<div class='field_holder'>";
	
	$sAssistentes = new TSelecionador('tos', 'frmNewMessage');
	$optionsTos = arrayToObject($optionsTos);
	$sAssistentes->SetDados($optionsTos);
	$instrucoes = "Selecione no quadro da esquerda os destinários da mensagem. Você pode selecionar mais de 1 destinatário segurando a tecla Ctrl enquanto clica. Depois clique em '>>' para levá-los para o quadro da direita.";
	echo $sAssistentes->GerarHTML('Destinatários', $instrucoes, 'Usu&aacute;rios n&atilde;o selecionados','Usu&aacute;rios selecionados');
	
	
	echo "</div>";
	echo div_clear();
	echo "<div class='field_holder'>";
	echo form_label('Mensagem', 'txtMessage');
	$data = array(
              'name'        => 'txtMessage',
              'id'          => 'txtMessage',
              'value'       => '',
              'rows'	    => '10',
              'cols'        => '100',
              'style'       => '',
            );
	echo form_textarea($data);
	echo "</div>";	
	
	
	echo "<div class='bt_holder'>";
	echo div_clear();
	echo form_hidden('hidden_from_id', '68'); // TODO: colocar ID do usuário logado
	echo form_submit('submit', 'Enviar mensagem', "onclick='BeforeSubmit()'");
	echo "</div>"; // bt_holder
	echo "</div>"; // fields_holder
	echo "</form>";
	echo "<script type='text/javascript'>\r\n<!--\r\n";
	echo "function BeforeSubmit()\r\n{\r\n";
	echo $sAssistentes->GerarBeforeSubmit();
	echo "\r\n}\r\n-->\r\n</script>\r\n";	

} // end if users
?>
<?php $this->load->view('footer'); ?>