<?php

/**
 * Group DataMapper Model
 *
 */
class Group extends DataMapper {

	var $model = 'group';
	var $table = 'groups';

	// Insert related models that Group can have just one of.
	var $has_one = array('supervisor' => array(
		'class' => 'user',
		'other_field' => 'group_superv'
	),
						'coordenador' => array(
		'class' => 'user',
		'other_field' => 'group_coord'
	));

	// Insert related models that Group can have more than one of.
	var $has_many = array('user', 'avaliacao');


	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------

	var $validation = array(
		'name' => array(
			'label' => 'Nome do grupo',
			'rules' => array(
				'required',
				'trim',
				'min-length' => 3,
				'max-length' => 255
			)
		),
		'supervisor' => array(
			'label' => 'Supervisor',
			'rules' => array(
				'required'
			)
		),
		'coordenador' => array(
			'label' => 'Coordenador',
			'rules' => array(
				'required'
			)
		),
		'user' => array(
			'label' => 'Assistentes',
			'rules' => array(
				'required'
			)
		),
		'obs' => array(
			'label' => 'Observações gerais'
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
	function get_open_groups()
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

/* End of file group.php */
/* Location: ./application/models/group.php */
