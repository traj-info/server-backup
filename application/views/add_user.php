<?php $this->load->view('header'); ?>
<?php $this->load->view('usuarios_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Utilize este formulário para adicionar ao Sistema Administrativo Anestesiologia USP o(s) usuário(s) previamente cadastrado(s) no site</h3>
<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmAddUser');

echo validation_errors();

echo form_open('usuarios/add', $attributes);
echo "<p id='nota1'>Selecione na tabela abaixo o(s) usuário(s) que desejar adicionar ao sistema administrativo.</p>";
echo "<p id='nota2'>NOTA: São mostrados apenas os usuários que ainda não foram cadastrados no sistema. Para editar configurações de usuários já cadastrados, acesse o <a href='" . base_url('usuarios') . "'>índice de usuários</a>.</p>";
echo "<table id='add_user' class='tabela1 tabela_estilo1'>";
echo "<thead>";
echo "<tr>";
echo "<th></th>";
echo "<th>ID</th>";
echo "<th>Username</th>";
echo "<th>Nome</th>";
echo "<th>CRM</th>";
echo "<th>Matrícula HC</th>";
echo "<th>Cargo</th>";
echo "<th>Instituto</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

foreach($atuais as $id => $user)
{
	$nome = ($user['firstname'] != "" && $user['lastname'] != "") ? $user['firstname'] . " " . $user['lastname'] : $user['display_name'];
	$nome = strtoupper($nome);
	
	echo "<tr id='" . $id . "'>";
	echo "<td>" . form_checkbox('addusercheck[]', $id, FALSE) . "</td>";
	echo "<td>" . $user['id'] . "</td>";
	echo "<td>" . $user['username'] . "</td>";
	echo "<td>" . $nome . "</td>";
	echo "<td>" . $user['crm'] . "</td>";
	echo "<td>" . $user['matricula_hc'] . "</td>";
	echo "<td>" . $user['cargo'] . "</td>";
	echo "<td>" . $user['instituto'] . "</td>";
	echo form_hidden('hidNome[' . $user['id'] . ']', $nome);
	echo form_hidden('hidFirstName[' . $user['id'] . ']', $user['firstname']);
	echo form_hidden('hidLastName[' . $user['id'] . ']', $user['lastname']);
	echo form_hidden('hidUsername[' . $user['id'] . ']', $user['username']);
	echo form_hidden('hidEmail[' . $user['id'] . ']', $user['email']);
	echo "</tr>";
}

echo "</tbody>";
echo "</table>";

echo "<div class='fields_holder'>";

$options = array(
                  ROLE_ASSISTENTE  => 'Assistente, Coordenador ou Supervisor',
                  ROLE_ADMIN_SISTEMA   => 'Administrador do sistema'
                );
echo form_label('Selecione o papel do(s) usuário(s) selecionado(s) no sistema', 'selRole');
echo form_dropdown('selRole', $options, ROLE_ASSISTENTE);
echo "<p>NOTA: Você poderá especificar os coordenadores e supervisores de cada grupo na <a href='" . base_url('grupos')  . "'>página de configurações dos grupos</a>, depois de adicionar todos os usuários ao sistema.</p>";
echo "<div class='bt_holder'>";
echo form_submit('submit', 'Adicionar usuário(s) selecionado(s)');
echo "</div>"; // bt_holder
echo "</div>"; // fields_holder
echo "</form>";


?>
<?php $this->load->view('footer'); ?>