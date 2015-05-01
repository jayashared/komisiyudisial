<?php
class User_m  extends CI_Model  {

	protected $primary_key = null;
	protected $table_name = null;
	protected $relation = array();
	protected $relation_n_n = array();
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
    }
	
	function select($where)
	{
		$this->db->where($where);
		$query = $this->db->get('tbl_user_view');
		return $query->result();
	}
}