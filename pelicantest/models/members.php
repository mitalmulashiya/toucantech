<?php

	// Model Name : members
	// Purpose : perform various database functions
	// Created On : 21-Oct-2016
	class members extends MY_Model
	{
		
		// Function Name : get_schools
		// Params : NA
		// Purpose : function to retrieve school data
		// Access : within and outside of class 
		public function get_schools($fields='*',$school_id=NULL) //
		{
			if(is_array($fields) && !empty($fields))
				$fields = implode(',',$fields);
			
			$this->db->select($fields);
			
			$res=$this->db->from($this->tables['schools']);
			if(!empty($school_id))
				$this->db->where('id', $school_id);
			$this->db->where('active >',0);
			$query = $this->db->get();
			if(!$query)
				return false;
			
			return $query->result();
		}

		// Function Name : get_member_record
		// Params : $check_fld name of the field as string,$fld_value value as string to search within given field
		// Purpose : function to retrieve memeber data
		//  Access : within or outside of class 
		public function get_record($check_fld='',$fld_value='') 
		{	
			$this->db->select('*');
			$this->db->where($check_fld,$fld_value);	
			$this->db->from($this->tables['members']);
			$query = $this->db->get();
			if(!$query)
				return false;
			
			return $query->result();
		}

		// Function Name : add_member
		// Params : $member_data array of member data ,$schools array of school ids
		// Purpose : function to add member data
		// Access : within or outside of class 
		public function add_member($member_data,$schools) 
		{
			
			$this->db->insert($this->tables['members'],$member_data);
			
			$usrid= $this->db->insert_id();	
			if($usrid)
			{
				//add selected schools with user id to the userselected_school db
				
				$this->data_list = array();
				foreach($schools as $scl)
				{
					$this->data_list[]=array($usrid,$scl);
					$this->db->insert($this->tables['member_school'],array("user_id"=>$usrid,"school_id"=>$scl));
				}

				return $usrid;
			} 
			else 
				return false;
		}

		// Function Name : by_school
		// Params : $school_id, school id as integer
		// Purpose : retrieve member list for selected shool
		// Access : within or outside of class 
		public function by_school($school_id='')
		{
			$this->db->select('m.name, m.email,s.school_name');
			$this->db->from($this->tables['member_school']. ' as ms');
			if(!empty($school_id))
			$this->db->where('ms.school_id',$school_id);
			$this->db->join($this->tables['schools'].' s', 'ms.school_id = s.school_id');
			$this->db->join($this->tables['members'].' m', 'ms.user_id = m.id');

			$query = $this -> db -> get();
			if($query->num_rows() >0)
				return $query->result();
			else
				return false;
		}
	}