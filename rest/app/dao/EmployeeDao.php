<?php

class EmployeeDao extends BaseDao{

  public $table = 'employee';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
