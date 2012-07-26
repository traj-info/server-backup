<?php

/**
 * Resposta DataMapper Model
 *
 */
class Resposta extends DataMapper {

	var $model = 'resposta';
	var $table = 'respostas';

	// Insert related models that Resposta can have just one of.
	var $has_one = array('avaliacao',
						 'controle',
						 'author' => array(
		'class' => 'user',
		'other_field' => 'respostas_minhas'
	),					 'ref_user' => array(
		'class' => 'user',
		'other_field' => 'respostas_sobre_mim'
	));

	// Insert related models that Resposta can have more than one of.
	var $has_many = array();


	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------

	var $validation = array(
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
	function get_open_respostas()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/
	public function get_auto_avaliacao()
	{
		return $this->where('author_id', $this->ref_user_id)->get();
	}
	
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

/* End of file resposta.php */
/* Location: ./application/models/resposta.php */
