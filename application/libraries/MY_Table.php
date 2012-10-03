<?php
class MY_Table extends CI_Table {

	function __construct()
	{
		parent::__construct();
		$this->set_template(array('table_open'=>'<table class="table table-bordered table-condensed table-hover">'));
	}

}