<?php
/*
/* VALIDAÇÃO DO FORMULÁRIO: assistente_uti
*/

$n = 0;
$erros = array();

switch($r->open_as)
{
	case OPENAS_AUTO:
	
		break;
	
	case OPENAS_COORDENADOR_ASSISTENTE:
	
		break;
		
	case OPENAS_SUPERVISOR_ASSISTENTE:
		
		break;
		
	case OPENAS_SUPERVISOR_COORDENADOR:
	
		break;
		
	case OPENAS_CHEFE_COORDENADOR:
	
		break;
		
	case OPENAS_CHEFE_SUPERVISOR:
	
		break;
}

return ($n > 0) ? $erros : FALSE;
?>