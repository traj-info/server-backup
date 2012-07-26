<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('msg'))
{
    function msg($str, $type='note', $custom_id = '')
    {
		$str = trim($str);
		$html = "";
        if($str != "")
		{
			$html .= "<div class='msgbox msg_$type' id='$custom_id'>";
			$html .= $str;
			$html .= "</div><!-- .msgbox -->";
		}
		return $html;
    }
}

function arrayToObject($d) {
	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return (object) array_map(__FUNCTION__, $d);
	}
	else {
		// Return object
		return $d;
	}
}

function NowDatetime()
{
	return date("Y-m-d H:i:s");
}

function FormatDate($date) // d/m/Y H:i:s
{
	$temp = explode(' ', $date);
	$data = explode('-', $temp[0]);
	return $data[2] . '/' . $data[1] . '/' . $data[0] . ' ' . $temp[1];
}

function FilterData($variable)
{
	#gera warning se a conexao com o banco nao estiver estabelecida
	return mysql_real_escape_string(strip_tags($variable));
}

function create_guid($namespace = '') {
	static $guid = '';
	$uid = uniqid("", true);
	$data = $namespace;
	$data .= $_SERVER['REQUEST_TIME'];
	$data .= $_SERVER['HTTP_USER_AGENT'];
	$data .= $_SERVER['REMOTE_ADDR'];
	$data .= $_SERVER['REMOTE_PORT'];
	$hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
	$guid = substr($hash,  0,  8) .
	'-' .
	substr($hash,  8,  4) .
	'-' .
	substr($hash, 12,  4) .
	'-' .
	substr($hash, 16,  4) .
	'-' .
	substr($hash, 20, 12);
	return $guid;
}

function print_array($arr)
{
	if(is_array($arr))
	{
		echo "<br><pre>";
		print_r($arr);
		echo "</pre><br>";
	}
}

function print_object($arr)
{
	echo "<br><pre>";
	print_r($arr);
	echo "</pre><br>";
}

function traduz_status($s)
{
	switch($s)
	{
		case STATUS_INACTIVE: return "Inativo";
		case STATUS_ACTIVE: return "Ativo";
	}
}

function traduz_status_resposta($s)
{
	switch($s)
	{
		case RESP_NAOINICIADO: return "Não iniciado";
		case RESP_INICIADO: return "Iniciado";
		case RESP_FINALIZADO: return "Finalizado";
	}
}
	
function traduz_open_as($s)
{
	switch($s)
	{
		case OPENAS_AUTO: return "Auto-preenchimento";
		case OPENAS_COORDENADOR_ASSISTENTE: return "Coordenador de grupo";
		case OPENAS_SUPERVISOR_ASSISTENTE: return "Supervisor de grupo";
		case OPENAS_SUPERVISOR_COORDENADOR: return "Supervisor de grupo";
		case OPENAS_CHEFE_COORDENADOR: return "Chefe da Disciplina";
		case OPENAS_CHEFE_SUPERVISOR: return "Chefe da Disciplina";
	}
}

function traduz_mes($n) //n --> YYYY-MM-DD
{
	$temp = explode('-', $n);
	$mes[1] = 'Janeiro';
	$mes[2] = 'Fevereiro';
	$mes[3] = 'Março';
	$mes[4] = 'Abril';
	$mes[5] = 'Maio';
	$mes[6] = 'Junho';
	$mes[7] = 'Julho';
	$mes[8] = 'Agosto';
	$mes[9] = 'Setembro';
	$mes[10] = 'Outubro';
	$mes[11] = 'Novembro';
	$mes[12] = 'Dezembro';
	
	return $mes[(int)$temp[1]];
}

function obter_ano($n) //n --> YYYY-MM-DD
{
	$temp = explode('-', $n);
	return $temp[0];
}

function div_clear()
{
	return "<div class='clear'></div>";
}

function traduz_role($s)
{
	switch($s)
	{
		case ROLE_NAO_ATRIBUIDO: return "N/I";
		case ROLE_ASSISTENTE: return "Assistente";
		case ROLE_COORDENADOR_GRUPO: return "Coord. Grupo";
		case ROLE_SUPERVISOR_GRUPO: return "Superv. Grupo";
		case ROLE_ADMIN_ANESTESIA: return "Admin. Anest.";
		case ROLE_ADMIN_SISTEMA: return "Admin. Sistema";
	}
}

function SelectBoxSelect($id, $value)
{
    $txt = "<script type=\"text/javascript\" language=\"javascript\">";
    $txt .= "\n<!--\n";
	$txt .= "var select_box = document.getElementById('$id');";
    $txt .= "for(i=0;i<select_box.length;i++)";
	$txt .= "{";
	$txt .= "if(select_box.options[i].value == '$value')";
	$txt .= "{";
	$txt .= "select_box.options[i].selected = true;";
	$txt .= "i = select_box.length;";
	$txt .= "}";
	$txt .= "}";
    $txt .= "\n-->\n";
    $txt .= "</script>";
	return $txt;
}

//-----------------------------------------------------------------------------------------------------------------------------------------
class TSelecionador
{
	private $nome;
	private $dados;
	private $form;
	
