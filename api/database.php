<?php

class database {
   
    private $connection;
    //Prepared statements for queries.

    private $get_all_projects_statement= null;
	private $get_all_projects_from_country_statement = null;
	private $get_all_projects_with_status_statement = null;

    public function __construct($host, $user, $pass, $database) {
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli($host, $user, $pass, $database);
         $this->connection->set_charset("utf8");

        if ($this->connection->connect_error) {
            die($this->connection->connect_error);

            exit();
        }

        
		$this->get_all_projects_statement = $this->connection->prepare("SELECT * FROM project");	
		$this->get_all_projects_from_country_statement = $this->connection->prepare("SELECT * FROM project inner join country on project.id=country.id WHERE country.name=?");
		$this->get_all_projects_with_status_statement = $this->connection->prepare("SELECT * FROM project inner join approval_status on project.id=approval_status.id WHERE approval_status.name=?");
		
		
 }

    public function __destruct() {
        $this->connection->close();
    }
	

   public function get_all_projects() {
        $this->get_all_projects_statement->execute();
        $result = $this->get_all_projects_statement->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($rows);
    }
	

	 public function get_all_projects_from_country($id) {
        $this->get_all_projects_from_country_statement->bind_param('i', $id);
        $this->get_all_projects_from_country_statement->execute();
        $result = $this->get_all_projects_from_country_statement->get_result();
     $rows = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($rows);
    }
	
	 public function get_all_projects_for_approval_status($id) {
        $this->get_all_projects_with_status_statement->bind_param('i', $id);
        $this->get_all_projects_with_status_statement->execute();
        $result = $this->get_all_projects_with_status_statement->get_result();
     $rows = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($rows);
    }
	

}

?>
