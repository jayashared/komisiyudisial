<?php
class Polling_m  extends CI_Model  {


	protected $table_name = "tbl_polling";
	protected $table_category = "tbl_polling_category";
	protected $table_result = "tbl_polling_result";
	protected $primary_keys = "id_polling";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_category()
	{
		$this->db->where(array("is_active"=>"Y"));
		$this->db->limit(1);
		$query = $this->db->get($this->table_category);		
		return $query->result();
	}
	
	function get_list($where=NULL)
	{
		if( !empty($where) )
			$this->db->where($where);
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function insert_vote($data=NULL)
	{
		try{
			if( !empty($data) )
				return $this->db->insert($this->table_result, $data);
			else
				return 0;
		} catch(Exception $e){
			return 0;
		}
	}
	
	function get_result($id_polling=NULL)
	{
		$sql = 'select		
									round((
										(
											select	count(*)
											from		tbl_polling_result pr
											where		pr.id_polling = p.id_polling
										) 
										/
										(
											select	count(*)
											from		tbl_polling_result
										)
									) * 100, 0) as total_semua
									, p.id_polling,
									pc.id_polling_category
					from			tbl_polling p
					left join	tbl_polling_category pc on pc.id_polling_category = p.id_polling_category
					where 		pc.is_active = "Y" and id_polling = "' . $id_polling . '"
					group by		pc.id_polling_category, p.id_polling
					order by		pc.id_polling_category
					';
		$query = $this->db->query($sql);
		$result = $query->result();
		
		$total_semua = isset($result[0]->total_semua)?$result[0]->total_semua:0;
		return $total_semua;
	}
	
}