	public function TSelecionador($nome, $form)
	{
		$this->nome = trim($nome);
		$this->form = trim($form);
	}
	
	public function SetNome($nome)
	{
		$this->nome = trim($nome);
	}
	
	public function GetNome()
	{
		return $this->nome;
	}
	
	public function SetForm($form)
	{
		$this->form = trim($form);
	}
	
	public function GetForm()
	{
		return $this->form;
	}
	
	public function SetDados($dados)
	{
		$this->dados = $dados;
	}
	
	public function GerarHTML($tit, $instr, $txt_1, $txt_2)
	{
		$txt = "<div class='selecionador' id='selecionador_" . $this->nome . "'>";
		$txt .= "<p class='full'><strong>$tit</strong></p>";
		$txt .= "<p class='full'>$instr</p>";
		$txt .= "<input type='hidden' name='hidden_selecionador_" . $this->nome . "' id='hidden_selecionador_" . $this->nome . "' value=''>";

		//construa primeiro select box com todos os NÃO SELECIONADOS
		$txt .= "<div class='selecionador_primeiro'>";
		$txt .= "<p>$txt_1</p>";
		$txt .= "<select name='" . $this->nome . "_1' id='" . $this->nome . "_1' multiple size='10'>";
		
		if(isset($this->dados))
		{
			foreach($this->dados as $d)
			{
				if(!$d->selected)
				{
					$txt .= "<option value='". $d->value . "'>" . $d->option . "</option>";
				}
			}
		}
		$txt .= "</select>";
		$txt .= "</div>";
		
		// botões >> e <<
		$txt .= "<div class='selecionador_botoes'>";
		$txt .= "<input type='button' name='" . $this->nome . "_add' id='". $this->nome . "_add' value='&raquo;' onclick='AddItem_" . $this->nome . "()' />";
		$txt .= "<input type='button' name='" . $this->nome . "_del' id='". $this->nome . "_del' value='&laquo;' onclick='RemoveItem_" . $this->nome . "()'/>";	
		$txt .= "</div>";
		
		//construa segundo select box com todos os SELECIONADOS
		$txt .= "<div class='selecionador_segundo'>";
		$txt .= "<p>$txt_2</p>";
		$txt .= "<select name='" . $this->nome . "_2' id='" . $this->nome . "_2' multiple size='10'>";
		
		if(isset($this->dados))
		{
			foreach($this->dados as $d)
			{
				if($d->selected)
				{
					$txt .= "<option value='". $d->value . "'>" . $d->option . "</option>";
				}
			}
		}
		$txt .= "</select>";
		$txt .= "</div>";
		
		//javascript para implementar botões >> e <<
		$txt .= "<script type='text/javascript'><!--\r\n";
		
		$txt .= "function AddItem_" . $this->nome . "(){\r\n";
		$txt .= "var box1 = document." . $this->form . "." . $this->nome . "_1;\r\n";
		$txt .= "if(box1.selectedIndex == -1) return;\r\n";
		$txt .= "var selection = box1.options[box1.selectedIndex].value;\r\n";
		$txt .= "var box2 = document." . $this->form . "." . $this->nome . "_2;\r\n";
		$txt .= "for(i=0;i<box1.length;i++){\r\n";
		$txt .= "if(box1.options[i].selected){\r\n";
		$txt .= "box2.options[box2.length] = new Option(box1.options[i].text, box1.options[i].value);\r\n";
		$txt .= "box1.options[i] = null;\r\n";
		$txt .= "i=-1;}\r\n}}\r\n";

		$txt .= "function RemoveItem_" . $this->nome . "(){\r\n";
		$txt .= "var box1 = document." . $this->form . "." . $this->nome . "_2;\r\n";
		$txt .= "if(box1.selectedIndex == -1) return;\r\n";
		$txt .= "var selection = box1.options[box1.selectedIndex].value;\r\n";
		$txt .= "var box2 = document." . $this->form . "." . $this->nome . "_1;\r\n";
		$txt .= "for(i=0;i<box1.length;i++){\r\n";
		$txt .= "if(box1.options[i].selected){\r\n";
		$txt .= "box2.options[box2.length] = new Option(box1.options[i].text, box1.options[i].value);\r\n";
		$txt .= "box1.options[i] = null;\r\n";
		$txt .= "i=-1;}\r\n}}\r\n";		
		
		$txt .= "--></script>";
		
		$txt .= "</div>";
		
		return $txt;
	}
	
	public function GerarBeforeSubmit()
	{
		$txt = "var temp_" . $this->nome . " = \"\";\r\n";
		$txt .= "var box_" . $this->nome . " = document." . $this->form . "." . $this->nome . "_2;\r\n";
		$txt .= "for(i=0;i<box_" . $this->nome . ".length;i++)\r\n{\r\n";
		$txt .= "temp_" . $this->nome . " += box_" . $this->nome . ".options[i].value + \",\";\r\n";
		$txt .= "}\r\n";
		$txt .= "document." . $this->form . ".hidden_selecionador_" . $this->nome . ".value = temp_" . $this->nome . ";\r\n\r\n";
		return $txt;
	}
}

/* End of file trajettoria_helper.php */
/* Location: ./application/helpers/trajettoria_helper.php */
