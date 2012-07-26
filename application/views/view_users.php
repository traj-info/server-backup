<?php $this->load->view('header'); ?>
<?php $this->load->view('usuarios_opcoes'); ?>
<?php echo (isset($msg) && isset($msg_type) )? msg($msg, $msg_type) : ''; ?>
<h2><?php echo $title; ?></h2>
<h3>Abaixo segue a lista de usuários já cadastrados no sistema administrativo</h3>

<script type="text/javascript">
function confirmar_delete(url, id, nome)
{
	$msg = "Tem certeza de que deseja excluir o cadastro do usuário " + nome + " (ID: " + id + ")? Todos os registros vinculados a ele, como mensagens, dados de produção, avaliações, etc. também serão excluídos.";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}
</script>

<?php
if($total > 0)
{
	echo "<table id='view_users' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Username</th>";
	echo "<th>Nome</th>";
	echo "<th>CRM</th>";
	echo "<th>Matrícula HC</th>";
	echo "<th>Cargo</th>";
	echo "<th>Instituto</th>";
	echo "<th>Função</th>";
	echo "<th>Credencial</th>";
	echo "<th>Status</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($users as $i => $u)
	{
		if($u->status == STATUS_ACTIVE)
		{
			$temp = "<li class='op_inativar'><a title='Inativar usuário' href='" . base_url('usuarios/inativar/' . $u->id) . "'></a></li>";
			$cor = "";			
		}
		else
		{
			$temp = "<li class='op_ativar'><a title='Ativar usuário' href='" . base_url('usuarios/ativar/' . $u->id) . "'></a></li>";
			$cor = " style='color: #f00;'";
		}
	
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td $cor>" . $u->username . "</td>";
		echo "<td $cor>" . strtoupper($u->nome) . "</td>";
		echo "<td>" . $u->crm . "</td>";
		echo "<td>" . $u->matricula_hc . "</td>";
		echo "<td>" . $u->cargo . "</td>";
		echo "<td>" . $u->instituto . "</td>";
		echo "<td>" . $u->funcao . "</td>";
		echo "<td>" . strtoupper(traduz_role($u->role)) . "</td>";
		echo "<td>" . strtoupper(traduz_status($u->status)) . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_excluir'><a title='Excluir usuário' onclick=\"confirmar_delete('" . base_url('usuarios/delete/' . $u->id) . "', '" . $u->id . "', '" . strtoupper($u->nome) . "')\" href='#'>Excluir</a></li>";
		echo "<li class='op_credencial'><a title='Alterar credencial do usuário' href='" . base_url('usuarios/credencial/' . $u->id) . "'>Alterar credencial</a></li>";
		echo $temp;
		echo "</ul></td>";
		
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhum usuário encontrado.</p>";
}

?>
<?php $this->load->view('footer'); ?>