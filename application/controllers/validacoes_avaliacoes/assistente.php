<?php
/*
/* VALIDAÇÃO DO FORMULÁRIO: assistente
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

/*
echo "<pre>";

print_r($post);

echo "</pre>";
*/

return ($n > 0) ? $erros : FALSE;
?>