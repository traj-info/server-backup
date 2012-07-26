<?php

/**
 * Avaliacao DataMapper Model
 *
 */
class Avaliacao extends DataMapper {

	var $model = 'avaliacao';
	var $table = 'avaliacoes';

	// Insert related models that Avaliacao can have just one of.
	var $has_one = array();

	// Insert related models that Avaliacao can have more than one of.
	var $has_many = array('group', 'resposta');

	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------

	var $validation = array(
		'name' => array(
			'label' => 'Nome do modelo de avaliação',
			'rules' => array(
				'required',
				'trim',
				'min-length' => 3,
				'max-length' => 255
			)
		),
		'description' => array(
			'label' => 'Descrição',
			'rules' => array(
				'trim',
				'min-length' => 3,
				'max-length' => 255
			)
		),
		'filename' => array(
			'label' => 'Nome do arquivo com as questões',
			'rules' => array(
				'required',
				'trim',
				'min-length' => 3,
				'max-length' => 255
			)
		),
		'target' => array(
			'label' => 'Aplica-se',
			'rules' => array(
				'required'
			)
		)
	);

	// --------------------------------------------------------------------
	// Default Ordering
	//   Uncomment this to always sort by 'name', then by
	//   id descending (unless overridden)
	// --------------------------------------------------------------------

	// var $default_order_by = array('name', 'id' => 'desc');

	// --------------------------------------------------------------------

	/**
	 * Constructor: calls parent constructor
	 */
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	function post_model_init($from_cache = FALSE)
	{
	}

	// --------------------------------------------------------------------
	// Custom Methods
	//   Add your own custom methods here to enhance the model.
	// --------------------------------------------------------------------

	/* Example Custom Method
	function get_open_avaliacaos()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/


	// --------------------------------------------------------------------
	// Custom Validation Rules
	//   Add custom validation rules for this model here.
	// --------------------------------------------------------------------

	/* Example Rule
	function _convert_written_numbers($field, $parameter)
	{
	 	$nums = array('one' => 1, 'two' => 2, 'three' => 3);
	 	if(in_array($this->{$field}, $nums))
		{
			$this->{$field} = $nums[$this->{$field}];
	 	}
	}
	*/
}

/* End of file avaliacao.php */
/* Location: ./application/models/avaliacao.php */
