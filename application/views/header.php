<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<!--  jquery core -->
	<script src="<?php echo base_url('js/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
	<!--  jquery ui -->
	<script src="<?php echo base_url('js/jquery-ui-1.8.20.custom.min.js'); ?>" type="text/javascript"></script>
	<link rel='stylesheet' id='main-css-css'  href='<?php echo base_url('css/style.css'); ?>' type='text/css' media='all' />	
	<title><?php echo $title ?> - Anestesiologia USP</title>

</head>
<body>
<div id="top">
	<h1>Sistema Administrativo :: Anestesiologia USP</h1>
	<ul class="top_menu">
		<li id="mn_home"><a href="<?php echo base_url(); ?>">Página inicial</a></li>
		<li id="mn_meusdados"><a href="<?php echo base_url(); ?>">Meus dados</a></li>
		<li id="mn_site"><a href="http://www.anestesiologiausp.com.br" target="_blank">Voltar para o site</a></li>
		<li id="mn_sair"><a href="<?php echo base_url('#'); ?>">Sair</a></li>
	</ul>
</div>
<div id="breadcrumb">Você está aqui: <?php echo set_breadcrumb(); ?></div>