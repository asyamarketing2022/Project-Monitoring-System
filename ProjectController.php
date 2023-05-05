<?php 

class ProjectController
{

    public function __construct()
    {
        $db = new DBconnection();
        $this->conn = $db->connection();
    }

    public function create()
    {
        
    }
}


?>