<?php $this->load->view('header'); ?>
<?php $this->load->view('usuarios_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Selecione a nova credencial de acesso para o usuário: <?php echo $nome; ?> (ID: <?php echo $user_id; ?>)</h3>

<?php
$attributes = array('class' => 'traj_form', 'id' => 'frmChangeCredential');

echo validation_errors();

echo form_open('usuarios/credencial', $attributes);

echo "<div class='fields_holder'>";
$options = array(
                  ROLE_ASSISTENTE  => 'Assistente, Coordenador ou Supervisor',
                  ROLE_ADMIN_SISTEMA   => 'Administrador do sistema'
                );
echo form_label('Selecione o novo papel para este usuário', 'selRole');
echo form_dropdown('selRole', $options, ROLE_ASSISTENTE);
echo form_hidden('hidUserId', $user_id);
echo "<p>NOTA: Após alterar a credencial de acesso, configure também a nova disposição dos grupos.</p>";
echo "<div class='bt_holder'>";
echo form_submit('submit', 'Confirmar alteração');
echo "</div>"; // bt_holder
echo "</div>"; // fields_holder

?>
</form>
<?php $this->load->view('footer'); ?>