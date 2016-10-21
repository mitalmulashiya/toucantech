<?php

	// Common Model class : My_model
	// Purpose : gets table names
	// Created On : 21-Oct-2016
	
	class MY_Model extends CI_Model {
		
		//list of database tables
		protected $tables,$num_rows;
		
		function __construct()
		{
			parent::__construct();
			$this->tables =  $this->config->item('DB_TABLES');
			$this->num_rows = 0;
		}
	}