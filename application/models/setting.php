<?php

/**
 * Setting DataMapper Model
 *
 */
class Setting extends DataMapper {

	var $model = 'setting';
	var $table = 'settings';

	// Insert related models that Setting can have just one of.
	var $has_one = array();

	// Insert related models that Setting can have more than one of.
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
	function get_open_settings()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/
	
	public function get_chefe_disciplina()
	{
		$user = new User('71'); // TODO: obter chefe da disciplina
		return $user;
	}
	
	private function _strip_email($txt)
	{
		return substr($txt, 6);
	}
	
	public function get_email_settings()
	{
		$result = $this->like('param', 'email_%')->get();
		if($this->result_count() > 0)
		{
			foreach($result as $row)
			{
				$set[$this->_strip_email($row->param)] = $row->value;
			}
			
			return arrayToObject($set);
		}
		else
		{
			return NULL;
		}
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

/* End of file setting.php */
/* Location: ./application/models/setting.php */
