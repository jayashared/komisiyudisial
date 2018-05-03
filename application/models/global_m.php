<?php
class Global_m  extends CI_Model  {

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_newsticker_list()
	{
		if( $this->sess == "id" )
			$this->db->order_by( "title_id desc");
		else
			$this->db->order_by( "title_en desc");
		$query = $this->db->get("view_news_ticker");		
		return $query->result();
	}
	
	function get_search_result($limit=0, $offset=0, $query=NULL)
	{
		if( $this->sess == "id" )
			$this->db->order_by( "title_id desc");
		else
			$this->db->order_by( "title_en desc");
		
		$this->db->limit($limit, $offset);
			
		$this->db->like(array("title_id"=>$query));
		$this->db->or_like(array("title_en"=>$query));
		$this->db->or_like(array("text_id"=>$query));
		$this->db->or_like(array("text_en"=>$query));
		$query = $this->db->get("view_search_result");
		
		//echo $this->db->last_query();
		
		return $query->result();
	}
	
	function get_search_result_count($query=NULL)
	{
		$this->db->like(array("title_id"=>$query));
		$this->db->or_like(array("title_en"=>$query));
		$this->db->or_like(array("text_id"=>$query));
		$this->db->or_like(array("text_en"=>$query));
		
		return $this->db->count_all_results("view_search_result");
	}
	
	function insert_contact_us($data)
	{
		if( !empty($data) )
			return $this->db->insert("tbl_contact_us", $data);
		else
			return false;
	}
	
	function get_detail_contact_us($id_contact_us=NULL)
	{
		$this->db->where(array("id_contact_us"=>$id_contact_us));
		$query = $this->db->get("tbl_contact_us");
		return $query->result();
	}
	
	function get_path_picture()
	{
		$this->db->where(array("name"=>"picture_path"));
		$query = $this->db->get("tbl_global");
		$data = $query->result();
		return $data[0]->value_varchar;
	}
	function get_path_file()
	{
		$this->db->where(array("name"=>"file_path"));
		$query = $this->db->get("tbl_global");
		$data = $query->result();
		return $data[0]->value_varchar;
	}
	
	function get_download_url($name=NULL)
	{
		$this->db->where(array("name"=>$name));
		$query = $this->db->get("tbl_global");
		$data = $query->result();
		return $data[0]->value_varchar;
	}
	
	function check_contact_us_computerid($computerid=null){
		$sql = "
			select 		*
			from 		tbl_contact_us 
			where 		DATE_FORMAT(modified_date, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d')
						and computerid = '" . $computerid . "'
		";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function alter_table_contact(){
		$sql = 'ALTER TABLE tbl_contact_us ADD COLUMN computerid TEXT NOT NULL AFTER reply';
		$query = $this->db->query($sql);
	}
	
}