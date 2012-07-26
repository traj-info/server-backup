<?php

/**
 * Message DataMapper Model
 *
 */
class Message extends DataMapper {

	var $model = 'message';
	var $table = 'messages';

	// Insert related models that Message can have just one of.
	var $has_one = array('from' => array(
		'class' => 'user',
		'other_field' => 'sent_messages'
		), 				 'to' => array(
		'class' => 'user',
		'other_field' => 'got_messages'
	));

	// Insert related models that Message can have more than one of.
	var $has_many = array();

	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------

	var $validation = array(
		'body' => array(
			'label' => 'Mensagem',
			'rules' => array('required')
		),
		'to' => array(
			'label' => 'Destinatário(s)',
			'rules' => array('required')
		),
		'subject' => array(
			'label' => 'Assunto',
			'rules' => array('required')
		),
		'reference' => array(
			'label' => 'Referência',
			'rules' => array('required')
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
	function get_open_messages()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/

	public function new_message($from, $to, $subject, $body)
	{
		$this->subject = $subject;
		$this->body = $body;
		$this->reference = create_guid();
		$this->read_count = 0;
		
		return $this->save( array(
			'from' => $from,
			'to' => $to
		));
	}
	
	public function record_count_to($to) {
        return $this->where('to_id', $to)->where('obs', NULL)->or_where('obs !=', 'deleted')->count();
    }

	public function record_count_from($from) {
        $this->select('COUNT(id)')->where('from_id', $from)->group_by('reference')->get();
		return $this->result_count();
    }

    public function get_to($to, $limit=NULL, $start=NULL, $status=NULL) {
        if($limit && $start) $this->limit($limit, $start);
		
		$status_where = '';
		if($status == MSG_UNREAD)
		{
			$status_where = 'AND `read_count` < 1' ;
		}
		else if($status == MSG_READ)
		{
			$status_where = 'AND `read_count` > 0 ' ;
		}
		
		$where =  "`to_id` = " . $to . " AND (`obs` IS NULL OR `obs` != 'deleted') " . $status_where;
		$this->where($where);
		$this->order_by('created', 'desc');
					
        $query = $this->get();

        if ($query->result_count() > 0) {
            foreach ($query as $row) {
				$row->from->get();
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_from($from, $limit, $start) {
        $this->limit($limit, $start);
		$this->select('*, COUNT(*) as total');
		$this->order_by('created', 'desc');
        $this->where('from_id', $from)->group_by('reference');
		$query = $this->get();

        if ($query->result_count() > 0) {
            foreach ($query as $row) {
				$row->to->get();
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   public function get_csv_tos($ref)
   {
		$query = $this->where('reference', $ref)->get();
		if($this->result_count() > 0)
		{
			$csv = '';
			foreach($query as $row)
			{
				$row->to->get();
				$csv .= $row->to->nome . ', ';
			}
			return substr($csv, 0, strlen($csv) - 2);
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

/* End of file message.php */
/* Location: ./application/models/message.php */
