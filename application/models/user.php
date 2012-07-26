<?php

/**
 * User DataMapper Model
 *
 */
class User extends DataMapper {

	var $model = 'user';
	var $table = 'users';
	var $created_field = 'created';
    var $updated_field = 'modified';

	// Insert related models that User can have just one of.
	var $has_one = array('modified_author' => array(
		'class' => 'user',
		'other_field' => 'modified_users'
		));

	// Insert related models that User can have more than one of.
	var $has_many = array('group', 
						  'log', 
						  'controle',
						  'aprovacao',
						  'group_coord' => array(
		'class' => 'group',
		'other_field' => 'coordenador'
	),
						  'group_superv' => array(
		'class' => 'group',
		'other_field' => 'supervisor'
	),
						  'modified_users' => array(
		'class' => 'user',
		'other_field' => 'modified_author'
	),
						  'sent_messages' => array(
		'class' => 'message',
		'other_field' => 'from'
	), 					  'got_messages' => array(
		'class' => 'message',
		'other_field' => 'to'
	),					  'respostas_minhas' => array(
		'class' => 'resposta',
		'other_field' => 'author'
	),					  'respostas_sobre_mim' => array(
		'class' => 'resposta',
		'other_field' => 'ref_user'
	));

	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------

	var $validation = array(
		'wp_user_id' => array(
			'rules' => array('unique')
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

	public function get_active()
	{
		return $this->where('status_id', STATUS_ACTIVE)->get();
	}
	
	// --------------------------------------------------------------------
	// Custom Methods
	//   Add your own custom methods here to enhance the model.
	// --------------------------------------------------------------------

	/* Example Custom Method
	function get_open_users()
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

/* End of file user.php */
/* Location: ./application/models/user.php */
